<div class="d-lg-none">
    <div class="container-fluid mt-lg-n15-3 px-lg-3 px-0">
        <div class="container">
            <div class="row">
                <div class="col-12 px-0 px-lg-3">
                    <div class="shadow-xl border-top-tertiary pt-lg-3 pt-4 pb-4 hero_banner_form_background border_form home_form_a">
                        <h5 class="d-block pt-lg-1 text-center">
                            <?php echo !empty($args["globals"]["hero"]["form_heading"]) ? $args["globals"]["hero"]["form_heading"] : ''; ?>
                        </h5>
                        <h3 class="d-block pb-lg-2 text-center">
                            <?php echo !empty($args["globals"]["hero"]["form_subheading"]) ? $args["globals"]["hero"]["form_subheading"] : ''; ?>
                        </h3>
                        <?php
                        $form_id = !empty($args["globals"]["hero"]["mobile_gravity_form_id"]) ? $args["globals"]["hero"]["mobile_gravity_form_id"] : '';
                        if (!empty($form_id)) {
                            echo do_shortcode("[gravityforms id=" . $form_id . " ajax=true]");
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
