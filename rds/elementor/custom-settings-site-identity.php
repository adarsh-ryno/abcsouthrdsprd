<?php

namespace Elementor\Core\Kits\Documents\Tabs;

use Elementor\Controls_Manager;
use Elementor\Core\Base\Document;
use Elementor\Core\Files\Uploads_Manager;

if (!defined("ABSPATH")) {
	exit(); // Exit if accessed directly
}

class Custom_Settings_Site_Identity extends Tab_Base
{
	public function get_id()
	{
		return "custom-settings-site-identity";
	}

	public function get_title()
	{
		return esc_html__("Custom Site Identity", "elementor");
	}

	public function get_group()
	{
		return "settings";
	}

	public function get_icon()
	{
		return "eicon-site-identity";
	}

	public function get_help_url()
	{
		return "https://go.elementor.com/global-site-identity/";
	}

	protected function register_tab_controls()
	{
		$mobile_logo_id = get_theme_mod("mobile_logo");
		$mobile_logo_src = wp_get_attachment_image_src($mobile_logo_id, "full");

		// If CANNOT upload svg normally, it will add a custom inline option to force svg upload if requested. (in logo and favicon)
		$should_include_svg_inline_option = !Uploads_Manager::are_unfiltered_uploads_enabled();

		$this->start_controls_section("section_" . $this->get_id(), [
			"label" => $this->get_title(),
			"tab" => $this->get_id(),
		]);

		$this->add_control($this->get_id() . "_refresh_notice", [
			"type" => Controls_Manager::RAW_HTML,
			"raw" => sprintf(
				/* translators: 1: Link open tag, 2: Link open tag, 3: Link close tag. */
				esc_html__(
					'Changes will be reflected only after %1$s saving %3$s and %2$s reloading %3$s preview.',
					"elementor"
				),
				'<a href="javascript: $e.run( \'document/save/default\' )">',
				'<a href="javascript: $e.run( \'preview/reload\' )">',
				"</a>"
			),
			"content_classes" =>
				"elementor-panel-alert elementor-panel-alert-info",
		]);

		$this->add_control("mobile_logo", [
			"label" => esc_html__("Mobile Logo", "elementor"),
			"type" => Controls_Manager::MEDIA,
			"should_include_svg_inline_option" => $should_include_svg_inline_option,
			"default" => [
				"id" => $mobile_logo_id,
				"url" => $mobile_logo_src ? $mobile_logo_src[0] : "",
			],
			"description" => sprintf(
				/* translators: 1: Width number pixel, 2: Height number pixel. */
				esc_html__(
					'Suggested image dimensions: %1$s × %2$s pixels.',
					"elementor"
				),
				"350",
				"100"
			),
			"export" => false,
		]);

		$this->end_controls_section();
	}

	public function on_save($data)
	{
		if (isset($data["settings"]["mobile_logo"])) {
			set_theme_mod(
				"mobile_logo",
				$data["settings"]["mobile_logo"]["id"]
			);
		}
	}
}
