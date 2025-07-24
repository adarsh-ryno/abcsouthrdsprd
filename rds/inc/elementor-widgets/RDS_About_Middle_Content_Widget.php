<?php
//namespace Elementor;

if (!defined('ABSPATH')) {
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
require_once get_template_directory() . '/inc/custom-widget-function.php';
class RDS_About_Middle_Content_Widget extends Widget_Base
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
        $this->widgetPath = "about-us/middle-content";
        $this->widgetPathFull = "/global-templates/" . $this->widgetPath . "/";
        $this->allVariation = $this->getFileVariations($this->widgetPath);
    }

    /**
     * Get widget name.
     *
     * Retrieve About Middle content widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'rds-global-about-middle-content-widget';
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
     * Retrieve About Middle content widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__('About Middle Content Widget', 'rds-global-about-middle-content-widget');
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
        return ['rds-global-widgets'];
    }

    /**
     * Get widget icon.
     *
     * Retrieve aboutContent  widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-tabs';
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
        return ['about middle content widget ', 'tabs', 'toggle'];
    }

    /**
     * Register About Middle content widget controls.
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
        $this->start_controls_section('rds_global_aboutContent_widget', [
            'label' => esc_html__('About Middle Content Widget', 'rds-global-about-middle-content-widget'),
        ]);

        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $defaultVariation = isset($args['page_templates']['about_us_page']['middle_content']['variation']) ? $args['page_templates']['about_us_page']['middle_content']['variation'] : "a";
            $this->add_control("variation", [
                "label" => "Variation",
                "type" => \Elementor\Controls_Manager::SELECT,
                "default" => $defaultVariation,
                "options" => $this->allVariation,
            ]);
        }
        $this->add_control('middle_content', [
            'label' => 'Middle Content',
            'type' => \Elementor\Controls_Manager::WYSIWYG,
            "default" => "Lorem Ipsum Gen",
        ]);

        $this->end_controls_section();
    }

    /**
     * Render About Middle Content widget output on the frontend.
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
            $args['page_templates']['about_us_page']['middle_content']['variation'] = sanitize_text_field($settings['variation']);
        }
        $args['page_templates']['about_us_page']['middle_content'] = $settings['middle_content'];
        // SAVE TO SPEC
            $this->setFeatureJsonData($args);
        //RENDER VARIATION
        $variationVal = isset($settings["variation"]) ? sanitize_text_field($settings["variation"]) : 'a';
        set_query_var('settings', $settings);
        get_template_part($this->widgetPathFull . $variationVal, null, $args);
    }
}
