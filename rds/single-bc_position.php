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
die();
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
                                <a name="back to CAREER" href="<?php echo wp_get_referer(); ?>" class="no_hover_underline d-inline-flex align-items-center text_semibold text_semibold_hover text-uppercase text_18 line_height_23 font_alt_1 mb-3 ">
                                    <i class=" bc_text_18 bc_line_height_18 icon-chevron-left2 me-1 position-relative "></i> 
                                    back to CAREER
                                </a>
                            </div>
                            <?php if (have_posts()):
                            	while (have_posts()):
                            		the_post();
                            		get_template_part(
                            			"loop-templates/content",
                            			"position"
                            		);
                            	endwhile;
                            endif; ?>
                            <?php get_template_part(
                            	"sidebar-templates/sidebar",
                            	"subpagerightsidebar"
                            ); ?>
                        </div>
                    </div>
                </div>
                <!-- Subpage content area ends -->
            </div>
            <?php
//echo do_shortcode('[bc-blog-slider]');
?>
            <?php
            if (
            	$get_rds_template_data_array["globals"]["request_service"][
            		"variation"
            	] == "a"
            ) {
            	get_template_part(
            		"global-templates/request-service/a",
            		null,
            		$get_rds_template_data_array
            	);
            } elseif (
            	$get_rds_template_data_array["globals"]["service_area"][
            		"variation"
            	] == "b"
            ) {
            	get_template_part(
            		"global-templates/request-service/b",
            		null,
            		$get_rds_template_data_array
            	);
            } elseif (
            	$get_rds_template_data_array["globals"]["service_area"][
            		"variation"
            	] == "c"
            ) {
            	get_template_part(
            		"global-templates/request-service/c",
            		null,
            		$get_rds_template_data_array
            	);
            }
            if ($get_rds_template_data_array["globals"]["company_services"]) {
            	get_template_part(
            		"global-templates/company-services/a",
            		null,
            		$get_rds_template_data_array
            	);
            }
            ?>
        </div>
    </div>
</main>
<?php get_footer();
