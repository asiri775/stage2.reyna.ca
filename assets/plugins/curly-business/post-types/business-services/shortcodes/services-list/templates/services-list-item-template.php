<?php
$price = get_post_meta(get_the_ID(), 'business_services_item_price', true);
$description = get_post_meta(get_the_ID(), 'business_services_item_description', true);
$label = get_post_meta(get_the_ID(), 'business_services_item_label', true);
?>
<li class="mkdf-bsl-item clearfix">
    <?php if ($show_featured_image === 'yes') : ?>
        <div class="mkdf-bsl-item-image">
            <a href="<?php echo esc_url(wp_get_attachment_url(get_post_thumbnail_id())); ?>" data-rel="prettyPhoto<?php echo esc_attr(get_the_ID()); ?>">
                <?php the_post_thumbnail('thumbnail'); ?>
            </a>
        </div>
    <?php endif; ?>
    <div class="mkdf-bsl-item-content">
        <div class="mkdf-bsl-item-top-holder">
            <div class="mkdf-bsl-item-title-holder">
                <h4 class="mkdf-bsl-item-title">
                    <?php esc_html(the_title()); ?>
                </h4>
            </div>
            <div class="mkdf-bsl-item-line"></div>

            <?php if (!empty($price)) : ?>
                <div class="mkdf-bsl-item-price-holder">
                    <span class="mkdf-bsl-price"><?php echo esc_html($price); ?></span>
                </div>
            <?php endif; ?>
        </div>
        <div class="mkdf-bsl-item-bottom-holder clearfix">
            <?php if (!empty($description)) : ?>
                <div class="mkdf-bsl-item-description-holder">
                    <?php echo esc_html($description); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($label)) : ?>
                <div class="mkdf-bsl-item-label-holder">
                    <span class="mkdf-bsl-item-label"><?php echo esc_html($label); ?></span>
                </div>
            <?php endif; ?>
        </div>
    </div>
</li>