<?php
/**
 * Single Job Position partial template
 *
 * @package Understrap
 */
// Exit if accessed directly.
defined("ABSPATH") || exit(); ?>
<div class="col-12 col-lg-8">
    <h1 class="mb-5"><?php the_title(); ?></h1>
    <?php
    if (has_post_thumbnail()) {
    	$image = wp_get_attachment_image_src(
    		get_post_thumbnail_id(),
    		"single-post-thumbnail"
    	);
    	$get_image_id = attachment_url_to_postid($image[0]);
    	$alt = get_post_meta($get_image_id, "_wp_attachment_image_alt", true);
    	if (empty($alt)) {
    		$alt = "blog detail";
    	}
    }
    the_content();
    ?>
</div>