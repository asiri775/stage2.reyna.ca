<div class="mkdf-reviews-list-info mkdf-reviews-per-mark">
    <?php foreach ($post_ratings as $rating) { ?>
        <?php
        $average_rating = curly_core_post_average_rating($rating);
        $rating_count = $rating['count'];
        $rating_count_label = $rating_count === 1 ? esc_html__('Rating', 'curly-core') : esc_html__('Ratings', 'curly-core');
        $rating_marks = $rating['marks'];
        ?>
        <div class="mkdf-grid-row">
            <div class="mkdf-grid-col-4">
                <div class="mkdf-reviews-number-wrapper">
                    <span class="mkdf-reviews-number"><?php echo esc_html($average_rating); ?></span>
                    <span class="mkdf-stars-wrapper">
                        <span class="mkdf-stars">
                            <?php
                            for ($i = 1; $i <= $average_rating; $i++) { ?>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            <?php } ?>
                        </span>
                        <span class="mkdf-reviews-count">
                            <?php echo esc_html__('Rated', 'curly-core') . ' ' . $average_rating . ' ' . esc_html__('out of', 'curly-core') . ' ' . $rating_count . ' ' . $rating_count_label; ?>
                        </span>
                    </span>
                </div>
            </div>
            <div class="mkdf-grid-col-8">
                <div class="mkdf-rating-percentage-wrapper">
                    <?php
                    foreach ($rating_marks as $item => $value) {
                        $percentage = $rating_count == 0 ? 0 : round(($value / $rating_count) * 100);
                        echo do_shortcode('[mkdf_progress_bar percent="' . $percentage . '" title="' . $item . esc_attr__(' stars', 'curly-core') . '"]');
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
