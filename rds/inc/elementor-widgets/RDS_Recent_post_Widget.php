<?php
class RDS_Recent_post_Widget extends \Elementor\Widget_Base
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
		$this->widgetPath = "blog/recent-post";
		$this->widgetPathFull = "/global-templates/" . $this->widgetPath . "/"; 
		$this->allVariation = $this->getFileVariations($this->widgetPath);
	}

	public function get_categories()
	{
		return ["rds-global-widgets"];
	}

	public function get_name()
	{
		return "rds-single-page-widget";
	}

	public function get_title()
	{
		return "Recent Post Page Widget";
	}

	public function get_icon()
	{
		return "eicon-testimonial-carousel";
	}

	protected function register_controls()
	{
		global $rdsTemplateDataGlobal;
        $args = $rdsTemplateDataGlobal;
		$this->start_controls_section("rds_single_blog_widget", [
			"label" => __(
				"Recent Post Blog Page Widget",
				"rds-single-page-widget"
			),
		]);

		if (!empty($this->allVariation) && count($this->allVariation) > 1) {
			$defaultVariation = isset($args["page_templates"]["blog"]["variation"]) ? $args["page_templates"]["blog"]["variation"] : "a";
			$this->add_control("variation", [
				"label" => "Variation",
				"type" => \Elementor\Controls_Manager::SELECT,
				"default" => $defaultVariation,
				"options" => $this->allVariation,
			]);
		}

		$this->end_controls_section();
	}

	protected function render()
	{
		//GET SETTINGS VALUE
		$settings = $this->get_settings();
		$args = [];
		//CREATE ARRAY FOR SPEC FILE 
		// CHECK IF ANY VARIATION
		if (!empty($this->allVariation) && count($this->allVariation) > 1) {
			$args["page_templates"]["blog"]["variation"] = sanitize_text_field($settings["variation"]);
		}

        // SAVE TO SPEC
        if ($this->globalPath){
            $this->setFeatureJsonData($args);
		}

		//RENDER VARIATION
		$variationVal = isset($settings["variation"]) ? sanitize_text_field($settings["variation"]) : 'a';
		set_query_var('settings', $settings);
		get_template_part($this->widgetPathFull . $variationVal, null, $args);
?>
    <?php
	}

	
}
?>
