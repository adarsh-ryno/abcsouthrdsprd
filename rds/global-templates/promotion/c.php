 <?php if (function_exists("get_promotion_query")) {
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
 		$subheading = get_post_meta(
 			get_the_ID(),
 			"promotion_subheading",
 			true
 		);
 		$heading = get_post_meta(get_the_ID(), "promotion_heading", true);
 		$footer_heading = get_post_meta(
 			get_the_ID(),
 			"promotion_footer_heading",
 			true
 		);
 		$more_info = get_post_meta(get_the_ID(), "promotion_more_info", true);
 		?>
    <div class="<?php echo $get_rds_template_data_array["page_templates"][
    	"promotions"
    ]["subpage_sidebar"] == true
    	? "col-lg-6 mb-lg-5 mb-4 pb-lg-3"
    	: "col-lg-4 mb-lg-5 mb-4"; ?>">
        <div class="h-auto border-quaternary-dashed p-2">
            <div class="coupon_name promotion_c h-coupan-100 text-center">
                <div class="color_primary_bg mb-2 w-100  h-coupan-100" style="background-color: <?php echo $color; ?>;">
                    <h4 class="mb-0 pt-lg-3 pt-3 coupon_title coupon_offer"><?php echo $title; ?></h4>
                    <span class="pt-lg-3 pt-2 d-block coupon_expiry"><?php if (
                    	$noexpiry != 1
                    ) {
                    	echo "expires " . $date . "<br>";
                    } ?></span>
                   
                    <div class="collapse bg-transparent border-0" id="collapseExample<?php echo get_the_ID(); ?>">
                        <div class="card card-body bg-transparent border-0">
                            
                            
                            <span class="d-block text-center coupon_heading py-2 px-lg-0 px-2 pt-2 my-lg-1"><?php echo $heading; ?></span>
                            <span class="d-block text-center  py-2 px-lg-0 px-2 coupon_sub_heading "><?php echo $subheading; ?></span>
                            <span class="d-block text-center px-lg-0 px-3 pt-lg-0 pt-2  coupon_disclaimer"><?php echo $footer_heading .
                            	$more_info; ?></span>

                        </div>
                    </div>
                     <a  class="mw-150 text-uppercase font_alt_1 text_18 line_height_23 mh-33 text_semibold text_semibold_hover d-inline-flex align-items-center justify-content-center no_hover_underline mb-4 promotionC_icon" data-bs-toggle="collapse" href="#collapseExample<?php echo get_the_ID(); ?>" role="button" aria-expanded="false" aria-controls="collapseExample<?php echo get_the_ID(); ?>">More info <i class="icon-plus1 ms-4"></i></a>
                </div>
                <a data-bs-toggle="modal" data-bs-target="#request_coupon_form" onclick="couponButtonClick(this);" class="btn btn-secondary w-100 btn-border">Request Service </a>
            </div>
        </div>
    </div>
    <?php
 	}
 }
?>
