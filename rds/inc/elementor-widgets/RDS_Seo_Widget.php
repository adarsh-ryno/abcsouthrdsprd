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
class RDS_Seo_Widget extends Widget_Base
{
	use FileVariations;
	use FeatureJSONUpdate;
	public $allVariation;
	public $widgetPath;
	public $widgetPathFull;
	public $variationVal;
	public function __construct($data = [], $args = null)
	{
		parent::__construct($data, $args);

		$this->widgetPath = "seo-section";  //Edit
		$this->widgetPathFull = "/global-templates/" .$this->widgetPath. "/"; 
		$this->allVariation = $this->getFileVariations($this->widgetPath);
	}


	/**
	 * Get widget name.
	 *
	 * Retrieve seo widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return "rds-template-seo-widget";
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

	private $seo_array = "";
	private $seo = "";

	/**
	 * Get widget title.
	 *
	 * Retrieve about widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__("RDS SEO Widget", "polaris-rds");
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
	 * Retrieve about  widget icon.
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
		return ["seo", "tabs", "toggle"];
	}

	/**
	 * Register seo template  widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 3.1.0
	 * @access protected
	 */
	protected function register_controls()
	{
		$this->start_controls_section("rds_seo_widget", [
			"label" => esc_html__("Seo Template Widget", "polaris-rds"),
		]);


		if (!empty($this->allVariation) && count($this->allVariation) > 1) {
			$template_id = get_current_elementor_template_id();
			// Initialize $defaultVariation
			$defaultVariation = isset($settings["seo_variation"]) ? sanitize_text_field($settings["seo_variation"]) : '';
			if ($template_id == 41084) {
				if (isset($args["page_templates"]["history_page"]["seo_section"])) {
					$args["page_templates"]["history_page"]["seo_section"]["variation"] = $defaultVariation;
				}
			} elseif ($template_id == 40930) {
				if (isset($args["page_templates"]["landing_page"]["seo_section"])) {
					$args["page_templates"]["landing_page"]["seo_section"]["variation"] = $defaultVariation;
				}
			} elseif ($template_id == 40758) {
				if (isset($args["page_templates"]["about_us_page"]["seo_section"])) {
					$args["page_templates"]["about_us_page"]["seo_section"]["variation"] = $defaultVariation;
				}
			} elseif ($template_id == 39478) {
				if (isset($args["page_templates"]["homepage"]["seo_section"])) {
					$args["page_templates"]["homepage"]["seo_section"]["variation"] = $defaultVariation;
				}
			}else{
				$args["page_templates"]["homepage"]["seo_section"]["variation"] = $defaultVariation;
			}
			$options = [];
			foreach ($this->allVariation as $key => $value) {
				$options[$key] = $value;
			}
			$this->add_control("seo_variation", [
				"label" => esc_html__("Variation", "polaris-rds"),
				"type" => Controls_Manager::SELECT,
				"default" => $defaultVariation,
				"options" => $this->allVariation,
			]);
		}
		$this->add_control("heading", [
			"label" => "Heading",
			"type" => \Elementor\Controls_Manager::TEXTAREA,
			"default" => esc_html__("Lorem Ipsum Gen", "polaris-rds"),
		]);
		$this->add_control("subheading", [
			"label" => "Sub Heading",
			"type" => \Elementor\Controls_Manager::TEXTAREA,
			"default" => esc_html__("Lorem Ipsum Gen", "polaris-rds"),
		]);

		$this->add_control("before_read_more_content", [
			"label" => "Description",
			"type" => \Elementor\Controls_Manager::WYSIWYG,
			"default" => esc_html__("<span></span>", "polaris-rds"),
		]);
		$this->add_control("after_read_more_content", [
			"label" => "More description with Read more...",
			"type" => \Elementor\Controls_Manager::WYSIWYG,
			"default" => esc_html__("<span></span>", "polaris-rds"),
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
		$args = [];
		$settings = $this->get_settings();

		/*if (!empty($settings['image']['id'])) {
            $this->custom_image_upload_actions($settings['image']['id']);
            $args['image'] = $this->custom_image_upload_actions($settings['image']['id']);;
    
        }*/
		$template_id = get_current_elementor_template_id();
		if ($template_id == 41084) {
		if (!empty($this->allVariation) && count($this->allVariation) > 1) {
			$args["page_templates"]["history_page"]["seo_section"]["variation"] = sanitize_text_field($settings["seo_variation"]);
		}
		// $args['page_templates']['history_page']['seo_section']['image_url'] = sanitize_text_field($settings['image']['url']);
		$args["page_templates"]["history_page"]["seo_section"]["heading"] = $settings["heading"];
		$args["page_templates"]["history_page"]["seo_section"]["subheading"] = $settings["subheading"];
		$args["page_templates"]["history_page"]["seo_section"]["before_read_more_content"] = $settings["before_read_more_content"];
		$args["page_templates"]["history_page"]["seo_section"]["after_read_more_content"] = $settings["after_read_more_content"];

		// SAVE TO SPEC
		$this->setFeatureJsonData($args);   //FIXED
		//RENDER VARIATION
		$variationVal = isset($settings["seo_variation"]) ? sanitize_text_field($settings["seo_variation"]) : 'a'; //FIXED
		get_template_part($this->widgetPathFull.$variationVal,null,$args); //FIXED
	}elseif ($template_id == 39478) {
		if (!empty($this->allVariation) && count($this->allVariation) > 1) {
			$args["page_templates"]["homepage"]["seo_section"]["variation"] = sanitize_text_field($settings["seo_variation"]);
		}
		// $args['page_templates']['homepage']['seo_section']['image_url'] = sanitize_text_field($settings['image']['url']);
		$args["page_templates"]["homepage"]["seo_section"]["heading"] = $settings["heading"];
		$args["page_templates"]["homepage"]["seo_section"]["subheading"] = $settings["subheading"];
		$args["page_templates"]["homepage"]["seo_section"]["before_read_more_content"] = $settings["before_read_more_content"];
		$args["page_templates"]["homepage"]["seo_section"]["after_read_more_content"] = $settings["after_read_more_content"];

        // SAVE TO SPEC
            $this->setFeatureJsonData($args);
		//RENDER VARIATION
		$variationVal = isset($settings["seo_variation"]) ? sanitize_text_field($settings["seo_variation"]) : 'a'; //FIXED		
			set_query_var('settings', $settings);

		get_template_part($this->widgetPathFull.$variationVal,null,$args); //FIXED
	}elseif ($template_id == 40758) {
		if (!empty($this->allVariation) && count($this->allVariation) > 1) {
			$args["page_templates"]["about_us_page"]["seo_section"]["variation"] = sanitize_text_field($settings["seo_variation"]);
		}
		// $args['page_templates']['about_us_page']['seo_section']['image_url'] = sanitize_text_field($settings['image']['url']);
		$args["page_templates"]["about_us_page"]["seo_section"]["heading"] = $settings["heading"];
		$args["page_templates"]["about_us_page"]["seo_section"]["subheading"] = $settings["subheading"];
		$args["page_templates"]["about_us_page"]["seo_section"]["before_read_more_content"] = $settings["before_read_more_content"];
		$args["page_templates"]["about_us_page"]["seo_section"]["after_read_more_content"] = $settings["after_read_more_content"];

		// SAVE TO SPEC
		$this->setFeatureJsonData($args);   //FIXED
		//RENDER VARIATION
		$variationVal = isset($settings["seo_variation"]) ? sanitize_text_field($settings["seo_variation"]) : 'a'; //FIXED 
						set_query_var('settings', $settings);

		get_template_part($this->widgetPathFull.$variationVal,null,$args); //FIXED
	} elseif($template_id == 40930) {
		if (!empty($this->allVariation) && count($this->allVariation) > 1) {
			$args["page_templates"]["landing_page"]["seo_section"]["variation"] = sanitize_text_field($settings["seo_variation"]);
		}
		// $args['page_templates']['landing_page']['seo_section']['image_url'] = sanitize_text_field($settings['image']['url']);
		$args["page_templates"]["landing_page"]["seo_section"]["heading"] = $settings["heading"];
		$args["page_templates"]["landing_page"]["seo_section"]["subheading"] = $settings["subheading"];
		$args["page_templates"]["landing_page"]["seo_section"]["before_read_more_content"] = $settings["before_read_more_content"];
		$args["page_templates"]["landing_page"]["seo_section"]["after_read_more_content"] = $settings["after_read_more_content"];

		// SAVE TO SPEC
		$this->setFeatureJsonData($args);   //FIXED
		//RENDER VARIATION
		$variationVal = isset($settings["seo_variation"]) ? sanitize_text_field($settings["seo_variation"]) : 'a'; //FIXED
						set_query_var('settings', $settings);

		get_template_part($this->widgetPathFull.$variationVal,null,$args); //FIXED
	} elseif($template_id == 60786) {
		if (!empty($this->allVariation) && count($this->allVariation) > 1) {
			$args["page_templates"]["landing_page"]["seo_section"]["variation"] = sanitize_text_field($settings["seo_variation"]);
		}
		// $args['page_templates']['landing_page']['seo_section']['image_url'] = sanitize_text_field($settings['image']['url']);
		$args["page_templates"]["landing_page"]["seo_section"]["heading"] = $settings["heading"];
		$args["page_templates"]["landing_page"]["seo_section"]["subheading"] = $settings["subheading"];
		$args["page_templates"]["landing_page"]["seo_section"]["before_read_more_content"] = $settings["before_read_more_content"];
		$args["page_templates"]["landing_page"]["seo_section"]["after_read_more_content"] = $settings["after_read_more_content"];

		// SAVE TO SPEC
		$this->setFeatureJsonData($args);   //FIXED
					set_query_var('settings', $settings);

		//RENDER VARIATION
		$variationVal = isset($settings["seo_variation"]) ? sanitize_text_field($settings["seo_variation"]) : 'a'; //FIXED
						set_query_var('settings', $settings);

		get_template_part($this->widgetPathFull.$variationVal,null,$args); //FIXED
	} else {
		if (!empty($this->allVariation) && count($this->allVariation) > 1) {
			$args["page_templates"]["homepage"]["seo_section"]["variation"] = sanitize_text_field($settings["seo_variation"]);
		}
		// $args['page_templates']['landing_page']['seo_section']['image_url'] = sanitize_text_field($settings['image']['url']);
		$args["page_templates"]["homepage"]["seo_section"]["heading"] = $settings["heading"];
		$args["page_templates"]["homepage"]["seo_section"]["subheading"] = $settings["subheading"];
		$args["page_templates"]["homepage"]["seo_section"]["before_read_more_content"] = $settings["before_read_more_content"];
		$args["page_templates"]["homepage"]["seo_section"]["after_read_more_content"] = $settings["after_read_more_content"];

		// SAVE TO SPEC
		//$this->setFeatureJsonData($args);   //FIXED
		//RENDER VARIATION
		$variationVal = isset($settings["seo_variation"]) ? sanitize_text_field($settings["seo_variation"]) : 'a'; //FIXED
		set_query_var('settings', $settings);
		get_template_part($this->widgetPathFull.$variationVal,null,$args); //FIXED
	}
		
		
		?>

            <script type="text/javascript">
                jQuery(document).ready(function(){
                  function toggleColor(t, e) {
    var n = jQuery(t).data("open-color-class"),
        i = jQuery(t).data("close-color-class");
    (void 0 === n && void 0 === i) || ("toggle" != e ? (jQuery(t).find("span").addClass(i), jQuery(t).find("span").removeClass(n)) : (jQuery(t).find("span").toggleClass(n), jQuery(t).find("span").toggleClass(i)));
}

   jQuery(".bc_toggle_content").on("click", function (t) {
        t.preventDefault();
        var e = jQuery(this).data("toggle"),
            n = jQuery(this).data("toggle-group");
        toggleContent(e, this),
            void 0 !== n &&
                jQuery(".bc_toggle_content").each(function () {
                    var t = jQuery(this).data("toggle");
                    jQuery(this).data("toggle-group") == n && e != t && toggleContent(t, this, "hide");
                });
                function toggleContent(t, e, n) {
    (n && void 0 !== n) || (n = "toggle"), jQuery(t).animate({ height: n }, "slow");
    var i,
        t = jQuery(e).data("open-icon"),
        o = jQuery(e).data("close-icon");
    (void 0 !== t && void 0 !== o) || ((t = "icon-plus2"), (o = "icon-minus2")),
        "toggle" != n
            ? (jQuery(e).find("i").addClass(t), jQuery(e).find("i").removeClass(o), toggleColor(e, n))
            : ((i = jQuery(e).find("i").hasClass(t)),
              jQuery(e).find("i").toggleClass(t),
              jQuery(e).find("i").toggleClass(o),
              toggleColor(e, n),
              void 0 === (t = jQuery(e).children("span").html().trim()) ||
                  (i && -1 != t.search("read more") && jQuery(e).children("span").html(t.replace("read more", "read less")), i) ||
                  -1 == t.search("read less") ||
                  jQuery(e).children("span").html(t.replace("read less", "read more")));
}
    });

    jQuery(".bc_toggle_btn").on('click', function(e) {
            e.preventDefault();
            var currentPageUrl = window.location.href;
            var headerHeight = jQuery('header').height();
            var offsetValue = headerHeight + 50;
            if (jQuery(this).hasClass("bc_toggle_btn_closed")) {
                jQuery("html, body").animate({
                    scrollTop: jQuery('.bc_homepage').offset().top - offsetValue
                }, 500);
                jQuery(this).removeClass("bc_toggle_btn_closed");
            } else {
                jQuery('html, body').animate({
                    scrollTop: jQuery('.bc_homepage').offset().top - offsetValue
                }, 500);
                jQuery(this).addClass("bc_toggle_btn_closed");
            }
        });

                });
            </script>
        <?php
	}
}
