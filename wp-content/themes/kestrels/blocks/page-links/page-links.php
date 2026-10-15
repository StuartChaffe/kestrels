<?php
$links = get_field('links');

if ($links) : ?>
<section class="block page-links">
	<div class="container">
		<ul class="page-links__list">
		<?php foreach ($links as $item) : ?>
			<?php $tag = $item['link'] ? 'a' : 'div'; ?>
			<li class="page-links__item">
			<<?php echo $tag; ?> class="page-links__card"<?php echo $item['link'] ? ' href="' . esc_url($item['link']) . '"' : ''; ?>>
			<?php if ($item['image']) : ?>
				<div class="page-links__media">
					<?php echo wp_get_attachment_image($item['image']['ID'], 'Banner', false, ['class' => 'page-links__image']); ?>
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
