<?php
$get_alt_text = RDS_ALT_DATA;
// $footer_tem = json_decode(get_option("rds_template"), true);
$footer_logo_alt = "";
$footer_mobile_logo_alt = "";
$copyright_svg_alt = "";
if (is_array($get_alt_text)) {
    foreach ($get_alt_text as $value) {
        if (in_array("footer-logo.webp", $value)) {
            $footer_logo_alt = 'alt="' . $value[3] . '"';
        }

        if (in_array("m-footer-logo.webp", $value)) {
            $footer_mobile_logo_alt = 'alt="' . $value[3] . '"';
        }

        if (in_array("bc-logo.svg", $value)) {
            $copyright_svg_alt = 'alt="' . $value[3] . '"';
        }
    }
}
?>  
<footer class=" border-top-tertiary overflow-hidden">

    <div class="container-fluid text-md-start pt-0 pt-lg-5 pb-5 pb-lg-5">
        <div class="container pt-lg-0 pt-3">
            <div class="row">
                <div class="col-sm-12 col-lg-3 pr-xl-2 pt-lg-2 text-lg-start text-center">
                    <a class="mt-1 d-inline-block pb-1" href="<?php echo get_home_url(); ?>">
                    <img src="<?php echo get_exist_image_url(
                    	"footer",
                    	"footer-logo"
                    ); ?>" srcset="<?php echo get_exist_image_url(
	"footer",
	"footer-logo"
); ?> 1x, <?php echo get_exist_image_url(
 	"footer",
 	"footer-logo@2x"
 ); ?> 2x, <?php echo get_exist_image_url(
 	"footer",
 	"footer-logo@3x"
 ); ?> 3x" class="d-lg-block d-none img-fluid w-auto" style="max-width: 210px" <?php echo $footer_logo_alt; ?> width="210" height="138">

                    <img src="<?php echo get_exist_image_url(
                    	"footer",
                    	"m-footer-logo"
                    ); ?>" srcset="<?php echo get_exist_image_url(
	"footer",
	"m-footer-logo"
); ?> 1x, <?php echo get_exist_image_url(
 	"footer",
 	"m-footer-logo@2x"
 ); ?> 2x, <?php echo get_exist_image_url(
 	"footer",
 	"m-footer-logo@3x"
 ); ?> 3x" class="d-lg-none d-block img-fluid w-auto" style="max-width: 175px" <?php echo $footer_mobile_logo_alt; ?> width="175" height="127">
                    </a>
                    <div class="text_24 mt-4 d-lg-flex pt-4 pb-lg-0 pb-2">

                        <div class="d-block w-100">
                            <div class="d-flex justify-content-lg-start justify-content-center pb-lg-0 pb-2">
                                <i class="footer_phone_icon_color icon-phone-volume2 me-2   text_21 line_height_25 rotate_n35"></i>
                                <span class="h8 pt-1 pt-lg-0 ps-lg-2">Phone: </span>
                            </div>

                            <div class="ps-lg-3">
                                 <?php
// $phoneNum = $args['site_info']['phone'];
// $phoneNumber = preg_replace('/\D/', '', $phoneNum);
// $formatedPhone = substr($phoneNumber, 0, 6) . '-' . substr($phoneNumber, 6);
$country_code =  !empty( $args["site_info"]["country_code"]) ?  $args["site_info"]["country_code"] : ''; 
$phone = !empty( $args["site_info"]["phone"]) ?  $args["site_info"]["phone"] : ''; 
?>
                                <a href="tel: <?php echo $country_code .
                                	$phone ; ?>" class=" footer_phone_number position-relative top_n2 offset-lg-1"><?php echo $country_code . $phone; ?></a>
                            </div>

                        </div>
                    </div>
                    <?php if (
                    	!empty($args["site_info"]["license_number"][0])
                    ) { ?>


                        <div class="text_16 mt-3 mt-lg-4 d-lg-flex">
                            <div class="position-relative">
                                <small class=" d-flex align-items-center justify-content-center justify-content-lg-start h8">
                                    <i class="footer_license_icon_color icon-id-card2 text_24 line_height_25 float-lg-start me-2  d-inline-block"></i> 
                                    <?php if (
                                    	count(
                                    		$args["site_info"]["license_number"]
                                    	) > 1
                                    ) {
                                    	echo "Licenses: ";
                                    } else {
                                    	echo "License: ";
                                    } ?>
                                </small>
                                <div class="ps-lg-1"><span class="d-inline-block footer_add  text_normal text_14 line_height_20 sm_line_height_30 line_height_20 sm_text_16 pt-lg-0 pt-2 font_default ms-lg-4 ps-lg-2">
                                        <?php foreach (
                                        	$args["site_info"]["license_number"]
                                        	as $value
                                        ) {
                                        	echo "" . $value . "<br>";
                                        } ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-sm-12 col-lg-3 pt-lg-0 pt-3 d-lg-block d-none">
                    <div class="ps-lg-4">
                        <h6 class="d-block mb-4 h6-alt  font_default   ">
                        <?php echo !empty( $args["globals"]["footer"]["data"]["footer_menu_1_heading"] ) ?  $args["globals"]["footer"]["data"]["footer_menu_1_heading"] : ''; ?>
                            <?php //echo $args["globals"]["footer"]["data"]["footer_menu_1_heading"]; ?>
                        </h6>	
                        <?php
                        $name = !empty($args["globals"]["footer"]["data"]["footer_menu_1_name"]) ?  $args["globals"]["footer"]["data"]["footer_menu_1_name"] : '';
                        	//$args["globals"]["footer"]["data"]["footer_menu_1_name"];
                        $menu = get_term_by("name", $name, "nav_menu");
                        $menu_items = wp_get_nav_menu_items($menu);
                        if (isset($menu_items) && !empty($menu_items)): ?>
                            <ul class="list-unstyled text_14">
                                <?php foreach (
                                	$menu_items
                                	as $key => $value
                                ) { ?>
                                    <li class="footer_links  no_hover_underline">
                                        <a class="footer_links " target="<?php echo $value->target; ?>" href="<?php echo $value->url; ?>">
                                            <?php echo $value->post_title; ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                            <?php endif;
                        ?>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-3 pt-lg-0 pt-3 d-lg-block d-none">
                    <div class="ps-lg-4">
                        <h6 class="d-block mb-4 h6-alt font_default   ">
                        <?php echo !empty( $args["globals"]["footer"]["data"]["footer_menu_2_heading"] ) ?  $args["globals"]["footer"]["data"]["footer_menu_2_heading"] : ''; ?>
                            <?php //echo $args["globals"]["footer"]["data"]["footer_menu_2_heading"]; ?>
                        </h6>
                        <?php
                        $name = !empty($args["globals"]["footer"]["data"]["footer_menu_2_name"]) ?  $args["globals"]["footer"]["data"]["footer_menu_2_name"] : '';
                        	//$args["globals"]["footer"]["data"]["footer_menu_2_name"];
                        $menu = get_term_by("name", $name, "nav_menu");
                        $menu_items = wp_get_nav_menu_items($menu);
                        if (isset($menu_items) && !empty($menu_items)): ?>
                            <ul class="list-unstyled text_14">
                                <?php foreach (
                                	$menu_items
                                	as $key => $value
                                ) { ?>
                                    <li class="footer_links  no_hover_underline">
                                        <a class="footer_links " target="<?php echo $value->target; ?>" href="<?php echo $value->url; ?>">
                                            <?php echo $value->post_title; ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                            <?php endif;
                        ?>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-3 pt-lg-0 pt-3">
                    <div class="d-flex flex-column">
                        <div class="order-lg-1 order-1"><h6 class="d-block mb-lg-4 mb-2 h6-alt  font_default    pb-1  sm_text_16  sm_line_height_21 text-center text-lg-start">
                                <?php // if (count($args['site_info']['address']) > 1) {
                                //     echo 'Office Locations';
                                // } else {
                                //     echo 'Office Location';
                                // }
                                echo !empty( $args["site_info"]["address_heading"] ) ?  $args["site_info"]["address_heading"] : ''; 
                                //echo $args["site_info"]["address_heading"]; ?>
                            </h6>
                            <?php
                            if (!empty($args["site_info"]["address"])) {
                            $address = $args["site_info"]["address"];
                            foreach ($address as $value) { ?>
                                <p class="footer_add  text_14 line_height_28 sm_line_height_30  font_default mb-0  sm_text_16 text-center text-lg-start pe-xxl-5"> <?php echo $value[
                                	"address"
                                ]; ?><br> <?php echo $value[
	"city"
]; ?> <?php echo $value["state"]; ?> <?php echo $value["zip"]; ?></span></p>
                            <?php }
                            }
                            ?>
                        </div>

                        <div class="order-lg-3 order-2"><span class="d-block mb-3 mb-lg-2 h8  pt-4 text-lg-start text-center mt-lg-0 mt-1">
                        <?php echo !empty( $args["site_info"]["heading"] ) ?  $args["site_info"]["heading"] : ''; 
                        //echo $args["site_info"]["heading"]; ?></span>
                            <div class="text-center text-lg-start d-flex justify-content-lg-start justify-content-center">
                                <?php
                                 if (!empty($args["site_info"]["social_media"]["items"])) {
                                $socialItems =
                                	$args["site_info"]["social_media"]["items"];
                                foreach ($socialItems as $value) {
                                	echo '<a target="_blank" class=" social_media_icons no_hover_underline   mx-2 ms-lg-0 me-lg-3 sm_text_20 sm_line_height_25 no_hover_underline " title="' .
                                		$value["icon_class"] .
                                		'" href="' .
                                		$value["url"] .
                                		'">
		            <i class="' .
                                		$value["icon_class"] .
                                		'"></i>
		        </a>';
                                }
                            }
                                ?>
                            </div></div>


                        <div class="order-lg-2 order-3">
                            <span class="d-block mb-2 h8 pt-4 text-lg-start text-center mb-2"><?php 
                            echo !empty( $args["site_info"]["hours_heading"] ) ?  $args["site_info"]["hours_heading"] : '';
                           // echo $args["site_info"]["hours_heading"]; ?></span>
                            <div class="mw-266 mx-auto">
                                <div class="row">
                                    <div class="col-7 px-lg-3 px-0">
                                        <p class="footer_add text-lg-start text_14 line_height_28 sm_text_16 sm_line_height_30 mb-0 text-center">
                                            <?php echo !empty( $args["site_info"]["week_days"] ) ?  $args["site_info"]["week_days"] : '';
                                            //echo $args["site_info"]["week_days"]; ?></p>     
                                    </div>
                                    <div class="col-5 px-lg-3 px-0">
                                        <p class="footer_add text-lg-start text_14 line_height_28 sm_text_16 sm_line_height_30 mb-0 text-center"><?php 
                                        echo !empty( $args["site_info"]["weekday_hours"] ) ?  $args["site_info"]["weekday_hours"] : '';
                                        //echo $args["site_info"]["weekday_hours"]; ?></p>


                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-7 px-lg-3 px-0">
                                        <p class="footer_add text-lg-start text_14 line_height_28 sm_text_16 sm_line_height_30 mb-0 text-center"><?php 
                                        echo !empty( $args["site_info"]["weekend_days"] ) ?  $args["site_info"]["weekend_days"] : '';
                                       // echo $args["site_info"]["weekend_days"]; ?></p>   
                                    </div>
                                    <div class="col-5 px-lg-3 px-0">
                                        <p class="footer_add text-lg-start text_14 line_height_28 sm_text_16 sm_line_height_30 mb-0  text-center"><?php 
                                        echo !empty($args["site_info"]["weekend_hours"] ) ?  $args["site_info"]["weekend_hours"] : '';
                                       // echo $args["site_info"]["weekend_hours"]; ?></p>   

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php
    $get_rds_template_data_array = RDS_TEMPLATE_DATA;
    // check is service area is enabled
    $enable_service_areas = $get_rds_template_data_array["globals"]["footer"];

    // get service area pagelist on which we need to show
    $service_areas =
    	$get_rds_template_data_array["globals"]["footer"]["service_areas"];
    $page_ids_to_show_service_areas = [];
    foreach ($service_areas as $value) {
    	$get_pageids = $value["page_ids"];
    	$page_ids_to_show_service_areas = array_merge(
    		$page_ids_to_show_service_areas,
    		$get_pageids
    	);
    }
    if (
    	$enable_service_areas["enable"] == true &&
    	is_page($page_ids_to_show_service_areas)
    ) {
    	get_template_part("page-templates/common/servicearea");
    }
    ?>
    <div class=" footer_copyright_bar text-center text-lg-start  font_alt_1 mb-lg-0 mb-5 pt-1 pb-3 pt-lg-4 pb-lg-4">
      <div class="container py-lg-1 pb-3  p-alt  line_height_30   font_alt_1  text_normal  text_16 px-0  ">
         <i class="p-alt icon-copyright4   text_16  line_height_28  "></i> <?php echo date(
            "Y"
            ); ?> <?php
            echo !empty( $args["site_info"]["copyright_title"] ) ?  $args["site_info"]["copyright_title"] : '';
            //echo $args["site_info"]["copyright_title"];
            if (!empty($args["site_info"]["bluecorona_branding"])) { ?><span class="d-none d-sm-inline-block  line_height_30  font_alt_1  text_normal  text_16 d-lg-inline-block">&nbsp;|&nbsp;</span><span class="d-block d-sm-inline-block d-lg-inline-block  p-alt ">Web Design and Digital Marketing by</span>
            
         <a class=" footer_copyright_links a-alt copyright_hover" target="_blank" href="<?php 
         echo !empty( $args["site_info"]["bluecorona_link"] ) ?  $args["site_info"]["bluecorona_link"] : ''
         //echo $args["site_info"]["bluecorona_link"]; ?>">RYNO Strategic Solutions</a><?php } ?><span class="d-none d-sm-inline-block d-lg-inline-block d-none">&nbsp; | &nbsp;</span><a class=" footer_copyright_links  a-alt  copyright_hover"  href="#" data-bs-toggle="modal" data-bs-target="#disclaimer">Disclaimer</a><span class="d-inline-block">&nbsp; | &nbsp;</span><a class=" footer_copyright_links  a-alt copyright_hover" href="<?php echo get_home_url() .

           ( !empty( $args["site_info"]["privacy_policy_link"] ) ?  $args["site_info"]["privacy_policy_link"] : ''); ?>">Privacy Policy</a>
      </div>
   </div>
    <div class="container-fluid m-0 p-0 d-lg-none fixed-bottom btn color_primary_bg" style="position:fixed;">
        <div class="container p-0 color_primary_bg">
            <div class="row no-gutters">
                <div class="col-12 schedule_service text-center">
                    <a data-bs-toggle="modal" href="#" data-bs-target="#cta-a" class="py-3 d-flex align-items-center justify-content-center btn no_hover_underline mh-65"><i  class="icon-calendar-plus3 me-2 text_18 line_height_18 "></i>Schedule Service today <i class="icon-chevron-right2 ms-2 text_18 line_height_18"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade p-0" id="disclaimer" tabindex="-1" data-bs-backdrop="false" role="dialog" aria-labelledby="disclaimerLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content rounded-0">
                <div class="modal-header border-0 text-end ms-auto pb-0">
                    <button type="button" class="close border-0 bg-transparent ms-auto" data-bs-dismiss="modal" aria-label="Close" style="opacity: 1;">
                        <span aria-hidden="true"><i class="icon-xmark1 true_black line_height_24 text_24"></i></span>
                    </button>
                </div>
                <div class="modal-body px-md-5 px-4 pb-5 col-md-10 offset-md-1 text-lg-start text-center">
                    <div id="disclaimerLabel" class="h1">Disclaimer</div>
                    <p class=""><?php 
                    echo !empty( $args["site_info"]["disclaimer_text"] ) ?  $args["site_info"]["disclaimer_text"] : '';
                    //echo $args["site_info"]["disclaimer_text"]; ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade p-0 mobile_cta" id="mobile-cta" tabindex="-1" role="dialog" aria-labelledby="mobilectaLabel" aria-hidden="true">
        <div class="modal-dialog  modal-xl m-0 border_form bg_form pt-lg-3 pb-lg-4  true_white_bg order-lg-1 order-1 h-100" role="document">
            <div class="modal-content rounded-0 border-0 true_white_bg">
                <div class="modal-header border-0 text-end ms-auto pb-0">
                    <button type="button" class="close border-0 bg-transparent ms-auto" data-bs-dismiss="modal" aria-label="Close" style="opacity: 1;">
                        <span aria-hidden="true"><i class="icon-xmark1 line_height_24 text_24"></i></span>
                    </button>
                </div>
                <div class="modal-body px-md-5 px-4 pb-5 col-md-10 offset-md-1 text-lg-start text-center">
                    <span class="d-block pt-lg-1 text-center font_default text_normal text_27 line_height_32"><?php 
                     echo !empty( $args["globals"]["request_service"]["heading"] ) ?  $args["globals"]["request_service"]["heading"] : '';
                    //echo $args["globals"]["request_service"]["heading"]; ?></span>
      
                    <?php echo do_shortcode(
                    	"[gravityforms id=6 ajax=true]"
                    ); ?> 

                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function couponBannerButtonClick(attr) {
            var CouponTitle = jQuery(attr).siblings('.coupon_title').text();
            var CouponsubTitle = jQuery(attr).siblings('.coupon_subtitle').text();
            var Couponsubheading = jQuery(attr).siblings('.coupon_subtitle2 ').text();
            console.log(CouponTitle + " " + CouponsubTitle + " " + Couponsubheading)
            jQuery(".coupon-name").find('input:text').val(CouponTitle + " " + CouponsubTitle + " " + Couponsubheading);
            jQuery(".bc-promotion-title").text(CouponTitle + " " + CouponsubTitle + " " + Couponsubheading);
        }

    </script>
</footer>
