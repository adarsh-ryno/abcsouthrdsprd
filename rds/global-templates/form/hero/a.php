<div class="col-lg-4 d-lg-none">
                    <div class="shadow-xl d-lg-block d-none border-top-tertiary pt-lg-3 pt-4 pb-lg-4 hero_banner_form_background border_form home_form_a">
                        <h2 class="d-block pt-lg-1 text-center">
                        <?php echo !empty($args["globals"]["hero"]["form_heading"]) ? $args["globals"]["hero"]["form_heading"] : ''; ?>
                        <?php //echo $args["globals"]["hero"]["form_heading"]; ?></h2>
                        <h4 class="d-block pb-lg-2 text-center">
                        <?php echo !empty($args["globals"]["hero"]["form_subheading"]) ? $args["globals"]["hero"]["form_subheading"] : ''; ?>
                        <?php //echo $args["globals"]["hero"]["form_subheading"]; ?></h4>   
                        <?php
                        $form_id = !empty($args["globals"]["hero"]["desktop_gravity_form_id"]) ? $args["globals"]["hero"]["desktop_gravity_form_id"] : '';
                        	//$args["globals"]["hero"]["desktop_gravity_form_id"];
                            if (!empty($form_id)) {
                        echo do_shortcode("[gravityforms id=" . $form_id . " ajax=true]");
                            }
                        ?>
                    </div>
                </div>