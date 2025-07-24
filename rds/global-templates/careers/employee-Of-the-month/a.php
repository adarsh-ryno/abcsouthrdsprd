<div class="d-block order-7 order-lg-7 ">
    <div class="container-fluid pt-lg-1 pb-lg-2 pt-1">
        <div class="container pb-lg-2 mb-lg-2 position-relative right-xl-n25 overflow-hidden">
            <div class="row">
                <div class="col-lg-6 offset-lg-6">
                    <h4 class="text-start pb-lg-4 pb-4 mb-0"><?php echo !empty($args["page_templates"]["career_page"]["employee_Of_the_month"]["heading"]) ? $args["page_templates"]["career_page"]["employee_Of_the_month"]["heading"] : ''; ?></h4>
                </div>

                <div class="col-lg-12">
                    <div class="swiper employee-review-swiper pt-1 text-start">
                        <div class="swiper-wrapper">
                            <?php
                            $testimonialsItems = $args["page_templates"]["career_page"]["employee_Of_the_month"]["items"];
                            foreach ($testimonialsItems as $value) {
                                if (!empty($value["month"]) || !empty($value["name"]) || !empty($value["description"]) || !empty($value["position"])) {
                                    $valueAdd = !empty($value["month"]) && !empty($value["name"]) ? " | " : "";
                                    ?>
                                    <div class="swiper-slide">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <img src="<?php echo get_exist_image_url("careers", "employee-1"); ?>" 
                                                     srcset="<?php echo get_exist_image_url("careers", "employee-1"); ?> 1x, <?php echo get_exist_image_url("careers", "employee-1@2x"); ?> 2x, <?php echo get_exist_image_url("careers", "employee-1@3x"); ?> 3x" 
                                                     alt="Review Image" 
                                                     width="540" 
                                                     height="406" 
                                                     class="img-fluid pl-lg-3 w-100">
                                                <div class="d-flex justify-content-end pt-2">
                                                    <?php echo !empty($value["instagram_link"]) ? '<a href="' . $value["instagram_link"] . '" target="_blank" class="d-inline-flex align-items-center justify-content-center rounded-10 color_quaternary_bg true_black text_12 line_height_30 text_normal font_default ms-3 px-3 no_hover_underline">Share | <i class="icon-instagram text_14 ms-1"></i></a>' : ''; ?>
                                                    <?php echo !empty($value["facebook_link"]) ? '<a href="' . $value["facebook_link"] . '" target="_blank" class="d-inline-flex align-items-center justify-content-center rounded-10 color_quaternary_bg true_black text_12 line_height_30 text_normal font_default ms-3 px-3 no_hover_underline">Share | <i class="icon-facebook text_14 ms-1"></i></a>' : ''; ?>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="slide-icon d-flex align-items-end pb-3">
                                                    <i class="icon-quote-left1 text_50 true_black line_height_50 me-3"></i>
                                                    <i class="icon-star1 stars_color text_15 line_height_42 me-1"></i>
                                                    <i class="icon-star1 stars_color text_15 line_height_42 me-1"></i>
                                                    <i class="icon-star1 stars_color text_15 line_height_42 me-1"></i>
                                                    <i class="icon-star1 stars_color text_15 line_height_42 me-1"></i>
                                                    <i class="icon-star1 stars_color text_15 line_height_42 me-1"></i>
                                                </div>
                                                <p class="pt-2 pe-2 pb-2"><?php echo !empty($value["description"]) ? $value["description"] : ''; ?></p>
                                                <strong class="d-block text_14 line_height_23_1 text_semibold">
                                                    <?php echo !empty($value["month"]) ? $value["month"] . $valueAdd : ''; ?>
                                                    <?php echo !empty($value["name"]) ? $value["name"] : ''; ?>
                                                </strong>
                                                <p class="mb-0 position-relative top_n2 transform"><?php echo !empty($value["position"]) ? $value["position"] : ''; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>    
                        </div>
                    </div>
                    <div class="swiper-pagination position-relative employee-review-pagination-a pagination-variation-a text-lg-start text-center pt-lg-0 my-lg-0 mt-5"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function(){
        var swiperEmployeeA = new Swiper(".employee-review-swiper", {
            spaceBetween: 10,
            loop: true,
            slidesPerView: 1,
            autoplay: {
                delay: 8000,
                disableOnInteraction: false,
            },    
            pagination: {
                el: ".employee-review-pagination-a",
                clickable: true,
            },
        });
    });
</script>
