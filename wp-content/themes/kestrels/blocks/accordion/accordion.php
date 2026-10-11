<?php
$accordion = get_field('accordion_items');
$show_all = get_field('accordion_show_all');
$title = get_field('title');

if ($accordion) : ?>
<section class="block accordion">

    <div class="container container--s">

        <?php if ($title) : ?>
        <div class="block-heading accordion__heading">
            <h2 class="accordion__heading"><?php echo esc_html($title); ?></h2>
            <?php if ($show_all) : ?>
            <div class="block-heading__actions accordion__actions">
                <button class="accordion__show-all btn" data-show="<?php esc_attr_e('Show all', 'origin'); ?>" data-close="<?php esc_attr_e('Close all', 'origin'); ?>"><?php _e('Show all', 'origin'); ?></button>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        
        <?php foreach ($accordion as $item) : ?>
        <details class="accordion__item" id="<?php echo sanitize_title($item['accordion_title']); ?>">
            <summary class="accordion__handle">
                <h3 class="accordion__title"><?php echo esc_html($item['accordion_title']); ?></h3>
                <div class="accordion__icon"></div>
            </summary>
            <div class="accordion__body content">
                <?php echo $item['accordion_body']; ?>
            </div>
        </details>
        <?php endforeach; ?>

    </div>

</section>
<?php endif; ?>
