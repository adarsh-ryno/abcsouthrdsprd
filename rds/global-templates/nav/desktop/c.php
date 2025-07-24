<?php
/**
 * navigation C
 */

// Exit if accessed directly.
defined("ABSPATH") || exit();
$get_rds_template_data_array = RDS_TEMPLATE_DATA;
$nav_class = "d-lg-block";
$template = basename(get_page_template());

if (
    $template == "rds-landing.php" &&
    (!isset($get_rds_template_data_array["page_templates"]["landing_page"]["announcement_and_nav_toggle"]) || 
    empty($get_rds_template_data_array["page_templates"]["landing_page"]["announcement_and_nav_toggle"]))
) {
    $nav_class = "d-lg-none";
}
?>
<div class="container-fluid nav_container_desktop nav_container_desktop_c d-none hide-on-touch <?php echo esc_attr($nav_class); ?>">
    <div class="container">
        <div class="row">
            <div class="col-md-12 pl-0 text-right">
                <nav class="navbar navbar-expand-lg navbar-dark m-auto p-0 w-100">
                    <div id="navbarSupportedContentDesktop" class="navbar-collapse collapse">
                        <?php
                        $args = [
                            "menu" => "main-menu",
                            "depth" => 3,
                            "theme_location" => "primary",
                            "container" => false,
                            "container_class" => "collapse navbar-collapse",
                            "container_id" => "navbarSupportedContentDesktop",
                            "menu_class" => "navbar-nav mx-auto ms-auto",
                            "fallback_cb" => "Bluecorona_WP_Bootstrap_Navwalker::fallback",
                            "walker" => new Bluecorona_WP_Bootstrap_Navwalker(),
                        ];
                        wp_nav_menu($args);
                        ?>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
