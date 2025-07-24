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
require_once get_template_directory() . "/inc/custom-widget-function.php";
class RDS_Career_Perk_Widget extends Widget_Base
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
        $this->widgetPath = "careers/perks";
        $this->widgetPathFull = "/global-templates/" . $this->widgetPath . "/";
        $this->allVariation = $this->getFileVariations($this->widgetPath);
    }

    /**
     * Get widget name.
     *
     * Retrieve career widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return "rds-career-Perk-widget";
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
     * Retrieve career widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__("Career Perks Widget", "rds-career-Perk-widget");
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
     * Retrieve career  widget icon.
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
        return ["career", "tabs", "toggle"];
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
        $i = 0;
        $itemsArray = [
            [
                "item_heading" => "Competitive Wages",
                "item_icon" => "icon-dollar-sign3",
                "item_description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
            ],
        ];
       

        $this->start_controls_section("rds_career_perk_widget", [
            "label" => esc_html__("Career Perk Widget 3", "rds-career-perk-widget"),
        ]);

        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $defaultVariation = isset($args["page_templates"]["career_page"]["perks"]["variation"]) ? $args["page_templates"]["career_page"]["perks"]["variation"] : "a";
            $this->add_control("variation", [
                "label" => "Variation",
                "type" => \Elementor\Controls_Manager::SELECT,
                "default" => $defaultVariation,
                "options" => $this->allVariation,
            ]);
        }

        $this->add_control("perk_items", [
            "label" => __("Perks Items", "rds-career-perk-widget"),
            "type" => \Elementor\Controls_Manager::REPEATER,
            "fields" => [
                [
                    "name" => "item_heading",
                    "label" => __("Heading", "rds-career-perk-widget"),
                    "type" => \Elementor\Controls_Manager::TEXT,
                    "default" => 'Competitive Wages',
                    "label_block" => true,
                ],
                [
                    "name" => "item_icon",
                    "label" => __("Icon", "rds-career-perk-widget"),
                    "type" => \Elementor\Controls_Manager::TEXT,
                    "default" => 'icon-dollar-sign3',
                    "label_block" => true,
                ],
                [
                    "name" => "item_description",
                    "label" => __("Description", "rds-career-perk-widget"),
                    "type" => \Elementor\Controls_Manager::TEXTAREA,
                    "default" => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                    "label_block" => true,
                ],
            ],
            "default" => $itemsArray,
            "heading_field" => "{{{ item_heading }}}",
            "icon_field" => "{{{ item_icon }}}",
            "description_field" => "{{{ item_description }}}",
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
        $perkArray = [];
        $i = 0;
        if (!empty($settings["perk_items"])) {
            foreach ($settings["perk_items"] as $item2) {
                $perkArray[$i]["heading"] = sanitize_text_field($item2["item_heading"]);
                $perkArray[$i]["icon"] = sanitize_text_field($item2["item_icon"]);
                $perkArray[$i]["description"] = sanitize_text_field($item2["item_description"]);
                $i++;
            }
        }

        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $args["page_templates"]["career_page"]["perks"]["variation"] = sanitize_text_field($settings["variation"]);
        }

        $args["page_templates"]["career_page"]["perks"]["items"] = $perkArray;
        // SAVE TO SPEC
        if ($this->globalPath){
            $this->setFeatureJsonData($args);
		}
        //RENDER VARIATION
        $variationVal = isset($settings["variation"]) ? sanitize_text_field($settings["variation"]) : 'a';
        set_query_var('settings', $settings);
        get_template_part($this->widgetPathFull . $variationVal, null, $args);
    }
}
