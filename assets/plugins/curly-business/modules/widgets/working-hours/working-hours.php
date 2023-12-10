<?php
if ( class_exists( 'CurlyCoreClassWidget' ) ) {
	
	class CurlyBusinessWorkingHours extends CurlyCoreClassWidget {
		public function __construct() {
			parent::__construct(
				'curly_business_working_hours',
				esc_html__( 'Curly Working Hours', 'curly-business' ),
				array( 'description' => esc_html__( 'Add Working Hours to widget areas', 'curly-business' ) )
			);
			
			$this->setParams();
		}
		
		protected function setParams() {
			$this->params = array(
				array(
					'type'  => 'textfield',
					'name'  => 'extra_class',
					'title' => esc_html__( 'Extra Class Name', 'curly-business' )
				),
				array(
					'type'        => 'textfield',
					'name'        => 'widget_width',
					'title'       => esc_html__( 'Widget Width', 'curly-business' ),
					'description' => esc_html__( 'For example: 80%', 'curly-business' ),
				),
				array(
					'type'  => 'textfield',
					'name'  => 'widget_title',
					'title' => esc_html__( 'Widget Title', 'curly-business' )
				),
				array(
					'type'    => 'dropdown',
					'name'    => 'label_tag',
					'title'   => esc_html__( 'Label Tag', 'curly-business' ),
					'options' => curly_mkdf_get_title_tag( true, array( 'p' => 'p' ) )
				),
				array(
					'type'    => 'dropdown',
					'name'    => 'time_tag',
					'title'   => esc_html__( 'Time Tag', 'curly-business' ),
					'options' => curly_mkdf_get_title_tag( true, array( 'p' => 'p' ) )
				),
			);
		}
		
		public function widget( $args, $instance ) {
			$extra_class = ! empty( $instance['extra_class'] ) ? esc_attr( $instance['extra_class'] ) : '';
			if ( empty( $instance['label_tag'] ) ) {
				$instance['label_tag'] = 'p';
			}
			if ( empty( $instance['time_tag'] ) ) {
				$instance['time_tag'] = 'p';
			}
			if ( empty( $instance['widget_width'] ) ) {
				$instance['widget_width'] = '100%';
			}
			?>
			
			<div class="widget mkdf-working-hours-widget <?php echo esc_attr( $extra_class ); ?>">
				<?php if ( ! empty( $instance['widget_title'] ) ) {
					echo wp_kses_post( $args['before_title'] ) . esc_html( $instance['widget_title'] ) . wp_kses_post( $args['after_title'] );
				} ?>
				<div class="mkdf-wh-wrapper" style="width: <?php echo esc_attr( $instance['widget_width'] ); ?>">
					<?php
					echo do_shortcode( '[mkdf_working_hours label_tag="' . esc_attr( $instance['label_tag'] ) . '" time_tag="' . esc_attr( $instance['time_tag'] ) . '"]' );
					?>
				</div>
			</div>
		<?php }
	}
}