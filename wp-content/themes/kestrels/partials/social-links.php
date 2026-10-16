<?php
$defaults = [
    'modifier_classes' => '',
];

$args   = wp_parse_args( $args, $defaults );
$social = get_field( 'social_links', 'options' );

if ( ! $social || ! array_filter( $social ) ) {
    return;
}
?>
<ul class="social-links<?php echo $args['modifier_classes'] ? ' ' . esc_attr( $args['modifier_classes'] ) : ''; ?>">
	<?php if ( $social['x_url'] ) : ?>
		<li class="social-links__item">
			<a href="<?php echo esc_url( $social['x_url'] ); ?>" class="social-links__link" aria-label="X (Twitter)" rel="noopener noreferrer" target="_blank">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.748l7.73-8.835L1.254 2.25H8.08l4.253 5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
			</a>
		</li>
	<?php endif; ?>
	<?php if ( $social['facebook_url'] ) : ?>
		<li class="social-links__item">
			<a href="<?php echo esc_url( $social['facebook_url'] ); ?>" class="social-links__link" aria-label="Facebook" rel="noopener noreferrer" target="_blank">
				<svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M9.34475 10.0485L9.86302 6.81553H6.62101V4.71751C6.62101 3.83302 7.07387 2.97088 8.52599 2.97088H10V0.218461C10 0.218461 8.66227 0 7.38337 0C4.7132 0 2.96805 1.54835 2.96805 4.35146V6.81553H0V10.0485H2.96805V17.8641C3.56319 17.9535 4.17317 18 4.79455 18C5.41592 18 6.02587 17.9535 6.62101 17.8641V10.0485H9.34475Z" fill="currentColor"/>
				</svg>
			</a>
		</li>
	<?php endif; ?>
	<?php if ( $social['instagram_url'] ) : ?>
		<li class="social-links__item">
			<a href="<?php echo esc_url( $social['instagram_url'] ); ?>" class="social-links__link" aria-label="Instagram" rel="noopener noreferrer" target="_blank">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
			</a>
		</li>
	<?php endif; ?>
	<?php if ( $social['youtube_url'] ) : ?>
		<li class="social-links__item">
			<a href="<?php echo esc_url( $social['youtube_url'] ); ?>" class="social-links__link" aria-label="YouTube" rel="noopener noreferrer" target="_blank">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M23.495 6.205a3.007 3.007 0 00-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 00.527 6.205a31.247 31.247 0 00-.522 5.805 31.247 31.247 0 00.522 5.783 3.007 3.007 0 002.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 002.088-2.088 31.247 31.247 0 00.5-5.783 31.247 31.247 0 00-.5-5.805zM9.609 15.601V8.408l6.264 3.602z"/></svg>
			</a>
		</li>
	<?php endif; ?>
	<?php if ( $social['linkedin_url'] ) : ?>
		<li class="social-links__item">
			<a href="<?php echo esc_url( $social['linkedin_url'] ); ?>" class="social-links__link" aria-label="LinkedIn" rel="noopener noreferrer" target="_blank">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
			</a>
		</li>
	<?php endif; ?>
</ul>
