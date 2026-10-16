<?php
$allowed_blocks = null;

if (!isset($args)) {
	$args = null;
	$allowed_blocks = array('core/heading', 'core/table', 'core/paragraph', 'core/buttons', 'core/image', 'core/video', 'core/embed', 'core/button', 'core/columns', 'core/column', 'acf/logos', 'acf/block-list', 'acf/text-image', 'acf/spacer', 'acf/anchor', 'acf/block-grid', 'acf/block-text', 'acf/team', 'acf/faqs', 'acf/illustration', 'acf/block-form', 'acf/block-video', 'acf/block-image', 'acf/stat', 'acf/image-gallery');
}

$defaults = [
	'bkg' => get_field('bkg_colour'),
];
$args = wp_parse_args($args, $defaults);
?>

<section class="content-block <?php echo $args['bkg'] ?>">
    <div class="container container--s">
    <?php if ( is_admin() || ! empty( $content ) ) : ?>
		<?php echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" />'; ?>
	<?php endif; ?>
    </div>
</section>
