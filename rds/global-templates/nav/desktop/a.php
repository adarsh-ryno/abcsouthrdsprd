<?php
/**
 * navigation A
 */

// Exit if accessed directly.
defined("ABSPATH") || exit();

if (function_exists('rds_template')) {
    $get_rds_template_data_array = RDS_TEMPLATE_DATA;
}

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
<div class="nav_container_desktop nav_container_desktop_a d-none hide-on-touch <?php echo esc_attr($nav_class); ?>">
    <div class="">
        <div class="">
            <div class="pl-0 text-right pt-1">
                <nav class="navbar navbar-expand-lg navbar-dark m-auto px-0 pb-0 pt-2 w-100">
                    <div id="navbarSupportedContentDesktop" class="navbar-collapse collapse" style="">
                        <?php
                        $args = [
                            "menu" => "main-menu",
                            "depth" => 3,
                            "theme_location" => "primary",
                            "container" => false,
                            "container_class" => "collapse navbar-collapse",
                            "container_id" => "navbarSupportedContentDesktop",
                            "menu_class" => "navbar-nav my-auto ms-auto flex-wrap justify-content-end",
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
