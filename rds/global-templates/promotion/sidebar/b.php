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
    <div class="sidebar_coupon pt-lg-5 pb-lg-4 px-lg-0 px-2 mx-lg-0 mx-1 order-lg-2 order-2">
    <?php if (!empty($args["page_templates"]["subpage"]["sidebar"]["promotion"]["heading"])): ?>
        <span class="font_default text_semibold text_28 line_height_33 text-center d-block pb-lg-3 sm_text_26 pb-4 sm_line_height_31">
            <?php echo $args["page_templates"]["subpage"]["sidebar"]["promotion"]["heading"]; ?>
        </span>
    <?php endif; ?>

    <div class="swiper coupon-swiper">
        <div class="swiper-wrapper">
            <?php while (have_posts()): the_post(); ?>
                <?php
                $promotion_type = get_post_meta(get_the_ID(), "promotion_type", true);
                $noexpiry = get_post_meta(get_the_ID(), "promotion_noexpiry", true);
                $colorCode = get_post_meta(get_the_ID(), "promotion_color", true);
                $date = get_post_meta(get_the_ID(), "promotion_expiry_date1", true);

                if ((strtotime($date) >= strtotime(current_time("m/d/Y")) || $noexpiry == 1) && !empty($colorCode)): 
                    $title = get_post_meta(get_the_ID(), "promotion_title1", true);
                    $subheading = get_post_meta(get_the_ID(), "promotion_subheading", true);
                    $heading = get_post_meta(get_the_ID(), "promotion_heading", true);
                    $footer_heading = get_post_meta(get_the_ID(), "promotion_footer_heading", true);
                    $requestButtonLink = get_post_meta($post->ID, "request_button_link", true);
                    $open_new_tab = get_post_meta(get_the_ID(), "promotion_open_new_tab", true);
                    $requestButtonTitle = get_post_meta($post->ID, "request_button_title", true);
                ?>
                    <div class="swiper-slide h-auto border-quaternary-dashed p-lg-2 p-3">
                        <div class="coupon_name color_primary_bg h-100 py-4 p-4 px-lg-0 text-center" style="background-color: <?php echo esc_attr($colorCode); ?>;">
                            <?php if (!empty($heading)): ?>
                                <span class="d-block text-center px-lg-0 px-3 pt-lg-0 pt-2 coupon_subtitle coupon_sub_heading"><?php echo $heading; ?></span>
                            <?php endif; ?>
                            <?php if (!empty($subheading)): ?>
                                <span class="d-block text-center py-2 px-lg-0 px-2 pt-2 my-lg-1 coupon_heading"><?php echo $subheading; ?></span>
                            <?php endif; ?>
                            <?php if (!empty($title)): ?>
                                <h4 class="mb-0 pb-lg-3 pt-lg-0 py-3 coupon_title coupon_offer"><?php echo $title; ?></h4>
                            <?php endif; ?>
                            <a data-bs-toggle="<?php echo empty($requestButtonLink) ? "modal" : ""; ?>" 
                               data-bs-target="<?php echo empty($requestButtonLink) ? "#sidebar_request_coupon_form" : ""; ?>" 
                               <?php echo empty($requestButtonLink) ? 'onclick="couponButtonClick(this);"' : 'href="' . esc_url($requestButtonLink) . '"'; ?>
                               <?php echo empty($requestButtonTitle) ? 'aria-label="Request Service"' : 'aria-label="' . esc_attr($requestButtonTitle) . '"'; ?>
                               class="btn btn-secondary mw-226 request_service_button"
                               <?php echo $open_new_tab == 1 ? 'target="_blank"' : ""; ?>>
                                <?php echo empty($requestButtonTitle) ? "Request Service" : esc_html($requestButtonTitle); ?> 
                                <i class="icon-chevron-right text_18 line_height_18 ms-2"></i>
                            </a>
                            <?php if ($noexpiry != 1 && !empty($date)): ?>
                                <span class="pt-lg-3 pt-2 d-block px-3 coupon_expiry"><?php echo "Expires " . esc_html($date); ?></span>
                            <?php endif; ?>
                            <?php if (!empty($footer_heading)): ?>
                                <span class="d-block coupon_disclaimer"><?php echo $footer_heading; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; endwhile; ?>
        </div>
    </div>
    <div class="swiper-pagination coupon-pagination pagination-variation-a position-relative pb-3"></div>

    <?php if (!empty($args["page_templates"]["subpage"]["sidebar"]["promotion"]["button_link"]) && !empty($args["page_templates"]["subpage"]["sidebar"]["promotion"]["button_text"])): ?>
        <div class="text-center see_all_button mb-4 pb-2">
            <a href="<?php echo esc_url(get_home_url() . $args["page_templates"]["subpage"]["sidebar"]["promotion"]["button_link"]); ?>" class="btn btn-primary mw-232">
                <?php echo esc_html($args["page_templates"]["subpage"]["sidebar"]["promotion"]["button_text"]); ?> 
                <i class="icon-chevron-right text_18 line_height_18 ms-2 d-lg-inline-block d-none"></i>
            </a>
        </div>
    <?php endif; ?>
</div>

<div class="modal fade request_form px-lg-0 px-0 pt-5 pt-md-0 bb" id="sidebar_request_coupon_form" tabindex="-1" role="dialog" data-bs-backdrop="false" data-bs-keyboard="false" aria-labelledby="requestcoupon_Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered px-lg-0 px-2 " role="document">
        <div class="modal-content border-0 rounded-0 text-center">
            <div class="modal-header border-0 p-0">
                <button type="button" class="close coupon-popup-close position-absolute bg-transparent border-0 pb-0 px-0" data-bs-dismiss="modal" aria-label="Close" style="opacity:1; z-index: 999; color:#fff ;">
                    <i class="icon-xmark1 text_30 line_height_26"></i>
                </button>
            </div>
            <div class="modal-body p-lg-4 p-2 w-100 my-auto mx-auto coupons">
                <?php if (!empty($args["page_templates"]["subpage"]["sidebar"]["promotion"]["popup_form_heading"])): ?>
                    <div class="border-dashed-7 pt-lg-4 pb-lg-4 py-4 footer_form_A ui_kit_footer_form elementor-popupform">
                        <h3 class="px-lg-0 px-4"><?php echo $args["page_templates"]["subpage"]["sidebar"]["promotion"]["popup_form_heading"]; ?></h3>
                        <?php if (!empty($args["page_templates"]["subpage"]["sidebar"]["promotion"]["popup_form_subheading"])): ?>
                            <div class="my-md-0 mt-lg-4 mt-3 w-lg-260 mx-auto text-start text-lg-center d-flex align-items-center justify-content-center pb-4 px-lg-0 px-4">
                                <i class="icon-shield-check1 text_30 line_height_30 me-2 position-relative color_primary"></i>
                                <span class="font_alt_1 text_bold text_16 line_height_25 sm_text_16 sm_line_height_30 color_primary">
                                    <?php echo $args["page_templates"]["subpage"]["sidebar"]["promotion"]["popup_form_subheading"]; ?>
                                </span>
                            </div>
                        <?php endif; ?>
                        <?php
                        $form_id = $args["page_templates"]["subpage"]["sidebar"]["promotion"]["popup_gravity_form_id"];
                        if (!empty($form_id)):
                            echo do_shortcode("[gravityforms id=" . esc_attr($form_id) . " ajax=true]");
                        endif;
                        ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

    <script type="text/javascript">
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
	    var swiperSubpageA = new Swiper(".coupon-swiper", {
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
       setInterval(function () {
               var promotiontitleValue = jQuery('#input_9_10').val();
               jQuery('.bc-promotion-title').text(promotiontitleValue);
       }, 500);
   });
   
   function couponButtonClick(attr) {
       var CouponTitle = jQuery(attr).parent('.coupon_name').find('.coupon_title').text();
       var CouponsubTitle = jQuery(attr).parent('.coupon_name').find('.coupon_subtitle').text();
       var Couponsubheading = jQuery(attr).parent('.coupon_name').find('.coupon_sub_heading ').text();
       console.log(CouponTitle + " " + CouponsubTitle + " " + Couponsubheading)
       jQuery(".coupon-name").find('input:text').val(CouponTitle + " " + CouponsubTitle + " " + Couponsubheading);
       jQuery(".bc-promotion-title").text(CouponTitle + " " + CouponsubTitle + " " + Couponsubheading);
   }
    </script>
    <?php }
	wp_reset_query();
} ?>
