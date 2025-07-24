<div class="d-flex flex-column w-100 page-template-rds-free-estimate">
    <div class="d-block order-1 order-lg-1">
        <div class="container-fluid pt-4 pb-lg-5 pb-4 my-2 px-lg-3 px-0">
            <div class="container pb-lg-5">
                <div class="row pb-lg-5">
                    <div class="col-12 pt-lg-4 free_estimate_form">
                        <h1 class="mb-4 mb-lg-0"><?php the_title(); ?></h1>
                        <div class="d-lg-flex d-none w-100 estimate_accordion position-relative mt-lg-5">
                            <?php if (!empty($args["page_templates"]["free_estimate_page"]["first_icon_class"])): ?>
                                <div class="col-lg-4 border-0 step">
                                    <div class="border-0 d-flex flex-lg-column">
                                        <div class="rounded-circle w-108 h-108 steps_background d-inline-flex align-items-center justify-content-center">
                                            <i class="<?php echo $args["page_templates"]["free_estimate_page"]["first_icon_class"]; ?> text_48 line_height_48 steps_icon_color"></i>
                                        </div>
                                        <h3 class="pt-lg-4 mt-lg-3 steps_heading_color">
                                            <?php echo !empty($args["page_templates"]["free_estimate_page"]["first_title"]) ? $args["page_templates"]["free_estimate_page"]["first_title"] : ''; ?>
                                        </h3>
                                    </div>
                                    <div class="border-0 pe-xl-3">
                                        <div class="px-0 pt-lg-3 pe-xl-5 me-xl-4">
                                            <p class="pb-lg-3 steps_description_color pe-xl-5 me-xl-5">
                                                <?php echo !empty($args["page_templates"]["free_estimate_page"]["first_description"]) ? $args["page_templates"]["free_estimate_page"]["first_description"] : ''; ?>
                                            </p> 
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($args["page_templates"]["free_estimate_page"]["second_icon_class"])): ?>
                                <div class="col-lg-4 border-0 step">
                                    <div class="border-0 d-flex flex-lg-column">
                                        <div class="rounded-circle w-108 h-108 steps_background d-inline-flex align-items-center justify-content-center">
                                            <i class="<?php echo $args["page_templates"]["free_estimate_page"]["second_icon_class"]; ?> text_48 line_height_48 steps_icon_color"></i>
                                        </div>
                                        <h3 class="pt-lg-4 mt-lg-3 steps_heading_color">
                                            <?php echo !empty($args["page_templates"]["free_estimate_page"]["second_title"]) ? $args["page_templates"]["free_estimate_page"]["second_title"] : ''; ?>
                                        </h3>
                                    </div>
                                    <div class="border-0 pe-xl-3">
                                        <div class="px-0 pt-lg-3 pe-xl-5 me-xl-4">
                                            <p class="pb-lg-3 steps_description_color pe-xl-5 me-xl-5">
                                                <?php echo !empty($args["page_templates"]["free_estimate_page"]["second_description"]) ? $args["page_templates"]["free_estimate_page"]["second_description"] : ''; ?>
                                            </p> 
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($args["page_templates"]["free_estimate_page"]["third_icon_class"])): ?>
                                <div class="col-lg-4 border-0 step">
                                    <div class="border-0 d-flex flex-lg-column">
                                        <div class="rounded-circle w-108 h-108 steps_background d-inline-flex align-items-center justify-content-center">
                                            <i class="<?php echo $args["page_templates"]["free_estimate_page"]["third_icon_class"]; ?> text_48 line_height_48 steps_icon_color"></i>
                                        </div>
                                        <h3 class="pt-lg-4 mt-lg-3 steps_heading_color">
                                            <?php echo !empty($args["page_templates"]["free_estimate_page"]["third_title"]) ? $args["page_templates"]["free_estimate_page"]["third_title"] : ''; ?>
                                        </h3>
                                    </div>
                                    <div class="border-0 pe-xl-3">
                                        <div class="px-0 pt-lg-3 pe-xl-5 me-xl-4">
                                            <p class="pb-lg-3 steps_description_color pe-xl-5 me-xl-5">
                                                <?php echo !empty($args["page_templates"]["free_estimate_page"]["third_description"]) ? $args["page_templates"]["free_estimate_page"]["third_description"] : ''; ?>
                                            </p> 
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="d-lg-none d-block accordion w-100 free_estimate_accord position-relative mt-lg-5 px-2" id="free_estimate_accordion">
                            <?php if (!empty($args["page_templates"]["free_estimate_page"]["first_icon_class"])): ?>
                                <div class="accordion-item col-lg-4 border-0 mb-4 pb-2 bg-transparent">
                                    <div class="border-0 d-flex align-items-center justify-content-between accordion-header curson-pointer" id="heading1" data-bs-toggle="collapse" data-bs-target="#collapse1">
                                        <div class="d-inline-flex align-items-center">
                                            <div class="rounded-circle w-76 h-76 steps_background d-inline-flex align-items-center justify-content-center me-4">
                                                <i class="<?php echo $args["page_templates"]["free_estimate_page"]["first_icon_class"]; ?> text_30 line_height_30 steps_icon_color"></i>
                                            </div>
                                            <h3 class="pt-lg-4 mt-lg-3 mb-0 steps_heading_color">
                                                <?php echo !empty($args["page_templates"]["free_estimate_page"]["first_title"]) ? $args["page_templates"]["free_estimate_page"]["first_title"] : ''; ?>
                                            </h3>
                                        </div>
                                        <div class="accrdion_icon free_estimate_accrdion_icon"><i class="icon-plus text_20 line_height_18"></i></div>
                                    </div>
                                    <div class="border-0 accordion-collapse collapse ps-5" id="collapse1" aria-labelledby="heading1" data-bs-parent="#free_estimate_accordion">
                                        <div class="px-lg-0 ps-5 pt-lg-3">
                                            <p class="ps-1 steps_description_color">
                                                <?php echo !empty($args["page_templates"]["free_estimate_page"]["first_description"]) ? $args["page_templates"]["free_estimate_page"]["first_description"] : ''; ?>
                                            </p> 
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($args["page_templates"]["free_estimate_page"]["second_icon_class"])): ?>
                                <div class="accordion-item col-lg-4 border-0 mb-4 pb-2 bg-transparent">
                                    <div class="border-0 d-flex align-items-center justify-content-between accordion-header curson-pointer" id="heading2" data-bs-toggle="collapse" data-bs-target="#collapse2">
                                        <div class="d-inline-flex align-items-center">
                                            <div class="rounded-circle w-76 h-76 steps_background d-inline-flex align-items-center justify-content-center me-4">
                                                <i class="<?php echo $args["page_templates"]["free_estimate_page"]["second_icon_class"]; ?> text_30 line_height_30 steps_icon_color"></i>
                                            </div>
                                            <h3 class="pt-lg-4 mt-lg-3 mb-0 steps_heading_color">
                                                <?php echo !empty($args["page_templates"]["free_estimate_page"]["second_title"]) ? $args["page_templates"]["free_estimate_page"]["second_title"] : ''; ?>
                                            </h3>
                                        </div>
                                        <div class="accrdion_icon free_estimate_accrdion_icon"><i class="icon-plus text_20 line_height_18"></i></div>
                                    </div>
                                    <div class="border-0 accordion-collapse collapse ps-5" id="collapse2" aria-labelledby="heading2" data-bs-parent="#free_estimate_accordion">
                                        <div class="px-lg-0 ps-5 pt-lg-3">
                                            <p class="ps-1 steps_description_color">
                                                <?php echo !empty($args["page_templates"]["free_estimate_page"]["second_description"]) ? $args["page_templates"]["free_estimate_page"]["second_description"] : ''; ?>
                                            </p> 
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($args["page_templates"]["free_estimate_page"]["third_icon_class"])): ?>
                                <div class="accordion-item col-lg-4 border-0 mb-4 pb-2 bg-transparent">
                                    <div class="border-0 d-flex align-items-center justify-content-between accordion-header curson-pointer" id="heading3" data-bs-toggle="collapse" data-bs-target="#collapse3">
                                        <div class="d-inline-flex align-items-center">
                                            <div class="rounded-circle w-76 h-76 steps_background d-inline-flex align-items-center justify-content-center me-4">
                                                <i class="<?php echo $args["page_templates"]["free_estimate_page"]["third_icon_class"]; ?> text_30 line_height_30 steps_icon_color"></i>
                                            </div>
                                            <h3 class="pt-lg-4 mt-lg-3 mb-0 steps_heading_color">
                                                <?php echo !empty($args["page_templates"]["free_estimate_page"]["third_title"]) ? $args["page_templates"]["free_estimate_page"]["third_title"] : ''; ?>
                                            </h3>
                                        </div>
                                        <div class="accrdion_icon free_estimate_accrdion_icon"><i class="icon-plus text_20 line_height_18"></i></div>
                                    </div>
                                    <div class="border-0 accordion-collapse collapse ps-5" id="collapse3" aria-labelledby="heading3" data-bs-parent="#free_estimate_accordion">
                                        <div class="px-lg-0 ps-5 pt-lg-3">
                                            <p class="ps-1 steps_description_color">
                                                <?php echo !empty($args["page_templates"]["free_estimate_page"]["third_description"]) ? $args["page_templates"]["free_estimate_page"]["third_description"] : ''; ?>
                                            </p> 
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="">
                            <?php
                            $form_id = !empty($args["page_templates"]["free_estimate_page"]["gravity_form_id"]) ? $args["page_templates"]["free_estimate_page"]["gravity_form_id"] : '';
                            echo do_shortcode("[gravityforms id=" . $form_id . " ajax=true]");
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    jQuery(document).ready(function () {
        jQuery(".accordion-header").on("click", function () {
            jQuery(this).find(".accrdion_icon i").toggleClass("icon-plus icon-minus1");
            jQuery(this).closest(".accordion-item").siblings().each(function (k, d) {
                var icon_class = jQuery(this).closest(".accordion-item").find(".accrdion_icon i").hasClass("icon-minus1");
                if (icon_class) {
                    jQuery(this).closest(".accordion-item").find(".accrdion_icon i").removeClass("icon-minus1");
                    jQuery(this).closest(".accordion-item").find(".accrdion_icon i").addClass("icon-plus");
                }
            });
        });
        
        jQuery(function () {
            // Handling free_estimate_accord class
            jQuery(".free_estimate_accord").each(function (index) {
                jQuery(this).children(".accordion-item").children(".accordion-collapse:first").addClass("show");
                jQuery(this).children(".accordion-item:first").find('.accrdion_icon i').toggleClass("icon-plus icon-minus1");
                jQuery(this).children(".accordion-item:first").children(".accordion-header").attr('aria-expanded', 'false');
            });
        });
    });
</script>
