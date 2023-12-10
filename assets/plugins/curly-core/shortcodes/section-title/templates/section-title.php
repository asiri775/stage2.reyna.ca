<div class="mkdf-section-title-holder <?php echo esc_attr($holder_classes); ?>" <?php echo curly_mkdf_get_inline_style($holder_styles); ?>>
    <div class="mkdf-st-inner">

        <?php if (!empty($background_text)) : ?>
            <?php echo '<' . esc_attr($background_text_tag); ?> class="mkdf-st-background-text" <?php echo curly_mkdf_get_inline_style($background_text_styles); ?> id="mkdf-st-background-text-<?php echo rand(0, 1000); ?>" <?php echo curly_mkdf_get_inline_attrs($data_atts); ?>>
            <?php echo wp_kses($background_text, array('br' => true, 'span' => array('class' => true))); ?>
            <?php echo '</' . esc_attr($background_text_tag); ?>>
        <?php endif; ?>

        <?php if (!empty($title)) : ?>
            <?php echo '<' . esc_attr($title_tag); ?> class="mkdf-st-title">
            <?php echo wp_kses($title, array('br' => true, 'span' => array('class' => true))); ?>
            <?php echo '</' . esc_attr($title_tag); ?>>
        <?php endif; ?>

        <?php if (!empty($text)) : ?>
            <?php echo '<' . esc_attr($text_tag); ?> class="mkdf-st-text">
            <?php echo wp_kses($text, array('br' => true)); ?>
            <?php echo '</' . esc_attr($text_tag); ?>>
        <?php endif; ?>

    </div>
</div>