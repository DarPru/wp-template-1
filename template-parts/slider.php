<div class="itcss">
    <div class="itcss__wrapper">
        <div class="itcss__items">
            <?php
    global $query_string; 
    
     query_posts( array(  'posts_per_page' => 4, 'post_type' => 'compares', 'orderby' => 'rand') );
   if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
            <div class="itcss__item">
                <div class="comparelideritem_inner">
                    <div class="left">
                        <div class="top">
                            <div class="center">
                                <?php $image = get_field( 'item_logo_1' );
               	                if ( ! empty( $image ) ): ?>
                                <img data-position="first" width="100" height="100" class="team-1" src="<?php echo esc_url($image['url']); ?>" srcset="<?php echo esc_url($image['sizes']['thumbnail']); ?> 300w,   <?php echo esc_url($image['sizes']['large']); ?> 1024w,   <?php echo esc_url($image['sizes']['medium']); ?> 768w " sizes="(max-width: 100px) 100vw, 100px" alt="<?php echo esc_attr($image['alt']); ?>" title="<?php echo esc_attr($image['title']); ?>" />
                                <?php endif; ?>
                                <div data-position="first-txt" class="team team-1-txt">
                                    <?php the_field('item_1') ?>
                                </div>
                            </div>
                            <div class="timedate center">
                                <div class="time">
                                    <?php the_field('comp_cat') ?>
                                </div>
                                <div class="date">
                                    category
                                </div>
                            </div>
                            <div class=" center">
                                <?php $image = get_field( 'item_logo_2' );
               	            if ( ! empty( $image ) ): ?>
                                <img data-position="second" width="100" height="100" class="team-2" src="<?php echo esc_url($image['url']); ?>" srcset="<?php echo esc_url($image['sizes']['thumbnail']); ?> 300w,   <?php echo esc_url($image['sizes']['large']); ?> 1024w,   <?php echo esc_url($image['sizes']['medium']); ?> 768w " sizes="(max-width: 100px) 100vw, 100px" alt="<?php echo esc_attr($image['alt']); ?>" title="<?php echo esc_attr($image['title']); ?>" />
                                <?php endif; ?>
                                <div data-position="second-txt" class="team team-2-txt">
                                    <?php the_field('item_2') ?>
                                </div>
                            </div>
                        </div>
                        <div class="bottom">
                            <a href="<?php the_permalink() ?>">
                                <span>Find out more</span> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 24 24" fill="none">
                                <path d="M11 16L15 12M15 12L11 8M15 12H3M4.51555 17C6.13007 19.412 8.87958 21 12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C8.87958 3 6.13007 4.58803 4.51555 7" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="right">
                        <h4>Info</h4>
                        <div class="compare">
                            <div class="compare_item for_price">
                                <div class="team">Best price</div>
                                <div class="compare_inner">
                                    <img width="70" max-height="20" src="<?php the_field('best_plice_logo') ?>" alt="Best price" title="Best price" sizes="(max-width: 70px) 100vw, 70px">
                                    <div class="koff">
                                        <?php the_field('best_plice') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="compare_item for_draw">
                                <div class="team">Best rating</div>
                                <div class="compare_inner">
                                    <img width="70" max-height="20" src="<?php the_field('best_rating_logo') ?>" alt="Best rating" title="Best rating" sizes="(max-width: 70px) 100vw, 70px">
                                    <div class="koff">
                                        <?php the_field('best_rating') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="compare_item for_price">
                                <div class="team">Quality</div>
                                <div class="compare_inner">
                                    <img width="70" max-height="20" src="<?php the_field('quality_logo') ?>" alt="Quality" title="Quality" sizes="(max-width: 70px) 100vw, 70px">
                                    <div class="koff">
                                        <?php the_field('quality') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; 
            wp_reset_query();  ?>
        </div>
    </div>
    <a class="itcss__control itcss__control_prev" href="#" role="button" data-slide="prev"></a>
    <a class="itcss__control itcss__control_next" href="#" role="button" data-slide="next"></a>
</div>