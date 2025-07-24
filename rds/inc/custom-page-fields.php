<?php

/*Define Excerpt Lenght*/
add_filter("excerpt_length", "custom_excerpt_length", 999);
function custom_excerpt_length($length)
{
    global $post;
    return 25;
}
/*Hard crop Image for blog post page*/
add_theme_support("post-thumbnails");
add_image_size("blogpost-thumbnail", 250, 170, true); // Hard Crop Mode

/*Create custom field (title) for pages, post, custom posts */
add_action("add_meta_boxes", "bc_create_title_overlay_metabox");
function bc_create_title_overlay_metabox()
{
    global $post;
    if (!in_array($post->post_type, ["bc_affiliations", "bc_testimonials", "bc_schemas"])) {
        add_meta_box("bc_title_overlay", "Hero Overlay text", "bc_title_overlay", "", "normal");
    }
}
function bc_title_overlay()
{
    global $post;
    $title = get_post_meta($post->ID, "title_overlay", true);
    ?>
<textarea class="form-control" rows="6" cols="85" name="bc_title_overlay_heading" id="title"><?php echo $title; ?></textarea>
<?php wp_nonce_field("bc_title_overlay_metabox_nonce", "bc_title_overlay_metabox_process");
}
/** Save the metabox */
add_action("save_post", "bc_save_title_overlay", 1, 2);
function bc_save_title_overlay($post_id, $post)
{
    if (!isset($_POST["bc_title_overlay_metabox_process"])) {
        return;
    }
    if (!wp_verify_nonce($_POST["bc_title_overlay_metabox_process"], "bc_title_overlay_metabox_nonce")) {
        return $post->ID;
    }
    if (!current_user_can("edit_post", $post->ID)) {
        return $post->ID;
    }
    if (!isset($_POST["bc_title_overlay_heading"])) {
        return $post->ID;
    }
    $sanitizedtitle = wp_filter_post_kses($_POST["bc_title_overlay_heading"]);
    update_post_meta($post->ID, "title_overlay", $sanitizedtitle);
}

// Custom Field for service area Location Name
add_action("add_meta_boxes", "bc_create_location_metabox");
function bc_create_location_metabox()
{
    global $post;
    if (!in_array($post->post_type, ["bc_affiliations", "bc_testimonials", "bc_schemas"])) {
        add_meta_box("bc_location", "Location", "bc_location", "", "side");
    }
}
function bc_location()
{
    global $post;
    $location = get_post_meta($post->ID, "location", true);
    ?>
<textarea class="form-control" rows="1" cols="20" name="bc_location_heading" id="location"><?php echo $location; ?></textarea>

<!-- services area start -->
<div id="reviews-enable-section">
    <div class="container-add-more">
        <?php
        $pages = get_pages();
        $array = RDS_TEMPLATE_DATA;

        // Ensure "service_areas" key exists and is an array
        $service_areas = isset($array["page_templates"]["landing_page"]["footer"]["service_areas"]) ? $array["page_templates"]["landing_page"]["footer"]["service_areas"] : [];

        $m = 0;

        if (is_array($service_areas)) {
            foreach ($service_areas as $areas) {
                if (isset($areas["page_ids"][0]) && $areas["page_ids"][0] == $post->ID) {
                    $area = $areas;
                }
            }
        }
        ?>

    <div class="mt-4" style="border-top: 1px solid #000;">  
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 mb-3" style="font-size: 16px;"><span>SELECT SERVICE AREA PAGES</span></div>
                    <div class="col-12">
                        <div class="dropdown show " style="border: 1px solid #000; border-radius: 7px;" >
                            <ul class="dropdown-menu  rdsMatchPageName"  style="width: 100%; ">
                                <input type="serach" value="" class="form-control rdsSearchThePageId" placeholder="Search Ids"/>
                                <div  style="max-height: 485.388px; overflow-y: auto; min-height: 96px;">                                                       
                                    <?php
                                    $l_selected = [];
                                    foreach ($pages as $location) {
                                        if (!empty(get_post_meta($location->ID, "location", true))) {
                                            if (!empty($area["location_ids"]) && in_array($location->ID, $area["location_ids"])) {
                                                $l_selected[] = get_the_title($location->ID);

                                                echo ' <li style="font-size:small; white-space: normal !important; " class=" dropdown-item rdsPageName"><input name="service_area_ids[' .
                                                    $m .
                                                    '][location_ids][]" type="checkbox" value="' .
                                                    $location->ID .
                                                    '"  checked class="service_area_page_ids service_area_l_ids" data-title="' .
                                                    $location->post_title .
                                                    '" data-page-id="' .
                                                    $location->ID .
                                                    '" > ' .
                                                    $location->post_title .
                                                    "(" .
                                                    $location->ID .
                                                    ")</li>";
                                            } else {
                                                echo ' <li style="font-size:small; white-space: normal !important;"   class="dropdown-item rdsPageName"><input name="service_area_ids[' .
                                                    $m .
                                                    '][location_ids][]" type="checkbox" value="' .
                                                    $location->ID .
                                                    '" class="service_area_page_ids service_area_l_ids" data-title="' .
                                                    $location->post_title .
                                                    '" data-page-id="' .
                                                    $location->ID .
                                                    '" > ' .
                                                    $location->post_title .
                                                    "(" .
                                                    $location->ID .
                                                    ") </li>";
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            </ul>
                            <button type="button" class="btn dropdown-toggle rds_selected_service_area service-title-class"  role="button" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="word-wrap: break-word; white-space: normal;">
                                <?php if (!empty($l_selected)) { ?>
                                    <ul style="padding-left: 0rem;" class="mb-0">
                                        <?php foreach ($pages as $location) {
                                            if (!empty($area["location_ids"]) && in_array($location->ID, $area["location_ids"])) {
                                                $l_selected["name"][] = get_the_title($location->ID);
                                                $l_selected["id"][] = $location->ID;
                                                echo ' <li style="text-align: left; font-size:small;" class="mb-0">' . get_the_title($location->ID) . "(" . $location->ID . ")</li>";
                                            }
                                        } ?>
                                    </ul>
                                <?php } else {echo "<label>SELECT SERVICE AREA PAGES</label>";} ?>

                            </button>
                        </div>
                    </div>

                </div> 
            </div>
        </div>
    </div>
    <?php $m++; ?>
    </div>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>    
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
 <script type="text/javascript">

                    jQuery(document).ready(function () {
                        //Hide Section if not enable
                        jQuery('.rds_selected_service_area').click(function () {
                            jQuery(this).parent('.dropdown').hasClass('show');
                        });
                 
                        //Search page ids
                        jQuery(".rdsSearchThePageId").on('keyup', function () {
                            var value = jQuery(this).val().toLowerCase();
                            //                    console.log(jQuery(this).parent(".rdsMatchPageName").html())
                            jQuery(this).parent(".rdsMatchPageName").find("li").each(function () {
                                if (jQuery(this).text().toLowerCase().search(value) > -1) {
                                    jQuery(this).show();
                                    jQuery(this).prev('.rdsPageName').last().show();
                                } else {
                                    jQuery(this).hide();
                                }
                            });
                        });
                        jQuery("body").on("change", ".service_area_page_ids", function () {
                            var title = jQuery(this).data("title");
                            var titleId = jQuery(this).data("page-id");
                            var titles = new Array();
                            titles[0] = 'SERVICE AREA PAGES TITLE';
                            var i = 0;
                            if (jQuery(this).is(":checked")) {
                                titles[0] = title+" ("+titleId+")";
                                i = 1;
                            }

                            var selected_inputs = jQuery(this).parent(".rdsPageName").siblings();
                            selected_inputs.each(function () {
                                if (jQuery(this).find("input").is(":checked")) {
                                    titles[i] = jQuery(this).find("input").data("title");
                                }
                                i++;
                            });
                            var blkstr = jQuery.map(titles, function (val, index) {
                                return val;
                            }).join(", ");
                            jQuery(this).closest(".rdsMatchPageName").siblings(".rds_selected_service_area").text(blkstr);
                        });
                    });
        </script>
<!-- services area start -->

<?php wp_nonce_field("bc_location_metabox_nonce", "bc_location_metabox_process");
}
/** Save the metabox */
add_action("save_post", "bc_save_location", 1, 2);
function bc_save_location($post_id, $post)
{
    if (!isset($_POST["bc_location_metabox_process"])) {
        return;
    }
    if (!wp_verify_nonce($_POST["bc_location_metabox_process"], "bc_location_metabox_nonce")) {
        return $post->ID;
    }
    if (!current_user_can("edit_post", $post->ID)) {
        return $post->ID;
    }
    if (!isset($_POST["bc_location_heading"])) {
        return $post->ID;
    }
    $sanitizedlocation = wp_filter_post_kses($_POST["bc_location_heading"]);
    update_post_meta($post->ID, "location", $sanitizedlocation);

    $array = RDS_TEMPLATE_DATA;
    $service_areas = isset($array["page_templates"]["landing_page"]["footer"]["service_areas"]) ? $array["page_templates"]["landing_page"]["footer"]["service_areas"] : [];

    if (isset($service_areas) && is_array($service_areas)) {
        $i = 0;
        $j = 0;
        foreach ($service_areas as $area) {
            if (isset($area["page_ids"][0]) && $area["page_ids"][0] == $post->ID) {
                if (empty($_POST["service_area_ids"]) || !isset($_POST["service_area_ids"][0]["location_ids"])) {
                    unset($array["page_templates"]["landing_page"]["footer"]["service_areas"][$i]);
                } else {
                    $array["page_templates"]["landing_page"]["footer"]["service_areas"][$i]["location_ids"] = $_POST["service_area_ids"][0]["location_ids"];
                }
                $j++;
            }
            $i++;
        }
        if ($j == 0) {
            $pageID = [$post->ID];
            $array["page_templates"]["landing_page"]["footer"]["service_areas"][$i]["page_ids"] = $pageID;
            if (isset($_POST["service_area_ids"][0]["location_ids"])) {
                $array["page_templates"]["landing_page"]["footer"]["service_areas"][$i]["location_ids"] = $_POST["service_area_ids"][0]["location_ids"];
            } else {
                // Handle the case where location_ids is not set in $_POST["service_area_ids"]
                $array["page_templates"]["landing_page"]["footer"]["service_areas"][$i]["location_ids"] = null; // Or some default value
            }
        }

        global $wpdb;
        $tableName = $wpdb->prefix . "options";
        $wpdb->update($tableName, ["option_value" => json_encode($array)], ["option_name" => "rds_template"]);
    }
}
/*Create custom field (title) for banner subpage , custom posts */
add_action("add_meta_boxes", "rds_create_subpage_banner_metabox");
function rds_create_subpage_banner_metabox()
{
    global $post;
    // echo '<pre>';
    // print_r(get_post_meta( $post->ID, '_wp_page_template', true ));
    if ("page-templates/rds-subpage-sidebar.php" == get_post_meta($post->ID, "_wp_page_template", true) || "page-templates/rds-subpage-withoutsidebar.php" == get_post_meta($post->ID, "_wp_page_template", true)) {
        add_meta_box("rds_heading_subheading_overlay", "Banner Heading And Subheading Text", "rds_heading_subheading_overlay", "", "normal");
    }
}
function rds_heading_subheading_overlay()
{
    global $post;
    $heading = get_post_meta($post->ID, "banner_heading", true);
    $subheading = get_post_meta($post->ID, "banner_subheading", true);
    $buttontext = get_post_meta($post->ID, "banner_buttontext", true);
    $buttonlink = get_post_meta($post->ID, "banner_buttonlink", true);
    ?>

<div>Banner Heading Text<textarea class="form-control" rows="1" cols="85" name="rds_heading" ><?php echo $heading; ?></textarea></div>
<div>Banner Subheading Text<textarea class="form-control" rows="1" cols="85" name="rds_subheading" ><?php echo $subheading; ?></textarea></div>
<div>Banner Button Text<textarea class="form-control" rows="1" cols="85" name="rds_buttontext" ><?php echo $buttontext; ?></textarea></div>
<div>Banner Button Link<textarea class="form-control" rows="1" cols="85" name="rds_buttonlink" ><?php echo $buttonlink; ?></textarea></div>

<?php wp_nonce_field("rds_title_overlay_metabox_nonce", "rds_title_overlay_metabox_process");
}
/** Save the metabox */
add_action("save_post", "rds_save_subpage_banner", 1, 2);
function rds_save_subpage_banner($post_id, $post)
{
    if (!isset($_POST["rds_title_overlay_metabox_process"])) {
        return;
    }
    if (!wp_verify_nonce($_POST["rds_title_overlay_metabox_process"], "rds_title_overlay_metabox_nonce")) {
        return $post->ID;
    }
    if (!current_user_can("edit_post", $post->ID)) {
        return $post->ID;
    }
    if (!isset($_POST["rds_heading"])) {
        return $post->ID;
    }
    if (!isset($_POST["rds_subheading"])) {
        return $post->ID;
    }
    if (!isset($_POST["rds_buttontext"])) {
        return $post->ID;
    }
    if (!isset($_POST["rds_buttonlink"])) {
        return $post->ID;
    }

    $sanitizedheading = wp_filter_post_kses($_POST["rds_heading"]);
    $sanitizedsubheading = wp_filter_post_kses($_POST["rds_subheading"]);
    $sanitizedbuttontext = wp_filter_post_kses($_POST["rds_buttontext"]);
    $sanitizedbuttonlink = wp_filter_post_kses($_POST["rds_buttonlink"]);

    update_post_meta($post->ID, "banner_heading", $sanitizedheading);
    update_post_meta($post->ID, "banner_subheading", $sanitizedsubheading);
    update_post_meta($post->ID, "banner_buttontext", $sanitizedbuttontext);
    update_post_meta($post->ID, "banner_buttonlink", $sanitizedbuttonlink);
}

/*Create custom field (title) for banner service subpage , custom posts */
add_action("add_meta_boxes", "rds_create_promotion_banner_metabox", 1);
function rds_create_promotion_banner_metabox()
{
    global $post;
    $page_template = array(
        "page-templates/rds-subpage-sidebar.php",
        "page-templates/rds-subpage-withoutsidebar.php",
        "page-templates/rds-contactpage.php",
        "page-templates/rds-service-subpage-sidebar.php",
        "page-templates/rds-review.php",
        "page-templates/rds-team.php",
        "page-templates/rds-schedule-services.php",
        "page-templates/rds-free-estimate.php",
        "page-templates/rds-financing.php",
        "page-templates/rds-history.php",
        "page-templates/rds-about-us.php",
        "page-templates/rds-landing.php",
    );
    if (get_post_meta($post->ID, "_wp_page_template", true)) {
        add_meta_box("rds_banner_promotion", "Promotion ID", "rds_banner_promotion", "page", "side", "high");
    }
}

function rds_banner_promotion()
{
    global $post;
    $service_promotion_id = get_post_meta($post->ID, "rds_promotion_id", true);
    ?>
<input type="text" name="rds_promotion_id" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  value="<?php echo $service_promotion_id; ?>" >

<?php wp_nonce_field("rds_title_overlay_metabox_nonce", "rds_title_overlay_metabox_process");
}
/** Save the metabox */
add_action("save_post", "rds_save_banner_promotion_id", 1, 2);
function rds_save_banner_promotion_id($post_id, $post)
{
    if (!isset($_POST["rds_title_overlay_metabox_process"])) {
        return;
    }
    if (!wp_verify_nonce($_POST["rds_title_overlay_metabox_process"], "rds_title_overlay_metabox_nonce")) {
        return $post->ID;
    }
    if (!current_user_can("edit_post", $post->ID)) {
        return $post->ID;
    }
    if (!isset($_POST["rds_promotion_id"])) {
        return $post->ID;
    }

    $sanitizedheading = wp_filter_post_kses($_POST["rds_promotion_id"]);

    update_post_meta($post->ID, "rds_promotion_id", $sanitizedheading);
}

// Custom Field for Schema
add_action("add_meta_boxes", "rds_create_chema_metabox");

function rds_create_chema_metabox()
{
    global $post;
    if (!in_array($post->post_type, ["bc_affiliations", "bc_testimonials", "bc_schemas"])) {
        add_meta_box("rds_schema", "Schema", "rds_schema");
    }
}

function rds_schema()
{
    global $post;
    $rds_schema = get_post_meta($post->ID, "rds_schema", true);
    ?>
        <textarea class="" style="width: 100%; height: 150px;"  name="rds_schema_heading" id="rds_schema"><?php echo $rds_schema; ?></textarea>
    <?php wp_nonce_field("rds_schema_metabox_nonce", "rds_schema_metabox_process");
}

/** Save the metabox */
add_action("save_post", "rds_save_schema", 1, 2);

function rds_save_schema($post_id, $post)
{
    if (!isset($_POST["rds_schema_metabox_process"])) {
        return;
    }
    if (!wp_verify_nonce($_POST["rds_schema_metabox_process"], "rds_schema_metabox_nonce")) {
        return $post->ID;
    }
    if (!current_user_can("edit_post", $post->ID)) {
        return $post->ID;
    }
    if (!isset($_POST["rds_schema_heading"])) {
        return $post->ID;
    }
    $sanitizedrds_schema = wp_filter_post_kses($_POST["rds_schema_heading"]);
    update_post_meta($post_id, "rds_schema", $sanitizedrds_schema);
}
