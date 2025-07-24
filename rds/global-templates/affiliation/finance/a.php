<div class="d-block order-2 order-lg-2">
    <div class="container-fluid pt-lg-2">
        <div class="container">
            <div class="row position-relative">
                <div class="col-lg-10 mx-auto">
                    <div class="swiper finance_logo_swiper">
                        <div class="swiper-wrapper">
                            <?php
                            $Count =
                            	$args["page_templates"]["finance_page"][
                            		"affiliation"
                            	]["count"];
                            $i = 1;
                            $media_dir =
                            	get_stylesheet_directory_uri() .
                            	"/img/financing-page/";
                            while ($Count >= $i) {

                            	$logo = get_exist_image_url(
                            		"financing-page",
                            		"affiliate-logo-" . $i . ""
                            	);
                            	$logo2x = get_exist_image_url(
                            		"financing-page",
                            		"affiliate-logo-" . $i . "@2x"
                            	);
                            	$logo3x = get_exist_image_url(
                            		"financing-page",
                            		"affiliate-logo-" . $i . "@3x"
                            	);
                            	?>
                                <div class="swiper-slide">
                                    <div class="text-center">
                                        <img src="<?php echo $logo; ?>" class="img-fluid" width="125" height="125" alt="financing-affiliate-logo" srcset="<?php echo $logo; ?> 1x, <?php echo $logo2x; ?> 2x, <?php echo $logo3x; ?> 3x," />
                                    </div>
                                </div>
                                <?php $i++;
                            }
                            ?>
                        </div>
                    </div>
                    <div class="swiper-button-next finance_next_a ">
                        <i class="icon-chevron-right text_20 line_height_25  transform_lg  color_primary"></i>
                    </div>
                    <div class="swiper-button-prev finance_prev_a ">
                        <i class="icon-chevron-left text_20 line_height_25  transform_lg  color_primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function () {
        var variation = "<?php echo $args["page_templates"]["finance_page"][
        	"affiliation"
        ]["variation"]; ?>";
          var count = "<?php echo $args["page_templates"]["finance_page"][
          	"affiliation"
          ]["count"]; ?>";
        var slidesPerView = {a: 4, b: 5, c: 6};
        if(count <= slidesPerView[variation]){
             var financeSwiper = new Swiper(".finance_logo_swiper", {
            spaceBetween: 30,
            slidesPerView: 1,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".finance_next_a",
                prevEl: ".finance_prev_a",
            },
            breakpoints: {
                640: {
                    slidesPerView: 1,
                    spaceBetween: 30,
                },
                768: {
                    slidesPerView: 1,
                    spaceBetween: 30,
                },
                992: {
                    slidesPerView: count,
                    spaceBetween: 30,
                    noSwiping: true,
                    allowSlidePrev: false,
                    allowSlideNext: false,
                },
            },
        });

        }else{
           var financeSwiper = new Swiper(".finance_logo_swiper", {
            spaceBetween: 30,
            slidesPerView: 1,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            loop: true,
            navigation: {
                nextEl: ".finance_next_a",
                prevEl: ".finance_prev_a",
            },
            breakpoints: {
                640: {
                    slidesPerView: 1,
                    spaceBetween: 30,
                },
                768: {
                    slidesPerView: 1,
                    spaceBetween: 30,
                },
                992: {
                    slidesPerView: slidesPerView[variation],
                    spaceBetween: 30,
                    noSwiping: false,
                    allowSlidePrev: true,
                    allowSlideNext: true,
                },
            },
        });

        }
        
    });
</script>