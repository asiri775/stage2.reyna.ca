<?php
$portfolio_single_navigation = curly_mkdf_options()->getOptionValue('portfolio_single_hide_pagination') !== 'yes' ? true : false;
$portfolio_nav_same_category = curly_mkdf_options()->getOptionValue('portfolio_single_nav_same_category') == 'yes';
$back_to_link = get_post_meta(get_the_ID(), 'portfolio_single_back_to_link', true);
?>

<?php

?>


<?php if ($portfolio_single_navigation) : ?>
    <div class="mkdf-portfolio-single-navigation">

        <div class="mkdf-portfolio-single-prev">

            <?php if (get_previous_post() !== '') : ?>

                <?php
                $previous_post_link = '<span class="mkdf-arrow"></span>';
                $previous_post_link .= '<h4 class="mkdf-title">' . get_previous_post()->post_title . '</h4>';
                $previous_post_link .= '<h5 class="mkdf-label">' . esc_html__('Previous', 'curly') . '</h5>';
                ?>

                <?php if ($portfolio_nav_same_category) {
                    previous_post_link('%link', "$previous_post_link", true, '', 'portfolio-category');
                } else {
                    previous_post_link('%link', "$previous_post_link");
                } ?>
            <?php endif; ?>

        </div>

        <?php if ($back_to_link !== '') : ?>
            <div class="mkdf-portfolio-single-back">
                <a itemprop="url" href="<?php echo esc_url(get_permalink($back_to_link)); ?>">
                    <span class="fa fa-ellipsis-h"></span>
                </a>
            </div>
        <?php endif; ?>

        <div class="mkdf-portfolio-single-next">

            <?php if (get_next_post() !== '') : ?>

                <?php
                $next_post_link = '<h4 class="mkdf-title">' . get_next_post()->post_title . '</h4>';
                $next_post_link .= '<h5 class="mkdf-label">' . esc_html__('Next', 'curly') . '</h5>';
                $next_post_link .= '<span class="mkdf-arrow"></span>';
                ?>


                <?php if ($portfolio_nav_same_category) {
                    next_post_link('%link', "$next_post_link", true, '', 'portfolio-category');
                } else {
                    next_post_link('%link', "$next_post_link");
                } ?>
            <?php endif; ?>

        </div>

    </div>
<?php endif; ?>