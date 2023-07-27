<div class="comp_event">
    <div class="title">
        <div class="team1">
            <?php the_field('item_1') ?>
        </div> <span>&nbsp;—&nbsp;</span>
        <div class="team2">
            <?php the_field('item_2') ?>
        </div>
    </div>
    <div class="info">
        <div class="logo"><?php $image = get_field( 'item_logo_1' );
               	if ( ! empty( $image ) ): ?>
			   	<img src="<?php echo esc_url($image['url']); ?>" srcset="<?php echo esc_url($image['sizes']['thumbnail']); ?> 300w,   <?php echo esc_url($image['sizes']['medium']); ?> 768w " sizes="(max-width: 1110px) 100vw, 1110px" alt="<?php echo esc_attr($image['alt']); ?>" title="<?php echo esc_attr($image['title']); ?>" />   
              <?php endif; ?></div>
        <div class="timedate">
            <div class="time">
                <?php the_field('comp_cat') ?>
            </div>
            <div class="date">
                category
            </div>
        </div>
        <div class="logo"><?php $image = get_field( 'item_logo_2' );
               	if ( ! empty( $image ) ): ?>
			   	<img src="<?php echo esc_url($image['url']); ?>" srcset="<?php echo esc_url($image['sizes']['thumbnail']); ?> 300w,   <?php echo esc_url($image['sizes']['medium']); ?> 768w " sizes="(max-width: 1110px) 100vw, 1110px" alt="<?php echo esc_attr($image['alt']); ?>" title="<?php echo esc_attr($image['title']); ?>" />   
              <?php endif; ?></div>
    </div>
    <div class="compare">
        <div onClick="window.open('<?php echo get_option('theme_btn_link'); ?>');"  class="compare_item for_price">
            <div class="team">
                Best price
            </div>
            <div class="compare_inner">
                <img src="<?php the_field('best_plice_logo') ?>" alt="">
                <div class="koff">
                    <?php the_field('best_plice') ?>
                </div>
            </div>
        </div>
        <div onClick="window.open('<?php echo get_option('theme_btn_link'); ?>');"  class="compare_item for_draw">
            <div class="team">Best rating</div>
            <div class="compare_inner">
                <img src="<?php the_field('best_rating_logo') ?>" alt="">
                <div class="koff">
                    <?php the_field('best_rating') ?>
                </div>
            </div>
        </div>
        <div onClick="window.open('<?php echo get_option('theme_btn_link'); ?>');"  class="compare_item for_price">
            <div class="team">
                Quality
            </div>
            <div class="compare_inner">
                <img src="<?php the_field('quality_logo') ?>" alt="">
                <div class="koff">
                    <?php the_field('quality') ?>
                </div>
            </div>
        </div>
    </div>
</div>