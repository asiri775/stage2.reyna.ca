<div class="mkdf-core-dashboard wrap about-wrap">
	<div class="mkdf-cd-title-holder">
		<img class="mkdf-cd-logo" src="<?php echo  plugins_url( CURLY_CORE_REL_PATH . '/core-dashboard/assets/img/logo.png' ); ?>" alt="<?php esc_attr_e('Qode', 'curly-core') ?>" />
		<h1 class="mkdf-cd-title"><?php esc_html_e('Welcome to ', 'curly-core'); echo wp_get_theme()->Name;  ?></h1>
	</div>
	<h4 class="mkdf-cd-subtitle"><?php echo sprintf( esc_html__( 'Thank you for choosing %s. Now it\'s time to create something awesome.', 'curly-core' ), wp_get_theme()->Name ); ?></h4>
	<div class="mkdf-core-dashboard-inner">
		<div class="mkdf-core-dashboard-column">
			<div class="mkdf-core-dashboard-box mkdf-core-bottom-space">
				<div class="mkdf-cd-box-title-holder">
					<h2><?php esc_html_e('Registration', 'curly-core'); ?></h2>
					<?php if(!$is_activated) {  ?>
					<p><?php esc_html_e('Please input the purchase code you received with the theme as well as your email address in order to activate your copy of the theme.', 'curly-core'); ?></p>
					<?php } else { ?>
					<p><?php esc_html_e('You have successfully registered your copy of the theme! ', 'curly-core'); ?></p>
					<?php } ?>
				</div>
				<div class="mkdf-cd-box-inner">
					<form method="post" action="" id="mkdf-register-purchase-form">
						<?php if(!$is_activated) { ?>
							<div class="mkdf-cd-box-section mkdf-activation-holder" >
								<h3><?php esc_html_e('Register your theme', 'curly-core'); ?></h3>
								<div class="mkdf-cd-field-holder" data-empty-field = "<?php esc_html_e('Field is empty', 'curly-core'); ?>" >
									<label class="mkdf-cd-label"><?php esc_html_e('Purchase Code', 'curly-core'); ?></label>
									<input type="text" name="purchase_code" class="mkdf-cd-input mkdf-cd-required" required>
								</div>
								<div class="mkdf-cd-field-holder" data-empty-field = "<?php esc_html_e('Field is empty', 'curly-core'); ?>" data-invalid-field = "<?php esc_html_e('Email is not valid', 'curly-core'); ?>">
									<label class="mkdf-cd-label"><?php esc_html_e('Email', 'curly-core'); ?></label>
									<input type="text" name="email" class="mkdf-cd-input mkdf-cd-required" required>
								</div>
								<div class="mkdf-cd-field-holder">
									<input type="submit" class="mkdf-cd-button" value="<?php esc_attr_e('Register Theme', 'curly-core'); ?>" name="check" id="mkdf-register-purchase-key" />
									<span class="mkdf-cd-button-wait"><?php esc_attr_e('Please Wait...', 'curly-core'); ?></span>
								</div>
							</div>
						<?php } else { ?>
							<div class="mkdf-cd-box-section mkdf-deactivation-holder">
								<h3><?php esc_html_e('Deregister your theme', 'curly-core'); ?></h3>
								<div class="mkdf-cd-field-holder">
									<label class="mkdf-cd-label"><?php esc_html_e('Purchase Code', 'curly-core'); ?></label>
									<input type="text" name="text" class="mkdf-cd-input mkdf-cd-required" value="<?php echo $info['purchase_code']; ?>" disabled>
								</div>
								<div class="mkdf-cd-field-holder">
									<input type="submit" class="mkdf-cd-button" value="<?php esc_attr_e('Deregister Theme', 'curly-core'); ?>" name="check" id="mkdf-deregister-purchase-key" />
									<span class="mkdf-cd-button-wait"><?php esc_attr_e('Please Wait...', 'curly-core'); ?></span>
								</div>
							</div>
						<?php } ?>
						<div class="message"></div>
					</form>
				</div>
			</div>
			<div class="mkdf-core-dashboard-box">
				<div class="mkdf-cd-box-title-holder">
					<h2><?php esc_html_e('System Information', 'curly-core'); ?></h2>
					<p><?php esc_html_e('Here is an overview of your current server configuration info.', 'curly-core'); ?></p>
				</div>
				<div class="mkdf-cd-box-inner">
					<?php foreach ($system_info as $system_info_key => $system_info_value):
						$class = (isset($system_info_value['pass']) && !$system_info_value['pass']) ? 'mkdf-cdb-value-false' : '';
						?>
						<div class="mkdf-cd-box-row">
							<div class="mkdf-cdb-label"><?php echo esc_attr($system_info_value['title']); ?></div>
							<div class="mkdf-cdb-value <?php echo esc_attr($class); ?>"><span><?php echo wp_kses_post($system_info_value['value']); ?></span>
								<?php if(isset($system_info_value['notice']) && (isset($system_info_value['pass']) && !$system_info_value['pass'])){ ?>
									<?php echo esc_html($system_info_value['notice']); ?>
								<?php } ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<div class="mkdf-core-dashboard-column mkdf-cd-smaller-column">
			<div class="mkdf-core-dashboard-box">
				<div class="mkdf-cd-box-title-holder">
					<h2><?php esc_html_e('Useful links', 'curly-core'); ?></h2>
				</div>

				<div class="mkdf-cd-box-inner">
					<ul class="mkdf-cd-box-list">
						<li><a href="<?php echo sprintf('http://curly.%s-themes.com/documentation/', MIKADO_PROFILE_SLUG ); ?>" target="_blank"><?php esc_html_e( 'Theme Documentation', 'curly-core' ); ?></a></li>
						<li><a href="https://helpcenter.qodeinteractive.com" target="_blank"><?php esc_html_e('Support center', 'curly-core'); ?></a></li>
						<li><a href="https://www.youtube.com/QodeInteractiveVideos" target="_blank"><?php esc_html_e('Video tutorials', 'curly-core'); ?></a></li>
						<li><a href="https://qodeinteractive.com" target="_blank"><?php esc_html_e('Qode Interactive themes', 'curly-core'); ?></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>