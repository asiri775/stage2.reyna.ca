<?php if (curly_mkdf_options()->getOptionValue('enable_social_share') == 'yes' && curly_mkdf_options()->getOptionValue('enable_social_share_on_portfolio-item') == 'yes') : ?>
    <div class="mkdf-ps-info-item mkdf-ps-social-share">
        <?php echo curly_mkdf_get_social_share_html() ?>
    </div>
<?php endif; ?>