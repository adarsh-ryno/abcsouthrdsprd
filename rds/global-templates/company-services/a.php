<!--order-9 order-lg-9-->
<?php
$get_alt_text = RDS_ALT_DATA;
$alt = "";
if (is_array($get_alt_text)) {
    foreach ($get_alt_text as $value) {
        if (in_array("company-services-img.webp", $value)) {
            $alt = 'alt="' . $value[3] . '"';
        }
    }
}
?>  

<div class="d-block">
    <div class="container-fluid px-0 px-lg-3 pb-3 pb-lg-3 pt-lg-0 mt-lg-0">
        <div class="container px-lg-3 px-0 mb-4">
            <div class="row">                   
            </div>          
            <div class="d-lg-flex mx-0 align-items-center mt-lg-5">
                <div class="text-md-right px-lg-3 px-md-5 mt-lg-0">
                    <div class="img_section pt-lg-0 pt-xl-2 mt-lg-0 pl-lg-4 pl-md-3 text-center">
                        <img src="<?php echo get_exist_image_url(
                            'company-services',
                            'company-services-img'
                        ); ?>" 
                        srcset="<?php echo get_exist_image_url(
                            'company-services',
                            'company-services-img'
                        ); ?> 1x, 
                                <?php echo get_exist_image_url(
                                    'company-services',
                                    'company-services-img@2x'
                                ); ?> 2x, 
                                <?php echo get_exist_image_url(
                                    'company-services',
                                    'company-services-img@3x'
                                ); ?> 3x" 
                        <?php echo !empty($alt) ? $alt : ''; ?> class="img-fluid" width="522" height="327">
                    </div>
                </div>
                <div class="cmpny-content">
                    <?php if (!empty($args["globals"]["company_services"]["heading"])): ?>
                        <h4 class="text-lg-start text-center ml-lg-5"><?php echo $args["globals"]["company_services"]["heading"]; ?></h4>
                    <?php endif; ?>

                    <?php if (!empty($args["globals"]["company_services"]["subheading"])): ?>
                        <h5 class="mb-lg-0 text-lg-start text-center ml-lg-5"><?php echo $args["globals"]["company_services"]["subheading"]; ?></h5>
                    <?php endif; ?>

                    <div class="treat_content mw-md-330 mx-lg-0 mx-auto pt-lg-4">
                        <?php echo !empty($args["globals"]["company_services"]["description_html_allowed"]) ? $args["globals"]["company_services"]["description_html_allowed"] : ''; ?>

                        <?php if (!empty($args["globals"]["company_services"]["button_text"])): ?>
                            <div class="text-lg-start text-center">
                                <a href="<?php echo get_home_url() . $args["globals"]["company_services"]["button_link"]; ?>" class="btn btn-primary mw-165 mx-lg-0 mx-auto">
                                    <?php echo $args["globals"]["company_services"]["button_text"]; ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>
