<div class="mkdf-banner-holder <?php echo esc_attr($holder_classes); ?>">

    <div class="mkdf-banner-text-holder">
        <div class="mkdf-banner-text-outer">
            <div class="mkdf-banner-text-inner">

                <?php if (!empty($tagline)) : ?>
                    <?php echo '<' . esc_attr($tagline_tag); ?> class="mkdf-banner-tagline">
                    <?php echo esc_html($tagline); ?>
                    <?php echo '</' . esc_attr($tagline_tag); ?>>
                <?php endif; ?>

                <?php if (!empty($title)) : ?>
                    <?php echo '<' . esc_attr($title_tag); ?> class="mkdf-banner-title">
                    <?php echo esc_html($title); ?>
                    <?php echo '</' . esc_attr($title_tag); ?>>
                <?php endif; ?>

                <?php if (!empty($subtitle)) : ?>
                    <?php echo '<' . esc_attr($subtitle_tag); ?> class="mkdf-banner-subtitle">
                    <?php echo esc_html($subtitle); ?>
                    <?php echo '</' . esc_attr($subtitle_tag); ?>>
                <?php endif; ?>


                <?php if (!empty($link) && !empty($link_text)) : ?>
                    <div class="mkdf-banner-button"><?php echo curly_mkdf_get_button_html($button_params); ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if (!empty($link)) { ?>
        <a itemprop="url" class="mkdf-banner-link" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($link_target); ?>"></a>
    <?php } ?>

</div>