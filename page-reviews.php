<?php 
 get_header(); ?>
<div class="container">
    <?php
if ( function_exists( 'yoast_breadcrumb' ) ) :
   yoast_breadcrumb( '<div id="breadcrumbs">', '</div>' );
endif;
?>
    <h1>
        <?php the_title(); ?>
    </h1>
    <?php the_field('bk_list_description') ?>
    <div class="reviews_list">
        <?php
$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;

$the_query = new WP_Query( array(
  'posts_per_page' => 20,
  'paged'          => $paged,
  'post_type' => 'reviews' 
) );

// staring the loop
while( $the_query->have_posts() ){
  $the_query->the_post();
  ?>
        <div class="reviews_list_item">
            <!-- content -->
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
                <button class="white" onClick="window.location.href = '  <?php the_permalink() ?>';">More</button>
                <button class="blue" onClick="window.open('<?php the_field('review_btnlink'); ?>');">Visit site</button>
            </div>
            <!-- / content  -->
        </div>
        <?php
}?>
    </div>
    <?php
wp_reset_postdata();

// pagination
$big = 999999999; 
?>
    <div class="nav-links">
        <div class="navigation pagination">
            <?php
echo paginate_links( array(
  'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
  'current' => max( 1, get_query_var('paged') ),
  'total'   => $the_query->max_num_pages
) );
?>
        </div>
    </div>
    <div class="content">
        <?php the_content() ?>
    </div>
</div>
<?php get_footer(); ?>