<?php
require_once get_template_directory() . "/inc/custom-widget-function.php";
class RDS_Financing_CTA_Widget extends \Elementor\Widget_Base
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
        $this->widgetPath = "fullwidth-cta/service-subpage";
        $this->widgetPathFull = "/global-templates/" . $this->widgetPath . "/";
        $this->allVariation = $this->getFileVariations($this->widgetPath);
    }

    public function get_categories()
    {
        return ["rds-global-widgets"];
    }

    public function get_name()
    {
        return "rds-financing-cta-widget";
    }

    public function get_title()
    {
        return "Financing CTA";
    }

    public function get_icon()
    {
        return "eicon-call-to-action";
    }

    public function render()
    {
        $settings = $this->get_settings();

        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
                $args["page_templates"]["service_subpage"]["financing"]["variation"] = sanitize_text_field($settings["variation"]);
            }
            $button_link = isset($settings["button_link"]) ? sanitize_text_field($settings["button_link"]) : "";
            $args["page_templates"]["service_subpage"]["financing"]["button_link"] = $button_link;
            $args["page_templates"]["service_subpage"]["financing"]["heading"] = sanitize_text_field($settings["heading"]);
            $args["page_templates"]["service_subpage"]["financing"]["subheading"] = sanitize_text_field($settings["subheading"]);
            $args["page_templates"]["service_subpage"]["financing"]["button_text"] = sanitize_text_field($settings["button_text"]);
            $args["page_templates"]["service_subpage"]["financing"]["heading_tag"] = sanitize_text_field($settings["heading_tag"]);
            $args["page_templates"]["service_subpage"]["financing"]["subheading_tag"] = sanitize_text_field($settings["subheading_tag"]);

         // SAVE TO SPEC
         if ($this->globalPath){
            $this->setFeatureJsonData($args);
		}
            //RENDER VARIATION
            $variationVal = isset($settings["variation"]) ? sanitize_text_field($settings["variation"]) : 'a';
            set_query_var('settings', $settings);
            get_template_part($this->widgetPathFull . $variationVal, null, $args);
    }

    public function _register_controls()
    {
        global $rdsTemplateDataGlobal;
        $args = $rdsTemplateDataGlobal;
        $financing_cta = $args["page_templates"]["service_subpage"]["financing"];
        $this->start_controls_section("rds_financing_cta", [
            "label" => __("Financing CTA", "rds-financing-cta-widget"),
        ]);
        $this->add_control("heading", [
            "label" => "Heading",
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => $financing_cta["heading"],
        ]);
        $this->add_control("heading_tag", [
            "label" => "Heading Tag",
            "type" => \Elementor\Controls_Manager::SELECT,
            "options" => [
                "h1" => "H1",
                "h2" => "H2",
                "h3" => "H3",
                "h4" => "H4",
                "h5" => "H5",
                "h6" => "H6",
                "span" => "span",
                "p" => "p",
            ],
            "default" => "h2",
        ]);
        $this->add_control("subheading", [
            "label" => "Subheading",
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => $financing_cta["subheading"],
        ]);
        $this->add_control("subheading_tag", [
            "label" => "Sub Heading Tag",
            "type" => \Elementor\Controls_Manager::SELECT,
            "options" => [
                "h1" => "H1",
                "h2" => "H2",
                "h3" => "H3",
                "h4" => "H4",
                "h5" => "H5",
                "h6" => "H6",
                "span" => "span",
                "p" => "p",
            ],
            "default" => "h4",
        ]);
        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $defaultVariation = isset($args["page_templates"]["service_subpage"]["financing"]["variation"]) ? $args["page_templates"]["service_subpage"]["financing"]["variation"] : "a";
            $this->add_control("variation", [
                "label" => "Variation",
                "type" => \Elementor\Controls_Manager::SELECT,
                "default" => $defaultVariation,
                "options" => $this->allVariation,
            ]);
        }

        $this->add_control("button_link", [
            "label" => "Button Link",
            "type" => \Elementor\Controls_Manager::TEXT,
            "placeholder" => $financing_cta["button_link"],
            "default" => $financing_cta["button_link"],
        ]);

        $this->add_control("button_text", [
            "label" => "Button Text",
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => $financing_cta["button_text"],
        ]);
        $this->end_controls_section();
    }
}
