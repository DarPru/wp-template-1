<div class="review_info">
	<h2>Information about <?php the_field('review_name')?></h2>
	<div class="bookinfo_inner">
		<div class="row">
			<div class="col label">Name:</div>
			<div class="col"><?php the_field('review_fullname')?></div>
		</div>
		<div class="row">
			<div class="col label">Year:</div>
			<div class="col"><?php the_field('review_foundyear')?></div>
		</div>
		<div class="row">
			<div class="col label">License:</div>
			<div class="col"><?php the_field('review_license')?></div>
		</div>
		<div class="row">
			<div class="col label">Website:</div>
			<div class="col"><a target="_blank" rel="nofollow" href="<?php the_field('review_siteurl')?>"><?php the_field('review_sitetext')?></a></div>
		</div>
	</div>
</div>