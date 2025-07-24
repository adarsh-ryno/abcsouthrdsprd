<?php
//namespace Elementor;

if (!defined('ABSPATH')) {
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
require_once get_template_directory() . '/inc/custom-widget-function.php';
class RDS_Career_Employee_Of_The_Month_Widget extends Widget_Base
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
        $this->widgetPath = "careers/employee-Of-the-month";
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
        return 'rds-career-employee-of-the-month-widget';
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
        return esc_html__('Career Employee Of The Month Widget', 'rds-career-employee-of-the-month-widget');
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
        return ['rds-template-widgets'];
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
        return 'eicon-site-identity';
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
        return ['career', 'tabs', 'toggle'];
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
        $itemsArray = [
            [
                "item_name" => "Brandon B",
                "icon_month" => "August",
                "position_field" => "HVAC Specialist",
                "icon_location" => "Anytown",
                "position_state" => "ST",
                "description_field" =>
                    "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer id condimentum a tortor vel. Et et nulla mauris, quam mattis tellus. Gravida morbi volutpat tristique praesent adipiscing nunc sit imperdiet. Sit mauris gravida ut rhoncus vel.",
                "instagram_link_field" => "#",
                "facebook_link_field" => "#",
            ],
        ];

        $this->start_controls_section('rds_career_employe_widget', [
            'label' => esc_html__('Career Employee Of The Month Widget 4', 'rds-career-employee-of-the-month-widget'),
        ]);

        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $defaultVariation = isset($args['page_templates']['career_page']['employee_Of_the_month']['variation']) ? $args['page_templates']['career_page']['employee_Of_the_month']['variation'] : "a";
            $this->add_control("variation", [
                "label" => "Variation",
                "type" => \Elementor\Controls_Manager::SELECT,
                "default" => $defaultVariation,
                "options" => $this->allVariation,
            ]);
        }
        $this->add_control('employe_heading', [
            'label' => 'Heading',
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => 'Employee of the Month',
        ]);

        $this->add_control('employe_items', [
            'label' => __('Employes Items', 'rds-career-employee-of-the-month-widget'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => [
                [
                    'name' => 'item_name',
                    'label' => __('Name', 'rds-career-employee-of-the-month-widget'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => 'Brandon A.',
                    'label_block' => true,
                ],
                [
                    'name' => 'item_month',
                    'label' => __('Month', 'rds-career-employee-of-the-month-widget'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => 'August',
                ],
                [
                    'name' => 'item_position',
                    'label' => __('Position', 'rds-career-employee-of-the-month-widget'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => 'HVAC Specialist',
                ],
                [
                    'name' => 'item_location',
                    'label' => __('Location', 'rds-career-employee-of-the-month-widget'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => 'Anytown',
                ],
                [
                    'name' => 'item_state',
                    'label' => __('State', 'rds-career-employee-of-the-month-widget'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => 'ST',
                ],
                [
                    'name' => 'item_description',
                    'label' => __('Description', 'rds-career-employee-of-the-month-widget'),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'default' =>
                        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer id condimentum a tortor vel. Et et nulla mauris, quam mattis tellus. Gravida morbi volutpat tristique praesent adipiscing nunc sit imperdiet. Sit mauris gravida ut rhoncus vel.',
                    'label_block' => true,
                ],
                [
                    'name' => 'item_instagram_link',
                    'label' => __('Instagram Link', 'rds-career-employee-of-the-month-widget'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => '#',
                    'label_block' => true,
                ],
                [
                    'name' => 'item_facebook_link',
                    'label' => __('Facebook Link', 'rds-career-employee-of-the-month-widget'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => '#',
                    'label_block' => true,
                ],
            ],
            'default' => $itemsArray,
            'name_field' => '{{{ item_name }}}',
            'icon_month' => '{{{ item_month }}}',
            'position_field' => '{{{ item_position }}}',
            'icon_location' => '{{{ item_location }}}',
            'position_state' => '{{{ item_state }}}',
            'description_field' => '{{{ item_description }}}',
            'instagram_link_field' => '{{{ item_instagram_link }}}',
            'facebook_link_field' => '{{{ item_facebook_link }}}',
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
        $employeArray = [];
        $k = 0;
        if (!empty($settings['employe_items'])) {
            foreach ($settings['employe_items'] as $item3) {
                $employeArray[$k]['name'] = sanitize_text_field($item3['item_name']);
                $employeArray[$k]['month'] = sanitize_text_field($item3['item_month']);
                $employeArray[$k]['position'] = sanitize_text_field($item3['item_position']);
                $employeArray[$k]['location'] = sanitize_text_field($item3['item_location']);
                $employeArray[$k]['state'] = sanitize_text_field($item3['item_state']);
                $employeArray[$k]['description'] = sanitize_text_field($item3['item_description']);
                $employeArray[$k]['instagram_link'] = sanitize_text_field($item3['item_instagram_link']);
                $employeArray[$k]['facebook_link'] = sanitize_text_field($item3['item_facebook_link']);
                $k++;
            }
        }
        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $args['page_templates']['career_page']['employee_Of_the_month']['variation'] = sanitize_text_field($settings['variation']);
        }
        $args['page_templates']['career_page']['employee_Of_the_month']['heading'] = sanitize_text_field($settings['employe_heading']);
        $args['page_templates']['career_page']['employee_Of_the_month']['items'] = $employeArray;

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
