<?php /* Template Name:News template */
     get_header(); ?>
    <div class="container">
        <h1>
            <?php the_title(); ?>
        </h1>
        <?php
    if ( function_exists( 'yoast_breadcrumb' ) ) :
       yoast_breadcrumb( '<div id="breadcrumbs">', '</div>' );
    endif;
    ?>
    <div class="pagenews_list main">
        <?php
        $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;

        $the_query = new WP_Query( array(
          'posts_per_page' => 10,
          'paged'          => $paged,
          'post_type' => 'post' 
        ) );

        while( $the_query->have_posts() ){
          $the_query->the_post();
          ?>
                <div class="pagenews_list_item inner">
                    <a href="<?php the_permalink() ?>">
                        <?php the_post_thumbnail() ?>
                        <h4>
                            <?php the_title(); ?>
                        </h4>
                    </a>
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
      <?php the_content(); ?>
    </div>
</div>
<?php get_footer(); ?>