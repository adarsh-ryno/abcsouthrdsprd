<?php
require_once get_template_directory() . "/inc/custom-widget-function.php";

class RDS_Team_widget extends \Elementor\Widget_Base
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
        $this->widgetPath = "team"; // Edit
        $this->widgetPathFull = "/global-templates/" . $this->widgetPath . "/";
        $this->allVariation = $this->getFileVariations($this->widgetPath);
    }

    public function get_categories()
    {
        return ["rds-global-widgets"];
    }

    public function get_name()
    {
        return "rds-team-widget";
    }

    public function get_title()
    {
        return "Team Page Widget";
    }

    public function get_icon()
    {
        return "eicon-tags";
    }

    protected function _register_controls()
    {
        global $rdsTemplateDataGlobal;
        $args = $rdsTemplateDataGlobal;
        $this->start_controls_section("rds_team", [
            "label" => __("Team Widget", "rds-team-widget"),
        ]);

        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $defaultVariation = isset($args["page_templates"]["team_page"]["variation"]) ? $args["page_templates"]["team_page"]["variation"] : "a";
            $this->add_control("variation", [
                "label" => "Variation",
                "type" => \Elementor\Controls_Manager::SELECT,
                "default" => $defaultVariation,
                "options" => $this->allVariation,
            ]);
        }

        // Subheading control
        $this->add_control("team_subheading", [
            "label" => "Subheading",
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => 'Meet Our Team',
        ]);
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();

        if (!empty($settings) && is_array($settings)) {
            if (!empty($this->allVariation) && count($this->allVariation) > 1) {
                $args["page_templates"]["team_page"]["variation"] = sanitize_text_field($settings["variation"]);
            }
            $args["page_templates"]["team_page"]["subheading"] = sanitize_text_field($settings["team_subheading"]);
            // SAVE TO SPEC
            if ($this->globalPath) {
                $this->setFeatureJsonData($args);
            }
            // RENDER VARIATION
            $variationVal = isset($settings["variation"]) ? sanitize_text_field($settings["variation"]) : 'a';
            set_query_var('settings', $settings);
            get_template_part($this->widgetPathFull . $variationVal, null, $args);
        }
    }
}
?>
