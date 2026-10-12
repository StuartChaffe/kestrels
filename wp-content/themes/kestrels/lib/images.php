<?php

/**
 * Set image sizes
 */
function origin_register_image_sizes() {
	add_image_size( 'Banner', 600, 450, true );
	add_image_size( 'Square', 400, 400, true );
	add_image_size( 'Gallery', 1400, 800, true );
}
add_action( 'after_setup_theme', 'origin_register_image_sizes' );

function origin_image_defaults() {
	update_option( 'image_default_align', 'center' );
	update_option( 'image_default_link_type', 'none' );
	update_option( 'image_default_size', 'large' );
}
add_action( 'after_switch_theme', 'origin_image_defaults' );



/**
 * Remove image dimensions
 */
function origin_remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}
add_filter( 'post_thumbnail_html', 'origin_remove_thumbnail_dimensions', 10, 3 );

/**
 * Allow SVG
 */
function add_file_types_to_uploads($file_types){
	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types = array_merge($file_types, $new_filetypes );
	return $file_types;
}
add_filter('upload_mimes', 'add_file_types_to_uploads');


/**
 * Responsive image helper function
 * Based on https://www.awesomeacf.com/responsive-images-wordpress-acf/
 * Usage: <img class="my_class" <?php echo get_acf_responsive_image_path(get_field( 'image_1' ),'banner','1000px'); ?>  alt="text" /> 
 */
 function get_acf_responsive_image_path($image_id,$image_size,$max_width) {
	// check the image ID is not blank
	if($image_id != '') {
		// set the default src image size
		$image_src = wp_get_attachment_image_url( $image_id, $image_size );
		// set the srcset with various image sizes
		$image_srcset = wp_get_attachment_image_srcset( $image_id, $image_size );
		// generate the markup for the responsive image
		return 'src="'.$image_src.'" srcset="'.$image_srcset.'" sizes="(max-width: '.$max_width.') 100vw, '.$max_width.'"';
	}
 }
