<?php
$message = get_post_meta(get_the_ID(), "testimonial_message", true);
$name = get_post_meta(get_the_id(), "testimonial_name", true);
$heading = get_post_meta(get_the_id(), "testimonial_heading", true);
?>
<div class="pb-lg-4 pe-lg-2 pt-lg-2 ms-3 mb-5 review_b">
    <div class="border-left-secondary py-lg-5 py-3 px-lg-0 px-3 shadow position-relative">
        <div class="review-quote-icon d-flex top-n18 left-n20  w-35 h-35 justify-content-center color_secondary_bg rounded-circle position-absolute align-items-center position-absolute"><i class="p-alt icon-quote-left1   line_height_18 text_18  "></i></div>
        <div class="row align-items-lg-center">
            <div class="col-lg-10 border-lg-right-1">
                <p class="pb-3 ps-lg-4 "><?php echo $message; ?></p>
            </div>
            <div class="col-lg-2">
                <div class="slide-icon  align-items-center pb-lg-0 pb-2 d-flex justify-content-start ps-lg-2">
                    <i class="icon-star1 stars_color text_12 line_height_12 me-1"></i>
                    <i class="icon-star1 stars_color text_12 line_height_12 me-1"></i>
                    <i class="icon-star1 stars_color text_12 line_height_12 me-1"></i>
                    <i class="icon-star1 stars_color text_12 line_height_12 me-1"></i>
                    <i class="icon-star1 stars_color text_12 line_height_12 me-0"></i>
                </div>
                <strong class="d-block text_16 line_height_26_4 px-lg-2 text_bold"><?php echo $name; ?></strong>
                 <strong class="d-block text_16 line_height_26_4 px-lg-2"><?php echo $heading; ?></strong>
            </div>
        </div>
    </div>
</div>