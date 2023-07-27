<div class="review_about" style="background-image: url(<?php
								  if (get_field('review_bg')) the_field('review_bg');?>);">
    <div class="cover"></div>
    <div class="left">
        <?php $image = get_field( 'review_image' );
               	if ( ! empty( $image ) ): ?>
        <img src="<?php echo esc_url($image['url']); ?>" srcset="<?php echo esc_url($image['sizes']['thumbnail']); ?> 300w,   <?php echo esc_url($image['sizes']['medium']); ?> 768w " sizes="(max-width: 125px) 100vw, 125px" />
        <?php endif; ?>
        <div class="book_rating_mobile">
            <div class="like_dislike">
                <div class="like" onClick="like_m(); this.onclick=null;"><i class="icon-thumbs-up"></i></div>
                <div class="number_m">
                    <?php the_field('review_likes')?>
                </div>
                <div class="dislike" onClick="dislike_m(); this.onclick=null;"><i class="icon-thumbs-down"></i></div>
            </div>
            <div class="rating"><i class="icon-star"></i>
                <?php the_field('review_rating')?>
            </div>
        </div>
        <div class="name">
            <?php the_field('review_name')?>
        </div>
        <div class="btns">
            <button onClick="window.open('<?php the_field('review_btnlink');?>');" class="blue" style="background: #80ffdb; color: #000;">
                <?php the_field('review_btntext')?></button>
            <button class="white"><i class="icon-gift"></i>Discount <span>
                    <?php the_field('review_discount')?></span></button>
        </div>
    </div>
    <div class="right">
        <div class="rating"><i class="icon-star"></i>
            <?php the_field('review_rating')?>
        </div>
        <div class="like_dislike">
            <div class="like" onClick="like(); this.onclick=null;"><i class="icon-thumbs-up"></i></div>
            <div class="number">
                <?php the_field('review_likes')?>
            </div>
            <div class="dislike" onClick="dislike(); this.onclick=null;"><i class="icon-thumbs-down"></i></div>
        </div>
    </div>
</div>
<script>
let number_m = document.querySelector(".number_m");

function like_m() {
    number_m.textContent = parseInt(number_m.textContent) + 1;
    console.log(number_m.textContent)
}

function dislike_m() {
    number.textContent = parseInt(number.textContent) - 1;
}
let number = document.querySelector(".number");

function like() {
    number.textContent = parseInt(number.textContent) + 1;
    console.log(number.textContent)
}

function dislike() {
    number.textContent = parseInt(number.textContent) - 1;
}
</script>