<?php

add_action('init', function() {
    if (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], 'wp-comments-post.php') !== false) {
        wp_die('Comments are disabled.', 403);
    }
});

add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);
add_filter('comments_array', '__return_empty_array', 10, 2);

add_action('admin_init', function() {
    foreach (get_post_types() as $post_type) {
        remove_post_type_support($post_type, 'comments');
        remove_post_type_support($post_type, 'trackbacks');
    }

    if ($GLOBALS['pagenow'] === 'edit-comments.php') {
        wp_safe_redirect(admin_url());
        exit;
    }
});

add_action('admin_menu', function() {
    remove_menu_page('edit-comments.php');
});

add_action('admin_bar_menu', function($wp_admin_bar) {
    $wp_admin_bar->remove_node('comments');
}, 999);
