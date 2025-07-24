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
class RDS_Career_Video_Widget extends Widget_Base
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
		$this->widgetPath = "careers/videos";
		$this->widgetPathFull = "/global-templates/" .$this->widgetPath. "/"; 
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
		return "rds-career--video-widget";
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
		return esc_html__("Career Video Widget", "rds-career--video-widget");
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
		$itemsArray = [
			[
				"item_video_url" => "https://www.youtube.com/embed/Mdip4k5xWrc?enablejsapi=1&rel=0"
			]
		];
		$this->start_controls_section("rds_career_video_widget", [
			"label" => esc_html__(
				"Career Video Widget 6",
				"rds-career-video-widget"
			),
		]);

		if (!empty($this->allVariation) && count($this->allVariation) > 1) {
			$defaultVariation = isset($args["page_templates"]["career_page"]["video"]["variation"]) ? $args["page_templates"]["career_page"]["video"]["variation"] : "a";
			$this->add_control("variation", [
				"label" => "Variation",
				"type" => \Elementor\Controls_Manager::SELECT,
				"default" => $defaultVariation,
				"options" => $this->allVariation,
			]);
		}

		$this->add_control("video_heading", [
			"label" => "Heading",
			"type" => \Elementor\Controls_Manager::TEXTAREA,
			"default" => 'Our culture',
		]);

		$this->add_control("videos_item", [
			"label" => __("Video URL items", "rds-career-video-widget"),
			"type" => \Elementor\Controls_Manager::REPEATER,
			"fields" => [
				[
					"name" => "item_video_url",
					"label" => __("Video URL", "rds-career-video-widget"),
					"type" => \Elementor\Controls_Manager::TEXT,
					"default" =>'https://www.youtube.com/embed/Mdip4k5xWrc?enablejsapi=1&rel=0',
					"label_block" => true,
				],
			],
			"default" => $itemsArray,
			"youtube_field" => "{{{ item_video_url }}}",
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
		if (!empty($this->allVariation) && count($this->allVariation) > 1) {
			$args["page_templates"]["career_page"]["video"]["variation"] = sanitize_text_field($settings["variation"]);
		}
		$itemsArray = [];
		$i = 0;

		if (!empty($settings["videos_item"])) {
			foreach ($settings["videos_item"] as $item1) {
				$itemsArray[$i]["video_url"] = sanitize_text_field(
					$item1["item_video_url"]
				);
				$i++;
			}
		}
		$args["page_templates"]["career_page"]["video"][
			"heading"
		] = sanitize_text_field($settings["video_heading"]);
		$args["page_templates"]["career_page"]["video"]["items"] = $itemsArray;

	
		$get_alt_text = RDS_ALT_DATA;
		$career_banner_alt = "";
		if (is_array($get_alt_text)) {
		    foreach ($get_alt_text as $value) {
		        if (in_array("careers-banner.webp", $value)) {
		            $career_banner_alt = 'alt="' . $value[3] . '"';
		        }
		    }
		}
		?>
    <!-- culture area starts -->
    <div class="container-fluid">
        <div class="container">
            <?php 
			// SAVE TO SPEC
			if ($this->globalPath){
				$this->setFeatureJsonData($args);
			} 
			//RENDER VARIATION
			$variationVal = isset($settings["variation"]) ? sanitize_text_field($settings["variation"]) : 'a';
			set_query_var('settings', $settings);
			get_template_part($this->widgetPathFull.$variationVal,null,$args);
				?> 
        </div>
    </div>
    <?php
	}
}
