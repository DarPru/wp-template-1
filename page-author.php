<?php get_header(); ?>
 <div class="container">
 	<?php
if ( function_exists( 'yoast_breadcrumb' ) ) :
   yoast_breadcrumb( '<div id="breadcrumbs">', '</div>' );
endif;
?> 
  <h1><?php the_title(); ?></h1>
	
<ul id="authorlist"><?php contributors(); ?></ul>
<div class="content">
	<?php the_content() ?>
</div>
<?php get_template_part('template-parts/testimonials') ?>
  </div>
<?php get_footer(); ?>
