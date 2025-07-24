<?php
/* Blog Single Page slider Shortcode : [bc-blog-slider] [bc-blog-slider id='1,2,3'] */
add_shortcode("bc-blog-slider", "bc_blog_slider_shortcode");

function bc_blog_slider_shortcode($atts, $content = null)
{
	$Ids = null;
	$args = [
		"post_type" => "post",
		"posts_per_page" => 3,
		"order" => "DESC",
		"post_status" => "publish",
	];
	if (isset($atts["id"])) {
		$Ids = explode(",", $atts["id"]);
		$postIds = $Ids;
		$args["post__in"] = $postIds;
	}
	?>
    <div class="color_quaternary_bg order-lg-2 order-2 py-lg-5 py-5 recent_post">
        <div class="container">
            <div class="pt-lg-5 pt-4">
                <div class="row">
                    <div class="col-lg-12"><h4 class="mb-4 pb-lg-3">Recent Posts</h4></div>
                    <?php
                    $query = new WP_Query($args);
                    if ($query->have_posts()):
                    	while ($query->have_posts()):
                    		$query->the_post(); ?>
                            <div class="col-lg-4 col-md-4 mb-4 pb-2 pt-4">
                                <div class="border-0 rounded-0 p-0 position-relative blogs h-100">
                                    <a name="Keep reading blog" href="<?php echo get_permalink(); ?>" class="no_hover_underline no-underline">
                                           <div class="blog_img_container mb-4"> <img class="blog_img  img-fluid" alt="blog-thumbnail" width="350" height="200" src="<?php echo post_content_first_image(); ?>" > </div>
                                        <div class="card-body px-0 py-0">
                                            <h5 class="pb-4 mb-4 border-bottom-2"> 
                                                <?php echo get_the_title(); ?>
                                            </h5>                                   
                                        </div>
                                        <span class="no_hover_underline a w-100 d-inline-flex align-items-center text_semibold  text-uppercase text_semibold_hover text_18 line_height_23 font_alt_1 mb-3 position-absolute continue text-uppercase" style="bottom: -40px"> 
                                            Keep Reading 
                                            <i class=" bc_text_18 bc_line_height_18 icon-chevron-right2 ms-1 position-relative "></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <?php
                    	endwhile;
                    	wp_reset_query();
                    endif;?>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
