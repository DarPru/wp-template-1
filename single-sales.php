<?php get_header();?>
<div class="container">
    <?php   yoast_breadcrumb( '<div id="breadcrumbs">', '</div>' ); ?>
    <?php get_template_part('template-parts/sales-register') ?>
    <?php the_field('sales_content') ?>
    <?php get_template_part('template-parts/review-bonus') ?>
    <?php get_template_part('template-parts/sale-benefits') ?>
    <div class="content">
        <?php the_content() ?>
    </div>
    <?php 

 $the_query = new WP_Query( array(
  'posts_per_page' => 8,
  'post_type' => 'sales',
  'orderby' => 'rand'

    ) );
     ?>
    <h2>Our best offers</h2>
    <div class="review_list">
        <?php
        while( $the_query->have_posts() ){
          $the_query->the_post();
          ?>
        <div class="review_list_item" style="background-image: url(<?php the_post_thumbnail_url() ?>);">
            <img src="<?php the_field('sale_reglogo') ?>" alt="">
            <?php the_excerpt() ?>
            <button onClick="window.location.href = '<?php the_permalink() ?>';">Get bonus</button>
            <?php if (get_field('unique_review') == 'yes') {?>
            <div class="exclusive">EXCLUSIVE</div>
            <?php } ?>
        </div>
        <?php
    }?>
    </div>
    <?php
wp_reset_postdata();?>
</div>
<?php get_footer() ?>