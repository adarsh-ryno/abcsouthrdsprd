<?php
$testimonial = [
    "post_type" => "bc_testimonials",
    "posts_per_page" => 5,
    "order" => "DESC",
    "post_status" => "publish",
];
$query = new WP_Query($testimonial);
if ($query->have_posts()) {

    $temName = basename(get_page_template());
    if ($temName === "rds-gallery.php") {
        $order_class = "order-8 ";
    } else {
        $order_class = isset($args["globals"]["testimonial"]["order"]) && !empty($args["globals"]["testimonial"]["order"])
            ? "order-" . $args["globals"]["testimonial"]["order"]
            : "order-7";
    }
    $heading_tag = isset($args["globals"]["testimonial"]["heading_tag"])
        ? $args["globals"]["testimonial"]["heading_tag"]
        : "h5";
    $subheading_tag = isset($args["globals"]["testimonial"]["subheading_tag"])
        ? $args["globals"]["testimonial"]["subheading_tag"]
        : "h4";
    ?>

    <!-- use this order class order-7 order-lg-7-->
    <div class="d-block <?php echo $order_class ?> px-0">
        <div class="container-fluid pt-lg-5 pb-lg-5 pt-5 true_white_bg">
            <div class="container pb-lg-5 mb-lg-5 position-relative right-xl-n25">
                <div class="row align-items-lg-center">
                    <div class="col-lg-5 pt-4 pe-xl-2 text-lg-start text-center">
                        <?php if (!empty($args["globals"]["testimonial"]["heading"])): ?>
                            <<?php echo $heading_tag ?> class="pe-lg-5 me-lg-5 mb-0">
                                <?php echo $args["globals"]["testimonial"]["heading"]; ?>
                            </<?php echo $heading_tag ?>>
                        <?php endif; ?>
                        <?php if (!empty($args["globals"]["testimonial"]["subheading"])): ?>
                            <<?php echo $subheading_tag ?> class="pe-lg-4 me-xl-4 mb-0 py-4">
                                <?php echo $args["globals"]["testimonial"]["subheading"]; ?>
                            </<?php echo $subheading_tag ?>>
                        <?php endif; ?>
                        <?php if (!empty($args["globals"]["testimonial"]["button_link"]) || !empty($args["globals"]["testimonial"]["button_text"])): ?>
                            <div class="text-lg-start text-center pb-lg-0">
                                <a href="<?php echo get_home_url() . $args["globals"]["testimonial"]["button_link"]; ?>" class="btn btn-primary">
                                    <?php echo $args["globals"]["testimonial"]["button_text"]; ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-7 ps-lg-0">

                        <!-- Swiper -->
                        <div class="swiper review-swiper-b pt-1 pt-4 ps-3 pe-lg-2 pe-3 text-start">
                            <div class="swiper-wrapper">
                                <?php while ($query->have_posts()):

                                    $query->the_post();
                                    $name = get_post_meta(get_the_ID(), "testimonial_name", true);
                                    $title = get_post_meta(get_the_ID(), "testimonial_title", true);
                                    $message = get_post_meta(get_the_ID(), "testimonial_message", true);
                                    ?>
                                    <div class="swiper-slide pb-lg-4 pe-lg-2 pt-lg-2">
                                        <div class="border-left-primary py-lg-4 py-3 px-lg-0 px-3 shadow position-relative">
                                            <div class="review-quote-icon d-flex top-n18 left-n20 w-35 h-35 justify-content-center p-alt color_primary_bg rounded-circle position-absolute align-items-center">
                                                <i class="p-alt icon-quote-left1 line_height_18 text_18"></i>
                                            </div>
                                            <div class="row align-items-lg-center">
                                                <div class="col-lg-9 border-lg-right-1">
                                                    <p class="py-lg-0 mb-lg-0 pe-lg-0 pb-3 ps-lg-4">
                                                        <?php
                                                        $my_content = wp_strip_all_tags($message);
                                                        echo wp_trim_words($my_content, 46);
                                                        ?>
                                                    </p>
                                                </div>
                                                <div class="col-lg-3">
                                                    <?php if (!empty($name) || !empty($title)): ?>
                                                        <div class="slide-icon d-none align-items-center pb-lg-0 pb-2 d-lg-flex justify-content-start">
                                                            <i class="icon-star-sharp1 text_12 stars_color line_height_12 mr-1"></i>
                                                            <i class="icon-star-sharp1 text_12 stars_color line_height_12 mr-1"></i>
                                                            <i class="icon-star-sharp1 text_12 stars_color line_height_12 mr-1"></i>
                                                            <i class="icon-star-sharp1 text_12 stars_color line_height_12 mr-1"></i>
                                                            <i class="icon-star-sharp1 text_12 stars_color line_height_12 mr-1"></i>
                                                        </div>
                                                        <div class="d-lg-block d-none">
                                                            <?php if (!empty($name)): ?>
                                                                <strong class="d-block text_14 line_height_23_1 text-capitalize"><?php echo $name; ?></strong>
                                                            <?php endif; ?>
                                                            <?php if (!empty($title)): ?>
                                                                <p class="mb-0 position-relative top_n2 text_12 line_height_19_8"><?php echo $title; ?></p>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="d-lg-none d-block">
                                                            <?php if (!empty($name)): ?>
                                                                <strong class="d-block text-capitalize font_alt_1 text_bold text_16 line_height_30"><?php echo $name; ?></strong>
                                                            <?php endif; ?>
                                                            <?php if (!empty($title)): ?>
                                                                <p class="mb-0 position-relative top_n4 text_normal text_14 line_height_30"><?php echo $title; ?></p>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>  
                            </div>
                            <div data-dark-color="color_primary" data-light-color="true_white" class="apply-conditional-color swiper-pagination review-pagination-b pagination-variation-a position-relative py-lg-0 py-4"></div>
                        </div>

                        <?php if (!empty($args["globals"]["testimonial"]["button_link"]) || !empty($args["globals"]["testimonial"]["button_text"])): ?>
                            <div class="text-lg-start text-center d-lg-none pb-lg-0 pb-5">
                                <a href="<?php echo get_home_url() . $args["globals"]["testimonial"]["button_link"]; ?>" class="btn btn-primary">
                                    <?php echo $args["globals"]["testimonial"]["button_text"]; ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>
