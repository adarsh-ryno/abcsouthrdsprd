<?php
add_action("init", "register_site_info_shortcodes");

function register_site_info_shortcodes()
{
	$templateData = get_decoded_template_data();

	if (empty($templateData)) {
		return;
	}

	foreach ($templateData as $key => $value) {
		$shortcode_name = "site_info_" . $key;
		add_shortcode($shortcode_name, function () use ($key, $value) {
			return $value;
		});
	}

	add_shortcode("address", "get_address_info");
	// add_shortcode('search_box', 'get_search_box_info');
	add_shortcode("license_number", "get_license_number_info");
	add_shortcode("social_media", "get_social_media_info");
}

function get_address_info()
{
	$templateData = get_decoded_template_data();

	if (
		!isset($templateData["address"]) ||
		!is_array($templateData["address"])
	) {
		return "";
	}

	$address_info = "";

	foreach ($templateData["address"] as $address) {
		$address_info .=
			$address["address"] .
			", " .
			$address["city"] .
			", " .
			$address["state"] .
			" " .
			$address["zip"] .
			" ";
		if (!empty($address["map_directions_link"])) {
			$address_info .=
				"Map directions: " . $address["map_directions_link"];
		}
		$address_info .= " ";
	}

	return $address_info;
}

/*function get_search_box_info() {
    $templateData = get_decoded_template_data();

    if (!isset($templateData['search_box'])) {
        return '';
    }

    $search_box_info = '';
    $search_box = $templateData['search_box'];

    if (!empty($search_box['icon_class'])) {
        $search_box_info .= $search_box['icon_class'] . ', ';
    }

    if (!empty($search_box['placeholder'])) {
        $search_box_info .= $search_box['placeholder'] . ', ';
    }

    if (!empty($search_box['button_text'])) {
        $search_box_info .= $search_box['button_text'];
    }

    return $search_box_info;
}
*/
function get_license_number_info()
{
	$templateData = get_decoded_template_data();

	if (!isset($templateData["license_number"])) {
		return "";
	}

	$license_number_info = "";

	foreach ($templateData["license_number"] as $license) {
		if (!empty($license)) {
			$license_number_info .= $license . ", ";
		}
	}

	return rtrim($license_number_info, ", ");
}

function get_social_media_info()
{
	$templateData = get_decoded_template_data();

	if (!isset($templateData["social_media"]["items"])) {
		return "";
	}

	$social_media_info = "";

	foreach ($templateData["social_media"]["items"] as $social_item) {
		if (!empty($social_item["icon_class"]) && !empty($social_item["url"])) {
			$social_media_info .= $social_item["icon_class"] . ", ";
			$social_media_info .= $social_item["url"] . "<br>";
		}
	}

	return $social_media_info;
}

function get_decoded_template_data()
{
	$rdsTemplate = get_option("rds_template");
	$templateData = json_decode($rdsTemplate, true);

	if (json_last_error() !== JSON_ERROR_NONE || !is_array($templateData)) {
		return [];
	}

	return $templateData["site_info"];
}

?>
