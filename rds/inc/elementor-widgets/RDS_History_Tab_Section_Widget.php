<?php
//namespace Elementor;

if (!defined("ABSPATH")) {
    exit(); // Exit if accessed directly.
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Text_Shadow;
//use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

/**
 * Elementor accordion widget.
 *
 * Elementor widget that displays a collapsible display of content in an
 * request service style, showing only one item at a time.
 *
 * @since 1.0.0
 */
class RDS_history_Tab_Section_Widget extends Widget_Base
{
    use FileVariations;
    use FeatureJSONUpdate;
    public $allVariation;
    public $widgetPath;
public $widgetPathFull;
    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);
  
        $this->widgetPath = "history/tab-section";
        $this->widgetPathFull = "/global-templates/" . $this->widgetPath . "/";
        $this->allVariation = $this->getFileVariations($this->widgetPath);
    }

    /**
     * Get widget name.
     *
     * Retrieve history widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return "rds-history-tab-widget";
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

    private $history_array = "";
    private $history = "";

    /**
     * Get widget title.
     *
     * Retrieve history widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__("history Tab Section Widget", "rds-history-tab-widget");
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
        return ["rds-template-widgets"];
    }

    /**
     * Get widget icon.
     *
     * Retrieve history  widget icon.
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
        return ["history tab section", "tabs", "toggle"];
    }

    /**
     * Register history template  widget controls.
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
        // $args = json_decode(get_option("rds_template"), true);
        // $i = 0;
        // $perkItems =
        // 	$args["page_templates"]["history_page"]["tab_section"]["items"];
        // $tabArray = [];
        // foreach ($perkItems as $itemp) {
        // 	$tabArray[$i] = [
        // 		"item_title" => __($itemp["title"], "rds-history-tab-widget"),
        // 		"item_heading" => __(
        // 			$itemp["heading"],
        // 			"rds-history-tab-widget"
        // 		),
        // 		"item_content" => __(
        // 			$itemp["content"],
        // 			"rds-history-tab-widget"
        // 		),
        // 	];
        // 	$i++;
        // }

        $tabArray = [
            [
                "item_title" => "1976",
                "item_heading" => "Apple I",
                "item_content" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
            ],
        ];

        $this->start_controls_section("rds_history_tab_widget", [
            "label" => esc_html__("History Tab Section Widget", "rds-history-tab-widget"),
        ]);

        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $defaultVariation = isset($args["page_templates"]["history_page"]["variation"]) ? $args["page_templates"]["history_page"]["variation"] : "a";
            $this->add_control("variation", [
                "label" => "Variation",
                "type" => \Elementor\Controls_Manager::SELECT,
                "default" =>  $defaultVariation ,
                "options" => $this->allVariation,
            ]);
        }

        $this->add_control("tab_items", [
            "label" => __("Tab Items", "rds-history-tab-widget"),
            "type" => \Elementor\Controls_Manager::REPEATER,
            "fields" => [
                [
                    "name" => "item_title",
                    "label" => __("Title", "rds-history-tab-widget"),
                    "type" => \Elementor\Controls_Manager::TEXT,
                    "default" => __("1976", "rds-history-tab-widget"),
                    "label_block" => true,
                ],
                [
                    "name" => "item_heading",
                    "label" => __("Heading", "rds-history-tab-widget"),
                    "type" => \Elementor\Controls_Manager::TEXT,
                    "default" => __("Apple I", "rds-history-tab-widget"),
                    "label_block" => true,
                ],
                [
                    "name" => "item_content",
                    "label" => __("Content", "rds-history-tab-widget"),
                    "type" => \Elementor\Controls_Manager::WYSIWYG,
                    "default" => __("Lorem ipsum dolor sit amet, consectetur adipiscing elit.", "rds-history-tab-widget"),
                    "label_block" => true,
                ],
            ],
            "default" => $tabArray,
            "title_field" => "{{{ item_title }}}",
            "heading_field" => "{{{ item_heading }}}",
            "content_field" => "{{{ item_content }}}",
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
        // $args = json_decode(get_option("rds_template"), true);
        $settings = $this->get_settings();
        $tabArray = [];
        $i = 0;
        if (!empty($settings["tab_items"])) {
            foreach ($settings["tab_items"] as $item2) {
                $tabArray[$i]["title"] = sanitize_text_field($item2["item_title"]);
                $tabArray[$i]["heading"] = sanitize_text_field($item2["item_heading"]);
                $tabArray[$i]["content"] = $item2["item_content"];
                $i++;
            }
        }
        $args["page_templates"]["history_page"]["tab_section"]["items"] = $tabArray;
        // SAVE TO SPEC
            $this->setFeatureJsonData($args);
        //RENDER VARIATION
        $variationVal = isset($settings["variation"]) ? sanitize_text_field($settings["variation"]) : 'a';
        set_query_var('settings', $settings);
        get_template_part($this->widgetPathFull . $variationVal, null, $args);
    }
}
