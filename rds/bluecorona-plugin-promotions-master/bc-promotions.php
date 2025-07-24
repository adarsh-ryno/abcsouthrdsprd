<?php
/**
 * Plugin Name:       BC Promotions - Coupon Builder
 * Plugin URI:        https://github.com/nikhil-twinspark/bc-promotions
 * Description:       A simple plugin for creating coupons for promotion.
 * Version:           2.0.0
 * Author:            Blue Corona
 * Author URI:        #
 * License:           AGPL-3.0
 * License URI:       https://www.gnu.org/licenses/agpl-3.0.html
 * Text Domain:       bc-promotions
 * Domain Path:       /languages
 */

if (!defined("WPINC")) {
	die();
}

define("BC_VERSION", "1.0.0");
define("BCDOMAIN", "polaris-rds");
define("BCPATH", plugin_dir_path(__FILE__));

require_once BCPATH . "post-types/register-type.php";
add_action("init", "bc_register_promotion_type");

require_once BCPATH . "/taxonomies/register.php";
add_action("init", "bc_promotion_register_promotion_taxonomy");

require_once BCPATH . "/custom-fields/register-fields.php";
require_once BCPATH . "/custom-fields/promotion-setting-fields.php";
require_once BCPATH . "/bc-promotions-widget.php";

function bc_rewrite_flush()
{
	flush_rewrite_rules();
}
register_activation_hook(__FILE__, "bc_rewrite_flush");

// plugin uninstallation
register_uninstall_hook(BCPATH, "bc_custom_uninstall");
function bc_custom_uninstall()
{
	// delete_posts();
}

function get_promotion_query($attr)
{
	$promotions_args = [
		"post_type" => "bc_promotions",
		"posts_per_page" => -1,
		"order" => "DESC",
		"post_status" => "publish",
	];
	$query = new WP_Query($promotions_args);
	$defalut_value = get_post_meta(
		get_the_ID(),
		"promotion_default_value",
		true
	);
	$promotioncat_value = get_post_meta(
		get_the_ID(),
		"promotion_default_category",
		true
	);
	$promotion_cat = explode(",", $promotioncat_value);
	$promotion_spa = get_post_meta(
		get_the_ID(),
		"promotion_default_special",
		true
	);
	$promotion_spa = explode(",", $promotion_spa);
	$promotion_default_checkbox_value = get_post_meta(
		get_the_ID(),
		"promotion_default_checkbox_value",
		true
	);
	$promotion_show_value = get_post_meta(
		get_the_ID(),
		"promotion_show_value",
		true
	);

	if ($promotion_show_value == 0) {
		$promotions_args = [
			"post_type" => "bc_promotions",
			"posts_per_page" => $attr,
			"order" => "DESC",
			"post_status" => "publish",
			"paged" => get_query_var("paged") ? get_query_var("paged") : 1,
		];

		return $query = new WP_Query($promotions_args);
	} else {
		// Default Coupan
		if ($defalut_value == 1) {
			$promotions_args = [
				"post_type" => "bc_promotions",
				"posts_per_page" => $attr,
				"order" => "DESC",
				"post_status" => "publish",
				"paged" => get_query_var("paged") ? get_query_var("paged") : 1,
				"meta_query" => [
					[
						"key" => "promotion_default_checkbox",
						"value" => 1,
						"compare" => "=",
					],
				],
			];
			return $query = new WP_Query($promotions_args);
		} else {
			// Categorywise select Coupan
			if ($promotion_default_checkbox_value == 2) {
				$promotions_args = [
					"post_type" => "bc_promotions",
					"post_status" => "publish",
					"posts_per_page" => $attr,
					"tax_query" => [
						[
							"taxonomy" => "bc_promotion_category",
							"field" => "term_id",
							"terms" => $promotion_cat,
						],
					],
				];
				return $query = new WP_Query($promotions_args);

				// Special Coupan
			} elseif ($promotion_default_checkbox_value == 3) {
				$promotions_args = [
					"post_type" => "bc_promotions",
					"posts_per_page" => $attr,
					"order" => "DESC",
					"post_status" => "publish",
					"post__in" => $promotion_spa,
					"paged" => get_query_var("paged")
						? get_query_var("paged")
						: 1,
				];

				return $query = new WP_Query($promotions_args);

				//coupan not show on this page
			} else {
				$promotions_args = [
					"post_type" => "bc_promotions",
					"posts_per_page" => $attr,
					"order" => "DESC",
					"post_status" => "publish",
					"paged" => get_query_var("paged")
						? get_query_var("paged")
						: 1,
				];

				return $query = new WP_Query($promotions_args);
			}
		}
	}
}
// Add Conditionally css & js for specific pages
add_action("admin_enqueue_scripts", "bc_include_css_js");
function bc_include_css_js($hook)
{
	wp_enqueue_media();
	$current_screen = get_current_screen();
	if ($current_screen->post_type == "bc_promotions") {
		// Include CSS Libs
		wp_register_style(
			"bc-plugin-css",
			plugins_url("assests/css/bootstrap.min.css", __FILE__),
			[],
			"1.0.0",
			"all"
		);
		wp_enqueue_style("bc-plugin-css");
		wp_enqueue_style(
			"bc-colorpicker-css",
			plugins_url("assests/css/bootstrap-colorpicker.min.css", __FILE__),
			[],
			"1.0.0",
			"all"
		);
		wp_enqueue_style(
			"bc-datepicker",
			plugins_url("assests/css/datepicker3.css", __FILE__),
			[],
			"1.0.0",
			"all"
		);
		// wp_enqueue_style('bc-fontawesome',plugins_url('assests/css/font-awesome.min.css', __FILE__), array(), '1.0.0', 'all');
		wp_enqueue_style(
			"bc-style",
			plugins_url("assests/css/bc-style.css", __FILE__),
			[],
			"1.0.0",
			"all"
		);

		// Inculde JS Libs
		wp_enqueue_script(
			"jquery",
			"https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js",
			true
		);
		wp_enqueue_script(
			"bootstap",
			"https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js",
			true
		);

		wp_enqueue_script(
			"bc-datepicker-js",
			plugin_dir_url(__FILE__) . "assests/js/bootstrap-datepicker.js",
			true
		);

		wp_enqueue_script(
			"bc-colorpicker-js",
			plugin_dir_url(__FILE__) .
				"assests/js/bootstrap-colorpicker.min.js",
			true
		);

		wp_enqueue_script(
			"bc-custom-js",
			plugin_dir_url(__FILE__) . "assests/js/bc-custom.js",
			true
		);
		wp_enqueue_script(
			"bc-image-upload-js",
			plugin_dir_url(__FILE__) . "assests/js/bc-image-upload.js",
			["jquery"]
		);
	}
}

add_shortcode("bc-promotion", "bc_promotion_shortcode");
function bc_promotion_shortcode($atts, $content = null)
{
	static $count = 0;
	$count++;
	add_action("wp_footer", function () use ($count) {
		?>
<script>
    jQuery(document).ready(function(){
var couponSwiper = new Swiper('#bc_coupons_swiper_<?php echo $count; ?>', {
navigation: {
    nextEl: '.coupon-btn-next',
    prevEl: '.coupon-btn-prev',
},
 slidesPerView: 2,
    loop: true,
    speed: 400,
    // autoplay: true,
    paginationClickable: true,
    spaceBetween: 20,
    pagination: {
        el: '.coupon-pagination_new',
        type: 'bullets',
        clickable: true,
    },
    breakpoints: {
    640: {
      slidesPerView: 1,
      spaceBetween: 20,
    },
    1024: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
  }     
});

var get_promotion_title;
jQuery(document).ready(function() {
  jQuery(".coupon_btn").on('click', function(e) {
    e.preventDefault();
    get_promotion_title = jQuery(this).attr('data-value');
    console.log(get_promotion_title);
    jQuery('#input_15_9').val(get_promotion_title);
  });
});
});
</script>
<?php
	});
	$Ids = null;
	$args = [
		"post_type" => "bc_promotions",
		"posts_per_page" => -1,
		"order" => "DESC",
		"post_status" => "publish",
	];

	if (isset($atts["coupon_id"])) {
		$Ids = explode(",", $atts["coupon_id"]);
		$postIds = $Ids;
		$args["post__in"] = $postIds;
	}
	ob_start();
	$query = new WP_Query($args);
	if ($query->have_posts()): ?>
    
    <div class="container-fluid m-0">
      <div class="container px-0">
        <div class="row no-gutters coupon_A_swiper">
            <div class="coupon-btn-prev col-md-1 text-center d-none d-md-block align-self-center" tabindex="0" aria-label="Previous slide" role="button">
                <i class="far fa-chevron-left d-block mx-auto"></i>
            </div>
            <div class="col-md-10 col-12">
              <div id="bc_coupons_swiper_<?php echo $count; ?>" class="swiper-container coupon_swiper py-lg-4">
                <div class="swiper-wrapper pb-5 pb-lg-0">
                <?php
                while ($query->have_posts()):
                	$query->the_post();
                	$promotion_type = get_post_meta(
                		get_the_ID(),
                		"promotion_type",
                		true
                	);
                	$noexpiry = get_post_meta(
                		get_the_ID(),
                		"promotion_noexpiry",
                		true
                	);
                	if ($promotion_type == "Builder") {
                		$date = get_post_meta(
                			get_the_ID(),
                			"promotion_expiry_date1",
                			true
                		);
                		if (
                			strtotime($date) >=
                				strtotime(current_time("m/d/Y")) ||
                			$noexpiry == 1
                		) {

                			$title = get_post_meta(
                				get_the_ID(),
                				"promotion_title1",
                				true
                			);
                			$color = get_post_meta(
                				get_the_ID(),
                				"promotion_color",
                				true
                			);
                			$subheading = get_post_meta(
                				get_the_ID(),
                				"promotion_subheading",
                				true
                			);
                			$footer_heading = get_post_meta(
                				get_the_ID(),
                				"promotion_footer_heading",
                				true
                			);
                			?>
                  <div class="swiper-slide text-center">
                    <div id="coupon-id-<?php echo get_the_ID(); ?>" class="coupon_slide p-3 " style="background-color:<?php echo $color; ?> !important">
                      <div class="border_dashed text-center py-4 px-3">
                        <span class="mb-3 d-block heading_1"><?php echo $title; ?></span>
                        <span class="prise heading_2 d-block"><?php echo $subheading; ?></span>
                         <span class="prise heading_2 d-block"><?php echo $footer_heading; ?></span>
                        <button class="coupon_btn btn-primary" data-value="<?php echo $title; ?>" data-toggle="modal" data-target="#request_form">request service <i class="far fa-arrow-right"></i></button>
                        <?php if ($noexpiry != 1) { ?>
                            <div class="mt-3">expires <?php echo $date; ?></div>
                        <?php } ?>
                        
                      </div>
                    </div>
                  </div>
                    <?php
                		}
                	} elseif ($promotion_type == "Image") {
                		$date2 = get_post_meta(
                			get_the_ID(),
                			"promotion_expiry_date2",
                			true
                		);
                		if (
                			strtotime($date2) >=
                				strtotime(current_time("m/d/Y")) ||
                			$noexpiry == 1
                		) {

                			$title2 = get_post_meta(
                				get_the_ID(),
                				"promotion_title2",
                				true
                			);
                			$promotion_custom_image = get_post_meta(
                				get_the_ID(),
                				"promotion_custom_image",
                				true
                			);

                			// $subheading = get_post_meta( get_the_ID(), 'promotion_subheading', true );
                			?>
                    <div class="swiper-slide  text-center" >
                        <a href="#" data-toggle="modal" data-target="#request_form">
                            <img  data-value="<?php echo $title2; ?>" class="coupon_btn img-fluid" src="<?php echo $promotion_custom_image; ?>">
                        </a>
                    </div>
                <?php
                		}
                	}
                endwhile;
                wp_reset_query();
                endif;
	?>

                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination slid_bullets coupon-pagination_new d-md-none"></div>
              </div>
              <div class="modal fade overflow-hidden request_form_A ui_kit_footer_form" id="request_form" tabindex="-1" role="dialog" aria-labelledby="disclaimerLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content border-0 bg-transparent p-lg-4">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 0px; top: 24px; opacity: 1;">
                        <i class="far fa-times text-white close_icon"></i>
                      </button>
                    <div class="modal-body bg-white p-lg-3 p-2 w-100 my-auto mx-auto">
                      <div class="border_dashed px-lg-5 px-2 py-md-3 py-1">
                        <span class="heading d-block text-center"><?php echo $atts[
                        	"gravity_form_title"
                        ]; ?></span>
                        <?php echo do_shortcode(
                        	"[gravityform id=" .
                        		$atts["gravity_form_id"] .
                        		" ajax=true]"
                        ); ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="coupon-btn-next col-md-1 text-center d-none d-md-block align-self-center" tabindex="0" aria-label="Next slide" role="button">
                <i class="far fa-chevron-right d-block mx-auto"></i>
            </div>
        </div>
      </div>    
    </div>  
    <?php
    $output = ob_get_clean();
    return $output;
}

// Admin notice for displaying shortcode on index page
add_action("admin_notices", "bc_promotion_general_admin_notice");
function bc_promotion_general_admin_notice()
{
	global $pagenow;
	global $post;
	if (
		$pagenow == "edit.php" &&
		(isset($post->post_type) ? $post->post_type : null) == "bc_promotions"
	) {
		echo '<div class="notice notice-success is-dismissible">
            <p><b>Shortcode Example</b> widgets : [bc-promotions  type="promotion-widget"   posts-per-page=3], grid : [bc-promotions  type="promotion-grid"   posts-per-page=3], slider : [bc-promotions  type="promotion-slider"   posts-per-page=3]</p>
         </div>';
	}
}

/** ADMIN COLUMN - HEADERS*/
add_filter("manage_edit-bc_promotions_columns", "add_new_promotions_columns");
function add_new_promotions_columns($concerts_columns)
{
	/*$new_columns['cb'] = '<input type="checkbox" />';
    $new_columns['title'] = _x('Title', 'column name');
    $new_columns['promotion_expiry_date1'] = __('Expiration');
    $new_columns['updated'] = __('Updated');
    $new_columns['type'] = __('Type');
    $new_columns['status'] = __('Status');
    return $new_columns;*/

	return [
		"cb" => $concerts_columns["cb"],
		"title" => $concerts_columns["title"],
		"type" => "Type",
		"taxonomy-bc_promotion_category" => "Categories",
		"promotion_expiry_date1" => __("Expiration", "polaris-rds"),
		"updated" => __("Updated", "polaris-rds"),
	];
}

/** ADMIN COLUMN - CONTENT*/
add_action(
	"manage_bc_promotions_posts_custom_column",
	"manage_promotions_columns",
	10,
	2
);
function manage_promotions_columns($column_name, $id)
{
	global $post;
	switch ($column_name) {
		case "title":
			echo $get_title = get_post_meta($post->ID, "custom_title", true);
			break;
		case "type":
			echo get_post_meta($post->ID, "promotion_type", true);
			break;
		case "category":
			$list_tax = get_the_terms($post->ID, "bc_promotion_category", true);
			if (isset($list_tax) && !empty($list_tax)) {
				foreach ($list_tax as $key => $value) {
					echo $value->name . ",";
				}
			}
			break;
		case "promotion_expiry_date1":
			$expiry_date = get_post_meta(
				$post->ID,
				"promotion_expiry_date1",
				true
			);
			$expiry_date2 = get_post_meta(
				$post->ID,
				"promotion_expiry_date2",
				true
			);
			$npexpirydate = get_post_meta(
				$post->ID,
				"promotion_noexpiry",
				true
			);
			$curdate = date("m/d/Y");
			$expiry_date_timestamp = strtotime($expiry_date);
			$expiry_date2_timestamp = strtotime($expiry_date2);
			$curdate_timestamp = strtotime($curdate);
			if ($npexpirydate == 1) {
				echo "—";
			} else {
				if (isset($expiry_date) && !empty($expiry_date)) {
					if ($curdate_timestamp > $expiry_date_timestamp) {
						echo '<span class="expired">' .
							$expiry_date .
							"</span>";
					} else {
						echo $expiry_date;
					}
				} elseif (isset($expiry_date2) && !empty($expiry_date2)) {
					if ($curdate_timestamp > $expiry_date2_timestamp) {
						echo '<span class="expired">' .
							$expiry_date2 .
							"</span>";
					} else {
						echo $expiry_date2;
					}
				}
			}
			break;
		case "updated":
			echo get_the_date("m/d/Y");
			break;
		case "status":
			$status = $post->post_status;
			$expiry_date = get_post_meta(
				$post->ID,
				"promotion_expiry_date1",
				true
			);
			$expiry_date2 = get_post_meta(
				$post->ID,
				"promotion_expiry_date2",
				true
			);
			$curdate = date("m/d/Y");
			$expiry_date_timestamp = strtotime($expiry_date);
			$expiry_date2_timestamp = strtotime($expiry_date2);
			$curdate_timestamp = strtotime($curdate);
			if (isset($expiry_date) && !empty($expiry_date)) {
				if ($curdate_timestamp > $expiry_date_timestamp) {
					echo '<span class="expired">Expired</span>';
				} else {
					echo ucfirst($status);
				}
			} elseif (isset($expiry_date2) && !empty($expiry_date2)) {
				if ($curdate_timestamp > $expiry_date2_timestamp) {
					echo '<span class="expired">Expired</span>';
				} else {
					echo ucfirst($status);
				}
			}
			break;
		default:
			break;
	} // end switch
}

// /*
//  * ADMIN COLUMN - SORTING - MAKE HEADERS SORTABLE
//  * https://gist.github.com/906872
//  */
// add_filter("manage_edit-bc_promotions_sortable_columns", 'promotions_sort');
// function promotions_sort($columns) {
//     $custom = array(
//         'state' => 'state',
//         'city'  => 'city',
//         'category'  => 'category',
//         'date_custom'   => 'date_custom',
//         'status'    => 'status',
//     );
//     return wp_parse_args($custom, $columns);
// }

add_action("init", "update_expiry_date1");

function update_expiry_date1()
{
	$args = [
		"post_type" => "bc_promotions",
		"posts_per_page" => -1,
		"order" => "DESC",
		"post_status" => "publish",
	];
	ob_start();
	$query = new WP_Query($args);

	if ($query->have_posts()):
		while ($query->have_posts()):
			$query->the_post();
			$promotion_type = get_post_meta(
				get_the_ID(),
				"promotion_type",
				true
			);
			$ids = get_the_ID();
			$recuring = get_post_meta(
				get_the_ID(),
				"promotion_recurring_setting",
				true
			);
			$noexpiry = get_post_meta(get_the_ID(), "promotion_noexpiry", true);
			if ($promotion_type == "Builder") {
				$expiration_date = get_post_meta(
					get_the_ID(),
					"promotion_expiry_date1",
					true
				);
				$enddate = get_post_meta(
					get_the_ID(),
					"promotion_expiry_enddate",
					true
				);
				if ($recuring == 1) {
					$date1 = date_create(date("m/d/Y"));
					$date2 = date_create($expiration_date);
					$diff = date_diff($date1, $date2);
					$current_diff = $diff->format("%R%a");
					if ($current_diff <= 0) {
						$time = date("m/d/Y");
						$final = date(
							"m/d/Y",
							strtotime("+30 days", strtotime($time))
						);
						update_post_meta(
							$ids,
							"promotion_expiry_date1",
							$final
						);
					} elseif ($current_diff < 0 && $enddate == 1) {
						$lastdate = date("m/t/y", strtotime(date("m/d/Y")));
						update_post_meta(
							$ids,
							"promotion_expiry_date1",
							$lastdate
						);
					}
				}
			} elseif ($promotion_type == "Image") {
				$expiration_date2 = get_post_meta(
					get_the_ID(),
					"promotion_expiry_date2",
					true
				);
				$noexpiry = get_post_meta(
					get_the_ID(),
					"promotion_noexpiry",
					true
				);
				$enddate2 = get_post_meta(
					get_the_ID(),
					"promotion_expiry_enddate2",
					true
				);
				if ($recuring == 1) {
					$date12 = date_create(date("m/d/Y"));

					$date22 = date_create($expiration_date2);

					$diff2 = date_diff($date12, $date22);
					$current_diff2 = $diff2->format("%R%a");
					if ($current_diff2 <= 0) {
						$time2 = date("m/d/Y");
						$final2 = date(
							"m/d/Y",
							strtotime("+30 days", strtotime($time2))
						);
						update_post_meta(
							$ids,
							"promotion_expiry_date2",
							$final2
						);
					} elseif ($current_diff2 < 0 && $enddate2 == 1) {
						$lastdate2 = date("m/t/y", strtotime(date("m/d/Y")));
						update_post_meta(
							$ids,
							"promotion_expiry_date2",
							$lastdate2
						);
					}
				}
			}
		endwhile;
		wp_reset_query();
	endif;
}
