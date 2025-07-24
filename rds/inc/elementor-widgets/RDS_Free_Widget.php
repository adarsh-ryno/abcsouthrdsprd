<?php
//namespace Elementor;

if (!defined("ABSPATH")) {
	exit(); // Exit if accessed directly.
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Text_Shadow;
//use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

/**
 * Elementor accordion widget.
 *
 * Elementor widget that displays a collapsible display of content in an
 * free estimate style, showing only one item at a time.
 *
 * @since 1.0.0
 */
require_once get_template_directory() . "/inc/custom-widget-function.php";
class RDS_Free_Widget extends Widget_Base
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
		$this->widgetPath = "free-estimate";  //Edit
		$this->widgetPathFull = "/global-templates/" .$this->widgetPath. "/"; 
		$this->allVariation = $this->getFileVariations($this->widgetPath);
	}

	/**
	 * Get widget name.
	 *
	 * Retrieve request widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return "rds-template-free-widget";
	}

	/* Get RDS Spec File.
	 *
	 * Retrieve rds spec file from wp options.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */

	private $free_array = "";
	private $free = "";

	/**
	 * Get widget title.
	 *
	 * Retrieve free estimate widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__("Free Estimate Template", "rds-template-free-widget");
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the category the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget category.
	 */
	public function get_categories()
	{
		return ["rds-template-widgets"];
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve free estimate  widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return "eicon-site-identity";
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords()
	{
		return ["free estimate", "tabs", "toggle"];
	}

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
	 * Register Free Estimate service template  widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 3.1.0
	 * @access protected
	 */
	protected function register_controls()
	{
		global $rdsTemplateDataGlobal;
        $args = $rdsTemplateDataGlobal;
		$this->start_controls_section("rds_free_estimate_widget", [
			"label" => esc_html__(
				"Free Estimate Template Widget",
				"rds-free-widget"
			),
		]);
		if (!empty($this->allVariation) && count($this->allVariation) > 1) {
			$defaultVariation = isset($args["page_templates"]["free_estimate_page"]["variation"]) ? $args["page_templates"]["free_estimate_page"]["variation"] : "a";
			$this->add_control("variation", [
				"label" => "Variation",
				"type" => \Elementor\Controls_Manager::SELECT,
				"default" => $defaultVariation,
				"options" => $this->allVariation,
			]);
		}
		$this->add_control("first_icon_class", [
			"label" => "First Icon Class",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => 'icon-pen-to-square2',
		]);
		$this->add_control("first_title", [
			"label" => "First Title",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => 'Information',
		]);

		$this->add_control("first_description", [
			"label" => "First Description",
			"type" => \Elementor\Controls_Manager::TEXTAREA,
			"default" => 'Lorem ipsum dolor sit amet, morbi et consectetur adipiscing elit.',
		]);
		$this->add_control("second_icon_class", [
			"label" => "Second Icon Class",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => 'icon-user-headset1',
		]);
		$this->add_control("second_title", [
			"label" => "Second Title",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => 'Confirmation',
		]);

		$this->add_control("second_description", [
			"label" => "Second Description",
			"type" => \Elementor\Controls_Manager::TEXTAREA,
			"default" => 'Lorem ipsum dolor sit amet, morbi et consectetur adipiscing elit.',
		]);

		$this->add_control("third_icon_class", [
			"label" => "Third Icon Class",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => 'icon-truck-fast4',
		]);
		$this->add_control("third_title", [
			"label" => "Third Title",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => 'Dispatch',
		]);

		$this->add_control("third_description", [
			"label" => "Third Description",
			"type" => \Elementor\Controls_Manager::TEXTAREA,
			"default" => 'Lorem ipsum dolor sit amet, morbi et consectetur adipiscing elit.',
		]);
		// Gravity Forms list start
		$Form_list = $this->get_gravity_forms_list();
		$this->add_control("gravity_form_id", [
			"label" => "Gravity Forms",
			"type" => \Elementor\Controls_Manager::SELECT,
			"options" => $Form_list,
			"default" => '7',
		]);
		// Gravity Forms list end

		$this->end_controls_section();
	}

	/**
	 * Render request widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render()
	{
		$settings = $this->get_settings();
		if (!empty($this->allVariation) && count($this->allVariation) > 1) {
			$args["page_templates"]["free_estimate_page"]["variation"] = sanitize_text_field($settings["variation"]);
		}
		$args["page_templates"]["free_estimate_page"]["first_icon_class"] = sanitize_text_field($settings["first_icon_class"]);
		$args["page_templates"]["free_estimate_page"]["first_title"] = sanitize_text_field($settings["first_title"]);
		$args["page_templates"]["free_estimate_page"]["first_description"] = sanitize_text_field($settings["first_description"]);
		$args["page_templates"]["free_estimate_page"]["second_icon_class"] = sanitize_text_field($settings["second_icon_class"]);
		$args["page_templates"]["free_estimate_page"]["second_title"] = sanitize_text_field($settings["second_title"]);
		$args["page_templates"]["free_estimate_page"]["second_description"] = sanitize_text_field($settings["second_description"]);
		$args["page_templates"]["free_estimate_page"]["third_icon_class"] = sanitize_text_field($settings["third_icon_class"]);
		$args["page_templates"]["free_estimate_page"]["third_title"] = sanitize_text_field($settings["third_title"]);
		$args["page_templates"]["free_estimate_page"]["third_description"] = sanitize_text_field($settings["third_description"]);
		$args["page_templates"]["free_estimate_page"]["gravity_form_id"] = sanitize_text_field($settings["gravity_form_id"]);
        // SAVE TO SPEC
        if ($this->globalPath){
            $this->setFeatureJsonData($args);
		}

		//RENDER VARIATION
		$variationVal = isset($settings["variation"]) ? sanitize_text_field($settings["variation"]) : 'a'; //FIXED
		set_query_var('settings', $settings);
		get_template_part($this->widgetPathFull.$variationVal,null,$args); //FIXED
	}
}
