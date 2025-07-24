<?php
$get_alt_text = RDS_ALT_DATA;
$header_logo_alt = "";
$header_mobile_logo_alt = "";
$header_mobile_cta_alt = "";
if (is_array($get_alt_text)) {
    foreach ($get_alt_text as $value) {
        if (is_array($value) && in_array("header-logo.webp", $value)) {
            $header_logo_alt = 'alt="' . $value[3] . '"';
        }

        if (is_array($value) && in_array("m-header-logo.webp", $value)) {
            $header_mobile_logo_alt = 'alt="' . $value[3] . '"';
        }

        if (is_array($value) && in_array("m-menu-cta-logo.webp", $value)) {
            $header_mobile_cta_alt = 'alt="' . $value[3] . '"';
        }
    }
}

$announcement_class = "d-lg-block";
$template = basename(get_page_template());
if (
	$template == "rds-landing.php" &&
	!$args["page_templates"]["landing_page"]["announcement_and_nav_toggle"]
) {
	$announcement_class = "d-lg-none";
}
if ($args["globals"]["desktop_schedule_online_button"]["enabled"] == false) {
	$enable_desktop = "d-none";
}

// $phoneNum = $args['site_info']['phone'];
// $phoneNumber = preg_replace('/\D/', '', $phoneNum);
// $formatedPhone = substr($phoneNumber, 0, 6) . '-' . substr($phoneNumber, 6);
?>
        <!-- Header Deafult Starts -->
        <div class="container-fluid d-none hide-on-touch d-lg-block">
            <div class="container">
                <div class="row">
                    <div class="col-12 me-0 pb-1 text-center">
                        <a href="<?php echo get_home_url(); ?>" class="d-inline-block my-3">
                        <img loading="eager" fetchpriority="high" src="<?php echo get_exist_image_url(
                        	"header",
                        	"header-logo"
                        ); ?>" srcset="<?php echo get_exist_image_url(
	"header",
	"header-logo"
); ?> 1x, <?php echo get_exist_image_url(
 	"header",
 	"header-logo@2x"
 ); ?> 2x, <?php echo get_exist_image_url(
 	"header",
 	"header-logo@3x"
 ); ?> 3x" <?php echo $header_logo_alt; ?> class="branding_logo img-fluid w-auto" style="max-width: 294px;" width="294" height="59">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header Deafult Ends -->
        <!-- Desktop Navigations Starts -->
        <?php get_template_part("global-templates/nav/desktop/c"); ?>
        <!-- Desktop Navigations Ends -->
        <!-- Mobile Header Starts -->
        <div class="container-fluid ui_kit_mobile_header mobile_header_type_A d-lg-none show-on-touch px-0">
            <div class="container-fluid">
                <div class="row row-eq-height no-gutters align-items-center">
                    <div class="col-2 ps-o text-center  align-self-center">
                        <button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler d-inline-flex align-items-center" data-bs-target="#navbarSupportedContent" data-bs-toggle="collapse" type="button">
                            <i class="icon-bars2 color_primary navbar-toggler-icon icon-bars2 text_24 line_height_24"></i>
                        </button>
                    </div>
                    <div class="col-7  text-center">
                        <a href="<?php echo get_home_url(); ?>" class="d-block">
                            <img loading="eager" fetchpriority="high" src="<?php echo get_exist_image_url(
                            	"header",
                            	"m-header-logo"
                            ); ?>" srcset="<?php echo get_exist_image_url(
	"header",
	"m-header-logo"
); ?> 1x, <?php echo get_exist_image_url(
 	"header",
 	"m-header-logo@2x"
 ); ?> 2x, <?php echo get_exist_image_url(
 	"header",
 	"m-header-logo@3x"
 ); ?> 3x"  width="200" height="40" style="max-width: 200px" class="img-fluid w-atuo" <?php echo $header_mobile_logo_alt; ?>>
                        </a>
                    </div>
                    <div class="col-3 text-center pe-0 ">
                        <div class="d-flex h-100 phone-icon">
                            <a data-bs-toggle="modal" href="#" data-bs-target="#cta-a"  class="d-flex align-items-center justify-content-center w-100 no_hover_underline color_primary_bg">
                                <i class="true_white icon-phone-flip  text_24 line_height_24  "></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade  border-0 mobile_popup_form_background_color" id="cta-a" tabindex="-1" role="dialog" aria-labelledby="cta-a" aria-hidden="true">
            <div class="modal-dialog mt-0" role="document">
                <div class="modal-content border-0 position-absolute mt-md-0">
                    <button type="button" class="close p-0 bg-transparent border-0" data-bs-dismiss="modal" aria-label="Close" style="z-index: 9; position: absolute; right: 20px; top: 20px;">
                        <i class="apply-conditional-color icon-xmark  close_icon text_24 line_height_24  " data-dark-color="true_black" data-light-color="true_white"></i>
                    </button>
                    <div class="modal-body px-2 mobile_popup_form_background_color text-center border-0">
                        <img loading="eager" fetchpriority="high" src="<?php echo get_exist_image_url(
                        	"header",
                        	"m-menu-cta-logo@3x"
                        ); ?>" srcset="<?php echo get_exist_image_url(
	"header",
	"m-menu-cta-logo"
); ?> 1x, <?php echo get_exist_image_url(
 	"header",
 	"m-menu-cta-logo@2x"
 ); ?> 2x, <?php echo get_exist_image_url(
 	"header",
 	"m-menu-cta-logo@3x"
 ); ?> 3x"  class="mb-4 w-auto h-auto" <?php echo $header_mobile_cta_alt; ?> width="191" height="39"> 
                        <div class="text-center">
                            <a href="tel:<?php 
                              echo !empty( $args["site_info"]["country_code"] ) ?  $args["site_info"]["country_code"] : '';
                                 echo !empty( $args["site_info"]["phone"] ) ?  $args["site_info"]["phone"] : ''; ?>" class=" btn-quaternary">
                                <i class="icon-phone"></i> call | <?php  echo !empty( $args["site_info"]["country_code"] ) ?  $args["site_info"]["country_code"] : '';
                                 echo !empty( $args["site_info"]["phone"] ) ?  $args["site_info"]["phone"] : ''; ?> <i class="icon-chevron-right2"></i>
                            </a>
                            <?php
                             if (!empty($args["globals"]["ctas"])) {
                            $footerItems = $args["globals"]["ctas"];
                            $i = 0;
                            foreach ($footerItems as $key => $value) {
                            	if ($value["enabled"] == true) {
                            		if (
                            			$value["type"] == "url" ||
                            			$value["type"] == "sms"
                            		) {
                            			echo '<a href="' .
                            				get_home_url() .
                            				$value["type"] .
                            				'" class=" btn-quaternary" id="rds_footer_element_' .
                            				$i .
                            				'">
                           <i class="' .
                            				$value["icon_class"] .
                            				'"></i> ' .
                            				$value["label"] .
                            				'  <i class="icon-chevron-right2"></i>
                        </a>';
                            		} else {
                            			echo '<span id="rds_footer_element_' .
                            				$i .
                            				'" class="btn btn-quaternary" >
                           <i class="' .
                            				$value["icon_class"] .
                            				'"></i> ' .
                            				$value["label"] .
                            				'  <i class="icon-chevron-right2"></i>
                        </span>';
                            		}
                            	}
                            	$i++;
                            }
                        }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php get_template_part("global-templates/nav/mobile/a"); ?>
        <!-- Mobile Header Ends --> 