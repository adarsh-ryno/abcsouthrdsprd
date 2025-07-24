<?php
//exaple how to set image sizewise
// ['dektop', 'ipad', 'mobile']

$img1x = [
	get_exist_image_url("subpage-hero", "subpage-banner"),
	get_exist_image_url("subpage-hero", "subpage-banner"),
	get_exist_image_url("subpage-hero", "m-subpage-banner"),
];

$img2x = [
	get_exist_image_url("subpage-hero", "subpage-banner@2x"),
	get_exist_image_url("subpage-hero", "subpage-banner@2x"),
	get_exist_image_url("subpage-hero", "m-subpage-banner@2x"),
];

$img3x = [
	get_exist_image_url("subpage-hero", "subpage-banner@3x"),
	get_exist_image_url("subpage-hero", "subpage-banner@3x"),
	get_exist_image_url("subpage-hero", "m-subpage-banner@3x"),
];

$img1x = Implode(",", $img1x);
$img2x = Implode(",", $img2x);
$img3x = Implode(",", $img3x);

$heading = get_post_meta($post->ID, "banner_heading", true);
$subheading = get_post_meta($post->ID, "banner_subheading", true);
$buttontext = get_post_meta($post->ID, "banner_buttontext", true);
$buttonlink = get_post_meta($post->ID, "banner_buttonlink", true);
?>

<?php echo do_shortcode(
	'[custom-bg-srcset class="service_subpage_banner" img1x="' .
		$img1x .
		'" img2x="' .
		$img2x .
		'" img3x="' .
		$img3x .
		'" size1x="cover" size2x="cover" size3x="cover"]'
); ?>
<div class="container-fluid service_subpage_banner py-lg-0 py-4">
    <div class="container px-0 pb-lg-2 pb-4">
        <div class="row py-2 pb-lg-3">
            <div class="col-lg-12 py-3 py-lg-4"> 
                <?php
                $i = 0;
                $services_prmotion_id = get_post_meta(
                	get_the_ID(),
                	"rds_promotion_id",
                	true
                );
                global $post;
                $get_slug = $post->post_name;
                $the_query = new WP_Query([
                	"post_type" => "bc_promotions",
                	"post_status" => "publish",
                	"tax_query" => [
                		[
                			"taxonomy" => "bc_promotion_category",
                			"field" => "slug",
                			"terms" => $get_slug,
                		],
                	],
                ]);
				if (empty($the_query->post) && isset($post) && isset($post->post_parent)) {
					$get_slug = get_page($post->post_parent)->post_name;
				}
				
                if (!empty($services_prmotion_id)) {
                	$get_id = [
                		"post_type" => "bc_promotions",
                		"post_status" => "publish",
                		"p" => $services_prmotion_id,
                	];
                	$loop = new WP_Query($get_id);
                	if ($loop->have_posts()) {
                		while ($loop->have_posts()):
                			$loop->the_post();

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
                			if (
                				strtotime($date) >=
                					strtotime(current_time("m/d/Y")) ||
                				$noexpiry == 1
                			) {
                				$i++; ?>
                            <span class="d-block display1 coupon_title"><?php echo get_post_meta(
                            	get_the_ID(),
                            	"promotion_title1",
                            	true
                            ); ?> </span> 
                                <span class="d-block display2 coupon_subtitle"><?php echo get_post_meta(
                                	get_the_ID(),
                                	"promotion_heading",
                                	true
                                ); ?> </span>
                                <span class="d-block display2 coupon_subtitle2 "><?php echo get_post_meta(
                                	get_the_ID(),
                                	"promotion_subheading",
                                	true
                                ); ?> </span>
                                <a data-bs-toggle="modal" data-bs-target="#request_coupon_form" onclick="couponBannerButtonClick(this);" class="btn btn-secondary mw-226 mt-2">Request Service <i class="icon-chevron-right text_18 line_height_18 ms-2 "></i></a>
                            <?php
                			}
                		endwhile;
                		wp_reset_postdata();
                	}
                }
                if ($i == 0) {
                	$get_id = [
                		"post_type" => "bc_promotions",
                		"post_status" => "publish",
                		"orderby" => "modified",
                	];
                	$loop = new WP_Query($get_id);
                	while ($loop->have_posts()):
                		$loop->the_post();
                		$terms = wp_get_post_terms($loop->post->ID, [
                			"bc_promotion_category",
                		]);
                		foreach ($terms as $term):
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
                			if (
                				$get_slug == $term->slug &&
                				$i == 0 &&
                				get_post_meta(
                					get_the_ID(),
                					"promotion_show_banner_setting",
                					true
                				) == true &&
                				(strtotime($date) >=
                					strtotime(current_time("m/d/Y")) ||
                					$noexpiry == 1)
                			) { ?>
                                <span class="d-block display1 coupon_title"><?php echo get_post_meta(
                                	get_the_ID(),
                                	"promotion_title1",
                                	true
                                ); ?> </span> 
                                <span class="d-block display2 coupon_subtitle"><?php echo get_post_meta(
                                	get_the_ID(),
                                	"promotion_heading",
                                	true
                                ); ?> </span>
                                <span class="d-block display2 coupon_subtitle2 "><?php echo get_post_meta(
                                	get_the_ID(),
                                	"promotion_subheading",
                                	true
                                ); ?> </span>
                                <a data-bs-toggle="modal" data-bs-target="#request_coupon_form" onclick="couponBannerButtonClick(this);" class="btn btn-secondary mw-226 mt-2">Request Service <i class="icon-chevron-right text_18 line_height_18 ms-2 "></i></a>
                                <?php $i++;}
                		endforeach;
                	endwhile;
                	wp_reset_postdata();
                }
				if ($i == 0) {
					if (!empty($args['page_templates']['subpage']['banner']['heading'])) {
						?>
						<span class="d-block display1"><?php echo esc_html($args['page_templates']['subpage']['banner']['heading']); ?> </span> 
						<?php
					}
					if (!empty($args['page_templates']['subpage']['banner']['subheading'])) {
						?>
						<span class="d-block display2"><?php echo esc_html($args['page_templates']['subpage']['banner']['subheading']); ?> </span>
						<?php
					}
					if (!empty($args['page_templates']['subpage']['banner']['button_text']) && !empty($args['page_templates']['subpage']['banner']['button_link'])) {
						?>
						<a href="<?php echo esc_url(get_home_url() . $args['page_templates']['subpage']['banner']['button_link']); ?>" class="btn btn-primary mw-237 mt-3"><?php echo esc_html($args['page_templates']['subpage']['banner']['button_text']); ?>  <i class="icon-chevron-right1 ms-1 text_18 line_height_18 d-lg-inline-block"></i></a> 
						<?php 
					}
				}
				
                ?>
            </div>
        </div>
    </div>
</div>
<div class="modal fade request_form px-lg-0 px-0 pt-5 pt-md-0 bb" id="request_coupon_form" tabindex="-1" role="dialog" data-bs-backdrop="false" data-bs-keyboard="false" aria-labelledby="requestcoupon_Label" aria-hidden="true">
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
                        <h3 class="px-lg-0 px-4"><?php echo esc_html($args["page_templates"]["subpage"]["sidebar"]["promotion"]["popup_form_heading"]); ?></h3>
                        <?php if (!empty($args["page_templates"]["subpage"]["sidebar"]["promotion"]["popup_form_subheading"])): ?>
                            <div class="my-md-0 mt-lg-4 mt-3 w-lg-260 mx-auto text-start text-lg-center d-flex align-items-center justify-content-center pb-4 px-lg-0 px-4">
                                <i class="icon-shield-check1 text_30 line_height_30 me-2 position-relative color_primary"></i>
                                <span class="font_alt_1 text_bold text_16 line_height_25 sm_text_16 sm_line_height_30 color_primary">
                                    <?php echo esc_html($args["page_templates"]["subpage"]["sidebar"]["promotion"]["popup_form_subheading"]); ?>
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
           
           jQuery(this).closest("#request_coupon_form").find("form .gfield_label").each(function (k, d) {
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