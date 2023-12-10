<?php
if ( isset( $items ) && count( $items ) ) {
	?>
	<<?php echo esc_attr( $list_tag ); ?> class="qodef-m-content">
		<?php
		foreach ( $items as $item ) {
			$classes   = array( 'qodef-e-item' );
			$classes[] = ( 'yes' === $item['item_excluded'] ) ? 'qodef--excluded' : '';
			?>
			<li <?php qi_addons_for_elementor_framework_class_attribute( $classes ); ?>>
				<?php if ( 'unordered' === $list_type && ! empty( $icon ) ) { ?>
					<span class="qodef-e-icon"><?php \Elementor\Icons_Manager::render_icon( $icon, array( 'aria-hidden' => 'true' ) ); ?></span>
				<?php } ?>
				<span class="qodef-e-text"><?php echo esc_html( $item['item_text'] ); ?></span>
			</li>
		<?php } ?>
	</<?php echo esc_attr( $list_tag ); ?>>
<?php } ?>
