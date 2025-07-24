<?php
function bc_register_promotion_type()
{
	$labels = [
		"name" => __("Polaris RDS Promotions", "polaris-rds"),
		"singular_name" => __("Promotion", "polaris-rds"),
		// 'archives' => __( 'Promotions Calendar', "polaris-rds" ),
		"add_new" => __("Add New", "polaris-rds"),
		"add_new_item" => __("Add New Promotion", "polaris-rds"),
	];

	$args = [
		"labels" => $labels,
		"public" => true,
		"has_archive" => "promotions",
		"rewrite" => ["has_front" => true, "slug" => "promotions"],
		"menu_icon" => "dashicons-tag",
		"supports" => false,
		"show_in_rest" => true,
	];

	register_post_type("bc_promotions", $args);
}
