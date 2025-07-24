<?php
if (function_exists("get_promotion_query")) {
	$query = get_promotion_query(1);
	if ($query->have_posts()) {
		while ($query->have_posts()):
			$query->the_post();
			$promotion_type = get_post_meta(
				get_the_ID(),
				"promotion_type",
				true
			);
			$noexpiry = get_post_meta(get_the_ID(), "promotion_noexpiry", true);
			$colorCode = get_post_meta(get_the_ID(), "promotion_color", true);
			$date = get_post_meta(get_the_ID(), "promotion_expiry_date1", true);
			$open_new_tab = get_post_meta(
				get_the_ID(),
				"promotion_open_new_tab",
				true
			);
			if (
				strtotime($date) >= strtotime(current_time("m/d/Y")) ||
				$noexpiry == 1
			) {

				$title = get_post_meta(get_the_ID(), "promotion_title1", true);
				$color = get_post_meta(get_the_ID(), "promotion_color", true);
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

                <div class="col-lg-6 px-0 px-lg-3">
    <div class="h-auto border-quaternary-dashed p-2">
        <div class="coupon_name promotion_c h-100 text-center p-1">
            <!-- Check if $color and $title are not empty before rendering -->
            <?php if (!empty($color) && !empty($title)): ?>
                <div class="color_primary_bg mb-2 w-100" style="background-color: <?php echo $color; ?>;">
                    <h4 class="mb-0 pt-lg-3 pt-3 coupon_title coupon_offer"><?php echo $title; ?></h4>
                    
                    <!-- Check if $noexpiry is not set to 1 before rendering -->
                    <?php if ($noexpiry != 1 && !empty($date)): ?>
                        <span class="pt-lg-3 pt-2 d-block coupon_expiry">expires <?php echo $date; ?></span>
                    <?php endif; ?>

                    <div class="collapse bg-transparent border-0" id="collapseExample21">
                        <div class="card card-body bg-transparent border-0">

                            <!-- Check if $heading is not empty before rendering -->
                            <?php if (!empty($heading)): ?>
                                <span class="d-lg-block d-none text-center py-2 px-lg-0 px-2 pt-2 my-lg-1 coupon_subtitle coupon_heading"><?php echo $heading; ?></span>
                            <?php endif; ?>
                            
                            <!-- Check if $subheading is not empty before rendering -->
                            <?php if (!empty($subheading)): ?>
                                <span class="d-block text-center py-2 px-lg-0 px-2 coupon_sub_heading"><?php echo $subheading; ?></span>
                            <?php endif; ?>
                            
                            <!-- Check if $more_info is not empty before rendering -->
                            <?php if (!empty($more_info)): ?>
                                <span class="d-block text-center px-lg-0 px-3 pt-lg-0 pt-2 coupon_disclaimer"><?php echo $more_info; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <a class="mw-150 text-uppercase font_alt_1 text_18 line_height_23 mh-33 text_semibold text_semibold_hover mb-4 d-inline-flex align-items-center justify-content-center no_hover_underline promotionC_icon" data-bs-toggle="collapse" href="#collapseExample21" role="button" aria-expanded="false" aria-controls="collapseExample21">More info <i class="icon-plus1 ms-4"></i></a>
                </div>
            <?php endif; ?>

            <!-- Check if $requestButtonLink is not empty before rendering -->
            <?php if (!empty($requestButtonLink) || !empty($requestButtonTitle)): ?>
                <a data-bs-toggle="<?php echo empty($requestButtonLink) ? "modal" : ""; ?>" 
                   data-bs-target="<?php echo empty($requestButtonLink) ? "#request_coupon_form" : ""; ?>" 
                   <?php echo empty($requestButtonLink) ? 'onclick="couponButtonClick(this);"' : 'href="' . $requestButtonLink . '"'; ?>
                   <?php echo empty($requestButtonTitle) ? 'aria-label="Request Service"' : 'aria-label="' . $requestButtonTitle . '"'; ?>
                   class="btn btn-secondary w-100 btn-border request_service_button"
                   <?php echo $open_new_tab == 1 ? 'target="_blank"' : ""; ?>>
                   <?php echo empty($requestButtonTitle) ? "Request Service" : $requestButtonTitle; ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php if (!empty($args["globals"]["promotion"]["popup_form_heading"]) && !empty($args["globals"]["promotion"]["popup_gravity_form_id"])): ?>
        <div class="modal fade request_form px-lg-0 px-0 pt-5 pt-md-0 88" id="request_coupon_form" tabindex="-1" role="dialog" data-bs-backdrop="false" data-bs-keyboard="false" aria-labelledby="requestcoupon_Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered px-lg-0 px-2" role="document">
                <div class="modal-content border-0 rounded-0 text-center">
                    <div class="modal-header border-0 p-0">
                        <button type="button" class="close coupon-popup-close position-absolute bg-transparent border-0 pb-0 px-0" data-bs-dismiss="modal" aria-label="Close" style="opacity:1; z-index: 999; color:#fff ;">
                            <i class="icon-xmark1 text_30 line_height_26"></i>
                        </button>
                    </div>
                    <div class="modal-body p-lg-4 p-2 w-100 my-auto mx-auto coupons">
                        <div class="border-dashed-7 pt-lg-4 pb-lg-4 py-4 footer_form_A ui_kit_footer_form elementor-popupform">
                            <h3 class="px-lg-0 px-4"><?php echo $args["globals"]["promotion"]["popup_form_heading"]; ?></h3>
                            <div class="my-md-0 mt-lg-4 mt-3 w-lg-260 mx-auto text-start text-lg-center d-flex align-items-center justify-content-center pb-4 px-lg-0 px-4">
                                <i class="icon-shield-check1 text_30 line_height_30 me-2 position-relative color_primary"></i>
                                <span class="font_alt_1 text_bold text_16 line_height_25 sm_text_16 sm_line_height_30 color_primary"><?php echo $args["globals"]["promotion"]["popup_form_subheading"]; ?></span>
                            </div>
                            <div class="px-lg-5 mx-lg-4 px-4">
                                <?php
                                $form_id = $args["globals"]["promotion"]["popup_gravity_form_id"];
                                echo do_shortcode("[gravityforms id=" . $form_id . " ajax=true]");
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
            <?php
			}
		endwhile;
	}
} ?> 