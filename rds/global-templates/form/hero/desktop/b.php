<div class="desktop-form-b d-lg-block d-none">
    <div class="container-fluid mt-lg-n15-3 px-lg-3 px-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 offset-lg-5 px-0 px-lg-3">
                    <div class="hero_banner_form_background color_secondary_bg position-relative py-4 px-lg-5 px-4 elementor-form-b">
                        <h2 class="h2-alt text-lg-start text-center mb-0 pt-2">
                            <?php echo !empty($args["globals"]["hero"]["form_heading"]) ? $args["globals"]["hero"]["form_heading"] : ''; ?>
                        </h2>
                        <?php
                     
                        ?>
                        <div class="banner-form pt-lg-4 pt-2 mt-lg-0 mt-1">
                            <?php
                            $form_id = !empty($args["globals"]["hero"]["desktop_gravity_form_id"]) ? $args["globals"]["hero"]["desktop_gravity_form_id"] : '';
                            echo !empty($form_id) ? do_shortcode("[gravityforms id=" . $form_id . " ajax=true]") : '';
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
