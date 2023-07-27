<?php 
get_header();?>
<div class="container reviews_single">
    <?php   yoast_breadcrumb( '<div id="breadcrumbs">', '</div>' ); ?>
    <h1>
        <?php the_title() ?>
    </h1>
    <?php get_template_part('template-parts/author') ?>
    <div class="excerpt">
        <?php the_excerpt() ?>
    </div>
    <?php get_template_part('template-parts/compare-info') ?>
    <?php the_content() ?>
    <?php
if( have_rows('comp_stats') ): ?>
    <h2>Companies statisic
        <?php the_field('item_1') ?><span style="display: inline-block;">&nbsp;—&nbsp;</span>
        <?php the_field('item_2') ?>
    </h2>
    <table cellspacing class="comp_stats">
        <tr class="title">
            <td width="50%" style="text-align: left;">Company</td>
            <td width="12.5%">Best price</td>
            <td width="12.5%">Best rating</td>
            <td width="12.5%">Quality</td>
            <td width="12.5%">Sale</td>
        </tr>
        <?php while( have_rows('comp_stats') ) : the_row(); ?>
        <tr>
            <td width="50%">
                <div class="info"><img style="object-fit: cover;" src="<?php the_sub_field('comp_stats_logo')?>" alt="">
                    <div class="name">
                        <?php the_sub_field('comp_stats_name')?>
                    </div>
                </div>
            </td>
            <td width="12.5%"><i class="icon-<?php the_sub_field('up_down1')?>"></i>
                <?php the_sub_field('comp_stats_best_price')?>
            </td>
            <td width="12.5%"><i class="icon-<?php the_sub_field('up_down2')?>"></i>
                <?php the_sub_field('comp_stats_best_rating')?>
            </td>
            <td width="12.5%"><i class="icon-<?php the_sub_field('up_down_draw')?>"></i>
                <?php the_sub_field('comp_stats_quality')?>
            </td>
            <td class="review" width="12.5%">
                <?php the_sub_field('comp_stats_sale')?>
            </td>
        </tr>
        <?php  endwhile; ?>
    </table>
    <?php
endif;?>
    <h2>Resent posts</h2>
    <?php get_template_part('template-parts/news') ?>
</div>
<?php get_footer() ?>