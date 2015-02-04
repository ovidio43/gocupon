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
}
add_action( 'init', 'custom_widgets_init' );