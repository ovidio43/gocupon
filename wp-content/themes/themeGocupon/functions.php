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