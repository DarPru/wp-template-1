<?php 
 get_header() ?>
<div class="container">
    <?php
if ( function_exists( 'yoast_breadcrumb' ) ) :
   yoast_breadcrumb( '<div id="breadcrumbs">', '</div>' );
endif;
?>
    <h1>
        <?php the_title(); ?>
    </h1>
    <div class="review_list">
        <?php

          $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;

          $the_query = new WP_Query( array(
            'posts_per_page' => 20,
            'paged'          => $paged,
            'post_type' => 'sales' 
          ) );

          while( $the_query->have_posts() ){
            $the_query->the_post();
            ?>
        <div class="review_list_item" style="background-image: url(<?php the_post_thumbnail_url() ?>);">
            <img src="<?php the_field('sale_reglogo') ?>" alt="">
            <?php the_excerpt() ?>
            <button onClick="window.location.href = '<?php the_permalink() ?>';">Get bonus</button>
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
    <div class="content">
        <?php the_content() ?>
    </div>
</div>
</div>
<?php get_footer() ?>