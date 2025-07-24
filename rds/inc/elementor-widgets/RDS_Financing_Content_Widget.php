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
class RDS_Financing_Content_Widget extends Widget_Base
{
    use FileVariations;
    use FeatureJSONUpdate;
    public $allVariation;
    public $widgetPath;
public $widgetPathFull;
    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);

        $this->widgetPath = "financing/content";
        $this->widgetPathFull = "/global-templates/" . $this->widgetPath . "/";
        $this->allVariation = $this->getFileVariations($this->widgetPath);
    }

    /**
     * Get widget name.
     *
     * Retrieve financing content widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return "rds-global-financing-content-widget";
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

    /**
     * Get widget title.
     *
     * Retrieve financing content  widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__("Financing Content Widget", "rds-global-financing-content-widget");
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
     * Retrieve financing content  widget icon.
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
        return ["financing content ", "tabs", "toggle"];
    }

    /**
     * Register financing content widget controls.
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
        $this->start_controls_section("rds_global_financing_content_widget", [
            "label" => esc_html__("Financing Content Widget", "rds-global-financing-content-widget"),
        ]);

        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $defaultVariation = isset($args["page_templates"]["finance_page"]["variation"]) ? $args["page_templates"]["finance_page"]["variation"] : "a";
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
            "default" => 'Need Financing?',
        ]);

        $this->add_control("subheading", [
            "label" => "SubHeading",
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => 'BUY TODAY, PAY OVER TIME',
        ]);
        $this->add_control("button_text", [
            "label" => "Button Text",
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => 'Learn more',
        ]);

        $this->add_control("button_link", [
            "label" => "Button Link",
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => '/financing',
        ]);

        $this->add_control("target", [
            "label" => "Open In New Window",
            "type" => \Elementor\Controls_Manager::SWITCHER,
            "label_on" => "true",
            "label_off" => "false",
            "default" => 'yes',
        ]);

        $this->add_control("content", [
            "label" => "Content",
            "type" => \Elementor\Controls_Manager::WYSIWYG,
            "default" =>
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Euismod nisi, cursus at ultricies a. Auctor turpis amet sagittis nunc, vel blandit amet ultrices. Lorem tellus egestas volutpat tortor aenean vel. Iaculis purus sed platea non vitae auctor. Fames feugiat sed tristique accumsan nec turpis facilisis posuere sem. Tristique netus integer sed pellentesque. Euismod pulvinar sagittis amet, sodales.',
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
        //GET SETTINGS VALUE
        $settings = $this->get_settings();
        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $args["page_templates"]["finance_page"]["variation"] = sanitize_text_field($settings["variation"]);
        }

        $args["page_templates"]["finance_page"]["heading"] = sanitize_text_field($settings["heading"]);
        $args["page_templates"]["finance_page"]["subheading"] = sanitize_text_field($settings["subheading"]);
        $args["page_templates"]["finance_page"]["button_text"] = sanitize_text_field($settings["button_text"]);
        $args["page_templates"]["finance_page"]["button_link"] = sanitize_text_field($settings["button_link"]);
        $args["page_templates"]["finance_page"]["target"] = sanitize_text_field($settings["target"]) ? true : false;

        $args["page_templates"]["finance_page"]["content"] = $settings["content"];
        // SAVE TO SPEC
            $this->setFeatureJsonData($args);
        //RENDER VARIATION
        $variationVal = isset($settings["variation"]) ? sanitize_text_field($settings["variation"]) : 'a';
        set_query_var('settings', $settings);
        get_template_part($this->widgetPathFull . $variationVal, null, $args);
    }
}
