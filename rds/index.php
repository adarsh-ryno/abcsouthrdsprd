<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Understrap
 */
// Exit if accessed directly.
defined("ABSPATH") || exit();
get_header();
$get_rds_template_data_array = RDS_TEMPLATE_DATA;
?>

<main>
    <?php get_template_part(
    	"global-templates/subpage-hero/subpage-banner-section"
    ); ?>

    <div class="w-100 d-block">
        <div class="d-flex flex-column">
            <div class="d-block ">
                <!-- Subpage content area starts -->
                <div class="container-fluid pt-4 pb-lg-0 pb-4 my-2  px-lg-3 px-0 page_content">
                    <div class="container subpage_full_content pb-lg-5 ">
                        <div class="row pt-lg-4 pb-lg-4 ">
                            <div class="col-12">
                                <h1><?php single_post_title(); ?></h1>
                                <?php get_template_part(
                                	"sidebar-templates/search",
                                	"blogtopbar"
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
            <?php
// Check and handle request_service variation
if (
    isset($get_rds_template_data_array["globals"]["request_service"]["variation"]) &&
    $get_rds_template_data_array["globals"]["request_service"]["variation"] == "a"
) {
    get_template_part(
        "global-templates/request-service/a",
        null,
        $get_rds_template_data_array
    );
} elseif (
    isset($get_rds_template_data_array["globals"]["service_area"]["variation"]) &&
    $get_rds_template_data_array["globals"]["service_area"]["variation"] == "b"
) {
    get_template_part(
        "global-templates/request-service/b",
        null,
        $get_rds_template_data_array
    );
} elseif (
    isset($get_rds_template_data_array["globals"]["service_area"]["variation"]) &&
    $get_rds_template_data_array["globals"]["service_area"]["variation"] == "c"
) {
    get_template_part(
        "global-templates/request-service/c",
        null,
        $get_rds_template_data_array
    );
}

// Check and handle company_services
if (
    isset($get_rds_template_data_array["globals"]["company_services"]) &&
    !empty($get_rds_template_data_array["globals"]["company_services"])
) {
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
