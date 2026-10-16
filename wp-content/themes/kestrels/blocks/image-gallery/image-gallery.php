<?php
$title = get_field('title');
$slides = get_field('slides');

if ($slides) : ?>
<section class="block">
	<div class="container--s image-gallery">
	<div class="swiper image-gallery__swiper">
		<div class="swiper-wrapper">
			<?php foreach ($slides as $slide) : ?>
			<?php if ($slide['image']) : ?>
			<div class="swiper-slide image-gallery__slide">
				<figure class="image-gallery__figure">
					<?php echo wp_get_attachment_image($slide['image']['ID'], 'large', false, ['class' => 'image-gallery__image', 'sizes' => '(min-width: 1320px) 1200px, 90vw']); ?>
					<?php if ($slide['caption']) : ?>
					<figcaption class="image-gallery__caption"><?php echo esc_html($slide['caption']); ?></figcaption>
					<?php endif; ?>
				</figure>
			</div>
			<?php endif; ?>
			<?php endforeach; ?>
		</div>
		<button type="button" class="swiper-button-prev" aria-label="Previous image"></button>
		<button type="button" class="swiper-button-next" aria-label="Next image"></button>
	</div>
	</div>
</section>
<?php endif; ?>
