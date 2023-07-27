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
    <div class="reviewcat_last">
        <?php
    global $query_string; 
    
     query_posts( array(  'posts_per_page' => 3, 'post_type' => 'compares', 'orderby' => 'rand'));
   if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        <div class="comp_event">
            <a href="<?php the_permalink()?>">
                <div class="info">
                    <div class="logo">
                        <?php $image = get_field( 'item_logo_1' );
                if ( ! empty( $image ) ): ?>
                        <img width="75" height="75" src="<?php echo esc_url($image['url']); ?>" srcset="<?php echo esc_url($image['sizes']['thumbnail']); ?> 300w,   <?php echo esc_url($image['sizes']['medium']); ?> 768w " sizes="(max-width: 1110px) 100vw, 1110px" alt="<?php echo esc_attr($image['alt']); ?>" title="<?php echo esc_attr($image['title']); ?>" />
                        <?php endif; ?>
                    </div>
                    <div class="timedate">
                        <div class="time">
                            <?php the_field('comp_cat') ?>
                        </div>
                        <div class="date">
                            category
                        </div>
                    </div>
                    <div class="logo">
                        <?php $image = get_field( 'item_logo_2' );
                if ( ! empty( $image ) ): ?>
                        <img width="75" height="75" src="<?php echo esc_url($image['url']); ?>" srcset="<?php echo esc_url($image['sizes']['thumbnail']); ?> 300w,   <?php echo esc_url($image['sizes']['medium']); ?> 768w " sizes="(max-width: 1110px) 100vw, 1110px" alt="<?php echo esc_attr($image['alt']); ?>" title="<?php echo esc_attr($image['title']); ?>" />
                        <?php endif; ?>
                    </div>
                </div>
                <div class="title">
                    <div class="team1">
                        <?php the_field('item_1') ?>
                    </div> <span>&nbsp;—&nbsp;</span>
                    <div class="team2">
                        <?php the_field('item_2') ?>
                    </div>
                </div>
                <?php 
                $content = [["Best price", get_field('best_plice')], ["Best rating", get_field('quality')], ["Quality", get_field('best_rating')]];
                $random =   $content[rand(0, 2)]
                   ?>
                <div class="compare">
                    <div class="compare_item for_draw">
                        <div class="team">
                            <?php echo  $random[0]?>
                        </div>
                        <div class="compare_inner">
                            <img src="<?php the_field('quality_logo') ?>" alt="">
                            <div class="koff">
                                <?php echo $random[1] ?>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <?php endwhile; 
  wp_reset_query();  ?>
    </div>
    <div class="reviewcat">
        <?php

$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;

$the_query = new WP_Query( array(
  'posts_per_page' => 6,
  'paged'          => $paged,
  'post_type' => 'compares' 
) );


while( $the_query->have_posts() ){
  $the_query->the_post();
  ?>
        <div class="comp_event">
            <a href="<?php the_permalink()?>">
                <div class="info">
                    <div class="team">
                        <div class="logo">
                            <?php $image = get_field( 'item_logo_1' );
                             if ( ! empty( $image ) ): ?>
                            <img src="<?php echo esc_url($image['url']); ?>" srcset="<?php echo esc_url($image['sizes']['thumbnail']); ?> 300w,   <?php echo esc_url($image['sizes']['medium']); ?> 768w " sizes="(max-width: 1110px) 100vw, 1110px" alt="<?php echo esc_attr($image['alt']); ?>" title="<?php echo esc_attr($image['title']); ?>" />
                            <?php endif; ?>
                        </div>
                        <div class="title">
                            <?php the_field('item_1') ?>
                        </div>
                    </div>
                    <div class="team">
                        <div class="logo">
                            <?php $image = get_field( 'item_logo_2' );
                             if ( ! empty( $image ) ): ?>
                            <img src="<?php echo esc_url($image['url']); ?>" srcset="<?php echo esc_url($image['sizes']['thumbnail']); ?> 300w,   <?php echo esc_url($image['sizes']['medium']); ?> 768w " sizes="(max-width: 1110px) 100vw, 1110px" alt="<?php echo esc_attr($image['alt']); ?>" title="<?php echo esc_attr($image['title']); ?>" />
                            <?php endif; ?>
                        </div>
                        <div class="title">
                            <?php the_field('item_2') ?>
                        </div>
                    </div>
                </div>
                <div class="compare">
                   <?php the_title();?>
                </div>
            </a>
        </div>
        <?php
}?>
    </div>
    <?php
wp_reset_postdata();

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
    <?php get_template_part('template-parts/testimonials') ?>
</div>
<?php get_footer(); ?>