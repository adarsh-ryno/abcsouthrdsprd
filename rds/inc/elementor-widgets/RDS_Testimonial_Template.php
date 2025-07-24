<?php
require_once get_template_directory() . "/inc/custom-widget-function.php";
class RDS_Testimonial_Template extends \Elementor\Widget_Base
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
        $this->widgetPath = "testimonial/testimonial-template"; //Edit
        $this->widgetPathFull = "/global-templates/" . $this->widgetPath . "/";
        $this->allVariation = $this->getFileVariations($this->widgetPath);
    }

    public function get_categories()
    {
        return ["rds-global-widgets"];
    }

    public function get_name()
    {
        return "rds-testimonial-template-widget";
    }

    public function get_title()
    {
        return "Testimonial Template Widget";
    }

    public function get_icon()
    {
        return "eicon-testimonial-carousel";
    }

    protected function _register_controls()
    {
        global $rdsTemplateDataGlobal;
        $args = $rdsTemplateDataGlobal;
        // $args = json_decode(get_option("rds_template"), true);
        // $testimonials = $args["page_templates"]["testimonial_page"];
        $promotionCategory = [
            "taxonomy" => "bc_testimonial_category",
            "orderby" => "name",
            "order" => "ASC",
        ];

        $categoryNames = get_categories($promotionCategory);

        // $catName = [];
        $catName = [
            "all" => esc_html__("all", "rds-testimonial-widget"), // Static 'All' field
        ];
        foreach ($categoryNames as $value) {
            $catName[$value->name] = $value->name;
        }

        if (!empty($categoryNames) && !is_wp_error($categoryNames)) {
            foreach ($categoryNames as $category) {
                $catName[$category->name] = esc_html__($category->name, "rds-testimonial-widget");
            }
        }

        $this->start_controls_section("rds_testimonials", [
            "label" => __("Testimonial Widget", "rds-testimonial-template-widget"),
        ]);
        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $defaultVariation = isset($args["page_templates"]["testimonial_page"]["variation"]) ? $args["page_templates"]["testimonial_page"]["variation"] : "a";
            $this->add_control("testimonial_variation", [
                "label" => "Variation",
                "type" => \Elementor\Controls_Manager::SELECT,
                "default" => $defaultVariation,
                "options" => $this->allVariation,
            ]);
        }

        $this->add_control("category_filter", [
            "label" => esc_html__("Select Category", "rds-promotions-widget"),
            "type" => \Elementor\Controls_Manager::SELECT2,
            "label_block" => true,
            "multiple" => true,
            "options" => $catName,
            "default" => ["all"],
        ]);

        $this->add_control("testimonial_subheading", [
            "label" => "Sub Heading",
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => 'See What Your Neighbors Are Saying',
        ]);

        // Gravity Forms list end
        $this->end_controls_section();
    }
    protected function render()
    {
        $settings = $this->get_settings();
        $widget_id = $this->get_id();
        $selected_category = $settings["category_filter"];
        $args["category_taxonomy"] = $selected_category;
        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $args["page_templates"]["testimonial_page"]["variation"] = sanitize_text_field($settings["testimonial_variation"]);
        }
        $args["page_templates"]["testimonial_page"]["subheading"] = sanitize_text_field($settings["testimonial_subheading"]);
        $args["page_templates"]["testimonial_page"]["category_filter"] = $settings["category_filter"];
        // SAVE TO SPEC
        if ($this->globalPath) {
            $this->setFeatureJsonData($args);
        }

        //RENDER VARIATION
        $variationVal = isset($settings["testimonial_variation"]) ? sanitize_text_field($settings["testimonial_variation"]) : 'a'; //FIXED
        set_query_var('settings', $settings);
        get_template_part($this->widgetPathFull . $variationVal, null, $args); //FIXED
    }
}
