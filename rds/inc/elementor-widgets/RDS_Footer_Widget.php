<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
require_once(get_template_directory() . '/inc/custom-widget-function.php');
class RDS_Footer_Widget extends \Elementor\Widget_Base {
	use FileVariations;
	use FeatureJSONUpdate;
	public $allVariation;
	public $widgetPath;
public $widgetPathFull;
	public $globalPath = false;
	public function __construct($data = [], $args = null)
	{
		parent::__construct($data, $args);
if ( $data && is_numeric( $data['id'] ) ) {             
			$this->globalPath = true;			
        }
		$this->widgetPath = "footer";
		$this->widgetPathFull = "/global-templates/" .$this->widgetPath. "/"; 
		$this->allVariation = $this->getFileVariations($this->widgetPath);
	}

    public function get_categories() {
        return ['rds-global-widgets'];
    }

    public function get_name() {
        return 'rds-footer-widget';
    }

    public function get_title() {
        return 'Footer';
    }

    public function get_icon() {
        return 'eicon-custom';
    }

    protected function _register_controls() {
        global $rdsTemplateDataGlobal;
        $args = $rdsTemplateDataGlobal;
        $menus = wp_get_nav_menus(); // Get the list of available menus
        $menu_options = [];
        foreach ( $menus as $menu ) {
            $menu_options[ $menu->name ] = $menu->name;
        }
        $this->start_controls_section(
                'footer',
                array(
                    'label' => __('Footer', 'rds-footer-widget'),
                )
        );

        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $defaultVariation = isset($args['globals']['footer']['variation']) ? $args['globals']['footer']['variation'] : "a";
			$this->add_control("variation", [
				"label" => "Variation",
				"type" => \Elementor\Controls_Manager::SELECT,
				"default" => $defaultVariation,
				"options" => $this->allVariation,
			]);
		}

         $this->add_control(
                'footer_menu_1_heading',
                array(
                    'label' => 'Footer Menu 1 Name',
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => 'Services',
                    'condition' => [
                        "variation!" => ["b"],
                    ],

                )
        );

          $this->add_control(
            'footer_menu_1_name',
            [
                'label' => __( 'Select Menu 1', 'rds-footer-widget' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $menu_options,
                'default' => 'our company',
                'condition' => [
                            "variation!" => ["b"],
                        ],
            ]
        );

         $this->add_control(
                'footer_menu_2_heading',
                array(
                    'label' => 'Footer Menu 2 Name',
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => 'our company',
                    'condition' => [
                        "variation!" => ["b"],
                    ],
                )
        );

        $this->add_control(
            'footer_menu_2_name',
            [
                'label' => __( 'Select Menu 2', 'rds-footer-widget' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $menu_options,
                'default' => 'Services',
                'condition' => [
                            "variation!" => ["b"],
                        ],
            ]
        );
        $this->add_control("landing_address", [
			"label" => "Address",
			"type" => \Elementor\Controls_Manager::TEXTAREA,
			"default" =>  'SOUTHEND: 1234 Address St',
			"condition" => [
				"variation!" => ["a"],
			],
		]);

		$this->add_control("landing_city", [
			"label" => "City",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => 'city',
			"condition" => [
				"variation!" => ["a"],
			],
		]);

		$this->add_control("landing_state", [
			"label" => "State",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => 'state',
			"condition" => [
				"variation!" => ["a"],
			],
		]);

		$this->add_control("landing_zip", [
			"label" => "Zip",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => '10939',
			"condition" => [
				"variation!" => ["a"],
			],
		]);
      
        $this->end_controls_section();
    }

    public function render() {
       	//GET SETTINGS VALUE
        $settings = $this->get_settings();
        global $rdsTemplateDataGlobal;
        $args = $rdsTemplateDataGlobal;
        
        if (!empty($settings) && is_array($settings)) {   
        

            $args['globals']['footer']['data']['footer_menu_1_name'] = sanitize_text_field($settings['footer_menu_1_name']);
            
            $args['globals']['footer']['data']['footer_menu_1_heading'] = sanitize_text_field($settings['footer_menu_1_heading']);
            $args['globals']['footer']['data']['footer_menu_2_name'] = sanitize_text_field($settings['footer_menu_2_name']);
            $args['globals']['footer']['data']['footer_menu_2_heading'] = sanitize_text_field($settings['footer_menu_2_heading']);
            $args["globals"]["footer"]["data"]["address"] = sanitize_text_field($settings["landing_address"]);
			$args["globals"]["footer"]["data"]["city"] = sanitize_text_field($settings["landing_city"]);
			$args["globals"]["footer"]["data"]["state"] = sanitize_text_field($settings["landing_state"]);
			$args["globals"]["footer"]["data"]["zip"] = sanitize_text_field($settings["landing_zip"]);
			//CREATE ARRAY FOR SPEC FILE 
			// CHECK IF ANY VARIATION
			if (!empty($this->allVariation) && count($this->allVariation) > 1) {
                $args['globals']['footer']['variation'] = sanitize_text_field($settings['variation']);
            } 
          
        // SAVE TO SPEC
        if ($this->globalPath){
            $this->setFeatureJsonData($args);
		}
		//RENDER VARIATION
		$variationVal = isset($settings["variation"]) ? sanitize_text_field($settings["variation"]) : 'a';
        set_query_var('settings', $settings);
		get_template_part($this->widgetPathFull.$variationVal,null,$args);               
		get_template_part('page-templates/common/footer-common');
        }
    }

   }
