<?php
$widget_id = 32453;
$category_name = $args["category_taxonomy"];
if (empty($category_name) || in_array('all', $category_name)) {
    $testimonial = array(
        'post_type'      => 'bc_testimonials',
        'posts_per_page' => 5,
        'order'          => 'DESC',
        'meta_query'     => array(
            'relation' => 'OR',
            array(
                'key'     => 'testimonial_landing_page',
                'compare' => 'NOT EXISTS', // Exclude posts where the 'testimonial_landing_page' meta key doesn't exist
            ),
            array(
                'key'     => 'testimonial_landing_page',
                'value'   => '0', // Exclude posts where 'testimonial_landing_page' is set to 1
                'compare' => '=', 
                'type'    => 'NUMERIC',
            ),
        ),
        'post_status'    => 'publish',
        
    );
} else {
    $testimonial = array(
        'post_type'      => 'bc_testimonials',
        'posts_per_page' => 5,
        'order'          => 'DESC',
        'meta_query'     => array(
            'relation' => 'OR',
            array(
                'key'     => 'testimonial_landing_page',
                'compare' => 'NOT EXISTS', // Exclude posts where the 'testimonial_landing_page' meta key doesn't exist
            ),
            array(
                'key'     => 'testimonial_landing_page',
                'value'   => '0', // Exclude posts where 'testimonial_landing_page' is set to 1
                'compare' => '=', 
                'type'    => 'NUMERIC',
            ),
        ),
        'post_status'    => 'publish',
        'tax_query' => [
            'relation' => 'OR', 
            [
                'taxonomy' => 'bc_testimonial_category',
                'field'    => 'name',
                'terms' => $category_name,
                'operator' => 'IN', 
            ],
        ],
    );
}

$query = new WP_Query($testimonial);

if ($query->have_posts()) {

    $heading_tag = isset($args["globals"]["testimonial"]["heading_tag"])
        ? $args["globals"]["testimonial"]["heading_tag"]
        : "h5";
    $subheading_tag = isset($args["globals"]["testimonial"]["subheading_tag"])
        ? $args["globals"]["testimonial"]["subheading_tag"]
        : "h4";
    ?>
    <div class="d-block px-0 border-top-15">
        <div class="container-fluid pt-lg-2 pb-lg-2 pt-4 px-lg-3 px-0">
            <div class="container pb-lg-2 mb-lg-2 pt-lg-2 mt-2 mt-lg-3 position-relative right-xl-n25">
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
                            <<?php echo $heading_tag ?> class="d-none"><?php echo $args["globals"]["testimonial"]["heading"]; ?></<?php echo $heading_tag ?>>
                        <?php endif; ?>
                        <?php if (!empty($args["globals"]["testimonial"]["subheading"])): ?>
                            <<?php echo $subheading_tag ?> class="text-center px-lg-5 mx-lg-4 mb-0"><?php echo $args["globals"]["testimonial"]["subheading"]; ?></<?php echo $subheading_tag ?>>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-lg-8 mx-auto px-5 pt-2 position-relative">
                                <div class="px-lg-2 mx-lg-1">
                                    <div class="swiper review-swiper-a review-swiper-a-<?php echo $widget_id ?> pt-3 pb-6 px-lg-5 px-2 text-center testimonials-elementor-widget-slider-a ">
                                        <div class="swiper-wrapper align-items-center">
                                            <?php while ($query->have_posts()): $query->the_post();
                                                $name = get_post_meta(get_the_ID(), "testimonial_name", true);
                                                $city = get_post_meta(get_the_ID(), "testimonial_city", true);
                                                $state = get_post_meta(get_the_ID(), "testimonial_state", true);
                                                $message = get_post_meta(get_the_ID(), "testimonial_message", true);
                                                ?>
                                                <div class="swiper-slide shadow position-relative">
                                                    <?php if (!empty($message)): ?>
                                                        <p class="p-lg-4 p-3 mb-0 mx-lg-3 pb-4">
                                                            <?php
                                                            $my_content = wp_strip_all_tags($message);
                                                            echo wp_trim_words($my_content, 56);
                                                            ?>
                                                        </p>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endwhile; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-button-next review_next review_next_a">
                                    <i class="icon-chevron-right text_25 line_height_42 transform_lg"></i>
                                </div>
                                <div class="swiper-button-prev review_prev review_prev_a">
                                    <i class="icon-chevron-left text_25 line_height_42 transform_lg"></i>
                                </div>
                            </div>
                        </div>
                        <?php
                        global $template;
                        if (!empty($template) && basename($template) == "rds-landing.php"): ?>
                            <div data-dark-color="color_primary" class="apply-conditional-color swiper-pagination position-relative review-pagination-a-<?php echo $widget_id ?> landing_pagination_a pagination-variation-a text-center pt-lg-0 pb-lg-4 py-4 "></div>
                        <?php else: ?>
                            <div data-dark-color="color_primary" class="swiper-pagination position-relative review-pagination-a-<?php echo $widget_id ?> pagination-variation-a text-center pt-lg-0 pb-lg-4 py-4"></div>
                        <?php endif; ?>
                        <div class="text-center pb-lg-0 pb-4 mb-3 mb-lg-0">
                            <?php if (!empty($args["globals"]["testimonial"]["button_text"])): ?>
                                <a href="<?php echo get_home_url() . $args["globals"]["testimonial"]["button_link"]; ?>" class="btn btn-primary" target="<?php echo isset($args["globals"]["testimonial"]["is_external"]) ? $args["globals"]["testimonial"]["is_external"] : false; ?>"><?php echo $args["globals"]["testimonial"]["button_text"]; ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            var swiper = new Swiper(".review-swiper-a-<?php echo $widget_id ?>", {
                spaceBetween: 70,
                slidesPerView: 1,
                loop: true,
                autoplay: {
                    delay: 8000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".review-pagination-a-<?php echo $widget_id ?>",
                    clickable: true
                },
                navigation: {
                    nextEl: ".review_next",
                    prevEl: ".review_prev"
                },
                // allowTouchMove: false,
            });
        });
    </script>
    <?php
}
?>
