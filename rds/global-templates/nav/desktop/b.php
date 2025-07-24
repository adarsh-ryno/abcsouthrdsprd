<?php
/**
 * navigation B
 */

// Exit if accessed directly.
defined("ABSPATH") || exit();
// $args = RDS_TEMPLATE_DATA;
$nav_class = "d-lg-block";
$template = basename(get_page_template());

if (
    $template == "rds-landing.php" &&
    empty($args["page_templates"]["landing_page"]["announcement_and_nav_toggle"])
) {
    $nav_class = "d-lg-none";
}

$enable_desktop = "";
if (isset($args["globals"]["desktop_schedule_online_button"]["enabled"]) && !$args["globals"]["desktop_schedule_online_button"]["enabled"]) {
    $enable_desktop = "d-none";
}

// var_dump($args);
?>
<div class="container-fluid nav_container_desktop nav_container_desktop_b d-none hide-on-touch <?php echo esc_attr($nav_class); ?>">
    <div class="container">
        <div class="row align-items-center justify-content-end">
            <div class="col-md-9 text-end pe-0 pt-3">
                <nav class="navbar navbar-expand-lg navbar-dark m-auto p-0 w-100">
                    <div id="navbarSupportedContentDesktop" class="navbar-collapse collapse">
                        <?php
                        $menu_args = [
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
                        wp_nav_menu($menu_args);
                        ?>
                    </div>
                </nav>
            </div>
            <?php if (
                !empty($args["globals"]["desktop_schedule_online_button"]["enabled"]) &&
                $args["globals"]["desktop_schedule_online_button"]["enabled"]
            ) { ?>
                <div class="col-lg-3 mt-n4 text-end <?php echo esc_attr($enable_desktop); ?>">
                    <?php if (
                        !empty($args["globals"]["desktop_schedule_online_button"]["type"]) &&
                        $args["globals"]["desktop_schedule_online_button"]["type"] != "url"
                    ) { ?>
                        <span id="schedule_online_button_desktop" class="btn btn-primary mw-242 mh-43">
                            <i class="<?php echo esc_attr($args["globals"]["desktop_schedule_online_button"]["icon_class"]); ?>"></i>
                            <?php echo esc_html($args["globals"]["desktop_schedule_online_button"]["label"]); ?>
                        </span>
                    <?php } else { ?>
                        <a class="btn btn-primary mw-242 mh-43 no_hover_underline" href="<?php echo esc_url(get_home_url() . $args["globals"]["desktop_schedule_online_button"]["url"]); ?>">
                            <i class="<?php echo esc_attr($args["globals"]["desktop_schedule_online_button"]["icon_class"]); ?>"></i>
                            <?php echo esc_html($args["globals"]["desktop_schedule_online_button"]["label"]); ?>
                        </a>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
