<?php get_header() ?>
<div class="container">
    <?php get_template_part('template-parts/slider') ?>
    <h2>Best reviews</h2>
    <div class="reviews_list">
        <?php $the_query = new WP_Query( array(
  'posts_per_page' => 5,
  'post_type' => 'reviews' 
) );

// reviews loop
while( $the_query->have_posts() ){
  $the_query->the_post();
  ?>
        <div class="reviews_list_item">
            <!--content -->
            <?php $image = get_field( 'review_image' );
                if ( ! empty( $image ) ): ?>
            <img class="review__logo" src="<?php echo esc_url($image['url']); ?>" srcset="<?php echo esc_url($image['sizes']['thumbnail']); ?> 300w,   <?php echo esc_url($image['sizes']['medium']); ?> 768w " sizes="(max-width: 1110px) 100vw, 1110px" alt="<?php echo esc_attr($image['alt']); ?>" title="<?php echo esc_attr($image['title']); ?>" />
            <?php endif; ?>
            <div class="title">
                <?php the_field('review_name') ?>
            </div>
            <div class="review">
                <span>
                    <?php the_field('review_discount') ?></span>
                Discount
            </div>
            <div class="rating"><i class="icon-star"></i>
                <?php the_field('review_rating')?>
            </div>
            <div class="likes"><i class="icon-heart"></i>
                <?php the_field('review_likes')?>
            </div>
            <div class="btns">
                <a class="white desktop" onClick="window.location.href = '  <?php the_permalink() ?>';">More</a>
                <a class="white mobile" onClick="window.location.href = '  <?php the_permalink() ?>';">info</a>
                <button class="blue" onClick="window.open('<?php the_field('review_btnlink'); ?>');">To site</button>
            </div>
            <!-- / content  -->
        </div>
        <?php
}?>
    </div>
    <?php
wp_reset_postdata();?>
    <a href="/reviews/" class="all">Show all reviews</a>
    <?php get_template_part('template-parts/banner') ?>
    <h2>News posts</h2>
    <?php get_template_part('template-parts/news') ?>
    <?php
wp_reset_postdata();?>
    <?php get_template_part('template-parts/match-zentr') ?>
    <?php get_template_part('template-parts/testimonials') ?>
    <div class="content">
        <?php the_content() ?>
    </div>
</div>
<?php get_footer() ?>