<?php
require_once(get_template_directory() . '/inc/custom-widget-function.php');
class RDS_Financing_form_Widget extends \Elementor\Widget_Base {
	use FileVariations;
	use FeatureJSONUpdate;
	public $allVariation;
	public $widgetPath;
public $widgetPathFull;
	public function __construct($data = [], $args = null)
	{
		parent::__construct($data, $args);

		$this->widgetPath = "financing/form";
		$this->widgetPathFull = "/global-templates/" .$this->widgetPath. "/"; 
		$this->allVariation = $this->getFileVariations($this->widgetPath);
	}

    public function get_categories() {
        return ['rds-global-widgets'];
    }

    public function get_name() {
        return 'rds-financing-form-widget';
    }

    public function get_title() {
        return 'Financing Form Widget';
    }

    public function get_icon() {
        return 'eicon-tabs';
    }

    public function get_gravity_forms_list() {
    
        global $wpdb;

        $forms_table = $wpdb->prefix . 'gf_form';

        $forms = $wpdb->get_results("SELECT * FROM $forms_table");

        $form_list = array();

        foreach ($forms as $form) {
            $form_list["$form->id"] = $form->title;
        }

        return $form_list;
    }


    public function render() {
		//GET SETTINGS VALUE
		$settings = $this->get_settings();
		if (!empty($this->allVariation) && count($this->allVariation) > 1) {
			$args['page_templates']['finance_page']['variation'] = sanitize_text_field($settings['variation']);
        }
            $args['page_templates']['finance_page']['gravity_form_heading'] = sanitize_text_field($settings['gravity_form_heading']);
            $args['page_templates']['finance_page']['gravity_form_id'] = sanitize_text_field($settings['gravity_form_id']);
            //Update template spec file
         // SAVE TO SPEC
            $this->setFeatureJsonData($args);
            if ($settings['gravity_form_id']) { 
			//RENDER VARIATION
			$variationVal = isset($settings["variation"]) ? sanitize_text_field($settings["variation"]) : 'a';
            set_query_var('settings', $settings);
			get_template_part($this->widgetPathFull.$variationVal,null,$args);
             }
    }

    public function _register_controls() {
        global $rdsTemplateDataGlobal;
        $args = $rdsTemplateDataGlobal;
           $this->start_controls_section(
                'financing_form_section',
                array(
                    'label' => __('Financing Form Widget', 'rds-financing-form-widget'),
                )
        );

		if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $defaultVariation = isset($args['page_templates']['finance_page']['variation']) ? $args['page_templates']['finance_page']['variation'] : "a";
			$this->add_control("variation", [
				"label" => "Variation",
				"type" => \Elementor\Controls_Manager::SELECT,
				"default" =>  $defaultVariation,
				"options" => $this->allVariation,
			]);
		}
         $this->add_control(
                'gravity_form_heading',
                array(
                    'label' => 'Heading',
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' =>'Financing',
                )
        );

         $Form_list = $this->get_gravity_forms_list();
                $this->add_control(
                        'gravity_form_id',
                        array(
                            'label' => 'Gravity Forms',
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => $Form_list,
                            'default' => '17',
                        )
        );

        $this->end_controls_section();
       
    }

}