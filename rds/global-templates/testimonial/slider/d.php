<?php
$testimonial = [
	"post_type" => "bc_testimonials",
	"posts_per_page" => 5,
	"order" => "DESC",
	"post_status" => "publish",
];
$heading_tag = isset($args["globals"]["testimonial"]["heading_tag"])
	? $args["globals"]["testimonial"]["heading_tag"]
	: "h5";
$subheading_tag = isset($args["globals"]["testimonial"]["subheading_tag"])
	? $args["globals"]["testimonial"]["subheading_tag"]
	: "h4";

$query = new WP_Query($testimonial);
if ($query->have_posts()) { ?>    
    <div class="d-block order-6 order-lg-6 mt-lg-n5">
        <div class="container-fluid pt-lg-0 pb-lg-5 px-lg-3 px-0 mt-lg-n5 position-relative z-index true_white_bg">

            <div class="container pb-lg-5 mb-lg-5 pt-5  position-relative true_white_bg mt-lg-n5 position-relative z-index shadow-md-alt border-top-tertiary-10">
                <div class="row ">

                    <div class="col-lg-11 text-center px-0 px-lg-3 mx-auto">

                        <div class="slide-icon align-items-center pb-2 justify-content-center">
                            <i class="icon-star1 sm_text_15 sm_line_height_15 text_25 line_height_42 stars_color mx-1"></i>
                            <i class="icon-star1 sm_text_15 sm_line_height_15 text_25 line_height_42 stars_color mx-1"></i>
                            <i class="icon-star1 sm_text_15 sm_line_height_15 text_25 line_height_42 stars_color mx-1"></i>
                            <i class="icon-star1 sm_text_15 sm_line_height_15 text_25 line_height_42 stars_color mx-1"></i>
                            <i class="icon-star1 sm_text_15 sm_line_height_15 text_25 line_height_42 stars_color mx-1"></i>
                        </div>

                        <<?php echo $subheading_tag ?> class="text-center px-lg-5 mx-lg-4 mb-0"><?php echo $args[
 	"globals"
 ]["testimonial"]["subheading"]; ?></<?php echo $subheading_tag ?>>
                        <div class="row mx-0">
                            <div class="col-lg-12 mx-auto px-lg-5 pt-2 position-relative">
                                <div class="px-lg-2 mx-lg-1">
                                    <div class="swiper review-swiper-d pt-3 pb-lg-5 px-lg-5 px-2 text-center">
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
                                                <div class="swiper-slide  position-relative">
                                                    <p class="p-lg-4 p-3 mb-0  mx-lg-3 pb-4"><?php
                                                    $my_content = wp_strip_all_tags(
                                                    	$message
                                                    );
                                                    echo wp_trim_words(
                                                    	$my_content,
                                                    	46
                                                    );
                                                    ?></p>
                                                    <div class="slide-icon align-items-center pb-2 justify-content-center">
                                                        <i class="icon-star1  text_15 line_height_15 stars_color mx-1"></i>
                                                        <i class="icon-star1  text_15 line_height_15 stars_color mx-1"></i>
                                                        <i class="icon-star1  text_15 line_height_15 stars_color mx-1"></i>
                                                        <i class="icon-star1  text_15 line_height_15 stars_color mx-1"></i>
                                                        <i class="icon-star1  text_15 line_height_15 stars_color mx-1"></i>
                                                    </div>
                                                    <div class="d-lg-block d-none">
                                                        <strong class="d-block  line_height_26_4 "><?php echo $name; ?></strong>
                                                    </div>
                                                    <div class="d-lg-none d-block">
                                                        <strong class="d-block text-capitalize font_alt_1 text_bold text_16 line_height_30"><?php echo $name; ?></strong>

                                                    </div>
                                                </div>
                                            <?php
                                            endwhile; ?>
                                        </div>

                                    </div>
                                </div>
                                <div class="swiper-button-next review_next_d d-lg-block d-none">
                                    <i class="icon-chevron-right text_25 line_height_42  transform_lg"></i>
                                </div>
                                <div class="swiper-button-prev review_prev_d d-lg-block d-none">
                                    <i class="icon-chevron-left text_25 line_height_42 transform_lg"></i>
                                </div>

                            </div>
                        </div>
                        <div data-dark-color="color_primary" data-light-color="true_white" class="apply-conditional-color swiper-pagination position-relative review-pagination-d pagination-variation-a text-center pt-lg-0 pb-lg-4 py-4 d-lg-none"></div>
                        <div class="text-center pb-lg-0 pb-5">
                            <a href="<?php echo get_home_url() .
                            	$args["globals"]["testimonial"][
                            		"button_link"
                            	]; ?>" class="btn btn-info-alt "><?php echo $args[
	"globals"
]["testimonial"]["button_text"]; ?> <i class="icon-chevron-right1 ms-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php }
?> 
<script type="text/javascript">
    jQuery(document).ready(function () {
        var swiper = new Swiper(".review-swiper-d", {
            spaceBetween: 70,
            slidesPerView: 1,
            loop: true,
            pagination: {
                el: ".review-pagination-d",
                clickable: true,
            },
            navigation: {
                nextEl: ".review_next_d",
                prevEl: ".review_prev_d",
            },

        });
    });
</script>