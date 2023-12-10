<?php if (is_array($post_ratings) && count($post_ratings)) { ?>
    <?php $average_rating_total = curly_core_get_total_average_rating($post_ratings); ?>
    <div class="mkdf-reviews-list-info mkdf-reviews-per-criteria">
        <div class="mkdf-item-reviews-display-wrapper clearfix">
            <?php if (!empty($title)) { ?>
                <h3 class="mkdf-item-review-title"><?php echo esc_html($title); ?></h3>
            <?php } ?>

            <?php if (!empty($subtitle)) { ?>
                <p class="mkdf-item-review-subtitle"><?php echo esc_html($subtitle); ?></p>
            <?php } ?>

            <div class="mkdf-grid-row">
                <div class="mkdf-grid-col-3">
                    <div class="mkdf-item-reviews-average-wrapper">
                        <div class="mkdf-item-reviews-average-rating">
                            <?php echo esc_html(curly_core_reviews_format_rating_output($average_rating_total)); ?>
                        </div>
                        <div class="mkdf-item-reviews-verbal-description">
                            <span class="mkdf-item-reviews-rating-icon">
                                <?php echo curly_core_reviews_get_icon_for_rating($average_rating_total); ?>
                            </span>
                            <span class="mkdf-item-reviews-rating-description">
                                <?php echo esc_html(curly_core_reviews_get_description_for_rating($average_rating_total)); ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="mkdf-grid-col-9">
                    <div class="mkdf-rating-percentage-wrapper">
                        <?php
                        foreach ($post_ratings as $rating) {
                            $percentage = curly_core_post_average_rating_per_criteria($rating);
                            echo do_shortcode('[mkdf_progress_bar percent="' . $percentage . '" title="' . $rating['label'] . '"]');
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }