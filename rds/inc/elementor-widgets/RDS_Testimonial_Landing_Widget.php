<?php
require_once get_template_directory() . "/inc/custom-widget-function.php";
class RDS_Testimonial_Landing_Widget extends \Elementor\Widget_Base
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
        $this->widgetPath = "testimonial/landing"; //Edit
        $this->widgetPathFull = "/global-templates/" . $this->widgetPath . "/";
        $this->allVariation = $this->getFileVariations($this->widgetPath);
    }

    public function get_categories()
    {
        return ["rds-global-widgets"];
    }

    public function get_name()
    {
        return "rds-testimonial-landing-widget";
    }

    public function get_title()
    {
        return "Landing Page Testimonial  Widget";
    }

    public function get_icon()
    {
        return "eicon-testimonial-carousel";
    }

    protected function render()
    {
        $args = json_decode(get_option("rds_template"), true);
        $settings = $this->get_settings();
        $widget_id = $this->get_id();
        $selected_category = $settings["category_filter"];
        $args["category_taxonomy"] = $selected_category;
        if (!empty($settings) && is_array($settings)) {
            if (!empty($this->allVariation) && count($this->allVariation) > 1) {
                $args["globals"]["testimonial"]["variation"] = sanitize_text_field($settings["variation"]);
            }
            $button_link = isset($settings["testimonial_button_link"]) ? sanitize_text_field($settings["testimonial_button_link"]) : "";
            $args["globals"]["testimonial"]["button_link"] = $button_link;
            $args["globals"]["testimonial"]["heading"] = sanitize_text_field($settings["testimonial_heading"]);
            $args["globals"]["testimonial"]["subheading"] = sanitize_text_field($settings["testimonial_subheading"]);
            $args["globals"]["testimonial"]["button_text"] = sanitize_text_field($settings["testimonial_button_text"]);
            $args["globals"]["testimonial"]["category_filter"] = $settings["category_filter"];

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

    protected function _register_controls()
    {
        global $rdsTemplateDataGlobal;
        $args = $rdsTemplateDataGlobal;
        // $args = json_decode(get_option("rds_template"), true);
        // $Testimonial = $args["globals"]["testimonial"];
        $promotionCategory = [
            "taxonomy" => "bc_testimonial_category",
            "orderby" => "name",
            "order" => "ASC",
        ];

        $categoryNames = get_categories($promotionCategory);

        // $catName = [];
        $catName = [
            "all" => esc_html__("all", "rds-testimonial-landing-widget"), // Static 'All' field
        ];
        foreach ($categoryNames as $value) {
            $catName[$value->name] = $value->name;
        }

        if (!empty($categoryNames) && !is_wp_error($categoryNames)) {
            foreach ($categoryNames as $category) {
                $catName[$category->name] = esc_html__($category->name, "rds-testimonial-landing-widget");
            }
        }
        $this->start_controls_section("rds_testimonial", [
            "label" => __("Landing Testimonial", "rds-testimonial-landing-widget"),
        ]);

        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $defaultVariation = isset($args["globals"]["testimonial"]["variation"]) ? $args["globals"]["testimonial"]["variation"] : "a";
            $this->add_control("variation", [
                "label" => "Variation",
                "type" => \Elementor\Controls_Manager::SELECT,
                "default" => $defaultVariation,
                "options" => $this->allVariation,
            ]);
        }
        //   print_r($Testimonial);
        $this->add_control("category_filter", [
            "label" => esc_html__("Select Category", "rds-promotions-widget"),
            "type" => \Elementor\Controls_Manager::SELECT2,
            "label_block" => true,
            "multiple" => true,
            "options" => $catName,
            "default" => ["all"],
        ]);
        $this->add_control("testimonial_heading", [
            "label" => "Heading",
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => 'Our Reviews',
            "condition" => [
                "variation!" => ["a"],
            ],
        ]);

        // Subheading control
        $this->add_control("testimonial_subheading", [
            "label" => "Subheading",
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => 'See What Your Neighbors Are Saying',
        ]);

        // Subheading control
        $this->add_control("testimonial_button_link", [
            "label" => "Button Link",
            "type" => \Elementor\Controls_Manager::TEXT,
            "show_external" => true,
            "default" => '#',
        ]);

        $this->add_control("testimonial_button_text", [
            "label" => "Button Text",
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => 'About us',
        ]);
        $this->end_controls_section();
    }
}
