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
class RDS_Request_Service_Widget extends Widget_Base
{
    use FileVariations;
    use FeatureJSONUpdate;
    public $variationIsset = false;
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
        $this->widgetPath = "request-service";
        $this->allVariation = $this->getFileVariations($this->widgetPath);
    }

    /**
     * Get widget name.
     *
     * Retrieve request widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return "rds-global-request-service-widget";
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

    private $request_arrya = "";
    private $request = "";

    /**
     * Get widget title.
     *
     * Retrieve request service widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__("Request Service", "polaris-rds");
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
        return "eicon-site-identity";
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
        return ["request service", "tabs", "toggle"];
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
     * Register request service  widget controls.
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
        $this->start_controls_section("rds_global_request_service_widget", [
            "label" => esc_html__("Global Request Service Widget", "polaris-rds"),
        ]);

        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $options = [];
            foreach ($this->allVariation as $key => $value) {
                $options[$key] = $value;
            }
            $defaultVariation = isset($args["globals"]["request_service"]["variation"]) ? $args["globals"]["request_service"]["variation"] : "a";
            $this->add_control("variation", [
                "label" => esc_html__("Variation", "polaris-rds"),
                "type" => Controls_Manager::SELECT,
                "default" => $defaultVariation,
                "options" => $options,
            ]);
        }

        $this->add_control("heading", [
            "label" => "Heading",
            "type" => \Elementor\Controls_Manager::TEXTAREA,
            "default" => 'Request Service',
        ]);

        // Gravity Forms list start
        $Form_list = $this->get_gravity_forms_list();
        $this->add_control("gravity_form_id", [
            "label" => "Gravity Forms",
            "type" => \Elementor\Controls_Manager::SELECT,
            "options" => $Form_list,
            "default" => '4',
        ]);
        // Gravity Forms list end
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
        // $args = $this->request_arrya;
        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $args["globals"]["request_service"]["variation"] = sanitize_text_field($settings["variation"]);
        }
        $args["globals"]["request_service"]["heading"] = $settings["heading"];
        $args["globals"]["request_service"]["gravity_form_id"] = sanitize_text_field($settings["gravity_form_id"]);

         // SAVE TO SPEC
         if ($this->globalPath){
            $this->setFeatureJsonData($args);
		}

        //RENDER VARIATION
        $folderath = "/global-templates/" . $this->widgetPath . "/";
        $variationVal = isset($settings["variation"]) ? sanitize_text_field($settings["variation"]) : 'a';
        set_query_var('settings', $settings);
        get_template_part($folderath . $variationVal, null, $args);
    }
}
