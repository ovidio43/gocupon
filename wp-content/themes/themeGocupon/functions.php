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

if ( ! function_exists( 'the_breadcrumb' ) ) :

    function the_breadcrumb() {
          /* === OPTIONS === */
        $text['home']     = _x( 'Cupons Up', 'Cupons Up', 'pietergoosen' ); // text for the 'Home' link
     $text['category'] = __( 'Archive by Category "%s"', 'pietergoosen' );  // text for a category page
     $text['search']   = __( 'Search Results for "%s" Query', 'pietergoosen' ); // text for a search results page
     $text['tag']      = __( 'Posts Tagged "%s"', 'pietergoosen' );  // text for a tag page
     $text['author']   = __( 'Posts Posted by %s', 'pietergoosen' ); // text for an author page
     $text['404']      = __( 'Error 404', 'pietergoosen' );  // text for the 404 page

     $show_current   = 1; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show
     $show_on_home   = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
     $show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
     $show_title     = 1; // 1 - show the title for the links, 0 - don't show
     $delimiter      = ' &raquo; '; // delimiter between crumbs
     $before         = '<span class="current">'; // tag before the current crumb
     $after          = '</span>'; // tag after the current crumb
     /* === END OF OPTIONS === */

     global $post;
        $here_text    = __('', 'pietergoosen');
     $home_link    = home_url('/');
     $link_before  = '<span typeof="v:Breadcrumb">';
     $link_after   = '</span>';
     $link_attr    = ' rel="v:url" property="v:title"';
     $link         = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
        if (isset($post)){
            $parent_id    = $parent_id_2  = $post->post_parent;
        }
     $frontpage_id = get_option('page_on_front');

     if (is_home() || is_front_page()) {

            if ($show_on_home == 1) echo '<div class="breadcrumb"><a href="' . $home_link . '">' . $text['home'] . '</a></div>';

        } else {

         echo '<div class="breadcrumb">';
         if ($show_home_link == 1) {
             echo  $here_text . '<a href="' . $home_link . '" rel="v:url" property="v:title">' . $text['home'] . '</a>';
             if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;
         }

         if ( is_category() ) {
             $this_cat = get_category(get_query_var('cat'), false);
             if ($this_cat->parent != 0) {
                 $cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
                 if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                 $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
                 $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                 if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                 echo $cats;
             }
                if ($show_current == 1) echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

          } elseif ( is_search() ) {
              echo $before . sprintf($text['search'], get_search_query()) . $after;

          } elseif ( is_day() ) {
             echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
             echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
             echo $before . get_the_time('d') . $after;

         } elseif ( is_month() ) {
             echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
             echo $before . get_the_time('F') . $after;

          } elseif ( is_year() ) {
              echo $before . get_the_time('Y') . $after;

          } elseif ( is_single() && !is_attachment() ) {
                if ( get_post_type() != 'post' ) {
                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    printf($link, $home_link . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
                    if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
                } else {
                    $cat = get_the_category(); $cat = $cat[0];
                    $cats = get_category_parents($cat, TRUE, $delimiter);
                    if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                    $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
                    $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                    if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                    echo $cats;
                    if ($show_current == 1) echo $before . get_the_title() . $after;
                }

         } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
             $post_type = get_post_type_object(get_post_type());
             echo $before . $post_type->labels->singular_name . $after;

         } elseif ( is_attachment() ) {
               $parent = get_post($parent_id);
                $cat = get_the_category($parent->ID); $cat = $cat[0];
                $cats = get_category_parents($cat, TRUE, $delimiter);
                $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
                $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                echo $cats;
              printf($link, get_permalink($parent), $parent->post_title);
              if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

            } elseif ( is_page() && !$parent_id ) {
                if ($show_current == 1) echo $before . get_the_title() . $after;

            } elseif ( is_page() && $parent_id ) {
                if ($parent_id != $frontpage_id) {
                    $breadcrumbs = array();
                    while ($parent_id) {
                        $page = get_page($parent_id);
                        if ($parent_id != $frontpage_id) {
                            $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                        }
                        $parent_id = $page->post_parent;
                    }
                   $breadcrumbs = array_reverse($breadcrumbs);
                   for ($i = 0; $i < count($breadcrumbs); $i++) {
                       echo $breadcrumbs[$i];
                       if ($i != count($breadcrumbs)-1) echo $delimiter;
                   }
              }
             if ($show_current == 1) {
                 if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo $delimiter;
                 echo $before . get_the_title() . $after;
             }

          } elseif ( is_tag() ) {
             echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

          } elseif ( is_author() ) {
               global $author;
               $userdata = get_userdata($author);
              echo $before . sprintf($text['author'], $userdata->display_name) . $after;

           } elseif ( is_404() ) {
               echo $before . $text['404'] . $after;
           }

          if ( get_query_var('paged') ) {
              if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
             echo __('&nbsp;&raquo;&nbsp; Page', 'pietergoosen') . ' ' . get_query_var('paged');
             if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
         }

           echo '</div><!-- .breadcrumbs -->';

        }
    }

endif; 
function themeCatStevens_sizes() {
    add_image_size('smallimg-prod', 298, 336, true);
    add_image_size('bigimg-prod', 627, 336, true);
    add_image_size('slideimg-prod', 960, 470, true);
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


remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 25 );


