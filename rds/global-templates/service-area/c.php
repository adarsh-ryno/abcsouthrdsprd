<div class="d-block">
    <!-- proudly serving area starts -->
    <div class="container-fluid">
        <div class="container py-lg-3 py-4">
            <div class="row align-item-center pt-lg-5">
                <div class="col-lg-12 text-center">
                    <ul class="nav nav-tabs d-flex border-0 mb-3" id="myTab" role="tablist">
                        <?php
                        $site_titles = get_multisite_site_titles();
                        $enable_service = isset($args['globals']['service_area']['multisite_service_area_option']) ? $args['globals']['service_area']['multisite_service_area_option'] : null;
                        if (is_array($site_titles) && $enable_service == 'yes') {
                            foreach ($site_titles as $site_id => $site_title) {
                                switch_to_blog($site_id);
                                $rds_template_value = get_option('rds_template');
                                $site_data = json_decode($rds_template_value);
                                if (!empty($site_data)) {
                        ?>
                                    <li class="nav-item border-0 pe-2 ps-0 w-lg-25 w-sm-50 w-100 mb-lg-0 mb-2" role="presentation">
                                        <button class="nav-link <?php echo ($site_id == 1) ? 'active' : ''; ?> w-100 border-0 h6" id="site-<?php echo $site_id; ?>-tab" data-bs-toggle="tab" data-bs-target="#site-<?php echo $site_id; ?>" type="button" role="tab" aria-controls="site-<?php echo $site_id; ?>" aria-selected="<?php echo ($site_id == 1) ? 'true' : 'false'; ?>"><?php echo $site_title; ?></button>
                                    </li>
                                <?php }
                                restore_current_blog();
                            }
                        } else {
                            if (!empty($args['globals']['service_area']['first_tab_title'])) { ?>
                                <li class="nav-item border-0 pe-2 ps-0 w-lg-25 w-sm-50 w-100 mb-lg-0 mb-2" role="presentation">
                                    <button class="nav-link active w-100 border-0 h6" id="nova-tab" data-bs-toggle="tab" data-bs-target="#nova" type="button" role="tab" aria-controls="nova" aria-selected="false"><?php echo $args['globals']['service_area']['first_tab_title']; ?></button>
                                </li>
                            <?php }
                            if (!empty($args['globals']['service_area']['second_tab_title'])) { ?>
                                <li class="nav-item border-0 pe-2 ps-0 w-lg-25 w-sm-50 w-100 mb-lg-0 mb-2" role="presentation">
                                    <button class="nav-link w-100 border-0 h6" id="richmond-tab" data-bs-toggle="tab" data-bs-target="#richmond" type="button" role="tab" aria-controls="richmond" aria-selected="true"><?php echo $args['globals']['service_area']['second_tab_title']; ?></button>
                                </li>
                            <?php }
                            if (!empty($args['globals']['service_area']['third_tab_title'])) { ?>
                                <li class="nav-item border-0 pe-2 ps-0 w-lg-25 w-sm-50 w-100 mb-lg-0 mb-2" role="presentation">
                                    <button class="nav-link w-100 border-0 h6" id="maryland-tab" data-bs-toggle="tab" data-bs-target="#maryland" type="button" role="tab" aria-controls="maryland" aria-selected="false"><?php echo $args['globals']['service_area']['third_tab_title']; ?></button>
                                </li>
                            <?php }
                            if (!empty($args['globals']['service_area']['fourth_tab_title'])) { ?>
                                <li class="nav-item border-0 pe-2 ps-0 w-lg-25 w-sm-50 w-100 mb-lg-0 mb-2" role="presentation">
                                    <button class="nav-link w-100 border-0 h6" id="virginia-tab" data-bs-toggle="tab" data-bs-target="#virginia" type="button" role="tab" aria-controls="virginia" aria-selected="false"><?php echo $args['globals']['service_area']['fourth_tab_title']; ?></button>
                                </li>
                            <?php }
                        } ?>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <?php
                        $site_titles = get_multisite_site_titles();
                        $enable_service = isset($args['globals']['service_area']['multisite_service_area_option']) ? $args['globals']['service_area']['multisite_service_area_option'] : null;
                        if (is_array($site_titles) && $enable_service == 'yes') {
                            foreach ($site_titles as $site_id => $site_title) {
                                switch_to_blog($site_id);
                                $rds_template_value = get_option('rds_template');
                                $site_data = json_decode($rds_template_value);
                                if (!empty($site_data)) {
                                    $subheading = $site_data->globals->service_area->subheading;
                                    $heading = $site_data->globals->service_area->heading;
                                    $button_link = $site_data->globals->service_area->button_link;
                                    $button_text = $site_data->globals->service_area->button_text;
                                    $description_html_allowed = $site_data->globals->service_area->description_html_allowed;
                        ?>
                                    <div class="tab-pane fade <?php echo ($site_id == 1) ? 'show active' : ''; ?>" id="site-<?php echo $site_id; ?>" role="tabpanel" aria-labelledby="site-<?php echo $site_id; ?>-tab">
                                        <div class="row py-lg-3">
                                            <div class="col-lg-7">
                                                <img src="<?php echo get_exist_image_url('service-area', 'service-map-c'); ?>" srcset="<?php echo get_exist_image_url('service-area', 'service-map-c'); ?> 1x, <?php echo get_exist_image_url('service-area', 'service-map-c@2x'); ?> 2x, <?php echo get_exist_image_url('service-area', 'service-map-c@3x'); ?> 3x" class="img-fluid w-100 h-100 object-fit" width="641" height="393">
                                            </div>
                                            <div class="col-lg-5 mt-lg-0 mt-3 text-center">
                                                <div class="d-block px-xl-4 py-lg-5 py-4 bg-white h-100 h-sm-100">
                                                    <?php if (!empty($heading)) { ?>
                                                        <h4 class="pt-lg-4 pb-3 mb-0"><?php echo $heading; ?></h4>
                                                    <?php } ?>
                                                    <div class="text-center border-bottom-tertiary mw-100 mx-auto mb-4"></div>
                                                    <?php if (!empty($description_html_allowed)) { ?>
                                                        <p class="mb-2 px-xl-0 px-3"><?php echo $description_html_allowed; ?></p>
                                                    <?php } ?>
                                                    <div class="pt-2 pb-3 pb-lg-4">
                                                        <?php if (!empty($button_text)) { ?>
                                                            <a href="<?php echo get_home_url() . $button_link; ?>" class="btn btn-primary mw-173"><?php echo $button_text; ?> <i class="icon-chevron-right ms-2 me-0 bc_text_18 bc_line_height_18 transform_lg position-relative"></i></a>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                                restore_current_blog();
                            }
                        } else {
                            if (!empty($args['globals']['service_area']['first_tab_title'])) { ?>
                                <div class="tab-pane fade show active" id="nova" role="tabpanel" aria-labelledby="nova-tab">
                                    <div class="row py-lg-3">
                                        <div class="col-lg-7">
                                            <img src="<?php echo get_exist_image_url('service-area', 'service-map-c'); ?>" srcset="<?php echo get_exist_image_url('service-area', 'service-map-c'); ?> 1x, <?php echo get_exist_image_url('service-area', 'service-map-c@2x'); ?> 2x, <?php echo get_exist_image_url('service-area', 'service-map-c@3x'); ?> 3x" class="img-fluid w-100 h-100 object-fit" width="641" height="393">
                                        </div>
                                        <div class="col-lg-5 mt-lg-0 mt-3 text-center">
                                            <div class="d-block px-xl-4 py-lg-5 py-4 bg-white h-100 h-sm-100">
                                                <?php if (!empty($args['globals']['service_area']['first_tab_heading'])) { 
                                                    if ($args['globals']['service_area']['first_tab_heading'] != strip_tags($args['globals']['service_area']['first_tab_heading'])) { ?>
                                                        <span class="p-alt mb-0 mb-lg-2 pe-lg-4 pe-xl-5"><?php echo $args['globals']['service_area']['first_tab_heading']; ?> </span>
                                                    <?php } else { ?>
                                                        <h4 class="pt-lg-4 pb-3 mb-0"><?php echo $args['globals']['service_area']['first_tab_heading']; ?></h4>
                                                    <?php } ?>
                                                <?php } ?>
                                                <div class="text-center border-bottom-tertiary mw-100 mx-auto mb-4"></div>
                                                <?php if (!empty($args['globals']['service_area']['first_tab_description_html_allowed'])) { ?>
                                                    <p class="mb-2 px-xl-0 px-3"><?php echo $args['globals']['service_area']['first_tab_description_html_allowed']; ?></p>
                                                <?php } ?>
                                                <div class="pt-2 pb-3 pb-lg-4">
                                                    <?php if (!empty($args['globals']['service_area']['first_tab_button_text']) && !empty($args['globals']['service_area']['first_tab_button_link'])) { ?>
                                                        <a href="<?php echo get_home_url() . $args['globals']['service_area']['first_tab_button_link']; ?>" class="btn btn-primary mw-173"><?php echo $args['globals']['service_area']['first_tab_button_text']; ?> <i class="icon-chevron-right ms-2 me-0 bc_text_18 bc_line_height_18 transform_lg position-relative"></i></a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                            if (!empty($args['globals']['service_area']['second_tab_title'])) { ?>
                                <div class="tab-pane fade" id="richmond" role="tabpanel" aria-labelledby="richmond-tab">
                                    <div class="row py-lg-3">
                                        <div class="col-lg-7">
                                            <img src="<?php echo get_exist_image_url('service-area', 'service-map-c'); ?>" srcset="<?php echo get_exist_image_url('service-area', 'service-map-c'); ?> 1x, <?php echo get_exist_image_url('service-area', 'service-map-c@2x'); ?> 2x, <?php echo get_exist_image_url('service-area', 'service-map-c@3x'); ?> 3x" class="img-fluid w-100 h-100 object-fit" width="641" height="393">
                                        </div>
                                        <div class="col-lg-5 mt-lg-0 mt-3 text-center">
                                            <div class="d-block px-xl-4 py-lg-5 py-4 bg-white h-100 h-sm-100">
                                                <?php if (!empty($args['globals']['service_area']['second_tab_heading'])) { ?>
                                                    <h4 class="pt-lg-4 pb-3 mb-0"><?php echo $args['globals']['service_area']['second_tab_heading']; ?></h4>
                                                <?php } ?>
                                                <div class="text-center border-bottom-tertiary mw-100 mx-auto mb-4"></div>
                                                <?php if (!empty($args['globals']['service_area']['second_tab_description_html_allowed'])) { ?>
                                                    <p class="mb-2 px-xl-0 px-3"><?php echo $args['globals']['service_area']['second_tab_description_html_allowed']; ?></p>
                                                <?php } ?>
                                                <div class="pt-2 pb-3 pb-lg-4">
                                                    <?php if (!empty($args['globals']['service_area']['second_tab_button_text']) && !empty($args['globals']['service_area']['second_tab_button_link'])) { ?>
                                                        <a href="<?php echo get_home_url() . $args['globals']['service_area']['second_tab_button_link']; ?>" class="btn btn-primary mw-173"><?php echo $args['globals']['service_area']['second_tab_button_text']; ?> <i class="icon-chevron-right ms-2 me-0 bc_text_18 bc_line_height_18 transform_lg position-relative"></i></a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                            if (!empty($args['globals']['service_area']['third_tab_title'])) { ?>
                                <div class="tab-pane fade" id="maryland" role="tabpanel" aria-labelledby="maryland-tab">
                                    <div class="row py-lg-3">
                                        <div class="col-lg-7">
                                            <img src="<?php echo get_exist_image_url('service-area', 'service-map-c'); ?>" srcset="<?php echo get_exist_image_url('service-area', 'service-map-c'); ?> 1x, <?php echo get_exist_image_url('service-area', 'service-map-c@2x'); ?> 2x, <?php echo get_exist_image_url('service-area', 'service-map-c@3x'); ?> 3x" class="img-fluid w-100 h-100 object-fit" width="641" height="393">
                                        </div>
                                        <div class="col-lg-5 mt-lg-0 mt-3 text-center">
                                            <div class="d-block px-xl-4 py-lg-5 py-4 bg-white h-100 h-sm-100">
                                                <?php if (!empty($args['globals']['service_area']['third_tab_heading'])) { ?>
                                                    <h4 class="pt-lg-4 pb-3 mb-0"><?php echo $args['globals']['service_area']['third_tab_heading']; ?></h4>
                                                <?php } ?>
                                                <div class="text-center border-bottom-tertiary mw-100 mx-auto mb-4"></div>
                                                <?php if (!empty($args['globals']['service_area']['third_tab_description_html_allowed'])) { ?>
                                                    <p class="mb-2 px-xl-0 px-3"><?php echo $args['globals']['service_area']['third_tab_description_html_allowed']; ?></p>
                                                <?php } ?>
                                                <div class="pt-2 pb-3 pb-lg-4">
                                                    <?php if (!empty($args['globals']['service_area']['third_tab_button_text']) && !empty($args['globals']['service_area']['third_tab_button_link'])) { ?>
                                                        <a href="<?php echo get_home_url() . $args['globals']['service_area']['third_tab_button_link']; ?>" class="btn btn-primary mw-173"><?php echo $args['globals']['service_area']['third_tab_button_text']; ?> <i class="icon-chevron-right ms-2 me-0 bc_text_18 bc_line_height_18 transform_lg position-relative"></i></a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                            if (!empty($args['globals']['service_area']['fourth_tab_title'])) { ?>
                                <div class="tab-pane fade" id="virginia" role="tabpanel" aria-labelledby="virginia-tab">
                                    <div class="row py-lg-3">
                                        <div class="col-lg-7">
                                            <img src="<?php echo get_exist_image_url('service-area', 'service-map-c'); ?>" srcset="<?php echo get_exist_image_url('service-area', 'service-map-c'); ?> 1x, <?php echo get_exist_image_url('service-area', 'service-map-c@2x'); ?> 2x, <?php echo get_exist_image_url('service-area', 'service-map-c@3x'); ?> 3x" class="img-fluid w-100 h-100 object-fit" width="641" height="393">
                                        </div>
                                        <div class="col-lg-5 mt-lg-0 mt-3 text-center">
                                            <div class="d-block px-xl-4 py-lg-5 py-4 bg-white h-100 h-sm-100">
                                                <?php if (!empty($args['globals']['service_area']['fourth_tab_heading'])) { ?>
                                                    <h4 class="pt-lg-4 pb-3 mb-0"><?php echo $args['globals']['service_area']['fourth_tab_heading']; ?></h4>
                                                <?php } ?>
                                                <div class="text-center border-bottom-tertiary mw-100 mx-auto mb-4"></div>
                                                <?php if (!empty($args['globals']['service_area']['fourth_tab_description_html_allowed'])) { ?>
                                                    <p class="mb-2 px-xl-0 px-3"><?php echo $args['globals']['service_area']['fourth_tab_description_html_allowed']; ?></p>
                                                <?php } ?>
                                                <div class="pt-2 pb-3 pb-lg-4">
                                                    <?php if (!empty($args['globals']['service_area']['fourth_tab_button_text']) && !empty($args['globals']['service_area']['fourth_tab_button_link'])) { ?>
                                                        <a href="<?php echo get_home_url() . $args['globals']['service_area']['fourth_tab_button_link']; ?>" class="btn btn-primary mw-173"><?php echo $args['globals']['service_area']['fourth_tab_button_text']; ?> <i class="icon-chevron-right ms-2 me-0 bc_text_18 bc_line_height_18 transform_lg position-relative"></i></a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- proudly serving area ends -->
</div>

<script type="text/javascript">
    jQuery(document).ready(function() {
  // Set the aria-selected attribute to true for the first li
   jQuery('#myTab .nav-link').first().attr('aria-selected', 'true');
    jQuery('#myTab .nav-link').first().addClass('active',);
   jQuery('#myTabContent div:first').addClass('fade active show');
});

</script> 
