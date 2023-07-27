<?php get_header() ?>
<div class="container">
    <div class="container_inner">
        <div class="main">
            <?php
	if ( function_exists('yoast_breadcrumb') ) {
	  yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
	}
?>
            <h1>
                <?php the_title() ?>
            </h1>
            <?php get_template_part('template-parts/author') ?>
            <div class="singlemain_img">
                <?php the_post_thumbnail() ?>
            </div>
            <?php the_content() ?>
            <h2>Other posts</h2>
            <?php 
			 $query = new WP_Query( [
				'posts_per_page' => 6,
				'orderby'        => 'rand'
			] );

global $post;

if ( $query->have_posts() ) {
	?>
            <div class="newssingle_more">
                <?php
	while ( $query->have_posts() ) {
		$query->the_post();?>
                <a href="<?php the_permalink() ?>">
                    <article class="newssingle_moreitem">
                        <?php the_post_thumbnail() ?>
                        <h4>
                            <?php the_title() ?>
                        </h4>
                    </article>
                </a>
                <?php
	} ?>
            </div>
            <?php
} 
wp_reset_postdata();?>
        </div>
        <div class="sidebar">
            <?php get_sidebar('review') ?>
        </div>
    </div>
</div>
<?php get_footer() ?>