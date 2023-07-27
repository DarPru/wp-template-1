<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <title><?php wp_title(); ?> — <?php bloginfo('name'); ?></title>
  <meta name="keywords" content="<?php the_field('keywords') ?>" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="alternate" type="application/rss+xml" title="RSS" href="<?php bloginfo('rss_url'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/style.css">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
   <header>
    <div class="row">
      <div class="container">
        <div class="burger" id="burger">
          <span></span>
          <span></span>
          <span></span>
        </div>
		<div class="header__logo">
      		<?php the_custom_logo('custom-logo') ?>
		</div>
      <?php
        $args = array('theme_location' => 'header', 'container'=> 'ul', 'menu_class' => 'header-menu', 'menu_id' => 'header-menu');
        wp_nav_menu($args);
      ?>
      <div class="buttons">
      <button onClick="window.open('<?php echo get_option('theme_btn_link'); ?>');">LOGIN</button> 
		  <?php do_action('wpml_add_language_selector'); ?>
        <div id="header_search" class="header_search"><img src="<?php echo get_template_directory_uri(); ?>/img/magnifying-glass.png" alt=""></div>
        <?php include (TEMPLATEPATH . '/searchform.php'); ?>
        </div>
      </div>
    <div class="row submenu">
      <div class="container">
      <?php
        $args = array('theme_location' => 'header_bottom', 'container'=> 'ul', 'menu_class' => 'header-submenu', 'menu_id' => 'header-menu');
        wp_nav_menu($args);
      ?>
      </div>
    </div>
  </header> 
<script>
  var burger = document.getElementById("burger"),
  menu = document.getElementById("header-menu"),
  search = document.getElementById("header_search"),
  searchform = document.getElementById("searchform");
   

burger.addEventListener("click", (function() {
  burger.classList.toggle("toggle");
  menu.classList.toggle("toggle");
}));
search.addEventListener("click", (function() {
  searchform.classList.toggle("show");
}));

</script>