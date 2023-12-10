<li>
    <div class="<?php echo esc_attr($comment_class); ?>">
        <?php if (!$is_pingback_comment) { ?>
            <div class="mkdf-comment-image"> <?php echo curly_mkdf_kses_img(get_avatar($comment, 'thumbnail')); ?> </div>
        <?php } ?>
        <div class="mkdf-comment-text">
            <div class="mkdf-comment-info">
                <h5 class="mkdf-comment-name vcard">
                    <?php echo wp_kses_post(get_comment_author_link()); ?>
                </h5>
                <div class="mkdf-review-rating">
                    <?php foreach ($rating_criteria as $rating) { ?>
                        <?php if (!isset($rating['show']) || (isset($rating['show']) && $rating['show'])) { ?>
                            <span class="mkdf-rating-inner">
                                <span class="mkdf-rating-label">
                                    <?php echo esc_html($rating['label']); ?>
                                </span>
                                <span class="mkdf-rating-value">
                                    <?php
                                    $review_rating = get_comment_meta($comment->comment_ID, $rating['key'], true);
                                    for ($i = 1; $i <= $review_rating; $i++) { ?>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    <?php } ?>
                                </span>
                            </span>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
            <?php if (!$is_pingback_comment) { ?>
                <div class="mkdf-text-holder" id="comment-<?php comment_ID(); ?>">
                    <div class="mkdf-review-title">
                        <span><?php echo esc_html($review_title); ?></span>
                    </div>
                    <?php comment_text(); ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <!-- li is closed by wordpress after comment rendering -->