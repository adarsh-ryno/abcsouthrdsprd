<div class="container-fluid bg-white px-0 px-lg-3 pb-3 pb-lg-2 pt-lg-2 mb-2 mt-4 mt-lg-2">
    <div class="container pt-4">
        <div class="row">
            <div class="col-lg-6">
                <div class="img_section pb-lg-0 pb-4 text-center">
                    <?php
                    $financing_placeholder_image = get_exist_image_url(
                        "financing-page",
                        "financing-img"
                    );
                    $financing_placeholder_image2x = get_exist_image_url(
                        "financing-page",
                        "financing-img@2x"
                    );
                    $financing_placeholder_image3x = get_exist_image_url(
                        "financing-page",
                        "financing-img@3x"
                    );
                    if (@getimagesize($financing_placeholder_image) == false) {
                        $financing_placeholder_image = get_exist_image_url(
                            "",
                            "finance-placeholder"
                        );
                        $financing_placeholder_image2x = get_exist_image_url(
                            "",
                            "finance-placeholder@2x"
                        );
                        $financing_placeholder_image3x = get_exist_image_url(
                            "",
                            "finance-placeholder@3x"
                        );
                    }
                    ?>
                    <img src="<?php echo $financing_placeholder_image; ?>" srcset="<?php echo $financing_placeholder_image; ?> 1x, <?php echo $financing_placeholder_image2x; ?> 2x, <?php echo $financing_placeholder_image3x; ?> 3x" alt="placeholder Image" class="img-fluid" width="540" height="390" >
                </div>
            </div>
            <div class="col-lg-6">
                <div class="finance_custom_content mw-md-330 mx-lg-0 mx-auto">
                    <?php if (!empty($args["page_templates"]["finance_page"]["company_services"]["heading"])): ?>
                        <h4 class="text-lg-start text-center"><?php echo $args["page_templates"]["finance_page"]["company_services"]["heading"]; ?></h4>
                    <?php endif; ?>
                    
                    <?php if (!empty($args["page_templates"]["finance_page"]["company_services"]["subheading"])): ?>
                        <h2 class="mb-lg-0 pb-lg-5 text-lg-start text-center"><?php echo $args["page_templates"]["finance_page"]["company_services"]["subheading"]; ?></h2>
                    <?php endif; ?>
                    
                    <?php if (!empty($args["page_templates"]["finance_page"]["company_services"]["description_html_allowed"])): ?>
                        <?php echo $args["page_templates"]["finance_page"]["company_services"]["description_html_allowed"]; ?>
                    <?php endif; ?>
                    
                    <div class="text-lg-start text-center pt-lg-2">
                        <?php if (!empty($args["page_templates"]["finance_page"]["company_services"]["button_text"])): ?>
                            <a href="<?php echo get_home_url() . $args["page_templates"]["finance_page"]["company_services"]["button_link"]; ?>" target="<?php echo $args["page_templates"]["finance_page"]["company_services"]["target"] == "true" ? "_blank" : "_self"; ?>" class="btn btn-primary mw-165 mx-lg-0 mx-auto"><?php echo $args["page_templates"]["finance_page"]["company_services"]["button_text"]; ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
