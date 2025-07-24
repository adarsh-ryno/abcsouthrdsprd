<div class="mobile-varb-form">
    <div class="container-fluid mt-lg-n15-3 px-lg-3 px-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 offset-lg-5 px-0 px-lg-3">
                    <div class="color_secondary_bg py-4 hero_banner_form_background px-lg-5 px-4 elementor-form-b">
                        <h2 class="h2-alt text-lg-start text-center mb-0 pt-2">
                            <?php echo !empty($args["globals"]["hero"]["form_heading"]) ? $args["globals"]["hero"]["form_heading"] : ''; ?>
                        </h2>
                        <?php
                        /*<span class="d-block p-alt text-start font_alt_1 text_normal text_16 line_height_21 sm_text_14 pe-lg-5 me-lg-5 pe-4"><?php echo !empty($args['globals']['hero']['form_subheading']) ? $args['globals']['hero']['form_subheading'] : ''; ?></span> */
                        ?>
                        <div class="banner-form pt-lg-4 pt-2 mt-lg-0 mt-1 do_not_use_custom_dropdown">
                            <?php
                            $mform_id = !empty($args["globals"]["hero"]["mobile_gravity_form_id"]) ? $args["globals"]["hero"]["mobile_gravity_form_id"] : '';
                            if (!empty($mform_id)) {
                                echo do_shortcode("[gravityforms id=" . $mform_id . " ajax=true]");
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
