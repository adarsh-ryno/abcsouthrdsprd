<div class="d-none d-lg-block desktop-form-c">
    <div class="container-fluid px-lg-3 px-0">
        <div class="container mt-lg-n5">
            <div class="row">
                <div class="col-lg-12 mt-lg-n5 px-0 px-lg-3 home-form">
                    <div class="hero_banner_form_background position-relative py-4 px-lg-4 px-4 shadow-1 elementor-form-c">
                        <h3 class="pb-4 text-center mb-0 h3-alt color_secondary">
                        <?php echo !empty($args["globals"]["hero"]["form_heading"]) ? $args["globals"]["hero"]["form_heading"] : ''; ?>
                            <?php //echo $args["globals"]["hero"]["form_heading"]; ?>
                        </h2>
                        <div class="border_form bg_form">
                        <?php
                        $form_id = !empty($args["globals"]["hero"]["desktop_gravity_form_id"]) ? $args["globals"]["hero"]["desktop_gravity_form_id"] : '';
                        //$args["globals"]["hero"]["desktop_gravity_form_id"];
                        if (!empty($form_id)) {
                    echo do_shortcode(
                        "[gravityforms id=" . $form_id . " ajax=true]"
                    );
                }
                        ?> 
                        </div>
                    </div>   
                </div>
            </div>
        </div>
    </div>
</div>


<div class="d-none d-lg-none  hero_banner_form_background mobile-c-service">
    <div class="container-fluid px-lg-3 px-0">
        <div class="container mt-lg-n5 ">
            <div class="row">
                <div class="col-lg-12 mt-lg-n5 px-0 px-lg-3 home-form">
                    <div class=" py-4 px-lg-5 px-4 shadow-1 elementor-form-c">
                        <h3 class="pb-4 text-center mb-0">
                        <?php echo !empty($args["globals"]["hero"]["form_heading"]) ? $args["globals"]["hero"]["form_heading"] : ''; ?>
                            <?php //echo $args["globals"]["hero"]["form_heading"]; ?>
                        </h2>
                        <div class="border_form bg_form">
                        <?php
                       $mform_id = !empty($args["globals"]["hero"]["mobile_gravity_form_id"]) ? $args["globals"]["hero"]["mobile_gravity_form_id"] : '';
                       //$args["globals"]["hero"]["mobile_gravity_form_id"];
                       if (!empty($form_id)) {
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