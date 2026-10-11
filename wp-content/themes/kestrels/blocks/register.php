<?php

add_action( 'init', 'register_acf_blocks' );

function register_acf_blocks() {
	foreach ( glob( get_stylesheet_directory() . '/blocks/*/', GLOB_ONLYDIR ) as $path ) {
		if ( file_exists( $path . 'block.json' ) ) {
			register_block_type( $path );
		}
	}
}
