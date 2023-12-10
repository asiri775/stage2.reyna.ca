<div class="mkdf-twitter-list-holder <?php echo esc_attr($holder_classes); ?>">
    <div class="mkdf-tl-wrapper mkdf-outer-space">
        <?php if (isset($response) && $response->status) { ?>
            <?php if (is_array($response->data) && count($response->data)) { ?>
                <ul class="mkdf-twitter-list">
                    <?php foreach ($response->data as $tweet) { ?>
                        <?php
                        $params['tweet'] = $tweet;
                        echo curly_twitter_get_shortcode_module_template_part('templates/item', 'twitter-list', '', $params);
                        ?>
                    <?php } ?>
                </ul>
            <?php } else { ?>
                <div class="mkdf-twitter-message">
                    <?php echo esc_html($response->message); ?>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="mkdf-twitter-not-connected">
                <?php esc_html_e('It seams that you haven\'t connected with your Twitter account', 'curly-twitter-feed'); ?>
            </div>
        <?php } ?>
    </div>
</div>