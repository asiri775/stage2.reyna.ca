<div class="mkdf-pie-chart-holder <?php echo esc_attr($holder_classes); ?>">
    <div class="mkdf-pc-percentage" <?php echo curly_mkdf_get_inline_attrs($pie_chart_data); ?>>
        <span class="mkdf-pc-percent" <?php echo curly_mkdf_get_inline_style($percent_styles); ?>><?php echo esc_html($percent); ?></span>
    </div>
    <?php if (!empty($title) || !empty($text)) { ?>
    <div class="mkdf-pc-text-holder">
        <?php if (!empty($title)) { ?>
        <<?php echo esc_attr($title_tag); ?> class="mkdf-pc-title" <?php echo curly_mkdf_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
<?php } ?>
    <?php if (!empty($text)) { ?>
        <p class="mkdf-pc-text" <?php echo curly_mkdf_get_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
    <?php } ?>
</div>
<?php } ?>
</div>