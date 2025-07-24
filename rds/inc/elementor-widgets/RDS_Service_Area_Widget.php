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
 * service area style, showing only one item at a time.
 *
 * @since 1.0.0
 */
require_once get_template_directory() . "/inc/custom-widget-function.php";
class RDS_Service_Area_Widget extends Widget_Base
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
		$this->widgetPath = "service-area";  //Edit
		$this->widgetPathFull = "/global-templates/" .$this->widgetPath. "/"; 
		$this->allVariation = $this->getFileVariations($this->widgetPath);
	}

	/**
	 * Get widget name.
	 *
	 * Retrieve service area widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return "rds-global-service-area-widget";
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
	 * Retrieve service area  widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__("Service Area", "rds-global-service-area-widget");
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
	 * Retrieve request service  widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return "eicon-kit-parts";
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
		return ["service area", "tabs", "toggle"];
	}

	/**
	 * Register Gravity form lists.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 3.1.0
	 * @access public
	 */

	/**
	 * Register service area  widget controls.
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
		// $site_titles = get_multisite_site_titles();
		$this->start_controls_section("rds_global_service_area_widget", [
			"label" => esc_html__(
				"Global Service Area Widget",
				"rds-global-service-area-widget"
			),
		]);
		if (!empty($this->allVariation) && count($this->allVariation) > 1) {
			$defaultVariation = isset($args["globals"]["service_area"]["variation"]) ? $args["globals"]["service_area"]["variation"] : "a";
			$this->add_control("variation", [
				"label" => esc_html__(
					"Variation",
					"rds-global-request-service-widget"
				),
				"type" => Controls_Manager::SELECT,
				"default" => $defaultVariation,
				"options" => $this->allVariation,
			]);
		}
		if (is_multisite()) {
			$this->add_control("multisite_service_area_option", [
				"label" => esc_html__(
					"Enable Multi Site Serice Area",
					"rds-global-service-area-widget"
				),
				"type" => \Elementor\Controls_Manager::SWITCHER,
				"label_on" => esc_html__(
					"Yes",
					"rds-global-service-area-widget"
				),
				"label_off" => esc_html__(
					"No",
					"rds-global-service-area-widget"
				),
				"return_value" => isset(
					$this->service["multisite_service_area_option"]
				)
					? "yes"
					: "",
				"default" => "yes",
				"condition" => [
					"variation!" => ["a", "b"],
				],
			]);
		}

		$this->add_control("first_tab_title", [
			"label" => "First Tab Title",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => 'Nova & DC',
			"condition" => [
				"variation!" => ["a", "b"],
				// "multisite_service_area_option" => "",
			],
		]);
		$this->add_control("first_tab_heading", [
			"label" => "First Tab Heading",
			"type" => \Elementor\Controls_Manager::WYSIWYG,
			"default" => 'Proudly Serving',
			"condition" => [
				"variation!" => ["a", "b"],
				// "multisite_service_area_option" => "",
			],
		]);

		$this->add_control("first_tab_description_html_allowed", [
			"label" => "First Tab Description",
			"type" => \Elementor\Controls_Manager::WYSIWYG,
			"default" => 'Lorem ipsum',
			"condition" => [
				"variation!" => ["a", "b"],
				// "multisite_service_area_option" => "",
			],
		]);
		$this->add_control("first_tab_button_text", [
			"label" => "First Tab Button Text",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => 'See More',
			"condition" => [
				"variation!" => ["a", "b"],
				// "multisite_service_area_option" => "",
			],
		]);

		$this->add_control("first_tab_button_link", [
			"label" => "First Tab Button Link",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => '/service-subpage',
			"condition" => [
				"variation!" => ["a", "b"],
				// "multisite_service_area_option" => "",
			],
		]);

		$this->add_control("second_tab_title", [
			"label" => "Second Tab Title",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => 'Richmond Area',
			"condition" => [
				"variation!" => ["a", "b"],
				// "multisite_service_area_option" => "",
			],
		]);

		$this->add_control("second_tab_heading", [
			"label" => "Second Tab Heading",
			"type" => \Elementor\Controls_Manager::WYSIWYG,
			"default" => 'Proudly Serving',
			"condition" => [
				"variation!" => ["a", "b"],
				// "multisite_service_area_option" => "",
			],
		]);

		$this->add_control("second_tab_description_html_allowed", [
			"label" => "Second Tab Description",
			"type" => \Elementor\Controls_Manager::WYSIWYG,
			"default" => 'Lorem ipsum',
			"condition" => [
				"variation!" => ["a", "b"],
				// "multisite_service_area_option" => "",
			],
		]);

		$this->add_control("second_tab_button_text", [
			"label" => "Second Tab Button Text",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => 'See More',
			"condition" => [
				"variation!" => ["a", "b"],
				// "multisite_service_area_option" => "",
			],
		]);

		$this->add_control("second_tab_button_link", [
			"label" => "Second Tab Button Link",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => '/service-subpage',
			"condition" => [
				"variation!" => ["a", "b"],
				// "multisite_service_area_option" => "",
			],
		]);

		$this->add_control("third_tab_title", [
			"label" => "Third Tab Title",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => 'Maryland',
			"condition" => [
				"variation!" => ["a", "b"],
				// "multisite_service_area_option" => "",
			],
		]);
		$this->add_control("third_tab_heading", [
			"label" => "Third Tab Heading",
			"type" => \Elementor\Controls_Manager::WYSIWYG,
			"default" => 'Proudly Serving',
			"condition" => [
				"variation!" => ["a", "b"],
				// "multisite_service_area_option" => "",
			],
		]);

		$this->add_control("third_tab_description_html_allowed", [
			"label" => "Third Tab Description",
			"type" => \Elementor\Controls_Manager::WYSIWYG,
			"default" => 'Lorem ipsum',
			"condition" => [
				"variation!" => ["a", "b"],
				// "multisite_service_area_option" => "",
			],
		]);

		$this->add_control("third_tab_button_text", [
			"label" => "Third Tab Button Text",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => 'See More',
			"condition" => [
				"variation!" => ["a", "b"],
				// "multisite_service_area_option" => "",
			],
		]);

		$this->add_control("third_tab_button_link", [
			"label" => "Third Tab Button Link",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => '/service-subpage',
			"condition" => [
				"variation!" => ["a", "b"],
				// "multisite_service_area_option" => "",
			],
		]);

		$this->add_control("fourth_tab_title", [
			"label" => "Fourth Tab Title",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => 'West Virginia',
			"condition" => [
				"variation!" => ["a", "b"],
				// "multisite_service_area_option" => "",
			],
		]);

		$this->add_control("fourth_tab_heading", [
			"label" => "Fourth Tab Heading",
			"type" => \Elementor\Controls_Manager::WYSIWYG,
			"default" => 'Proudly Serving',
			"condition" => [
				"variation!" => ["a", "b"],
				// "multisite_service_area_option" => "",
			],
		]);

		$this->add_control("fourth_tab_description_html_allowed", [
			"label" => "Fourth Tab Description",
			"type" => \Elementor\Controls_Manager::WYSIWYG,
			"default" => 'Lorem ipsum',
			"condition" => [
				"variation!" => ["a", "b"],
				// "multisite_service_area_option" => "",
			],
		]);

		$this->add_control("fourth_tab_button_text", [
			"label" => "Fourth Tab Button Text",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => 'See More',
			"condition" => [
				"variation!" => ["a", "b"],
				// "multisite_service_area_option" => "",
			],
		]);

		$this->add_control("fourth_tab_button_link", [
			"label" => "Fourth Tab Button Link",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => '/service-subpage',
			"condition" => [
				"variation!" => ["a", "b"],
				// "multisite_service_area_option" => "",
			],
		]);

		$this->add_control("heading", [
			"label" => "Heading",
			"type" => \Elementor\Controls_Manager::WYSIWYG,
			"default" => 'Proudly Serving',
			"condition" => [
				"variation!" => ["c"],
			],
		]);

		$this->add_control("subheading", [
			"label" => "Subheading",
			"type" => \Elementor\Controls_Manager::WYSIWYG,
			"default" => 'The Lorem Ipsum Area',
			"condition" => [
				"variation!" => ["b", "c"],
			],
		]);
		$this->add_control("description_html_allowed", [
			"label" => "Description",
			"type" => \Elementor\Controls_Manager::WYSIWYG,
			"default" => 'Lorem ipsum',
			"condition" => [
				"variation!" => ["c"],
			],
		]);

		$this->add_control("button_text", [
			"label" => "Button Text",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => 'View More',
			"condition" => [
				"variation!" => ["c"],
			],
		]);

		$this->add_control("button_link", [
			"label" => "Button Link",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => '/service-subpage-sidebar',
			"condition" => [
				"variation!" => ["c"],
			],
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
			$args["globals"]["service_area"]["variation"] = sanitize_text_field($settings["variation"]);
		}
		if (is_multisite()) {
			$args["globals"]["service_area"]["multisite_service_area_option"] = $settings["multisite_service_area_option"] ? true : false;
		}
		$args["globals"]["service_area"]["subheading"] = $settings["subheading"];
		$args["globals"]["service_area"]["heading"] = $settings["heading"];
		$args["globals"]["service_area"]["button_link"] = sanitize_text_field($settings["button_link"]);
		$args["globals"]["service_area"]["button_text"] = sanitize_text_field($settings["button_text"]);
		$args["globals"]["service_area"]["description_html_allowed"] = $settings["description_html_allowed"];
		$args["globals"]["service_area"]["first_tab_title"] = $settings["first_tab_title"];
		$args["globals"]["service_area"]["second_tab_title"] = $settings["second_tab_title"];
		$args["globals"]["service_area"]["third_tab_title"] = $settings["third_tab_title"];
		$args["globals"]["service_area"]["fourth_tab_title"] = $settings["fourth_tab_title"];
		$args["globals"]["service_area"]["first_tab_heading"] = $settings["first_tab_heading"];
		$args["globals"]["service_area"]["second_tab_heading"] = $settings["second_tab_heading"];
		$args["globals"]["service_area"]["third_tab_heading"] = $settings["third_tab_heading"];
		$args["globals"]["service_area"]["fourth_tab_heading"] = $settings["fourth_tab_heading"];
		$args["globals"]["service_area"]["first_tab_description_html_allowed"] = $settings["first_tab_description_html_allowed"];
		$args["globals"]["service_area"]["second_tab_description_html_allowed"] = $settings["second_tab_description_html_allowed"];
		$args["globals"]["service_area"]["third_tab_description_html_allowed"] = $settings["third_tab_description_html_allowed"];
		$args["globals"]["service_area"]["fourth_tab_description_html_allowed"] = $settings["fourth_tab_description_html_allowed"];
		$args["globals"]["service_area"]["first_tab_button_text"] = sanitize_text_field($settings["first_tab_button_text"]);
		$args["globals"]["service_area"]["second_tab_button_text"] = sanitize_text_field($settings["second_tab_button_text"]);
		$args["globals"]["service_area"]["third_tab_button_text"] = sanitize_text_field($settings["third_tab_button_text"]);
		$args["globals"]["service_area"]["fourth_tab_button_text"] = sanitize_text_field($settings["fourth_tab_button_text"]);
		$args["globals"]["service_area"]["first_tab_button_link"] = sanitize_text_field($settings["first_tab_button_link"]);
		$args["globals"]["service_area"]["second_tab_button_link"] = sanitize_text_field($settings["second_tab_button_link"]);
		$args["globals"]["service_area"]["third_tab_button_link"] = sanitize_text_field($settings["third_tab_button_link"]);
		$args["globals"]["service_area"]["fourth_tab_button_link"] = sanitize_text_field($settings["fourth_tab_button_link"]);
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
