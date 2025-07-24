<?php
if (function_exists('rds_template')) {
    $get_rds_template_data_array = RDS_TEMPLATE_DATA;
}
require_once "type_A_navwalker.php";

// function mobile_nav_type_A_init($attrs){
$searchForm = isset($attrs["search_form"]) ? $attrs["search_form"] : "false";
$searchFormType = gettype($searchForm);
$closeIconClass = "icon-xmark";
if (isset($attrs["close_icon_class"]) && !in_array($attrs["close_icon_class"], [null, false, ""])) {
    $closeIconClass = $attrs["close_icon_class"];
}
if (!empty($attrs["dropdown_icon_up"]) && !empty($attrs["dropdown_icon_down"])) {
    $dropdown_icon_up = $attrs["dropdown_icon_up"];
    $dropdown_icon_down = $attrs["dropdown_icon_down"];
} else {
    $dropdown_icon_up = "icon-chevron-up";
    $dropdown_icon_down = "icon-chevron-down";
}
$button_class = "";
$template = basename(get_page_template());
if ($template == "rds-landing.php" && isset($args["page_templates"]["landing_page"]["announcement_and_nav_toggle"]) && $args["page_templates"]["landing_page"]["announcement_and_nav_toggle"] == false) {
    $button_class = "d-none";
}
?>
<div class="container-fluid bc_nav_container_mobile d-lg-none ui_kit_mobile_nav mobile_nav_type_A">
    <div class="level-3-background"></div>
    <div class="container px-0">
        <nav class="navbar navbar-expand-lg m-auto d-table w-100 p-0">
            <div id="navbarSupportedContent" class="navbar-collapse collapse">      
                <div class="pb-3 nav-header">
                    <div class="row row-eq-height align-items-center pt-3" style="margin-top: 2px;">
                        <div class="col-2 ps-1 align-self-center">
                            <button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler <?php echo $button_class; ?>" data-bs-target="#navbarSupportedContent" data-bs-toggle="collapse" type="button">
                                <i class="icon-xmark1 close_icon true_black text_24 line_height_24"></i>
                            </button>
                        </div>
                        <div class="col-7 px-0 text-center">
                            <a href="<?php echo get_site_url(); ?>"> 
                                <img loading="eager" fetchpriority="high" 
                                     src="<?php echo get_exist_image_url("header", "m-header-logo"); ?>" 
                                     srcset="<?php echo get_exist_image_url("header", "m-header-logo"); ?> 1x, 
                                             <?php echo get_exist_image_url("header", "m-header-logo@2x"); ?> 2x, 
                                             <?php echo get_exist_image_url("header", "m-header-logo@3x"); ?> 3x" 
                                     width="200" height="40" 
                                     style="max-width: 200px" 
                                     class="img-fluid w-atuo" 
                                     alt="site mobile logo">
                            </a> 
                        </div>
                        <?php if ($searchForm == "true" && !empty($searchForm)) { ?>
                        <div class="col-12">
                            <div class="nav-search">
                                <?php require_once "type_A_search.php"; ?>
                            </div>
                        </div>
                        <?php } elseif (!in_array($searchForm, ["true", "false"]) && !empty($searchForm)) { ?>
                        <div class="col-12">
                            <div class="nav-search">
                                <?php get_search_form($searchForm); ?>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="py-3 nav-header-level-3">
                    <button class="navbar-toggler p-0 py-2 close-level-3" type="button">
                        <i class="icon-chevron-left2 me-2 text_21"></i> Back
                    </button>
                </div>
                <div class="mobile_buttons px-3">
                    <?php if (!empty($get_rds_template_data_array["globals"]["announcement"]["left"]["type"]) && $get_rds_template_data_array["globals"]["announcement"]["left"]["type"] == "link") { ?>
                        <a href="<?php echo get_home_url() . $get_rds_template_data_array["globals"]["announcement"]["left"]["url"]; ?>" class="color_tertiary_bg d-flex w-100 align-items-center announcment_bar_text justify-content-start me-auto py-3 pe-3 ps-3 mb-2">
                            <i class="<?php echo $get_rds_template_data_array["globals"]["announcement"]["left"]["icon_class"]; ?> text_16 line_height_16 me-2"></i> 
                            <?php echo $get_rds_template_data_array["globals"]["announcement"]["left"]["text"]; ?> 
                            <i class="icon-chevron-right1 ms-auto text_15 line_height_15"></i>
                        </a>
                    <?php } else { ?>
                        <div class="color_tertiary_bg mb-2 header_accordion" id="accordionExample1">
                            <div class="accordion-item border-0 rounded-0">
                                <h2 class="accordion-header border-0" id="headingOne">
                                    <button class="accordion-button border-0 rounded-0 collapsed color_tertiary_bg d-flex w-100 align-items-center announcment_bar_text justify-content-start me-auto py-3 pe-3 ps-3" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        <i class="<?php echo $get_rds_template_data_array["globals"]["announcement"]["left"]["icon_class"]; ?> text_16 line_height_16 me-2"></i> 
                                        <?php echo $get_rds_template_data_array["globals"]["announcement"]["left"]["text"]; ?> 
                                        <i class="icon-chevron-right1 ms-auto text_15 line_height_15 icon_right"></i>
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body color_quaternary_bg">
                                        <?php echo $get_rds_template_data_array["globals"]["announcement"]["left"]["tooltip_text"]; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?> 

                    <?php if (!empty($get_rds_template_data_array["globals"]["announcement"]["variation"]) && $get_rds_template_data_array["globals"]["announcement"]["variation"] == "a") { ?>
                        <a href="<?php echo get_home_url() . $get_rds_template_data_array["globals"]["announcement"]["middle"]["url"]; ?>" class="color_tertiary_bg w-100 d-flex align-items-center announcment_bar_text py-3 pe-3 ps-3 mb-2">
                            <i class="<?php echo $get_rds_template_data_array["globals"]["announcement"]["middle"]["icon_class"]; ?> text_16 line_height_16 me-1 stars_color"></i>
                            <i class="<?php echo $get_rds_template_data_array["globals"]["announcement"]["middle"]["icon_class"]; ?> text_16 line_height_16 me-1 stars_color"></i>
                            <i class="<?php echo $get_rds_template_data_array["globals"]["announcement"]["middle"]["icon_class"]; ?> text_16 line_height_16 me-1 stars_color"></i>
                            <i class="<?php echo $get_rds_template_data_array["globals"]["announcement"]["middle"]["icon_class"]; ?> text_16 line_height_16 me-1 stars_color"></i>
                            <i class="<?php echo $get_rds_template_data_array["globals"]["announcement"]["middle"]["icon_class"]; ?> text_16 line_height_16 me-1 stars_color"></i>
                            <span class="no_hover_underline d-flex align-items-center w-100 ms-1 text_normal"><?php echo $get_rds_template_data_array["globals"]["announcement"]["middle"]["text"]; ?> <i class="icon-chevron-right1 ms-auto"></i></span>
                        </a>
                    <?php } else {
                        if (!empty($get_rds_template_data_array["globals"]["announcement"]["desktop_schedule_online_button"]["enabled"]) && $get_rds_template_data_array["globals"]["announcement"]["desktop_schedule_online_button"]["enabled"] == true) {
                            if (!empty($get_rds_template_data_array["globals"]["announcement"]["desktop_schedule_online_button"]["type"]) && $get_rds_template_data_array["globals"]["announcement"]["desktop_schedule_online_button"]["type"] != "url") { ?>
                                <span id="schedule_online_button_desktop" class="color_tertiary_bg w-100 d-flex align-items-center announcment_bar_text cursor-pointer py-3 pe-3 ps-3 mb-2">
                                    <i class="<?php echo $get_rds_template_data_array["globals"]["announcement"]["desktop_schedule_online_button"]["icon_class"]; ?> text_16 line_height_16 me-1 px-1"></i>
                                    <?php echo $get_rds_template_data_array["globals"]["announcement"]["desktop_schedule_online_button"]["label"]; ?> 
                                    <i class="icon-chevron-right1 ms-auto"></i>
                                </span>
                            <?php } else { ?>
                                <a class="color_tertiary_bg w-100 d-flex align-items-center announcment_bar_text py-3 pe-3 ps-3 mb-2" href="<?php echo get_home_url() . $get_rds_template_data_array["globals"]["announcement"]["desktop_schedule_online_button"]["url"]; ?>">
                                    <i class="<?php echo $get_rds_template_data_array["globals"]["announcement"]["desktop_schedule_online_button"]["icon_class"]; ?> text_16 line_height_16 me-1 px-1"></i>
                                    <?php echo $get_rds_template_data_array["globals"]["announcement"]["desktop_schedule_online_button"]["label"]; ?> 
                                    <i class="icon-chevron-right1 ms-auto"></i>
                                </a>
                            <?php }
                        }
                    } ?>  

                    <?php if (!empty($get_rds_template_data_array["globals"]["announcement"]["variation"]) && $get_rds_template_data_array["globals"]["announcement"]["variation"] == "a") { ?>
                        <a class="color_tertiary_bg announcment_bar_text w-100 d-flex align-items-center pe-3 ps-3 py-3 mb-2" href="<?php echo get_home_url() . $get_rds_template_data_array["globals"]["announcement"]["right"]["url"]; ?>">
                            <i class="<?php echo $get_rds_template_data_array["globals"]["announcement"]["right"]["icon_class"]; ?> text_16 line_height_16 me-1 pl-2"></i>
                            <span class="no_hover_underline d-flex align-items-center w-100"><?php echo $get_rds_template_data_array["globals"]["announcement"]["right"]["text"]; ?> 
                            <i class="icon-chevron-right1 ms-auto text_15 line_height_15"></i></span>
                        </a>
                    <?php } else { ?>
                        <a class="color_tertiary_bg announcment_bar_text w-100 d-flex align-items-center pl-2 pe-3 ps-3 py-3 mb-2" href="tel:<?php echo $get_rds_template_data_array["site_info"]["country_code"] . $get_rds_template_data_array["site_info"]["phone"]; ?>">
                            <i class="<?php echo $get_rds_template_data_array["globals"]["announcement"]["right"]["icon_class"]; ?> text_16 line_height_16 me-1"></i>
                            <span class="no_hover_underline d-flex align-items-center w-100"><?php echo $get_rds_template_data_array["globals"]["announcement"]["right"]["text"]; ?>: <?php echo $get_rds_template_data_array["site_info"]["country_code"] . $get_rds_template_data_array["site_info"]["phone"]; ?> 
                            <i class="icon-chevron-right1 ms-auto text_15 line_height_15"></i></span>
                        </a>
                    <?php } ?>
                </div>
                <?php
                $args = [
                    "menu" => "mobile-main-menu",
                    "icon_down" => $dropdown_icon_down,
                    "depth" => 3,
                    "theme_location" => "primary",
                    "container" => false,
                    "menu_class" => "navbar-nav m-auto px-3",
                    "fallback_cb" => "Bluecorona_Type_A_Navwalker::fallback",
                    "walker" => new Bluecorona_Type_A_Navwalker(),
                ];
                wp_nav_menu($args);
                ?>
            </div>
        </nav>
    </div>
</div>
<script type="text/javascript">
    var dropdown_icon_up = '<?php echo $dropdown_icon_up; ?>';
    var dropdown_icon_down = '<?php echo $dropdown_icon_down; ?>';

</script>

