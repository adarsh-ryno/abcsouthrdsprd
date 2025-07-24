<div class="d-block py-lg-5 pt-4">
    <div class="container-fluid text-center px-lg-3 px-0 py-5 py-lg-4 ">
        <?php
        $img1x = [
            get_exist_image_url("fullwidth-cta", "financing-b-bg"),
            get_exist_image_url("fullwidth-cta", "financing-b-bg@2x"),
            get_exist_image_url("fullwidth-cta", "financing-b-bg@3x"),
        ];

        $img2x = [
            get_exist_image_url("fullwidth-cta", "financing-b-bg"),
            get_exist_image_url("fullwidth-cta", "financing-b-bg@2x"),
            get_exist_image_url("fullwidth-cta", "financing-b-bg@3x"),
        ];

        $img3x = [
            get_exist_image_url("fullwidth-cta", "financing-b-bg"),
            get_exist_image_url("fullwidth-cta", "financing-b-bg@2x"),
            get_exist_image_url("fullwidth-cta", "financing-b-bg@3x"),
        ];

        $img1x = implode(",", $img1x);
        $img2x = implode(",", $img2x);
        $img3x = implode(",", $img3x);
        ?>
        <?php echo do_shortcode(
            '[custom-bg-srcset class="financing-bg" img1x="' .
                esc_attr($img1x) .
                '" img2x="' .
                esc_attr($img2x) .
                '" img3x="' .
                esc_attr($img3x) .
                '" size1x="cover" size2x="cover" size3x="cover"]'
        ); ?>
        <div class="container py-lg-3 py-2 financing-bg" style="background-size:cover; background-position:center;">
            <div class="row align-items-center px-lg-5">
                <div class="col-sm-12 col-lg-3 text-lg-start text-center">
                    <div class="color_primary_bg rounded-circle w-150 h-150 d-flex align-items-center justify-content-center mx-lg-0 mx-auto">
                        <i class="p-alt icon-dollar-sign3 text_100 line_height_100"></i>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-6 text-center py-lg-0 py-4">
                    <?php if (!empty($args["globals"]["financing"]["heading"])): ?>
                        <h4><?php echo $args["globals"]["financing"]["heading"]; ?></h4>
                    <?php endif; ?>
                    <?php if (!empty($args["globals"]["financing"]["subheading"])): ?>
                        <h5 class="mt-2 mb-0"><?php echo $args["globals"]["financing"]["subheading"]; ?></h5>
                    <?php endif; ?>
                </div>
                <div class="col-sm-12 col-lg-3 text-center text-lg-end">
                    <?php if (!empty($args["globals"]["financing"]["button_link"])): ?>
                        <a href="<?php echo esc_url(get_home_url() . $args["globals"]["financing"]["button_link"]); ?>" class="no_hover_underline">
                            <i class="icon-right-to-line2 text_100 line_height_100"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
