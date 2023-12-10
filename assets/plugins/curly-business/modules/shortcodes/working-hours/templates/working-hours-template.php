<div <?php curly_mkdf_class_attribute($holder_classes); ?>>
    <div class="mkdf-wh-holder-inner">

        <?php if (!empty($title)) : ?>
            <?php echo '<' . esc_attr($title_tag); ?> class="mkdf-wh-title" <?php echo curly_mkdf_get_inline_style($title_styles); ?>>
            <?php echo wp_kses($title, array('span' => array('class' => true))); ?>
            <?php echo '</' . esc_attr($title_tag); ?>>
        <?php endif; ?>

        <?php if (is_array($working_hours) && count($working_hours)) : ?>
            <ul class="mkdf-wh-items">
                <?php foreach ($working_hours as $working_hour) : ?>
                    <li class="mkdf-wh-item clearfix">
                        <?php echo '<' . esc_attr($label_tag); ?> class="mkdf-wh-day">
                        <?php echo esc_html($working_hour['label']); ?>
                        <?php echo '</' . esc_attr($label_tag); ?>>
                        <?php echo '<' . esc_attr($time_tag); ?> class="mkdf-wh-hours">
                        <?php if (isset($working_hour['from']) && $working_hour['from'] !== '') : ?>
                            <span class="mkdf-wh-from"><?php echo esc_html($working_hour['from']); ?></span>
                        <?php endif; ?>
                        <?php if (isset($working_hour['to']) && $working_hour['to'] !== '') : ?>
                            <span class="mkdf-wh-delimiter">-</span>
                            <span class="mkdf-wh-to"><?php echo esc_html($working_hour['to']); ?></span>
                        <?php endif; ?>
                        <?php echo '</' . esc_attr($time_tag); ?>>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p><?php esc_html_e('Working hours are not set', 'curly-business'); ?></p>
        <?php endif; ?>

    </div>
</div>