<?php
//namespace Elementor;

if (!defined("ABSPATH")) {
	exit(); // Exit if accessed directly.
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
/**
 * Elementor accordion widget.
 *
 * Elementor widget that displays a collapsible display of content in an
 * request service style, showing only one item at a time.
 *
 * @since 1.0.0
 */
require_once get_template_directory() . "/inc/custom-widget-function.php";
class RDS_Company_Service_Widget extends Widget_Base
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
		$this->widgetPath = "company-services";  //Edit
		$this->widgetPathFull = "/global-templates/" .$this->widgetPath. "/"; 
		$this->allVariation = $this->getFileVariations($this->widgetPath);
	}

	/**
	 * Get widget name.
	 *
	 * Retrieve company widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return "rds-global-company-service-widget";
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

	private $company_array = "";
	private $company = "";

	/**
	 * Get widget title.
	 *
	 * Retrieve company service widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__(
			"Company Service",
			"rds-global-company-service-widget"
		);
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
		return ["rds-global-widgets"];
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve company service  widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return "eicon-tabs";
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
		return ["company service", "tabs", "toggle"];
	}

	/**
	 * Register company service  widget controls.
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
		$this->start_controls_section("rds_global_company_service_widget", [
			"label" => esc_html__(
				"Global Company Service Widget",
				"rds-global-company-service-widget"
			),
		]);

		if (!empty($this->allVariation) && count($this->allVariation) > 1) {
			$defaultVariation = isset($args["globals"]["company_services"]["variation"]) ? $args["globals"]["company_services"]["variation"] : "a";
			$this->add_control("variation", [
				"label" => "Variation",
				"type" => \Elementor\Controls_Manager::SELECT,
				"default" => $defaultVariation,
				"options" => $this->allVariation,
			]);
		}
		$this->add_control("heading", [
			"label" => "Heading",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => 'Lorem ipsum dolor sit amet',
		]);

		$this->add_control("subheading", [
			"label" => "SubHeading",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => 'consectetur adipiscing elit',
		]);

		$this->add_control("content", [
			"label" => "Content",
			"type" => \Elementor\Controls_Manager::WYSIWYG,
			"default" => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
		]);

		$this->add_control("button_text", [
			"label" => "Button Text",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => 'learn more',
		]);

		$this->add_control("button_link", [
			"label" => "Button Link",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => '#',
		]);

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
		// $args = $this->company_array;
		if (!empty($this->allVariation) && count($this->allVariation) > 1) {
			$args["globals"]["company_services"]["variation"] = sanitize_text_field($settings["variation"]);
		}
		$args["globals"]["company_services"]["heading"] = $settings["heading"];
		$args["globals"]["company_services"]["subheading"] = $settings["subheading"];
		$args["globals"]["company_services"]["button_text"] = sanitize_text_field($settings["button_text"]);
		$args["globals"]["company_services"]["button_link"] = sanitize_text_field($settings["button_link"]);
		$args["globals"]["company_services"]["description_html_allowed"] = $settings["content"];
		        // SAVE TO SPEC
				if ($this->globalPath){
					$this->setFeatureJsonData($args);
				}

		//RENDER VARIATION
		$folderath = "/global-templates/" .$this->widgetPath. "/"; 
		$variationVal = isset($settings["variation"]) ? sanitize_text_field($settings["variation"]) : 'a';
		set_query_var('settings', $settings);
		get_template_part($folderath.$variationVal,null,$args);
	}
}
