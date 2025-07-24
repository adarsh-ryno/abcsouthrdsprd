<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package Understrap
 */
// Exit if accessed directly.
defined("ABSPATH") || exit();
$gallery_img = get_post_meta(get_the_ID(), "gallery_images", true);
$gallery_img_arr = json_decode($gallery_img);
$alt = "";
?>
<div class="col-lg-4 col-md-6 pb-30 268 lightbox cursor-pointer" data-bs-toggle="modal" data-bs-target="#Gallery-lightBox">
    <div class="gallery_link ">
        <div class="rounded-0 border-10 position-relative" >        
            <img class="m-auto d-block w-100 h-auto img-border" src="<?php echo $gallery_img_arr[0]
            	->image; ?>"   alt="<?php echo $alt; ?>">          
            <div class="overlay position-absolute h-100 w-100 d-flex align-items-center justify-content-center">
                <div class="text position-absolute text-center">
                    <i class="p-alt icon-magnifying-glass1  text_50 line_height_24 mx-auto"></i>
                </div>
            </div>  
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-8"><h3><?php echo get_the_title(); ?></h3></div>
        <div class="col-4 text-end  "><i class="bc_line_height_24 text_16 icon-arrow-right1 ms-1 position-relative true_black"></i></div>
</div>
</div>