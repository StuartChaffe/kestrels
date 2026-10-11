<?php
$title = get_field('title');
$slides = get_field('slides');

if ($slides) : ?>
<section class="block image-gallery">
    <div class="container">

        <?php if ($title) : ?>
        <h2 class="image-gallery__title"><?php echo esc_html($title); ?></h2>
        <?php endif; ?>

        <div class="swiper image-gallery__swiper">
            <div class="swiper-wrapper">
                <?php foreach ($slides as $slide) : ?>
                <?php if ($slide['image']) : ?>
                <div class="swiper-slide image-gallery__slide">
                    <figure class="image-gallery__figure">
                        <?php echo wp_get_attachment_image($slide['image']['ID'], 'Gallery', false, ['class' => 'image-gallery__image']); ?>
                        <?php if ($slide['caption']) : ?>
                        <figcaption class="image-gallery__caption"><?php echo esc_html($slide['caption']); ?></figcaption>
                        <?php endif; ?>
                    </figure>
                </div>
                <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-pagination"></div>
        </div>

    </div>
</section>
<?php endif; ?>
