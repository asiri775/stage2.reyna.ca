<?php
get_header();
curly_mkdf_get_title();
do_action('curly_mkdf_before_main_content'); ?>
<div class="mkdf-container mkdf-default-page-template">
    <?php do_action('curly_mkdf_after_container_open'); ?>
    <div class="mkdf-container-inner clearfix">
        <?php
        $curly_taxonomy_id = get_queried_object_id();
        $curly_taxonomy_type = is_tax('portfolio-tag') ? 'portfolio-tag' : 'portfolio-category';
        $curly_taxonomy = !empty($curly_taxonomy_id) ? get_term_by('id', $curly_taxonomy_id, $curly_taxonomy_type) : '';
        $curly_taxonomy_slug = !empty($curly_taxonomy) ? $curly_taxonomy->slug : '';
        $curly_taxonomy_name = !empty($curly_taxonomy) ? $curly_taxonomy->taxonomy : '';

        curly_core_get_archive_portfolio_list($curly_taxonomy_slug, $curly_taxonomy_name);
        ?>
    </div>
    <?php do_action('curly_mkdf_before_container_close'); ?>
</div>
<?php get_footer(); ?>
