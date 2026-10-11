<?php
$title       = get_field('title');
$description = get_field('description');
$button      = get_field('button');
?>
<section class="block page-header">
    <div class="container">
        <?php if ($title) : ?>
        <h1 class="page-header__title"><?php echo esc_html($title); ?></h1>
        <?php endif; ?>
        <?php if ($description) : ?>
        <div class="page-header__description">
            <?php echo wp_kses_post($description); ?>
        </div>
        <?php endif; ?>
        <?php if ($button) : ?>
        <a class="page-header__button btn" href="<?php echo esc_url($button['url']); ?>"<?php echo $button['target'] ? ' target="' . esc_attr($button['target']) . '"' : ''; ?>>
            <?php echo esc_html($button['title']); ?>
        </a>
        <?php endif; ?>
    </div>
</section>
