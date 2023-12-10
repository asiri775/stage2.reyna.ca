<?php if(!CurlyCoreImport::get_instance()->is_ready_to_import()): ?>
<div class="mkdf-cdb-problem">
	<p><?php esc_html_e('Please note that your server resources are not configured properly so you might run into an issue during the demo import process. Please adjust your server configuration values. ', 'curly-core'); ?></p>
</div>
<?php endif; ?>