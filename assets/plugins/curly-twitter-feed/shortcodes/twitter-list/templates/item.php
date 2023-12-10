<li class="mkdf-tl-item mkdf-item-space">
    <div class="mkdf-tli-inner">
        <div class="mkdf-tli-content">
            <div class="mkdf-twitter-content-top">
                <div class="mkdf-twitter-user clearfix">
                    <div class="mkdf-twitter-image">
                        <img src="<?php echo esc_url($twitter_api->getHelper()->getTweetProfileImage($tweet)); ?>" alt="<?php esc_attr_e($twitter_api->getHelper()->getTweetProfileName($tweet)); ?>"/>
                    </div>
                    <div class="mkdf-twitter-name">
                        <div class="mkdf-twitter-autor">
                            <h5>
                                <?php echo esc_html($twitter_api->getHelper()->getTweetProfileName($tweet)); ?>
                            </h5>
                        </div>
                        <div class="mkdf-twitter-profile">
                            <a href="<?php echo esc_url($twitter_api->getHelper()->getTweetProfileURL($tweet)); ?>" target="_blank" itemprop="url">
                                <?php echo esc_html($twitter_api->getHelper()->getTweetProfileScreenName($tweet)); ?>
                            </a>
                        </div>
                    </div>
                </div>
                <i class="mkdf-twitter-icon social_twitter"></i>
            </div>
            <div class="mkdf-twitter-content-bottom">
                <div class="mkdf-tweet-text">
                    <?php echo wp_kses_post($twitter_api->getHelper()->getTweetText($tweet)); ?>
                </div>
            </div>
            <a class="mkdf-twitter-link-over" href="<?php echo esc_url($twitter_api->getHelper()->getTweetProfileURL($tweet)); ?>" target="_blank" itemprop="url"></a>
        </div>
    </div>
</li>