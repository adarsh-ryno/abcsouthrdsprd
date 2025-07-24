<?php
if (!defined("ABSPATH")) {
    exit(); // Exit if accessed directly.
}
use Elementor\Widget_Base;
/**
 * Elementor Annoucement Bar widget.
 *
 * Elementor widget that displays a collapsible display of content in an
 * Annoucement Bar style, showing only one item at a time.
 *
 * @since 1.0.0
 */
require_once get_template_directory() . "/inc/custom-widget-function.php";
class RDS_Annoucement_Bar_Widget extends Widget_Base
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
        $this->widgetPath = "announcement";
        $this->widgetPathFull = "/global-templates/" . $this->widgetPath . "/";
        $this->allVariation = $this->getFileVariations($this->widgetPath);
    }
    /**
     * Get widget name.
     *
     * Retrieve Annoucement Bar widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return "rds-global-annoucement-bar-widget";
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
     * Retrieve Annoucement Bar widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__("Announcement Bar", "rds-global-annoucement-bar-widget");
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
     * Retrieve Annoucement Bar widget icon.
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
        return ["Annoucement Bar"];
    }
    /**
     * Register announcement bar widget controls.
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
        $this->start_controls_section("rds_global_announcement_bar_widget", [
            "label" => esc_html__("Announcement Bar", "rds-global-announcement-bar-widget"),
        ]);
        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $defaultVariation = isset($args["globals"]["announcement"]["variation"]) ? $args["globals"]["announcement"]["variation"] : "a";
            $this->add_control("variation", [
                "label" => "Variation",
                "type" => \Elementor\Controls_Manager::SELECT,
                "default" => $defaultVariation,
                "options" => $this->allVariation,
            ]);
        }
        $this->end_controls_section();
        //Left Section control Start
        $this->start_controls_section("rds_global_announcement_left", [
            "label" => esc_html__("Left Section", "rds-global-announcement-bar-widget"),
        ]);
        $this->add_control("left_icon_class", [
            "label" => "Icon",
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => 'icon-clock2',
        ]);
        $this->add_control("left_type", [
            "label" => "Type",
            "type" => \Elementor\Controls_Manager::SELECT,
            "options" => ["hover" => "Hover", "link" => "Link"],
            "default" => 'hover',
        ]);
        $this->add_control("left_url", [
            "label" => "URL",
            "type" => \Elementor\Controls_Manager::TEXT,
            "placeholder" => '/specials',
            "condition" => [
                "left_type" => "link", // Show the control only if "type" is set to "option1"
            ],
            "default" => '/schedule-now',
        ]);
        $this->add_control("left_title", [
            "label" => "Title",
            "type" => \Elementor\Controls_Manager::TEXTAREA,
            "default" => '24/7 Emergency Service',
        ]);
        $this->add_control("left_text", [
            "label" => "Text",
            "type" => \Elementor\Controls_Manager::TEXTAREA,
            "default" => '24/7 Emergency Service',
        ]);
        $this->add_control("tooltip_text", [
            "label" => "Tooltip Text",
            "type" => \Elementor\Controls_Manager::WYSIWYG,
            "condition" => [
                "left_type" => "hover", // Show the control only if "type" is set to "option1"
            ],
            "default" =>
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Euismod nisi, cursus at ultricies a. Auctor turpis amet sagittis nunc, vel blandit amet ultrices. Lorem tellus egestas volutpat tortor aenean vel. Iaculis purus sed platea non vitae auctor',
        ]);
        //Left Section control End
        $this->end_controls_section();
        //Middle Section control Start
        $this->start_controls_section("rds_global_announcement_middle", [
            "label" => esc_html__("Middle Section", "rds-global-announcement-bar-widget"),
            "condition" => ["variation!" => "b"],
        ]);
        $this->add_control("middle_icon_class", [
            "label" => "Icon",
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => 'icon-star1',
        ]);
        $this->add_control("middle_url", [
            "label" => "URL",
            "type" => \Elementor\Controls_Manager::TEXT,
            "show_external" => true,
            "default" => '/reviews',
        ]);
        $this->add_control("middle_title", [
            "label" => "Title",
            "type" => \Elementor\Controls_Manager::TEXTAREA,
            "default" => 'Read Our Reviews',
        ]);
        $this->add_control("middle_text", [
            "label" => "Text",
            "type" => \Elementor\Controls_Manager::TEXTAREA,
            "default" => 'Read Our Reviews',
        ]);
        //Middle Section control End
        $this->end_controls_section();
        //Descktop schedule online  Section control start
        $this->start_controls_section("desktop_schedule_online_button", [
            "label" => esc_html__("Middle Section", "rds-global-announcement-bar-widget"),
            "condition" => ["variation!" => "a"],
        ]);
        $this->add_control("desktop_schedule_online_enable", [
            "name" => "desktop_schedule_online_enable",
            "label" => "Enable Schedule Online",
            "type" => \Elementor\Controls_Manager::SWITCHER,
            "label_on" => "Yes",
            "label_off" => "No",
            "default" => "yes",
        ]);
        $this->add_control("desktop_schedule_online_label", [
            "name" => "desktop_schedule_online_label",
            "label" => "Label",
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => 'Schedule Service',
        ]);
        $this->add_control("desktop_schedule_online_button_type", [
            "label" => "Schedule Online Type",
            "type" => \Elementor\Controls_Manager::SELECT,
            "options" => [
                "service_titan" => "Service Titan",
                "schedule_online" => "Schedule Online",
                "url" => "URL",
            ],
            "default" => 'URL',
        ]);
        $this->add_control("desktop_schedule_online_url", [
            "name" => "desktop_schedule_online_url",
            "label" => "URL",
            "type" => \Elementor\Controls_Manager::TEXT,
            "condition" => ["desktop_schedule_online_button_type" => "url"],
            "default" => '/schedule-service/"',
        ]);
        $this->add_control("desktop_schedule_online_icon_class", [
            "name" => "desktop_schedule_online_icon_class",
            "label" => "Icon",
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => 'icon-calendar2',
        ]);
        $this->end_controls_section();
        //Descktop schedule online  Section control end
        //Schedule online  Section control end
        //Right Section control Start
        $this->start_controls_section("rds_global_announcement_right", [
            "label" => esc_html__("Right Section", "rds-global-announcement-bar-widget"),
        ]);
        $this->add_control("right_icon_class", [
            "label" => "Icon",
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => 'icon-circle-dollar2',
        ]);
        $this->add_control("right_url", [
            "label" => "URL",
            "type" => \Elementor\Controls_Manager::TEXT,
            "show_external" => true,
            "default" => '/specials',
            "condition" => [
                "variation!" => "b", // Show the control only if "type" is set to "option1"
            ],
        ]);
        $this->add_control("right_title", [
            "label" => "Title",
            "type" => \Elementor\Controls_Manager::TEXTAREA,
            "default" => "Deals & Financing",
        ]);
        $this->add_control("right_text", [
            "label" => "Text",
            "type" => \Elementor\Controls_Manager::TEXTAREA,
            "default" => 'sss',
        ]);
        //Right Section control End
        $this->end_controls_section();
    }
    /**
     * Render announcement bar widget output on the frontend.
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
        //LEFT Section start
        $args["globals"]["announcement"]["left"]["icon_class"] = sanitize_text_field($settings["left_icon_class"]);
        $args["globals"]["announcement"]["left"]["type"] = sanitize_text_field($settings["left_type"]);
        $args["globals"]["announcement"]["left"]["title"] = sanitize_text_field($settings["left_title"]);
        $args["globals"]["announcement"]["left"]["text"] = sanitize_text_field($settings["left_text"]);
        $args["globals"]["announcement"]["left"]["url"] = isset($settings["left_url"]) ? sanitize_text_field($settings["left_url"]) : "";
        $args["globals"]["announcement"]["left"]["tooltip_text"] = $settings["tooltip_text"];
        //LEFT Section End
        //MIDDLE Section start
        $args["globals"]["announcement"]["middle"]["icon_class"] = sanitize_text_field($settings["middle_icon_class"]);
        $args["globals"]["announcement"]["middle"]["title"] = sanitize_text_field($settings["middle_title"]);
        $args["globals"]["announcement"]["middle"]["text"] = sanitize_text_field($settings["middle_text"]);
        $args["globals"]["announcement"]["middle"]["url"] = isset($settings["middle_url"]) ? sanitize_text_field($settings["middle_url"]) : "";
        //Middle Section End
        //RIGHT Section start
        $args["globals"]["announcement"]["right"]["icon_class"] = sanitize_text_field($settings["right_icon_class"]);
        $args["globals"]["announcement"]["right"]["title"] = sanitize_text_field($settings["right_title"]);
        $args["globals"]["announcement"]["right"]["text"] = sanitize_text_field($settings["right_text"]);
        $args["globals"]["announcement"]["right"]["url"] = isset($settings["right_url"]) ? sanitize_text_field($settings["right_url"]) : "";
        //RIGHT Section End
        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $args["globals"]["announcement"]["variation"] = sanitize_text_field($settings["variation"]);
        }
        //desktop_schedule_online_button start
        $args["globals"]["announcement"]["desktop_schedule_online_button"]["type"] = sanitize_text_field($settings["desktop_schedule_online_button_type"]);
        $args["globals"]["announcement"]["desktop_schedule_online_button"]["enabled"] = sanitize_text_field($settings["desktop_schedule_online_enable"]) ? true : false;
        $args["globals"]["announcement"]["desktop_schedule_online_button"]["url"] = isset($settings["desktop_schedule_online_url"]) ? sanitize_text_field($settings["desktop_schedule_online_url"]) : "";
        $args["globals"]["announcement"]["desktop_schedule_online_button"]["label"] = sanitize_text_field($settings["desktop_schedule_online_label"]);
        $args["globals"]["announcement"]["desktop_schedule_online_button"]["icon_class"] = sanitize_text_field($settings["desktop_schedule_online_icon_class"]);
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
