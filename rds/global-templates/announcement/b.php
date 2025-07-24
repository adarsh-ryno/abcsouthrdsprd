<div class="container-fluid p-0 color_secondary_bg">
    <!-- Hide this section if announcement bar is disabled -->
    <?php if (!empty($args["globals"]["announcement"]["left"]["text"]) || !empty($args["globals"]["announcement"]["desktop_schedule_online_button"]["label"]) || !empty($args["globals"]["announcement"]["right"]["text"]) || !empty($args["site_info"]["phone"])): ?>
    <div class="container">
        <div class="row text-center text-lg-start announcement_bar_text">
            <!-- Announcement bar content -->
            <div class="col-lg-4 text-start d-flex">
                <?php if (!empty($args["globals"]["announcement"]["left"]["text"])): ?>
                    <?php if ($args["globals"]["announcement"]["left"]["type"] == "link"): ?>
                        <a class="announcment_bar_text d-inline-flex align-items-center" title="<?php echo $args["globals"]["announcement"]["left"]["title"]; ?>" href="<?php echo get_home_url() . $args["globals"]["announcement"]["left"]["url"]; ?>">
                            <i class="<?php echo $args["globals"]["announcement"]["left"]["icon_class"]; ?> text_16 line_height_16 me-2 icon"></i>
                            <?php echo $args["globals"]["announcement"]["left"]["text"]; ?>
                        </a>
                    <?php else: ?>
                        <span title="<?php echo $args["globals"]["announcement"]["left"]["title"]; ?>" class="d-inline-flex announcment_bar_text align-items-center tooltip-text position-relative">
                            <i class="<?php echo $args["globals"]["announcement"]["left"]["icon_class"]; ?> text_16 line_height_16 me-2 icon"></i>
                            <?php echo $args["globals"]["announcement"]["left"]["text"]; ?>
                            <div class="tooltips p-4 text-center text-transform-none">
                                <span class="p d-inline-block tool_tip_text"><?php echo $args["globals"]["announcement"]["left"]["tooltip_text"]; ?></span>
                            </div>
                        </span>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <div class="col-lg-8 text-end d-flex justify-content-end align-items-center">
                <?php if (!empty($args["globals"]["announcement"]["desktop_schedule_online_button"]["label"])): ?>
                    <?php if ($args["globals"]["announcement"]["desktop_schedule_online_button"]["enabled"] == true): ?>
                        <?php if (isset($args["globals"]["announcement"]["desktop_schedule_online_button"]) && $args["globals"]["announcement"]["desktop_schedule_online_button"]["type"] != "url"): ?>
                            <span id="schedule_online_button_desktop" class="announcment_bar_text cursor-pointer position-relative align-items-center justify-content-center pe-2 h-32 color_tertiary_bg d-inline-flex">
                                <i class="px-2 <?php echo $args["globals"]["announcement"]["desktop_schedule_online_button"]["icon_class"]; ?>"></i>
                                <?php echo $args["globals"]["announcement"]["desktop_schedule_online_button"]["label"]; ?>
                            </span>
                        <?php else: ?>
                            <a class="announcment_bar_text position-relative align-items-center justify-content-center w-167 h-32 color_tertiary_bg d-inline-flex" href="<?php echo get_home_url() . $args["globals"]["announcement"]["desktop_schedule_online_button"]["url"]; ?>">
                                <i class="px-2 <?php echo $args["globals"]["announcement"]["desktop_schedule_online_button"]["icon_class"]; ?>"></i>
                                <?php echo $args["globals"]["announcement"]["desktop_schedule_online_button"]["label"]; ?>
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if (!empty($args["site_info"]["phone"])): ?>
                    <a class="announcment_bar_text h-32 px-1 position-relative align-items-center justify-content-center px-2 color_callbtn d-inline-flex" title="<?php echo $args["globals"]["announcement"]["right"]["title"]; ?>" href="tel:<?php echo $args["site_info"]["country_code"] . $args["site_info"]["phone"]; ?>">
                        <i class="<?php echo $args["globals"]["announcement"]["right"]["icon_class"]; ?> text_16 line_height_16 me-1 icon"></i>
                        <span class="d-inline-flex me-1"><?php echo $args["globals"]["announcement"]["right"]["text"]; ?>:</span>
                        <?php echo $args["site_info"]["country_code"] . $args["site_info"]["phone"]; ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
