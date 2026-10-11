<?php

/**
 * Manually inject the BrowserSync client script when running locally.
 *
 * BrowserSync 3.x no longer auto-injects its client script when used in
 * proxy mode (which is how vite-plugin-browser-sync's `buildWatch` runs),
 * so we add it ourselves here. Only outputs if the BrowserSync server
 * (port 3000) is actually reachable, so it's a no-op when `npm run watch`
 * isn't running — safe to leave active on any environment.
 */
function origin_browser_sync_snippet() {
	$host = wp_parse_url( home_url(), PHP_URL_HOST );
	$port = 3000;

	// Quick, cheap check that something is listening before we print the tag.
	$connection = @fsockopen( $host, $port, $errno, $errstr, 0.2 );
	if ( ! $connection ) {
		return;
	}
	fclose( $connection );

	printf(
		'<script async src="https://%s:%d/browser-sync/browser-sync-client.js"></script>' . "\n",
		esc_attr( $host ),
		$port
	);
}
add_action( 'wp_footer', 'origin_browser_sync_snippet', 99 );
