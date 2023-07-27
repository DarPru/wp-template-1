<?php get_header();?>
<div class="container">
<?php   yoast_breadcrumb( '<div id="breadcrumbs">', '</div>' ); ?>
<?php get_template_part('template-parts/review-about') ?>
<?php get_template_part('template-parts/review-info') ?>
<?php get_template_part('template-parts/review-char') ?>
<?php get_template_part('template-parts/review-review') ?>
<div class="content">
	<?php the_content() ?>	
</div>
<?php get_template_part('template-parts/review-benefits') ?>
<?php get_template_part('template-parts/testimonials') ?>
</div>

<?php get_footer() ?>