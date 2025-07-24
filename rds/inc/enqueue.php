<?php
/**
 * Understrap enqueue scripts
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined("ABSPATH") || exit();

function pr($value)
{
	$template = '<pre class="pr">%s</pre>';
	printf($template, trim(print_r($value, true)));
	return $value;
}

if (!function_exists("understrap_scripts")) {
	/**
	 * Load theme's JavaScript and CSS sources.
	 */
	function understrap_scripts()
	{
		// Get the theme data.
		global $wpdb;
		$the_theme = wp_get_theme();
		$theme_version = $the_theme->get("Version");
		$bootstrap_version = get_theme_mod(
			"understrap_bootstrap_version",
			"bootstrap4"
		);
		$suffix = ".min";

		if (is_multisite()) {
			if (is_main_site()) {
				$theme_styles  = "/css/". $wpdb->prefix ."theme{$suffix}.css";
					} 
					else {
						$theme_styles  = "/css/". $wpdb->prefix ."theme{$suffix}.css";
					}
		} else {
			$theme_styles  = "/css/theme{$suffix}.css";
		}
		//$theme_styles = "/css/theme{$suffix}.css";
		$theme_scripts = "/js/theme{$suffix}.js";
		if ("bootstrap4" === $bootstrap_version) {
			//$theme_styles = "/css/theme{$suffix}.css";
			$theme_scripts = "/js/theme{$suffix}.js";
		}

		$css_version =	$theme_version . "." .  filemtime(get_template_directory() . $theme_styles);

		wp_enqueue_style( "rds-parent",	get_template_directory_uri() . $theme_styles, array('elementor-frontend' ) , $css_version, 'all');


		wp_enqueue_script("jquery", true);

		$js_version =
			$theme_version .
			"." .
			filemtime(get_template_directory() . $theme_scripts);
		wp_enqueue_script(
			"rds-parent",
			get_template_directory_uri() . $theme_scripts,
			[],
			$js_version,
			true
		);
		if (is_singular() && comments_open() && get_option("thread_comments")) {
			wp_enqueue_script("comment-reply");
		}
	}
} // End of if function_exists( 'understrap_scripts' ).

add_action("wp_enqueue_scripts", "understrap_scripts");
 