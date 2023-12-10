<div class="mkdf-price-table mkdf-item-space <?php echo esc_attr($holder_classes); ?>">
    <div class="mkdf-pt-inner">
        <ul>
            <li class="mkdf-pt-title-holder">
                <var class="mkdf-pt-title"><?php echo esc_html($title); ?></var>
            </li>
            <li class="mkdf-pt-prices">
                <h2 class="mkdf-pt-price"><?php echo esc_html($currency); ?><?php echo esc_html($price); ?><span>,<?php echo esc_html($price_decimal); ?></span></h2>
                <h5 class="mkdf-pt-period"><?php echo esc_html($price_period); ?></h5>
            </li>
            <li class="mkdf-pt-content">
                <?php echo do_shortcode($content); ?>
            </li>
            <?php
            if (!empty($link_text)) : ?>
                <li class="mkdf-pt-button">
                    <?php echo curly_mkdf_get_button_html($button_params); ?>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>