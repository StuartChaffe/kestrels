<?php

/**
 * Enable ACF options page
 */
add_action('acf/init', function () {
    if( function_exists('acf_add_options_page') ) {
        $parent = acf_add_options_page(array(
            'page_title'  => __('Theme Options'),
            'menu_title'  => __('Theme Options'),
            'redirect'    => false,
        ));
    }
});



/**
 * ACF JSON: load from global acf-json/ and each block's acf-json/ folder
 */
add_filter('acf/settings/load_json', function ($paths) {
	foreach ( glob( get_stylesheet_directory() . '/blocks/*/acf-json', GLOB_ONLYDIR ) as $path ) {
		$paths[] = $path;
	}
	return $paths;
});



/**
 * ACF JSON: save block field groups into their block folder, everything else into acf-json/
 */
add_action('acf/update_field_group', function ($group) {
	$slug = _origin_block_slug_for_group( $group );
	if ( ! $slug ) return;

	$path = get_stylesheet_directory() . '/blocks/' . $slug . '/acf-json';
	wp_mkdir_p( $path );

	add_filter('acf/settings/save_json', function() use ($path) {
		return $path;
	}, 100);
}, 1);

add_filter('acf/settings/save_json', function ($path) {
	return get_stylesheet_directory() . '/acf-json';
});

function _origin_block_slug_for_group( $group ) {
	foreach ( $group['location'] ?? [] as $rules ) {
		foreach ( $rules as $rule ) {
			if ( $rule['param'] === 'block' && $rule['operator'] === '==' ) {
				return str_replace( 'acf/', '', $rule['value'] );
			}
		}
	}
	return null;
}
