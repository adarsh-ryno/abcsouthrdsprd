<?php
function bc_promotion_register_promotion_taxonomy()
{
	$labels = [
		"name" => __("Promotion Category", "polaris-rds"),
		"singular_name" => __("Promotion", "polaris-rds"),
		"add_new_item" => __("Add New Promotion Category", "polaris-rds"),
	];

	$args = [
		"labels" => $labels,
		"public" => true,
		"show_admin_column" => true,
		"show_in_quick_edit" => true,
		"show_in_rest" => true,
		"hierarchical" => true,
		"rewrite" => ["hierarchical" => true, "has_front" => true],
	];

	$post_types = ["bc_promotions"];

	register_taxonomy("bc_promotion_category", $post_types, $args);
}
