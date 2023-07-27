<div class="review_about review" style="background-image: url(<?php the_field('review_bg')?>);">
    <div class="cover"></div>
    <div class="content">
        <img src="<?php the_field('sale_reglogo')?>" alt="">
        <div class="name">
            <?php the_title()?>
        </div>
        <div class="promo"><input class="promocode" readonly type="text" value="<?php the_field('review_promocode')?>" id="myInput"></div>
        <div class="btns">
            <button class="orange" id="copy" onclick="myFunction()">
                <?php the_field('review_promocode_copy')?></span></button>
            <button onClick="window.open('<?php the_field('review_btnlink');?>');" class="blue">
                <?php the_field('review_btntext')?></button>
        </div>
    </div>
</div>
<script>
function myFunction() {
    var copyText = document.getElementById("myInput");
    var copyBtn = document.getElementById("copy");
    copyText.select();
    document.execCommand("copy");
    copyBtn.textContent = 'copied';
}
</script>