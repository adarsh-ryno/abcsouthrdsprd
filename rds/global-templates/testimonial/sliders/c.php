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

    $heading_tag = isset($args["globals"]["testimonial"]["heading_tag"]) ? $args["globals"]["testimonial"]["heading_tag"] : "h5";
    $subheading_tag = isset($args["globals"]["testimonial"]["subheading_tag"]) ? $args["globals"]["testimonial"]["subheading_tag"] : "h4";
    ?>
    <!-- use this order class order-7 order-lg-7-->
    <div class="d-block px-0 border-top-15 d-block px-0 border-top-15">
        <div class="container-fluid pt-lg-2 pb-lg-2 pt-5 px-lg-3 px-0">
            <div class="container pb-lg-2 mb-lg-5 pt-lg-2 position-relative right-xl-n25">
                <div class="row">
                    <div class="col-lg-6 pt-4 pt-lg-0 d-lg-block d-none">
                        <img src="<?php echo get_exist_image_url("testimonial", "reviews-img"); ?>" 
                            srcset="<?php echo get_exist_image_url("testimonial", "reviews-img"); ?> 1x, 
                                    <?php echo get_exist_image_url("testimonial", "reviews-img@2x"); ?> 2x, 
                                    <?php echo get_exist_image_url("testimonial", "reviews-img@3x"); ?> 3x" 
                            alt="Review Image" width="540" height="542" 
                            class="img-fluid pl-3 h-100">
                    </div>
                    <div class="col-lg-6">
                        <div class="slide-icon align-items-center pb-2 justify-content-center d-flex d-lg-none">
                            <i class="icon-star1 sm_text_15 sm_line_height_15 text_25 line_height_42 stars_color mx-1"></i>
                            <i class="icon-star1 sm_text_15 sm_line_height_15 text_25 line_height_42 stars_color mx-1"></i>
                            <i class="icon-star1 sm_text_15 sm_line_height_15 text_25 line_height_42 stars_color mx-1"></i>
                            <i class="icon-star1 sm_text_15 sm_line_height_15 text_25 line_height_42 stars_color mx-1"></i>
                            <i class="icon-star1 sm_text_15 sm_line_height_15 text_25 line_height_42 stars_color mx-1"></i>
                        </div>
                        <?php if (!empty($args["globals"]["testimonial"]["heading"])): ?>
                            <<?php echo $heading_tag ?> class="text-center pt-lg-0 pt-2 px-lg-5 mx-xl-3"><?php echo $args["globals"]["testimonial"]["heading"]; ?></<?php echo $heading_tag ?>>
                        <?php endif; ?>
                        <?php if (!empty($args["globals"]["testimonial"]["subheading"])): ?>
                            <<?php echo $subheading_tag ?> class="text-center px-lg-5 mx-lg-4 pb-lg-4 pb-4"><?php echo $args["globals"]["testimonial"]["subheading"]; ?></<?php echo $subheading_tag ?>>
                        <?php endif; ?>
                        <div class="slide-icon d-lg-flex d-none align-items-end">
                            <i class="icon-quote-left1 text_50 line_height_50 me-3 true_black"></i>
                            <i class="icon-star1 text_15 line_height_42 stars_color me-1"></i>
                            <i class="icon-star1 text_15 line_height_42 stars_color me-1"></i>
                            <i class="icon-star1 text_15 line_height_42 stars_color me-1"></i>
                            <i class="icon-star1 text_15 line_height_42 stars_color me-1"></i>
                            <i class="icon-star1 text_15 line_height_42 stars_color me-1"></i>
                        </div>
                        <div class="swiper review-swiper-c-<?php echo $widget_id ?> pt-1 text-start">
                            <div class="swiper-wrapper">
                                <?php while ($query->have_posts()): $query->the_post();
                                    $name = get_post_meta(get_the_ID(), "testimonial_name", true);
                                    $city = get_post_meta(get_the_ID(), "testimonial_city", true);
                                    $state = get_post_meta(get_the_ID(), "testimonial_state", true);
                                    $message = get_post_meta(get_the_ID(), "testimonial_message", true);
                                    ?>
                                    <div class="swiper-slide pb-lg-4 text-lg-start text-center">
                                        <?php if (!empty($message)): ?>
                                            <p class="pt-3 pe-lg-2 pb-3"><?php
                                                $my_content = wp_strip_all_tags($message);
                                                echo wp_trim_words($my_content, 46);
                                            ?></p>
                                        <?php endif; ?>
                                        <?php if (!empty($name) || !empty($city) || !empty($state)): ?>
                                            <div class="d-lg-block d-none">
                                                <?php if (!empty($name)): ?>
                                                    <strong class="d-block text-capitalize line_height_19_8"><?php echo $name; ?></strong>
                                                <?php endif; ?>
                                                <p class="mb-0 position-relative top_n4 line_height_19_8 text_14 line_height_30">
                                                    <?php 
                                                    if (!empty($city) && !empty($state)) {
                                                        echo $city . ", " . $state;
                                                    } elseif (!empty($city)) {
                                                        echo $city;
                                                    } elseif (!empty($state)) {
                                                        echo $state;
                                                    } 
                                                    ?>
                                                </p>
                                            </div>
                                            <div class="d-lg-none d-block">
                                                <?php if (!empty($name)): ?>
                                                    <strong class="d-block font_alt_1 text-capitalize text_bold text_16 line_height_30"><?php echo $name; ?></strong>
                                                <?php endif; ?>
                                                <p class="mb-0 position-relative top_n4 text_normal text_14 line_height_30">
                                                    <?php 
                                                    if (!empty($city) && !empty($state)) {
                                                        echo $city . ", " . $state;
                                                    } elseif (!empty($city)) {
                                                        echo $city;
                                                    } elseif (!empty($state)) {
                                                        echo $state;
                                                    } 
                                                    ?>
                                                </p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                        <div data-dark-color="color_primary" class="review-pagination-c-<?php echo $widget_id ?> apply-conditional-color swiper-pagination position-relative pagination-variation-a text-lg-start text-center pt-lg-0 pb-lg-2 py-4" id="rds-testimonial-ew-pg-c-<?php echo $widget_id ?> "></div>
                        <?php if (!empty($args["globals"]["testimonial"]["button_text"])): ?>
                            <div class="text-lg-start text-center pb-lg-0 pb-4 mb-3 mb-lg-0 ">
                                <a href="<?php echo get_home_url() . $args["globals"]["testimonial"]["button_link"]; ?>" class="btn btn-primary" target="<?php echo isset($args["globals"]["testimonial"]["is_external"]) ? $args["globals"]["testimonial"]["is_external"] : false; ?>"><?php echo $args["globals"]["testimonial"]["button_text"]; ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    <script type="text/javascript">
        jQuery(document).ready(function () {
            var swiper = new Swiper(".review-swiper-c-<?php echo $widget_id ?>", {
                spaceBetween: 10,
                slidesPerView: 1,
                loop: true,
                autoplay: {
                    delay: 8000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".review-pagination-c-<?php echo $widget_id ?>",
                    clickable: true
                },
                // allowTouchMove: false,
            });
        })
    </script>
    <?php
}
