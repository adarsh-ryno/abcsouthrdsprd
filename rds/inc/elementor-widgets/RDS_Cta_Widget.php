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
 * cta style, showing only one item at a time.
 *
 * @since 1.0.0
 */
require_once get_template_directory() . '/inc/custom-widget-function.php';
class RDS_Cta_Widget extends Widget_Base
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
        $this->widgetPath = "cta";
        $this->widgetPathFull = "/global-templates/" . $this->widgetPath . "/";
        $this->allVariation = $this->getFileVariations($this->widgetPath);
    }

    /**
     * Get widget name.
     *
     * Retrieve cta widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'rds-global-cta-widget';
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
     * Retrieve cta  widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__('CTA', 'rds-global-cta-widget');
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
     * Retrieve request service  widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-shortcode';
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
        return ['cta', 'tabs', 'toggle'];
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
     * Register cta  widget controls.
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
        $this->start_controls_section('rds_global_cta_widget', [
            'label' => esc_html__('Global CTA Widget', 'rds-global-cta-widget'),
        ]);

        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $defaultVariation = isset($args['globals']['in_content_cta']['variation']) ? $args['globals']['in_content_cta']['variation'] : "a";
            $this->add_control("variation", [
                "label" => "Variation",
                "type" => \Elementor\Controls_Manager::SELECT,
                "default" => $defaultVariation,
                "options" => $this->allVariation,
            ]);
        }
        $this->add_control('icon_class', [
            'label' => 'Icon Class',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'fa-group',
            'condition' => [
                "variation!" => ["b"],
            ],
        ]);

        $this->add_control('heading', [
            'label' => 'Heading',
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => '24/7 Emergency Service',
        ]);

        $this->add_control('button_text', [
            'label' => 'Button Text',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Schedule Service',
        ]);

        $this->add_control('cta_id', [
            'label' => esc_html__('ID', 'rds-global-cta-widget'),
            'type' => Controls_Manager::SELECT,
            'options' => [
                '' => esc_html__('Select', 'rds-global--widget'),
                'service_titan' => esc_html__('Service Titan', 'rds-global--widget'),
                'schedule_engine' => esc_html__('Schedule Engine', 'rds-global--widget'),
            ],
            'default' => 'service_titan',
        ]);

        $this->add_control('title_class', [
            'label' => 'Title Class',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'title-class',
        ]);

        $this->add_control('button_class', [
            'label' => 'Button Class',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'button-class',
        ]);

        $this->add_control('telephone_class', [
            'label' => 'Telephone Class',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'telephone-class',
            'condition' => [
                "variation!" => ["b"],
            ],
        ]);
        $this->add_control('button_link', [
            'label' => 'Button Link',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '/contact-us',
        ]);
        $this->add_control('target', [
            'label' => 'Open In New Window',
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => 'true',
            'label_off' => 'false',
            'default' => 'yes',
        ]);
        $this->add_control('phone', [
            'label' => 'Phone Number',
            'type' => \Elementor\Controls_Manager::WYSIWYG,
            'default' => '(555) 555-5555',
            'condition' => [
                "variation!" => ["b"],
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
        //GET SETTINGS VALUE
        $settings = $this->get_settings();
        global $rdsTemplateDataGlobal;
        $args = $rdsTemplateDataGlobal;

        //CREATE ARRAY FOR SPEC FILE
        // CHECK IF ANY VARIATION
        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $args['globals']['in_content_cta']['variation'] = sanitize_text_field($settings['variation']);
        }
        $args['globals']['in_content_cta']['icon_class'] = sanitize_text_field($settings['icon_class']);
        $args['globals']['in_content_cta']['title_class'] = sanitize_text_field($settings['title_class']);
        $args['globals']['in_content_cta']['button_class'] = sanitize_text_field($settings['button_class']);
        $args['globals']['in_content_cta']['telephone_class'] = sanitize_text_field($settings['telephone_class']);
        $args['globals']['in_content_cta']['heading'] = $settings['heading'];
        $args['globals']['in_content_cta']['target'] = sanitize_text_field($settings['target']) ? true : false;
        $args['globals']['in_content_cta']['phone'] = sanitize_text_field($settings['phone']);
        $args['globals']['in_content_cta']['button_link'] = sanitize_text_field($settings['button_link']);
        $args['globals']['in_content_cta']['button_text'] = $settings['button_text'];
        $args['globals']['in_content_cta']['id'] = sanitize_text_field($settings['cta_id']);

        // SAVE TO SPEC
        if ($this->globalPath) {
            $this->setFeatureJsonData($args);
        }
        //RENDER VARIATION
        $variationVal = isset($settings["variation"]) ? sanitize_text_field($settings["variation"]) : 'a';
        set_query_var('settings', $settings);
        get_template_part($this->widgetPathFull . $variationVal, null, $args);
    }
}
