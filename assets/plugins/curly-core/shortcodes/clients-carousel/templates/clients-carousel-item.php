<div class="mkdf-cc-item">
    <?php if (!empty($link)) { ?>
    <a itemprop="url" class="mkdf-cc-link mkdf-block-drag-link" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>">
        <?php } ?>
        <?php if (!empty($image)) { ?>
            <img itemprop="image" class="mkdf-cc-image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"/>
        <?php } ?>
        <?php if (!empty($hover_image)) { ?>
            <img itemprop="image" class="mkdf-cc-hover-image" src="<?php echo esc_url($hover_image['url']); ?>" alt="<?php echo esc_attr($hover_image['alt']); ?>"/>
        <?php } ?>
        <?php if (!empty($link)) { ?>
    </a>
<?php } ?>
</div>