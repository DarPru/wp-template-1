<div class="book_benefits">
    <div class="book_benefits_item">
        <h2>Pros</h2>
        <?php 
		if( have_rows('review_pros') ): ?>
		        <?php while( have_rows('review_pros') ) : the_row(); ?>
		        <div class="list"><i class="icon-thumbs-up"></i>
		            <?php the_sub_field('review_pros_text')?>
		        </div>
		        <?php  endwhile; ?>
		        <?php
		endif;?>
    </div>
    <div class="book_benefits_item">
        <h2>Cons</h2>
        <?php
		if( have_rows('review_cons') ): ?>
        <?php while( have_rows('review_cons') ) : the_row(); ?>
        <div class="list"><i class="icon-thumbs-down"></i>
            <?php the_sub_field('review_cons_text')?>
        </div>
        <?php  endwhile; ?>
        <?php
		endif;?>
    </div>
</div>