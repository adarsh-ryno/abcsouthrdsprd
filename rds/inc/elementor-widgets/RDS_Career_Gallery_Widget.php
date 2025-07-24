<?php
//namespace Elementor;

if (!defined('ABSPATH')) {
    exit(); // Exit if accessed directly.
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

require_once get_template_directory() . '/inc/custom-widget-function.php';

class RDS_Career_Gallery_Widget extends Widget_Base
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
        $this->widgetPath = "careers/gallery";
        $this->widgetPathFull = "/global-templates/" . $this->widgetPath . "/";
        $this->allVariation = $this->getFileVariations($this->widgetPath);
    }

    public function get_name()
    {
        return 'rds-global-career-gallery-widget';
    }

    public function get_title()
    {
        return esc_html__('Career Gallery Widget', 'rds-global-career-gallery-widget');
    }

    public function get_categories()
    {
        return ['rds-global-widgets'];
    }

    public function get_icon()
    {
        return 'eicon-tabs';
    }

    public function get_keywords()
    {
        return ['career gallery widget ', 'tabs', 'toggle'];
    }

    protected function _register_controls()
    {
        global $rdsTemplateDataGlobal;
        $args = $rdsTemplateDataGlobal;
        $this->start_controls_section('rds_career_job_widget', [
            'label' => esc_html__('Career Gallery Widget', 'rds-career-gallery-widget'),
        ]);
        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $defaultVariation = isset($args['page_templates']['career_page']['career_gallery']['variation']) ? $args['page_templates']['career_page']['career_gallery']['variation'] : "a";
            $this->add_control("variation", [
                "label" => "Variation",
                "type" => \Elementor\Controls_Manager::SELECT,
                "default" =>  $defaultVariation,
                "options" => $this->allVariation,
            ]);
        }
        $this->end_controls_section();
    }

    protected function render()
    {
        // GET SETTINGS VALUE
        $settings = $this->get_settings();
        $args = [];
        // CHECK IF ANY VARIATION
        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $args['page_templates']['career_page']['career_gallery']['variation'] = sanitize_text_field($settings['variation']);
        }
        // SAVE TO SPEC
        if ($this->globalPath) {
            $this->setFeatureJsonData($args);
        }
        ?>
        <div class="container-fluid">
            <div class="container">
                <?php
                // RENDER VARIATION
                $variationVal = isset($settings["variation"]) ? sanitize_text_field($settings["variation"]) : 'a';
                set_query_var('settings', $settings);
                get_template_part($this->widgetPathFull . $variationVal, null, $args);?>
            </div>
        </div>
        <?php
    }
}
