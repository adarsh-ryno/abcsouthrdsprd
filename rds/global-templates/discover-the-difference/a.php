<!--order-5 order-lg-5-->


<div class="d-block">
    <div class="container-fluid  py-lg-5 pt-4">
        <div class="container pt-lg-4 pb-lg-5 pt-2">
            <div class="row">
                <div class="col-lg-12 text-center mb-4">
      <h5 data-dark-color="color_primary" data-light-color="true_white" class="apply-conditional-color true_white text-center mb-0 sm_text_22 sm_line_height_27">
    <?php echo !empty( $args['globals']['discover_the_difference']['heading']) ?  $args['globals']['discover_the_difference']['heading'] : ''; ?>
</h5>


<h4 data-dark-color="color_primary" data-light-color="true_white" class="apply-conditional-color text-center true_white h4-alt pb-lg-5 mb-lg-5 pb-4">
    <?php echo !empty($args['globals']['discover_the_difference']['subheading']) ? $args['globals']['discover_the_difference']['subheading'] : ''; ?>    
</h4>


                </div>
                <div data-dark-color="color_primary" data-light-color="true_white"  class="apply-conditional-color d-lg-block d-none col-lg-12 swiper expect-swiper-a expect-swiper-a mw-md-292 mx-lg-0 mx-auto swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden">
                    <div class="swiper-wrapper flex-lg-wrap transform-lg-none" id="swiper-wrapper-c1e105e1b106f1b1ca" aria-live="polite">

                    <?php 
                     if (!empty($args['globals']['discover_the_difference']['items'])) {
                      $discoverItems = $args['globals']['discover_the_difference']['items']; 
                      $discoverItemsCount = count($discoverItems);
                    $i = 1;

                    foreach ($discoverItems as $value) {
                        echo'<div class="swiper-slide col-lg-4 h-lg-auto pb-lg-5 mb-lg-4 pe-lg-5 swiper-slide-active" role="group" aria-label="'.$i.' / '.$discoverItemsCount.'" style="width: 190px;">

                            <div class="row align-items-center align-items-lg-start">
                                <div class="col-5 col-lg-2 pe-lg-0 pe-4 align-items-center d-flex mh-md-75">
                                    <i class="color_primary  '.$value['icon'].' text_35 line_height_35 sm_text_70 sm_line_height_25"></i>
                                </div>
                                <div class="col-7 col-lg-10 ps-lg-3 ps-4 border-lg-left">
                                    <h6 class="px-lg-1 mb-0 h6-alt">'.$value['title'].'</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-10 offset-lg-2">
                                    <p class="p-alt ps-lg-1 pe-lg-3 mb-lg-3 mb-0 pt-3">'.$value['description'].'</p>
                                </div>
                            </div>
                        </div>';
                        $i++;
                       } 
                      }?>
                      </div>
                      
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                </div>

                <div data-dark-color="color_primary" data-light-color="true_white"  class="apply-conditional-color d-lg-none d-block col-lg-12 swiper m-expect-swiper-a m-expect-swiper-a mw-md-292 mx-lg-0 mx-auto swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden">
                    <div class="swiper-wrapper flex-lg-wrap transform-lg-none" id="swiper-wrapper-c1e105e1b106f1b1ca" aria-live="polite">

                    <?php 
                     if (!empty($args['globals']['discover_the_difference']['items'])) {
                      $discoverItems = $args['globals']['discover_the_difference']['items']; 
                      $discoverItemsCount = count($discoverItems);
                    $i = 1;

                    foreach ($discoverItems as $value) {
                        echo'<div class="swiper-slide col-lg-4 h-lg-auto pb-lg-5 mb-lg-4 pe-lg-5 swiper-slide-active" role="group" aria-label="'.$i.' / '.$discoverItemsCount.'" style="width: 190px;">

                            <div class="row align-items-center align-items-lg-start">
                                <div class="col-5 col-lg-2 pe-lg-0 pe-4 align-items-center d-flex mh-md-75">
                                    <i class="color_primary  '.$value['icon'].' text_35 line_height_35 sm_text_70 sm_line_height_25"></i>
                                </div>
                                <div class="col-7 col-lg-10 ps-lg-3 ps-4 border-lg-left">
                                    <h6 class="px-lg-1 mb-0 h6-alt">'.$value['title'].'</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-10 offset-lg-2">
                                    <p class="p-alt ps-lg-1 pe-lg-3 mb-lg-3 mb-0 pt-3">'.$value['description'].'</p>
                                </div>
                            </div>
                        </div>';
                        $i++;
                       } 
                      }?>
                      </div>
                      
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                </div>
                <div data-dark-color="color_primary" data-light-color="true_white" class="apply-conditional-color d-lg-none d-block swiper-pagination position-relative what-pagination-a what-pagination-a pagination-variation-a"><span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button" aria-label="Go to slide 1" aria-current="true"></span></div>
                <div class="col-12 text-center pb-lg-4 pb-5 pt-lg-0 pt-4">
                    <a href="<?php echo get_home_url(). (!empty($args['globals']['discover_the_difference']['button_link']) ? $args['globals']['discover_the_difference']['button_link'] : ''); ?>" class="btn btn-primary"><?php echo $args['globals']['discover_the_difference']['button_text']; ?></a>
                </div>
            </div>
        </div>
    </div>
</div>
  <script>
        jQuery(document).ready(function(){
            var swiperExpectA = new Swiper(".expect-swiper-a", {
                spaceBetween: 10,
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                  },
                pagination: {
                  el: ".what-pagination-a",
                  clickable: true,
                },
                breakpoints: {
                  640: {
                    slidesPerView: 1,
                    spaceBetween: 40,
                    noSwiping: false,
                    allowSlidePrev: true,
                    allowSlideNext: true,
                    autoHeight:true,
                  },
                  768: {
                    slidesPerView: 6,
                    spaceBetween: 0,
                    noSwiping: true,
                    allowSlidePrev: false,
                    allowSlideNext: false,
                  },
                  993: {
                    slidesPerView: 6,
                    spaceBetween: 0,
                    noSwiping: true,
                    allowSlidePrev: false,
                    allowSlideNext: false,
                  },
                },
            });
            var mswiperExpectA = new Swiper(".m-expect-swiper-a", {
                spaceBetween: 10,
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                  },
                pagination: {
                  el: ".what-pagination-a",
                  clickable: true,
                },
                breakpoints: {
                  640: {
                    slidesPerView: 1,
                    spaceBetween: 40,
                    noSwiping: false,
                    allowSlidePrev: true,
                    allowSlideNext: true,
                    autoHeight:true,
                  },
                  992: {
                    slidesPerView: 1,
                    spaceBetween: 40,
                    noSwiping: false,
                    allowSlidePrev: true,
                    allowSlideNext: true,
                  },
                  993: {
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
