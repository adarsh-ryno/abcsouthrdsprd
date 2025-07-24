<?php
namespace Elementor\Core\Kits\Documents\Tabs;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined("ABSPATH")) {
	exit(); // Exit if accessed directly
}

class Custom_Style_Typography extends Tab_Base
{
	public function get_id()
	{
		return "custom-style-typography";
	}

	public function get_title()
	{
		return esc_html__("Custom Typography", "elementor");
	}

	public function get_group()
	{
		return "theme-style";
	}

	public function get_icon()
	{
		return "eicon-typography-1";
	}

	public function get_help_url()
	{
		return "https://go.elementor.com/global-theme-style-typography/";
	}

	public function register_tab_controls()
	{
		$this->start_controls_section("section_custom_typography", [
			"label" => esc_html__("Custom Typography", "elementor"),
			"tab" => $this->get_id(),
		]);

		$this->add_default_globals_notice();

		// Headings.

		$this->display_add_element_controls(
			esc_html__("Hero Display_1", "elementor"),
			"display_1",
			"{{WRAPPER}} .display1"
		);
		$this->display_add_element_controls(
			esc_html__("Hero Display_2", "elementor"),
			"display_2",
			"{{WRAPPER}} .display2"
		);
		$this->add_element_controls_alt(
			esc_html__("Paragraph (P)", "elementor"),
			"p",
			"{{WRAPPER}} p",
			"{{WRAPPER}} .p"
		);
		$this->add_element_controls_alt(
			esc_html__("LI", "elementor"),
			"li",
			"{{WRAPPER}} li",
			"{{WRAPPER}} .li"
		);
		$this->add_element_controls_alt(
			esc_html__("Strong", "elementor"),
			"strong",
			"{{WRAPPER}} strong",
			"{{WRAPPER}} .strong"
		);
		$this->add_element_controls_alt(
			esc_html__("EM", "elementor"),
			"em",
			"{{WRAPPER}} em",
			"{{WRAPPER}} .em"
		);
		$this->add_element_controls_alt(
			esc_html__("H7 service", "elementor"),
			"h7",
			"{{WRAPPER}} .h7",
			"{{WRAPPER}} .h7"
		);
		$this->add_element_controls_alt(
			esc_html__("H8 footer", "elementor"),
			"h8",
			"{{WRAPPER}} .h8",
			"{{WRAPPER}} .h8"
		);
		$this->add_element_controls_hover(
			esc_html__("Footer Phone Number", "elementor"),
			"footer_phone_number",
			"{{WRAPPER}} .footer_phone_number"
		);
		$this->add_element_controls_text_footerhover(
			esc_html__("Footer Links", "elementor"),
			"footer_links",
			"{{WRAPPER}} .footer_links",
			"{{WRAPPER}} .footer_add"
		);
		$this->add_element_controls_text_hover(
			esc_html__("Phone Number", "elementor"),
			"phone_number",
			"{{WRAPPER}} .phone_number"
		);
		$this->add_element_controls(
			esc_html__("Default", "elementor"),
			"default",
			"{{WRAPPER}} default"
		);
		$this->add_element_controls_hero(
			esc_html__("Hero", "elementor"),
			"hero",
			"{{WRAPPER}} .hero"
		);
		$this->add_element_controls_bar(
			esc_html__("Announcement Bar", "elementor"),
			"announcement_bar",
			"{{WRAPPER}} .announcment_bar_text"
		);
		$this->add_element_controls(
			esc_html__("Call Today", "elementor"),
			"call_today",
			"{{WRAPPER}} .call_today"
		);
		$this->add_element_controls_color(
			esc_html__("Footer Phone Icons", "elementor"),
			"footer_phone_icon",
			"{{WRAPPER}} .footer_phone_icon_color"
		);
		$this->add_element_controls_color(
			esc_html__("Footer License Icons", "elementor"),
			"footer_license_icon",
			"{{WRAPPER}} .footer_license_icon_color"
		);
		$this->add_element_controls_copy(
			esc_html__("Copyright", "elementor"),
			"copyright",
			"{{WRAPPER}} .copyright_hover"
		);
		$this->add_element_controls_blog(
			esc_html__("Blog", "elementor"),
			"blog",
			"{{WRAPPER}} .blog_read_more_text_color"
		);

		$this->add_element_controls_color(
			esc_html__("Anchor Alt color", "elementor"),
			"aalt",
			"{{WRAPPER}} .a-alt"
		);
		$this->add_element_controls_color(
			esc_html__("H1 Alt color", "elementor"),
			"h1alt",
			"{{WRAPPER}} .h1-alt"
		);
		$this->add_element_controls_color(
			esc_html__("H2 Alt color", "elementor"),
			"h2alt",
			"{{WRAPPER}} .h2-alt"
		);
		$this->add_element_controls_color(
			esc_html__("H3 Alt color", "elementor"),
			"h3alt",
			"{{WRAPPER}} .h3-alt"
		);
		$this->add_element_controls_color(
			esc_html__("H4 Alt color", "elementor"),
			"h4alt",
			"{{WRAPPER}}. h4-alt"
		);
		$this->add_element_controls_color(
			esc_html__("H5 Alt color", "elementor"),
			"h5alt",
			"{{WRAPPER}} .h5-alt"
		);
		$this->add_element_controls_color(
			esc_html__("H6 Alt color", "elementor"),
			"h6alt",
			"{{WRAPPER}} .h6-alt"
		);

		//color and hover settings
		$this->add_element_controls_colors(
			esc_html__("Social Media Icons", "elementor"),
			"social_media_icons",
			"{{WRAPPER}} .social_media_icons"
		);
		//mobile_popup_form
		//$this->add_element_mobile_popup_form( esc_html__( 'Mobile Popup Form', 'elementor' ), 'mobile_popup_form', '{{WRAPPER}} .mobile_popup_form' );
		//mobile_popup_form
		$this->add_element_thankyou(
			esc_html__("Thank You", "elementor"),
			"thankyou",
			"{{WRAPPER}} .thankyou"
		);
		//page Not found
		$this->add_element_pagenotfound(
			esc_html__("Page not found", "elementor"),
			"pagenotfound",
			"{{WRAPPER}} .pagenotfound"
		);
		$this->add_element_mobile(
			esc_html__("Mobile  CTA Popup", "elementor"),
			"mobile_cta_popup",
			"{{WRAPPER}} .mobile_popup_form_background_color"
		);
		$this->add_element_gmobile(
			esc_html__("Hero banner & Request Service", "elementor"),
			"hero_banner_and_request_service",
			"{{WRAPPER}} .gform_wrapper"
		);
		$this->add_element_button_primary(
			esc_html__("Button Primary", "elementor"),
			"button_primary",
			"{{WRAPPER}} .btn-primary",
			"{{WRAPPER}} .btn"
		);
		$this->add_element_button(
			esc_html__("Button Secondary", "elementor"),
			"button_secondary",
			"{{WRAPPER}} .btn-secondary"
		);

		$this->add_element_service_block_hover(
			esc_html__("Service Block Hover", "elementor"),
			"service_block_hover",
			"{{WRAPPER}} .service_block"
		);
		$this->add_element_navigation(
			esc_html__("Navigation", "elementor"),
			"navigation",
			"{{WRAPPER}} .nav_container_desktop #navbarSupportedContentDesktop ul.navbar-nav > li > a, .nav_container_desktop #navbarSupportedContentDesktop ul.navbar-nav>li>ul>li>a, .nav_container_desktop #navbarSupportedContentDesktop ul.navbar-nav>li>ul>li>ul>li>a"
		);
		$this->add_element_coupon(
			esc_html__("Coupon", "elementor"),
			"coupon",
			"{{WRAPPER}} .coupon"
		);
		$this->add_element_callbtn_bg(
			esc_html__("Call Button Header", "elementor"),
			"callbtn_bg",
			"{{WRAPPER}} .color_callbtn"
		);
		//$this->add_element_fonts(esc_html__( 'Fonts', 'elementor' ), 'fonts', '{{WRAPPER}} .fonts');
		$this->end_controls_section();
	}

	private function add_element_callbtn_bg($label, $prefix, $selector)
	{
		$this->add_control($prefix . "_heading", [
			"type" => Controls_Manager::HEADING,
			"label" => $label,
			"separator" => "before",
		]);

		$this->add_control($prefix . "_background_color", [
			"label" => esc_html__("Background Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector => "background-color: {{VALUE}};",
			],
		]);
	}
	private function add_element_fonts($label, $prefix, $selector)
	{
		$this->add_control($prefix . "_heading", [
			"type" => Controls_Manager::HEADING,
			"label" => $label,
			"separator" => "before",
		]);
		$this->add_group_control(Group_Control_Typography::get_type(), [
			"name" => "default_font_family",
			"label" => "Default Font Family",
			"selector" => $selector,
			"exclude" => [
				"font_style",
				"font_size",
				"font_weight",
				"text_transform",
				"text_decoration",
				"line_height",
				"letter_spacing",
				"word_spacing",
			],
		]);
		$this->add_group_control(Group_Control_Typography::get_type(), [
			"name" => "alternate_font_family_1",
			"label" => "Alternate Font Family_1",
			"selector" => $selector,
			"exclude" => [
				"font_style",
				"font_size",
				"font_weight",
				"text_transform",
				"text_decoration",
				"line_height",
				"letter_spacing",
				"word_spacing",
			],
		]);
		$this->add_group_control(Group_Control_Typography::get_type(), [
			"name" => "alternate_font_family_2",
			"label" => "Alternate Font Family_2",
			"selector" => $selector,
			"exclude" => [
				"font_style",
				"font_size",
				"font_weight",
				"text_transform",
				"text_decoration",
				"line_height",
				"letter_spacing",
				"word_spacing",
			],
		]);
		$this->add_group_control(Group_Control_Typography::get_type(), [
			"name" => "alternate_font_family_3",
			"label" => "Alternate Font Family_3",
			"selector" => $selector,
			"exclude" => [
				"font_style",
				"font_size",
				"font_weight",
				"text_transform",
				"text_decoration",
				"line_height",
				"letter_spacing",
				"word_spacing",
			],
		]);
	}
	private function add_element_controls($label, $prefix, $selector)
	{
		$this->add_control($prefix . "_heading", [
			"type" => Controls_Manager::HEADING,
			"label" => $label,
			"separator" => "before",
		]);

		$this->add_control($prefix . "_color", [
			"label" => esc_html__("Text Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector => "color: {{VALUE}};",
			],
		]);

		$this->add_group_control(Group_Control_Typography::get_type(), [
			"name" => $prefix . "_typography",
			"selector" => $selector,
		]);
	}
	private function add_element_controls_hero($label, $prefix, $selector)
	{
		$this->add_control($prefix . "_heading", [
			"type" => Controls_Manager::HEADING,
			"label" => $label,
			"separator" => "before",
		]);
		$this->add_control($prefix . "_bg_color", [
			"label" => esc_html__("Form Background color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				"{{WRAPPER}} .hero_banner_form_background" =>
					"background-color: {{VALUE}};",
			],
		]);
	}
	private function display_add_element_controls($label, $prefix, $selector)
	{
		$this->add_control($prefix . "_heading", [
			"type" => Controls_Manager::HEADING,
			"label" => $label,
			"separator" => "before",
		]);

		$this->add_control($prefix . "_color", [
			"label" => esc_html__("Text Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector => "color: {{VALUE}};",
			],
		]);

		$this->add_group_control(Group_Control_Typography::get_type(), [
			"name" => $prefix . "_typography",
			"selector" => $selector,
		]);
	}

	private function add_element_controls_alt(
		$label,
		$prefix,
		$selector,
		$selector2
	) {
		$this->add_control($prefix . "_heading", [
			"type" => Controls_Manager::HEADING,
			"label" => $label,
			"separator" => "before",
		]);

		$this->add_control($prefix . "_color", [
			"label" => esc_html__("Text Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector => "color: {{VALUE}};",
			],
		]);
		$this->add_control($prefix . "_alt_color", [
			"label" => esc_html__("Alt Text Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector2 . "-alt" => "color: {{VALUE}};",
			],
		]);

		$this->add_group_control(Group_Control_Typography::get_type(), [
			"name" => $prefix . "_typography",
			"selector" => $selector,
		]);
	}
	private function add_element_controls_bar($label, $prefix, $selector)
	{
		$this->add_control($prefix . "_heading", [
			"type" => Controls_Manager::HEADING,
			"label" => $label,
			"separator" => "before",
		]);

		$this->add_control($prefix . "_color", [
			"label" => esc_html__("Text Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector => "color: {{VALUE}};",
			],
		]);
		$this->add_control($prefix . "_hover_color", [
			"label" => esc_html__("Hover Text Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector . ":hover" => "color: {{VALUE}};",
			],
		]);

		$this->add_group_control(Group_Control_Typography::get_type(), [
			"name" => $prefix . "_typography",
			"selector" => $selector . " , " . $selector . ":hover",
		]);
	}
	private function add_element_controls_hover($label, $prefix, $selector)
	{
		$this->add_control($prefix . "_heading", [
			"type" => Controls_Manager::HEADING,
			"label" => $label,
			"separator" => "before",
		]);

		$this->add_control($prefix . "_color", [
			"label" => esc_html__("Text Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector => "color: {{VALUE}};",
			],
		]);
		$this->add_control($prefix . "_hover_color", [
			"label" => esc_html__("Hover Text Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector . ":hover" => "color: {{VALUE}};",
			],
		]);

		$this->add_group_control(Group_Control_Typography::get_type(), [
			"name" => $prefix . "_typography",
			"selector" => $selector . " , " . $selector . ":hover",
		]);
	}
	private function add_element_controls_text_hover($label, $prefix, $selector)
	{
		$this->add_control($prefix . "_heading", [
			"type" => Controls_Manager::HEADING,
			"label" => $label,
			"separator" => "before",
		]);

		$this->add_control($prefix . "_color", [
			"label" => esc_html__("Text Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector => "color: {{VALUE}};",
			],
		]);
		$this->add_control($prefix . "_hover_color", [
			"label" => esc_html__("Hover Text Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector . ":hover" => "color: {{VALUE}};",
			],
		]);

		$this->add_group_control(Group_Control_Typography::get_type(), [
			"name" => $prefix . "_typography",
			"selector" => $selector . " , " . $selector . ":hover",
		]);
	}
	private function add_element_controls_text_footerhover(
		$label,
		$prefix,
		$selector,
		$selector2
	) {
		$this->add_control($prefix . "_heading", [
			"type" => Controls_Manager::HEADING,
			"label" => $label,
			"separator" => "before",
		]);

		$this->add_control($prefix . "_color", [
			"label" => esc_html__("Text Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector => "color: {{VALUE}};",
				$selector2 => "color: {{VALUE}};",
			],
		]);
		$this->add_control($prefix . "_hover_color", [
			"label" => esc_html__("Hover Text Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector . ":hover" => "color: {{VALUE}};",
			],
		]);

		$this->add_group_control(Group_Control_Typography::get_type(), [
			"name" => $prefix . "_typography",
			"selector" => $selector . " , " . $selector . ":hover",
		]);
	}
	private function add_element_controls_color($label, $prefix, $selector)
	{
		$this->add_control($prefix . "_heading", [
			"type" => Controls_Manager::HEADING,
			"label" => $label,
			"separator" => "before",
		]);
		$this->add_control($prefix . "_color", [
			"label" => esc_html__("Text Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector => "color: {{VALUE}};",
			],
		]);
	}
	private function add_element_controls_copy($label, $prefix, $selector)
	{
		$this->add_control($prefix . "_heading", [
			"type" => Controls_Manager::HEADING,
			"label" => $label,
			"separator" => "before",
		]);
		$this->add_control($prefix . "_color", [
			"label" => esc_html__("Hover Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector . ":hover" => "color: {{VALUE}};",
			],
		]);
	}
	private function add_element_controls_colors($label, $prefix, $selector)
	{
		$this->add_control($prefix . "_heading", [
			"type" => Controls_Manager::HEADING,
			"label" => $label,
			"separator" => "before",
		]);
		$this->add_control($prefix . "_color", [
			"label" => esc_html__("Text Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector => "color: {{VALUE}};",
			],
		]);
		$this->add_control($prefix . "_hover_color", [
			"label" => esc_html__("Hover Text Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector . ":hover " => "color: {{VALUE}};",
			],
		]);
	}

	private function add_element_controls_blog($label, $prefix, $selector)
	{
		$this->add_control($prefix . "_heading", [
			"type" => Controls_Manager::HEADING,
			"label" => $label,
			"separator" => "before",
		]);
		$this->add_control($prefix . "_color", [
			"label" => esc_html__("Text Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector => "color: {{VALUE}};",
			],
		]);
		$this->add_control($prefix . "_hover_color", [
			"label" => esc_html__("Hover Text Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector . ":hover " => "color: {{VALUE}};",
			],
		]);
	}

	private function add_element_mobile_popup_form($label, $prefix, $selector)
	{
		$this->add_control($prefix . "_heading", [
			"type" => Controls_Manager::HEADING,
			"label" => $label,
			"separator" => "before",
		]);
		$this->add_control($prefix . "_input_text_color", [
			"label" => esc_html__("Input Text Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector => "color: {{VALUE}};",
			],
		]);
		$this->add_control($prefix . "_background_color", [
			"label" => esc_html__("Background Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector => "background-color: {{VALUE}};",
			],
		]);
		$this->add_control($prefix . "_border_color", [
			"label" => esc_html__("Border Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector => "border-color: {{VALUE}};",
			],
		]);
		$this->add_group_control(Group_Control_Typography::get_type(), [
			"name" => $prefix . "_typography",
			"selector" => $selector . " , " . $selector . ":hover",
		]);
	}
	private function add_element_thankyou($label, $prefix, $selector)
	{
		$this->add_control($prefix . "_heading", [
			"type" => Controls_Manager::HEADING,
			"label" => $label,
			"separator" => "before",
		]);
		$this->add_control($prefix . "_page_heading_color", [
			"label" => esc_html__("Page Heading Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector . "_page_heading_color" => "color: {{VALUE}};",
			],
		]);
		$this->add_control($prefix . "_page_content_color", [
			"label" => esc_html__("Page Content Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector . "_page_content_color" => "color: {{VALUE}};",
			],
		]);
	}
	private function add_element_pagenotfound($label, $prefix, $selector)
	{
		$this->add_control($prefix . "_heading", [
			"type" => Controls_Manager::HEADING,
			"label" => $label,
			"separator" => "before",
		]);
		$this->add_control($prefix . "_display_1", [
			"label" => esc_html__("Display_1", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector . "_display_1" => "color: {{VALUE}};",
			],
		]);
		$this->add_control($prefix . "_display_2", [
			"label" => esc_html__("Display_2", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector . "_display_2" => "color: {{VALUE}};",
			],
		]);
	}

	private function add_element_mobile($label, $prefix, $selector)
	{
		$this->add_control($prefix . "_heading", [
			"type" => Controls_Manager::HEADING,
			"label" => $label,
			"separator" => "before",
		]);
		$this->add_control($prefix . "_form_background", [
			"label" => esc_html__("Popup Background", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector => "background: {{VALUE}} !important;",
			],
		]);
		$this->add_control($prefix . "_text_color", [
			"label" => esc_html__("Button Text Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector . " .btn-quaternary" => "color: {{VALUE}}!important;",
			],
		]);
		$this->add_control($prefix . "_background_color", [
			"label" => esc_html__("Button Background Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector .
				" .btn-quaternary" => "background-color: {{VALUE}}!important;",
			],
		]);
		$this->add_control($prefix . "_border_color", [
			"label" => esc_html__("Button Border Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector .
				" .btn-quaternary" => "border-color: {{VALUE}}!important;",
			],
		]);
		$this->add_group_control(Group_Control_Typography::get_type(), [
			"name" => $prefix . "_typography",
			"selector" =>
				$selector .
				" .btn-quaternary, " .
				$selector .
				" .btn-quaternary:hover",
			//'selector' => '{{WRAPPER}} .btn-quaternary',
		]);
	}
	private function add_element_gmobile($label, $prefix, $selector)
	{
		$this->add_control($prefix . "_heading", [
			"type" => Controls_Manager::HEADING,
			"label" => $label,
			"separator" => "before",
		]);
		$this->add_control($prefix . "_text_color", [
			"label" => esc_html__("Text Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector .
				" ul.gform_fields li.gfield .gfield_label, ::placeholder" => "color: {{VALUE}}!important;",
				$selector .
				" ul.gfield_checkbox .gchoice .gfield-choice-input" => "color: {{VALUE}}!important;",
				$selector .
				" ul li.gfield .large" => "color: {{VALUE}}!important;",
				$selector .
				" ul li.gfield .medium" => "color: {{VALUE}}!important;",
				$selector .
				" ul .gfield_checkbox li label" => "color: {{VALUE}}!important;",
			],
		]);
		$this->add_control($prefix . "_border_color", [
			"label" => esc_html__("Border Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector .
				" ul li .ginput_container_text input" => "border-color: {{VALUE}}!important;",
				$selector .
				" ul.gfield_checkbox .gchoice .gfield-choice-input" => "border-color: {{VALUE}}!important;",
				$selector .
				" ul li.gfield .large" => "border-color: {{VALUE}}!important;",
				$selector .
				" ul li.gfield .medium" => "border-color: {{VALUE}}!important;",
				$selector .
				" ul li.gfield .ginput_container_select:after" => "border-color: {{VALUE}}!important;",
			],
		]);
	}

	private function add_element_button_primary(
		$label,
		$prefix,
		$selector,
		$selector2
	) {
		$this->add_control($prefix . "_heading", [
			"type" => Controls_Manager::HEADING,
			"label" => $label,
			"separator" => "before",
		]);

		$this->add_control($prefix . "_color", [
			"label" => esc_html__("Text Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector => "color: {{VALUE}};",
				$selector2 => "color: {{VALUE}};",
			],
		]);
		$this->add_control($prefix . "_bgcolor", [
			"label" => esc_html__("Background Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector =>
					"background-color: {{VALUE}};border-color: {{VALUE}};",
				$selector2 =>
					"background-color: {{VALUE}};border-color: {{VALUE}};",
			],
		]);
		$this->add_control($prefix . "_border_radius", [
			"label" => __("Border Radius", "elementor"),
			"type" => Controls_Manager::DIMENSIONS,
			"description" => __(
				"Set the border radius for all corners.",
				"elementor"
			),
			"size_units" => ["px", "%"], // Choose appropriate units
			"selectors" => [
				$selector =>
					"border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};", // Apply border radius to your element
				$selector2 =>
					"border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
			],
		]);
		$this->add_group_control(Group_Control_Typography::get_type(), [
			"name" => $prefix . "_typography",
			"selector" =>
				$selector .
				", " .
				$selector .
				":hover, " .
				$selector2 .
				", " .
				$selector2 .
				":hover",
		]);
		$this->add_control($prefix . "_hover_color", [
			"label" => esc_html__("Hover Text Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector . ":hover" => "color: {{VALUE}};",
				$selector2 . ":hover" => "color: {{VALUE}};",
			],
		]);
		$this->add_control($prefix . "_hover_bg_color", [
			"label" => esc_html__("Hover Background Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector .
				":hover" => "background-color: {{VALUE}};border-color: {{VALUE}};",
				$selector2 .
				":hover" => "background-color: {{VALUE}};border-color: {{VALUE}};",
				$selector .
				":before" => "background-color: {{VALUE}};border-color: {{VALUE}};",
				$selector2 .
				":before" => "background-color: {{VALUE}};border-color: {{VALUE}};",
			],
		]);
		$this->add_control($prefix . "_border_radius_hover", [
			"label" => __("Hover Border Radius", "elementor"),
			"type" => Controls_Manager::DIMENSIONS,
			"description" => __(
				"Set the border radius for all corners.",
				"elementor"
			),
			"size_units" => ["px", "%"], // Choose appropriate units
			"selectors" => [
				$selector .
				":hover" => "border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};", // Apply border radius to your element
				$selector2 .
				":hover" => "border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
			],
		]);
		$this->add_group_control(Group_Control_Typography::get_type(), [
			"name" => $prefix . "_alt_typography",
			"label" => esc_html__("Alt Typography", "elementor"),
			"selector" => $selector . "-alt , " . $selector . "alt:hover",
		]);

		$this->add_control($prefix . "_alt_color", [
			"label" => esc_html__("Alt Text Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector . "-alt" => "color: {{VALUE}};",
			],
		]);
		$this->add_control($prefix . "_alt_bgcolor", [
			"label" => esc_html__("Alt Background Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector .
				"-alt" => "background-color: {{VALUE}};border-color: {{VALUE}};",
			],
		]);
		$this->add_control($prefix . "_border_radius_alt", [
			"label" => __("Alt Border Radius", "elementor"),
			"type" => Controls_Manager::DIMENSIONS,
			"description" => __(
				"Set the border radius for all corners.",
				"elementor"
			),
			"size_units" => ["px", "%"], // Choose appropriate units
			"selectors" => [
				$selector .
				"-alt" => "border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};", // Apply border radius to your element
			],
		]);
		$this->add_control($prefix . "_althover_color", [
			"label" => esc_html__("Alt Hover Text Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector . "-alt:hover" => "color: {{VALUE}};",
			],
		]);
		$this->add_control($prefix . "_althover_bg_color", [
			"label" => esc_html__("Alt Hover Background Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector .
				"-alt:hover" => "background-color: {{VALUE}};border-color: {{VALUE}};",
				$selector .
				"-alt:before" => "background-color: {{VALUE}};border-color: {{VALUE}};",
			],
		]);
		$this->add_control($prefix . "_border_radius_alt_hover", [
			"label" => __("Alt Hover Border Radius", "elementor"),
			"type" => Controls_Manager::DIMENSIONS,
			"description" => __(
				"Set the border radius for all corners.",
				"elementor"
			),
			"size_units" => ["px", "%"], // Choose appropriate units
			"selectors" => [
				$selector .
				"-alt:hover" => "border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};", // Apply border radius to your element
			],
		]);
	}

	private function add_element_button($label, $prefix, $selector)
	{
		$this->add_control($prefix . "_heading", [
			"type" => Controls_Manager::HEADING,
			"label" => $label,
			"separator" => "before",
		]);

		$this->add_control($prefix . "_color", [
			"label" => esc_html__("Text Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector => "color: {{VALUE}};",
			],
		]);
		$this->add_control($prefix . "_bgcolor", [
			"label" => esc_html__("Background Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector =>
					"background-color: {{VALUE}};border-color: {{VALUE}};",
			],
		]);
		$this->add_control($prefix . "_border_radius", [
			"label" => __("Border Radius", "elementor"),
			"type" => Controls_Manager::DIMENSIONS,
			"description" => __(
				"Set the border radius for all corners.",
				"elementor"
			),
			"size_units" => ["px", "%"], // Choose appropriate units
			"selectors" => [
				$selector =>
					"border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};", // Apply border radius to your element
			],
		]);
		$this->add_group_control(Group_Control_Typography::get_type(), [
			"name" => $prefix . "_typography",
			"selector" => $selector . " , " . $selector . ":hover",
		]);
		$this->add_control($prefix . "_hover_color", [
			"label" => esc_html__("Hover Text Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector . ":hover" => "color: {{VALUE}};",
			],
		]);
		$this->add_control($prefix . "_hover_bg_color", [
			"label" => esc_html__("Hover Background Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector .
				":hover" => "background-color: {{VALUE}};border-color: {{VALUE}};",
				$selector .
				":before" => "background-color: {{VALUE}};border-color: {{VALUE}};",
			],
		]);
		$this->add_control($prefix . "_border_radius_hover", [
			"label" => __("Hover Border Radius", "elementor"),
			"type" => Controls_Manager::DIMENSIONS,
			"description" => __(
				"Set the border radius for all corners.",
				"elementor"
			),
			"size_units" => ["px", "%"], // Choose appropriate units
			"selectors" => [
				$selector .
				":hover" => "border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};", // Apply border radius to your element
			],
		]);
		$this->add_group_control(Group_Control_Typography::get_type(), [
			"name" => $prefix . "_alt_typography",
			"label" => esc_html__("Alt Typography", "elementor"),
			"selector" => $selector . "-alt , " . $selector . "-alt:hover",
		]);

		$this->add_control($prefix . "_alt_color", [
			"label" => esc_html__("Alt Text Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector . "-alt" => "color: {{VALUE}};",
			],
		]);
		$this->add_control($prefix . "_alt_bgcolor", [
			"label" => esc_html__("Alt Background Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector .
				"-alt" => "background-color: {{VALUE}};border-color: {{VALUE}};",
			],
		]);
		$this->add_control($prefix . "_border_radius_alt", [
			"label" => __("Alt Border Radius", "elementor"),
			"type" => Controls_Manager::DIMENSIONS,
			"description" => __(
				"Set the border radius for all corners.",
				"elementor"
			),
			"size_units" => ["px", "%"], // Choose appropriate units
			"selectors" => [
				$selector .
				"-alt" => "border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};", // Apply border radius to your element
			],
		]);
		$this->add_control($prefix . "_althover_color", [
			"label" => esc_html__("Alt Hover Text Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector . "-alt:hover" => "color: {{VALUE}};",
			],
		]);
		$this->add_control($prefix . "_althover_bg_color", [
			"label" => esc_html__("Alt Hover Background Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector .
				"-alt:hover" => "background-color: {{VALUE}};border-color: {{VALUE}};",
				$selector .
				"-alt:before" => "background-color: {{VALUE}};border-color: {{VALUE}};",
			],
		]);
		$this->add_control($prefix . "_border_radius_alt_hover", [
			"label" => __("Alt Hover Border Radius", "elementor"),
			"type" => Controls_Manager::DIMENSIONS,
			"description" => __(
				"Set the border radius for all corners.",
				"elementor"
			),
			"size_units" => ["px", "%"], // Choose appropriate units
			"selectors" => [
				$selector .
				"-alt:hover" => "border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};", // Apply border radius to your element
			],
		]);
	}

	private function add_element_service_block_hover($label, $prefix, $selector)
	{
		$this->add_control($prefix . "_heading", [
			"type" => Controls_Manager::HEADING,
			"label" => $label,
			"separator" => "before",
		]);
		$this->add_control($prefix . "_text_color", [
			"label" => esc_html__("Text Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector . ":hover .h7" => "color: {{VALUE}};",
			],
		]);
		$this->add_control($prefix . "_icon_color", [
			"label" => esc_html__("Icon Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector . ":hover .service_block_icon" => "color: {{VALUE}};",
			],
		]);
	}

	//Navigation
	private function add_element_navigation($label, $prefix, $selector)
	{
		$this->add_control($prefix . "_heading", [
			"type" => Controls_Manager::HEADING,
			"label" => $label,
			"separator" => "before",
		]);

		$this->add_group_control(Group_Control_Typography::get_type(), [
			"name" => $prefix . "_typography",
			"selector" => $selector,
		]);

		$this->add_control($prefix . "_top_nav_background", [
			"label" => esc_html__("Top Nav Background", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				"{{WRAPPER}} .nav_container_desktop.nav_container_desktop_b #navbarSupportedContentDesktop ul.navbar-nav>li.dropdown, .nav_container_desktop #navbarSupportedContentDesktop ul.navbar-nav>li.dropdown, .nav_container_desktop.nav_container_desktop_c" =>
					"background-color: {{VALUE}};",
			],
		]);
		$this->add_control($prefix . "_top_nav_color", [
			"label" => esc_html__("Top Nav Text Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				"{{WRAPPER}} .nav_container_desktop.nav_container_desktop_c #navbarSupportedContentDesktop ul.navbar-nav li>a, .nav_container_desktop #navbarSupportedContentDesktop ul.navbar-nav>li>a" =>
					"color: {{VALUE}};",
			],
		]);
		$this->add_control($prefix . "_top_nav_hover_background", [
			"label" => esc_html__("Top Nav Hover Background", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				"{{WRAPPER}} .nav_container_desktop #navbarSupportedContentDesktop ul.navbar-nav>li:hover" =>
					"background-color: {{VALUE}} !important;",
			],
		]);
		$this->add_control($prefix . "_top_nav_hover_color", [
			"label" => esc_html__("Top Nav Hover Text Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				"{{WRAPPER}} .nav_container_desktop #navbarSupportedContentDesktop ul.navbar-nav>li:hover>a" =>
					"color: {{VALUE}};",
			],
		]);

		$this->add_control($prefix . "_sub_nav_background", [
			"label" => esc_html__("Sub Nav Background", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				"{{WRAPPER}} .nav_container_desktop #navbarSupportedContentDesktop ul.navbar-nav>li>ul>li>a, .nav_container_desktop #navbarSupportedContentDesktop ul.navbar-nav>li>ul , .nav_container_desktop #navbarSupportedContentDesktop ul.navbar-nav > li > ul > li > ul > li > a" =>
					"background-color: {{VALUE}};",
			],
		]);
		$this->add_control($prefix . "_sub_nav_color", [
			"label" => esc_html__("Sub Nav Text Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				"{{WRAPPER}}  .nav_container_desktop #navbarSupportedContentDesktop ul.navbar-nav>li>ul>li:hover>a, .nav_container_desktop #navbarSupportedContentDesktop ul.navbar-nav>li>ul>li>a, .nav_container_desktop.nav_container_desktop_c #navbarSupportedContentDesktop ul.navbar-nav li>ul.dropdown-menu>li>a, .nav_container_desktop #navbarSupportedContentDesktop ul.navbar-nav > li > ul > li > ul > li > a" =>
					"color: {{VALUE}};",
			],
		]);
		$this->add_control($prefix . "_sub_nav_hover_background", [
			"label" => esc_html__("Sub Nav Hover Background", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				"{{WRAPPER}} .nav_container_desktop #navbarSupportedContentDesktop ul.navbar-nav>li>ul>li:hover>a, .nav_container_desktop.nav_container_desktop_b #navbarSupportedContentDesktop ul.navbar-nav li>ul li:hover, .nav_container_desktop.nav_container_desktop_c #navbarSupportedContentDesktop ul.navbar-nav li:hover, .nav_container_desktop.nav_container_desktop_c #navbarSupportedContentDesktop ul.navbar-nav li>ul li:hover>a , .nav_container_desktop #navbarSupportedContentDesktop ul.navbar-nav>li>ul>li>ul>li:hover>a, .nav_container_desktop.nav_container_desktop_b #navbarSupportedContentDesktop ul.navbar-nav li > ul li:hover > a" =>
					"background-color: {{VALUE}};",
			],
		]);
		$this->add_control($prefix . "_sub_nav_hover_color", [
			"label" => esc_html__("Sub Nav Hover Text Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				"{{WRAPPER}} .nav_container_desktop #navbarSupportedContentDesktop ul.navbar-nav>li>ul>li:hover>a, .nav_container_desktop.nav_container_desktop_b #navbarSupportedContentDesktop ul.navbar-nav li>ul li:hover>a, .nav_container_desktop #navbarSupportedContentDesktop ul.navbar-nav > li > ul > li > ul > li:hover > a, .nav_container_desktop.nav_container_desktop_c #navbarSupportedContentDesktop ul.navbar-nav li>ul li:hover>a" =>
					"color: {{VALUE}};",
			],
		]);
	}

	private function add_element_coupon($label, $prefix, $selector)
	{
		$image_selectors = ["{{WRAPPER}} "];

		$image_selectors = implode(",", $image_selectors);
		$this->add_control($prefix . "_heading", [
			"type" => Controls_Manager::HEADING,
			"label" => $label,
			"separator" => "before",
		]);

		$this->add_control($prefix . "_heading_color", [
			"label" => esc_html__("Heading Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector . "_heading" => "color: {{VALUE}};",
			],
		]);

		$this->add_group_control(Group_Control_Typography::get_type(), [
			"name" => $prefix . "_heading",
			"selector" => $selector . "_heading",
		]);
		$this->add_control($prefix . "_sub_heading_color", [
			"label" => esc_html__("Sub Heading Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector . "_sub_heading" => "color: {{VALUE}};",
			],
		]);
		$this->add_group_control(Group_Control_Typography::get_type(), [
			"name" => $prefix . "_sub_heading",
			"selector" => $selector . "_sub_heading",
		]);
		$this->add_control($prefix . "_offer_text_color", [
			"label" => esc_html__("Offer Text Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector . "_offer" => "color: {{VALUE}};",
			],
		]);
		$this->add_group_control(Group_Control_Typography::get_type(), [
			"name" => $prefix . "_offer_text",
			"selector" => $selector . "_offer",
		]);
		$this->add_control($prefix . "_expiry_text_color", [
			"label" => esc_html__("Expiry Text Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector . "_expiry" => "color: {{VALUE}};",
			],
		]);
		$this->add_group_control(Group_Control_Typography::get_type(), [
			"name" => $prefix . "_expiry_text",
			"selector" => $selector . "_expiry",
		]);
		$this->add_control($prefix . "_disclaimer_text_color", [
			"label" => esc_html__("Disclaimer  Text Color", "elementor"),
			"type" => Controls_Manager::COLOR,
			"dynamic" => [],
			"selectors" => [
				$selector . "_disclaimer" => "color: {{VALUE}};",
			],
		]);
		$this->add_group_control(Group_Control_Typography::get_type(), [
			"name" => $prefix . "_disclaimer_text",
			"selector" => $selector . "_disclaimer",
		]);
	}
}
