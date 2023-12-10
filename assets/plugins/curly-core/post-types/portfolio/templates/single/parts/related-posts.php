<?php
$show_related_posts = curly_mkdf_options()->getOptionValue('portfolio_single_related_posts') == 'yes' ? true : false;
$post_id = get_the_ID();
$related_posts = curly_core_get_portfolio_single_related_posts($post_id);
?>
<?php if ($show_related_posts) { ?>
    <div class="mkdf-ps-related-posts-holder">

        <div class="mkdf-ps-related-title-holder">
            <h4 class="mkdf-ps-related-title"><?php esc_html_e('More Works', 'curly-core'); ?></h4>
        </div>

        <div class="mkdf-ps-related-posts">
            <?php
            if ($related_posts && $related_posts->have_posts()) :
                while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                    <div class="mkdf-psr-post">

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="mkdf-psr-image">
                                <a itemprop="url" href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('full'); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="mkdf-psr-text">
                            <h4 itemprop="name" class="mkdf-psr-title entry-title">
                                <a itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h4>
                            <?php $categories = wp_get_post_terms($post_id, 'portfolio-category'); ?>
                            <?php if (!empty($categories)) : ?>
                                <div class="mkdf-psr-categories">
                                    <?php foreach ($categories as $cat) : ?>
                                        <a itemprop="url" class="mkdf-psr-category" href="<?php echo esc_url(get_term_link($cat->term_id)); ?>"><?php echo esc_html($cat->name); ?></a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>


                    </div>
                    <?php
                endwhile;
            endif;

            wp_reset_postdata();
            ?>
        </div>
    </div>
<?php } ?>
