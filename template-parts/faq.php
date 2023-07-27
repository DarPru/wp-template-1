<?php
if( have_rows('faq') ):
?>
<h2>
    <?php the_field('main_faq_title') ?>
</h2>
<?php
    while( have_rows('faq') ) : the_row(); ?>
    <details class="faq__question">
        <summary class="faq__toggle" aria-expanded="true" aria-controls="faq_answer_1">
            <?php the_sub_field('faq_title') ?><span>+</span>
        </summary>
        <div id="faq_answer_1" class="faq__answer">
            <p itemscope="text">
                <?php the_sub_field('faq_text') ?>
            </p>
        </div>
    </details>
<?php endwhile;
endif;?>