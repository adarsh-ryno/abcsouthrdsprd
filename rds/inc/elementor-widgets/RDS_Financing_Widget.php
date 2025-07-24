<?php

// namespace Elementor;
if (!defined("ABSPATH")) {
    exit(); // Exit if accessed directly.
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * Elementor accordion widget.
 *
 * Elementor widget that displays a collapsible display of content in an
 * cta style, showing only one item at a time.
 *
 * @since 1.0.0
 */
require_once get_template_directory() . "/inc/custom-widget-function.php";

class RDS_Financing_Widget extends Widget_Base
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
        $this->widgetPath = "fullwidth-cta";
        $this->widgetPathFull = "/global-templates/" . $this->widgetPath . "/";
        $this->allVariation = $this->getFileVariations($this->widgetPath);
    }

    /**
     * Get widget name.
     *
     * Retrieve Financing widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return "rds-global-financing-widget";
    }

    /**
     * Get widget title.
     *
     * Retrieve Financing  widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__("Financing", "rds-global-financing-widget");
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
        return "eicon-single-post";
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
        return ["financing", "tabs", "toggle"];
    }

    /**
     * Register Financing  widget controls.
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
        $this->start_controls_section("rds_global_financing_widget", [
            "label" => esc_html__(
                "Global Financing Widget",
                "rds-global-Financing-widget"
            ),
        ]);

        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $defaultVariation = isset($args["globals"]["financing"]["variation"]) ? $args["globals"]["financing"]["variation"] : "a";
            $this->add_control("variation", [
                "label" => "Variation",
                "type" => \Elementor\Controls_Manager::SELECT,
                "default" =>  $defaultVariation,
                "options" => $this->allVariation,
            ]);
        }

        $this->add_control("heading", [
            "label" => "Heading",
            "type" => \Elementor\Controls_Manager::TEXTAREA,
            "default" => '[ Insert Financing Percentage Rate + Months Offer ]',
        ]);

        $this->add_control("subheading", [
            "label" => "Subheading",
            "type" => \Elementor\Controls_Manager::TEXTAREA,
            "default" => 'Same Day Approval',
        ]);

        $this->add_control("button_text", [
            "label" => "Button Text",
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => 'Learn More',
            "condition" => [
                "variation!" => ["b"],
            ],
        ]);

        $this->add_control("button_link", [
            "label" => "Button Link",
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => '/financing',
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
        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $args["globals"]["financing"]["variation"] = sanitize_text_field($settings["variation"]);
        }
        $args["globals"]["financing"]["heading"] = $settings["heading"];
        $args["globals"]["financing"]["subheading"] = $settings["subheading"];
        $args["globals"]["financing"]["button_link"] = sanitize_text_field($settings["button_link"]);
        $args["globals"]["financing"]["button_text"] = sanitize_text_field($settings["button_text"]);

              // SAVE TO SPEC
              if ($this->globalPath){
                $this->setFeatureJsonData($args);
            }
        // RENDER VARIATION
        $variationVal = isset($settings["variation"]) ? sanitize_text_field($settings["variation"]) : 'a';
        set_query_var('settings', $settings);
        get_template_part($this->widgetPathFull . $variationVal, null, $args);
    }
}
