<?php

/**
 * Enqueue JS and CSS
 */
function origin_scripts() {
	if ( !is_admin() ) {
		wp_enqueue_style( 'styles', vite_asset( 'src/styles/styles.scss' ), array(), null );

		wp_register_script( 'scripts', vite_asset( 'src/js/scripts.js' ), array( 'jquery' ), null, true );
		wp_enqueue_script( 'scripts' );

		foreach ( vite_asset_css( 'src/js/scripts.js' ) as $i => $url ) {
			wp_enqueue_style( 'scripts-css-' . $i, $url, array(), null );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'origin_scripts', 100 );



/**
 * Remove wp-embed.js
 */
function origin_deregister_scripts() {
	if ( !is_admin() ) {
		wp_deregister_script( 'wp-embed' );
	}
}
add_action( 'wp_print_scripts', 'origin_deregister_scripts', 100);



/**
 * Remove jquery-migrate.js
 */
function origin_deregister_jquery_migrate( $scripts ) {
	if ( ! is_admin() && ! empty( $scripts->registered['jquery'] ) ) {
		$jquery_dependencies = $scripts->registered['jquery']->deps;
		$scripts->registered['jquery']->deps = array_diff( $jquery_dependencies, array( 'jquery-migrate' ) );
	}
}
add_action( 'wp_default_scripts', 'origin_deregister_jquery_migrate' );



function vite_get_manifest( $manifest_directory = 'assets' ) {
	static $manifests = [];

	if ( ! isset( $manifests[ $manifest_directory ] ) ) {
		$manifest_path = get_theme_file_path( $manifest_directory . '/.vite/manifest.json' );
		if ( ! file_exists( $manifest_path ) ) {
			$manifests[ $manifest_directory ] = null;
		} else {
			// @codingStandardsIgnoreLine
			$manifests[ $manifest_directory ] = json_decode( file_get_contents( $manifest_path ), true );
		}
	}

	return $manifests[ $manifest_directory ];
}



function vite_asset( $path, $manifest_directory = 'assets' ) {
	$manifest = vite_get_manifest( $manifest_directory );

	if ( ! $manifest || ! array_key_exists( $path, $manifest ) ) {
		return get_theme_file_uri( $path );
	}

	return get_theme_file_uri( trailingslashit( $manifest_directory ) . $manifest[ $path ]['file'] );
}



function vite_asset_css( $path, $manifest_directory = 'assets' ) {
	$manifest = vite_get_manifest( $manifest_directory );

	if ( ! $manifest ) {
		return [];
	}

	$css_files = $manifest[ $path ]['css'] ?? [];
	return array_map( function( $css ) use ( $manifest_directory ) {
		return get_theme_file_uri( trailingslashit( $manifest_directory ) . $css );
	}, $css_files );
}
