<?php

if (!defined("ABSPATH")) {
    exit(); // Exit if accessed directly.
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * Elementor Header widget.
 *
 * Elementor widget that displays a collapsible display of content in an
 * Header style, showing only one item at a time.
 *
 * @since 1.0.0
 */

require_once get_template_directory() . "/inc/custom-widget-function.php";
class RDS_Header_Widget extends Widget_Base
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
        if ($data && is_numeric($data['id'])) {
            $this->globalPath = true;
        }
        $this->widgetPath = "header"; //Edit
        $this->widgetPathFull = "/global-templates/" . $this->widgetPath . "/";
        $this->allVariation = $this->getFileVariations($this->widgetPath);
    }

    /**
     * Get widget name.
     *
     * Retrieve Header widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return "rds-header-widget-global";
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

    private $Header_arrya = "";
    private $Header = "";

    /**
     * Get widget title.
     *
     * Retrieve Header widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__("Header", "rds-header-widget-global");
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
     * Retrieve Header widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return "eicon-header";
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
        return ["Header"];
    }

    /**
     * Register header  widget controls.
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
        $this->start_controls_section("rds_global_header_widget", [
            "label" => esc_html__("Header", "rds-global-header--widget"),
        ]);
        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $defaultVariation = isset($args["globals"]["header"]["variation"]) ? $args["globals"]["header"]["variation"] : "a";
            $this->add_control("variation", [
                "label" => "Variation",
                "type" => \Elementor\Controls_Manager::SELECT,
                "default" => $defaultVariation,
                "options" => $this->allVariation,
            ]);
        }
        $this->add_control("call_text", [
            "label" => "Call Text",
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => 'Call Today',
            "condition" => [
                "variation!" => ["c"],
            ],
        ]);

        $this->add_control("phone_number", [
            "label" => "Phone Number",
            "type" => \Elementor\Controls_Manager::WYSIWYG,
            "default" => '5555555555',
            "condition" => [
                "variation!" => ["a", "b", "c"],
            ],
        ]);

        $this->end_controls_section();

        $this->start_controls_section("desktop_schedule_online_h_button", [
            "label" => esc_html__("Desktop Schedule Online Button", "rds-global-announcement-bar-widget"),
            "condition" => [
                "variation!" => ["c"],
            ],
        ]);
        $this->add_control("desktop_schedule_online_h_enable", [
            "name" => "desktop_schedule_online_h_enable",
            "label" => "Enable Schedule Online",
            "type" => \Elementor\Controls_Manager::SWITCHER,
            "label_on" => "Yes",
            "label_off" => "No",
            "default" => "yes",
        ]);
        $this->add_control("desktop_schedule_online_h_label", [
            "name" => "desktop_schedule_online_h_label",
            "label" => "Label",
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => 'Schedule Service',
        ]);
        $this->add_control("desktop_schedule_online_button_h_type", [
            "label" => "Schedule Online Type",
            "type" => \Elementor\Controls_Manager::SELECT,
            "options" => [
                "service_titan" => "Service Titan",
                "schedule_engine" => "Schedule Engine",
                "url" => "URL",
            ],
            "default" => 'service_titan',
        ]);
        $this->add_control("desktop_schedule_online_h_url", [
            "label" => "URL",
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => '/schedule-service',
            "condition" => [
                "desktop_schedule_online_button_h_type" => "url",
                "variation!" => ["c"],
            ],
        ]);
        $this->add_control("desktop_schedule_online_h_icon_class", [
            "label" => "Icon",
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => 'icon-calendar2',
        ]);
        $this->end_controls_section();

        $this->start_controls_section("mobile_schedule_h_online", [
            "label" => esc_html__("Mobile Schedule Online Button ", "rds-global-announcement-bar-widget"),
            "condition" => [
                "variation!" => ["d"],
            ],
        ]);
        $this->add_control("schedule_online_h_enable", [
            "label" => "Enable Schedule Online",
            "type" => \Elementor\Controls_Manager::SWITCHER,
            "label_on" => "Yes",
            "label_off" => "No",
            "default" => "yes",
        ]);
        $this->add_control("schedule_online_h_label", [
            "label" => "Label",
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => 'Schedule Service',
        ]);
        $this->add_control("schedule_online_h_type", [
            "label" => "Schedule Online Type",
            "type" => \Elementor\Controls_Manager::SELECT,
            "options" => [
                "service_titan" => "Service Titan",
                "schedule_engine" => "Schedule Engine",
                "url" => "URL",
            ],
            "default" => 'service_titan',
        ]);
        $this->add_control("schedule_online_h_url", [
            "label" => "URL",
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => "/schedule-service",
            "condition" => [
                "schedule_online_h_type" => "url",
                "variation!" => ["c"],
            ],
        ]);
        $this->add_control("schedule_online_h_icon_class", [
            "label" => "Icon",
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => "icon-calendar-check1",
        ]);
        $this->end_controls_section();
    }

    /**
     * Render header  widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings();
        global $rdsTemplateDataGlobal;
        $args = $rdsTemplateDataGlobal;
        // $args = $this->Header_arrya;
        //Header Part start
        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $args["globals"]["header"]["variation"] = sanitize_text_field($settings["variation"]);
        }
        $args["globals"]["header"]["call_text"] = sanitize_text_field($settings["call_text"]);
        $args["globals"]["header"]["phone_number"] = sanitize_text_field($settings["phone_number"]);
        //  //desktop_schedule_online_button start
        $args["globals"]["desktop_schedule_online_button"]["type"] = sanitize_text_field($settings["desktop_schedule_online_button_h_type"]);
        $args["globals"]["desktop_schedule_online_button"]["enabled"] = sanitize_text_field($settings["desktop_schedule_online_h_enable"]) ? true : false;
        $args["globals"]["desktop_schedule_online_button"]["url"] = isset($settings["desktop_schedule_online_h_url"]) ? sanitize_text_field($settings["desktop_schedule_online_h_url"]) : "";
        $args["globals"]["desktop_schedule_online_button"]["label"] = sanitize_text_field($settings["desktop_schedule_online_h_label"]);
        $args["globals"]["desktop_schedule_online_button"]["icon_class"] = sanitize_text_field($settings["desktop_schedule_online_h_icon_class"]);
        //desktop_schedule_online_button end
        //mobile_schedule_online  start
        $args["globals"]["ctas"]["schedule_online"]["type"] = sanitize_text_field($settings["schedule_online_h_type"]);
        $args["globals"]["ctas"]["schedule_online"]["enabled"] = sanitize_text_field($settings["schedule_online_h_enable"]) ? true : false;
        $args["globals"]["ctas"]["schedule_online"]["url"] = isset($settings["schedule_online_h_url"]) ? sanitize_text_field($settings["schedule_online_h_url"]) : "";
        $args["globals"]["ctas"]["schedule_online"]["label"] = sanitize_text_field($settings["schedule_online_h_label"]);
        $args["globals"]["ctas"]["schedule_online"]["icon_class"] = sanitize_text_field($settings["schedule_online_h_icon_class"]);

        // SAVE TO SPEC
        if ($this->globalPath) {
            $this->setFeatureJsonData($args);
        }

        //RENDER VARIATION
        $variationVal = isset($settings["variation"]) ? sanitize_text_field($settings["variation"]) : 'a'; //FIXED
        set_query_var('settings', $settings);
        get_template_part($this->widgetPathFull . $variationVal, null, $args); //FIXED
    }
}
