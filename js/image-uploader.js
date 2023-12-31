class ItcSimpleSlider {
  static PREFIX = 'itcss';
  static CLASS_NAME_ITEM = `${ItcSimpleSlider.PREFIX}__item`;
  static CLASS_NAME_ITEM_ACTIVE = `${ItcSimpleSlider.PREFIX}__item_active`;
  static CLASS_NAME_ITEMS = `${ItcSimpleSlider.PREFIX}__items`;
  static CLASS_NAME_INDICATOR = `${ItcSimpleSlider.PREFIX}__indicator`;
  static CLASS_NAME_INDICATOR_ACTIVE = `${ItcSimpleSlider.PREFIX}__indicator_active`;
  static CLASS_NAME_INDICATORS = `${ItcSimpleSlider.PREFIX}__indicators`;
  static CLASS_NAME_CONTROL = `${ItcSimpleSlider.PREFIX}__control`;
  static CLASS_NAME_CONTROL_PREV = `${ItcSimpleSlider.PREFIX}__control_prev`;
  static CLASS_NAME_CONTROL_NEXT = `${ItcSimpleSlider.PREFIX}__control_next`;
  static CLASS_NAME_CONTROL_SHOW = `${ItcSimpleSlider.PREFIX}__control_show`;
  static SELECTOR_ITEMS = `.${ItcSimpleSlider.CLASS_NAME_ITEMS}`;
  static SELECTOR_ITEM = `.${ItcSimpleSlider.CLASS_NAME_ITEM}`;
  static SELECTOR_ITEM_ACTIVE = `.${ItcSimpleSlider.CLASS_NAME_ITEM_ACTIVE}`;
  static SELECTOR_INDICATOR_ACTIVE = `.${ItcSimpleSlider.CLASS_NAME_INDICATOR_ACTIVE}`;
  static SELECTOR_INDICATORS = `.${ItcSimpleSlider.CLASS_NAME_INDICATORS}`;
  static SELECTOR_WRAPPER = `.${ItcSimpleSlider.PREFIX}__wrapper`;
  static SELECTOR_CONTROL = `.${ItcSimpleSlider.CLASS_NAME_CONTROL}`;
  static SELECTOR_CONTROL_NEXT = `.${ItcSimpleSlider.CLASS_NAME_CONTROL_NEXT}`;
  static SELECTOR_CONTROL_PREV = `.${ItcSimpleSlider.CLASS_NAME_CONTROL_PREV }`;
  // порог для переключения слайда (20%)
  static SWIPE_THRESHOLD = 20;
  // класс для отключения transition
  static TRANSITION_NONE = 'transition-none';

  constructor(target, config) {
    this._el = typeof target === 'string' ? document.querySelector(target) : target;
    this._elWrapper = this._el.querySelector(ItcSimpleSlider.SELECTOR_WRAPPER);
    this._elItems = this._el.querySelector(ItcSimpleSlider.SELECTOR_ITEMS);
    this._elsItem = this._el.querySelectorAll(ItcSimpleSlider.SELECTOR_ITEM);
    // текущий индекс
    this._currentIndex = 0;
    // экстремальные значения слайдов
    this._minOrder = 0;
    this._maxOrder = 0;
    this._$itemWithMinOrder = null;
    this._$itemWithMaxOrder = null;
    this._minTranslate = 0;
    this._maxTranslate = 0;
    // направление смены слайдов (по умолчанию)
    this._direction = 'next';
    // флаг, который показывает, что идёт процесс уравновешивания слайдов
    this._balancingItemsFlag = false;
    // текущее значение трансформации
    this._transform = 0;

    this._width = this._elWrapper.getBoundingClientRect().width;

    this._supportResizeObserver = typeof window.ResizeObserver !== 'undefined';

    // swipe параметры
    this._hasSwipeState = false;
    this._swipeStartPosX = 0;
    // id таймера
    this._intervalId = null;
    // конфигурация слайдера (по умолчанию)
    const defaultConfig = {
      autoplay: false,
      loop: true,
      indicators: true,
      interval: 5000,
      swipe: true,
    };
    this._config = Object.assign(defaultConfig, config);
    this._elItems.dataset.translate = 0;
    // добавляем к слайдам data-атрибуты
    this._elsItem.forEach((item, index) => {
      item.dataset.order = index;
      item.dataset.index = index;
      item.dataset.translate = 0;
    });
    // перемещаем последний слайд перед первым
    if (this._config.loop) {
      const count = this._elsItem.length - 1;
      const translate = -this._elsItem.length;
      this._elsItem[count].dataset.order = -1;
      this._elsItem[count].dataset.translate = -this._elsItem.length;
      const translateX = translate * this._width;
      this._elsItem[count].style.transform = `translateX(${translateX}px)`;
    }
    // добавляем индикаторы к слайдеру
    this._addIndicators();
    // обновляем экстремальные значения переменных
    this._refreshExtremeValues();
    // помечаем активные элементы
    this._setActiveClass();
    // назначаем обработчики
    this._addEventListener();
    // запускаем автоматическую смену слайдов
    this._autoplay();
  }

  _setActiveClass() {
    const elActive = this._el.querySelector(ItcSimpleSlider.SELECTOR_ITEM_ACTIVE);
    elActive ? elActive.classList.remove(ItcSimpleSlider.CLASS_NAME_ITEM_ACTIVE) : null;
    const elActiveNew = this._el.querySelector(`[data-index="${this._currentIndex}"]`);
    elActiveNew ? elActiveNew.classList.add(ItcSimpleSlider.CLASS_NAME_ITEM_ACTIVE) : null;

    const elIndicatorActive = this._el.querySelector(ItcSimpleSlider.SELECTOR_INDICATOR_ACTIVE);
    elIndicatorActive ? elIndicatorActive.classList.remove(ItcSimpleSlider.CLASS_NAME_INDICATOR_ACTIVE) : null;
    const elIndicatorNew = this._el.querySelector(`[data-slide-to="${this._currentIndex}"]`);
    elIndicatorNew ? elIndicatorNew.classList.add(ItcSimpleSlider.CLASS_NAME_INDICATOR_ACTIVE) : null;

    const elPrevBtn = this._el.querySelector(ItcSimpleSlider.SELECTOR_CONTROL_PREV);
    const elNextBtn = this._el.querySelector(ItcSimpleSlider.SELECTOR_CONTROL_NEXT);
    elPrevBtn ? elPrevBtn.classList.add(ItcSimpleSlider.CLASS_NAME_CONTROL_SHOW) : null;
    elNextBtn ? elNextBtn.classList.add(ItcSimpleSlider.CLASS_NAME_CONTROL_SHOW) : null;
    if (!this._config.loop && this._currentIndex === 0) {
      elPrevBtn.classList.remove(ItcSimpleSlider.CLASS_NAME_CONTROL_SHOW);
    } else if (!this._config.loop && this._currentIndex === this._elsItem.length - 1) {
      elNextBtn.classList.remove(ItcSimpleSlider.CLASS_NAME_CONTROL_SHOW);
    }

    this._el.dispatchEvent(new CustomEvent('active.itc.slider', {
      bubbles: true,
    }));
  }

  // смена слайдов
  _move(useTransition) {
    let translateX;
    this._elItems.classList.remove(ItcSimpleSlider.TRANSITION_NONE);
    if (useTransition === false) {
      this._elItems.classList.add(ItcSimpleSlider.TRANSITION_NONE);
    }
    if (this._direction === 'none') {
      translateX = this._transform * this._width;
      this._elItems.style.transform = `translateX(${translateX}px)`;
      return;
    }
    if (!this._config.loop) {
      const condition = this._currentIndex + 1 >= this._elsItem.length;
      if (condition && this._direction === 'next') {
        this._autoplay('stop');
        return;
      }
      if (this._currentIndex <= 0 && this._direction === 'prev') {
        return;
      }
    }
    const step = this._direction === 'next' ? -1 : 1;
    const transform = this._transform + step;
    if (this._direction === 'next') {
      if (++this._currentIndex > this._elsItem.length - 1) {
        this._currentIndex -= this._elsItem.length;
      }
    } else {
      if (--this._currentIndex < 0) {
        this._currentIndex += this._elsItem.length;
      }
    }
    this._transform = transform;
    this._elItems.dataset.translate = transform;
    translateX = transform * this._width;
    this._elItems.style.transform = `translateX(${translateX}px)`;
    this._elItems.dispatchEvent(new CustomEvent('transition-start', {
      bubbles: true,
    }));
    this._setActiveClass();
  }

  // функция для перемещения к слайду по индексу
  _moveTo(index, useTransition) {
    const currentIndex = this._currentIndex;
    this._direction = index > currentIndex ? 'next' : 'prev';
    for (let i = 0; i < Math.abs(index - currentIndex); i++) {
      this._move(useTransition);
	console.log('sdfds');
    }
  }

  // метод для автоматической смены слайдов
  _autoplay(action) {
    if (!this._config.autoplay) {
      return;
    }
    if (action === 'stop') {
      clearInterval(this._intervalId);
      this._intervalId = null;
      return;
    }
    if (this._intervalId === null) {
      this._intervalId = setInterval(() => {
        this._direction = 'next';
        this._move();
      }, this._config.interval);
    }
  };

  // добавление индикаторов
  _addIndicators() {
    if (this._el.querySelector(ItcSimpleSlider.SELECTOR_INDICATORS) || !this._config.indicators) {
      return;
    }
    let html = '';
    let img1elements = document.getElementsByClassName('team-1');
    let imgs1 = [];
    for (let item of img1elements) {
      imgs1.push(item.getAttribute('src'));
    }
    let img2elements = document.getElementsByClassName('team-2');
    let imgs2 = [];
    for (let item of img2elements) {
      imgs2.push(item.getAttribute('src'));
    }
    let imgs1srcset = [];
    for (let item of img1elements) {
      imgs1srcset.push(item.getAttribute('srcset'));
    }
    let imgs2srcset = [];
    for (let item of img2elements) {
      imgs2srcset.push(item.getAttribute('srcset'));
    }
    let txt1elements = document.getElementsByClassName('team-1-txt');
    let txts1 = [];
    for (let item of txt1elements) {
      txts1.push(item.textContent);
    }
    let txt2elements = document.getElementsByClassName('team-2-txt');
    let txts2 = [];
    for (let item of txt2elements) {
      txts2.push(item.textContent);
    }
    
    for (let i = 0, length = this._elsItem.length; i < length; i++) {
      html += `<li class="${ItcSimpleSlider.CLASS_NAME_INDICATOR}" data-slide-to="${i}">
        <div id="${i}" class="indicator__progress-element"></div>
        <div class="indicator__content" id="${i+10}">
          <div class="indicator__images">
            <img class="indicator__image" width="30" height="30" srcset="${imgs1srcset[i]}" src="${imgs1[i]}">
            <img class="indicator__image" width="30" height="30" srcset="${imgs2srcset[i]}" src="${imgs2[i]}">
          </div>
          <div class="indicator__texts">
            <p class="indicator__text">${txts1[i]}</p>
            <p class="indicator__text">${txts2[i]}</p>
          </div>
        </div>
          
      </li>`;
    }
    this._el.insertAdjacentHTML('beforeend', `<ol class="${ItcSimpleSlider.CLASS_NAME_INDICATORS}">${html}</ol>`);
	const el1 = document.getElementById('10');
	const el2 = document.getElementById('11');
	const el3 = document.getElementById('12');
	const el4 = document.getElementById('13');
	el1.addEventListener('click', () => {this._moveTo(0)});
	el2.addEventListener('click', () => {this._moveTo(1)});
	el3.addEventListener('click', () => {this._moveTo(2)});
	el4.addEventListener('click', () => {this._moveTo(3)});
  }

  // refresh extreme values
  _refreshExtremeValues() {
    this._minOrder = parseInt(this._elsItem[0].dataset.order);
    this._maxOrder = this._minOrder;
    this._$itemWithMinOrder = this._elsItem[0];
    this._$itemWithMaxOrder = this._$itemWithMinOrder;
    this._minTranslate = parseInt(this._elsItem[0].dataset.translate);
    this._maxTranslate = this._minTranslate;
    for (let i = 0, length = this._elsItem.length; i < length; i++) {
      const $item = this._elsItem[i];
      const order = parseInt($item.dataset.order, 10);
      if (order < this._minOrder) {
        this._minOrder = order;
        this._$itemWithMinOrder = $item;
        this._minTranslate = parseInt($item.dataset.translate, 10);
      } else if (order > this._maxOrder) {
        this._maxOrder = order;
        this._$itemWithMaxOrder = $item;
        this._maxTranslate = parseInt($item.dataset.translate, 10);
      }
    }
  }

  // balancing items
  _balancingItems() {
    if (!this._balancingItemsFlag) {
      return;
    }
    const $wrapper = this._elWrapper;
    const wrapperRect = $wrapper.getBoundingClientRect();
    const halfWidthItem = wrapperRect.width / 2;
    const count = this._elsItem.length;
    let translate;
    let clientRect;
    let translateX;
    if (this._direction === 'next') {
      const wrapperLeft = wrapperRect.left;
      const $min = this._$itemWithMinOrder;
      translate = this._minTranslate;
      clientRect = $min.getBoundingClientRect();
      if (clientRect.right < wrapperLeft - halfWidthItem) {
        $min.dataset.order = this._minOrder + count;
        translate += count;
        $min.dataset.translate = translate;
        translateX = translate * this._width;
        $min.style.transform = `translateX(${translateX}px)`;
        this._refreshExtremeValues();
      }
    } else if (this._direction === 'prev') {
      const wrapperRight = wrapperRect.right;
      const $max = this._$itemWithMaxOrder;
      translate = this._maxTranslate;
      clientRect = $max.getBoundingClientRect();
      if (clientRect.left > wrapperRight + halfWidthItem) {
        $max.dataset.order = this._maxOrder - count;
        translate -= count;
        $max.dataset.translate = translate;
        translateX = translate * this._width;
        $max.style.transform = `translateX(${translateX}px)`;
        this._refreshExtremeValues();
      }
    }
    requestAnimationFrame(this._balancingItems.bind(this));
  }

  // adding listeners
  _addEventListener() {
    const $items = this._elItems;
    function onClick(e) {
      const $target = e.target;
      this._autoplay('stop');
      if ($target.classList.contains(ItcSimpleSlider.CLASS_NAME_CONTROL)) {
        e.preventDefault();
        this._direction = $target.dataset.slide;
        this._move();
      } else if ($target.dataset.slideTo) {
        e.preventDefault();
        const index = parseInt($target.dataset.slideTo, 10);
        this._moveTo(index);
      }
      if (this._config.loop) {
        this._autoplay();
      }
    }

    function onTransitionStart() {
      if (this._balancingItemsFlag) {
        return;
      }
      this._balancingItemsFlag = true;
      window.requestAnimationFrame(this._balancingItems.bind(this));
    }

    function onTransitionEnd() {
      this._balancingItemsFlag = false;
      this._el.dispatchEvent(new CustomEvent('transition-end', {
        bubbles: true,
      }));
    }

    function onMouseEnter() {
      this._autoplay('stop');
    }

    function onMouseLeave() {
      if (this._config.loop) {
        this._autoplay();
      }
    }

    function onSwipeStart(e) {
      this._autoplay('stop');
      if (e.target.closest(ItcSimpleSlider.CLASS_NAME_CONTROL)) {
        return;
      }
      const event = e.type.search('touch') === 0 ? e.touches[0] : e;
      this._swipeStartPosX = event.clientX;
      this._swipeStartPosY = event.clientY;
      this._hasSwipeState = true;
      this._hasSwiping = false;
    }

    function onSwipeMove(e) {
      if (!this._hasSwipeState) {
        return;
      }
      const event = e.type.search('touch') === 0 ? e.touches[0] : e;
      let diffPosX = this._swipeStartPosX - event.clientX;
      const diffPosY = this._swipeStartPosY - event.clientY;
      if (!this._hasSwiping) {
        if (Math.abs(diffPosY) > Math.abs(diffPosX) || Math.abs(diffPosX) === 0) {
          this._hasSwipeState = false;
          return;
        }
        this._hasSwiping = true;
      }
      e.preventDefault();
      if (!this._config.loop) {
        if (this._currentIndex + 1 >= this._elsItem.length && diffPosX >= 0) {
          diffPosX /= 4;
        }
        if (this._currentIndex <= 0 && diffPosX <= 0) {
          diffPosX /= 4;
        }
      }
      const value = (diffPosX / this._elWrapper.getBoundingClientRect().width);
      let translateX = this._transform - value;
      this._elItems.classList.add(ItcSimpleSlider.TRANSITION_NONE);
      translateX *= this._width;
      this._elItems.style.transform = `translateX(${translateX}px)`;
    }

    function onSwipeEnd(e) {
      if (!this._hasSwipeState) {
        return;
      }
      const event = e.type.search('touch') === 0 ? e.changedTouches[0] : e;
      let diffPosX = this._swipeStartPosX - event.clientX;
      if (diffPosX === 0) {
        this._hasSwipeState = false;
        return;
      }
      if (!this._config.loop) {
        if (this._currentIndex + 1 >= this._elsItem.length && diffPosX >= 0) {
          diffPosX /= 7;
        }
        if (this._currentIndex <= 0 && diffPosX <= 0) {
          diffPosX /= 7;
        }
      }
      const value = (diffPosX / this._elWrapper.getBoundingClientRect().width) * 100;
      this._elItems.classList.remove(ItcSimpleSlider.TRANSITION_NONE);
      if (value > ItcSimpleSlider.SWIPE_THRESHOLD) {
        this._direction = 'next';
        this._move();
      } else if (value < -ItcSimpleSlider.SWIPE_THRESHOLD) {
        this._direction = 'prev';
        this._move();
      } else {
        this._direction = 'none';
        this._move();
      }
      this._hasSwipeState = false;
      if (this._config.loop) {
        this._autoplay();
      }
    }

    function onDragStart(e) {
      e.preventDefault();
    }

    function onVisibilityChange() {
      if (document.visibilityState === 'hidden') {
        this._autoplay('stop');
      } else if (document.visibilityState === 'visible') {
        if (this._config.loop) {
          this._autoplay();
        }
      }
    }
    // click
    this._el.addEventListener('click', onClick.bind(this));
    // transitionstart and transitionend
    if (this._config.loop) {
      $items.addEventListener('transition-start', onTransitionStart.bind(this));
      $items.addEventListener('transitionend', onTransitionEnd.bind(this));
    }
    // mouseenter and mouseleave
    if (this._config.autoplay) {
      this._el.addEventListener('mouseenter', onMouseEnter.bind(this));
      this._el.addEventListener('mouseleave', onMouseLeave.bind(this));
    }
    // swipe
    if (this._config.swipe) {
      let supportsPassive = false;
      try {
        const opts = Object.defineProperty({}, 'passive', {
          get() {
            supportsPassive = true;
          },
        });
        window.addEventListener('testPassiveListener', null, opts);
      } catch (err) {}
      this._el.addEventListener('touchstart', onSwipeStart.bind(this), supportsPassive ? {
        passive: false,
      } : false);
      this._el.addEventListener('touchmove', onSwipeMove.bind(this), supportsPassive ? {
        passive: false,
      } : false);
      this._el.addEventListener('mousedown', onSwipeStart.bind(this));
      this._el.addEventListener('mousemove', onSwipeMove.bind(this));
      document.addEventListener('touchend', onSwipeEnd.bind(this));
      document.addEventListener('mouseup', onSwipeEnd.bind(this));
      document.addEventListener('mouseout', onSwipeEnd.bind(this));
    }
    this._el.addEventListener('dragstart', onDragStart.bind(this));
    // при изменении активности вкладки
    document.addEventListener('visibilitychange', onVisibilityChange.bind(this));

    function onResizeObserver(entries) {
      const contentBoxSize = entries[0].contentBoxSize;
      const contentRect = entries[0].contentRect;
      const newWidth = contentRect ? contentRect.width : (contentBoxSize[0] || contentBoxSize).inlineSize;
      let newTranslateX;
      if (this._width.toFixed(1) === newWidth.toFixed(1)) {
        return;
      }
      this._autoplay('stop');
      this._elItems.classList.add(ItcSimpleSlider.TRANSITION_NONE);
      this._width = parseInt(newWidth.toFixed(1), 10);
      newTranslateX = newWidth * parseInt(this._elItems.dataset.translate, 10);
      this._elItems.style.transform = `translateX(${newTranslateX}px)`;
      const $items2 = this._elsItem;
      for (let i = 0; i < $items2.length; i++) {
        const translateX = parseInt($items2[i].dataset.translate, 10);
        newTranslateX = translateX * newWidth;
        $items2[i].style.transform = `translateX(${newTranslateX}px)`;
      }
      if (this._config.loop) {
        this._autoplay();
      }
    }
    if (this._supportResizeObserver) {
      const resizeObserver = new ResizeObserver(onResizeObserver.bind(this));
      resizeObserver.observe(this._elWrapper);
    }
  }
  // перейти к следующему слайду
  next() {
    this._direction = 'next';
    this._move();
  }
  // перейти к предыдущему слайду
  prev() {
    this._direction = 'prev';
    this._move();
  }
  // управление автоматической сменой слайдов
  autoplay() {
    this._autoplay('stop');
  }
  moveTo(index, useTransition) {
    this._moveTo(index, useTransition);
  }
}


document.addEventListener('DOMContentLoaded', function () {
  // инициализация слайдера
  var slider = new ItcSimpleSlider('.itcss', {
    loop: true,
    autoplay: true,
    swipe: true
  });
});

