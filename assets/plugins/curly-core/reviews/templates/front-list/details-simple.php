<div class="mkdf-reviews-list-info mkdf-reviews-simple">
    <div class="mkdf-reviews-number-wrapper">
        <h4 class="mkdf-reviews-summary">
            <span class="mkdf-reviews-number">
                <?php echo esc_html($rating_number); ?>
            </span>
            <span class="mkdf-reviews-label">
                <?php echo esc_html($rating_label); ?>
            </span>
        </h4>
        <span class="mkdf-stars-wrapper">
            <?php foreach ($post_ratings as $rating) { ?>
                <span class="mkdf-stars-wrapper-inner">
                    <span class="mkdf-stars-items">
                        <?php
                        $review_rating = curly_core_post_average_rating($rating);
                        for ($i = 1; $i <= $review_rating; $i++) { ?>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        <?php } ?>
                    </span>
                    <span class="mkdf-stars-label">
                        <?php echo esc_html($rating['label']); ?>
                    </span>
                </span>
            <?php } ?>
        </span>
    </div>
</div>