<?php

// Set theme defaults, tidy up WP
require_once( get_template_directory() . '/lib/theme-setup.php' );

// Image settings
require_once( get_template_directory() . '/lib/images.php' );

// Load scrips
require_once( get_template_directory() . '/lib/enqueue.php' );

// BrowserSync live-reload client (local dev only)
require_once( get_template_directory() . '/lib/browser-sync.php' );

// Gutenberg settings
require_once( get_template_directory() . '/lib/gutenberg.php' );

// Configure menus
require_once( get_template_directory() . '/lib/menus.php' );

// ACF configuration
require_once( get_template_directory() . '/lib/acf.php' );

// Vendor specific functions
require_once( get_template_directory() . '/lib/vendors.php' );

// Helper functions
require_once( get_template_directory() . '/lib/helpers.php' );

// Environment indicator
require_once( get_template_directory() . '/lib/env-indicator.php' );

// Disable comments
require_once( get_template_directory() . '/lib/comments.php' );

// Editor role capability enhancements
require_once( get_template_directory() . '/lib/roles.php' );

// Register ACF blocks
require_once( get_template_directory() . '/blocks/register.php' );
