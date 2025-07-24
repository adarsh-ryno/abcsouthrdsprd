<?php
$widget_id = $args["globals"]["promotion"]["widget_id"];
$query = get_promotion_query(6);
$widget_id = $args["globals"]["promotion"]["widget_id"];
$category_name = is_array($args["category_taxonomy"]) ? $args["category_taxonomy"] : array($args["category_taxonomy"]);
$current_date = date("m/d/Y");
$paged = get_query_var("paged") ? get_query_var("paged") : -1;

if (empty($category_name) || in_array("all", $category_name)) {
    query_posts([
        "post_type" => "bc_promotions",
        "posts_per_page" => "6",
        "paged" => $paged,
        "order" => "DESC",
        "post_status" => "publish",
        "meta_query" => [
     "relation" => "AND", 
         [
             "key" => "promotion_landing_page_setting",
             "value" => "0",
         ],
         [
             "key" => "promotion_expiry_date1",
             "value" => $current_date,
             "compare" => ">=",
         ],
     ],
         "meta_value" => $current_date,
         "meta_compare" => ">=",
         
     ]);
 } else { 
     $abc = query_posts([
     "post_type" => "bc_promotions",
     "posts_per_page" => "6",
     "paged" => $paged,
     "order" => "DESC",
     "post_status" => "publish",
     "meta_query" => [
         "relation" => "AND", 
         [
             "key" => "promotion_landing_page_setting",
             "value" => "0", 
         ],
         [
             "key" => "promotion_expiry_date1",
             "value" => $current_date,
             "compare" => ">=",
         ],
     ],
     "tax_query" => [
         [
             "taxonomy" => "bc_promotion_category",
             "field" => "name",
             "terms" => $category_name,
             "operator" => "IN",
         ],
     ],
 ]);
 
    
}
$title_tag = isset($args["globals"]["promotion"]["title_tag"])
	? $args["globals"]["promotion"]["title_tag"]
	: "h5";
$heading_tag = isset($args["globals"]["promotion"]["heading_tag"])
	? $args["globals"]["promotion"]["heading_tag"]
	: "h4";
?>
        <div class="d-block pb-lg-5 mb-lg-0 ">
            <?php
            global $template;
            if (
            	!empty($template) &&
            	basename($template) == "rds-landing.php"
            ) { ?>
                <div class="container-fluid px-0">
                <?php } else { ?>
                    <div class="container-fluid pb-lg-0 pb-4">
                    <?php }
            ?>
                    <div class="container px-0 px-lg-3">
                        <div class="row">
                            <div class="homepage_coupon pt-lg-5 mt-4 pb-lg-4 col-lg-12">   
                                <<?php echo $title_tag ?> class="mb-0 pb-2 text-center "><?php echo $args[
 	"globals"
 ]["promotion"]["title"]; ?></<?php echo $title_tag ?>>
                                <<?php echo $heading_tag ?> class="text-center d-block pb-lg-3 pb-4"><?php echo $args[
 	"globals"
 ]["promotion"]["heading"]; ?></<?php echo $heading_tag ?>>
                                <div class="swiper home-coupon-swiper-c home-coupon-swiper-c-<?php echo $widget_id ?> d-lg-block d-none">
                                    <div class="swiper-wrapper ">
                                        <?php if (have_posts()):
                                        	while (have_posts()):
                                        		the_post();
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
                                        		$date = get_post_meta(
                                        			get_the_ID(),
                                        			"promotion_expiry_date1",
                                        			true
                                        		);
                                        		$open_new_tab = get_post_meta(
                                        			get_the_ID(),
                                        			"promotion_open_new_tab",
                                        			true
                                        		);
                                        		if (
                                        			strtotime($date) >=
                                        				strtotime(
                                        					current_time(
                                        						"m/d/Y"
                                        					)
                                        				) ||
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
                                        			$heading = get_post_meta(
                                        				get_the_ID(),
                                        				"promotion_heading",
                                        				true
                                        			);
                                        			$footer_heading = get_post_meta(
                                        				get_the_ID(),
                                        				"promotion_footer_heading",
                                        				true
                                        			);
                                        			$more_info = get_post_meta(
                                        				get_the_ID(),
                                        				"promotion_more_info",
                                        				true
                                        			);
                                        			$requestButtonLink = get_post_meta(
                                        				$post->ID,
                                        				"request_button_link",
                                        				true
                                        			);
                                        			$requestButtonTitle = get_post_meta(
                                        				$post->ID,
                                        				"request_button_title",
                                        				true
                                        			);
                                        			?>           
                                                <div class="swiper-slide  border-quaternary-dashed p-2">
                                                    <div class="coupon_name promotion_c h-100 text-center">
                                                        <div class="color_primary_bg mb-2 w-100" style="background-color: <?php echo $color; ?>;">
                                                            <h4 class="mb-0 pt-lg-3 pt-3 coupon_title coupon_offer"><?php echo $title; ?></h4>
                                                            <span class="pt-lg-3 pt-2 d-block coupon_expiry"><?php if (
                                                            	$noexpiry != 1
                                                            ) {
                                                            	echo "expires " .
                                                            		$date;
                                                            } ?></span>

                                                                <div class="promotionC_coupon bg-transparent border-0" style="display: none;">
                                                                <div class="card card-body bg-transparent border-0">

                                                                    <span class="d-block  text-center py-2 px-lg-0 px-2 pt-2 my-lg-1 coupon_heading"><?php echo $heading; ?></span>
                                                                    <span class="d-block text-center  py-2 px-lg-0 px-2 coupon_sub_heading "><?php echo $subheading; ?></span>
                                                                    <span class="d-block  text-center px-lg-0 px-3 pt-lg-0 pt-2 coupon_disclaimer color_white"><?php echo $more_info; ?></span>
                                                                </div>
                                                            </div>
                                                            <a class="w-166 text-uppercase font_alt_1 text_18 line_height_23 mh-33 text_semibold text_semibold_hover d-inline-flex align-items-center justify-content-center no_hover_underline mb-4 promotionC_icon color_white more-info-button cursor-pointer">More info <i class="icon-plus1 ms-4"></i></a>
                                                        </div>
                                                        <a data-bs-toggle="<?php echo empty(
                                                        	$requestButtonLink
                                                        )
                                                        	? "modal"
                                                        	: ""; ?>" 
                                                            data-bs-target="<?php echo empty(
                                                            	$requestButtonLink
                                                            )
                                                            	? "#slider_request_coupon_form"
                                                            	: ""; ?>" 
                                                            <?php echo empty(
                                                            	$requestButtonLink
                                                            )
                                                            	? 'onclick="couponButtonClick(this);"'
                                                            	: 'href="' .
                                                            		$requestButtonLink .
                                                            		'"'; ?>
                                                            <?php echo empty(
                                                            	$requestButtonTitle
                                                            )
                                                            	? 'aria-label="Request Service"'
                                                            	: 'aria-label="' .
                                                            		$requestButtonTitle .
                                                            		'"'; ?>
                                                            class="btn btn-secondary w-100 btn-border request_service_button"
                                                            <?php echo $open_new_tab ==
                                                            1
                                                            	? 'target="_blank"'
                                                            	: ""; ?>>
                                                            <?php echo empty(
                                                            	$requestButtonTitle
                                                            )
                                                            	? "Request Service"
                                                            	: $requestButtonTitle; ?> 
                                                        </a>

                                                    </div>
                                                </div>   
                                                <?php
                                        		}
                                        	endwhile;
                                        endif; ?>
                                    </div>
                                </div>
                                <div class="swiper m-home-coupon-swiper-c-<?php echo $widget_id ?> d-lg-none d-block">
                                    <div class="swiper-wrapper justify-content-lg-center ps-lg-3">
                                        <?php if (have_posts()):
                                        	while (have_posts()):
                                        		the_post();
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
                                        		$date = get_post_meta(
                                        			get_the_ID(),
                                        			"promotion_expiry_date1",
                                        			true
                                        		);
                                        		$open_new_tab = get_post_meta(
                                        			get_the_ID(),
                                        			"promotion_open_new_tab",
                                        			true
                                        		);
                                        		if (
                                        			strtotime($date) >=
                                        				strtotime(
                                        					current_time(
                                        						"m/d/Y"
                                        					)
                                        				) ||
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
                                        			$heading = get_post_meta(
                                        				get_the_ID(),
                                        				"promotion_heading",
                                        				true
                                        			);
                                        			$footer_heading = get_post_meta(
                                        				get_the_ID(),
                                        				"promotion_footer_heading",
                                        				true
                                        			);
                                        			$more_info = get_post_meta(
                                        				get_the_ID(),
                                        				"promotion_more_info",
                                        				true
                                        			);
                                        			$requestButtonLink = get_post_meta(
                                        				$post->ID,
                                        				"request_button_link",
                                        				true
                                        			);
                                        			$requestButtonTitle = get_post_meta(
                                        				$post->ID,
                                        				"request_button_title",
                                        				true
                                        			);
                                        			?>           
                                                <div class="swiper-slide  border-quaternary-dashed p-2" >
                                                    <div class=" coupon_name  h-coupan-100 text-center">
                                                        <div class="color_primary_bg mb-2 w-100  h-coupan-100" style="background-color: <?php echo $color; ?>;">
                                                            <h4 class="mb-0 pt-lg-3 pt-3 coupon_title coupon_offer"><?php echo $title; ?></h4>
                                                            <span class="pt-lg-3 pt-2 d-block coupon_expiry"><?php if (
                                                            	$noexpiry != 1
                                                            ) {
                                                            	echo "expires " .
                                                            		$date;
                                                            } ?></span>
                                                            <div class="promotionC_coupon bg-transparent border-0" style="display: none;">
                                                                <div class="card card-body bg-transparent border-0">

                                                                    <span class="d-block  text-center py-2 px-lg-0 px-2 pt-2 my-lg-1 coupon_heading"><?php echo $heading; ?></span>
                                                                    <span class="d-block text-center  py-2 px-lg-0 px-2 coupon_sub_heading "><?php echo $subheading; ?></span>
                                                                    <span class="d-block  text-center px-lg-0 px-3 pt-lg-0 pt-2 coupon_disclaimer color_white"><?php echo $more_info; ?></span>
                                                                </div>
                                                            </div>
                                                            <a class="w-166 text-uppercase font_alt_1 text_18 line_height_23 mh-33 text_semibold d-inline-flex align-items-center justify-content-center no_hover_underline mb-4  promotionC_icon more-info-button cursor-pointer">More info <i class="icon-plus1 ms-4"></i></a>
                                                        </div>
                                                        <a data-bs-toggle="<?php echo empty(
                                                        	$requestButtonLink
                                                        )
                                                        	? "modal"
                                                        	: ""; ?>" 
                                                            data-bs-target="<?php echo empty(
                                                            	$requestButtonLink
                                                            )
                                                            	? "#slider_request_coupon_form"
                                                            	: ""; ?>" 
                                                            <?php echo empty(
                                                            	$requestButtonLink
                                                            )
                                                            	? 'onclick="couponButtonClick(this);"'
                                                            	: 'href="' .
                                                            		$requestButtonLink .
                                                            		'"'; ?>
                                                            <?php echo empty(
                                                            	$requestButtonTitle
                                                            )
                                                            	? 'aria-label="Request Service"'
                                                            	: 'aria-label="' .
                                                            		$requestButtonTitle .
                                                            		'"'; ?>
                                                            class="btn btn-secondary w-100 btn-border request_service_button"
                                                            <?php echo $open_new_tab ==
                                                            1
                                                            	? 'target="_blank"'
                                                            	: ""; ?>>
                                                            <?php echo empty(
                                                            	$requestButtonTitle
                                                            )
                                                            	? "Request Service"
                                                            	: $requestButtonTitle; ?> 
                                                        </a>
                                                    </div>
                                                </div>   
                                                <?php
                                        		}
                                        	endwhile;
                                        endif; ?>
                                    </div>
                                </div>
                                <?php
                                global $template;
                                if (
                                	!empty($template) &&
                                	basename($template) == "rds-landing.php"
                                ) { ?>
                                    <div class="swiper-button-next home_coupon_next_c-<?php echo $widget_id ?>">
                                        <i class="icon-chevron-right text_25 true_black line_height_42   transform"></i>
                                    </div>
                                    <div class="swiper-button-prev home_coupon_prev_c-<?php echo $widget_id ?>">
                                        <i class="icon-chevron-left text_25 true_black line_height_42   transform"></i>
                                    </div>
                                <?php } else { ?>
                                    <div data-dark-color="color_primary" class="apply-conditional-color swiper-pagination home-coupon-pagination-c-<?php echo $widget_id ?> pagination-variation-a position-relative pb-3 d-lg-block d-none"></div>
                                    <div data-dark-color="color_primary" class="apply-conditional-color swiper-pagination m-home-coupon-pagination-c-<?php echo $widget_id ?> pagination-variation-a position-relative pb-3 d-lg-none d-block"></div>
                                    <div class="text-center pt-lg-3">
                                        <a href="<?php echo get_home_url() .
                                        	$args["globals"]["promotion"][
                                        		"button_link"
                                        	]; ?>" class="btn btn-primary mw-210"><?php echo $args[
	"globals"
]["promotion"]["button_text"]; ?></a>
                                    </div>
                                <?php }
                                ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div> 
            <?php wp_reset_query(); ?>
    <div class="modal fade request_form px-lg-0 px-0 pt-5 pt-md-0 99" id="slider_request_coupon_form" tabindex="-1" role="dialog" data-bs-backdrop="false" data-bs-keyboard="false" aria-labelledby="requestcoupon_Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered px-lg-0 px-2 " role="document">
    <div class="modal-content border-0 rounded-0 text-center">
        <div class="modal-header border-0 p-0">
            <button type="button" class="close coupon-popup-close position-absolute bg-transparent border-0 pb-0 px-0" data-bs-dismiss="modal" aria-label="Close" style="opacity:1; z-index: 999; color:#fff ;">
                <i class="icon-xmark1 text_30 line_height_26"></i>
            </button>
        </div>
        <div class="modal-body p-lg-4 p-2 w-100 my-auto mx-auto coupons">
            <div class="border-dashed-7 pt-lg-4 pb-lg-4 py-4 footer_form_A ui_kit_footer_form elementor-popupform">
                <h3 class="px-lg-0 px-4"><?php echo $args["globals"][
                	"promotion"
                ]["popup_form_heading"]; ?></h3>
                <div class="my-md-0 mt-lg-4 mt-3 w-lg-260 mx-auto text-start text-lg-center d-flex align-items-center justify-content-center pb-4 px-lg-0 px-4">
                    <i class="icon-shield-check1 text_30 line_height_30 me-2 position-relative color_primary"></i>
                    <span class="font_alt_1 text_bold text_16 line_height_25 sm_text_16  sm_line_height_30 color_primary"><?php echo $args[
                    	"globals"
                    ]["promotion"]["popup_form_subheading"]; ?></span>
                </div>
                <div class="px-lg-5 mx-lg-4 px-4">
                    <?php
                    $form_id =
                    	$args["globals"]["promotion"]["popup_gravity_form_id"];
                    echo do_shortcode(
                    	"[gravityforms id=" . $form_id . " ajax=true]"
                    );
                    ?>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('.promotionC_icon').on('click', function () {
            jQuery(this).prev().slideToggle();

            if (jQuery(this).text().includes("Less info")) {
                jQuery(this).html('More info <i class="icon-plus1 ms-4"></i>');
            } else {
                jQuery(this).html('Less info <i class="icon-minus1 ms-4"></i>');
            }
        });
    });

    jQuery(document).ready(function () {

    jQuery(".coupon-popup-close").click(function () {

    jQuery(this).closest("#slider_request_coupon_form").find("form .gfield_label").each(function (k, d) {
    jQuery(d).attr("style", "");
    jQuery(d).parent('li').children('label').show();
    jQuery(d).parent('li').find('.validation_message').hide();
    jQuery(d).parent('li').removeClass('gfield_error');
    jQuery(d).parent('li').removeClass('gfield_error');
    jQuery(d).parent('li').find('input').val('');
    jQuery(d).parent('li').find('select').val('');
    jQuery(d).parent('li').children('label').removeClass('float_label');
    jQuery(d).parent("li").find(".gfield-choice-input").prop("checked", true);
    });
    });
    jQuery(".rds_gform_submit").click(function () {
    console.log(jQuery(this).closest("form").find(".coupon-name input").val());
    var promotiontitleValue = jQuery(this).closest("form").find(".coupon-name input").val();
    if (promotiontitleValue != "") {
    setTimeout(function () {
        jQuery('.bc-promotion-title').text(promotiontitleValue);
    }, 500);
    }
    });
    setInterval(function () {
    var promotiontitleValue = jQuery('#input_9_10').val();
    jQuery('.bc-promotion-title').text(promotiontitleValue);
    }, 500);
    });
    function couponButtonClick(attr) {
    var CouponTitle = jQuery(attr).parent('.coupon_name').find('.coupon_title').text();
    var CouponsubTitle = jQuery(attr).parent('.coupon_name').find('.coupon_heading').text();
    var Couponsubheading = jQuery(attr).parent('.coupon_name').find('.coupon_sub_heading ').text();
    console.log(CouponTitle + " " + CouponsubTitle + " " + Couponsubheading)
    jQuery(".coupon-name").find('input:text').val(CouponTitle + " " + CouponsubTitle + " " + Couponsubheading);
    jQuery(".bc-promotion-title").text(CouponTitle + " " + CouponsubTitle + " " + Couponsubheading);
    }

    </script>