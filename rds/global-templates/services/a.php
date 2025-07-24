<div class="d-lg-none pt-lg-5 pb-0 pt-4">
    <div class="container-fluid pb-lg-5 pb-4">
        <div class="container abc">
            <div class="row">
                <?php
                $servicesItems = $args['globals']['services']['items'];
                $titleLengths = [];
                foreach ($servicesItems as $item) {
                    // Check if the 'title' key exists in the current array element
                    if (isset($item['title'])) {
                        $title = $item['title'];
                        $titleLengths[] = strlen($title);
                    }
                }
                $maxValue = max($titleLengths);
                $class = "h-lg-250";
                if ($maxValue < 21) {
                    $class = 'h-lg-250';
                } elseif ($maxValue >= 21 && $maxValue < 42) {
                    $class = 'h-lg-284';
                } elseif ($maxValue >= 42) {
                    $class = 'h-lg-309';
                }
                foreach ($servicesItems as $value) {
                    echo '<div class="col-lg h-lg-250 ' .
                        $class .
                        '">
                    <a href="' .
                        get_home_url() .
                        $value['link'] .
                        '" class="d-block shadow-sm ' .
                        $args['globals']['services']['top_border_class'] .
                        ' no_hover_underline px-lg-3 h-100 service_block border-md-6  pt-lg-0">
                    <div class="d-flex d-lg-block align-items-center text-lg-center py-lg-2 px-lg-0 px-4 py-1">
                    <div class="w-100 d-lg-block d-flex align-items-center  py-lg-5">
                    <div class="col-lg-12 col-2">
                    <i class="' .
                        $value['icon'] .
                        ' color_primary text_70 line_height_70 sm_text_30 sm_line_height_60 service_block_icon"></i>
                    </div>
                    <div class="col-lg-12 col-8">
                    <h6 class="h7 mb-lg-2 mb-0 mt-lg-4 pt-lg-1">' .
                        $value['title'] .
                        '</h6>
                    </div>
                    <div class="col-lg-12 col-2 text-end">
                    <i class="true_black icon-chevron-right4 sm_text_20 sm_line_height_60 d-lg-none d-inline-block"></i>
                    </div>
                    </div>
                    </div>
                    </a>
                    </div>';
                }
                ?>  
            </div>
        </div>
    </div>
</div>
<div class="d-none position-relative d-lg-block pt-lg-5 pb-0 pt-4">
    <div class="container-fluid pb-lg-5 pb-4 px-0">
        <div class="container">
            <div id="rds_services_swiper" class="swiper  p-3 pb-lg-4">
                <div class="abc swiper-wrapper "> 
                    <?php
                    $servicesItems = $args['globals']['services']['items'];
                    $count = count($servicesItems);
                    $titleLengths = [];
                    foreach ($servicesItems as $item) {
                        // Check if the 'title' key exists in the current array element
                        if (isset($item['title'])) {
                            $title = $item['title'];
                            $titleLengths[] = strlen($title);
                        }
                    }
                    $maxValue = max($titleLengths);
                    $class = "h-lg-250";
                    if ($maxValue < 21) {
                        $class = 'h-lg-250';
                    } elseif ($maxValue >= 21 && $maxValue < 42) {
                        $class = 'h-lg-284';
                    } elseif ($maxValue >= 42) {
                        $class = 'h-lg-309';
                    }
                    foreach ($servicesItems as $value) {
                        echo '<div class="swiper-slide shadow-sm max-lg-255  ' .
                            $args['globals']['services']['top_border_class'] .
                            ' ' .
                            $class .
                            '">
                    <a href="' .
                            get_home_url() .
                            $value['link'] .
                            '" class="d-block no_hover_underline px-lg-3 h-100 service_block">
                    <div class="d-flex d-lg-block align-items-center text-lg-center py-lg-2 px-lg-0 px-4 py-1">
                    <div class="w-100 d-lg-block d-flex align-items-center  py-lg-5">
                    <div class="col-lg-12 col-2">
                    <i class="' .
                            $value['icon'] .
                            ' color_primary text_70 line_height_70 sm_text_30 sm_line_height_60 service_block_icon"></i>
                    </div>
                    <div class="col-lg-12 col-8">
                    <h6 class="h7 mb-lg-2 mb-0 mt-lg-4 pt-lg-1 ">' .
                            $value['title'] .
                            '</h6>
                    </div>
                    <div class="col-lg-12 col-2 text-end">
                    <i class="true_black icon-chevron-right4 sm_text_20 sm_line_height_60 d-lg-none d-inline-block"></i>
                    </div>
                    </div>
                    </div>
                    </a>
                    </div>';
                    }
                    ?> 
                </div>
            </div>
        </div>
    </div>
    <?php if ($count > 4) { ?>
        <div class="swiper-pagination swiper-pagination-service swiper-pagination-service d-none d-lg-block "></div>
    <?php } ?>
</div>
<script>
    var numImage1 = jQuery('.abc .col-lg').length;
    if (numImage1 <= 3) {
        jQuery('.abc .row').addClass('justify-content-center');
    }
    jQuery(document).ready(function () {
        var CountSlider = "<?php echo $count; ?>";
        var loop = false;
        if (CountSlider > 4) {
            loop = true;
        }
        if (CountSlider < 4) {
            jQuery(".abc.swiper-wrapper").addClass("justify-content-center");
        }
        var swiper = new Swiper('#rds_services_swiper', {
            loop: true,
            slidesPerView: 4,
            spaceBetween: 0,
            noSwiping: true,
            allowSlidePrev: true,
            allowSlideNext: true,
            autoplay: {
                        enabled: true,
                        delay: 5000
                    },
            navigation: {
                nextEl: ".swiper-button-next-services",
                prevEl: ".swiper-button-prev-services",
            },
            pagination: {
                el: ".swiper-pagination-service",
                clickable: true,

            },
            breakpoints: {
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 21.31,
                    noSwiping: true,
                    allowSlidePrev: true,
                    allowSlideNext: true,
                    
                },
                768: {
                    slidesPerView: 4,
                    spaceBetween: 21,
                    noSwiping: true,
                    allowSlidePrev: true,
                    allowSlideNext: true,
                    
                },
                640: {
                    slidesPerView: 4,
                    spaceBetween: 21,
                    noSwiping: true,
                    allowSlidePrev: true,
                    allowSlideNext: true,
                    
                }
            },
        });
       
  

    });
</script>
