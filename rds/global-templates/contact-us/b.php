<div class="container-fluid pt-lg-3 pb-lg-5 pb-4 my-2">
    <div class="container pb-lg-5">
        <div class="pb-3 pb-lg-4 mb-lg-2 ">
            <h1><?php the_title(); ?></h1>
            <?php if (!empty($args["page_templates"]["contact_page"]["content"])): ?>
                <?php echo $args["page_templates"]["contact_page"]["content"]; ?>
            <?php endif; ?>
        </div>
        <div class="row pb-lg-5">                     
            <div class="col-12 col-lg-8 pt-lg-0 pt-3 ps-lg-3">  
                <?php if (!empty($args["page_templates"]["contact_page"]["gravity_form_id"])): ?>
                    <?php
                    $form_id = $args["page_templates"]["contact_page"]["gravity_form_id"];
                    echo do_shortcode("[gravityforms id=" . $form_id . " ajax=true]");
                    ?>
                <?php endif; ?>  
            </div>                      
            <div class="col-sm-12 col-lg-4 pt-lg-0 pt-3 ps-lg-4 ">
                <div class="color_secondary_bg pt-5 pb-1 mxw-350 mx-auto ms-auto">
                    <div class="mb-4 pb-1">
                        <?php if (!empty($args["page_templates"]["contact_page"]["hours_heading"])): ?>
                            <h3 class="mb-3 h3-alt true_white text-center">
                                <?php echo $args["page_templates"]["contact_page"]["hours_heading"]; ?>
                            </h3>
                        <?php endif; ?>
                        
                        <?php if (!empty($args["site_info"]["week_days"])): ?>
                            <p class="mb-1 true_white text-center text_16 line_height_30">
                                <?php echo $args["site_info"]["week_days"]; ?>
                            </p>
                        <?php endif; ?>

                        <?php if (!empty($args["site_info"]["weekday_hours"])): ?>
                            <p class="mb-1 true_white text-center text_16 line_height_30">
                                <?php echo $args["site_info"]["weekday_hours"]; ?>
                            </p>
                        <?php endif; ?>

                        <?php if (!empty($args["site_info"]["weekend_days"])): ?>
                            <p class="mb-1 true_white text-center text_16 line_height_30">
                                <?php echo $args["site_info"]["weekend_days"]; ?>
                            </p>
                        <?php endif; ?>

                        <?php if (!empty($args["site_info"]["weekend_hours"])): ?>
                            <p class="mb-1 true_white text-center text_16 line_height_30">
                                <?php echo $args["site_info"]["weekend_hours"]; ?>
                            </p>  
                        <?php endif; ?>
                    </div>                            
                    <div class="mb-5 contact-social mt-n3">
                        <div class="social-border"></div>
                        <?php if (!empty($args["site_info"]["heading"])): ?>
                            <h3 class="mt-3 true_white text-center">
                                <?php echo $args["site_info"]["heading"]; ?>
                            </h3>
                        <?php endif; ?>

                        <div class="text-center">
                            <?php
                            if (!empty($args["site_info"]["social_media"]["items"])) {
                                $socialItems = $args["site_info"]["social_media"]["items"];
                                foreach ($socialItems as $value) {
                                    if (!empty($value["icon_class"]) && !empty($value["url"])) {
                                        echo '<a target="_blank" class="text_35 no_hover_underline line_height_30 mx-2 ms-lg-0 me-lg-2 no_hover_underline social_icons_contact_b true_white_hover" title="' . $value["icon_class"] . '" href="' . $value["url"] . '">
                                                <i class="' . $value["icon_class"] . ' "></i>
                                              </a>';
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
