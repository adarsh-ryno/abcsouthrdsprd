<?php $testimonial = [
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
        $order_class = isset($args["globals"]["testimonial"]["order"])
            ? "order-" . $args["globals"]["testimonial"]["order"]
            : "order-7";
    }
    $heading_tag = isset($args["globals"]["testimonial"]["heading_tag"])
        ? $args["globals"]["testimonial"]["heading_tag"]
        : "h5";
    $subheading_tag = isset($args["globals"]["testimonial"]["subheading_tag"])
        ? $args["globals"]["testimonial"]["subheading_tag"]
        : "h4";
    $heading = isset($args["globals"]["testimonial"]["heading"]) 
        ? $args["globals"]["testimonial"]["heading"] 
        : '';
    $subheading = isset($args["globals"]["testimonial"]["subheading"]) 
        ? $args["globals"]["testimonial"]["subheading"] 
        : '';
    ?>
<!-- use this order class order-7 order-lg-7-->
    <div class="d-block px-0 border-top-15 <?php echo $order_class ?>">
        <div class="container-fluid pt-lg-5 pb-lg-5 pt-5 px-lg-3 px-0 true_white_bg">
            <div class="container pb-lg-5 mb-lg-5 pt-lg-5 position-relative right-xl-n25">
                <div class="row ">
                    <div class="col-lg-6 pt-4 pt-lg-0 d-lg-block d-none">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/testimonial/reviews-img.webp" srcset="<?php echo get_stylesheet_directory_uri(); ?>/img/testimonial/reviews-img.webp 1x, <?php echo get_stylesheet_directory_uri(); ?>/img/testimonial/reviews-img@2x.webp 2x, <?php echo get_stylesheet_directory_uri(); ?>/img/testimonial/reviews-img@3x.webp 3x" alt="Review Image" width="540" height="542" class="img-fluid pl-3">
                    </div>
                    <div class="col-lg-6">
                        <div class="slide-icon align-items-center pb-2 justify-content-center d-flex d-lg-none">
                            <i class="icon-star1 sm_text_15 sm_line_height_15 text_25 line_height_42 stars_color mx-1"></i>
                            <i class="icon-star1 sm_text_15 sm_line_height_15 text_25 line_height_42 stars_color mx-1"></i>
                            <i class="icon-star1 sm_text_15 sm_line_height_15 text_25 line_height_42 stars_color mx-1"></i>
                            <i class="icon-star1 sm_text_15 sm_line_height_15 text_25 line_height_42 stars_color mx-1"></i>
                            <i class="icon-star1 sm_text_15 sm_line_height_15 text_25 line_height_42 stars_color mx-1"></i>
                        </div>
                        <?php if (!empty($heading)): ?>
                            <<?php echo $heading_tag; ?> class="text-center pt-lg-0 pt-2 px-lg-5 mx-xl-3"><?php echo $heading; ?></<?php echo $heading_tag; ?>>
                        <?php endif; ?>
                        <?php if (!empty($subheading)): ?>
                            <<?php echo $subheading_tag; ?> class="text-center px-lg-5 mx-lg-4 pb-lg-4 pb-4"><?php echo $subheading; ?></<?php echo $subheading_tag; ?>>
                        <?php endif; ?>
                        <div class="slide-icon d-lg-flex d-none align-items-end pb-2">
                            <i class="icon-quote-left1 text_50 line_height_50 me-3 true_black"></i>
                            <i class="icon-star1 text_15 line_height_42 stars_color me-1"></i>
                            <i class="icon-star1 text_15 line_height_42 stars_color me-1"></i>
                            <i class="icon-star1 text_15 line_height_42 stars_color me-1"></i>
                            <i class="icon-star1 text_15 line_height_42 stars_color me-1"></i>
                            <i class="icon-star1 text_15 line_height_42 stars_color me-1"></i>
                        </div>
                        <div class="swiper review-swiper-c pt-1 text-start">
                            <div class="swiper-wrapper">
                                <?php while ($query->have_posts()): $query->the_post();
                                    $name = get_post_meta(get_the_ID(), "testimonial_name", true);
                                    $title = get_post_meta(get_the_ID(), "testimonial_title", true);
                                    $message = get_post_meta(get_the_ID(), "testimonial_message", true);
                                ?>
                                    <div class="swiper-slide pb-lg-4 text-lg-start text-center ps-lg-4">
                                        <?php if (!empty($message)): ?>
                                            <p class="pt-3 pe-lg-2 pb-3">
                                                <?php
                                                $my_content = wp_strip_all_tags($message);
                                                echo wp_trim_words($my_content, 46);
                                                ?>
                                            </p>
                                        <?php endif; ?>
                                        <div class="d-lg-block d-none">
                                            <?php if (!empty($name)): ?>
                                                <strong class="d-block text-capitalize line_height_19_8"><?php echo $name; ?></strong>
                                            <?php endif; ?>
                                            <?php if (!empty($title)): ?>
                                                <p class="mb-0 position-relative top_n4 line_height_19_8 text_14 line_height_30"><?php echo $title; ?></p>
                                            <?php endif; ?>
                                        </div>
                                        <div class="d-lg-none d-block">
                                            <?php if (!empty($name)): ?>
                                                <strong class="d-block font_alt_1 text-capitalize text_bold text_16 line_height_30"><?php echo $name; ?></strong>
                                            <?php endif; ?>
                                            <?php if (!empty($title)): ?>
                                                <p class="mb-0 position-relative top_n4 text_normal text_14 line_height_30"><?php echo $title; ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                    <div data-dark-color="color_primary" data-light-color="true_white" class="apply-conditional-color swiper-pagination position-relative review-pagination-c pagination-variation-a text-lg-start text-center pt-lg-0 pb-lg-2 py-4"></div>
                    <div class="text-lg-start text-center pb-lg-0 pb-5">
                        <?php if (!empty($args["globals"]["testimonial"]["button_link"]) && !empty($args["globals"]["testimonial"]["button_text"])): ?>
                            <a href="<?php echo get_home_url() . $args["globals"]["testimonial"]["button_link"]; ?>" class="btn btn-primary"><?php echo $args["globals"]["testimonial"]["button_text"]; ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>
