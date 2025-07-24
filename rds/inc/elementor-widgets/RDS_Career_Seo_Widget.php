<?php
//namespace Elementor;

if (!defined("ABSPATH")) {
	exit(); // Exit if accessed directly.
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * Elementor accordion widget.
 *
 * Elementor widget that displays a collapsible display of content in an
 * request service style, showing only one item at a time.
 *
 * @since 1.0.0
 */
require_once get_template_directory() . "/inc/custom-widget-function.php";

class RDS_Career_Seo_Widget extends Widget_Base
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

		$this->widgetPath = "careers/seo";
		$this->widgetPathFull = "/global-templates/" . $this->widgetPath . "/";
		$this->allVariation = $this->getFileVariations($this->widgetPath);
	}

	/**
	 * Get widget name.
	 *
	 * Retrieve About Middle content widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return "rds-global-career-seo-widget";
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve About Middle content widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__("Career FAQ Widget", "rds-global-career-seo-widget");
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
		return ["rds-global-widgets"];
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve careerseo  widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return "eicon-tabs";
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
		return ["career faq widget ", "tabs", "toggle"];
	}

	/**
	 * Register About Middle content widget controls.
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
				"question_field" => "Accordion Heading",
				"content_field" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Non eu rhoncus natoque venenatis feugiat mollis. Sed purus quam arcu mauris sit turpis id id."
			]
		];

		$this->start_controls_section("rds_global_careerseo_widget", [
			"label" => esc_html__("Career FAQ Widget", "rds-global-career-seo-widget"),
		]);

		if (!empty($this->allVariation) && count($this->allVariation) > 1) {
			$defaultVariation = isset($args["page_templates"]["career_page"]["variation"]) ? $args["page_templates"]["career_page"]["variation"] : "a";
			$this->add_control("variation", [
				"label" => "Variation",
				"type" => \Elementor\Controls_Manager::SELECT,
				"default" => $defaultVariation,
				"options" => $this->allVariation,
			]);
		}

		$this->add_control("heading", [
			"label" => "Heading",
			"type" => \Elementor\Controls_Manager::TEXT,
			"default" => 'FAQs',
		]);

		$this->add_control("accordion_data", [
			"label" => __("Items", "rds-career-seo-widget"),
			"type" => \Elementor\Controls_Manager::REPEATER,
			"fields" => [
				[
					"name" => "question",
					"label" => __("Question", "rds-career-seo-widget"),
					"type" => \Elementor\Controls_Manager::TEXT,
					"default" => 'Accordion Heading',
					"label_block" => true,
				],
				[
					"name" => "content",
					"label" => __("Content", "rds-career-seo-widget"),
					"type" => \Elementor\Controls_Manager::WYSIWYG,
					"default" => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Non eu rhoncus natoque venenatis feugiat mollis. Sed purus quam arcu mauris sit turpis id id.',
					"label_block" => true,
				],
			],
			"default" => $itemsArray,
			"question_field" => "{{{ question }}}",
			"content_field" => "{{{ content }}}",
		]);

		$this->end_controls_section();
	}

	/**
	 * Render About Middle Content widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render()
	{
		$settings = $this->get_settings();

		if (!empty($settings) && is_array($settings)) {
			$args = [];
			if (!empty($this->allVariation) && count($this->allVariation) > 1) {
				$args["page_templates"]["career_page"]["variation"] = sanitize_text_field($settings["variation"]);
			}

			$i = 0;
			$items_Array = [];

			if (!empty($settings["accordion_data"])) {
				foreach ($settings["accordion_data"] as $item) {
					$items_Array[$i]["question"] = sanitize_text_field($item["question"]);
					$items_Array[$i]["content"] = $item["content"];
					$i++;
				}
			}

			$args["page_templates"]["career_page"]["faq"]["data"] = $items_Array;
			$args["page_templates"]["career_page"]["faq"]["heading"] = sanitize_text_field($settings["heading"]);

        // SAVE TO SPEC
        if ($this->globalPath){
            $this->setFeatureJsonData($args);
		}

			// RENDER VARIATION
			$variationVal = isset($settings["variation"]) ? sanitize_text_field($settings["variation"]) : 'a';
			set_query_var('settings', $settings);
			get_template_part($this->widgetPathFull . $variationVal, null, $args);

			if (!is_admin() && !defined("DOING_AJAX")) {
				// If frontend
			} else {
?>
				<script>
					jQuery(document).ready(function() {
						jQuery('.accordion').on('show.bs.collapse', function(e) {
							toggleIcon(e.target);
						});
						jQuery('.accordion').on('hidden.bs.collapse', function(e) {
							toggleIcon(e.target);
						});
					});

					function toggleIcon(target) {
						var target = jQuery(target).parent('.accordion-item').find('i');
						target.toggleClass('icon-chevron-up4');
						target.toggleClass('icon-chevron-down4');
					}
				</script>
<?php
			}
		}
	}
}
