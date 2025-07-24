<?php
/**
 * The template for displaying search results pages
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined("ABSPATH") || exit();

get_header();
$get_rds_template_data_array = RDS_TEMPLATE_DATA;
?>

<main>
    <?php echo do_shortcode('[elementor-template id="39819"]'); ?>

    <div class="w-100 d-block">
        <div class="d-flex flex-column">
            <div class="d-block ">
                <!-- Subpage content area starts -->
                <div class="container-fluid pt-4 pb-lg-0 pb-4 my-2  px-lg-3 px-0 page_content">
                    <div class="container subpage_full_content pb-lg-5">
                        <div class="row pt-lg-4 pb-lg-4 ">
                            <div class="col-12">
                               
                                <?php get_template_part(
                                	"sidebar-templates/search",
                                	"blogtopbar"
                                ); ?>
                                 <?php printf(
                                 	esc_html__(
                                 		"Search Results for: %s",
                                 		"understrap"
                                 	),
                                 	"<span>" . get_search_query() . "</span>"
                                 ); ?>
                                <div class="row ">
                                    <?php if (have_posts()):
                                    	while (have_posts()):
                                    		the_post();
                                    		get_template_part(
                                    			"loop-templates/content",
                                    			get_post_format()
                                    		);
                                    	endwhile;
                                    else:
                                    	get_template_part(
                                    		"loop-templates/content",
                                    		"none"
                                    	);
                                    endif; ?>                 
                                </div>
                                <div class="d-flex align-items-center justify-content-center mt-5 pt-3"><?php understrap_pagination(
                                	[
                                		"prev_text" =>
                                			'<i class="icon-angles-left4"></i>',
                                		"next_text" =>
                                			'<i class="icon-angles-right4"></i>',
                                	]
                                ); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Subpage content area ends -->
            </div>
            <?php echo do_shortcode('[elementor-template id="32406"]'); ?> 
            <?php echo do_shortcode('[elementor-template id="39286"]'); ?>
        </div>
    </div>
</main>

<?php get_footer();
