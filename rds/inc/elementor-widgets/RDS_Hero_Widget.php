<?php

if (!defined("ABSPATH")) {
	exit(); // Exit if accessed directly.
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
require_once get_template_directory() . "/inc/custom-widget-function.php";
class RDS_Hero_Widget extends Widget_Base
{
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
		$this->widgetPath = "hero";
		$this->widgetPathFull = "/global-templates/" .$this->widgetPath. "/"; 
		$this->allVariation = $this->getFileVariations($this->widgetPath);
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve Hero widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_categories()
	{
		return ["rds-global-widgets"];
	}

	/**
	 * Get widget name.
	 *
	 * Retrieve Hero widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_name()
	{
		return "rds-hero-widget";
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Hero widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_title()
	{
		return "Hero";
	}


	/**
	 * Get widget icon.
	 *
	 * Retrieve promotions widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return "eicon-banner";
	}

	/**
	 * Register Gravity form lists.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 3.1.0
	 * @access public
	 */
	public function get_gravity_forms_list()
	{
		global $wpdb;

		$forms_table = $wpdb->prefix . "gf_form";

		$forms = $wpdb->get_results("SELECT * FROM $forms_table");

		$form_list = [];

		foreach ($forms as $form) {
			$form_list["$form->id"] = $form->title;
		}

		return $form_list;
	}

	/**
	 * Render hero widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	public function render()
{
   	//GET SETTINGS VALUE
		$settings = $this->get_settings();
		global $rdsTemplateDataGlobal;
        $args = $rdsTemplateDataGlobal;
		if (!empty($this->allVariation) && count($this->allVariation) > 1) {
			$args["globals"]["hero"]["variation"] = sanitize_text_field($settings["variation"]);
		}
        
        $button_link = isset($settings["hero_button_link"]) ? sanitize_text_field($settings["hero_button_link"]) : "";
	
        $args["globals"]["hero"]["button_link"] = $button_link;
        $args["globals"]["hero"]["heading"] = $settings["hero_heading"];
        $args["globals"]["hero"]["subheading"] = $settings["hero_subheading"];
        $args["globals"]["hero"]["footer_text"] = $settings["hero_footer_text"];
        $args["globals"]["hero"]["form_heading"] = sanitize_text_field($settings["hero_form_heading"]);
        $args["globals"]["hero"]["form_subheading"] = sanitize_text_field($settings["hero_form_subheading"]);
        $args["globals"]["hero"]["button_text"] = sanitize_text_field($settings["hero_button_text"]);
        $args["globals"]["hero"]["desktop_gravity_form_id"] = sanitize_text_field($settings["hero_desktop_gravity_form_id"]);
        $args["globals"]["hero"]["mobile_gravity_form_id"] = sanitize_text_field($settings["hero_mobile_gravity_form_id"]);
        $args["globals"]["hero"]["schedule_online"]["type"] = sanitize_text_field($settings["hero_schedule_online_type"]);
        $args["globals"]["hero"]["schedule_online"]["url"] = sanitize_text_field($settings["hero_schedule_online_url"]);
        $args["globals"]["hero"]["schedule_online"]["label"] = sanitize_text_field($settings["hero_schedule_online_lable"]);
        $args["globals"]["hero"]["schedule_online"]["icon_class"] = sanitize_text_field($settings["hero_schedule_online_icon_class"]);
        
         // SAVE TO SPEC
		 if ($this->globalPath){
            $this->setFeatureJsonData($args);
		}
        //RENDER VARIATION
		$variationVal = isset($settings["variation"]) ? sanitize_text_field($settings["variation"]) : 'a';
		set_query_var('settings', $settings);
		get_template_part($this->widgetPathFull.$variationVal,null,$args);
        get_template_part("global-templates/form/hero/desktop/" . $variationVal, null, $args);
}
	/**
	 * Register hero widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 3.1.0
	 * @access protected
	 */
	protected function _register_controls()
	{
		global $rdsTemplateDataGlobal;
        $args = $rdsTemplateDataGlobal;
		$this->start_controls_section("hero", [
			"label" => __("Hero", "rds-hero-widget"),
		]);
		if (!empty($this->allVariation) && count($this->allVariation) > 1) {
			$defaultVariation = isset($args["globals"]["hero"]["variation"]) ? $args["globals"]["hero"]["variation"] : "a";
			$this->add_control("variation", [
				"label" => "Variation",
				"type" => \Elementor\Controls_Manager::SELECT,
				"default" => $defaultVariation,
				"options" => $this->allVariation,
			]);
		}
		$this->add_control("hero_heading", [
			"label" => "Heading",
			"type" => Controls_Manager::TEXTAREA,
			"default" => "[ Insert Company Name ]",
		]);

		// Subheading control
		$this->add_control("hero_subheading", [
			"label" => "Subheading",
			"type" => Controls_Manager::TEXTAREA,
			"default" => "Tag Line Goes Here",
		]);

		// Subheading control
		$this->add_control("hero_footer_text", [
			"label" => "Footer Text",
			"type" => Controls_Manager::TEXTAREA,
			"default" => "Main Service Area + List Main Services + Experts",
		]);

		$this->add_control("hero_button_link", [
			"label" => "Button Link",
			"type" => Controls_Manager::TEXT,
			"default" => "/specials",
		]);

		$this->add_control("hero_button_text", [
			"label" => "Button Text",
			"type" => Controls_Manager::TEXTAREA,
			"default" => "Deals & Financing",
		]);
		//  Forms Section Start
		$this->add_control("hero_form_heading", [
			"label" => "Form Heading",
			"type" => Controls_Manager::TEXTAREA,
			"default" => "Request Service",
		]);
		$this->add_control("hero_form_subheading", [
			"label" => "Form Sub Heading",
			"type" => Controls_Manager::TEXTAREA,
			"default" => "a",
			"condition" => [
				"variation!" => ["b", "c"], 
			],
		]);
		//  Forms Section Start
		// Gravity Forms list end
		$Form_list = $this->get_gravity_forms_list();
		$this->add_control("hero_desktop_gravity_form_id", [
			"label" => "Desktop Forms",
			"type" => Controls_Manager::SELECT,
			"options" => $Form_list,
			"default" => "13",
			"type" => Controls_Manager::SELECT,
			"condition" => [
				"variation!" => ["d"], // Show the control only if "type" is set to "option1"
			],
		]);
		$this->add_control("hero_mobile_gravity_form_id", [
			"label" => "Mobile Forms",
			"type" => Controls_Manager::SELECT,
			"options" => $Form_list,
			"default" => "13",
			"condition" => [
				"variation!" => ["d"], // Show the control only if "type" is set to "option1"
			],
		]);
		// Gravity Forms list end
		//Schedule online
		$this->add_control("hero_schedule_online_type", [
			"label" => "Schedule Online Type",
			"type" => Controls_Manager::SELECT,
			"options" => [
				"service_titan" => "service_titan",
				"schedule_engine" => "schedule_engine",
				"url" => "URL",
			],
			"default" => 'url',
			"condition" => [
				"variation!" => ["a", "b", "c"], // Show the control only if "type" is set to "option1"
			],
		]);
		$this->add_control("hero_schedule_online_url", [
			"label" => "Schedule Online URL",
			"type" => Controls_Manager::TEXT,
			"default" => '/schedule',
			"condition" => [
				"hero_schedule_online_type" => ["url"],
				"variation!" => ["a", "b", "c"],
			],
		]);
		$this->add_control("hero_schedule_online_lable", [
			"label" => "Schedule Online Label",
			"type" => Controls_Manager::TEXT,
			"default" => 'Schedule Now',
			"condition" => [
				"variation!" => ["a", "b", "c"],
			],
		]);
		$this->add_control("hero_schedule_online_icon_class", [
			"label" => "Schedule Online Class",
			"type" => Controls_Manager::TEXT,
			"default" =>'icon-chevron-right1',
			"condition" => [
				"variation!" => ["a", "b", "c"], // Show the control only if "type" is set to "option1"
			],
		]);
		$this->end_controls_section();
	}
}
