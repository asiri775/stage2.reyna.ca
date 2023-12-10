<?php

class QodeFrameworkElementorTranslator {
	private static $instance;

	public function __construct() {

	}

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	function create_output($shortcodes) {

        $default_functions = array(
            '__construct',
            'getBase',
            'vcMap',
            'render',
        );


        foreach ( $shortcodes as $shortcode ) {

            $shortcode_object = vc_get_shortcode( $shortcode->getBase() );

            if(isset($shortcode_object['as_child'])){
                continue;
            }

            $reflector = new \ReflectionClass($shortcode);
            $func = new \ReflectionMethod($shortcode, 'render');

            $filename = $func->getFileName();
            $start_line = $func->getStartLine(); // it's actually - 1, otherwise you wont get the function() block
            $end_line = $func->getEndLine() - 1;
            $length = $end_line - $start_line;

            $source = file($filename);
            $render_body = implode('', array_slice($source, $start_line, $length));
            $render_body = str_replace('return', 'echo', $render_body);

            $output_body = preg_replace('/(array\(.*?\);)/s', '', $render_body);
            $output_body = preg_replace('/^.*shortcode_atts/s', 'shortcode_atts', $output_body);
            $output_body = preg_replace('/(shortcode_atts\(.*?\);)/s', '', $output_body);

            $pattern = '/\s*/m';
            $replace = '';
            $removedLinebaksAndWhitespace = preg_replace( $pattern, $replace,$render_body);

            preg_match_all('/(array\(.*?\);)/', $removedLinebaksAndWhitespace, $match);
            $removed_array_from_string =  str_replace(');', '', str_replace('array(', '',$match[0][0]));

           $string_to_array = explode ( ',', $removed_array_from_string);
           $formatted_array =array();
           foreach ($string_to_array as $m) {
               $o = explode('=>', $m);
               $formatted_array[str_replace(array("'", "\""), '',$o[0])] = str_replace(array("'", "\""), '',$o[1]);

           }

            preg_match_all('/function (\w+)/', file_get_contents($filename), $m);

            $functions_to_print = array_diff($m[1], $default_functions);

            $add_functions = '';

            foreach ($functions_to_print as $funciton_to_print) {
                $func = new \ReflectionMethod($shortcode, $funciton_to_print);
                $filename = $func->getFileName();
                $start_line = $func->getStartLine() - 1;
                $end_line = $func->getEndLine();
                $length = $end_line - $start_line;

                $source = file($filename);
                $add_functions .= implode('', array_slice($source, $start_line, $length)) . "\n";

            }




            $file_path = dirname($reflector->getFileName()) . '/';


            $class_name = 'Elementor' . str_replace(array(' ', 'Mkdf'), '', ucwords(str_replace('_', ' ', $shortcode->getBase())));

            $output = '<?php' . "\n";
            $output .= 'class '. $class_name .' extends \Elementor\Widget_Base {'. "\n\n";

            $output .= "\t" . 'public function get_name() {'. "\n";
            $output .= "\t\treturn '". $shortcode->getBase() . "'; \n";
            $output .= "\t" . '}' . "\n\n";

            $output .= "\t" . 'public function get_title() {' . "\n";
            $output .= "\t\treturn esc_html__( '". $shortcode_object['name'] ."', 'curly-core' );" . "\n";
            $output .= "\t" . '}' . "\n\n";

            $output .= "\t" . 'public function get_icon() {' . "\n";
            $output .= "\t\treturn 'curly-elementor-custom-icon curly-elementor-" . strtolower(str_replace('mkdf-', '', str_replace('_', '-', $shortcode->getBase()))) . "';" . "\n";
            $output .= "\t" . '}' . "\n\n";

            $output .= "\t" . 'public function get_categories() {' . "\n";
            $output .= "\t\treturn [ 'mikado' ];" . "\n";
            $output .= "\t" . '}' . "\n\n";


            $output .= "\t" . 'protected function _register_controls() {' . "\n\n";
            $output .= "\t\t" . '$this->start_controls_section(' . "\n";
            $output .= "\t\t\t" . "'general'," . "\n";
            $output .= "\t\t\t[" . "\n";
            $output .= "\t\t\t\t" . "'label' => esc_html__( 'General', 'curly-core' )," . "\n";
            $output .= "\t\t\t\t" . "'tab'   => \Elementor\Controls_Manager::TAB_CONTENT," . "\n";
            $output .= "\t\t\t]" . "\n";
            $output .= "\t\t);" . "\n";

            $output .= $this->create_controls_output($shortcode_object, $formatted_array) . "\n";

            $output .= "\t\t" . '$this->end_controls_section();' . "\n";
            $output .= "\t" . '}' . "\n";

            $output .= "\t" . 'public function render() {' . "\n\n";
            $output .= "\t\t" . '$params = $this->get_settings_for_display();' . "\n\n";
            $output .= $output_body;
            $output .= "\t" . '}' . "\n\n";

            $output .= $add_functions;

            $output .= '}' . "\n";
            $output .= '\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ' . $class_name . '() );';

            $this->createFile($shortcode->getBase(), $output, $file_path);

        }
    }


	function convert_wpb_options_types_to_elementor_types( $type ) {

		switch ( $type ) :
			case 'textfield':
				$elementor_type = '\Elementor\Controls_Manager::TEXT';
				break;
			case 'textarea':
				$elementor_type = '\Elementor\Controls_Manager::TEXTAREA';
				break;
			case 'textarea_html':
				$elementor_type = '\Elementor\Controls_Manager::TEXTAREA';
				break;
			case 'html':
				$elementor_type = '\Elementor\Controls_Manager::WYSIWYG';
				break;
			case 'dropdown':
				$elementor_type = '\Elementor\Controls_Manager::SELECT';
				break;
			case 'checkbox':
				$elementor_type = '\Elementor\Controls_Manager::SWITCHER';
				break;
			case 'colorpicker':
				$elementor_type = '\Elementor\Controls_Manager::COLOR';
				break;
			case 'hidden':
				$elementor_type = '\Elementor\Controls_Manager::HIDDEN';
				break;
			case 'attach_image':
                $elementor_type = '\Elementor\Controls_Manager::MEDIA';
				break;
            case 'attach_images':
                $elementor_type = '\Elementor\Controls_Manager::GALLERY';
				break;
			case 'iconpack':
				$elementor_type = '\Elementor\Controls_Manager::SELECT';
				break;
			case 'icon':
				$elementor_type = '\Elementor\Controls_Manager::SELECT';
				break;
			case 'date':
				$elementor_type = '\Elementor\Controls_Manager::DATE_TIME';
				break;
			case 'param_group':
				$elementor_type = '\Elementor\Controls_Manager::REPEATER';
				break;
			default:
				$elementor_type = '\Elementor\Controls_Manager::TEXT';
				break;
		endswitch;

		return $elementor_type;
	}

	function get_dropdown_options($options) {

        $output = 'array(' . "\n";
        $i = 0;
        foreach (array_flip($options) as $option_key => $option){

            $output.= "\t\t\t\t\t" . "'". addslashes($option_key) ."' => esc_html__( '" . addslashes($option) . "', 'curly-core')";

            if((count($options) - 1) > $i) {
                $output.= ", \n";
            } else {
                $output.= "\n";
            }

            $i++;
        }

        $output.= "\t\t\t\t" . '),';

        return $output;

    }


    function create_controls_output($shortcode, $def_attributes = array()) {

	    $output = '';

	    $params    = $shortcode['params'];
        $params_by_group = array();

        if(isset($shortcode['as_parent']) && isset($shortcode['as_parent']['only'])){
            $child_elements_string = str_replace(' ', '', $shortcode['as_parent']['only']);
            $child_elements = explode(',', $child_elements_string);

            if(count($child_elements) == 1) {

                $child_shorcode_object = vc_get_shortcode( $child_elements[0]);
                $child_shorcode_params = $child_shorcode_object['params'];

                  $params_count = count($params);
                  $params[$params_count]['type'] = 'param_group';
                  $params[$params_count]['heading'] = $child_shorcode_object['name'];
                  $params[$params_count]['param_name'] = str_replace('mkdf_', '',$child_shorcode_object['base']);
                  $params[$params_count]['params'] = $child_shorcode_params;

            }
        }

        if(is_array($params) && count($params) > 0) {
            foreach ($params as $param_key => $param) {

                $icons_array = curly_mkdf_icon_collections()->getIconCollectionsParams();

                if (isset($param['group'])) {
                    $group_key = str_replace(' ', '_', mb_strtolower($param['group']));
                    $params_by_group[$group_key][] = $param;
                    continue;
                }

                if (in_array($param['param_name'], $icons_array)) {
                    continue;
                }
                $object = '$this';
                $repeated_object = '$this';
                if($param['type'] == 'param_group') {
                    $output .= "\t\t" . '$repeater = new \Elementor\Repeater();' . "\n\n";
                    $object = '$repeater';
                    $repeated_object = '$repeater';
                    foreach ($param['params'] as $r_param_key => $r_param) {
                        $output .= $this->format_output($r_param, array(), $object);
                    }
                }


                $output .= $this->format_output($param, $def_attributes, '$this', $repeated_object);

            }
        }
        if( ! empty($params_by_group) ) {

            foreach ($params_by_group as $params_group_key => $params_group) {

                $group_title = $params_group[0]['group'];

                $output .= "\t\t" . '$this->end_controls_section();' . "\n\n";

                $output .= "\t\t" . '$this->start_controls_section(' . "\n";
                $output .= "\t\t\t" . "'".$params_group_key."'," . "\n";
                $output .= "\t\t\t[" . "\n";
                $output .= "\t\t\t\t" . "'label' => esc_html__( '".$group_title."', 'curly-core' )," . "\n";
                $output .= "\t\t\t\t" . "'tab'   => \Elementor\Controls_Manager::TAB_CONTENT," . "\n";
                $output .= "\t\t\t]" . "\n";
                $output .= "\t\t);" . "\n";

                foreach ( $params_group as $param_group_key => $param_group) {
                    $output .= $this->format_output($param_group, $def_attributes);
                }
            }

        }

        return $output;
    }

    function format_output($param, $def_attributes = array(), $object = '$this', $repeater_object = '$repeater') {

        $output = '';
        $param_type = $this->convert_wpb_options_types_to_elementor_types($param['type']);
        if($param['param_name'] == 'icon_pack'){
            $output .= "\t\t" . 'curly_mkdf_icon_collections()->getElementorParamsArray( $this, \'\', \'\' );' . "\n";
        } else {

            $output .= "\t\t" . $object .'->add_control(' . "\n";
            $output .= "\t\t\t" . "'" . $param['param_name'] . "'," . "\n";
            $output .= "\t\t\t" . '[' . "\n";
            $output .= "\t\t\t\t" . "'label'     => esc_html__( '" . $param['heading'] . "', 'curly-core' )," . "\n";
            $output .= "\t\t\t\t" . "'type'      => " . $param_type . "," . "\n";

            if ($param['type'] == 'param_group' ) {
                $output .= "\t\t\t\t" . '\'fields\'     => '. $repeater_object .'->get_controls(),' . "\n";
                $output .= "\t\t\t\t" . "'title_field'     => esc_html__( 'Item', 'curly-core' )," . "\n";
            }

            if (!empty($param['description'])) {
                $output .= "\t\t\t\t" . "'description' => esc_html__( '" . $param['description'] . "', 'curly-core' )," . "\n";
            }

            if ($param['type'] == 'dropdown') {
                $output .= "\t\t\t\t" . "'options' => " . $this->get_dropdown_options($param['value']) . "\n";

                if(is_array($def_attributes) && count($def_attributes) > 0 && $def_attributes[$param['param_name']] !== ''){
                    $output .= "\t\t\t\t" . "'default' => '" . $def_attributes[$param['param_name']] . "',\n";
                } else {

                    $e = array_keys(array_flip($param['value']));
                    $output .= "\t\t\t\t" . "'default' => '" . $e[0] . "',\n";
                }

            }

            if (isset($param['dependency'])) {

                $output .= "\t\t\t\t" . "'condition' => [" . "\n";

                if (isset($param['dependency']['value'])) {

                    if(is_array($param['dependency']['value'])) {
                        $i_values = implode("', '", $param['dependency']['value']);
                    } else {
                        $i_values = $param['dependency']['value'];
                    }
                    $output .= "\t\t\t\t\t" . "'" . $param['dependency']['element'] . "' => array( '" . $i_values . "' )" . "\n";
                }
                if (isset($param['dependency']['not_empty'])) {
                    $output .= "\t\t\t\t\t" . "'" . $param['dependency']['element'] . "!' => ''" . "\n";
                }

                $output .= "\t\t\t\t" . ']' . "\n";
            }
            $output = rtrim($output, "\n ,");
            $output .= "\n\t\t\t" . ']' . "\n";
            $output .= "\t\t" . ');' . "\n\n";
        }
        return $output;
    }

    function createFile($name, $content, $path) {

        $name = str_replace('mkdf_', 'elementor-', $name);
        $name = str_replace('_', '-', $name);

        $fp = fopen($path . $name . '.php','w');

        $fw = fwrite($fp, $content);

        echo $name . ' Created' . "\n";

        fclose($fp);
    }

}

if ( ! function_exists( 'qode_framework_get_elementor_translator' ) ) {
	/**
	 * Function that return page builder module instance
	 */
	function qode_framework_get_elementor_translator() {
        return QodeFrameworkElementorTranslator::get_instance();
	}
}

if ( ! function_exists( 'qode_framework_init_elementor_translator' ) ) {
	/**
	 * Function that initialize page builder module
	 */
	function qode_framework_init_elementor_translator() {
		qode_framework_get_elementor_translator();
	}

	add_action( 'init', 'qode_framework_init_elementor_translator', 1 );
}
