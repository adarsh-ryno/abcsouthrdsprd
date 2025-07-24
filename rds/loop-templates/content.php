<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package Understrap
 */
// Exit if accessed directly.
defined("ABSPATH") || exit();
global $rdsTemplateDataGlobal;
        $args = $rdsTemplateDataGlobal;
if (isset($args["globals"]["blog"]["variation"]) && $args["globals"]["blog"]["variation"] == "a") { ?>
<div class="col-lg-4 col-md-6 mb-4 pb-2 pt-4">
    <div class="card border-0 rounded-0 p-0 position-relative blogs h-100">
        <a href="<?php echo get_permalink(); ?>" name="<?php echo get_the_title(); ?>" class="no_hover_underline no-underline">            
            <div class="blog_img_container mb-4"><img src="<?php echo post_content_first_image(); ?>" class="blog_img  img-fluid w-100" alt="Blog Thumbnail" width="350" height="200"></div>               
            <div class="card-body px-0 py-0">
                <h5 class="mb-0 pb-3"><?php echo get_the_title(); ?></h5>
                <p>
                <?php
                $my_content = wp_strip_all_tags(get_the_excerpt());
                echo wp_trim_words($my_content, 25) .
                	(!is_admin() ? "..." : "");
                ?>
                </p>
                <span class="no_hover_underline w-100 d-inline-flex align-items-center   mb-3 position-absolute lessthenfour blog_read_more_text_color" style="bottom: -40px">
                    <span class="continue blog_read_more_text_color text-uppercase text_18 line_height_23 text_semibold"> Keep Reading <i class="bc_line_height_18 icon-chevron-right2 ms-1 position-relative "></i></span> 
                </span>
            </div>
        </a>
    </div>
</div>
<?php } else { ?>
<div class="col-lg-4 col-md-6 mb-4 pb-2 pt-4">
                                            <div class="card border-0 rounded-0 p-0 position-relative blogs h-100">
                                                <a href="<?php echo get_permalink(); ?>" class="no_hover_underline no-underline">
                                                    <div class="blog_img_container mb-4">
                                                        <img src="<?php echo post_content_first_image(); ?>" class="blog_img  img-fluid w-100" alt="blog-thumbnail" width="350" height="200">
                                                    </div>
                                                    <div class="card-body px-0 py-0">
                                                        <h5 class="mb-0 pb-3"><?php echo get_the_title(); ?></h5>
                                                        <p>
                                                        <?php
                                                        $my_content = wp_strip_all_tags(
                                                        	get_the_excerpt()
                                                        );
                                                        echo wp_trim_words(
                                                        	$my_content,
                                                        	25
                                                        ) .
                                                        	(!is_admin()
                                                        		? "..."
                                                        		: "");
                                                        ?>

                                                        </p>
                                                        <span class="no_hover_underline w-100 d-inline-flex align-items-center text_semibold text-uppercase text_18 line_height_23 font_alt_1 mb-3 blog_read_more_text_color"><span class="continue blog_read_more_text_color"> Keep Reading <i class=" bc_text_18 bc_line_height_18 icon-chevron-right2 ms-1 position-relative "></i></span> 
                                                        </span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
<?php }
?> 