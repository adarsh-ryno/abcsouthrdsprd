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
        if (in_array("affiliate-logo-1-gray.webp", $value) && isset($value[3])) {
            $alt1 = 'alt="' . $value[3] . '"';
        }
        if (in_array("affiliate-logo-2-gray.webp", $value) && isset($value[3])) {
            $alt2 = 'alt="' . $value[3] . '"';
        }
        if (in_array("affiliate-logo-3-gray.webp", $value) && isset($value[3])) {
            $alt3 = 'alt="' . $value[3] . '"';
        }
        if (in_array("affiliate-logo-4-gray.webp", $value) && isset($value[3])) {
            $alt4 = 'alt="' . $value[3] . '"';
        }
        if (in_array("affiliate-logo-5-gray.webp", $value) && isset($value[3])) {
            $alt5 = 'alt="' . $value[3] . '"';
        }
        if (in_array("affiliate-logo-6-gray.webp", $value) && isset($value[3])) {
            $alt6 = 'alt="' . $value[3] . '"';
        }
    }
}
?>   
   
   <div class="col-lg-9 position-relative py-lg-0 py-4">
    <div class="swiper thank-affiliation-swiper-a position-relative">
        <div class="swiper-wrapper">
            <?php
            $Count = $args["globals"]["affiliation"]["count"];
            $i = 1;
            $media_dir = get_exist_image_url("affiliation", "affiliate-logo");
            while ($Count >= $i) {
                $alt_var = "alt" . $i;
            	$logo = get_exist_image_url(
            		"affiliation",
            		"affiliate-logo-" . $i . "-gray"
            	);
            	$logo2x = get_exist_image_url(
            		"affiliation",
            		"affiliate-logo-" . $i . "-gray@2x"
            	);
            	$logo3x = get_exist_image_url(
            		"affiliation",
            		"affiliate-logo-" . $i . "-gray@3x"
            	);
                $alt = isset($$alt_var) ? $$alt_var : '';
            	?>
                <div class="swiper-slide text-center">
                    <div class="text-center">
                    <img src="<?php echo $logo; ?>" class="img-fluid" width="85" height="82" <?php echo $alt; ?> srcset="<?php echo $logo; ?> 1x, <?php echo $logo2x; ?> 2x, <?php echo $logo3x; ?> 3x," />
                    </div>
                </div>
                <?php $i++;
            }
            ?>
        </div>
    </div>
    <div class="swiper-button-next thank_affiliation_next_a">
        <i class="icon-chevron-right text_20 line_height_25 transform_lg color_primary"></i>
    </div>
    <div class="swiper-button-prev thank_affiliation_prev_b">
        <i class="icon-chevron-left text_20 line_height_25 transform_lg color_primary"></i>
    </div>
</div>
   
                    <script type="text/javascript">

       jQuery(document).ready(function () {
        var variation = "<?php echo $args["globals"]["affiliation"][
        	"variation"
        ]; ?>";
          var count = "<?php echo $args["globals"]["affiliation"]["count"]; ?>";
        var slidesPerView = {a: 4, b: 5, c: 6};
        if(count <= slidesPerView[variation]){
             var swiperThankYou = new Swiper(".thank-affiliation-swiper-a", {
            spaceBetween: 30,
            slidesPerView: 1,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
           navigation: {
            nextEl: ".thank_affiliation_next_a",
                  prevEl: ".thank_affiliation_prev_b",
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
           var swiperThankYou = new Swiper(".thank-affiliation-swiper-a", {
            spaceBetween: 30,
            slidesPerView: 1,
            loop: true,
             autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            navigation: {
              nextEl: ".thank_affiliation_next_a",
                  prevEl: ".thank_affiliation_prev_b",
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
