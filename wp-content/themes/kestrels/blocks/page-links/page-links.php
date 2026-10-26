<?php
$items = [];

if (get_field('source') === 'pages') {
	foreach ((array) get_field('pages') as $page_id) {
		$items[] = [
			'image_id' => get_post_thumbnail_id($page_id),
			'title'    => get_the_title($page_id),
			'content'  => has_excerpt($page_id) ? get_the_excerpt($page_id) : '',
			'link'     => get_permalink($page_id),
		];
	}
} else {
	foreach ((array) get_field('links') as $item) {
		$items[] = [
			'image_id' => $item['image'] ? $item['image']['ID'] : 0,
			'title'    => $item['title'],
			'content'  => $item['content'],
			'link'     => $item['link'],
		];
	}
}

if ($items) : ?>
<section class="block page-links">
	<div class="container">
		<ul class="page-links__list">
		<?php foreach ($items as $item) : ?>
			<?php $tag = $item['link'] ? 'a' : 'div'; ?>
			<li class="page-links__item">
			<<?php echo $tag; ?> class="page-links__card"<?php echo $item['link'] ? ' href="' . esc_url($item['link']) . '"' : ''; ?>>
			<?php if ($item['image_id']) : ?>
				<div class="page-links__media">
					<?php echo wp_get_attachment_image($item['image_id'], 'Banner', false, ['class' => 'page-links__image']); ?>
					<?php if ($item['link']) : ?>
					<span class="page-links__arrow" aria-hidden="true"></span>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<?php if ($item['title']) : ?>
				<h3 class="page-links__title"><?php echo esc_html($item['title']); ?></h3>
			<?php endif; ?>
			<?php if ($item['content']) : ?>
				<p class="page-links__content"><?php echo nl2br(esc_html($item['content'])); ?></p>
			<?php endif; ?>
			</<?php echo $tag; ?>>
			</li>
		<?php endforeach; ?>
		</ul>
	</div>
</section>
<?php endif; ?>
