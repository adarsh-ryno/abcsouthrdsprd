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
class RDS_Landing_Page_Banner_Widget extends Widget_Base
{
	
	use FileVariations;
	use FeatureJSONUpdate;
	use AssetVariations;
	public $allVariation;
	public $widgetPath;
public $widgetPathFull;
	public $globalPath = false;
	public $allassVariation;
	public $assetWidgetPathFull;
	public $assetWidgetPath;

	public function __construct($data = [], $args = null)
	{
		parent::__construct($data, $args);
if ( $data && is_numeric( $data['id'] ) ) {             
			$this->globalPath = true;			
        }
		$this->widgetPath = "subpage-hero/landing-banner";  //Edit
		$this->widgetPathFull = "/global-templates/" .$this->widgetPath. "/"; 
		$this->allVariation = $this->getFileVariations($this->widgetPath);

		$this->assetWidgetPath = "landing-page";  //Edit
		$this->assetWidgetPathFull = "/global-templates/" .$this->assetWidgetPath. "/"; 
		$this->allassVariation = $this->getAssetVariations($this->assetWidgetPath);

	}

	/**
	 * Get widget name.
	 *
	 * Retrieve landing page banner widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return "rds-global-landing-page-banner-widget";
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

	private $service_array = "";
	private $service = "";

	/**
	 * Get widget title.
	 *
	 * Retrieve service subpage banner widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__(
			"Landing Page Banner Widget",
			"rds-global-landing-page-banner-widget"
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
	 * Retrieve service subapge banner widget icon.
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
		return ["landing page", "tabs", "toggle"];
	}
	/**
	 * Register subpage widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 3.1.0
	 * @access protected
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

	protected function register_controls()
	{
		global $rdsTemplateDataGlobal;
        $args = $rdsTemplateDataGlobal;
		$this->start_controls_section("rds_global_landing_page_banner_widget", [
			"label" => esc_html__(
				"Landing Page Banner Widget",
				"rds-global-landing-page-banner-widget"
			),
		]);

		if (!empty($this->allVariation) && count($this->allVariation) > 1) {
			$defaultVariation = isset($args["page_templates"]["landing_page"]["banner"]["variation"]) ? $args["page_templates"]["landing_page"]["banner"]["variation"] : "a";
			$this->add_control("variation", [
				"label" => "Variation",
				"type" => \Elementor\Controls_Manager::SELECT,
				"default" => $defaultVariation,
				"options" => $this->allVariation,
			]);
		}

		// Add control for asset variations
		if (!empty($this->allassVariation) && count($this->allassVariation) > 1) {
			$this->add_control("asset_variation", [
				"label" => "Asset Variation",
				"type" => \Elementor\Controls_Manager::SELECT,
				// 'default' => $this->allassVariation[0],
				"options" => $this->allassVariation,
			]);
		}

		$this->add_control("heading", [
			"label" => "Heading",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => 'Contact Us Today',
		]);

		$this->add_control("subheading", [
			"label" => "SubHeading",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => 'Who We are',
		]);

		$this->add_control("content", [
			"label" => "Content",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => 'Lorem ipsum dolor sit amet, morbi et consectetur adipiscing elit.',
		]);

		$this->add_control("button_text", [
			"label" => "Button Text",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => 'Deals & Financing',
		]);
		$this->add_control("button_link", [
			"label" => "Button Link",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => '#',
		]);

		// Gravity Forms list start
		$Form_list = $this->get_gravity_forms_list();
		$this->add_control("gravity_form_id", [
			"label" => "Gravity Forms",
			"type" => \Elementor\Controls_Manager::SELECT,
			"options" => $Form_list,
			"default" => '9',
		]);
		// Gravity Forms list end
		$this->add_control("form_heading", [
			"label" => "Heading",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => 'Request Service',
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
		// $args = $this->service_array;
		if (!empty($this->allVariation) && count($this->allVariation) > 1) {
			$args["page_templates"]["landing_page"]["banner"]["variation"] = sanitize_text_field($settings["variation"]);
		}
		$args["page_templates"]["landing_page"]["banner"]["heading"] = sanitize_text_field($settings["heading"]);
		$args["page_templates"]["landing_page"]["banner"]["subheading"] = sanitize_text_field($settings["subheading"]);
		$args["page_templates"]["landing_page"]["banner"]["button_text"] = sanitize_text_field($settings["button_text"]);
		$args["page_templates"]["landing_page"]["banner"]["button_link"] = sanitize_text_field($settings["button_link"]);
		$args["page_templates"]["landing_page"]["banner"]["content"] = sanitize_text_field($settings["content"]);
		$args["page_templates"]["landing_page"]["banner"]["gravity_form_id"] = sanitize_text_field($settings["gravity_form_id"]);
		$args["page_templates"]["landing_page"]["banner"]["form_heading"] = sanitize_text_field($settings["form_heading"]);

		if (isset($settings["asset_variation"])) {
		    $args["asset_variation"] = $settings["asset_variation"];
		}

		$args["asset_variation_isset"] = $this->allassVariation;

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
