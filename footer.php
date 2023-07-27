<footer>
	<div class="container">
		<div class="row footer first">
  <div class="wrapper">
    <a href="/"><?php the_custom_logo('custom-logo') ?></a>
     
          <?php
          $args = array('theme_location' => 'footer', 'container'=> 'ul', 'menu_class' => 'footer-menu', 'menu_id' => 'footer-menu');
          wp_nav_menu($args);
        ?>
  </div>
    <div class="socials">
    	<a target="_blank" href="<?php echo get_option('twitter'); ?>"><div class="social"><i class="icon-twitter"></i></div></a>
    	<a target="_blank" href="<?php echo get_option('facebook'); ?>"><div class="social"><i class="icon-facebook"></i></div></a>
    	<a target="_blank" href="<?php echo get_option('instagram'); ?>"><div class="social"><i class="icon-instagram"></i></div></a>
    	<a target="_blank" href="<?php echo get_option('vkontakte'); ?>"><div class="social"><i class="icon-vkontakte"></i></div></a>
    	<a target="_blank" href="<?php echo get_option('telega'); ?>"><div class="social"><i class="icon-paper-plane"></i></div></a>
    </div>
    </div>
    <?php
          $args = array('theme_location' => 'footer', 'container'=> 'ul', 'menu_class' => 'footer-menu-mobile', 'menu_id' => 'footer-menu');
          wp_nav_menu($args);
        ?>
    <div class="row">
    	<div class="copyright"><?php echo get_option('copyright'); ?></div>
    </div>
    </div>
</footer>
<?php wp_footer();?>