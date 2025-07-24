<?php if (function_exists("get_promotion_query")) {
	$category_name = $args["category_taxonomy"];
	$current_date = date("m/d/Y");
	if (empty($category_name) || in_array("all", $category_name)) {
        query_posts([
            "post_type" => "bc_promotions",
            "posts_per_page" => "3",
            // "paged" => $paged,
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
         "posts_per_page" => "3",
        //  "paged" => $paged,
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

	if (have_posts()) { ?>
    <div class="sidebar_coupon pt-lg-5 pt-4 pb-lg-4 px-lg-0 px-2 mx-lg-0 mx-1 order-lg-3 order-3">
    <span class="font_default text_semibold text_28 line_height_33 text-center d-block pb-lg-3 sm_text_26 pb-4 sm_line_height_31">
        <?php echo !empty($args["page_templates"]["subpage"]["sidebar"]["promotion"]["heading"]) ? $args["page_templates"]["subpage"]["sidebar"]["promotion"]["heading"] : ''; ?>
    </span>
    <div class="swiper coupon-swiper">
        <div class="swiper-wrapper">
            <?php while (have_posts()): the_post();
                $promotion_type = get_post_meta(get_the_ID(), "promotion_type", true);
                $noexpiry = get_post_meta(get_the_ID(), "promotion_noexpiry", true);
                $colorCode = get_post_meta(get_the_ID(), "promotion_color", true);
                $date = get_post_meta(get_the_ID(), "promotion_expiry_date1", true);

                if (strtotime($date) >= strtotime(current_time("m/d/Y")) || $noexpiry == 1) {
                    $title = get_post_meta(get_the_ID(), "promotion_title1", true);
                    $color = get_post_meta(get_the_ID(), "promotion_color", true);
                    $subheading = get_post_meta(get_the_ID(), "promotion_subheading", true);
                    $heading = get_post_meta(get_the_ID(), "promotion_heading", true);
                    $footer_heading = get_post_meta(get_the_ID(), "promotion_footer_heading", true);
                    $more_info = get_post_meta(get_the_ID(), "promotion_more_info", true);
                    $requestButtonLink = get_post_meta($post->ID, "request_button_link", true);
                    $open_new_tab = get_post_meta(get_the_ID(), "promotion_open_new_tab", true);
                    $requestButtonTitle = get_post_meta($post->ID, "request_button_title", true);
                    ?>
                    <div class="swiper-slide border-quaternary-dashed p-2">
                        <div class="coupon_name promotion_c h-100 text-center">
                            <div class="color_primary_bg mb-2 w-100 h-100" style="background-color: <?php echo !empty($color) ? $color : '#fff'; ?>;">
                                <h4 class="mb-0 pt-lg-3 pt-3 coupon_title coupon_offer"><?php echo !empty($title) ? $title : ''; ?></h4>
                                <span class="pt-lg-3 pt-2 d-block coupon_expiry">
                                    <?php if ($noexpiry != 1 && !empty($date)) {
                                        echo "expires " . $date . "<br>";
                                    } ?>
                                </span>
                                
                                <div class="promotionC_coupon bg-transparent border-0" style="display: none;">
                                    <div class="card card-body bg-transparent border-0">
                                        <span class="d-block text-center py-2 px-lg-0 px-2 pt-2 my-lg-1 coupon_heading"><?php echo !empty($heading) ? $heading : ''; ?></span>
                                        <span class="d-block text-center py-2 px-lg-0 px-2 coupon_sub_heading"><?php echo !empty($subheading) ? $subheading : ''; ?></span>
                                        <span class="d-block text-center px-lg-0 px-3 pt-lg-0 pt-2 coupon_disclaimer"><?php echo !empty($more_info) ? $more_info : ''; ?></span>
                                    </div>
                                </div>
                                <a class="w-166 text-uppercase font_alt_1 text_18 line_height_23 mh-33 text_semibold text_semibold_hover d-inline-flex align-items-center justify-content-center no_hover_underline mb-4 promotionC_icon more-info-button cursor-pointer">More info <i class="icon-plus1 ms-4"></i></a>
                            </div>
                            <a data-bs-toggle="<?php echo !empty($requestButtonLink) ? '' : 'modal'; ?>" 
                               data-bs-target="<?php echo !empty($requestButtonLink) ? '' : '#sidebar_request_coupon_form'; ?>" 
                               <?php echo !empty($requestButtonLink) ? 'href="' . $requestButtonLink . '"' : 'onclick="couponButtonClick(this);"'; ?>
                               <?php echo !empty($requestButtonTitle) ? 'aria-label="' . $requestButtonTitle . '"' : 'aria-label="Request Service"'; ?>
                               class="btn btn-secondary w-100 btn-border request_service_button"
                               <?php echo $open_new_tab == 1 ? 'target="_blank"' : ''; ?>>
                               <?php echo !empty($requestButtonTitle) ? $requestButtonTitle : 'Request Service'; ?>
                            </a>
                        </div>
                    </div>
                <?php
                }
            endwhile; ?>
        </div>
    </div>
    <div class="swiper-pagination coupon-pagination pagination-variation-a position-relative pb-3"></div>
    <div class="text-center see_all_button mb-4 pb-2">
        <a href="<?php echo !empty($args["page_templates"]["subpage"]["sidebar"]["promotion"]["button_link"]) ? get_home_url() . $args["page_templates"]["subpage"]["sidebar"]["promotion"]["button_link"] : '#'; ?>" 
           class="btn btn-primary mw-232">
           <?php echo !empty($args["page_templates"]["subpage"]["sidebar"]["promotion"]["button_text"]) ? $args["page_templates"]["subpage"]["sidebar"]["promotion"]["button_text"] : ''; ?> 
           <i class="icon-chevron-right text_18 line_height_18 ms-2 d-lg-inline-block d-none"></i>
        </a>
    </div>
</div>

<div class="modal fade request_form px-lg-0 px-0 pt-5 pt-md-0 cc" id="sidebar_request_coupon_form" tabindex="-1" role="dialog" data-bs-backdrop="false" data-bs-keyboard="false" aria-labelledby="requestcoupon_Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered px-lg-0 px-2 " role="document">
        <div class="modal-content border-0 rounded-0 text-center">
            <div class="modal-header border-0 p-0">
                <button type="button" class="close coupon-popup-close position-absolute bg-transparent border-0 pb-0 px-0" data-bs-dismiss="modal" aria-label="Close" style="opacity:1; z-index: 999; color:#fff ;">
                    <i class="icon-xmark1 text_30 line_height_26"></i>
                </button>
            </div>
            <div class="modal-body p-lg-4 p-2 w-100 my-auto mx-auto coupons">
                <div class="border-dashed-7 pt-lg-4 pb-lg-4 py-4 footer_form_A ui_kit_footer_form elementor-popupform">
                    <h3 class="px-lg-0 px-4"><?php echo !empty($args["page_templates"]["subpage"]["sidebar"]["promotion"]["popup_form_heading"]) ? $args["page_templates"]["subpage"]["sidebar"]["promotion"]["popup_form_heading"] : ''; ?></h3>
                    <div class="my-md-0 mt-lg-4 mt-3 w-lg-260 mx-auto text-start text-lg-center d-flex align-items-center justify-content-center pb-4 px-lg-0 px-4">
                        <i class="icon-shield-check1 text_30 line_height_30 me-2 position-relative color_primary"></i>
                        <span class="font_alt_1 text_bold text_16 line_height_25 sm_text_16 sm_line_height_30 color_primary">
                            <?php echo !empty($args["page_templates"]["subpage"]["sidebar"]["promotion"]["popup_form_subheading"]) ? $args["page_templates"]["subpage"]["sidebar"]["promotion"]["popup_form_subheading"] : ''; ?>
                        </span>
                    </div>
                    <div class="px-lg-5 mx-lg-4 px-4">
                        <?php
                        $form_id = !empty($args["page_templates"]["subpage"]["sidebar"]["promotion"]["popup_gravity_form_id"]) ? $args["page_templates"]["subpage"]["sidebar"]["promotion"]["popup_gravity_form_id"] : '';
                        echo !empty($form_id) ? do_shortcode("[gravityforms id=" . $form_id . " ajax=true]") : '';
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script type="text/javascript">
        jQuery(document).ready(function(){
            var swiperSubpageC = new Swiper(".coupon-swiper", {
                spaceBetween: 10,
                slidesPerView: 1,
                loop: true,
                autoplay: {
                    delay: 8000,
                    disableOnInteraction: false,
                  },
                pagination: {
                    el: ".coupon-pagination",
                    clickable: true,
                },

            });

            var mySwiper = document.querySelector('.coupon-swiper').swiper
                document.querySelectorAll('.request_service_button').forEach(function(button) {
                    button.addEventListener('click', function() {
                        if (document.getElementById('sidebar_request_coupon_form').classList.contains('show')) {
                            mySwiper.autoplay.stop();
                        }
                    });
                });

                document.querySelector('.coupon-popup-close').addEventListener('click', function() {
                    if (!document.getElementById('sidebar_request_coupon_form').classList.contains('show')) {
                        mySwiper.autoplay.start();
                }
            });
        });
    </script>
    <?php }
	wp_reset_query();
} ?>

<script type="text/javascript">
jQuery(document).ready(function () {
    jQuery('.promotionC_icon').on('click', function () { 
        console.log("click")
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
        jQuery(this).closest("#sidebar_request_coupon_form").find("form .gfield_label").each(function (k, d) {
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
    if (jQuery('.bc-promotion-title').text() == 'Promotion title here') {
        var promotiontitleValue = jQuery('#input_9_10').val();
        jQuery('.bc-promotion-title').text(promotiontitleValue);
    }
    }, 500);
});
function couponButtonClick(attr) {
    var CouponTitle = jQuery(attr).parent('.coupon_name').find('.coupon_title').text();
    var CouponsubTitle = jQuery(attr).parent('.coupon_name').find('.coupon_heading').text();
    var Couponsubheading = jQuery(attr).parent('.coupon_name').find('.coupon_sub_heading').text();
    console.log(CouponTitle + " " + CouponsubTitle + " " + Couponsubheading)
    jQuery(".coupon-name").find('input:text').val(CouponTitle + " " + CouponsubTitle + " " + Couponsubheading);
    jQuery(".bc-promotion-title").text(CouponTitle + " " + CouponsubTitle + " " + Couponsubheading);
}
</script>