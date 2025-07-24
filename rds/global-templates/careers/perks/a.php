<div class="container-fluid py-lg-5 mb-5">
    <div class="container pb-lg-5 pb-4">
        <div class="swiper carrer_icon_swiper">
            <div class="swiper-wrapper flex-lg-wrap">
                <?php
                // Check if $iconItems is an array and not empty
                if (!empty($args["page_templates"]["career_page"]["perks"]["items"]) && is_array($args["page_templates"]["career_page"]["perks"]["items"])) {
                    $iconItems = $args["page_templates"]["career_page"]["perks"]["items"];
                    foreach ($iconItems as $value) {
                        // Check if the necessary keys exist and are not empty
                        $icon = !empty($value["icon"]) ? esc_attr($value["icon"]) : '';
                        $heading = !empty($value["heading"]) ? esc_html($value["heading"]) : '';
                        $description = !empty($value["description"]) ? esc_html($value["description"]) : '';

                        // Output the HTML
                        echo '<div class="swiper-slide col-lg-4 pt-5 mt-lg-4 text-lg-start text-center pe-lg-4">
                            <div class="d-flex align-items-start justify-content-lg-start justify-content-center">
                                <div class="carrer_icon_inner mw-50 text-start me-3">
                                    <i class="' . $icon . ' text_36 line_height_30 color_primary"></i>
                                </div>
                                <div class="carrer_title text-start">
                                    <h3 class="mb-0">' . $heading . '</h3>
                                    <p class="pe-3 pt-lg-3 pt-2">' . $description . '</p>
                                </div>
                            </div>
                        </div>';
                    }
                }
                ?>
            </div>
        </div>
        <div class="swiper-pagination carrer_icon_pagination pagination-variation-a position-relative d-lg-none"></div>
    </div>
</div>

<script>
jQuery(document).ready(function(){
    var swiperIconA = new Swiper(".carrer_icon_swiper", {
        spaceBetween: 10,
		loop: true,
        autoplay: {
            delay: 8000,
            disableOnInteraction: false,
          },
        pagination: {
          el: ".carrer_icon_pagination",
          clickable: true,
        },
        breakpoints: {
          640: {
            slidesPerView: 1,
            spaceBetween: 10,
            noSwiping: false,
            allowSlidePrev: false,
            allowSlideNext: false,
            autoHeight:true,
          },
          768: {
            slidesPerView: 1,
            spaceBetween: 10,
            noSwiping: false,
            allowSlidePrev: true,
            allowSlideNext: true,
          },
          992: {
            slidesPerView: 6,
            spaceBetween: 0,
            noSwiping: true,
            allowSlidePrev: false,
            allowSlideNext: false,
          },
        },
    });
});
</script>
