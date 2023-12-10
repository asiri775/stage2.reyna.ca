<div class="mkdf-image-with-text-holder <?php echo esc_attr($holder_classes); ?>">
    <div class="mkdf-iwt-image">
        <?php if ($image_behavior === 'lightbox') { ?>
        <a itemprop="image" href="<?php echo esc_url($image['url']); ?>" data-rel="prettyPhoto[iwt_pretty_photo]" title="<?php echo esc_attr($image['alt']); ?>">
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
    <div class="mkdf-iwt-text-holder">
        <div class="mkdf-iwt-text-holder-inner">
            <?php if (!empty($title)) { ?>
                <<?php echo esc_attr($title_tag); ?> class="mkdf-iwt-title" <?php echo curly_mkdf_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
            <?php } ?>
            <?php if (!empty($text)) { ?>
                <p class="mkdf-iwt-text" <?php echo curly_mkdf_get_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
            <?php } ?>
        </div>
        <?php if(!empty($bottom_buttons) && $bottom_buttons == 'yes') { ?>
            <dvi class="mkdf-iwt-bottom-buttons-holder">
                <?php if( ! empty( $bottom_button_one_link ) ) { ?>
                    <<?php echo esc_attr($title_tag); ?> class="mkdf-iwt-bottom-link mkdf-iwt-first-link" <?php echo curly_mkdf_get_inline_style($bottom_styles); ?>>
                        <a itemprop="url" href="<?php echo esc_url($bottom_button_one_link); ?>" target="<?php echo esc_attr($custom_link_target); ?>">
                            <?php if( ! empty( $bottom_button_one_label ) ) { ?>
                                <span class="mkdf-iwt-bottom-text"><?php echo esc_html($bottom_button_one_label); ?></span>
                            <?php } ?>
                        </a>
                    </<?php echo esc_attr($title_tag); ?>>
                <?php } ?>
                <?php if( ! empty( $bottom_button_two_link ) ) { ?>
                    <<?php echo esc_attr($title_tag); ?> class="mkdf-iwt-bottom-link mkdf-iwt-first-link" <?php echo curly_mkdf_get_inline_style($bottom_styles); ?>>
                        <a itemprop="url" href="<?php echo esc_url($bottom_button_two_link); ?>" target="<?php echo esc_attr($custom_link_target); ?>">
                            <?php if( ! empty( $bottom_button_two_label ) ) { ?>
                                <span class="mkdf-iwt-bottom-text"><?php echo esc_html($bottom_button_two_label); ?></span>
                            <?php } ?>
                        </a>
                    </<?php echo esc_attr($title_tag); ?>>
                <?php } ?>
            </dvi>
        <?php } ?>
    </div>
</div>