<?php
$message = get_post_meta(get_the_ID(), "testimonial_message", true);
$heading = get_post_meta(get_the_id(), "testimonial_heading", true);
?>
<div class="shadow position-relative review_a px-lg-4 py-lg-2 mb-5">
    <p class="p-lg-4 p-3 mx-lg-4 text-center"><?php echo $message; ?></p>
    <p class="p-lg-4 p-3 mx-lg-4 text-center"><?php echo $heading; ?></p>
    
</div>