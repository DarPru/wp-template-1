<div class="author_box">	
		<div class="author_main">
			<div class="author_img">  <?php 
                  $image = get_field('author_logo', 'user_'.  get_the_author_ID());
                  if( !empty( $image ) ): ?>
                      <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                  <?php endif; ?></div>
			<div class="author_name"><?php the_author_posts_link(); ?></div>
			<div class="author_job"><?php the_author_meta('description') ?></div>
		</div>
		<div class="author_meta">
			<div class="author_date"><?php the_date(); ?></div>
			<div class="author_comments"><i class="icon-commenting-o"></i><?php comments_number( '0', '1', '%'); ?></div>
		</div>
</div>