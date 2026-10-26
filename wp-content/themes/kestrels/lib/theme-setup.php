<?php

/**
 * Add theme support
 */
function kestrels_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'script', 'style' ) );
    add_theme_support( 'disable-layout-styles' );
    add_post_type_support( 'page', 'excerpt' );
}
add_action( 'after_setup_theme', 'kestrels_theme_setup' );



/**
 * Tidy up head
 */
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action( 'wp_head', 'wp_resource_hints', 2 );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );



/**
 * Remove global styles and block layout CSS injected by WordPress
 */
add_action( 'after_setup_theme', function() {
    remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
    remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );
} );



/**
 * Bundle per-block stylesheets into wp-block-library so a single dequeue removes all of them
 */
add_filter( 'should_load_separate_core_block_assets', '__return_false' );



/**
 * Dequeue unneeded frontend styles
 */
add_action( 'wp_enqueue_scripts', function() {
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'classic-theme-styles' );
    wp_dequeue_style( 'wp-img-auto-sizes-contain' );

    if ( ! is_admin_bar_showing() ) {
        wp_dequeue_style( 'dashicons' );
    }
}, 100 );



/**
 * Disable XML-RPC
 */
add_filter( 'xmlrpc_enabled', '__return_false' );



/**
 * Strip version strings from enqueued asset URLs
 */
function kestrels_remove_version_strings( $src ) {
    if ( ! is_admin() ) {
        $src = remove_query_arg( 'ver', $src );
    }
    return $src;
}
add_filter( 'script_loader_src', 'kestrels_remove_version_strings' );
add_filter( 'style_loader_src', 'kestrels_remove_version_strings' );



/**
 * Add no-js class to body
 */
function kestrels_no_js_body_classes( $classes ) {
    return array_merge( $classes, array( 'no-js' ) );
}
add_filter( 'body_class', 'kestrels_no_js_body_classes', 20 );



/**
 * Tidy up body classes
 */
function kestrels_clean_body_classes( $classes ) {
    $allowed_classes = [
        'single',
        'page',
        'archive',
        'admin-bar',
        'no-js',
    ];
    return array_intersect( $classes, $allowed_classes );
}
add_filter( 'body_class', 'kestrels_clean_body_classes', 20 );
