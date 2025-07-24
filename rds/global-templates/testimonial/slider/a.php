<?php
$testimonial = [
    "post_type" => "bc_testimonials",
    "posts_per_page" => 5,
    "order" => "DESC",
    "post_status" => "publish",
];
$query = new WP_Query($testimonial);
if ($query->have_posts()) {

    $heading_tag = isset($args["globals"]["testimonial"]["heading_tag"])
        ? $args["globals"]["testimonial"]["heading_tag"]
        : "h5";
    $subheading_tag = isset($args["globals"]["testimonial"]["subheading_tag"])
        ? $args["globals"]["testimonial"]["subheading_tag"]
        : "h4";
    ?>

    <!-- use this order class order-7 order-lg-7-->
    <div class="d-block px-0 border-top-15">
        <div class="container-fluid pt-lg-5 pb-lg-5 pt-4 px-lg-3 px-0 true_white_bg">
            <div class="container pb-lg-5 mb-lg-5 pt-lg-5 mt-2 mt-lg-4 position-relative right-xl-n25">
                <div class="row">
                    <div class="col-lg-12 text-center px-0 px-lg-3">
                        <div class="slide-icon align-items-center pb-2 justify-content-center">
                            <i class="icon-star1 sm_text_15 sm_line_height_15 text_25 line_height_42 stars_color mx-1"></i>
                            <i class="icon-star1 sm_text_15 sm_line_height_15 text_25 line_height_42 stars_color mx-1"></i>
                            <i class="icon-star1 sm_text_15 sm_line_height_15 text_25 line_height_42 stars_color mx-1"></i>
                            <i class="icon-star1 sm_text_15 sm_line_height_15 text_25 line_height_42 stars_color mx-1"></i>
                            <i class="icon-star1 sm_text_15 sm_line_height_15 text_25 line_height_42 stars_color mx-1"></i>
                        </div>
                        <?php if (!empty($args["globals"]["testimonial"]["heading"])): ?>
                            <<?php echo $heading_tag ?> class="d-lg-none">
                                <?php echo $args["globals"]["testimonial"]["heading"]; ?>
                            </<?php echo $heading_tag ?>>
                        <?php endif; ?>
                        <?php if (!empty($args["globals"]["testimonial"]["subheading"])): ?>
                            <<?php echo $subheading_tag ?> class="text-center px-lg-5 mx-lg-4 mb-0">
                                <?php echo $args["globals"]["testimonial"]["subheading"]; ?>
                            </<?php echo $subheading_tag ?>>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-xl-8 col-lg-10 mx-auto px-5 pt-2 position-relative">
                                <div class="px-lg-2 mx-lg-1">
                                    <div class="swiper review-swiper-a pt-3 pb-6 px-lg-5 px-2 text-center">
                                        <div class="swiper-wrapper ">
                                            <?php while ($query->have_posts()):

                                                $query->the_post();
                                                $name = get_post_meta(
                                                    get_the_ID(),
                                                    "testimonial_name",
                                                    true
                                                );
                                                $title = get_post_meta(
                                                    get_the_ID(),
                                                    "testimonial_title",
                                                    true
                                                );
                                                $message = get_post_meta(
                                                    get_the_ID(),
                                                    "testimonial_message",
                                                    true
                                                );
                                                ?>
                                                <div class="swiper-slide shadow-lg position-relative">
                                                    <p class="p-lg-4 p-3 mb-0  mx-lg-3 pb-4">
                                                        <?php
                                                        $my_content = wp_strip_all_tags(
                                                            $message
                                                        );
                                                        echo wp_trim_words(
                                                            $my_content,
                                                            46
                                                        );
                                                        ?>
                                                    </p>
                                                    <?php if (!empty($name) || !empty($title)): ?>
                                                        <div class="d-lg-block d-none">
                                                            <?php if (!empty($name)): ?>
                                                                <strong class="d-block d-lg-none"><?php echo $name; ?></strong>
                                                            <?php endif; ?>
                                                            <?php if (!empty($title)): ?>
                                                                <p class="mb-0 position-relative top_n2 d-lg-none text_14"><?php echo $title; ?></p>
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
                                            <?php endwhile; ?>    
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-button-next review_next">
                                    <i class="icon-chevron-right text_25 line_height_42  transform_lg"></i>
                                </div>
                                <div class="swiper-button-prev review_prev">
                                    <i class="icon-chevron-left text_25 line_height_42  transform_lg"></i>
                                </div>
                            </div>
                        </div>

                        <?php
                        global $template;
                        if (basename($template) == "rds-landing.php") { ?>
                            <div data-dark-color="color_primary" data-light-color="true_white" class="apply-conditional-color swiper-pagination position-relative review-pagination-a landing_pagination_a pagination-variation-a text-center pt-lg-0 pb-lg-4 py-4 "></div>
                        <?php } else { ?>
                            <div data-dark-color="color_primary" data-light-color="true_white" class="swiper-pagination position-relative review-pagination-a pagination-variation-a text-center pt-lg-0 pb-lg-4 py-4"></div>
                        <?php }
                        ?>
                        <?php if (!empty($args["globals"]["testimonial"]["button_link"]) && !empty($args["globals"]["testimonial"]["button_text"])): ?>
                            <div class="text-center pb-lg-0 pb-5">
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
