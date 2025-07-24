<div class="d-block mobile-form-d">
    <div class="container-fluid px-lg-3 px-0">
        <div class="container">
            <div class="row pt-2"> 
                <div class="col-lg-7 mt-lg-n15-3 offset-lg-5 px-0 px-lg-3 ">
                    <div class="hero_banner_form_background color_secondary_bg position-relative py-4 px-4 px-lg-0 ">
                        <h2 class="h2-alt  text-start pt-2 mb-0 px-lg-5 sm_text_25 ">
                        <?php echo !empty($args["globals"]["hero"]["form_heading"]) ? $args["globals"]["hero"]["form_heading"] : ''; ?>
                        </h2>
                        <span class="d-block p-alt  text-start font_alt_1 text_normal text_16 line_height_21 sm_text_14 px-lg-5 me-lg-5 pr-4">
                        <?php echo !empty($args["globals"]["hero"]["form_subheading"]) ? $args["globals"]["hero"]["form_subheading"] : ''; ?>
                        </span>
                        <div class=" icon_swiper ps-lg-2 pt-lg-4 pt-2 mw-lg-566 mt-lg-0 mt-1 ms-lg-0 h-100">
                            <div class="swiper-wrapper">
                                <div class="col-3 text-center  border-right-lg-1 border-height pt-lg-0 pt-3 pb-lg-0 pb-1">
                                    <div class="icon_inner">
                                        <i class="p-alt icon-screwdriver-wrench1  text_48 line_height_48 sm_text_30 sm_line_height_30"></i>
                                    </div>
                                    <div class="icon_text pt-lg-4">
                                        <span class="d-block  p-alt text_15 line_height_30 font_alt_3 sm_text_11 text_bold text-uppercase">repair</span>
                                    </div>
                                </div>
                                <div class="col-3 text-center border-right-lg-1 border-height pt-lg-0 pt-3 pb-lg-0 pb-1">
                                    <div class="icon_inner">
                                        <i class="p-alt icon-gear3   text_48 line_height_48 sm_text_30 sm_line_height_30"></i>
                                    </div>
                                    <div class="icon_text pt-lg-4">
                                        <span class="d-block p-alt  text_15 line_height_30 font_alt_3 sm_text_11 text_bold text-uppercase">maintenance</span>
                                    </div>
                                </div>
                                <div class="col-3 text-center border-right-lg-1 border-height pt-lg-0 pt-3 pb-lg-0 pb-1">
                                    <div class="icon_inner">
                                        <i class="p-alt icon-file-invoice-dollar1   text_48 line_height_48 sm_text_30 sm_line_height_30"></i>
                                    </div>
                                    <div class="icon_text pt-lg-4">
                                        <span class="d-block p-alt  text_15 line_height_30 font_alt_3 sm_text_11 text_bold text-uppercase">estimate</span>
                                    </div>
                                </div>
                                <div class="col-3 text-center pt-lg-0 pt-3 pb-lg-0 pb-1">
                                    <div class="icon_inner">
                                        <i class="p-alt icon-comments-question3   text_48 line_height_48 sm_text_30 sm_line_height_30"></i>
                                    </div>
                                    <div class="icon_text pt-lg-4">
                                        <span class="d-block p-alt  text_15 line_height_30 font_alt_3 sm_text_11 text_bold text-uppercase">questions</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ps-lg-5 pt-4 mt-lg-3 pb-lg-5 pb-2 mb-lg-0 mb-1 text-start">
                            <?php
                            if (!empty($args["globals"]["hero"]["schedule_online"])) {
                                $schedule_online = $args["globals"]["hero"]["schedule_online"];
                            if (!empty($schedule_online["type"]) && $schedule_online["type"] != "url") { ?>
                                <span id="schedule_online_button_hero"  class="btn btn-secondary-alt mw-238 mh-52">
                                <?php echo !empty($schedule_online["label"]) ? $schedule_online["label"] : ''; ?> 
                                    <i class=" <?php echo !empty($schedule_online["icon_class"]) ? $schedule_online["icon_class"] : ''; ?>  text_18 line_height_18 ms-2"></i></span>
                            <?php } else { ?>
                                <a href="<?php echo get_home_url() . (!empty($schedule_online["url"]) ? $schedule_online["url"] : ''); ?>" class="btn btn-secondary-alt mw-238 mh-52">
                                    <?php echo !empty($schedule_online["label"]) ? $schedule_online["label"] : ''; ?> <i class=" <?php echo !empty($schedule_online["icon_class"]) ? $schedule_online["icon_class"] : ''; ?>   text_18 line_height_18 ms-2"></i></a>
                                <?php }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 