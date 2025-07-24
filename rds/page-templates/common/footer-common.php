<?php
$args = RDS_TEMPLATE_DATA;

$get_rds_tracking = rds_tracking();
if (is_array($get_rds_tracking) && isset($get_rds_tracking["tracking"]["enable"]) && $get_rds_tracking["tracking"]["enable"] == true) {
    // do_action('rds_footer_top');
}
$get_rds_template_data_array = RDS_TEMPLATE_DATA;
$footerItems = $get_rds_template_data_array["globals"]["ctas"];
$desktopItems =
	$get_rds_template_data_array["globals"]["desktop_schedule_online_button"];
$heroItems = $get_rds_template_data_array["globals"]["hero"]["schedule_online"];
if ($heroItems["type"] == "schedule_engine") { ?>
    <script type="text/javascript">
        jQuery("#schedule_online_button_hero").click(function () {
            if (typeof ScheduleEngine !== "undefined" && ScheduleEngine) {
                ScheduleEngine.show();
            }
        });
    </script>
<?php } elseif ($heroItems["type"] == "service_titan") { ?>
    <script type="text/javascript">
        jQuery("#schedule_online_button_hero").click(function () {
            if (typeof STWidgetManager !== "undefined" && STWidgetManager) {
                STWidgetManager("ws-open");
            }
        });
    </script>
    <?php } elseif ($desktopItems["type"] === "zocdoc") { ?>
    <script type="text/javascript">
    jQuery(document).ready(function(){
        var zocdocContent = '<?php echo $get_rds_tracking["scheduler"][
        	"zocdoc_content"
        ]; ?>';
        jQuery('a.btn.btn-primary.mw-242.mh-43.no_hover_underline').attr('href','https://www.zocdoc.com/practice/mind-management-counseling-' + zocdocContent).addClass('zd-plugin').attr({'data-type':'book-button',  'data-practice-id': zocdocContent});
    });
</script>

    <?php }

if ($desktopItems["type"] == "schedule_engine") { ?>
    <script type="text/javascript">
        jQuery("#schedule_online_button_desktop").click(function () {
            if (typeof ScheduleEngine !== "undefined" && ScheduleEngine) {
                ScheduleEngine.show();
            }
        });
    </script>
<?php } elseif ($desktopItems["type"] == "service_titan") { ?>
    <script type="text/javascript">
        jQuery("#schedule_online_button_desktop").click(function () {
            if (typeof STWidgetManager !== "undefined" && STWidgetManager) {
                STWidgetManager("ws-open");
            }
        });
    </script>
    <?php } elseif ($desktopItems["type"] === "zocdoc") { ?>
    <script type="text/javascript">
    jQuery(document).ready(function(){
        var zocdocContent = '<?php echo $get_rds_tracking["scheduler"][
        	"zocdoc_content"
        ]; ?>';
        jQuery('a.btn.btn-primary.mw-242.mh-43.no_hover_underline').attr('href','https://www.zocdoc.com/practice/mind-management-counseling-' + zocdocContent).addClass('zd-plugin').attr({'data-type':'book-button',  'data-practice-id': zocdocContent});
    });
</script>

    <?php }

$i = 0;
foreach ($footerItems as $key => $value) {
	if ($value["enabled"] == true) {
		if ($value["type"] == "service_titan") { ?>
            <script type="text/javascript">
                jQuery("#schedule_online_button, #rds_footer_element_<?php echo $i; ?>").click(function () {
                    if (typeof STWidgetManager !== "undefined" && STWidgetManager) {
                        STWidgetManager("ws-open");
                    }
                });
            </script>
            <?php } elseif ($value["type"] == "schedule_engine") { ?>
            <script type="text/javascript">
                jQuery("#schedule_online_button, #rds_footer_element_<?php echo $i; ?>").click(function () {
                    if (typeof ScheduleEngine !== "undefined" && ScheduleEngine) {
                        ScheduleEngine.show();
                    }
                });
            </script>
            <?php } elseif (
			$value["type"] == "url" &&
			$key == "schedule_online"
		) { ?>
            <script type="text/javascript">
                var href = "<?php echo get_home_url() . $value["url"]; ?>";
                jQuery("#schedule_online_button").attr("href", href)
                jQuery("#rds_footer_element_<?php echo $i ?>").attr("href", href);
            </script>
            <?php } elseif ($value["type"] == "sms") { ?>
            <script type="text/javascript">
                var href = "<?php echo $value["url"]; ?>";
                jQuery("#rds_footer_element_<?php echo $i ?>").attr("href", href);
            </script>
            <?php } else { ?>
            <script type="text/javascript">
                var href = "<?php echo get_home_url() . $value["url"]; ?>";
                jQuery("#rds_footer_element_<?php echo $i ?>").attr("href", href)
            </script>
            <?php }
	}
	$i++;
}
//exaple how to set image sizewise
// ['dektop', 'ipad', 'mobile']
$img1x = [
	get_exist_image_url("in-content-cta", "in-content-bg"),
	get_exist_image_url("in-content-cta", "in-content-bg@2x"),
	get_exist_image_url("in-content-cta", "in-content-bg@3x"),
];

$img2x = [
	get_exist_image_url("in-content-cta", "in-content-bg"),
	get_exist_image_url("in-content-cta", "in-content-bg@2x"),
	get_exist_image_url("in-content-cta", "in-content-bg@3x"),
];

$img3x = [
	get_exist_image_url("in-content-cta", "in-content-bg"),
	get_exist_image_url("in-content-cta", "in-content-bg@2x"),
	get_exist_image_url("in-content-cta", "in-content-bg@3x"),
];
$img1x = Implode(",", $img1x);
$img2x = Implode(",", $img2x);
$img3x = Implode(",", $img3x);
?>
<?php echo do_shortcode(
	'[custom-bg-srcset class="got-an-emergency" img1x="' .
		$img1x .
		'" img2x="' .
		$img2x .
		'" img3x="' .
		$img3x .
		'" size1x="cover" size2x="cover" size3x="cover"]'
); ?>

<script type="text/javascript">
    let places, input, address, city, inputs_class;
    jQuery(document).ready(function ($) {
//CODE FOR GEOLOCATION AUTOMATIC FIELD START
        jQuery('body').on("keyup", '.rds_geo_autopopulate_value .ginput_container_text input', function () {
            input_class = $(this);
            var city = "";
            var state = "";
            var places = new google.maps.places.Autocomplete(
                input_class[0]
                );
            google.maps.event.addListener(places, "place_changed", function () {
                var place = places.getPlace();
                var address = place.formatted_address;
                var latitude = place.geometry.location.lat();
                var longitude = place.geometry.location.lng();
                var latlng = new google.maps.LatLng(latitude, longitude);
                var geocoder = (geocoder = new google.maps.Geocoder());
                geocoder.geocode({latLng: latlng}, function (results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            var address = results[0].formatted_address;
                            var pin =
                            results[0].address_components[
                                results[0].address_components.length - 1
                                ].long_name;
                            var country =
                            results[0].address_components[
                                results[0].address_components.length - 2
                                ].long_name;
                            state =
                            results[0].address_components[
                                results[0].address_components.length - 3
                                ].long_name;
                            city =
                            results[0].address_components[
                                results[0].address_components.length - 4
                                ].long_name;
                            jQuery(input_class).parent().parent().siblings(".rds_gravity_state_city").find('input').val(city + ', ' + state);
                            jQuery(input_class).parent().parent().siblings(".rds_gravity_state_city").find('.gfield_label').addClass('float_label');
                        }
                    }
                });
            });

        });
//CODE FOR GEOLOCATION AUTOMATIC FIELD END
    });
//CODE FOR OVERLAPING TEXT FIELDS AFTER SUBMITION STATRT
    jQuery(document).on('gform_post_render', function (event, form_id, current_page) {
        var iframe_html = jQuery("#gform_ajax_frame_" + form_id).contents().find("html body").html();
        var error = jQuery(iframe_html).find(".gform_validation_errors");
        if (iframe_html && error.length == 0) {
//            event.preventDefault();
            jQuery("body").find("#gform_" + form_id + " .gfield_label").each(function (k, d) {
                if (jQuery(window).width() > 991) {
                    if (jQuery(this).closest(".home_form_c").length > 0) {
                        this.style.setProperty('margin-top', '-2px', 'important');
                        this.style.setProperty('color', '#949ca1', 'important');
                        this.style.setProperty('font-size', '9px', 'important');
                    } else {
                        this.style.setProperty('margin-top', '7px', 'important');
                        this.style.setProperty('color', '#000', 'important');
                        this.style.setProperty('font-size', '9px', 'important');
                    }
                } else {
//                                this.style.setProperty('margin-left', '10px', 'important');
                    this.style.setProperty('margin-left', '0px', 'important');
                }
//                this.classList.add("float_label");
            });

        }
    });
//CODE FOR OVERLAPING TEXT FIELDS AFTER SUBMITION END

    function rgb2hex(rgb) {
        rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
        return (rgb && rgb.length === 4) ? "#" +
        ("0" + parseInt(rgb[1], 10).toString(16)).slice(-2) +
        ("0" + parseInt(rgb[2], 10).toString(16)).slice(-2) +
        ("0" + parseInt(rgb[3], 10).toString(16)).slice(-2) : '';
    }
    function wc_hex_is_light(color) {
        const hex = color.replace('#', '');
        const c_r = parseInt(hex.substring(0, 0 + 2), 16);
        const c_g = parseInt(hex.substring(2, 2 + 2), 16);
        const c_b = parseInt(hex.substring(4, 4 + 2), 16);
        const brightness = ((c_r * 299) + (c_g * 587) + (c_b * 114)) / 1000;
        return brightness > 155;
    }
    jQuery(document).ready(function () {

        jQuery(".apply-conditional-color").each(function (index) {
            let color_bg = jQuery(this).parents('.container-fluid, #cta-a ').css("background-color");
// let model_color_bg = jQuery(this).parents('#cta-a').css("background-color");
            let dark_color_class = jQuery(this).data("dark-color")
            let light_color_class = jQuery(this).data("light-color")

// console.log(light_color_class,dark_color_class,rgb2hex(color_bg),wc_hex_is_light(rgb2hex(color_bg)));
            if (wc_hex_is_light(rgb2hex(color_bg))) {
                jQuery(this).addClass(dark_color_class);
            } else {
                jQuery(this).addClass(light_color_class);
            }

        });
        jQuery(".tool_tip_text").find("a.text-uppercase.text-decoration-none").attr("class","color_primary_hover")
    });
</script>    
<script>
jQuery('.collapse.navbar-collapse').on('show.bs.collapse', function () {
    jQuery('.uwy').hide();
});

jQuery('.collapse.navbar-collapse').on('hidden.bs.collapse', function () {
    jQuery('.uwy').show();
});

jQuery('#cta-a').on('show.bs.modal', function () {
    jQuery('.uwy').hide();  // Hide .uwy when the modal is shown
});

jQuery('#cta-a').on('hidden.bs.modal', function () {
    jQuery('.uwy').show();  // Show .uwy when the modal is hidden
});

</script>    
<?php 
if (is_array($get_rds_tracking) && isset($get_rds_tracking["tracking"]["enable"]) && $get_rds_tracking["tracking"]["enable"] == true) {
	//do_action('rds_footer_bottom');
} ?>
