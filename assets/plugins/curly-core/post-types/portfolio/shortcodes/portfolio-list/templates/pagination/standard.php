<?php if ($query_results->max_num_pages > 1) { ?>
    <div class="mkdf-pl-loading">
        <div class="mkdf-pl-loading-bounce1"></div>
        <div class="mkdf-pl-loading-bounce2"></div>
        <div class="mkdf-pl-loading-bounce3"></div>
    </div>
    <?php
    $pages = $query_results->max_num_pages;
    $paged = $query_results->query['paged'];

    if ($pages > 1) { ?>
        <div class="mkdf-pl-standard-pagination">
            <ul>
                <li class="mkdf-pl-pag-prev">
                    <a href="#" data-paged="1"><span class="fa fa-angle-left"></span></a>
                </li>
                <?php for ($i = 1; $i <= $pages; $i++) { ?>
                    <?php
                    $active_class = '';
                    if ($paged == $i) {
                        $active_class = 'mkdf-pl-pag-active';
                    }
                    ?>
                    <li class="mkdf-pl-pag-number <?php echo esc_attr($active_class); ?>">
                        <a href="#" data-paged="<?php echo esc_attr($i); ?>"><?php echo esc_html($i); ?></a>
                    </li>
                <?php } ?>
                <li class="mkdf-pl-pag-next">
                    <a href="#" data-paged="2"><span class="fa fa-angle-right"></span></a>
                </li>
            </ul>
        </div>
    <?php }
    ?>
<?php }