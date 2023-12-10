<div class="mkdf-single-image-holder <?php echo esc_attr($holder_classes); ?>">
    <div class="mkdf-si-inner" <?php echo curly_mkdf_get_inline_style($holder_styles); ?>>
        <?php if ($image_behavior === 'lightbox') { ?>
        <a itemprop="image" href="<?php echo esc_url($image['url']); ?>" data-rel="prettyPhoto[si_pretty_photo]" title="<?php echo esc_attr($image['alt']); ?>">
            <?php } else if ($image_behavior === 'custom-link' && !empty($custom_link)) { ?>
            <a itemprop="url" href="<?php echo esc_url($custom_link); ?>" target="<?php echo esc_attr($custom_link_target); ?>">
                <?php } ?>
                <?php if (is_array($image_size) && count($image_size)) : ?>
                    <?php echo curly_mkdf_generate_thumbnail($image['image_id'], null, $image_size[0], $image_size[1]); ?>
                <?php else: ?>
                    <?php echo wp_get_attachment_image($image['image_id'], $image_size); ?>
                <?php endif; ?>
                <?php if ($image_behavior === 'lightbox' || $image_behavior === 'custom-link') { ?>
            </a>
        <?php } ?>
    </div>
</div>