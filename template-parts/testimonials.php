<h2>More items</h2>
<div class="review_trust">
<?php $the_query = new WP_Query( array(
  'posts_per_page' => 4,
  'post_type' => 'reviews',
  'orderby' => 'rand' 
) );
while( $the_query->have_posts() ){
  $the_query->the_post();
  ?>
  <!-- ********** -->
  <div class="review_trust_item">
  	<div class="rating"><i class="icon-star"></i><?php the_field('review_rating')?></div>
  	<a href="<?php the_permalink() ?>"><?php $image = get_field( 'review_image' );
               	if ( ! empty( $image ) ): ?>
			   	<img class="review__logo" width="135" max-height="45" src="<?php echo esc_url($image['url']); ?>" srcset="<?php echo esc_url($image['sizes']['thumbnail']); ?> 300w,   <?php echo esc_url($image['sizes']['medium']); ?> 768w " sizes="(max-width: 1110px) 100vw, 1110px" alt="<?php echo esc_attr($image['alt']); ?>" title="<?php echo esc_attr($image['title']); ?>" />   
              <?php endif; ?></a>
  	 <div class="title"><?php the_field('review_name') ?></div>
  	<div class="review">
  		<div class="review_text">Discount: <span><?php the_field('review_discount') ?></span></div>
  		<button class="blue" onClick="window.open('<?php  the_field('review_btnlink');?>');">Visit site</button>
  	</div>
  </div>
  <!-- ********** -->
   <?php
}?>
</div><?php
wp_reset_postdata();
