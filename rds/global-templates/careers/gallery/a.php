<?php
$get_alt_text = RDS_ALT_DATA;
$alt_texts = [];

if (is_array($get_alt_text)) {
    foreach ($get_alt_text as $value) {
        if (isset($value[0]) && isset($value[3]) && !empty($value[0]) && !empty($value[3])) {
            $image_filename = $value[0];
            $alt_texts[$image_filename] = 'alt="' . $value[3] . '"';
        }
    }
}

?>
<div class="container-fluid pb-lg-0 mb-lg-5 mb-md-5 pt-lg-5">
    <div class="row pb-lg-1">
        <div class="col-lg-12">
            <div class="grid">
                <?php for ($i = 1; $i <= 13; $i++) {
                    $image_key = "careers-gallery-" . $i . ".webp";
                    $alt_text = isset($alt_texts[$image_key]) ? $alt_texts[$image_key] : '';

                    $image_url = get_exist_image_url("careers", "careers-gallery-" . $i . "");
                    $image_url2x = get_exist_image_url("careers", "careers-gallery-" . $i . "@2x");
                    $image_url3x = get_exist_image_url("careers", "careers-gallery-" . $i . "@3x");

                    if (!empty($image_url)) {
                ?>
                    <div class="grid_inner mb-32">
                        <img src="<?php echo esc_url($image_url); ?>" <?php echo $alt_text; ?> class="img-fluid" srcset="<?php echo esc_url($image_url); ?> 1x, <?php echo esc_url($image_url2x); ?> 2x, <?php echo esc_url($image_url3x); ?> 3x">
                    </div>
                <?php
                    }
                } ?>
            </div>
        </div>
    </div>
</div>
