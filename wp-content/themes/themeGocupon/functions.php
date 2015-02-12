<?php
require_once(get_template_directory() . '/lib/post-type.php');
add_theme_support( 'post-thumbnails' );
register_nav_menu('primary', 'Main Menu');
register_nav_menu('footer', 'Footer Menu');
register_nav_menu('social_nav', 'Social Menu');
function custom_widgets_init() {
	register_sidebar (array(
	'name' => __( 'main sidebar', 'themeCupon' ),
	'id' => 'main_sidebar',
	'before_widget' => '<aside>',
	'after_widget' => '</aside>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
	));	
	register_sidebar (array(
	'name' => __( 'search sidebar', 'themeCupon' ),
	'id' => 'search_bar',
	'before_widget' => '',
	'after_widget' => '',
	'before_title' => '',
	'after_title' => '',
	));
	register_sidebar (array(
	'name' => __( 'Newsletter', 'themeCupon' ),
	'id' => 'newsletter',
	'before_widget' => '',
	'after_widget' => '',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
	));	
}
add_action( 'init', 'custom_widgets_init' );

add_filter( 'loop_shop_columns', 'wc_loop_shop_columns', 1, 10 );
function wc_loop_shop_columns( $number_columns ) {
	return 3;
} 

function the_breadcrumb() {
	if (!is_home()) {
		echo '<span class="removed_link" title="&#039;;
		echo get_option(&#039;home&#039;);
	        echo &#039;">';
		bloginfo('name');
		echo "</span> » ";
		if (is_category() || is_single()) {
			the_category('title_li=');
			if (is_single()) {
				echo " » ";
				the_title();
			}
		} elseif (is_page()) {
			echo the_title();
		}
	}
} 
function themeCatStevens_sizes() {
    add_image_size('smallimg-prod', 360, 406, true);
    add_image_size('bigimg-prod', 750, 406, true);
    add_image_size('slideimg-prod', 1000, 470, true);
}

add_action('init', 'themeCatStevens_sizes', 0);

function get_excerpt($count){
  $excerpt = get_the_excerpt();
  $excerpt = strip_tags($excerpt);
  $excerpt = substr($excerpt, 0, $count);
  return $excerpt;
}
function custom_wp_title($title, $sep) {
    global $paged, $page;
    if (is_feed())
        return $title;
    $title .= get_bloginfo('name');
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && ( is_home() || is_front_page() ))
        $title = "$title $sep $site_description";
    if ($paged >= 2 || $page >= 2)
        $title = "$title $sep " . sprintf(__('Page %s', 'moe.'), max($paged, $page));
    return $title;
}

add_filter('wp_title', 'custom_wp_title', 10, 2);