<div class="container-fluid p-0 py-xl-2 color_tertiary_bg">
    <!-- Hide this section if announcement bar is disabled-->
    <div class="container ">
        <div class="row text-center text-lg-start announcement_bar_text">
            <!-- announcement bar content-->
            <div class="col-lg-4 text-start d-flex justify-content-start">
                <?php if (
                    !empty($args["globals"]["announcement"]["left"]["type"]) &&
                    $args["globals"]["announcement"]["left"]["type"] == "link"
                ) { ?>
                    <a class="announcment_bar_text d-inline-flex align-items-center justify-content-start me-auto tooltip-text" 
                       title="<?php echo esc_attr($args["globals"]["announcement"]["left"]["title"]); ?>" 
                       href="<?php echo esc_url(get_home_url() . $args["globals"]["announcement"]["left"]["url"]); ?>">
                        <i class="<?php echo esc_attr($args["globals"]["announcement"]["left"]["icon_class"]); ?> text_16 line_height_16 me-2 icon"></i>
                        <?php echo esc_html($args["globals"]["announcement"]["left"]["text"]); ?>
                    </a>
                <?php } elseif (
                    !empty($args["globals"]["announcement"]["left"]["text"])
                ) { ?>
                    <span title="<?php echo esc_attr($args["globals"]["announcement"]["left"]["title"]); ?>" 
                          class="announcment_bar_text d-inline-flex align-items-center text_normal justify-content-start me-auto tooltip-text position-relative">
                        <i class="<?php echo esc_attr($args["globals"]["announcement"]["left"]["icon_class"]); ?> text_16 line_height_16 me-2 icon"></i>
                        <?php echo esc_html($args["globals"]["announcement"]["left"]["text"]); ?>
                        <div class="tooltips p-4 text-center text-transform-none">
                            <span class="p d-inline-block tool_tip_text">
                                <?php echo esc_html($args["globals"]["announcement"]["left"]["tooltip_text"]); ?>
                            </span>
                        </div>
                    </span>
                <?php } ?> 
            </div>

            <div class="col-lg-4 text-center d-flex justify-content-center">
                <?php if (
                    !empty($args["globals"]["announcement"]["middle"]["text"])
                ) { ?>
                    <span class="announcment_bar_text d-inline-flex align-items-center">
                        <?php for ($i = 0; $i < 5; $i++) { ?>
                            <i class="<?php echo esc_attr($args["globals"]["announcement"]["middle"]["icon_class"]); ?> text_16 line_height_16 me-1 stars_color"></i>
                        <?php } ?>
                        <a class="announcment_bar_text d-inline-flex align-items-center ms-1 text_normal" 
                           title="<?php echo esc_attr($args["globals"]["announcement"]["middle"]["title"]); ?>" 
                           href="<?php echo esc_url(get_home_url() . $args["globals"]["announcement"]["middle"]["url"]); ?>">
                            <?php echo esc_html($args["globals"]["announcement"]["middle"]["text"]); ?> 
                            <i class="icon-chevron-right1 ms-1 text_16 line_height_16 transform"></i>
                        </a>
                    </span>
                <?php } ?>
            </div>

            <div class="col-lg-4 text-end d-flex justify-content-end">
                <?php if (
                    !empty($args["globals"]["announcement"]["right"]["text"])
                ) { ?>
                    <span class="announcment_bar_text d-inline-flex align-items-center">
                        <a class="announcment_bar_text d-inline-flex align-items-center ms-1" 
                           title="<?php echo esc_attr($args["globals"]["announcement"]["right"]["title"]); ?>" 
                           href="<?php echo esc_url(get_home_url() . $args["globals"]["announcement"]["right"]["url"]); ?>">
                            <i class="<?php echo esc_attr($args["globals"]["announcement"]["right"]["icon_class"]); ?> text_16 line_height_16 me-1 icon"></i>
                            <?php echo esc_html($args["globals"]["announcement"]["right"]["text"]); ?> 
                            <i class="icon-chevron-right1 ms-1 text_16 line_height_16 transform"></i>
                        </a>
                    </span>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
