<label class="mkdf-cd-label"><?php esc_html_e('Select Page To Import', 'curly-core'); ?></label>
<select name="import_single_page" id="import_single_page"  class="mkdf-cd-import-single-page">
	<?php
	foreach ($pages as $page => $page_value){ ?>
		<option value="<?php echo esc_attr($page); ?>"><?php echo esc_attr($page_value); ?></option>
	<?php }
	?>
</select>