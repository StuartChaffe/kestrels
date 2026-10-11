<?php

/**
 * Register menus
 */
add_action( 'after_setup_theme', function() {
	register_nav_menus( array(
		'primary' => __( 'Primary' ),
		'footer'  => __( 'Footer' ),
	) );
} );

class BEM_Nav_Walker extends Walker_Nav_Menu {

	private string $prefix;

	public function __construct( string $prefix = 'primary-nav' ) {
		$this->prefix = $prefix;
	}

	public function start_lvl( &$output, $depth = 0, $args = null ) {
		$indent  = str_repeat( "\t", $depth );
		$class   = $depth === 0 ? "{$this->prefix}__sub-menu" : "{$this->prefix}__sub-menu {$this->prefix}__sub-menu--depth-{$depth}";
		$output .= "\n{$indent}<ul class=\"{$class}\">\n";
	}

	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$indent = str_repeat( "\t", $depth );

		$item_classes = [ $depth === 0 ? "{$this->prefix}__item" : "{$this->prefix}__sub-item" ];

		if ( $item->current ) {
			$item_classes[] = "{$this->prefix}__item--current";
		}
		if ( $item->current_item_ancestor ) {
			$item_classes[] = "{$this->prefix}__item--ancestor";
		}
		if ( in_array( 'menu-item-has-children', (array) $item->classes ) ) {
			$item_classes[] = "{$this->prefix}__item--parent";
		}

		$output .= "{$indent}<li class=\"" . implode( ' ', $item_classes ) . "\">";

		$link_classes = [ $depth === 0 ? "{$this->prefix}__link" : "{$this->prefix}__sub-link" ];

		$atts = [
			'href'         => $item->url,
			'class'        => implode( ' ', $link_classes ),
			'aria-current' => $item->current ? 'page' : '',
		];

		if ( $item->target ) {
			$atts['target'] = $item->target;
		}
		if ( $item->target === '_blank' ) {
			$atts['rel'] = 'noopener noreferrer';
		}

		$atts   = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
		$attrs  = '';
		foreach ( $atts as $attr => $value ) {
			if ( $value !== '' ) {
				$attrs .= ' ' . $attr . '="' . esc_attr( $value ) . '"';
			}
		}

		$output .= "<a{$attrs}>" . apply_filters( 'the_title', $item->title, $item->ID ) . '</a>';
	}
}
