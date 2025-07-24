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
 * Thankyou style, showing only one item at a time.
 *
 * @since 1.0.0
 */
require_once get_template_directory() . "/inc/custom-widget-function.php";
class RDS_Thankyou extends Widget_Base
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
        $this->widgetPath = "thank-you"; //Edit
        $this->widgetPathFull = "/global-templates/" . $this->widgetPath . "/";
        $this->allVariation = $this->getFileVariations($this->widgetPath);
    }

    /**
     * Get widget name.
     *
     * Retrieve thankyou widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return "rds-global-thankyou-widget";
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

    private $thankyou_arrya = "";
    private $thankyou = "";

    /**
     * Get widget title.
     *
     * Retrieve thankyou widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__("Thankyou Widget ", "rds-global-thankyou-widget");
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
     * Retrieve thankyou widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return "eicon-tags";
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
        return ["thankyou", "tabs", "toggle"];
    }

    /**
     * Register Gravity form lists.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 3.1.0
     * @access public
     */

    /**
     * Register thankyou widget controls.
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
        $this->start_controls_section("rds_global_thankyou_widget", [
            "label" => esc_html__("Thankyou Widget", "rds-global-thankyou-widget"),
        ]);

        $this->add_control("show_promotions", [
            "label" => esc_html__("Enable Promotions", "rds-global-thankyou-widget"),
            "type" => \Elementor\Controls_Manager::SWITCHER,
            "label_on" => esc_html__("Show", "rds-global-thankyou-widget"),
            "label_off" => esc_html__("Hide", "rds-global-thankyou-widget"),
            "return_value" => "yes",
            "default" => "yes",
        ]);

        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $defaultVariation = isset($args["page_templates"]["thankyou_page"]["variation"]) ? $args["page_templates"]["thankyou_page"]["variation"] : "a";
            $this->add_control("variation", [
                "label" => esc_html__("Variation", "rds-global-thankyou-widget"),
                "type" => Controls_Manager::SELECT,
                "options" => $this->allVariation,
                "default" => $defaultVariation,
            ]);
        }

        $this->add_control("middle_content", [
            "label" => "Middle Content",
            "type" => \Elementor\Controls_Manager::WYSIWYG,
            "default" => 'We are processing your request. You will receive a confirmation email shortly.',
        ]);

        $this->add_control("scroll_button_text", [
            "label" => "Button Text",
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => 'SAVE ON YOUR NEXT SERVICE!',
        ]);
        $this->add_control("affiliation_heading", [
            "label" => "Affiliation Heading",
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => 'Trusted Us',
        ]);

        $this->add_control("heading", [
            "label" => "Heading",
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => 'Save On Your Next Service!',
        ]);

        $this->add_control("content", [
            "label" => "Content",
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => 'Lorem ipsum dolor sit amet',
        ]);

        $this->add_control("button_link", [
            "label" => "Button link",
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => '/contact',
        ]);
        $this->add_control("button_text", [
            "label" => "Button Text",
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => 'View all promotions',
        ]);
        $this->end_controls_section();
    }

    /**
     * Render thankyou widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings();
        global $rdsTemplateDataGlobal;
        $args = $rdsTemplateDataGlobal;
        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $args["page_templates"]["thankyou_page"]["variation"] = sanitize_text_field($settings["variation"]);
        }
        $args["page_templates"]["thankyou_page"]["show_promotions"] = $settings["show_promotions"] ? true : false;
        $args["page_templates"]["thankyou_page"]["middle_content"] = $settings["middle_content"];
        $args["page_templates"]["thankyou_page"]["scroll_button_text"] = sanitize_text_field($settings["scroll_button_text"]);
        $args["page_templates"]["thankyou_page"]["affiliation_heading"] = sanitize_text_field($settings["affiliation_heading"]);
        $args["page_templates"]["thankyou_page"]["promotions"]["heading"] = sanitize_text_field($settings["heading"]);
        $args["page_templates"]["thankyou_page"]["promotions"]["content"] = sanitize_text_field($settings["content"]);
        $args["page_templates"]["thankyou_page"]["promotions"]["button_text"] = sanitize_text_field($settings["button_text"]);
        $args["page_templates"]["thankyou_page"]["promotions"]["button_link"] = sanitize_text_field($settings["button_link"]);
        // SAVE TO SPEC
        if ($this->globalPath) {
            $this->setFeatureJsonData($args);
        }

        //RENDER VARIATION
        $variationVal = isset($settings["variation"]) ? sanitize_text_field($settings["variation"]) : 'a'; //FIXED
        set_query_var('settings', $settings);
        get_template_part($this->widgetPathFull . $variationVal, null, $args); //FIXED 
		?>
			<script>
                 jQuery(".promotionC_icon").click(function () {
                  var text = jQuery(this).html().trim();
                  currentText = jQuery(this).text();
                   if (currentText == "More info ") {
                            jQuery(this).html(text.replace('More info ', 'Less info '));
                            if (jQuery('body').hasClass('elementor-editor-active')) {
                             jQuery(this).find('i').toggleClass('icon-plus1 icon-minus1');
                         }
                        } else {
                            jQuery(this).html(text.replace('Less info ', 'More info '));
                             if (jQuery('body').hasClass('elementor-editor-active')) {
                                  jQuery(this).find('i').toggleClass('icon-minus1 icon-plus1');
                              }
                        }
                    });
            </script>
                <script type="text/javascript">
        jQuery(document).ready(function () {

            jQuery(".coupon-popup-close").click(function () {
                
                jQuery(this).closest("#request_coupon_form").find("form .gfield_label").each(function (k, d) {
                    jQuery(d).attr("style", "");
                    jQuery(d).parent('li').children('label').show();
                    jQuery(d).parent('li').find('.validation_message').hide();
                    jQuery(d).parent('li').removeClass('gfield_error');
                    jQuery(d).parent('li').removeClass('gfield_error');
                    jQuery(d).parent('li').find('input').val('');
                    jQuery(d).parent('li').find('select').val('');
                    jQuery(d).parent('li').children('label').removeClass('float_label');
                    jQuery(d).parent("li").find(".gfield-choice-input").prop("checked", true);
                });
            });
            jQuery(".rds_gform_submit").click(function () {
                console.log(jQuery(this).closest("form").find(".coupon-name input").val());
                var promotiontitleValue = jQuery(this).closest("form").find(".coupon-name input").val();
                if (promotiontitleValue != "") {
                    setTimeout(function () {
                        jQuery('.bc-promotion-title').text(promotiontitleValue);
                    }, 500);
                }
            });
            setInterval(function () {
                    var promotiontitleValue = jQuery('#input_9_10').val();
                    jQuery('.bc-promotion-title').text(promotiontitleValue);
            }, 500);
        });
        function couponButtonClick(attr) {
            var CouponTitle = jQuery(attr).parent('.coupon_name').find('.coupon_title').text();
            var CouponsubTitle = jQuery(attr).parent('.coupon_name').find('.coupon_subtitle').text();
            var Couponsubheading = jQuery(attr).parent('.coupon_name').find('.coupon_sub_heading ').text();
            console.log(CouponTitle + " " + CouponsubTitle + " " + Couponsubheading)
            jQuery(".coupon-name").find('input:text').val(CouponTitle + " " + CouponsubTitle + " " + Couponsubheading);
            jQuery(".bc-promotion-title").text(CouponTitle + " " + CouponsubTitle + " " + Couponsubheading);
        }

    </script>

<?php
    }
}
