<div class="pagenews_list shortcode">
    <?php $the_query = new WP_Query( array(
  'posts_per_page' => 8,
  'post_type' => 'post' 
) );

// loop
while( $the_query->have_posts() ){
  $the_query->the_post();
  ?>
    <div class="pagenews_list_item main">
        <!-- content -->
        <a href="<?php the_permalink() ?>">
            <?php the_post_thumbnail() ?>
            <h4>
                <?php the_title(); ?>
            </h4>
        </a>
        <!-- /content -->
    </div>
    <?php
}?>
</div>