<div class="modal fade request_form px-lg-0 px-0 pt-5 pt-md-0 gg" id="landing_request_coupon_form" tabindex="-1" role="dialog" data-bs-backdrop="false" data-bs-keyboard="false" aria-labelledby="requestcoupon_Label" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered px-lg-0 px-2 " role="document">
      <div class="modal-content border-0 rounded-0 text-center">
         <div class="modal-header border-0 p-0">
            <button type="button" class="close coupon-popup-close position-absolute bg-transparent border-0 pb-0 px-0" data-bs-dismiss="modal" aria-label="Close" style="opacity:1; z-index: 999; color:#fff ;">
            <i class="icon-xmark1 text_30 line_height_26"></i>
            </button>
         </div>
         <div class="modal-body p-lg-4 p-2 w-100 my-auto mx-auto coupons">
            <div class="border-dashed-7 pt-lg-4 pb-lg-4 py-4 footer_form_A ui_kit_footer_form elementor-popupform">
               <?php if (!empty($args["page_templates"]["landing_page"]["promotion"]["popup_form_heading"])) { ?>
                  <h3 class="px-lg-0 px-4"><?php echo $args["page_templates"]["landing_page"]["promotion"]["popup_form_heading"]; ?></h3>
               <?php } ?>

               <?php if (!empty($args["page_templates"]["landing_page"]["promotion"]["popup_form_subheading"])) { ?>
                  <div class="my-md-0 mt-lg-4 mt-3 w-lg-260 mx-auto text-start text-lg-center d-flex align-items-center justify-content-center pb-4 px-lg-0 px-4">
                     <i class="icon-shield-check1 text_30 line_height_30 me-2 position-relative color_primary"></i>
                     <span class="font_alt_1 text_bold text_16 line_height_25 sm_text_16 sm_line_height_30 color_primary"><?php echo $args["page_templates"]["landing_page"]["promotion"]["popup_form_subheading"]; ?></span>
                  </div>
               <?php } ?>

               <div class="px-lg-5 mx-lg-4 px-4">
                  <?php
                  if (!empty($args["page_templates"]["landing_page"]["promotion"]["popup_gravity_form_id"])) {
                     $form_id = $args["page_templates"]["landing_page"]["promotion"]["popup_gravity_form_id"];
                     echo do_shortcode("[gravityforms id=" . $form_id . " ajax=true]");
                  }
                  ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
   jQuery(".promotionC_icon").click(function () {
       var text = jQuery(this).html().trim();
       currentText = jQuery(this).text();
   
       if (currentText == "More info ") {
           jQuery(this).html(text.replace('More info ', 'Less info '));
           if (jQuery('body').hasClass('elementor-editor-active')) {
               jQuery(this).find('i').toggleClass('icon-plus1 icon-minus1');
           }
       } else {
           jQuery(this).html(text.replace('Less info ', 'More info '));
           if (jQuery('body').hasClass('elementor-editor-active')) {
               jQuery(this).find('i').toggleClass('icon-minus1 icon-plus1');
           }
       }
   });
</script>
<script type="text/javascript">
   jQuery(document).ready(function () {
   
       jQuery(".coupon-popup-close").click(function () {
           
           jQuery(this).closest("#landing_request_coupon_form").find("form .gfield_label").each(function (k, d) {
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
       var CouponsubTitle = jQuery(attr).parent('.coupon_name').find('.coupon_subtitle').text();
       var Couponsubheading = jQuery(attr).parent('.coupon_name').find('.coupon_sub_heading ').text();
       console.log(CouponTitle + " " + CouponsubTitle + " " + Couponsubheading)
       jQuery(".coupon-name").find('input:text').val(CouponTitle + " " + CouponsubTitle + " " + Couponsubheading);
       jQuery(".bc-promotion-title").text(CouponTitle + " " + CouponsubTitle + " " + Couponsubheading);
   }
   
</script>
<?php if (function_exists("get_promotion_query")) {
   $widget_id = $args["globals"]["promotion"]["widget_id"];
   $category_name = is_array($args["category_taxonomy"]) ? $args["category_taxonomy"] : array($args["category_taxonomy"]);
   $current_date = date("m/d/Y");
   $paged = get_query_var("paged") ? get_query_var("paged") : -1;
   if (empty($category_name) || in_array("all", $category_name)) {
   	query_posts([
   		"post_type" => "bc_promotions",
           "posts_per_page" => "-1",
   		"paged" => $paged,
   		"order" => "DESC",
   		"post_status" => "publish",
   	    "meta_query" => [
        "relation" => "AND", 
            [
                "key" => "promotion_landing_page_setting",
                "value" => "1",
                "compare" => "EXISTS",
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
        "posts_per_page" => "-1",
        "paged" => $paged,
        "order" => "DESC",
        "post_status" => "publish",
        "meta_query" => [
            "relation" => "AND", 
            [
                "key" => "promotion_landing_page_setting",
                "value" => "1", 
                "compare" => "EXISTS",
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
<div class="d-block  pb-lg-2">
   <?php global $template; ?>
   <div class="container-fluid px-0 true_white_bg">
      <div class="container px-0 px-lg-3">
         <div class="row mx-0">
            <div class="homepage_coupon col-lg-12  pt-lg-3 mt-4 pb-4 pb-lg-0 px-lg-0 px-4 ">
               <div class="coupon_slider px-3 position-relative">
                  <div class="swiper  promotion-swiper-variation-a  d-lg-block d-none">
                     <div class="swiper-wrapper">
                        <?php
                           $i = 0;
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
                        <div class="swiper-slide h-auto color_primary_bg p-3" style="background-color: <?php echo $color; ?>;">
                           <div class="coupon_name border-dashed-5 h-coupan-100 py-4 p-4 px-lg-0 text-center">
                              <span class="coupon_subtitle d-block text-center px-lg-0 px-3 pt-lg-0 pt-2 coupon_heading"><?php echo $heading; ?></span>
                              <span class="d-block text-center  py-2 px-lg-0 px-2 pt-lg-0 pt-2 my-lg-1 coupon_sub_heading "><?php echo $subheading; ?></span>
                              <h4 class="coupon_title mb-0 pb-lg-3 pt-lg-0 py-3 coupon_offer"><?php echo $title; ?></h4>
                              <a data-bs-toggle="<?php echo empty(
                                 $requestButtonLink
                                 )
                                 ? "modal"
                                 : ""; ?>" 
                                 data-bs-target="<?php echo empty(
                                    $requestButtonLink
                                    )
                                    ? "#landing_request_coupon_form"
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
                                 class="btn btn-secondary mw-226 request_service_button"
                                 <?php echo $open_new_tab ==
                                    1
                                    	? 'target="_blank"'
                                    	: ""; ?>>
                              <?php echo empty(
                                 $requestButtonTitle
                                 )
                                 ? "Request Service"
                                 : $requestButtonTitle; ?> 
                              <i class="icon-chevron-right text_18 line_height_18 ms-2"></i>
                              </a>
                              <span class="pt-lg-3 pt-2 d-block coupon_expiry"> <?php if (
                                 $noexpiry != 1
                                 ) {
                                 echo "Expires " .
                                 	$date;
                                 } ?></span><span class="d-block coupon_disclaimer color_white"><?php echo $footer_heading; ?></span>
                           </div>
                        </div>
                        <?php
                           }
                           $i++;
                           endwhile;
                           ?>
                     </div>
                  </div>
                  <div class="swiper m-promotion-swiper-variation-a d-lg-none d-block">
                     <div class="swiper-wrapper">
                        <?php while (have_posts()):
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
                           			current_time("m/d/Y")
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
                        <div class="swiper-slide h-auto color_primary_bg p-3 " style="background-color: <?php echo $color; ?>;">
                           <div class="coupon_name border-dashed-5  h-coupan-100 py-4 p-4 px-lg-0 text-center">
                              <span class="coupon_subtitle d-block text-center px-lg-0 px-3 pt-lg-0 pt-2 coupon_heading"><?php echo $heading; ?></span>
                              <span class="d-block text-center  py-2 px-lg-0 px-2 pt-lg-0 pt-2 my-lg-1 coupon_sub_heading "><?php echo $subheading; ?></span>
                              <h4 class="coupon_title mb-0 pb-lg-3 pt-lg-0 py-3 coupon_offer"><?php echo $title; ?></h4>
                              <a data-bs-toggle="<?php echo empty(
                                 $requestButtonLink
                                 )
                                 ? "modal"
                                 : ""; ?>" 
                                 data-bs-target="<?php echo empty(
                                    $requestButtonLink
                                    )
                                    ? "#landing_request_coupon_form"
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
                                 class="btn btn-secondary mw-226 request_service_button"
                                 <?php echo $open_new_tab ==
                                    1
                                    	? 'target="_blank"'
                                    	: ""; ?>>
                              <?php echo empty(
                                 $requestButtonTitle
                                 )
                                 ? "Request Service"
                                 : $requestButtonTitle; ?> 
                              <i class="icon-chevron-right text_18 line_height_18 ms-2"></i>
                              </a>
                              <span class="pt-lg-3 pt-2 d-block coupon_expiry"> <?php if (
                                 $noexpiry != 1
                                 ) {
                                 echo "Expires " .
                                 	$date;
                                 } ?></span><span class="d-block coupon_disclaimer color_white"><?php echo $footer_heading; ?></span>
                           </div>
                        </div>
                        <?php
                           }
                           endwhile; ?>
                     </div>
                  </div>
                  <?php if ($i > 3) { ?>
                  <div class="swiper-button-next landing_next_a d-lg-block ">
                     <i class="icon-chevron-right text_25 line_height_42  transform_lg"></i>
                  </div>
                  <div class="swiper-button-prev landing_prev_a d-lg-block">
                     <i class="icon-chevron-left text_25 line_height_42 transform_lg"></i>
                  </div>
                  <?php } ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
   jQuery(document).ready(function () {
       var numImage_a = jQuery('.promotion-swiper-variation-a .swiper-slide').length;
       if (numImage_a < 4) {
           jQuery('.promotion-swiper-variation-a .swiper-wrapper').addClass('justify-content-center ps-lg-3');
           new Swiper(".promotion-swiper-variation-a", {
               spaceBetween: 30,
               slidesPerView: 1,
               loop: false,
               pagination: {
                   el: ".home-coupon-pagination-<?php echo $widget_id ?>",
                   clickable: true
               },
               navigation: {
               nextEl: ".landing_next_a",
               prevEl: ".landing_prev_a",
           },
               breakpoints: {
                   640: {
                       slidesPerView: 1,
                       spaceBetween: 30
                   },
                   768: {
                       slidesPerView: 1,
                       spaceBetween: 30
                   },
                   992: {
                       slidesPerView: 3,
                       spaceBetween: 30
                   }
               }
           });
       } else {
    
           new Swiper(".promotion-swiper-variation-a", {
               spaceBetween: 30,
               slidesPerView: 1,
               autoplay: {
                   delay: 8000,
                   disableOnInteraction: false
               },
               loop: true,
               pagination: {
                   el: ".home-coupon-pagination-<?php echo $widget_id ?>",
                   clickable: true
               },
               navigation: {
                   nextEl: ".landing_next_a",
                   prevEl: ".landing_prev_a",
               },
               breakpoints: {
                   640: {
                       slidesPerView: 1,
                       spaceBetween: 30
                   },
                   768: {
                       slidesPerView: 1,
                       spaceBetween: 30
                   },
                   992: {
   
                       slidesPerView: 3,
                       spaceBetween: 30
                   }
               }
           });
           var mySwiper = document.querySelector('.promotion-swiper-variation-a').swiper
           document.querySelectorAll('.request_service_button').forEach(function(button) {
               button.addEventListener('click', function() {
                   if (document.getElementById('landing_request_coupon_form').classList.contains('show')) {
                       mySwiper.autoplay.stop();
                   }
               });
           });
   
           document.querySelector('.coupon-popup-close').addEventListener('click', function() {
               if (!document.getElementById('landing_request_coupon_form').classList.contains('show')) {
                   mySwiper.autoplay.start();
               }
           });
       }
   
       new Swiper(".m-promotion-swiper-variation-a", {
           spaceBetween: 30,
           slidesPerView: 1,
           autoplay: {
               delay: 8000,
               disableOnInteraction: false
           },
           navigation: {
               nextEl: ".landing_next_a",
               prevEl: ".landing_prev_a",
           },
           loop: true,
           pagination: {
               el: ".m-home-coupon-pagination-<?php echo $widget_id ?>",
               clickable: true
           },
           breakpoints: {
               640: {
                   slidesPerView: 1,
                   spaceBetween: 30
               },
               768: {
                   slidesPerView: 1,
                   spaceBetween: 30
               },
               992: {
                   slidesPerView: 3,
                   spaceBetween: 30
               }
           }
       }); 
   
       if(jQuery('.m-promotion-swiper-variation-a').length == 1){
           var mySwipera = document.querySelector('.m-promotion-swiper-variation-a').swiper
           document.querySelectorAll('.request_service_button').forEach(function(button) {
               button.addEventListener('click', function() {
                   if (document.getElementById('landing_request_coupon_form').classList.contains('show')) {
                       mySwipera.autoplay.stop();
                   }
               });
           });
   
           document.querySelector('.coupon-popup-close').addEventListener('click', function() {
               if (!document.getElementById('landing_request_coupon_form').classList.contains('show')) {
                   mySwipera.autoplay.start();
               }
           });
       }
   });
</script>
<?php }
wp_reset_query(); // Reset the custom query //
}