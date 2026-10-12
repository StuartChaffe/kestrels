<?php

/**
 * Handy function for seeing if a page is parent of child
 * Usage: if ( is_tree(2) ) { ... }
 */
function is_tree( $pid ) {
	global $post;
	$ancestors = get_post_ancestors( $pid );
	return is_page() && ( is_page( $pid ) || $post->post_parent == $pid || in_array( $pid, $ancestors ) );
}



/**
 * SVG helper icon
 * Usage:
 */

function get_icon( $icon ) {
	return '<svg class="icon icon-' . $icon . '"><use href="#' . $icon . '"></use></svg>';
}



/**
 * Dump helper. Functions to dump variables to the screen, in a nicley formatted manner.
 * https://gist.github.com/accentinteractive/3838495
 */
if (!function_exists('dump')) {
    function dump ($var, $label = 'Dump', $echo = TRUE)
    {
        // Store dump in variable
        ob_start();
        var_dump($var);
        $output = ob_get_clean();

        // Add formatting
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';

        // Output
        if ($echo == TRUE) {
            echo $output;
        }
        else {
            return $output;
        }
    }
}


if (!function_exists('dump_exit')) {
    function dump_exit($var, $label = 'Dump', $echo = TRUE) {
        dump ($var, $label, $echo);
        exit;
    }
}



function my_login_logo() { ?>
	<style type="text/css">
		#login h1 a, .login h1 a {
			background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/src/images/logo.svg');
			height: 63px;
			width: 198px;
			background-size: 198px 63px;
			background-repeat: no-repeat;
		}
		.wp-core-ui .button-primary {
			/* background: #FFDA42 !important;
			background-color: #FFDA42!important;
			color: #292545 !important;
			border: 0 !important; */
			border-radius: 6px !important;
			/* padding: 0.5rem 1rem; */
		}
		body.login {
			background: #F2F1EC;
			background-color: #F2F1EC;
		}
		.login form {
			/* padding: 0px !important;
			background: transparent !important; */
			padding: 30px !important;
			border-radius: 30px;
			border: 0 !important;
			box-shadow: none !important;
		}

		/* .wp-core-ui .button.button-large {
			padding: 5px 40px !important;
			border-radius: 0px;
			font-size: 16px !important;
		}
		a {
			color: #000 !important;
		}
		.privacy-policy-page-link {
			display: none;
		}
		.login-action-login {
			display: flex;
    		flex-direction: column;
			background-color: #F3F3F3 !important;
		}
		.login label {
			font-size: 16px !important;
		}
		.login form {
			padding: 0px !important;
			background: transparent !important;
			border: 0 !important;
			box-shadow: none !important;
		}
		#login {
			padding: 0 !important;
		}
		.login #nav,
		.login #backtoblog {
			padding: 0 !important;
		}
		#login input[type=text],
		#login input[type=password] {
			border-radius: 0 !important;
			border: 0 !important;
			padding: 10px 10px !important;
			box-shadow: none !important;
		}
		.login .button.wp-hide-pw .dashicons {
			top: 10px !important;
		} */
	</style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
