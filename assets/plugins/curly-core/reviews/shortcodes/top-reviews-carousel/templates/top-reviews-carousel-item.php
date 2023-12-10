<div class="mkdf-top-reviews-carousel-item">
    <h4 class="mkdf-top-reviews-item-title">
        <a href="<?php echo esc_url($post_link); ?>"><?php echo esc_html($post_title); ?></a>
    </h4>

    <div class="mkdf-tour-reviews-criteria-holder">
        <div class="mkdf-tour-reviews-criteria-holder-inner">
            <?php if (isset($review_value)) { ?>
                <span class="mkdf-tour-reviews-rating-holder">
                    <?php for ($i = 0; $i < CURLY_CORE_REVIEWS_MAX_RATING; $i++) : ?>
                        <?php
                        $is_empty_star = $i >= $review_value;
                        $star_class = $is_empty_star ? 'icon_star_alt' : 'icon_star';
                        ?>
                        <span class="mkdf-tour-reviews-star-holder">
                            <span class="mkdf-tour-reviews-star <?php echo esc_attr($star_class); ?>"></span>
                        </span>
                    <?php endfor; ?>
                </span>
            <?php } ?>
        </div>
    </div>

    <div class="mkdf-top-reviews-item-content">
        <?php echo esc_html($comment_text); ?>
    </div>

    <div class="mkdf-top-reviews-item-author-info">
        <span class="mkdf-top-reviews-item-author-avatar">
            <?php echo get_avatar($auhtor_email, 54); ?>
        </span>
        <h5 class="mkdf-top-reviews-item-author-name">
            <?php echo get_comment_author_link($comment_id); ?>
        </h5>
    </div>
</div>