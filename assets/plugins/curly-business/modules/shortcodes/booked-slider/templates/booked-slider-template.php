<div class="<?php echo esc_attr($holder_classes); ?>">
    <div class="mkdf-bs-rev-holder">
        <?php echo do_shortcode($content); ?>
    </div>

    <div class="mkdf-bs-calendar-holder">

        <?php if ($calendar_in_grid) : ?>
        <div class="mkdf-grid">
            <?php endif; ?>

            <div class="mkdf-bs-calendar-content" <?php echo curly_mkdf_inline_style($calendar_styles); ?> <?php echo curly_mkdf_get_inline_attrs($calendar_responsive_data); ?>>

                <?php if (!empty($title)) : ?>
                    <?php echo '<' . esc_attr($title_tag); ?> class="mkdf-bs-calendar-title" <?php echo curly_mkdf_get_inline_style($title_styles); ?>>
                    <?php echo wp_kses($title, array('span' => array('class' => true))); ?>
                    <?php echo '</' . esc_attr($title_tag); ?>>
                <?php endif; ?>

                <?php echo do_shortcode('[booked-calendar ' . $calendar_attrs . ']'); ?>

            </div>

            <?php if ($calendar_in_grid) : ?>
        </div>
    <?php endif; ?>

    </div>
</div>