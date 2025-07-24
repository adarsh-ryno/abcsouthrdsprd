<div class="d-block order-7 order-lg-7 ">
    <div class="container-fluid pt-lg-5">
        <div class="container mb-lg-5 position-relative">
            <div class="row ">
                <div class="col-lg-6 pb-lg-0 pb-2">
                <?php
                    // Define paths for child and main themes
                    $child_theme_uri = get_stylesheet_directory_uri();
                    $main_theme_uri = get_template_directory_uri();
                    
                    // Define image paths
                    $image_path = '/img/careers/employee-1.webp';
                    $image_path_2x = '/img/careers/employee-1@2x.webp';
                    $image_path_3x = '/img/careers/employee-1@3x.webp';

                    // Define full image URLs
                    $child_image_url = $child_theme_uri . $image_path;
                    $child_image_url_2x = $child_theme_uri . $image_path_2x;
                    $child_image_url_3x = $child_theme_uri . $image_path_3x;

                    $main_image_url = $main_theme_uri . $image_path;
                    $main_image_url_2x = $main_theme_uri . $image_path_2x;
                    $main_image_url_3x = $main_theme_uri . $image_path_3x;

                    // Check if the image exists in the child theme, else use the main theme
                    if (file_exists(get_stylesheet_directory() . $image_path)) {
                        $img_src = $child_image_url;
                        $img_srcset = $child_image_url . ' 1x, ' . $child_image_url_2x . ' 2x, ' . $child_image_url_3x . ' 3x';
                    } else {
                        $img_src = $main_image_url;
                        $img_srcset = $main_image_url . ' 1x, ' . $main_image_url_2x . ' 2x, ' . $main_image_url_3x . ' 3x';
                    }

                    // Display the image
                    echo '<img src="' . $img_src . '" srcset="' . $img_srcset . '" alt="Review Image" width="540" height="406" class="img-fluid pl-3 mh-lg-406 object-fit w-100 employee-b-img">';
                    ?>
                </div>
                <div class="col-lg-6">
                    <?php
                    // Check if heading exists and is not empty
                    if (!empty($args["page_templates"]["career_page"]["employee_Of_the_month"]["heading"])) {
                        echo '<h4 class="text-center px-lg-5 mx-xl-4 mx-lg-2 pb-lg-4 pb-4 mt-4 mt-lg-0 mb-0">' .
                            $args["page_templates"]["career_page"]["employee_Of_the_month"]["heading"] .
                            '</h4>';
                    }

                    // Check if items exist and is not empty
                    if (!empty($args["page_templates"]["career_page"]["employee_Of_the_month"]["items"])) {
                        echo '<div class="swiper employee-review-swiper pt-1 text-start">
                                <div class="swiper-wrapper">';

                        $testimonialsItems = $args["page_templates"]["career_page"]["employee_Of_the_month"]["items"];
                        foreach ($testimonialsItems as $value) {
                            // Check if description and name are not empty
                            if (!empty($value["description"]) && !empty($value["name"])) {
                                echo '<div class="swiper-slide">
                                        <div class="slide-icon d-flex align-items-end pb-3">
                                            <i class="icon-quote-left1 text_50 line_height_50 true_black me-3"></i>
                                            <i class="icon-star1 stars_color  text_15 line_height_42 me-1"></i>
                                            <i class="icon-star1 stars_color text_15 line_height_42 me-1"></i>
                                            <i class="icon-star1 stars_color text_15 line_height_42 me-1"></i>
                                            <i class="icon-star1 stars_color text_15 line_height_42 me-1"></i>
                                            <i class="icon-star1 stars_color text_15 line_height_42 me-1"></i>
                                        </div>
                                        <p class="pt-2 pe-2 pb-2">' . $value["description"] . '</p>
                                        <strong class="d-block">' . $value["name"] . '</strong>';

                                // Check if "title" key exists and is not empty
                                if (!empty($value["title"])) {
                                    echo '<p class="mb-0 position-relative top_n2 text_12 line_height_19_8">' . $value["title"] . '</p>';
                                }

                                // Check if location and state are not empty
                                if (!empty($value["location"]) && !empty($value["state"])) {
                                    echo '<p class="mb-0 position-relative top_n2 transform">' . $value["location"] . ', ' . $value["state"] . '</p>';
                                }

                                echo '</div>';
                            }
                        }

                        echo '</div>
                            </div>';
                    }
                    ?>
                    <div class="swiper-pagination position-relative employee-review-pagination pagination-variation-a text-lg-start text-center my-lg-0 mb-4 toppagination-margin"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function(){
        var swiperEmployeeB = new Swiper(".employee-review-swiper", {
            spaceBetween: 10,
            slidesPerView: 1,
            loop: true,
            autoplay: {
                delay: 8000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".employee-review-pagination",
                clickable: true,
            },
        });
    });
</script>
