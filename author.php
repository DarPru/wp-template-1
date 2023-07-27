<?php get_header(); ?>
<div class="container">
    <?php   yoast_breadcrumb( '<div id="breadcrumbs">', '</div>' ); 

$vern = 0;
$oshib = 0;
$wrong = 0; 
$right = 0; 
$tochno = 0;

$a = get_the_author();
$likes = (get_the_author_meta( 'likes', $user_id ) == "") ? 0 : get_the_author_meta( 'likes', $user_id); 
if (get_the_author_meta( 'aright', $user_id ) != "" && get_the_author_meta( 'awrong', $user_id ) != "") {

   $vern = get_the_author_meta( 'aright', $user_id ) ;
  settype($vern, 'integer');
   $oshib = get_the_author_meta( 'awrong', $user_id ) ;
  settype($oshib, 'integer'); 
  if ($vern > $oshib) {$right = bigger($vern, $oshib); $tochno = round (100/(($vern+$oshib)/$vern), 1);} else {$wrong = bigger($oshib, $vern); $tochno = round (100/(($vern+$oshib)/$vern), 1);}
} 

function bigger ($a, $b) {
   return  100* $b/$a;
}
?>
    <div class="authormain_info">
        <div class="authormain_top">
            <div class="authormain_logobox">
                <div class="authormain_img">
                  <?php 
                  $image = get_field('author_logo', 'user_'. get_queried_object_id());
                  if( !empty( $image ) ): ?>
                      <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                  <?php endif; ?>
                </div>
                <div class="authormain_rating">
                    <div onClick="like(); this.onclick=null;" class="like"><i class="icon-thumbs-up"></i></div>
                    <div class="number">
                        <?php echo $likes; ?>
                    </div>
                    <div class="dislike" onClick="dislike(); this.onclick=null;"><i class="icon-thumbs-down"></i></div>
                </div>
            </div>
            <div class="authormain_contentbox">
                <div class="contentbox_head">
                    <div class="title">
                        <h1>
                            <?php echo get_the_author_firstname() . ' ' . get_the_author_lastname(); ?>
                        </h1>
                        <p class="subtitle">
                            <?php get_the_author_meta( 'subtitle', $user_id );  ?>
                        </p>
                    </div>
                    <div class="socials">
                        <?php if (get_the_author_meta('twitter') != ''): ?>
                        <a href="<?php echo get_the_author_meta('twitter'); ?>" target="_blank">
                            <div class="social"><i class="icon-twitter"></i></div>
                        </a>
                        <?php endif; ?>
                        <?php if (get_the_author_meta('facebook') != ''): ?>
                        <a href="<?php echo get_the_author_meta('facebook'); ?>" target="_blank">
                            <div class="social"><i class="icon-facebook"></i></div>
                        </a>
                        <?php endif; ?>
                        <?php if (get_the_author_meta('instagram') != ''): ?>
                        <a href="<?php echo get_the_author_meta('instagram'); ?>" target="_blank">
                            <div class="social"><i class="icon-instagram"></i></div>
                        </a>
                        <?php endif; ?>
                        <?php if (get_the_author_meta('url') != ''): ?>
                        <a href="<?php echo get_the_author_meta('url'); ?>" target="_blank">
                            <div class="social"><i class="icon-vkontakte"></i></div>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div id="author_subext" class="contentbox_body">
                    <?php the_author_meta( 'subtext', $user_id );  ?>
                </div>
                <button id="toc_arrow" onclick="indexShow()" class="author_more">More</button>
            </div>
        </div>
        <div class="authormain_bottom">
            <div class="right">
                <div class="text">Liked —
                    <?php echo  $vern ?>
                </div>
                <div class="line">
                    <div style="width:  <?php echo  $right ?>%;" class="color"></div>
                </div>
            </div>
            <div class="number">
                <div class="boild">
                    <?php echo $tochno ?>%</div>
                <div class="text">Rating</div>
            </div>
            <div class="wrong">
                <div class="text">Disliked —
                    <?php echo  $oshib ?>
                </div>
                <div class="line">
                    <div style="width: <?php echo $wrong ?>%;" class="color"></div>
                </div>
            </div>
        </div>
    </div>

    <?php get_template_part('template-parts/testimonials') ?>
    <?php
        global $query_string; 
        $authid = get_the_author_ID();
        query_posts( $query_string .'&author=$authid&posts_per_page=10' ); 
       if ( have_posts() ) ?>
    <h2>Author posts</h2>
    <?php while ( have_posts() ) : the_post(); ?>
    <div class="author_post">
        <h3 class="author_news"><a href="<?php the_permalink()?>">
                <?php the_title(); ?>
        </h3></a>
        <div class="author_news_sub">
            <?php the_post_thumbnail() ?>
            <span>
                <?php  echo pretty_url(get_home_url())   ?></span>
        </div>
    </div>
    <?php endwhile; 
    wp_reset_query(); ?>

</div>
<?php get_footer(); ?>
<script>
let number = document.querySelector(".number");

function like() {
    number.textContent = parseInt(number.textContent) + 1;
}

function dislike() {
    number.textContent = parseInt(number.textContent) - 1;
}

// index collapse
var indexMenu = document.getElementById("author_subext");
var toc_arrow = document.getElementById("toc_arrow");
var test = indexMenu.getBoundingClientRect().height;
if (test < 140) {
    toc_arrow.classList.add('none');
}

function indexShow() {

    indexMenu.classList.toggle('open');
    toc_arrow.textContent = 'Hide';
    if (indexMenu.hasClass('open')) {
        toc_arrow.textContent = 'more';
    }
}
</script>