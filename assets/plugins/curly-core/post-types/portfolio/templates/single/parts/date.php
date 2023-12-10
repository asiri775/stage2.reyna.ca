<?php if (curly_mkdf_options()->getOptionValue('portfolio_single_hide_date') === 'yes') : ?>
    <div class="mkdf-ps-info-item mkdf-ps-date">
        <h4 class="mkdf-ps-info-title"><?php esc_html_e('Date', 'curly-core'); ?></h4>
        <p itemprop="dateCreated" class="mkdf-ps-info-date entry-date updated"><?php the_time(get_option('date_format')); ?></p>
        <meta itemprop="interactionCount" content="UserComments: <?php echo get_comments_number(curly_mkdf_get_page_id()); ?>"/>
    </div>
<?php endif; ?>