<?php

function register_custom_clear_cache_endpoint()
{
	register_rest_route("custom/v1", "/clear-cache", [
		"methods" => "POST",
		"callback" => "custom_clear_cache_callback",
		'permission_callback' => '__return_true',
	]);
}
add_action("rest_api_init", "register_custom_clear_cache_endpoint");

function custom_clear_cache_callback($data)
{
	if (function_exists("wp_cache_clear_cache")) {
		wp_cache_clear_cache();
		return ["success" => true, "message" => "Cache cleared successfully."];
	} else {
		return [
			"success" => false,
			"message" => "Cache clearing function not available.",
		];
	}
}

function wp_cache_clear_cache()
{
	wp_using_ext_object_cache(false);
	wp_cache_flush();
	wp_cache_init();
}
