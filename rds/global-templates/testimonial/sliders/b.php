<?php 
$widget_id = 32453;
$category_name = $args['category_taxonomy'];
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
    <!-- use this order class order-7 order-lg-7-->
    <div class="d-block pt-lg-3 pb-lg-2 px-0">    
        <div class="border-top-tertiary d-lg-none"></div>
        <div class="container-fluid mt-3 mt-lg-0">
            <div class="container pb-lg-2 position-relative right-xl-n25">
                <div class="row align-items-lg-center">
                    <div class="col-lg-5 pt-4 pe-xl-2 text-lg-start text-center">
                        <?php if (!empty($args["globals"]["testimonial"]["heading"])): ?>
                            <<?php echo $heading_tag ?> class="pe-lg-5 me-lg-5 mb-0"><?php echo $args["globals"]["testimonial"]["heading"]; ?></<?php echo $heading_tag ?>>
                        <?php endif; ?>
                        <?php if (!empty($args["globals"]["testimonial"]["subheading"])): ?>
                            <<?php echo $subheading_tag ?> class="pe-lg-4 me-xl-4 mb-0 py-4">
                            <?php echo $args["globals"]["testimonial"]["subheading"]; ?>.</<?php echo $subheading_tag ?>>
                        <?php endif; ?>
                        <div class="text-lg-start text-center pb-lg-0 ">
                        <?php if (!empty($args["globals"]["testimonial"]["button_text"])): ?>
                            <a href="<?php echo esc_url(get_home_url() . $args["globals"]["testimonial"]["button_link"]); ?>" class="btn btn-primary" target="<?php echo isset($args["globals"]["testimonial"]["is_external"]) ? esc_attr($args["globals"]["testimonial"]["is_external"]) : "_self"; ?>">
                                <?php echo esc_html($args["globals"]["testimonial"]["button_text"]); ?>
                            </a>
                        <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-7 ps-lg-0 px-0">
                        <!-- Swiper -->
                        <div class="swiper ps-xl-3 review-swiper-b pt-1 pt-4 pe-lg-2 pe-3 text-start review-swiper-b-<?php echo $widget_id ?>" >
                            <div class="swiper-wrapper">
                                <?php while ($query->have_posts()): $query->the_post();
                                    $name = get_post_meta(get_the_ID(), "testimonial_name", true);
                                    $city = get_post_meta(get_the_ID(), "testimonial_city", true);
                                    $state = get_post_meta(get_the_ID(), "testimonial_state", true);
                                    $message = get_post_meta(get_the_ID(), "testimonial_message", true);
                                ?>
                                <div class="swiper-slide pb-lg-1 pe-lg-2 pt-lg-2">
                                    <div class="border-left-primary py-lg-4 py-3 px-lg-0 ps-3 ps-lg-0 shadow position-relative testimonial-border">
                                        <div class="review-quote-icon d-flex top-n18 left-n20 w-35 h-35 justify-content-center p-alt color_primary_bg rounded-circle position-absolute align-items-center position-absolute"><i class=" p-alt icon-quote-left1 line_height_18 text_18 "></i></div>
                                        <div class="row align-items-lg-center">
                                            <div class="col-lg-9 border-lg-right-1">
                                                <?php if (!empty($message)): ?>
                                                    <p class="py-lg-0 mb-lg-0 pe-lg-0 pb-3 ps-lg-4"><?php echo wp_trim_words(wp_strip_all_tags($message), 56); ?></p>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="slide-icon d-none align-items-center pb-lg-0 pb-2 d-lg-flex justify-content-start">
                                                    <i class="icon-star-sharp1 text_12 stars_color line_height_12 mr-1"></i>
                                                    <i class="icon-star-sharp1 text_12 stars_color line_height_12 mr-1"></i>
                                                    <i class="icon-star-sharp1 text_12 stars_color line_height_12 mr-1"></i>
                                                    <i class="icon-star-sharp1 text_12 stars_color line_height_12 mr-1"></i>
                                                    <i class="icon-star-sharp1 text_12 stars_color line_height_12 mr-1"></i>
                                                </div>
                                                <?php if (!empty($name)): ?>
                                                    <div class="d-lg-block d-none">
                                                        <strong class="d-block text_14 line_height_23_1 text-capitalize"><?php echo $name; ?></strong>
                                                        <p class="mb-0 position-relative top_n2 text_12 line_height_19_8"><?php echo $city; if (!empty($state)) { echo "," . $state; } ?></p>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (!empty($name)): ?>
                                                    <div class="d-lg-none d-block">
                                                        <strong class="d-block text-capitalize font_alt_1 text_bold text_16 line_height_30"><?php echo $name; ?></strong>
                                                        <p class="mb-0 position-relative top_n4 text_normal text_14 line_height_30"><?php echo $city; if (!empty($state)) { echo "," . $state; } ?></p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endwhile; ?>  
                            </div>
                            <div data-dark-color="color_primary" class="apply-conditional-color swiper-pagination review-pagination-b review-pagination-b-<?php echo $widget_id ?> position-relative py-lg-0 mt-4 mb-lg-4 mb-0 py-4 toppagination-margin"></div>
                        </div>
                        <div class="text-lg-start text-center d-lg-none pb-lg-0 pb-4 mb-3 mb-lg-0">
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
            var swiperReviewB = new Swiper(".review-swiper-b", {
                spaceBetween: 30,
                slidesPerView: 1,
                loop: true,
                autoplay: {
                    delay: 8000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".review-pagination-b",
                    clickable: true,
                },
                // allowTouchMove: false,
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                        grid: {
                            rows: 1,
                        },
                        spaceBetween: 60,
                    },
                    768: {
                        slidesPerView: 1,
                        spaceBetween: 60,
                        grid: {
                            rows: 1,
                        },
                    },
                    992: {
                        slidesPerView: 1,
                        spaceBetween: 30,
                        grid: {
                            rows: 2,
                        },
                    },
                },
            });
        })
    </script>
<?php
}
