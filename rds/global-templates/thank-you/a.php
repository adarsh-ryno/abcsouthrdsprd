<?php $get_rds_template_data_array = RDS_TEMPLATE_DATA;
$get_alt_text = RDS_ALT_DATA;
$alt = "";
if (is_array($get_alt_text)) {
    foreach ($get_alt_text as $value) {
        if (is_array($value) && in_array("thank-you-graphic.webp", $value) && isset($value[3])) {
            $alt = 'alt="' . esc_attr($value[3]) . '"';
        }
    }
}

?>  
      <div class="d-block order-1 order-lg-1">
    <!-- Thank You content area starts -->
    <div class="container-fluid pt-4 order-1 order-lg-1 pb-lg-5 pb-4 my-2 px-lg-3 px-0">
        <div class="container px-lg-3 px-0">
            <div class="row pb-lg-2 pt-lg-5 mx-0">
                <div class="col-12 col-lg-12 order-lg-1 order-1 pt-lg-1">
                    <div class="text-center">
                        <?php
                        $thank_you_graphic = get_exist_image_url("thank-you", "thank-you-graphic");
                        $thank_you_graphic_2x = get_exist_image_url("thank-you", "thank-you-graphic@2x");
                        $thank_you_graphic_3x = get_exist_image_url("thank-you", "thank-you-graphic@3x");
                        if (!empty($thank_you_graphic)) {
                            ?>
                            <img src="<?php echo esc_url($thank_you_graphic); ?>" srcset="<?php echo esc_url($thank_you_graphic); ?> 1x, <?php echo esc_url($thank_you_graphic_2x); ?> 2x, <?php echo esc_url($thank_you_graphic_3x); ?> 3x" class="img-fluid mx-auto" width="540" height="163" alt="Thank You Graphic">
                            <?php
                        }
                        ?>
                        <h1 class="mt-4 pt-2 mb-4 thankyou_page_heading_color"><?php echo !empty($args['page_templates']['thankyou_page']['title']) ? esc_html($args['page_templates']['thankyou_page']['title']) : ''; ?></h1>
                        <p class="thankyou_page_content_color mb-4">
                            <?php echo !empty($args['page_templates']['thankyou_page']['middle_content']) ? esc_html($args['page_templates']['thankyou_page']['middle_content']) : ''; ?>
                        </p>
                        <?php
                        $temName = basename(get_page_template());
                        if ($temName != "rds-coupon-thankyou.php") {
                            ?>
                            <div class="text-center pt-2">
                                <span onclick="scrollSmoothTo('thankyou_page_promotion')" class="next-service btn btn-primary mw-338" id="bc-thankyou"><?php echo !empty($args["page_templates"]["thankyou_page"]["scroll_button_text"]) ? esc_html($args["page_templates"]["thankyou_page"]["scroll_button_text"]) : ''; ?> <i class="icon-circle-arrow-down2 ms-2 line_height_18"></i></span>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Thank You content area ends -->
</div>

<!-- Affiliation Start-->
<div class="d-block order-2 order-lg-2" id="next-service">
    <div class="container-fluid bc-thnkyu-trust px-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-11 col-xl-10 mx-auto">
                    <div class="row align-items-center mx-auto py-lg-4">
                        <div class="col-lg-3 text-center">
                            <h2 class="mb-0 pt-lg-0 pt-4 text-capitalize"><?php echo !empty($args["page_templates"]["thankyou_page"]["affiliation_heading"]) ? esc_html($args["page_templates"]["thankyou_page"]["affiliation_heading"]) : ''; ?></h2>
                        </div>
                        <?php if (!empty($get_rds_template_data_array["globals"]["affiliation"]["variation"])) {
                            get_template_part("global-templates/affiliation/thank-you/" . $get_rds_template_data_array["globals"]["affiliation"]["variation"], null, $get_rds_template_data_array);
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Affiliation End -->

<?php if (!empty($args["page_templates"]["thankyou_page"]["show_promotions"]) && $args["page_templates"]["thankyou_page"]["show_promotions"] == 1) { ?>
    <div class="d-block order-3 order-lg-3" id="thankyou_page_promotion">
        <div class="container-fluid py-5">
            <div class="container px-lg-3 pb-lg-5">
                <div class="row align-items-center">
                    <div class="col-lg-6 px-4 px-lg-3 text-center text-lg-start mb-5 mb-lg-0">
                        <h4 class="mb-0"><?php echo !empty($args["page_templates"]["thankyou_page"]["promotions"]["heading"]) ? esc_html($args["page_templates"]["thankyou_page"]["promotions"]["heading"]) : ''; ?></h4>
                        <p class="py-4 mb-0"><?php echo !empty($args["page_templates"]["thankyou_page"]["promotions"]["content"]) ? esc_html($args["page_templates"]["thankyou_page"]["promotions"]["content"]) : ''; ?></p>
                        <a href="<?php echo esc_url(get_home_url() . (!empty($args["page_templates"]["thankyou_page"]["promotions"]["button_link"]) ? $args["page_templates"]["thankyou_page"]["promotions"]["button_link"] : '#')); ?>" class="btn btn-primary-alt-1 mw-278">
                            <?php echo !empty($args["page_templates"]["thankyou_page"]["promotions"]["button_text"]) ? esc_html($args["page_templates"]["thankyou_page"]["promotions"]["button_text"]) : ''; ?>
                            <i class="icon-chevron-right2 align-top ms-2 top_n1 position-relative"></i>
                        </a>
                    </div>
                    <!-- Coupon starts -->
                    <?php if (!empty($get_rds_template_data_array["globals"]["promotion"]["variation"])) {
                        get_template_part("global-templates/promotion/thank-you/" . $get_rds_template_data_array["globals"]["promotion"]["variation"], null, $get_rds_template_data_array);
                    } ?>
                    <!-- Coupon ends -->
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<div class="modal fade request_form px-lg-0 px-0 pt-5 pt-md-0" id="thank_you_request_coupon_form" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="requestcoupon_Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered px-lg-0 px-2" role="document">
        <div class="modal-content border-0 rounded-0 text-center">
            <div class="modal-header border-0 p-0">
                <button type="button" class="close coupon-popup-close position-absolute bg-transparent border-0 pb-0 px-0" data-bs-dismiss="modal" aria-label="Close" style="opacity:1; z-index: 999; color:#fff ;">
                    <i class="icon-xmark1 text_30 line_height_26"></i>
                </button>
            </div>
            <div class="modal-body p-lg-4 p-2 w-100 my-auto mx-auto coupons">
                <div class="border-dashed-7 pt-lg-4 pb-lg-4 py-4 footer_form_A ui_kit_footer_form elementor-popupform">
                    <h3 class="px-lg-0 px-4"><?php echo !empty($args["globals"]["promotion"]["popup_form_heading"]) ? esc_html($args["globals"]["promotion"]["popup_form_heading"]) : ''; ?></h3>
                    <div class="my-md-0 mt-lg-4 mt-3 w-lg-260 mx-auto text-start text-lg-center d-flex align-items-center justify-content-center pb-4 px-lg-0 px-4">
                        <i class="icon-shield-check1 text_30 line_height_30 me-2 position-relative color_primary"></i>
                        <span class="font_alt_1 text_bold text_16 line_height_25 sm_text_16 sm_line_height_30 color_primary"><?php echo !empty($args["globals"]["promotion"]["popup_form_subheading"]) ? esc_html($args["globals"]["promotion"]["popup_form_subheading"]) : ''; ?></span>
                    </div>
                    <div class="px-lg-5 mx-lg-4 px-4">
                        <?php
                        $form_id = !empty($args["globals"]["promotion"]["popup_gravity_form_id"]) ? $args["globals"]["promotion"]["popup_gravity_form_id"] : 0;
                        echo do_shortcode("[gravityforms id=" . $form_id . " ajax=true]");
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
                            
                             jQuery(this).find('i').toggleClass('icon-plus1 icon-minus1');
                         
                        } else {
                            jQuery(this).html(text.replace('Less info ', 'More info '));
                         
                                  jQuery(this).find('i').toggleClass('icon-minus1 icon-plus1');
                              }
                        
                    });
            </script>
                <script type="text/javascript">
        jQuery(document).ready(function () {

            jQuery(".coupon-popup-close").click(function () {
                
                jQuery(this).closest("#thank_you_request_coupon_form").find("form .gfield_label").each(function (k, d) {
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
            var CouponsubTitle = jQuery(attr).parent('.coupon_name').find('.coupon_subtitle').text();
            var Couponsubheading = jQuery(attr).parent('.coupon_name').find('.coupon_sub_heading ').text();
            console.log(CouponTitle + " " + CouponsubTitle + " " + Couponsubheading)
            jQuery(".coupon-name").find('input:text').val(CouponTitle + " " + CouponsubTitle + " " + Couponsubheading);
            jQuery(".bc-promotion-title").text(CouponTitle + " " + CouponsubTitle + " " + Couponsubheading);
        }

    </script>
    <script type="text/javascript">
     function scrollSmoothTo(elementId) {
        var element = document.getElementById(elementId);
        if (element !== null) {
            element.scrollIntoView({
                block: 'start',
                behavior: 'smooth'
            });
        }
    }

    </script> 