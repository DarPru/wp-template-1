<h2>Discount</h2>
<div class="book_review">
    <div class="head">
        <div class="left">
             <?php $image = get_field( 'review_image' );
               	if ( ! empty( $image ) ): ?>
        <img src="<?php echo esc_url($image['url']); ?>" srcset="<?php echo esc_url($image['sizes']['thumbnail']); ?> 300w,   <?php echo esc_url($image['sizes']['medium']); ?> 768w " sizes="(max-width: 125px) 100vw, 125px" />
        <?php endif; ?>
            <div class="review">Discount: <span>
                    <?php the_field('review_discount')?></span></div>
        </div>
        <div class="right"><button class="blue" onClick="window.open('<?php the_field('reviewdiscount_btnlink'); ?>');">
                <?php the_field('reviewdiscount_btntext')?></button></div>
    </div>
    <div class="content">
        <div class="top">
            <p>
                <?php the_field('reviewdiscount_text')?>
            </p>
        </div>
        <div class="bottom">
            <div class="info">Best price for you: <b>
                    <?php the_field('reviewdiscount_bestprice')?></b></div>
            <button class="black" onClick="window.open('<?php the_field('reviewdiscount_btnlink2');?>');">
                <?php the_field('reviewdiscount_btntext2')?></button>
        </div>
    </div>
</div>