<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Understrap
 */
// Exit if accessed directly.
defined("ABSPATH") || exit();
global $template;
?>
<?php do_action("rds_footer_top"); ?>
<?php
$get_rds_template_data_array = RDS_TEMPLATE_DATA;
if (basename($template) == "rds-landing.php") {
    if (isset($get_rds_template_data_array["page_templates"]["landing_page"]["footer"]["variation"]) &&
        !empty($get_rds_template_data_array["page_templates"]["landing_page"]["footer"]["variation"])) {
        $variation = $get_rds_template_data_array["page_templates"]["landing_page"]["footer"]["variation"];
        if ($variation == "a") {
            get_template_part("global-templates/footer/a", null, $get_rds_template_data_array);
        } elseif ($variation == "b") {
            get_template_part("global-templates/footer/b", null, $get_rds_template_data_array);
        }
    }
} else {
    if (basename($template) != "rds-elementor.php") {
        //   echo do_shortcode('[elementor-template id="39015"]');
    }
}

$footerItems = !empty($get_rds_template_data_array["globals"]["ctas"]) ? $get_rds_template_data_array["globals"]["ctas"] : [];
$desktopItems = !empty($get_rds_template_data_array["globals"]["desktop_schedule_online_button"]) ? $get_rds_template_data_array["globals"]["desktop_schedule_online_button"] : [];
$heroItems = !empty($get_rds_template_data_array["globals"]["hero"]["schedule_online"]) ? $get_rds_template_data_array["globals"]["hero"]["schedule_online"] : [];

if (is_array($heroItems) && isset($heroItems["type"]) && !empty($heroItems["type"])): ?>
    <?php if ($heroItems["type"] == "schedule_engine"): ?>
        <script type="text/javascript">
            jQuery("#schedule_online_button_hero").click(function () {
                if (typeof ScheduleEngine !== "undefined" && ScheduleEngine) {
                    ScheduleEngine.show();
                }
            });
        </script>
    <?php elseif ($heroItems["type"] == "service_titan"): ?>
        <script type="text/javascript">
            jQuery("#schedule_online_button_hero").click(function () {
                if (typeof STWidgetManager !== "undefined" && STWidgetManager) {
                    STWidgetManager("ws-open");
                }
            });
        </script>
    <?php endif; ?>
<?php endif; ?>

<?php
if (isset($desktopItems["type"]) && !empty($desktopItems["type"])) {
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
    <?php }
}

$i = 0;
if (is_array($footerItems)) {
    foreach ($footerItems as $key => $value) {
        if (isset($value["enabled"]) && $value["enabled"] === true) {
            if (isset($value["type"]) && !empty($value["type"])) {
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
                <?php } elseif ($value["type"] == "url" && $key == "schedule_online") { ?>
                    <script type="text/javascript">
                        var href = "<?php echo !empty($value["url"]) ? esc_url(get_home_url() . $value["url"]) : ''; ?>";
                        jQuery("#schedule_online_button").attr("href", href);
                        jQuery("#rds_footer_element_<?php echo $i; ?>").attr("href", href);
                    </script>
                <?php } elseif ($value["type"] == "sms") { ?>
                    <script type="text/javascript">
                        var href = "<?php echo !empty($value['url']) ? htmlspecialchars($value['url'], ENT_QUOTES) : ''; ?>";
                        jQuery("#rds_footer_element_<?php echo $i; ?>").attr("href", href);
                    </script>
                <?php } else { ?>
                    <script type="text/javascript">
                        var href = "<?php echo !empty($value['url']) ? esc_url(get_home_url() . $value['url']) : ''; ?>";
                        jQuery("#rds_footer_element_<?php echo $i; ?>").attr("href", href);
                    </script>
                <?php }
            }
        }
        $i++;
    }
}

// Example of setting image size-wise
$img1x = [get_exist_image_url("in-content-cta", "in-content-bg"), get_exist_image_url("in-content-cta", "in-content-bg@2x"), get_exist_image_url("in-content-cta", "in-content-bg@3x")];
$img2x = [get_exist_image_url("in-content-cta", "in-content-bg"), get_exist_image_url("in-content-cta", "in-content-bg@2x"), get_exist_image_url("in-content-cta", "in-content-bg@3x")];
$img3x = [get_exist_image_url("in-content-cta", "in-content-bg"), get_exist_image_url("in-content-cta", "in-content-bg@2x"), get_exist_image_url("in-content-cta", "in-content-bg@3x")];
$img1x = implode(",", $img1x);
$img2x = implode(",", $img2x);
$img3x = implode(",", $img3x);
?>
<?php echo do_shortcode('[custom-bg-srcset class="got-an-emergency" img1x="' . $img1x . '" img2x="' . $img2x . '" img3x="' . $img3x . '" size1x="cover" size2x="cover" size3x="cover"]'); ?>

<script type="text/javascript">
    let places, input, address, city, inputs_class;
    jQuery(document).ready(function ($) {
        // CODE FOR GEOLOCATION AUTOMATIC FIELD START
        jQuery('body').on("keyup", '.rds_geo_autopopulate_value .ginput_container_text input', function () {
            input_class = $(this);
            var city = "";
            var state = "";
            var places = new google.maps.places.Autocomplete(input_class[0]);
            google.maps.event.addListener(places, "place_changed", function () {
                var place = places.getPlace();
                var address = place.formatted_address;
                var latitude = place.geometry.location.lat();
                var longitude = place.geometry.location.lng();
                var latlng = new google.maps.LatLng(latitude, longitude);
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({latLng: latlng}, function (results, status) {
                    if (status === google.maps.GeocoderStatus.OK && results[0]) {
                        var address = results[0].formatted_address;
                        var pin = results[0].address_components[results[0].address_components.length - 1].long_name;
                        var country = results[0].address_components[results[0].address_components.length - 2].long_name;
                        state = results[0].address_components[results[0].address_components.length - 3].long_name;
                        city = results[0].address_components[results[0].address_components.length - 4].long_name;
                        jQuery(input_class).parent().parent().siblings(".rds_gravity_state_city").find('input').val(city + ', ' + state);
                        jQuery(input_class).parent().parent().siblings(".rds_gravity_state_city").find('.gfield_label').addClass('float_label');
                    }
                });
            });
        });
        // CODE FOR GEOLOCATION AUTOMATIC FIELD END
    });

    // CODE FOR OVERLAPPING TEXT FIELDS AFTER SUBMISSION START
    jQuery(document).on('gform_post_render', function (event, form_id, current_page) {
        var iframe_html = jQuery("#gform_ajax_frame_" + form_id).contents().find("html body").html();
        var error = jQuery(iframe_html).find(".gform_validation_errors");
        if (iframe_html && error.length == 0) {
            var inputs = jQuery(".rds_gravity_state_city input");
            var get_fields = inputs.attr('id');
            jQuery(".rds_gravity_state_city").find("input").each(function () {
                if (jQuery(this).val() !== "" && jQuery(this).parent().find('.gfield_label').length) {
                    jQuery(this).parent().find('.gfield_label').addClass('float_label');
                }
            });
        }
    });
    // CODE FOR OVERLAPPING TEXT FIELDS AFTER SUBMISSION END

    // CODE FOR TEXTAREA FIELD START
    jQuery('.rds_gravity_textarea').each(function () {
        var $this = jQuery(this);
        if ($this.find('textarea').length) {
            var value = $this.find('textarea').val();
            if (value.length > 0) {
                $this.find('textarea').addClass('textarea_open');
            }
        }
    });
    // CODE FOR TEXTAREA FIELD END
</script>

<?php wp_footer(); ?>
</body>
</html>
