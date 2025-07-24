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
    <div class="h-auto border-quaternary-dashed p-lg-2 p-3">
        <div class="coupon_name color_primary_bg h-100 py-4 p-4 px-lg-0 text-center" style="background-color: <?php echo !empty($colorCode) ? $colorCode : '#ffffff'; ?>;">
            <?php if (!empty($heading)) : ?>
                <span class="d-block text-center px-lg-0 px-3 pt-lg-0 pt-2 coupon_subtitle coupon_heading"><?php echo $heading; ?></span>
            <?php endif; ?>

            <?php if (!empty($subheading)) : ?>
                <span class="d-block text-center py-2 px-lg-0 px-2 pt-2 my-lg-1 coupon_sub_heading"><?php echo $subheading; ?></span>
            <?php endif; ?>

            <?php if (!empty($title)) : ?>
                <h4 class="mb-0 py-3 coupon_title coupon_offer"><?php echo $title; ?></h4>
            <?php endif; ?>

            <?php if (!empty($requestButtonLink) || !empty($requestButtonTitle)) : ?>
                <a data-bs-toggle="<?php echo empty($requestButtonLink) ? 'modal' : ''; ?>"
                   data-bs-target="<?php echo empty($requestButtonLink) ? '#request_coupon_form' : ''; ?>"
                   <?php echo empty($requestButtonLink) ? 'onclick="couponButtonClick(this);"' : 'href="' . $requestButtonLink . '"'; ?>
                   <?php echo empty($requestButtonTitle) ? 'aria-label="Request Service"' : 'aria-label="' . $requestButtonTitle . '"'; ?>
                   class="btn btn-secondary mw-226 request_service_button"
                   <?php echo !empty($open_new_tab) && $open_new_tab == 1 ? 'target="_blank"' : ''; ?>>
                   <?php echo empty($requestButtonTitle) ? 'Request Service' : $requestButtonTitle; ?>
                   <i class="icon-chevron-right text_18 line_height_18 ms-2"></i>
                </a>
            <?php endif; ?>

            <?php if (!empty($date) && $noexpiry != 1) : ?>
                <span class="pt-lg-3 pt-2 d-block px-3 coupon_expiry">Expires <?php echo $date; ?></span>
            <?php endif; ?>

            <?php if (!empty($footer_heading)) : ?>
                <span class="d-block coupon_disclaimer"><?php echo $footer_heading; ?></span>
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
		endwhile; ?>
    <?php
	}
} ?> 