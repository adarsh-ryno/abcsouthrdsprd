<?php

/**
 * Create the metabox
 * @link https://developer.wordpress.org/reference/functions/add_meta_box/
 */
function bc_create_metabox()
{
	// Can only be used on a single post type (ie. page or post or a custom post type).
	// Must be repeated for each post type you want the metabox to appear on.
	add_meta_box(
		"bc_render_metabox", // Metabox ID
		"Coupon", // Title to display
		"bc_render_metabox", // Function to call that contains the metabox content
		"bc_promotions", // Post type to display metabox on
		"normal", // Where to put it (normal = main colum, side = sidebar, etc.)
		"high" // Priority relative to other metaboxes
	);
}

add_action("add_meta_boxes", "bc_create_metabox");

/**
 * Render the metabox markup
 * This is the function called in `bc_create_metabox()`
 */
function bc_render_metabox()
{
	// Get the current post data
	global $post; // Get the current post data
	$title = get_post_meta($post->ID, "promotion_title1", true);
	$recurring_setting = get_post_meta(
		$post->ID,
		"promotion_recurring_setting",
		true
	);
	$show_banner = get_post_meta(
		$post->ID,
		"promotion_show_banner_setting",
		true
	);
    $landing_page = get_post_meta(
        $post->ID,
        "promotion_landing_page_setting",
        true
    );
	$promotion_default_coupon = get_post_meta(
		$post->ID,
		"promotion_default_checkbox",
		true
	);
	$promotion_open_new_tab = get_post_meta(
		$post->ID,
		"promotion_open_new_tab",
		true
	);
	$defaultcheck = get_post($post->ID);

	$promotion_expiry_endDate = get_post_meta(
		$post->ID,
		"promotion_expiry_enddate",
		true
	);
	$promotion_expiry_endDate2 = get_post_meta(
		$post->ID,
		"promotion_expiry_enddate2",
		true
	);
	$promotion_noexp = get_post_meta($post->ID, "promotion_noexpiry", true);
	$color = get_post_meta($post->ID, "promotion_color", true);
    $date = get_post_meta($post->ID, "promotion_expiry_date1", true);
	$landing = get_post_meta($post->ID, "promotion_landing_page", true);
	$subheading = get_post_meta($post->ID, "promotion_subheading", true);
	$heading = get_post_meta($post->ID, "promotion_heading", true);
	$more_info = get_post_meta($post->ID, "promotion_more_info", true);
	$footer_heading = get_post_meta(
		$post->ID,
		"promotion_footer_heading",
		true
	);
	$rquestButtonLink = get_post_meta($post->ID, "request_button_link", true);
	$rquestButtonTitle = get_post_meta($post->ID, "request_button_title", true);

	$title2 = get_post_meta($post->ID, "promotion_title2", true);
	$date2 = get_post_meta($post->ID, "promotion_expiry_date2", true);
	$promotion_custom_image = get_post_meta(
		$post->ID,
		"promotion_custom_image",
		true
	);
	?>
    <!-- Design of the page -->
    <div class="col-lg-12">
        <div class="tabs-container">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a class="button " data-toggle="tab" href="#tab-1" aria-expanded="true"> Coupon Builder </a>
                </li>
                <li class="">
                    <a class="button " data-toggle="tab" href="#tab-2" aria-expanded="false">Custom Image</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="panel-body mt-3">
                    <div class="container">
                        <div class="row">
                            <!-- <div class="col-3">
                                <div class="form-group">
                                    <label>Default promotion</label>
                                    <input type="checkbox" name="promotion_default_coupon_metabox" id="promotion_default_coupon_metabox" class="form-control" value="1" <?php echo $promotion_default_coupon ==
                                    1
                                    	? "checked"
                                    	: ""; ?>
    <?php echo $defaultcheck->post_status == "auto-draft" ? "checked" : ""; ?>  

                                           />
                                </div>
                            </div> -->
                            <div class="col-3">
                                <div class="form-group ">
                                    <label>No Expiry</label>
                                    <input type="checkbox" name="promotion_noexpiry_metabox" id="promotion_noexpiry_metabox" class="form-control" value="1" 
    <?php echo $promotion_noexp == 1 ? "checked" : ""; ?> />
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group noexp">
                                    <label>Recurring promotion</label>
                                    <input type="checkbox" name="promotion_recurring_coupon_metabox" id="promotion_recurring_coupon_metabox" class="form-control" value="1" <?php echo $recurring_setting ==
                                    1
                                    	? "checked"
                                    	: ""; ?> />
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group ">
                                    <label>Show in banner</label>
                                    <input type="checkbox" name="promotion_show_banner_coupon_metabox" id="promotion_show_banner_coupon_metabox" class="form-control" value="1" <?php echo $show_banner ==
                                    1
                                    	? "checked"
                                    	: ""; ?> />
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group ">
                                    <label>Landing Page</label>
                                    <input type="checkbox" name="promotion_landing_page_coupon_metabox" id="promotion_landing_page_coupon_metabox" class="form-control" value="1" <?php echo $landing_page ==
                                    1
                                        ? "checked"
                                        : ""; ?> />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab-1" class="tab-pane active">
                    <div class="panel-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label><?php _e(
                                        	"Title",
                                        	"promotion_title_metabox"
                                        ); ?></label>
                                        <input type="hidden" name="tab_val1" value="true" id="tab_val1">
                                        <input type="text" name="promotion_title_metabox1" id="" value="<?php echo esc_attr(
                                        	$title
                                        ); ?>" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label><?php _e(
                                        	"Heading",
                                        	"promotion_heading"
                                        ); ?></label>
                                        <input type="text" name="promotion_heading" id="" value="<?php echo esc_attr(
                                        	$heading
                                        ); ?>" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label><?php _e(
                                        	"Button Label",
                                        	"request_button_title"
                                        ); ?></label>
                                        <input type="text" name="request_button_title" id="" value="<?php echo esc_attr(
                                        	$rquestButtonTitle
                                        ); ?>" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label><?php _e(
                                        	"Button Link",
                                        	"request_button_link"
                                        ); ?></label>
                                        <input type="text" name="request_button_link" id="" value="<?php echo esc_attr(
                                        	$rquestButtonLink
                                        ); ?>" class="form-control" >
                                        <label>Open in New Tab</label>
                                        <input type="checkbox" name="open_new_tab_metabox" id="open_new_tab_metabox" class="form-control" value="1" 
                                        <?php echo $promotion_open_new_tab == 1
                                        	? "checked"
                                        	: ""; ?>
                                           />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label><?php _e(
                                        	"Background Color (hex)",
                                        	"promotion_color_metabox"
                                        ); ?></label>
                                        <input type="text" name="promotion_color_metabox" id="promotion_color_metabox" class="form-control background-color" value="<?php echo esc_attr(
                                        	$color
                                        ); ?>" required />

                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group expiration_date noexp">
                                        <label class="expiry"><?php _e(
                                        	"Expiration Date",
                                        	"custompromotion_expiry_date_metabox_date"
                                        ); ?></label>
                                        <div class="input-group date">
                                            <span class="input-group-addon">
                                            <!-- <i class="fa fa-calendar"></i> -->
                                            </span>

                                            <input type="text" name="promotion_expiry_date_metabox1" id="promotion_expiry_date_metabox1" value="<?php echo esc_attr(
                                            	$date
                                            ); ?>" class="form-control" required>
                                        </div>
                                        <label>Last date of month</label>
                                        <input type="checkbox" name="promotion_expiry_enddate_metabox" id="promotion_expiry_enddate_metabox" class="form-control" value="1" 
    <?php echo $promotion_expiry_endDate == 1 ? "checked" : ""; ?>
                                               />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label><?php _e(
                                        	"Subheading (HTML allowed)",
                                        	"promotion_subheading"
                                        ); ?></label>
                                        <textarea class="form-control" rows="5" name="promotion_subheading" id="promotion_subheading" required ><?php echo $subheading ?></textarea>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label><?php _e(
                                        	"Footer (HTML allowed)",
                                        	"promotion_footer_heading"
                                        ); ?></label>
                                        <textarea class="form-control" rows="5" name="promotion_footer_heading" id="promotion_footer_heading" required ><?php echo $footer_heading ?></textarea>
                                    </div> 
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label><?php _e(
                                        	"More Info",
                                        	"promotion_more_info"
                                        ); ?></label>
                                        <textarea class="form-control" rows="5" name="promotion_more_info" id="promotion_more_info" ><?php echo $more_info ?></textarea>
                                    </div> 
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label><?php _e(
                                        	"Preview",
                                        	"promotion_footer_heading"
                                        ); ?></label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label><?php _e("Shortcode", "polaris-rds"); ?></label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="widget lazur-bg no-padding rounded-0" style="background-color:<?php echo $color; ?>">
                                        <div class="p-m">
                                            <h3 id="promotion_title" class="font-bold no-margins text-center ml-1"><?php echo esc_html(
                                            	$title
                                            ); ?></h3>
                                            <h5 id="promotion_subheading_msg" class="m-xs text-center"><?php echo $subheading ?></h5>


                                            <div class="text-center ml-1 font-italic"><small id="expires1"><?php if (
                                            	!empty($date)
                                            ) {
                                            	echo "Expires";
                                            } ?> <?php echo esc_attr(
 	$date
 ); ?></small></div>
                                            <div class="text-center font-italic"><small id="promotion_footerheading_msg" class="text-center"><?php echo $footer_heading ?></small></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <h5>[bc-promotion coupon_id="<?php echo $post->ID ?>"]</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab-2" class="tab-pane">
                    <div class="panel-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><?php _e(
                                        	"Title",
                                        	"promotion_title_metabox"
                                        ); ?></label>

                                        <input type="hidden" name="tab_val2" value="false" id="tab_val2">

                                        <input type="text" name="promotion_title_metabox2" id="" value="<?php echo esc_attr(
                                        	$title2
                                        ); ?>" class="form-control" >
                                    </div>
                                </div>

                                <!--  <div class="col-6">
                                     <div class="form-group">
                                       <label>Default promotion</label>
                                       <input type="checkbox" name="promotion_default_coupon_metabox" id="promotion_default_coupon_metabox" class="form-control" value="1" <?php //echo ((($promotion_default_coupon) == 1)?"checked":"")
	?> />
                                   </div>
                               </div>
                                    <div class="col-6">
                                   <div class="form-group">
                                       <label>Recurring promotion</label>
                                       <input type="checkbox" name="promotion_recurring_coupon_metabox" id="promotion_recurring_coupon_metabox" class="form-control" value="1" <?php //echo ((($recurring_setting) == 1)?"checked":"")
	?> />
                                   </div>
                               </div> -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php _e(
                                        	"Upload a custom image (Size 300*300)",
                                        	"promotion_color_metabox"
                                        ); ?></label>

                                        <input type="text" name="promotion_custom_image" class="meta-image form-control" value="<?php echo $promotion_custom_image; ?>">
                                        <input type="button" class="button bc-promotion-image-upload" value="Browse">
                                        <input type="button" class="button bc-promotion-image-remove" value="Remove Image">
                                        <p>
                                        <div class="image-preview">
                                            <?php if (
                                            	isset(
                                            		$promotion_custom_image
                                            	) &&
                                            	!empty($promotion_custom_image)
                                            ) { ?>

                                                <img src="<?php echo $promotion_custom_image; ?>" style="max-width: 250px;">
    <?php } else { ?>
                                                <img style="width: 250px; height: 250px;" src="http://placehold.it/300x300" />
    <?php } ?>
                                        </div>
                                        </p>


                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group expiration_date noexp">
                                        <label class="expiry"><?php _e(
                                        	"Expiration Date",
                                        	"custompromotion_expiry_date_metabox_date"
                                        ); ?></label>
                                        <div class="input-group date">
                                            <span class="input-group-addon">
                                            <!-- <i class="fa fa-calendar"></i> -->
                                            </span>
                                            <input type="text" name="promotion_expiry_date_metabox2" id="promotion_expiry_date_metabox2" value="<?php echo esc_attr(
                                            	$date2
                                            ); ?>" class="form-control" >
                                        </div>
                                        <label>Last date of month</label>
                                        <input type="checkbox" name="promotion_expiry_enddate2_metabox" id="promotion_expiry_enddate2_metabox" class="form-control" value="1" 
    <?php echo $promotion_expiry_endDate2 == 1 ? "checked" : ""; ?> />
                                    </div>
                                    <div class="form-group">
                                        <label>Shortcode</label>
                                        <h5>[bc-promotion coupon_id="<?php echo $post->ID ?>"]</h5>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            var todaydate = new Date();
            var lastDay = new Date(todaydate.getFullYear(), todaydate.getMonth() + 1, 0);
            function convert(str) {
                var date = new Date(str),
                        mnth = ("0" + (date.getMonth() + 1)).slice(-2),
                        day = ("0" + date.getDate()).slice(-2);
                return [mnth, day, date.getFullYear()].join("/");
            }
            if (jQuery("#promotion_recurring_coupon_metabox").prop('checked') == true) {
                jQuery(".expiry").text("Recurring Date");
            } else {
                jQuery(".expiry").text("Expiration Date");
            }

            jQuery("#promotion_recurring_coupon_metabox").change(function () {
                if (jQuery("#promotion_recurring_coupon_metabox").prop('checked') == true) {
                    jQuery(".expiry").text("Recurring Date");

                } else {

                    jQuery(".expiry").text("Expiration Date");
                }
            });
            jQuery("#promotion_expiry_enddate_metabox").change(function () {

                if (jQuery("#promotion_expiry_enddate_metabox").prop('checked') == true) {

                    jQuery("#promotion_expiry_date_metabox1").val(convert(lastDay));
                    jQuery("#promotion_expiry_date_metabox1").hide();

                } else {
                    jQuery("#promotion_expiry_date_metabox1").show();
                    jQuery("#promotion_expiry_date_metabox1").val(convert(lastDay));

                }
            });
            jQuery("#promotion_expiry_enddate2_metabox").change(function () {

                if (jQuery("#promotion_expiry_enddate2_metabox").prop('checked') == true) {

                    jQuery("#promotion_expiry_date_metabox2").val(convert(lastDay));
                    jQuery("#promotion_expiry_date_metabox2").hide();

                } else {
                    jQuery("#promotion_expiry_date_metabox2").show();
                    jQuery("#promotion_expiry_date_metabox2").val(convert(lastDay));

                }
            });
            if (jQuery("#promotion_expiry_enddate_metabox").prop('checked') == true) {
                jQuery("#promotion_expiry_date_metabox1").hide();
            } else {
                jQuery("#promotion_expiry_date_metabox1").show();
            }
            if (jQuery("#promotion_expiry_enddate2_metabox").prop('checked') == true) {
                jQuery("#promotion_expiry_date_metabox2").hide();
            } else {
                jQuery("#promotion_expiry_date_metabox2").show();
            }


            jQuery("#promotion_noexpiry_metabox").change(function () {
                if (jQuery("#promotion_noexpiry_metabox").prop('checked') == true) {
                    jQuery("#promotion_expiry_enddate_metabox").prop("checked", true);
                    jQuery("#promotion_recurring_coupon_metabox").prop("checked", true);
                    jQuery("#promotion_show_banner_coupon_metabox").prop("checked", true);
                    jQuery("#promotion_landing_page_coupon_metabox").prop("checked", true);
                    jQuery("#promotion_expiry_date_metabox1").val(convert(lastDay));
                    jQuery("#promotion_expiry_date_metabox2").val(convert(lastDay));
                    jQuery("#expires1").hide();
                    jQuery(".noexp").hide();

                } else {
                    jQuery("#promotion_recurring_coupon_metabox").prop("checked", false);
                    jQuery("#promotion_show_banner_coupon_metabox").prop("checked", false);
                    jQuery("#promotion_landing_page_coupon_metabox").prop("checked", false);
                    jQuery("#promotion_expiry_enddate_metabox").prop("checked", false);
                    jQuery("#expires1").show();
                    jQuery(".noexp").show();
                }
            });
            if (jQuery("#promotion_noexpiry_metabox").prop('checked') == true) {
                jQuery("#expires1").hide();
                jQuery(".noexp").hide();
            } else {
                jQuery("#expires1").show();
                jQuery(".noexp").show();
            }


        });
    </script>

    <?php // Security field

	// This validates that submission came from the
    // actual dashboard and not the front end or
    // a remote server.
    wp_nonce_field(
    	"_namespace_form_metabox_nonce",
    	"_namespace_form_metabox_process"
    );
}

/**
 * Save the metabox
 * @param  Number $post_id The post ID
 * @param  Array  $post    The post data
 */
function bc_save_metabox($post_id, $post)
{
	if (isset($_POST["tab_val1"]) && $_POST["tab_val1"] == "true") {
		/* echo "<pre>";
          print_r($_POST);
          // echo $sanitizedrecurring_coupon."--Recurring value";
          echo "<pre>"; die('ss'); */
		$sanitizedrecurring_coupon = "";
        $sanitizedshow_banner = "";
		$sanitizedlanding_page = "";
		$sanitizeddefault_coupon = "";
		$open_new_tab = "";
		$sanitizedexpiry_enddate = "";
		$sanitizednoexpiry = "";
		$sanitizedtitle = "";
		$sanitizedcolor = "";
		$sanitizedexpiry = "";
		if (isset($_POST["promotion_recurring_coupon_metabox"])) {
			$sanitizedrecurring_coupon = wp_filter_post_kses(
				strip_tags($_POST["promotion_recurring_coupon_metabox"])
			);
		}
		if (isset($_POST["promotion_show_banner_coupon_metabox"])) {
			$sanitizedshow_banner = wp_filter_post_kses(
				strip_tags($_POST["promotion_show_banner_coupon_metabox"])
			);
		}
        if (isset($_POST["promotion_landing_page_coupon_metabox"])) {
            $sanitizedlanding_page = wp_filter_post_kses(
                strip_tags($_POST["promotion_landing_page_coupon_metabox"])
            );
        }
		if (isset($_POST["promotion_default_coupon_metabox"])) {
			$sanitizeddefault_coupon = wp_filter_post_kses(
				strip_tags($_POST["promotion_default_coupon_metabox"])
			);
		}
		if (isset($_POST["open_new_tab_metabox"])) {
			$open_new_tab = wp_filter_post_kses(
				strip_tags($_POST["open_new_tab_metabox"])
			);
		}

		if (isset($_POST["promotion_expiry_enddate_metabox"])) {
			$sanitizedexpiry_enddate = wp_filter_post_kses(
				strip_tags($_POST["promotion_expiry_enddate_metabox"])
			);
		}
		if (isset($_POST["promotion_noexpiry_metabox"])) {
			$sanitizednoexpiry = wp_filter_post_kses(
				strip_tags($_POST["promotion_noexpiry_metabox"])
			);
		}
		if (isset($_POST["promotion_title_metabox1"])) {
			$sanitizedtitle = wp_filter_post_kses(
				$_POST["promotion_title_metabox1"]
			);
		}
		// print_r($sanitizedtitle); die('ss');
		if (isset($_POST["promotion_color_metabox"])) {
			$sanitizedcolor = wp_filter_post_kses(
				$_POST["promotion_color_metabox"]
			);
		}
		if (isset($_POST["promotion_expiry_date_metabox1"])) {
			$sanitizedexpiry = wp_filter_post_kses(
				$_POST["promotion_expiry_date_metabox1"]
			);
		}
		// $date_format = str_replace('/', '-', $get_expiry_date);
		// $sanitizedexpiry =  date('m/d/Y', strtotime($date_format));
		// print_r($get_expiry_date);die;
		$sanitizedsubheading = wp_filter_post_kses(
			$_POST["promotion_subheading"]
		);
		$sanitizedrequestlink = wp_filter_post_kses(
			$_POST["request_button_link"]
		);
		$sanitizedrequestitle = wp_filter_post_kses(
			$_POST["request_button_title"]
		);
		$sanitizedheading = wp_filter_post_kses($_POST["promotion_heading"]);
		$sanitizedfooterheading = wp_filter_post_kses(
			$_POST["promotion_footer_heading"]
		);
		$sanitizedmoreinfo = wp_filter_post_kses($_POST["promotion_more_info"]);
		// Save our submissions to the database
		update_post_meta($post->ID, "promotion_title1", $sanitizedtitle);
		if (empty($sanitizedrecurring_coupon)) {
			echo $sanitizedrecurring_coupon = 0;
		} else {
			echo $sanitizedrecurring_coupon = 1;
		}
		if (empty($sanitizedshow_banner)) {
			echo $sanitizedshow_banner = 0;
		} else {
			echo $sanitizedshow_banner = 1;
		}
        if (empty($sanitizedlanding_page)) {
            echo $sanitizedlanding_page = 0;
        } else {
            echo $sanitizedlanding_page = 1;
        }
		if (empty($open_new_tab)) {
			echo $open_new_tab = 0;
		} else {
			echo $open_new_tab = 1;
		}
		if (empty($sanitizeddefault_coupon)) {
			echo $sanitizeddefault_coupon = 0;
		} else {
			echo $sanitizeddefault_coupon = 1;
		}
		if (empty($sanitizedexpiry_enddate)) {
			echo $sanitizedexpiry_enddate = 0;
		} else {
			echo $sanitizedexpiry_enddate = 1;
		}
		if (empty($sanitizednoexpiry)) {
			echo $sanitizednoexpiry = 0;
		} else {
			echo $sanitizednoexpiry = 1;
		}

		update_post_meta(
			$post->ID,
			"promotion_recurring_setting",
			$sanitizedrecurring_coupon
		);
		update_post_meta(
			$post->ID,
			"promotion_show_banner_setting",
			$sanitizedshow_banner
		);
        update_post_meta(
            $post->ID,
            "promotion_landing_page_setting",
            $sanitizedlanding_page
        );

		update_post_meta($post->ID, "promotion_open_new_tab", $open_new_tab);
		update_post_meta(
			$post->ID,
			"promotion_default_checkbox",
			$sanitizeddefault_coupon
		);
		update_post_meta(
			$post->ID,
			"promotion_expiry_enddate",
			$sanitizedexpiry_enddate
		);
		update_post_meta($post->ID, "promotion_noexpiry", $sanitizednoexpiry);
		update_post_meta($post->ID, "promotion_color", $sanitizedcolor);
        update_post_meta($post->ID, "promotion_expiry_date1", $sanitizedexpiry);
		update_post_meta($post->ID, "promotion_landing_page", $sanitizedlanding_page);

		update_post_meta(
			$post->ID,
			"promotion_subheading",
			$sanitizedsubheading
		);
		update_post_meta(
			$post->ID,
			"request_button_link",
			$sanitizedrequestlink
		);
		update_post_meta(
			$post->ID,
			"request_button_title",
			$sanitizedrequestitle
		);
		update_post_meta($post->ID, "promotion_heading", $sanitizedheading);
		update_post_meta(
			$post->ID,
			"promotion_footer_heading",
			$sanitizedfooterheading
		);
		update_post_meta($post->ID, "promotion_more_info", $sanitizedmoreinfo);
		update_post_meta($post->ID, "promotion_type", "Builder");
		// Empty Tab2 value
		update_post_meta($post->ID, "promotion_title2", "");
		update_post_meta($post->ID, "promotion_expiry_date2", "");
		update_post_meta($post->ID, "promotion_custom_image", "");
		update_post_meta($post->ID, "promotion_expiry_enddate2", "0");
	} elseif (isset($_POST["tab_val2"]) && $_POST["tab_val2"] == "true") {
		$sanitizedrecurring_coupon = wp_filter_post_kses(
			strip_tags($_POST["promotion_recurring_coupon_metabox"])
		);
		$sanitizedshow_banner = wp_filter_post_kses(
            strip_tags($_POST["promotion_show_banner_coupon_metabox"])
        );
        $sanitizedlanding_page = wp_filter_post_kses(
            strip_tags($_POST["promotion_landing_page_coupon_metabox"])
        );
		$sanitizedexpiry_enddate2 = wp_filter_post_kses(
			strip_tags($_POST["promotion_expiry_enddate2_metabox"])
		);
		$sanitizednoexpiry = wp_filter_post_kses(
			strip_tags($_POST["promotion_noexpiry_metabox"])
		);
		$sanitizedtitle = wp_filter_post_kses(
			$_POST["promotion_title_metabox2"]
		);
		$sanitizedexpiry = wp_filter_post_kses(
			$_POST["promotion_expiry_date_metabox2"]
		);

		$sanitizedimage = wp_filter_post_kses($_POST["promotion_custom_image"]);
		// Save our submissions to the database
		update_post_meta($post->ID, "promotion_title2", $sanitizedtitle);
		if (empty($sanitizedrecurring_coupon)) {
			echo $sanitizedrecurring_coupon = 0;
		} else {
			echo $sanitizedrecurring_coupon = 1;
		}
		if (empty($sanitizedshow_banner)) {
			echo $sanitizedshow_banner = 0;
		} else {
			echo $sanitizedshow_banner = 1;
		}
        if (empty($sanitizedlanding_page)) {
            echo $sanitizedlanding_page = 0;
        } else {
            echo $sanitizedlanding_page = 1;
        }
		if (empty($sanitizeddefault_coupon)) {
			echo $sanitizeddefault_coupon = 0;
		} else {
			echo $sanitizeddefault_coupon = 1;
		}
		if (empty($open_new_tab)) {
			echo $open_new_tab = 0;
		} else {
			echo $open_new_tab = 1;
		}
		if (empty($sanitizedexpiry_enddate2)) {
			echo $sanitizedexpiry_enddate2 = 0;
		} else {
			echo $sanitizedexpiry_enddate2 = 1;
		}
		if (empty($sanitizednoexpiry)) {
			echo $sanitizednoexpiry = 0;
		} else {
			echo $sanitizednoexpiry = 1;
		}
		update_post_meta(
			$post->ID,
			"promotion_recurring_setting",
			$sanitizedrecurring_coupon
		);
		update_post_meta(
			$post->ID,
			"promotion_show_banner_setting",
			$sanitizedshow_banner
		);
        update_post_meta(
            $post->ID,
            "promotion_landing_page_setting",
            $sanitizedlanding_page
        );
		update_post_meta(
			$post->ID,
			"promotion_default_checkbox",
			$sanitizeddefault_coupon
		);
		update_post_meta($post->ID, "promotion_open_new_tab", $open_new_tab);
		update_post_meta(
			$post->ID,
			"promotion_expiry_enddate2",
			$sanitizedexpiry_enddate2
		);
		update_post_meta($post->ID, "promotion_noexpiry", $sanitizednoexpiry);
        update_post_meta($post->ID, "promotion_landing_page", $sanitizedlanding_page);
		update_post_meta($post->ID, "promotion_expiry_date2", $sanitizedexpiry);
		update_post_meta($post->ID, "promotion_custom_image", $sanitizedimage);
		update_post_meta($post->ID, "promotion_type", "Image");
		// Empty tab 1 value
		update_post_meta($post->ID, "promotion_title1", "");
		update_post_meta($post->ID, "promotion_color", "");
        update_post_meta($post->ID, "promotion_expiry_date1", "");
		// update_post_meta($post->ID, "promotion_landing_page", "");
		update_post_meta($post->ID, "promotion_subheading", "");
		update_post_meta($post->ID, "request_button_link", "");
		update_post_meta($post->ID, "request_button_title", "");
		update_post_meta($post->ID, "promotion_footer_heading", "");
		update_post_meta($post->ID, "promotion_expiry_enddate", "0");
	}
}

add_action("save_post", "bc_save_metabox", 1, 2);

// Change Title on insert and update of location title
add_filter("wp_insert_post_data", "bc_promotions_change_title");

function bc_promotions_change_title($data)
{
	if ($data["post_type"] != "bc_promotions") {
		return $data;
	}
	if (!empty($_POST["promotion_title_metabox1"])) {
		$data["post_title"] = $_POST["promotion_title_metabox1"];
	}
	if (!empty($_POST["promotion_title_metabox2"])) {
		$data["post_title"] = $_POST["promotion_title_metabox2"];
	}
	return $data;
}
