<?php
if (function_exists("get_promotion_query")) {
	$get_rds_template_data_array = RDS_TEMPLATE_DATA;
	$promotion_type = get_post_meta(get_the_ID(), "promotion_type", true);
	$noexpiry = get_post_meta(get_the_ID(), "promotion_noexpiry", true);
	$colorCode = get_post_meta(get_the_ID(), "promotion_color", true);
	$date = get_post_meta(get_the_ID(), "promotion_expiry_date1", true);
	if (
		strtotime($date) >= strtotime(current_time("m/d/Y")) ||
		$noexpiry == 1
	) {

		$title = get_post_meta(get_the_ID(), "promotion_title1", true);
		$color = get_post_meta(get_the_ID(), "promotion_color", true);
		$subheading = get_post_meta(get_the_ID(), "promotion_subheading", true);
		$heading = get_post_meta(get_the_ID(), "promotion_heading", true);
		$footer_heading = get_post_meta(
			get_the_ID(),
			"promotion_footer_heading",
			true
		);
		?>
    <div class="<?php echo $get_rds_template_data_array["page_templates"][
    	"promotions"
    ]["subpage_sidebar"] == true
    	? "col-lg-6 mb-lg-5 mb-4 pb-lg-3"
    	: "col-lg-4 mb-lg-5 mb-4"; ?> ">
        <div class="h-coupan-100 color_primary_bg p-lg-3 p-3" style="background-color: <?php echo $colorCode; ?>;">
            <div class="coupon_name  border-dashed-3 border-lg-dashed-5 h-coupan-100 py-4 p-4 px-lg-0 text-center">
                <span class="d-block text-center px-lg-0 px-3 pt-lg-0 pt-2  coupon_subtitle  coupon_heading"><?php echo $heading; ?></span>
                <span class="d-block text-center py-2 px-lg-0 px-2 pt-lg-0 pt-2 my-lg-1 coupon_sub_heading"><?php echo $subheading; ?></span>
                <h4 class="mb-0 pb-lg-3 pt-lg-0 py-3 coupon_title coupon_offer"><?php echo $title; ?></h4>
                <a data-bs-toggle="modal" data-bs-target="#request_coupon_form" onclick="couponButtonClick(this);" class="btn btn-secondary mw-226">Request Service <i class="icon-chevron-right text_18 line_height_18 ms-2"></i></a>
                <span class="pt-lg-3 pt-2 d-block coupon_expiry"><?php if (
                	$noexpiry != 1
                ) {
                	echo "Expires " . $date;
                } ?></span><span class="d-block coupon_disclaimer"><?php echo $footer_heading; ?></span>
            </div>
        </div>
    </div>
    <?php
	}
}
?>
