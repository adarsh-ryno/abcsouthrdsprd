<?php
require_once get_template_directory() . "/inc/custom-widget-function.php";
class RDS_Services_Widget extends \Elementor\Widget_Base
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
        $this->widgetPath = "services/";
        $this->widgetPathFull = "/global-templates/" . $this->widgetPath . "/";
        $this->allVariation = $this->getFileVariations($this->widgetPath);
    }

    public function get_categories()
    {
        return ["rds-global-widgets"];
    }

    public function get_name()
    {
        return "rds-services-widget";
    }

    public function get_title()
    {
        return "RDS Services";
    }

    public function get_icon()
    {
        return "eicon-nested-carousel";
    }
    public function _register_controls()
    {
        global $rdsTemplateDataGlobal;
        $args = $rdsTemplateDataGlobal;
        $itemsArray = [
            [
                "item_icon" => "icon-air-conditioner1",
                "item_title" => "Service1",
                "item_link" => "/service-subpage-sidebar/",
            ],
        ];

        $this->start_controls_section("services_section", [
            "label" => __("Services", "rds-services-widget"),
        ]);

        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $defaultVariation = isset($args["globals"]["services"]["variation"]) ? $args["globals"]["services"]["variation"] : "a";
            $this->add_control("variation", [
                "label" => "Variation",
                "type" => \Elementor\Controls_Manager::SELECT,
                "default" => $defaultVariation,
                "options" => $this->allVariation,
            ]);
        }

        $this->add_control("top_border_class", [
            "label" => "Top Border Class",
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => 'border-top-tertiary-lg-10',
        ]);

        $this->add_control("services_accordion_items", [
            "label" => __("Services Items", "rds-services-widget"),
            "type" => \Elementor\Controls_Manager::REPEATER,
            "fields" => [
                [
                    "name" => "item_icon",
                    "label" => __("Icon", "rds-services-widget"),
                    "type" => \Elementor\Controls_Manager::TEXT,
                    "default" => "icon-air-conditioner1",
                    "label_block" => true,
                ],
                [
                    "name" => "item_title",
                    "label" => __("Title", "rds-services-widget"),
                    "type" => \Elementor\Controls_Manager::TEXT,
                    "default" => "Service1",
                    "label_block" => true,
                ],
                [
                    "name" => "item_link",
                    "label" => __("Link", "rds-services-widget"),
                    "type" => \Elementor\Controls_Manager::TEXT,
                    "default" => "/service-subpage-sidebar/",
                    "label_block" => true,
                ],
            ],
            "default" => $itemsArray,
            "icon_field" => "{{{ item_icon }}}",
            "title_field" => "{{{ item_title }}}",
            "link_field" => "{{{ item_link }}}",
        ]);

        $this->end_controls_section();
    }
    public function render()
    {
        $settings = $this->get_settings();
        global $rdsTemplateDataGlobal;
        $args = $rdsTemplateDataGlobal;
        $serviceArray = [];
        $i = 0;
        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $args['globals']['services']['variation'] = sanitize_text_field($settings['variation']);
        }
        if (!empty($settings['services_accordion_items'])) {

            foreach ($settings['services_accordion_items'] as $item) {
                $serviceArray[$i]['icon'] = sanitize_text_field($item['item_icon']);
                $serviceArray[$i]['title'] = $item['item_title'];
                $serviceArray[$i]['link'] = sanitize_text_field($item['item_link']);
                $i++;
            }
            $args['globals']['services']['items'] = $serviceArray;
            $args['globals']['services']['top_border_class'] = sanitize_text_field($settings['top_border_class']);
            // SAVE TO SPEC
            if ($this->globalPath) {
                $this->setFeatureJsonData($args);
            }
            //RENDER VARIATION
            $variationVal = isset($settings["variation"]) ? sanitize_text_field($settings["variation"]) : 'a';
            set_query_var('settings', $settings);
            get_template_part($this->widgetPathFull . $variationVal, null, $args);
            ?>
				<div class="d-lg-none d-block">
					<?php get_template_part('global-templates/form/hero/mobile/' . $args['globals']['hero']['variation'], null, $args); ?>
				</div>
				<?php
        }
    }
}
