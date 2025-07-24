<?php
$heading_tag = !empty($args["page_templates"]["service_subpage"]["financing"]["heading_tag"])
    ? $args["page_templates"]["service_subpage"]["financing"]["heading_tag"]
    : "h4";
$subheading_tag = !empty($args["page_templates"]["service_subpage"]["financing"]["subheading_tag"])
    ? $args["page_templates"]["service_subpage"]["financing"]["subheading_tag"]
    : "h5";
?>
<div class="d-block order-lg-2 order-2 mb-5">
    <div class="container-fluid text-center px-lg-3 px-0 py-5 py-lg-4">
        <?php
        // example of how to set image sizewise
        // ['desktop', 'ipad', 'mobile']

        $img1x = [
            get_exist_image_url("fullwidth-cta", "financing-b-bg.webp"),
            get_exist_image_url("fullwidth-cta", "financing-b-bg@2x.webp"),
            get_exist_image_url("fullwidth-cta", "financing-b-bg@3x.webp"),
        ];

        $img2x = [
            get_exist_image_url("fullwidth-cta", "financing-b-bg.webp"),
            get_exist_image_url("fullwidth-cta", "financing-b-bg@2x.webp"),
            get_exist_image_url("fullwidth-cta", "financing-b-bg@3x.webp"),
        ];

        $img3x = [
            get_exist_image_url("fullwidth-cta", "financing-b-bg.webp"),
            get_exist_image_url("fullwidth-cta", "financing-b-bg@2x.webp"),
            get_exist_image_url("fullwidth-cta", "financing-b-bg@3x.webp"),
        ];

        $img1x = implode(",", $img1x);
        $img2x = implode(",", $img2x);
        $img3x = implode(",", $img3x);
        ?>
        <?= do_shortcode(
            '[custom-bg-srcset class="financing-bg" img1x="' . $img1x . '" img2x="' . $img2x . '" img3x="' . $img3x . '" size1x="cover" size2x="cover" size3x="cover"]'
        ); ?>
        <div class="container py-lg-3 py-2 financing-bg">
            <div class="px-lg-5">
                <div class="row align-items-center px-lg-5">
                    <div class="col-sm-12 col-lg-3 text-lg-start text-center">
                        <div class="rounded-circle w-150 h-150 d-flex align-items-center justify-content-center mx-lg-0 mx-auto">
                            <i class="p-alt icon-circle-dollar1 text_100 line_height_100"></i>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6 text-center py-lg-0 py-4">
                        <?php if (!empty($args["page_templates"]["service_subpage"]["financing"]["heading"])): ?>
                            <<?php echo $heading_tag ?> class="">
                                <?php echo $args["page_templates"]["service_subpage"]["financing"]["heading"]; ?>
                            </<?php echo $heading_tag ?>>
                        <?php endif; ?>
                        <?php if (!empty($args["page_templates"]["service_subpage"]["financing"]["subheading"])): ?>
                            <<?php echo $subheading_tag ?> class="mt-2 mb-0">
                                <?php echo $args["page_templates"]["service_subpage"]["financing"]["subheading"]; ?>
                            </<?php echo $subheading_tag ?>>
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-12 col-lg-3 text-center text-lg-end">
                        <?php if (!empty($args["page_templates"]["service_subpage"]["financing"]["button_text"]) && !empty($args["page_templates"]["service_subpage"]["financing"]["button_link"])): ?>
                            <a href="<?= get_home_url() . $args["page_templates"]["service_subpage"]["financing"]["button_link"]; ?>" class="no_hover_underline">
                                <i class="icon-right-to-line2 text_100 line_height_100"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
