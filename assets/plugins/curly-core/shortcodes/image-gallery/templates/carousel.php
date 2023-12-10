<?php
$i = 0;
$rand = rand(0, 1000);
?>
<div class="mkdf-image-gallery <?php echo esc_attr($holder_classes); ?>">
    <div class="mkdf-ig-slider mkdf-owl-slider" <?php echo curly_mkdf_get_inline_attrs($slider_data); ?>>
        <?php foreach ($images as $image) { ?>
            <div class="mkdf-ig-image">
                <?php if ($image_behavior === 'lightbox') { ?>
                <a itemprop="image" class="mkdf-ig-lightbox mkdf-block-drag-link" href="<?php echo esc_url($image['url']); ?>" data-rel="prettyPhoto[image_gallery_pretty_photo-<?php echo esc_attr($rand); ?>]" title="<?php echo esc_attr($image['title']); ?>">
                    <?php } else if ($image_behavior === 'custom-link' && !empty($custom_links)) { ?>
                    <a itemprop="url" class="mkdf-ig-custom-link mkdf-block-drag-link" href="<?php echo esc_url($custom_links[$i++]); ?>" target="<?php echo esc_attr($custom_link_target); ?>" title="<?php echo esc_attr($image['title']); ?>">
                        <?php } ?>
                        <?php if (is_array($image_size) && count($image_size)) :
                            echo curly_mkdf_generate_thumbnail($image['image_id'], null, $image_size[0], $image_size[1]);
                        else:
                            echo wp_get_attachment_image($image['image_id'], $image_size);
                        endif; ?>
                        <?php if ($image_behavior === 'lightbox' || $image_behavior === 'custom-link') { ?>
                    </a>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>