<?php
/**
 * The template for displaying all single posts
 *
 * @package Understrap
 */
// Exit if accessed directly.
defined("ABSPATH") || exit();
get_header();
$get_rds_template_data_array = RDS_TEMPLATE_DATA;
?>
<main>
    <!-- Subpage banner starts -->
    <?php get_template_part(
    	"global-templates/subpage-hero/subpage-banner-section"
    ); ?>
    <!-- subpage banner ends -->
    <div class="w-100 d-block">
        <div class="d-flex flex-column">
            <div class="d-block order-1 order-lg-1">
                <!-- Subpage content area starts -->
                <div class="container-fluid pt-4  order-1 order-lg-1 pb-lg-5 pb-4 my-2  px-lg-3 px-0">
                    <div class="container pt-lg-3 subpage_full_content pb-lg-5 px-lg-3 px-0">
                        <div class="row pb-lg-5 ">
                            <div class="col-lg-12 ">
                                <a name="Back to blog" href="<?php echo get_permalink(
                                	get_option("page_for_posts")
                                ); ?>" class="no_hover_underline d-inline-flex align-items-center  button  mb-3 back_to_blog">
                                    <i class=" bc_line_height_18 icon-chevron-left2 me-1 position-relative "></i> 
                                    back to Blog 
                                </a>
                                <a name="Back to Ca" href="<?php echo get_home_url(); ?>/careers/" class="no_hover_underline d-inline-flex align-items-center  button  mb-3 back_to_career">
                                    <i class=" bc_line_height_18 icon-chevron-left2 me-1 position-relative "></i> 
                                    Back To Careers 
                                </a>
                            </div>
                            <?php if (have_posts()):
                            	while (have_posts()):
                            		the_post();
                            		get_template_part(
                            			"loop-templates/content",
                            			"single"
                            		);
                            	endwhile;
                            endif; ?>
                            <div class="d-lg-none px-0">
                                <?php echo do_shortcode("[bc-blog-slider]"); ?>
                            </div>
                            <?php get_template_part(
                            	"sidebar-templates/sidebar",
                            	"blogsinglerightsidebar"
                            ); ?>
                        </div>
                    </div>
                </div>
                <!-- Subpage content area ends -->
            </div>
            <div class="d-none d-lg-block order-lg-3 order-2">
                <?php echo do_shortcode("[bc-blog-slider]"); ?>
            </div>
            <!-- <div class="order-3 d-lg-none">
                <div class="container">
                    <div class="py-4">
                        <div class="row">
                            <?php
//get_template_part('sidebar-templates/sidebar', 'blogsinglerightsidebar');
?>
                        </div>
                    </div>
                </div>
            </div> -->
             <div class="order-<?php
            $order_value = isset($get_rds_template_data_array["globals"]["request_service"]["order"]) ? $get_rds_template_data_array["globals"]["request_service"]["order"] : '';
            echo $order_value;
            ?>">
            <?php echo do_shortcode('[elementor-template id="32406"]'); ?>
            </div>

            <?php if (
            	$get_rds_template_data_array["globals"]["company_services"]
            ) {
            	get_template_part(
            		"global-templates/company-services/a",
            		null,
            		$get_rds_template_data_array
            	);
            } ?>
        </div>
    </div>
</main>
<?php get_footer();
