<div class="d-lg-block d-none">
    <div class="container-fluid py-5 py-lg-4 text-center" id="request_service">
        <div class="container pt-lg-3 py-2">
            <div class="row align-items-center py-lg-2">
                <div class="col-lg-12 pt-lg-3 elementor-requestformA">
                    <div class="">
                        <?php
                        if (!empty($args["globals"]["request_service"]["heading"])) {
                        ?>
                            <h4 class="h4-alt pb-lg-4 pb-3"><?php echo $args["globals"]["request_service"]["heading"]; ?></h4>
                        <?php
                        }
                        ?>
                        
                        <div class="banner-form">
                            <?php
                            if (!empty($args["globals"]["request_service"]["gravity_form_id"])) {
                                $form_id = $args["globals"]["request_service"]["gravity_form_id"];
                                echo do_shortcode("[gravityforms id=" . esc_attr($form_id) . " ajax=true]");
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
