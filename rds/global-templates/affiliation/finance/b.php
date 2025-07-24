<?php
$get_alt_text = RDS_ALT_DATA;
$alt1 = "";
$alt2 = "";
$alt3 = "";
$alt4 = "";
$alt5 = "";
$alt6 = "";

if (is_array($get_alt_text)) {
    foreach ($get_alt_text as $value) {
        if (is_array($value) && in_array("affiliate-logo-1-gray.webp", $value)) {
            $alt1 = 'alt="' . $value[3] . '"';
        }

        if (is_array($value) && in_array("affiliate-logo-2-gray.webp", $value)) {
            $alt2 = 'alt="' . $value[3] . '"';
        }

        if (is_array($value) && in_array("affiliate-logo-3-gray.webp", $value)) {
            $alt3 = 'alt="' . $value[3] . '"';
        }

        if (is_array($value) && in_array("affiliate-logo-4-gray.webp", $value)) {
            $alt4 = 'alt="' . $value[3] . '"';
        }

        if (is_array($value) && in_array("affiliate-logo-5-gray.webp", $value)) {
            $alt5 = 'alt="' . $value[3] . '"';
        }

        if (is_array($value) && in_array("affiliate-logo-6-gray.webp", $value)) {
            $alt6 = 'alt="' . $value[3] . '"';
        }
    }
}
?>
<div class="d-block order-2 order-lg-2">
    <div class="container-fluid py-5 py-lg-2 text-center ">
        <div class="container pb-lg-3 pt-lg-1 py-2">
            <div class="row align-items-center justify-content-center position-relative">
                <div class="col-sm-12 col-lg-10 px-lg-4 px-4 mx-atuo ">
                    <div class="swiper affiliation-swiper-a">
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
                                        <img src="<?php echo $logo; ?>" class="img-fluid " width="125" height="125" alt="financing-affiliate-logo" srcset="<?php echo $logo; ?> 1x, <?php echo $logo2x; ?> 2x, <?php echo $logo3x; ?> 3x," />
                                    </div>
                                </div>
                                <?php $i++;
                            }
                            ?>
                         
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next affiliation_next_a color_primary">
                    <i class="icon-chevron-right text_20 line_height_25 transform_lg color_primary"></i>
                </div>
                <div class="swiper-button-prev affiliation_prev_a color_primary">
                    <i class="icon-chevron-left text_20 line_height_25 transform_lg color_primary"></i>
                </div> 
            </div>

        </div>
    </div>
</div>


<script type="text/javascript">

       jQuery(document).ready(function () {
        var variation = "<?php echo $args["page_templates"]["finance_page"][
        	"affiliation"
        ]["variation"]; ?>";
          var count = "<?php echo $args["page_templates"]["finance_page"][
          	"affiliation"
          ]["count"]; ?>";
        var slidesPerView = {a: 4, b: 5, c: 6};
        if(count <= slidesPerView[variation]){
             var affiliactionSlider = new Swiper(".affiliation-swiper-a", {
            spaceBetween: 30,
            slidesPerView: 1,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
           navigation: {
                nextEl: ".affiliation_next_a",
                prevEl: ".affiliation_prev_a",
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
           var affiliactionSlider = new Swiper(".affiliation-swiper-a", {
            spaceBetween: 30,
            slidesPerView: 1,
            loop: true,
             autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            navigation: {
                 nextEl: ".affiliation_next_a",
                prevEl: ".affiliation_prev_a",
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
<style type="text/css">.affiliation_next_a.swiper-button-disabled.swiper-button-lock, .affiliation_prev_a.swiper-button-disabled.swiper-button-lock {
    display: none;
}</style> 