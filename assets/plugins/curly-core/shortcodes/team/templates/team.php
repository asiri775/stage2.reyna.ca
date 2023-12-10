<div class="mkdf-team-holder <?php echo esc_attr($holder_classes); ?>">
    <div class="mkdf-team-inner">

        <?php if ($team_image !== '') : ?>
            <div class="mkdf-team-image">
                <?php echo wp_get_attachment_image($team_image, 'full'); ?>
            </div>
        <?php endif; ?>

        <div class="mkdf-team-info">

            <?php if ($team_name !== '') : ?>
                <?php echo '<' . esc_attr($team_name_tag); ?> class="mkdf-team-name">
                <?php echo esc_html($team_name); ?>
                <?php echo '</' . esc_attr($team_name_tag); ?>>
            <?php endif; ?>

            <?php if ($team_position !== "") : ?>
                <h5 class="mkdf-team-position">
                    <?php echo esc_html($team_position); ?>
                </h5>
            <?php endif; ?>

            <?php if ($team_text !== "") : ?>
                <p class="mkdf-team-text">
                    <?php echo esc_html($team_text); ?>
                </p>
            <?php endif; ?>

            <?php if (!empty($team_social_icons)) : ?>
                <div class="mkdf-social-share-holder mkdf-list">
                    <ul>
                        <?php foreach ($team_social_icons as $team_social_icon) : ?>
                            <li class="mkdf-team-icon"><?php echo wp_kses_post($team_social_icon); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

        </div>

    </div>
</div>