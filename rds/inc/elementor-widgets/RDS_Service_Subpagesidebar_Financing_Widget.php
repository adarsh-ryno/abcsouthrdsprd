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
 * financing service style, showing only one item at a time.
 *
 * @since 1.0.0
 */
require_once get_template_directory() . "/inc/custom-widget-function.php";
class RDS_Service_Subpagesidebar_Financing_Widget extends Widget_Base
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
        $this->widgetPath = "fullwidth-cta/service-subpage"; //Edit
        $this->widgetPathFull = "/global-templates/" . $this->widgetPath . "/";
        $this->allVariation = $this->getFileVariations($this->widgetPath);
    }

    /**
     * Get widget name.
     *
     * Retrieve service subpagesidebar financing widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return "rds-global-service-subpagesidebar-financing-widget";
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

    private $service_subpagesidebarfinancing_array = "";
    private $service_subpagesidebarfinancing = "";

    /**
     * Get widget title.
     *
     * Retrieve service subpagesidebar financing  widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__("Service Subpagesidebar financing Service Widget", "rds-global-service-subpagesidebar-financing-widget");
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
     * Retrieve service subpagesidebar financing  widget icon.
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
        return ["service subpagesidebar financing", "tabs", "toggle"];
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
     * Register service subpagesidebarfinancing widget controls.
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
        $this->start_controls_section("rds_global_service_subpagesidebar_financing_widget", [
            "label" => esc_html__("Global Financing Service Subpage Sidebar ", "rds-global-service-subpagesidebar-financing-widget"),
        ]);

        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $defaultVariation = isset($args["page_templates"]["service_subpage"]["financing"]["variation"]) ? $args["page_templates"]["service_subpage"]["financing"]["variation"] : "a";
            $options = [];
            foreach ($this->allVariation as $key => $value) {
                $options[$key] = esc_html__($value, "rds-global-service-subpagesidebar-financing-widget");
            }
            $this->add_control("variation", [
                "label" => esc_html__("Variation", "rds-global-service-subpagesidebar-financing-widget"),
                "type" => Controls_Manager::SELECT,
                "default" => $defaultVariation,
                "options" => $options,
            ]);
        }
        $this->add_control("heading", [
            "label" => "Heading",
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => 'Lorem Ipsum Gen Dolor',
        ]);

        $this->add_control("subheading", [
            "label" => "SubHeading",
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => 'Ipsum Gen',
        ]);

        $this->add_control("button_text", [
            "label" => "Button Text",
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => 'LEARN MORE',
            "condition" => [
                "variation!" => ["b"],
            ],
        ]);

        $this->add_control("button_link", [
            "label" => "Button Link",
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => '/contact-us-today',
        ]);
        $this->end_controls_section();
    }

    /**
     * Render financing widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings();
        // $args = $this->service_subpagesidebarfinancing_array;
        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $args["page_templates"]["service_subpage"]["financing"]["variation"] = sanitize_text_field($settings["variation"]);
        }
        $args["page_templates"]["service_subpage"]["financing"]["heading"] = sanitize_text_field($settings["heading"]);
        $args["page_templates"]["service_subpage"]["financing"]["subheading"] = sanitize_text_field($settings["subheading"]);
        $args["page_templates"]["service_subpage"]["financing"]["button_text"] = sanitize_text_field($settings["button_text"]);
        $args["page_templates"]["service_subpage"]["financing"]["button_link"] = sanitize_text_field($settings["button_link"]);

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
