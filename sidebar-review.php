<?php
 $query = new WP_Query( [
	'posts_per_page' => 3,
	'orderby'        => 'rand',
	'post_type' => 'reviews' 
] );

global $post;

if ( $query->have_posts() ) {
	?>
<div class="sidebar_reviews">
    <?php
	while ( $query->have_posts() ) {
		$query->the_post();?>
    <div class="sidebar_reviews_item">
        <div class="rating"><i class="icon-star"></i>
            <?php the_field('review_rating')?>
        </div>
        <div class="sidebar_reviews_img">
            <?php $image = get_field( 'review_image' );
                if ( ! empty( $image ) ): ?>
            <img class="review__logo" src="<?php echo esc_url($image['url']); ?>" srcset="<?php echo esc_url($image['sizes']['thumbnail']); ?> 300w,   <?php echo esc_url($image['sizes']['medium']); ?> 768w " sizes="(max-width: 1110px) 100vw, 1110px" alt="<?php echo esc_attr($image['alt']); ?>" title="<?php echo esc_attr($image['title']); ?>" />
            <?php endif; ?></a></div>
        <div class="name">
            <?php the_field('review_name')?>
        </div>
        <div class="bottom">
            <div class="review">Discount: <span>
                    <?php the_field('review_discount')?></span></div>
            <button onClick="window.open('<?php the_permalink() ?>');" class="blue">Visit</button>
        </div>
    </div>
    <?php
	} ?>
</div>
<?php
} 

wp_reset_postdata();?>
<?php if (get_field('sidebar_banner')) {?>
<div class="sidebar_banner">
    <a href="<?php the_field('sidebar_banner_link') ?>" target="_blank"><img src="<?php the_field('sidebar_banner') ?>" alt=""></a>
</div>
<?php }