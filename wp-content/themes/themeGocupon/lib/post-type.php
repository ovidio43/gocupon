<?php
function custom_post_type_init() {
    $post_types = array(
        array("slug" => "proximas-ofertas", "plural" => "Próximas ofertas", "singular" => "Próxima oferta", "rewrite" => "proximas-ofertas", "public" => true, "archive" => true, "supports" => array('title',  'thumbnail'))
    );

    foreach ($post_types as $pt) {

        $supports = array('title', 'editor', 'post_tags', 'thumbnail', 'excerpt', "comments");
        $public = isset($pt['public']) ? $pt['public'] : false;
        register_post_type($pt["slug"], array(
            'labels' => array(
                'name' => $pt["plural"],
                'singular_name' => $pt["singular"]
            ),
            'show_ui' => true,
            'publicly_queryable' => isset($pt["publicly_queryable"]) ? $pt["publicly_queryable"] : $public,
            'public' => isset($pt['public']) ? $pt['public'] : false,
            'has_archive' => isset($pt['archive']) ? $pt['archive'] : true,
            'rewrite' => array('hierarchical' => true, 'with_front' => true, 'slug' => isset($pt["rewrite"]) ? $pt["rewrite"] : $pt["slug"]),
            'supports' => isset($pt['supports']) ? $pt['supports'] : $supports,
            'taxonomies' => isset($pt['taxonomies']) ? $pt['taxonomies'] : array(),
            'menu_icon' => isset($pt['menu_icon']) ? $pt['menu_icon'] : null,
            'hierarchical' => false
                )
        );
    }
}

add_action('init', 'custom_post_type_init');
// create taxonomy
add_action( 'init', 'create_my_taxonomies', 0 );
function create_my_taxonomies() {
    $taxonomies = array(
        array("name_tax" => "comercio", "related_tax" => "product", "name" => "Comercio para Cupon", "add_new_item" => "Agregar Comercio", "new_item_name" => "Nuevo Comercio")
    );
    foreach ($taxonomies as $tax) {
        register_taxonomy(
            $tax["name_tax"],
            $tax["related_tax"],
            array(
                'labels' => array(
                    'name' => $tax["name"],
                    'add_new_item' => $tax["add_new_item"],
                    'new_item_name' => $tax["new_item_name"]
                ),
                'show_ui' => true,
                'show_tagcloud' => false,
                'hierarchical' => true
            )
        );
    }
}