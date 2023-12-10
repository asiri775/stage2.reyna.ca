<div class="mkdf-testimonials-holder clearfix <?php echo esc_attr($holder_classes); ?>">

    <?php if (!empty($background_text)) : ?>
        <?php echo '<' . esc_attr($background_text_tag); ?> class="mkdf-testimonials-background-text" <?php echo curly_mkdf_get_inline_style($background_text_styles); ?>>
        <?php echo esc_html($background_text) ?>
        <?php echo '</' . esc_attr($background_text_tag); ?>>
    <?php endif; ?>

    <div class="mkdf-testimonials-mark">&#8221;</div>
    <div class="mkdf-testimonials mkdf-owl-slider" <?php echo curly_mkdf_get_inline_attrs($data_attr) ?>>

        <?php if ($query_results->have_posts()):
            while ($query_results->have_posts()) : $query_results->the_post();
                $title = get_post_meta(get_the_ID(), 'mkdf_testimonial_title', true);
                $text = get_post_meta(get_the_ID(), 'mkdf_testimonial_text', true);
                $author = get_post_meta(get_the_ID(), 'mkdf_testimonial_author', true);
                $position = get_post_meta(get_the_ID(), 'mkdf_testimonial_author_position', true);

                $current_id = get_the_ID();
                ?>

                <div class="mkdf-testimonial-content" id="mkdf-testimonials-<?php echo esc_attr($current_id) ?>">
                    <div class="mkdf-testimonial-text-holder">

                        <?php if (!empty($title)) : ?>
                            <h2 itemprop="name" class="mkdf-testimonial-title entry-title"><?php echo esc_html($title); ?></h2>
                        <?php endif; ?>

                        <?php if (!empty($text)) : ?>
                            <h6 class="mkdf-testimonial-text"><?php echo esc_html($text); ?></h6>
                        <?php endif; ?>

                        <?php if (!empty($author)) : ?>
                            <h5 class="mkdf-testimonial-author">
                                <span class="mkdf-testimonials-author-name"><?php echo esc_html($author); ?></span>
                                <?php if (!empty($position)) : ?>
                                    <span class="mkdf-testimonials-author-job"> &#x25CF; <?php echo esc_html($position); ?></span>
                                <?php endif; ?>
                            </h5>
                        <?php endif; ?>

                    </div>
                </div>

                <?php
            endwhile;
        else:
            echo esc_html__('Sorry, no posts matched your criteria.', 'curly-core');
        endif;

        wp_reset_postdata();
        ?>

    </div>
</div>