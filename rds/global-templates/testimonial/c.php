<?php
$message = get_post_meta(get_the_ID(), "testimonial_message", true);
$name = get_post_meta(get_the_id(), "testimonial_name", true);
$heading = get_post_meta(get_the_id(), "testimonial_heading", true);
?>
<div class="shadow bg-white border-top-secondary p-4 text-center mb-6">
    <p class="mb-0 pb-4 px-lg-2 mx-lg-1"><?php echo $message; ?></p>
    <div class="slide-icon align-items-center  d-flex justify-content-center pb-1">
        <i class="icon-star1 stars_color text_15 line_height_15  me-1"></i>
        <i class="icon-star1 stars_color text_15 line_height_15  me-1"></i>
        <i class="icon-star1 stars_color text_15 line_height_15  me-1"></i>
        <i class="icon-star1 stars_color text_15 line_height_15  me-1"></i>
        <i class="icon-star1 stars_color text_15 line_height_15  mr-0"></i>
    </div>
    <strong class="d-block  text_16 line_height_26_4 text_bold"><?php echo $name; ?></strong>
    <p><strong class="d-block  text_16 line_height_26_4"><?php echo $heading; ?></strong></p>
</div>