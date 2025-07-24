<div class="d-block">
    <div class="container-fluid py-5 py-lg-4 text-center">
        <div class="container py-lg-3 py-5">
            <div class="row align-items-center py-lg-0 py-2">
                <div class="col-sm-12 col-lg-3 text-center text-lg-end pe-xl-3 pe-lg-5">
                    <?php
                    $careers_cta_image = get_exist_image_url("careers-cta", "careers-icon");
                    $careers_cta_image2x = get_exist_image_url("careers-cta", "careers-icon@2x");
                    $careers_cta_image3x = get_exist_image_url("careers-cta", "careers-icon@3x");

                    if (!empty($careers_cta_image) && @getimagesize($careers_cta_image) !== false) {
                        ?>
                        <img src="<?php echo esc_url($careers_cta_image); ?>" alt="career-logo" class="img-fluid" width="125" height="125" srcset="<?php echo esc_url($careers_cta_image); ?> 1x, <?php echo esc_url($careers_cta_image2x); ?> 2x, <?php echo esc_url($careers_cta_image3x); ?> 3x">
                        <?php
                    } else {
                        ?>
                        <div class="hiring_icon"><i class="icon-people-group4 text_125 sm_text_100 line_height_23"></i></div>
                        <?php
                    }
                    ?>
                </div>
                <div class="col-sm-12 col-lg-6 text-center text-lg-start py-lg-0 py-4">
                   <h6 class=""> <?php echo !empty($args["page_templates"]["homepage"]["we_are_hiring"]["heading"]) ? $args["page_templates"]["homepage"]["we_are_hiring"]["heading"] : ''; ?> </h6>
<h4 class="mt-2 mb-0 d-block"> <?php echo !empty($args["page_templates"]["homepage"]["we_are_hiring"]["subheading"]) ? $args["page_templates"]["homepage"]["we_are_hiring"]["subheading"] : ''; ?> </h4>

                </div>
                <div class="col-sm-12 col-lg-3 text-center text-lg-end">
                    <?php if (!empty($args["page_templates"]["homepage"]["we_are_hiring"]["button_text"])) { ?>
                        <a href="<?php echo esc_url(get_home_url() . $args["page_templates"]["homepage"]["we_are_hiring"]["button_link"]); ?>" class="btn btn-primary mw-165">
                            <?php echo esc_html($args["page_templates"]["homepage"]["we_are_hiring"]["button_text"]); ?>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
