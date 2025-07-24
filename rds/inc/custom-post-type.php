<?php
/* Hook into the 'init' action so that the function
 * Containing our post type registration is not
 * unnecessarily executed.
 */

/* Our Team Section */

add_action("init", "bc_our_team_post_type", 0);
/* Creating a function to create our CPT */
function bc_our_team_post_type()
{
	// Set UI labels for Team Custom Post Type
	$labels = [
		"name" => _x("Team", "Post Type General Name", "rds"),
		"singular_name" => _x("Team", "Post Type Singular Name", "rds"),
		"menu_name" => __("Team", "rds"),
		"parent_item_colon" => __("Parent Team", "rds"),
		"all_items" => __("All Team", "rds"),
		"view_item" => __("View Team", "rds"),
		"add_new_item" => __("Add New Team", "rds"),
		"add_new" => __("Add New", "rds"),
		"edit_item" => __("Edit Team", "rds"),
		"update_item" => __("Update Team", "rds"),
		"search_items" => __("Search Team", "rds"),
		"not_found" => __("Not Found", "rds"),
		"not_found_in_trash" => __("Not found in Trash", "rds"),
	];
	// Set other options for Team Custom Post Type
	$args = [
		"label" => __("teams", "rds"),
		"description" => __("Team", "rds"),
		"labels" => $labels,
		"supports" => [
			"title",
			"editor",
			"thumbnail",
			"excerpt",
			"page-attributes",
		],
		"taxonomies" => ["genres"],
		// 'rewrite' => array( 'has_front' => false ,'slug' => '/'),
		"rewrite" => ["with_front" => false, "slug" => "meet-the-team"],
		/* A hierarchical CPT is like Pages and can have
		 * Parent and child items. A non-hierarchical CPT
		 * is like Posts.
		 */
		"hierarchical" => false,
		"public" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"show_in_admin_bar" => true,
		"menu_position" => 5,
		"can_export" => true,
		"has_archive" => false,
		"exclude_from_search" => false,
		"publicly_queryable" => true,
		"capability_type" => "page",
	];
	// Registering your Custom Post Type
	register_post_type("bc_teams", $args);
}
add_action("add_meta_boxes", "bc_create_team_metabox");
function bc_create_team_metabox()
{
	global $post;
	if (in_array($post->post_type, ["bc_teams"])) {
		add_meta_box("bc_teams", "Position", "bc_teams", "", "side");
	}
}
function bc_teams()
{
	global $post;
	$team_position = get_post_meta($post->ID, "team_position", true);
	?>
<textarea class="form-control" rows="1" cols="20" name="bc_team_heading" id="team_position"><?php echo $team_position ?></textarea>
<?php $team_position1 = get_post_meta($post->ID, "team_unique_id", true); ?>
<textarea class="form-control" rows="1" style="display: none;" cols="20" name="bc_team_unique_id" ><?php echo $team_position1 ?></textarea>
<?php wp_nonce_field("bc_team_metabox_nonce", "bc_team_metabox_process");
}
/** Save the metabox */
add_action("save_post", "bc_save_team_position", 1, 2);
function bc_save_team_position($post_id, $post)
{
	if (!isset($_POST["bc_team_metabox_process"])) {
		return;
	}
	if (
		!wp_verify_nonce(
			$_POST["bc_team_metabox_process"],
			"bc_team_metabox_nonce"
		)
	) {
		return $post->ID;
	}
	if (!current_user_can("edit_post", $post->ID)) {
		return $post->ID;
	}
	if (!isset($_POST["bc_team_heading"])) {
		return $post->ID;
	}
	if (!isset($_POST["bc_team_unique_id"])) {
		return $post->ID;
	}
	$sanitizedteam_position = wp_filter_post_kses($_POST["bc_team_heading"]);
	update_post_meta($post->ID, "team_position", $sanitizedteam_position);
	$sanitizedteam_unique_id = wp_filter_post_kses($_POST["bc_team_unique_id"]);
	update_post_meta($post->ID, "team_unique_id", $sanitizedteam_unique_id);
}

add_action("init", "bc_team_custom_taxonomy", 0);
//create a custom taxonomy name it "type" for your posts
function bc_team_custom_taxonomy()
{
	$labels = [
		"name" => _x("Departments", "taxonomy general name", "polaris-rds"),
		"singular_name" => _x("Department", "taxonomy singular name", "polaris-rds"),
		"search_items" => __("Search Teams Category", "polaris-rds"),
		"all_items" => __("All Departments", "polaris-rds"),
		"parent_item" => __("Parent Department", "polaris-rds"),
		"parent_item_colon" => __("Parent Department:", "polaris-rds"),
		"edit_item" => __("Edit Department", "polaris-rds"),
		"update_item" => __("Update Department", "polaris-rds"),
		"add_new_item" => __("Add New Department", "polaris-rds"),
		"new_item_name" => __("New Department Name", "polaris-rds"),
		"menu_name" => __("Departments", "polaris-rds"),
	];
	register_taxonomy(
		"bc_teams_category",
		["bc_teams"],
		[
			"hierarchical" => true,
			"labels" => $labels,
			"show_ui" => true,
			"show_admin_column" => true,
			"query_var" => true,
			// 'rewrite' => array( 'slug' => 'case-studies' ),
			"rewrite" => ["slug" => "meet-the-team", "with_front" => false],
		]
	);
}

/* Position Section */

add_action("init", "bc_position_post_type", 0);
/* Creating a function to create our CPT */
function bc_position_post_type()
{
	// Set UI labels for Position Custom Post Type
	$labels = [
		"name" => _x("Position", "Post Type General Name", "rds"),
		"singular_name" => _x("Position", "Post Type Singular Name", "rds"),
		"menu_name" => __("Position", "rds"),
		"parent_item_colon" => __("Parent Position", "rds"),
		"all_items" => __("All Position", "rds"),
		"view_item" => __("View Position", "rds"),
		"add_new_item" => __("Add New Position", "rds"),
		"add_new" => __("Add New", "rds"),
		"edit_item" => __("Edit Position", "rds"),
		"update_item" => __("Update Position", "rds"),
		"search_items" => __("Search Position", "rds"),
		"not_found" => __("Not Found", "rds"),
		"not_found_in_trash" => __("Not found in Trash", "rds"),
	];
	// Set other options for Position Custom Post Type
	$args = [
		"label" => __("position", "rds"),
		"description" => __("Position", "rds"),
		"labels" => $labels,
		"supports" => [
			"title",
			"editor",
			"thumbnail",
			"excerpt",
			"page-attributes",
		],
		"taxonomies" => ["genres"],
		// 'rewrite' => array( 'has_front' => false ,'slug' => '/'),
		"rewrite" => ["with_front" => false, "slug" => "position"],
		/* A hierarchical CPT is like Pages and can have
		 * Parent and child items. A non-hierarchical CPT
		 * is like Posts.
		 */
		"hierarchical" => false,
		"public" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"show_in_admin_bar" => true,
		"menu_position" => 5,
		"can_export" => true,
		"has_archive" => false,
		"exclude_from_search" => false,
		"publicly_queryable" => true,
		"capability_type" => "page",
	];
	// Registering your Custom Post Type
	register_post_type("bc_position", $args);
}
add_action("add_meta_boxes", "bc_create_position_metabox");
function bc_create_position_metabox()
{
	global $post;
	if (in_array($post->post_type, ["bc_position"])) {
		add_meta_box(
			"bc_position",
			"Custom Field",
			"bc_position",
			"",
			"normal"
		);
	}
}
function bc_position()
{
	global $post; ?>
<h4>Custom Content</h4>
<?php $team_custom_content = get_post_meta(
	$post->ID,
	"team_custom_content",
	true
); ?>
<textarea class="form-control" rows="15" cols="85" name="bc_team_custom_content" id="custom_content"><?php echo $team_custom_content ?></textarea>
<?php $team_position = get_post_meta($post->ID, "team_position", true); ?>
<h4>Position</h4>
<textarea class="form-control" rows="1" cols="20" name="bc_team_heading" id="team_position"><?php echo $team_position ?></textarea>
<?php $team_position_ID = get_post_meta(
	$post->ID,
	"position_unique_id",
	true
); ?>
<textarea class="form-control" style="display: none;" rows="1" cols="20" name="bc_position_unique_id" ><?php echo $team_position_ID ?></textarea>
<?php wp_nonce_field(
	"bc_position_metabox_nonce",
	"bc_position_metabox_process"
);
}
/** Save the metabox */
add_action("save_post", "bc_save_position_position", 1, 2);
function bc_save_position_position($post_id, $post)
{
	if (!isset($_POST["bc_position_metabox_process"])) {
		return;
	}
	if (
		!wp_verify_nonce(
			$_POST["bc_position_metabox_process"],
			"bc_position_metabox_nonce"
		)
	) {
		return $post->ID;
	}
	if (!current_user_can("edit_post", $post->ID)) {
		return $post->ID;
	}
	if (!isset($_POST["bc_team_heading"])) {
		return $post->ID;
	}
	if (!isset($_POST["bc_team_custom_content"])) {
		return $post->ID;
	}
	if (!isset($_POST["bc_position_unique_id"])) {
		return $post->ID;
	}
	$sanitizedteam_position = wp_filter_post_kses($_POST["bc_team_heading"]);
	$sanitizedteam_custom_content = wp_filter_post_kses(
		$_POST["bc_team_custom_content"]
	);
	update_post_meta($post->ID, "team_position", $sanitizedteam_position);
	update_post_meta(
		$post->ID,
		"team_custom_content",
		$sanitizedteam_custom_content
	);
	$sanitizedposition_unique_id = wp_filter_post_kses(
		$_POST["bc_position_unique_id"]
	);
	update_post_meta(
		$post->ID,
		"position_unique_id",
		$sanitizedposition_unique_id
	);
}

add_action("init", "bc_position_custom_taxonomy", 0);
//create a custom taxonomy name it "type" for your posts
function bc_position_custom_taxonomy()
{
	$labels = [
		"name" => _x("loaction", "taxonomy general name", "polaris-rds"),
		"singular_name" => _x("loaction", "taxonomy singular name", "polaris-rds"),
		"search_items" => __("Search loaction Category", "polaris-rds"),
		"all_items" => __("All loaction", "polaris-rds"),
		"parent_item" => __("Parent loaction", "polaris-rds"),
		"parent_item_colon" => __("Parent loaction:", "polaris-rds"),
		"edit_item" => __("Edit loaction", "polaris-rds"),
		"update_item" => __("Update loaction", "polaris-rds"),
		"add_new_item" => __("Add New loaction", "polaris-rds"),
		"new_item_name" => __("New loaction Name", "polaris-rds"),
		"menu_name" => __("loaction", "polaris-rds"),
	];
	register_taxonomy(
		"bc_position_category",
		["bc_position"],
		[
			"hierarchical" => true,
			"labels" => $labels,
			"show_ui" => true,
			"show_admin_column" => true,
			"query_var" => true,
			// 'rewrite' => array( 'slug' => 'case-studies' ),
			"rewrite" => ["slug" => "position", "with_front" => false],
		]
	);
}
