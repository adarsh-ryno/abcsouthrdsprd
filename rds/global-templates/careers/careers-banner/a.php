<?php
$get_alt_text = RDS_ALT_DATA;
$career_banner_alt = "";
$career_mobile_banner_alt = "";

if (is_array($get_alt_text)) {
    foreach ($get_alt_text as $value) {
        if (in_array("careers-banner.webp", $value)) {
            $career_banner_alt = !empty($value[3]) ? 'alt="' . esc_attr($value[3]) . '"' : '';
        }

        if (in_array("m-careers-banner.webp", $value)) {
            $career_mobile_banner_alt = !empty($value[3]) ? 'alt="' . esc_attr($value[3]) . '"' : '';
        }
    }
}
?> 
<!-- carrer banner starts -->
<div class="container-fluid px-0 mb-4 pb-lg-5">
        <div class="row mx-lg-0 mx-0">
            <div class="col-lg-7 ps-lg-0 px-0 pe-lg-3">
                <div class="mh-lg-502 rounded-30 shadow-md-alt overflow-hidden">
                    <img src="<?php echo get_exist_image_url('careers','careers-banner'); ?>" srcset="<?php echo get_exist_image_url('careers','careers-banner'); ?> 1x, <?php echo get_exist_image_url('careers','careers-banner@2x'); ?> 2x, <?php echo get_exist_image_url('careers','careers-banner@3x'); ?> 3x" width="1075" height="502" <?php echo $career_banner_alt; ?> class="img-fluid mh-lg-502 mw-lg-100 object-fit d-lg-block d-none">
                    <img src="<?php echo get_exist_image_url('careers','careers-banner'); ?>" srcset="<?php echo get_exist_image_url('careers','m-careers-banner'); ?> 1x, <?php echo get_exist_image_url('careers','m-careers-banner@2x'); ?> 2x, <?php echo get_exist_image_url('careers','m-careers-banner@3x'); ?> 3x"  width="1075" height="502" <?php echo $career_banner_alt; ?> class="img-fluid mh-lg-502 mw-lg-100 object-fit d-lg-none d-block">
                </div>
            </div>
            <div class="col-lg-5 pt-lg-0 pt-sm-4 pt-2 pb-3 position-relative carrer_banner_content">
                <div class="mw-lg-445 pt-lg-5">
                    <span class="display1 d-block pt-lg-5"><?php the_title(); ?></span>
                    <p> 
                                 <?php
$content = isset($args['page_templates']['career_page']['banner']['content']) ? $args['page_templates']['career_page']['banner']['content'] : '';
$charLimit = 464;
        if (strlen(strip_tags($content)) > $charLimit) {
            $trimmedContent = substr(strip_tags($content), 0, $charLimit);
            echo $trimmedContent . '...';
           
        } else {
            echo $content;
        }
    ?>
                    </p>
                    <div class="mb-lg-4">
                        <?php if(!empty($args['page_templates']['career_page']['banner']['button_text'])){ ?>
                        <button onclick="scrollSmoothTo('open_position')" class="btn btn-primary mw-248"><?php echo $args['page_templates']['career_page']['banner']['button_text']; ?></button>
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- carrer banner ends -->

    <script>
        function scrollSmoothTo(elementId) {
            var offset = <?php echo wp_is_mobile() ? 80 : 220; ?>;

            jQuery("html, body").animate({
            scrollTop: jQuery('#open_position').offset().top - offset
            }, 500);

            }
            //Job Application js
            function viewPostionButtonClick(attr) {
            var jobTitle = jQuery(attr).siblings('.position_title').text();
            console.log(jobTitle);
            jQuery(".job-title").find('input:text').val(jobTitle);
        }
    </script> 