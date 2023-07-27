<?php get_header() ?>
<div class="container">
<?php
if ( function_exists( 'yoast_breadcrumb' ) ) :
   yoast_breadcrumb( '<div id="breadcrumbs">', '</div>' );
endif;
?> 
 <h1><?php the_title(); ?></h1>
<div class="content">
  <?php the_content() ?>
</div>
</div>

<?php get_footer() ?>