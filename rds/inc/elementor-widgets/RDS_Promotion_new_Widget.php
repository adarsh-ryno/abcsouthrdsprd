<?php

if (!defined("ABSPATH")) {
	exit(); // Exit if accessed directly.
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * Elementor accordion widget.
 *
 * Elementor widget that displays a collapsible display of content in an
 * promotion style, showing only one item at a time.
 *
 * @since 1.0.0
 */
require_once get_template_directory() . "/inc/custom-widget-function.php";
class RDS_Promotion_new_Widget extends Widget_Base
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
		$this->widgetPath = "promotion/landing";  //Edit
		$this->widgetPathFull = "/global-templates/" .$this->widgetPath. "/"; 
		$this->allVariation = $this->getFileVariations($this->widgetPath);

	}

	/**
	 * Get widget name.
	 *
	 * Retrieve promotion widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return "rds-promotio-new-widget";
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

	private $promotion_arrya = "";
	private $promotion = "";

	/**
	 * Get widget title.
	 *
	 * Retrieve promotion widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__("Landing Promotion Widget", "polaris-rds");
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
	 * Retrieve promotion widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return "eicon-tags";
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
		return ["promotion widget", "tabs", "toggle"];
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
	 * Register promotion widget controls.
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
		
		$promotionCategory = [
			"taxonomy" => "bc_promotion_category",
			"orderby" => "name",
			"order" => "ASC",
		];

		$categoryNames = get_categories($promotionCategory);

		// $catName = [];
		$catName = [
			"all" => "all", // Static 'All' field
		];
		foreach ($categoryNames as $value) {
			$catName[$value->name] = $value->name;
		}

		if (!empty($categoryNames) && !is_wp_error($categoryNames)) {
			foreach ($categoryNames as $category) {
				$catName[$category->name] = $category->name;
			}
		}

		$this->start_controls_section("rds_promotion_widget", [
			"label" => esc_html__(
				"Promotion Widget",
				"polaris-rds"
			),
		]);

		if (!empty($this->allVariation) && count($this->allVariation) > 1) {
			$defaultVariation = isset($args["page_templates"]["landing_page"]["promotion"]["variation"]) ? $args["page_templates"]["landing_page"]["promotion"]["variation"] : "a";
			$options = [];
			foreach ($this->allVariation as $key => $value) {
				$options[$key] = $value;
			}
			$this->add_control("variation", [
				"label" => esc_html__("Variation", "polaris-rds"),
				"type" => Controls_Manager::SELECT,
				"default" => $defaultVariation,
				"options" => $options,
			]);
		}

		$this->add_control("category_filter", [
			"label" => esc_html__("Select Category", "polaris-rds"),
			"type" => \Elementor\Controls_Manager::SELECT2,
			"label_block" => true,
			"multiple" => true,
			"options" => $catName,
			"default" => 'all',
		]);

		//Promotion popup heading Start
		$this->add_control("popup_form_heading", [
			"label" => "Popup Heading",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => 'Request Service',
		]);

		// Promotion popup Subheading control start
		$this->add_control("popup_form_subheading", [
			"label" => "Popup Subheading",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => 'Your Promotional Selection Has Been Applied!',
		]);

		// $this->add_control(
		//     'coupon_button_text',
		//     array(
		//         'label' => 'Coupon Button Text',
		//         'type' => \Elementor\Controls_Manager::TEXT,
		//         'default' => $this->promotion['coupon_button_text'],
		//     )
		// );

		// $this->add_control(
		//     'request_button_link',
		//     array(
		//         'label' => 'Request Button Link',
		//         'type' => \Elementor\Controls_Manager::TEXT,
		//         'default' => $this->promotion['request_button_link'],
		//     )
		// );

		// Gravity Forms list start
		$Form_list = $this->get_gravity_forms_list();
		$this->add_control("popup_gravity_form_id", [
			"label" => "Gravity Forms",
			"type" => \Elementor\Controls_Manager::SELECT,
			"options" => $Form_list,
			"default" => '9',
		]);
		// Gravity Forms list end
		$this->end_controls_section();
	}

	/**
	 * Render promotion widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render()
	{
		$settings = $this->get_settings();
		// $args = $this->promotion_arrya;
		$widget_id = $this->get_id();
		$selected_category = $settings["category_filter"];
		if (!empty($this->allVariation) && count($this->allVariation) > 1) {
			$args["page_templates"]["landing_page"]["promotion"]["variation"] = sanitize_text_field($settings["variation"]);
		}
		$args["page_templates"]["landing_page"]["promotion"]["popup_form_heading"] = sanitize_text_field($settings["popup_form_heading"]);
		$args["page_templates"]["landing_page"]["promotion"]["popup_form_subheading"] = sanitize_text_field($settings["popup_form_subheading"]);
		//$args['page_templates']['landing_page']['promotion']['coupon_button_text'] = sanitize_text_field($settings['coupon_button_text']);
		//$args['page_templates']['landing_page']['promotion']['request_button_link'] = sanitize_text_field($settings['request_button_link']);
		$args["page_templates"]["landing_page"]["promotion"]["popup_gravity_form_id"] = sanitize_text_field($settings["popup_gravity_form_id"]);
		$args["page_templates"]["landing_page"]["promotion"]["category_filter"] = $settings["category_filter"];
        // SAVE TO SPEC
        if ($this->globalPath){
            $this->setFeatureJsonData($args);
		}
		$args["globals"]["promotion"]["widget_id"] = $widget_id;
		$args["category_taxonomy"] = $selected_category;
		$call_back = "rds_variation_promotion_new_html";
		$this->$call_back($args, $settings);
	}

	/**
	 * Render promotion widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 2.9.0
	 * @access protected
	 */
	public function rds_variation_promotion_new_html($args, $settings)
	{
		//RENDER VARIATION
		$variationVal = isset($settings["variation"]) ? sanitize_text_field($settings["variation"]) : 'a'; //FIXED
		set_query_var('settings', $settings);
		get_template_part($this->widgetPathFull.$variationVal,null,$args); //FIXED
	}
}