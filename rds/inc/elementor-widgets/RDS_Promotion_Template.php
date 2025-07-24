<?php

use Elementor\Controls_Manager;

require_once get_template_directory() . "/inc/custom-widget-function.php";
class RDS_Promotion_Template extends \Elementor\Widget_Base
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
		$this->widgetPath = "promotion/promotion-template";  //Edit
		$this->widgetPathFull = "/global-templates/" .$this->widgetPath. "/"; 
		$this->allVariation = $this->getFileVariations($this->widgetPath);
	}

	public function get_categories()
	{
		return ["rds-global-widgets"];
	}

	public function get_name()
	{
		return "rds-promotion-widget";
	}

	protected $promotion_arrya = "";
	protected $promotion = "";

	public function get_title()
	{
		return esc_html__( 'Promotion Template Widget', 'polaris-rds' );
	}

	public function get_icon()
	{
		return "eicon-tags";
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
	protected function _register_controls()
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

		$this->start_controls_section("rds_promotions", [
			"label" => __("Promotion Widget 1", "polaris-rds"),
		]);

		$this->add_control("enable_sidebar", [
			"name" => "enable",
			"label" => "Enable Sidebar",
			"type" => \Elementor\Controls_Manager::SWITCHER,
			"label_on" => "Yes",
			"label_off" => "No",
			"default" => "yes",
		]);

		if (!empty($this->allVariation) && count($this->allVariation) > 1) {
			$defaultVariation = isset($args["page_templates"]["promotions"]["variation"]) ? $args["page_templates"]["promotions"]["variation"] : "a";
			$this->add_control("variation", [
				"label" => esc_html__("Variation", "polaris-rds"),
				"type" => Controls_Manager::SELECT,
				"default" => $defaultVariation,
				"options" => $this->allVariation,
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

		$this->add_control("popup_form_heading", [
			"label" => "Popup Heading",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => 'Request Service',
		]);
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
		//     $this->add_control(
		//         'request_button_link',
		//         array(
		//             'label' => 'Request Button Link',
		//             'type' => \Elementor\Controls_Manager::TEXT,
		//             'default' => $this->promotion['request_button_link'],
		//         )
		// );
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
	protected function render()
	{
		$settings = $this->get_settings();
		// $args = $this->promotion_arrya;
		$enable_sidebar = sanitize_text_field($settings["enable_sidebar"]);
		$selected_category = $settings["category_filter"];
		if (!empty($this->allVariation) && count($this->allVariation) > 1) {
			$args["page_templates"]["promotions"]["variation"] = $settings["variation"];
		}
		// if (!empty($settings) && is_array($settings)) {
		$args["page_templates"]["promotions"]["subpage_sidebar"] = $settings["enable_sidebar"] ? true : false;
		$args["page_templates"]["promotions"]["popup_form_heading"] = sanitize_text_field($settings["popup_form_heading"]);
		$args["page_templates"]["promotions"]["popup_form_subheading"] = sanitize_text_field($settings["popup_form_subheading"]);
		//$args['page_templates']['promotions']['coupon_button_text'] = sanitize_text_field($settings['coupon_button_text']);
		//$args['page_templates']['promotions']['request_button_link'] = sanitize_text_field($settings['request_button_link']);
		$args["page_templates"]["promotions"]["popup_gravity_form_id"] = sanitize_text_field($settings["popup_gravity_form_id"]);
		$args["page_templates"]["promotions"]["category_filter"] = $settings["category_filter"];
        // SAVE TO SPEC
        if ($this->globalPath){
            $this->setFeatureJsonData($args);
		}

		$args["enable_sidebar"] = $enable_sidebar;
		$args["category_taxonomy"] = $selected_category;
		//RENDER VARIATION
		$variationVal = isset($settings["variation"]) ? sanitize_text_field($settings["variation"]) : 'a'; //FIXED
		set_query_var('settings', $settings);
		get_template_part($this->widgetPathFull.$variationVal,null,$args); //FIXED

		// }
	}
}
