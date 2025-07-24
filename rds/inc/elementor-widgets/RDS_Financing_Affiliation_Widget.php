<?php
require_once get_template_directory() . "/inc/custom-widget-function.php";
class RDS_Financing_Affiliation_Widget extends \Elementor\Widget_Base
{
    use FileVariations;
    use FeatureJSONUpdate;
    public $allVariation;
    public $widgetPath;
public $widgetPathFull;
    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);

        $this->widgetPath = "affiliation/finance";
        $this->widgetPathFull = "/global-templates/" . $this->widgetPath . "/";
        $this->allVariation = $this->getFileVariations($this->widgetPath);
    }
    public function get_categories()
    {
        return ["rds-global-widgets"];
    }
    public function get_name()
    {
        return "rds-financing-affiliation-widget";
    }
    public function get_title()
    {
        return "Financing Affiliation Widget";
    }
    public function get_icon()
    {
        return "eicon-nested-carousel";
    }
    public function render()
    {
        global $rdsTemplateDataGlobal;
        $args = $rdsTemplateDataGlobal;
        $settings = $this->get_settings();
        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $args["page_templates"]["finance_page"]["affiliation"]["variation"] = sanitize_text_field($settings["variation"]);
        }
        $args["page_templates"]["finance_page"]["affiliation"]["count"] = sanitize_text_field($settings["finance_affiliation_count"]);

        // SAVE TO SPEC
            $this->setFeatureJsonData($args);
        //RENDER VARIATION
        $variationVal = isset($settings["variation"]) ? sanitize_text_field($settings["variation"]) : 'a';
        set_query_var('settings', $settings);
        get_template_part($this->widgetPathFull . $variationVal, null, $args);
    }
    public function _register_controls()
 
    {
        global $rdsTemplateDataGlobal;
        $args = $rdsTemplateDataGlobal;
        $affiliation = $args["page_templates"]["finance_page"]["affiliation"];
        $this->start_controls_section("financing_affiliation_section", [
            "label" => __("Financing Affiliation Widget", "rds-financing-affiliation-widget"),
        ]);
        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $defaultVariation = isset($args["page_templates"]["finance_page"]["affiliation"]["variation"]) ? $args["page_templates"]["finance_page"]["affiliation"]["variation"] : "a";
            $this->add_control("variation", [
                "label" => "Variation",
                "type" => \Elementor\Controls_Manager::SELECT,
                "default" => $defaultVariation,
                "options" => $this->allVariation,
            ]);
        }
        $this->add_control("finance_affiliation_count", [
            "label" => "Count",
            "type" => \Elementor\Controls_Manager::NUMBER,
            "default" => isset($affiliation["count"]) ? $affiliation["count"] : 1,
            "min" => 1,
        ]);
        $this->end_controls_section();
    }
}
