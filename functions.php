<?php

// menu registration

register_nav_menus( array(
  'header' => 'Header menu',
  'header_bottom' => 'Header submenu',
  'footer' => 'Footer menu'
) );

add_theme_support('post-thumbnails');
set_post_thumbnail_size(500, 300);

// Sidebar
register_sidebar(array(
  'name' => 'left sidebar',
  'id' => "left-sidebar",
  'description' => 'Yep, this is a left sidebar',
  'before_widget' => '<div id="%1$s" class="widget-left %2$s">',
  'after_widget' => "</div>\n",
  'before_title' => '<span class="widget-title">',
  'after_title' => "</span>\n",
));

// Pagination
function showpagination() {
  global $wp_query;
  $big = 999999999;
  echo paginate_links(array(
    'base' => str_replace($big,'%#%',esc_url(get_pagenum_link($big))),
    'format' => '?paged=%#%',
    'current' => max(1, get_query_var('paged')),
    'type' => 'list',
    'prev_text'    => 'Back',
    'next_text'    => 'Next',
    'total' => $wp_query->max_num_pages,
    'show_all'     => false,
    'end_size'     => 5,
    'mid_size'     => 5,
    'add_args'     => false,
    'add_fragment' => '',
    'before_page_number' => '',
    'after_page_number' => ''
  ));
}

// logo settings 

add_theme_support( 'custom-logo', [
  'height'      => 90,
  'width'       => 200,
  'flex-width'  => true,
  'flex-height' => false,
  'header-text' => '',
  'unlink-homepage-logo' => false, // WP 5.5
] );

// Custom global site srttings

function mytheme_customize_register( $wp_customize ) {

$wp_customize->add_section(
    // ID
    'data_site_section',
    array(
        'title' => 'Site settings',
        'capability' => 'edit_theme_options',
        'description' => "Here you can setup your site"
    )
);


// login header btn 
$wp_customize->add_setting(
    'theme_btn_link',
    array(
        'default' => '',
        'type' => 'option'
    )
);
$wp_customize->add_control(
    'theme_btn_link',
    array(
        'type' => 'text',
        'label' => "Login link",
        'section' => 'data_site_section',
        'settings' => 'theme_btn_link'
    )
);
// footer copyright text
$wp_customize->add_setting(
    'copyright',
    array(
        'default' => '',
        'type' => 'option'
    )
);
$wp_customize->add_control(
    'copyright',
    array(
        'type' => 'text',
        'label' => "Copyright",
        'section' => 'data_site_section',
        'settings' => 'copyright'
    )
);
// footer logo
$wp_customize->add_setting(

    'footer_logo',
    array(
        'default' => '',
        'type' => 'option'
    )
);
$wp_customize->add_control(
 
        new WP_Customize_Image_Control(
        $wp_customize,
        'footer_logo',
        array(
            'label' => 'Footer logo',
            'section' => 'data_site_section',
            'settings' => 'footer_logo'
        )
    )
);

// footer sotials
$wp_customize->add_setting(
    'twitter',
    array(
        'default' => '',
        'type' => 'option'
    )
);
$wp_customize->add_control(
    'twitter',
    array(
        'type' => 'text',
        'label' => "twitter",
        'section' => 'data_site_section',
        'settings' => 'twitter'
    )
);
$wp_customize->add_setting(
    'facebook',
    array(
        'default' => '',
        'type' => 'option'
    )
);
$wp_customize->add_control(
    'facebook',
    array(
        'type' => 'text',
        'label' => "Facebook",
        'section' => 'data_site_section',
        'settings' => 'facebook'
    )
);
$wp_customize->add_setting(
    'instagram',
    array(
        'default' => '',
        'type' => 'option'
    )
);
$wp_customize->add_control(
    // ID
    'instagram',
    array(
        'type' => 'text',
        'label' => "Instagram",
        'section' => 'data_site_section',
        'settings' => 'instagram'
    )
);
$wp_customize->add_setting(
    'vkontakte',
    array(
        'default' => '',
        'type' => 'option'
    )
);
$wp_customize->add_control(
    'vkontakte',
    array(
        'type' => 'text',
        'label' => "VK",
        'section' => 'data_site_section',
        'settings' => 'vkontakte'
    )
);
$wp_customize->add_setting(
    'telega',
    array(
        'default' => '',
        'type' => 'option'
    )
);
$wp_customize->add_control(
    'telega',
    array(
        'type' => 'text',
        'label' => "Telegram",
        'section' => 'data_site_section',
        'settings' => 'telega'
    )
);
// Banner 
$wp_customize->add_setting(
    'theme_banner_img',
    array(
        'default' => '',
        'type' => 'option'
    )
);
$wp_customize->add_control(
 
        new WP_Customize_Image_Control(
        $wp_customize,
        'theme_banner_img',
        array(
            'label' => 'Banner image',
            'section' => 'data_site_section',
            'settings' => 'theme_banner_img'
        )
    )
);
// Banner image link
$wp_customize->add_setting(
    'theme_banner_link',
    array(
        'default' => '',
        'type' => 'option'
    )
);
$wp_customize->add_control(
    'theme_banner_link',
    array(
        'type' => 'text',
        'label' => "Banner image link",
        'section' => 'data_site_section',
        'settings' => 'theme_banner_link'
    )
    
);

} // and of customizing settings

add_action( 'customize_register', 'mytheme_customize_register' );
add_filter('show_admin_bar', '__return_false'); // disallow wp top menu
remove_action('wp_head','feed_links_extra', 3); // disallow rss feed
remove_action('wp_head','feed_links', 2); 
remove_action('wp_head','rsd_link');  
remove_action('wp_head','wlwmanifest_link'); // Windows Live Writer
remove_action('wp_head','wp_generator');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles'); // removing wp emojis

// taxonomy registration

add_action( 'init', 'create_taxonomy' );
function create_taxonomy(){
 // reviews tax
  register_taxonomy( 'keys', [ 'reviews' ], [
    'label'                 => '', 
    'labels'                => [
      'name'              => 'Reviews tags',
      'singular_name'     => 'Reviews tags',
      'search_items'      => 'Find section',
      'all_items'         => 'All sections',
      'view_item '        => 'Show section',
      'edit_item'         => 'Add section',
      'update_item'       => 'Update section',
      'add_new_item'      => 'Add new section',
      'new_item_name'     => 'New section name',
      'menu_name'         => 'Reviews tags',
    ],
    'description'           => '', // Reviews tags description
    'public'                => true,
    'hierarchical'          => false,
    'rewrite'               => true,
    'capabilities'          => array(),
    'meta_box_cb'           => 'post_categories_meta_box', 
    'show_admin_column'     => false, 
    'show_in_rest'          => null, 
    'rest_base'             => null, 
  ] );
// sales tax
  register_taxonomy( 'sales_tax', [ 'sales' ], [
    'label'                 => '', 
    'labels'                => [
      'name'              => 'Type of sales',
      'singular_name'     => 'Type of sales',
      'search_items'      => 'Search sales type',
      'all_items'         => 'All sales types',
      'view_item '        => 'View sales type',
      'edit_item'         => 'Add sales type',
      'update_item'       => 'Edit sales type',
      'add_new_item'      => 'Add new sales type',
      'new_item_name'     => 'Name sales type',
      'menu_name'         => 'Type of sales',
    ],
    'description'           => '', 
    'public'                => true,
    'hierarchical'          => false,
    'rewrite'               => true,
    'capabilities'          => array(),
    'meta_box_cb'           => 'post_categories_meta_box', 
    'show_admin_column'     => false, 
    'show_in_rest'          => null, 
    'rest_base'             => null, 
  ] );
}

// register new types of content

add_action( 'init', 'register_post_types' );
function register_post_types(){
    // compares
    register_post_type( 'compares', [
        'label'  => null,
        'labels' => [
            'name'               => 'Compares', // main name of the post type group
            'singular_name'      => 'Compare', // name of the single post type
            'add_new'            => 'Add Compare', 
            'add_new_item'       => 'Add Compare', // in admin panel
            'edit_item'          => 'Edit Compare', 
            'new_item'           => 'New Compare', 
            'view_item'          => 'Check Compare', 
            'search_items'       => 'Search for Compares', 
            'not_found'          => 'Compares didn\'t find', 
            'parent_item_colon'  => '', 
            'menu_name'          => 'Compares', 
        ],
        'description'         => '',
        'public'              => true,
         'publicly_queryable'  => true, 
         'exclude_from_search' => true, 
         'show_ui'             => true, 
         'show_in_nav_menus'   => true, 
        'show_in_menu'        => true, 
         'show_in_admin_bar'   => true, 
        'show_in_rest'        => null, 
        'rest_base'           => null,
        'menu_position'       => null,
        'menu_icon'           => 'dashicons-chart-line', // icon for displaying in admin panel
        'hierarchical'        => false,
        'supports'            => ['custom-fields', 'title', 'editor','author', 'excerpt'], // fields in edditor
        'taxonomies'          => ['keys'],
        'has_archive'         => false,
        'rewrite'             => true,
        'query_var'           => true,
    ] );
    // reviews
    register_post_type( 'reviews', [
        'label'  => null,
        'labels' => [
            'name'               => 'Reviews', // main name of the post type group
            'singular_name'      => 'Review', // name of the single post type
            'add_new'            => 'Add review', 
            'add_new_item'       => 'Add review', // in admin panel
            'edit_item'          => 'Edit review', 
            'new_item'           => 'New review', 
            'view_item'          => 'Check review', 
            'search_items'       => 'Search for review', 
            'not_found'          => 'Review didn\'t find', 
            'parent_item_colon'  => '', 
            'menu_name'          => 'Reviews', 
        ],
        'description'         => '',
        'public'              => true,
         'publicly_queryable'  => true, 
         'exclude_from_search' => true, 
         'show_ui'             => true, 
         'show_in_nav_menus'   => true, 
        'show_in_menu'        => true, 
         'show_in_admin_bar'   => true, 
        'show_in_rest'        => null, 
        'rest_base'           => null, 
        'menu_position'       => null,
        'menu_icon'           => 'dashicons-admin-page',
        'hierarchical'        => false,
        'supports'            => ['custom-fields', 'title', 'editor'], 
        'has_archive'         => false,
        'rewrite'             => true,
        'query_var'           => true,
    ] ); 
// Sales
    register_post_type( 'sales', [
        'label'  => null,
        'labels' => [
            'name'               => 'Sales', 
            'singular_name'      => 'Sale card', 
            'add_new'            => 'Add sale card', 
            'add_new_item'       => 'Adding sale card', 
            'edit_item'          => 'Edit sale card', 
            'new_item'           => 'New sale card', 
            'view_item'          => 'View sale card', 
            'search_items'       => 'Search sale card',
            'not_found'          => 'Not found', 
            'parent_item_colon'  => '', 
            'menu_name'          => 'Sales', 
        ],
        'description'         => '',
        'public'              => true,
         'publicly_queryable'  => true, 
         'exclude_from_search' => true, 
         'show_ui'             => true, 
         'show_in_nav_menus'   => true, 
        'show_in_menu'        => true, 
         'show_in_admin_bar'   => true, 
        'show_in_rest'        => null, 
        'rest_base'           => null, 
        'menu_position'       => null,
        'menu_icon'           => 'dashicons-money-alt',
        'hierarchical'        => false,
        'supports'            => ['custom-fields', 'post-formats', 'title', 'editor', 'thumbnail', 'excerpt'], 
        'taxonomies'          => ['sales_tax'],
        'has_archive'         => false,
        'rewrite'             => true,
        'query_var'           => true,
    ] );
}


/* Shortcodes*/
 

add_shortcode( 'mybtn', 'btn_shortcode' );

function btn_shortcode( $atts ){
  $atts = shortcode_atts( [
    'text' => '',
    'link' => '',
    
  ], $atts );
   return  '<button onClick="window.open(&apos;'. $atts['link'] .'&apos;);" class="btn">' . $atts['text'] . '</button>';
}

add_shortcode( 'bigquote', 'big_quote' );

function big_quote( $atts ){
  $atts = shortcode_atts( [
    'q_text' => '',
    'q_img' => '',
    'q_name' => '',
    'q_job' => '',
    
  ], $atts );
   return '<div class="mega_quote">
  <div class="text"><i>' . $atts['q_text'] . '</i></div>
  <div class="sub">
    <img src="' . $atts['q_img'] . '" alt="">
    <div class="name"><b>' . $atts['q_name'] . '</b>&nbsp;—&nbsp;' . $atts['q_job'] . '</div>
  </div>
</div>';
}

add_shortcode( 'faq', 'faq_accordion' );

function faq_accordion() {
    ob_start();
    get_template_part('template-parts/faq');
    return ob_get_clean();   
} 



function contributors() {
$args = array(
'role__in'     => array('author', 'editor' ),
//'EXCLUDE'    => ARRAY( 1, 2, 3, ),
//'INCLUDE'      => ARRAY( 4, 5, 6 ),
'orderby'      => 'display_name',
'order'        => 'ASC',
);   
$authors = get_users( $args );
foreach($authors as $author) {?>
<li><div class="authorava"><?php
$author_badge = get_field('author_logo', 'user_'. $author->ID );
?>
<img src="<?php echo $author_badge['url']; ?>" /><br><div class="authorname"><?php the_author_meta('display_name', $author->ID);?></div></div>
<div class="textauthor">
 <span><?php the_author_meta('description', $author->ID);?></span><br>
<a href="<?php get_bloginfo('url')?>/author/<?php echo $author->user_login;?>">More about author</a>
</div>
</li>
<?php }
}

add_action( 'show_user_profile', 'true_show_profile_fields' );
add_action( 'edit_user_profile', 'true_show_profile_fields' );
 
function true_show_profile_fields( $user ) {
 
    echo '<h3>Additional info</h3>';
    echo '<table class="form-table">';
	
    $user_subtitle = get_the_author_meta( 'subtitle', $user->ID );
    echo '<tr><th><label for="subtitle">Subtitle</label></th>
    <td><input type="text" name="subtitle" id="subtitle" value="' . esc_attr( $user_subtitle ) . '" class="regular-text" /></td>
    </tr>';
    $user_subtext = get_the_author_meta( 'subtext', $user->ID );
    echo '<tr><th><label for="subtext">Description</label></th>
    <td><textarea rows="5" cols="30" name="subtext" id="subtext" class="regular-text" />' . esc_attr( $user_subtext ) . '</textarea> </td>
    </tr>';
    $user_likes = get_the_author_meta( 'likes', $user->ID );
    echo '<tr><th><label for="likes">Author rating</label></th>
    <td><input type="number" name="likes" id="likes" value="' . esc_attr( $user_likes ) . '" class="regular-text" /></td>
    </tr>';
    $user_aright = get_the_author_meta( 'aright', $user->ID );
    echo '<tr><th><label for="aright">likes</label></th>
    <td><input type="number" name="aright" id="aright" value="' . esc_attr( $user_aright ) . '" class="regular-text" /></td>
    </tr>';
    $user_awrong = get_the_author_meta( 'awrong', $user->ID );
    echo '<tr><th><label for="awrong">dislikes</label></th>
    <td><input type="number" name="awrong" id="awrong" value="' . esc_attr( $user_awrong ) . '" class="regular-text" /></td>
    </tr>';
 
   
 
}

add_action( 'personal_options_update', 'true_save_profile_fields' );
add_action( 'edit_user_profile_update', 'true_save_profile_fields' );
 
function true_save_profile_fields( $user_id ) {
    update_user_meta( $user_id, 'subtitle', sanitize_text_field( $_POST[ 'subtitle' ] ) );
    update_user_meta( $user_id, 'subtext', sanitize_text_field( $_POST[ 'subtext' ] ) );
    update_user_meta( $user_id, 'likes', sanitize_text_field( $_POST[ 'likes' ] ) );
    update_user_meta( $user_id, 'aright', sanitize_text_field( $_POST[ 'aright' ] ) );
    update_user_meta( $user_id, 'awrong', sanitize_text_field( $_POST[ 'awrong' ] ) );
}
function pretty_url($full_url) {
    $index = 2;
    $len = strlen($full_url);
    for ($i = 0; $i < $len; $i++) {
   
      if ($full_url[$i] == '/') {
         $index += $i;
        break;
    }
}

    return substr($full_url, $index);
}

 function taxonomySort($tag) { 
                      
            
           $the_query = new WP_Query( array(
          'posts_per_page' => 5,
          'post_type' => 'reviews',
           'keys' =>  $tag 
            ) );

             while( $the_query->have_posts() ){
              $the_query->the_post();
             
            echo '<div class="mz_grid_item col">';
            echo '<span class="time">' . get_field('time') . '</span>';
            echo '<span class="date">' . get_field('date') . '</span>';
            echo '</div>';

            echo '<div class="mz_grid_item team right">';
            echo '<a href="' . get_permalink() . '">' . get_field('team_1') . '</a>';
            echo '</div>';
            echo '<div class="mz_grid_item nums"><span class="nums">' .  get_field('nums1') . ' : ' . get_field('nums2') . '</span>';
            echo '</div>';
            echo '<div class="mz_grid_item team left"><a href="' . get_permalink() . '">' .
                    get_field('team_2') . '</a></div>';
            echo '<div class="mz_grid_item koff">';
            echo '<div class="mz_koff">';
            echo '<div class="mz_koff_item"><a href="' . get_permalink() . '">' . get_field('koff_1') . '</a></div>';
            echo '<div class="mz_koff_item"><a href="' . get_permalink() . '">' . get_field('koff_draw') . '</a></div>';
            echo '<div class="mz_koff_item"><a href="' . get_permalink() . '">' . get_field('koff_2') . '</a></div>';
            echo '</div></div>';
            }
                wp_reset_postdata();
           
            }

            add_filter('comment_form_fields', 'kama_reorder_comment_fields' );
            function kama_reorder_comment_fields( $fields ){
               

                $new_fields = array();

                $myorder = array('author','email','comment'); 

                foreach( $myorder as $key ){
                    $new_fields[ $key ] = $fields[ $key ];
                    unset( $fields[ $key ] );
                }

                
                if( $fields )
                    foreach( $fields as $key => $val )
                        $new_fields[ $key ] = $val;

                return $new_fields;
            }
wp_enqueue_script('newscript', get_template_directory_uri() . '/js/image-uploader.js');

add_action( 'wp_enqueue_scripts', 'remove_block_css', 100 );
function remove_block_css() {
wp_dequeue_style( 'wp-block-library' ); // Wordpress core
wp_dequeue_style( 'wp-block-library-theme' ); // Wordpress core
wp_dequeue_style( 'wc-block-style' ); // WooCommerce
wp_dequeue_style( 'storefront-gutenberg-blocks' ); // Storefront theme
}

function wpdocs_dequeue_dashicon() {
    if (current_user_can( 'update_core' )) {
        return;
    }
    wp_deregister_style('dashicons');
}
add_action( 'wp_enqueue_scripts', 'wpdocs_dequeue_dashicon' ); 