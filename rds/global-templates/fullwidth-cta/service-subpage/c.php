<?php $get_alt_text = RDS_ALT_DATA;
$financing_svg_alt = "";
if (is_array($get_alt_text)) {
    foreach ($get_alt_text as $value) {
        if (is_array($value) && in_array("financing-c-mascot.svg", $value) && isset($value[3])) {
            $financing_svg_alt = 'alt="' . esc_attr($value[3]) . '"';
        }
    }
}

$heading_tag = isset($args["page_templates"]["service_subpage"]["financing"]["heading_tag"]) ? $args["page_templates"]["service_subpage"]["financing"]["heading_tag"] : "h4";
$subheading_tag = isset($args["page_templates"]["service_subpage"]["financing"]["subheading_tag"]) ? $args["page_templates"]["service_subpage"]["financing"]["subheading_tag"] : "h5";
?>
<div class="d-block order-lg-2 order-2 mb-5">
    <div class="container-fluid py-lg-4 px-lg-3 px-0">
        <div class="container financing-bg">
            <div class="row align-items-center">
                <div class="col-lg-11 mw-lg-1073 ms-lg-auto d-lg-flex align-items-center px-lg-0 px-0 ">
                    <?php
                    //exaple how to set image sizewise
                    // ['dektop', 'ipad', 'mobile']

                    $img1x = [get_exist_image_url("fullwidth-cta", "financing-c-bg"), get_exist_image_url("fullwidth-cta", "financing-c-bg@2x"), get_exist_image_url("fullwidth-cta", "financing-c-bg@3x")];

                    $img2x = [get_exist_image_url("fullwidth-cta", "financing-c-bg"), get_exist_image_url("fullwidth-cta", "financing-c-bg@2x"), get_exist_image_url("fullwidth-cta", "financing-c-bg@3x")];

                    $img3x = [get_exist_image_url("fullwidth-cta", "financing-c-bg"), get_exist_image_url("fullwidth-cta", "financing-c-bg@2x"), get_exist_image_url("fullwidth-cta", "financing-c-bg@3x")];

                    $img1x = Implode(",", $img1x);
                    $img2x = Implode(",", $img2x);
                    $img3x = Implode(",", $img3x);
                    ?>
                    <?php echo do_shortcode('[custom-bg-srcset class="financing-bg-c" img1x="' . $img1x . '" img2x="' . $img2x . '" img3x="' . $img3x . '" size1x="cover" size2x="cover" size3x="cover"]'); ?>
                    <div class="d-lg-flex w-100 mw-lg-1073 py-lg-0 py-5  align-items-center financing-bg-c" >
                        <img src="<?php echo get_exist_image_url("fullwidth-cta", "financing-c-mascot"); ?>" <?php echo $financing_svg_alt; ?> class="img-fluid position-relative left-lg-n120" width="306" height="230">
                        <div class="d-block ps-lg-4 pt-lg-0 pt-3">
                            <<?php echo $heading_tag; ?> class=""><?php echo $args["page_templates"]["service_subpage"]["financing"]["heading"]; ?></<?php echo $heading_tag; ?>>
                            <<?php echo $subheading_tag; ?> class="mt-2 mb-0 pb-1"><?php echo $args["page_templates"]["service_subpage"]["financing"]["subheading"]; ?></<?php echo $subheading_tag; ?>>
                              <?php if (!empty($args["page_templates"]["service_subpage"]["financing"]["button_text"])) { ?>
                            <a href="<?php echo get_home_url() .
                                $args["page_templates"]["service_subpage"]["financing"][
                                    "button_link"
                                ]; ?>" class="no_hover_underline text_18 text-uppercase line_height_23 d-inline-flex align-items-center justify-content-center font_alt_2 text_semibold"><?php echo $args["page_templates"]["service_subpage"][
    "financing"
]["button_text"]; ?><i class="icon-chevron-right2 text_18 line_height_18 ms-2 position-relative"></i></a>
                              <?php } ?> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
