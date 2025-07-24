<?php
$get_alt_text = RDS_ALT_DATA;
$financing_home_svg_alt = "";
if (is_array($get_alt_text)) {
    foreach ($get_alt_text as $value) {
        if (in_array("financing-a-badge.webp", $value) || in_array("financing-a-badge.svg", $value)) {
            $financing_home_svg_alt = 'alt="' . $value[3] . '"';
        }
    }
}
?>
<div class="d-block ">   
    <div class="container-fluid text-center px-lg-3 px-0 py-5 py-lg-4 text-center  ">
        <div class="container py-lg-0 py-2">
            <div class="row align-items-center">
                <div class="col-sm-12 col-lg-3">
                    <?php
                    $financing_image_url = get_exist_image_url("fullwidth-cta", "financing-a-badge");
                    if (!empty($financing_image_url)) {
                        if (@getimagesize($financing_image_url) === false) { ?>
                            <img src="<?php echo esc_url($financing_image_url); ?>" class="img-fluid" <?php echo $financing_home_svg_alt; ?>>
                        <?php } else { ?>
                            <img src="<?php echo esc_url($financing_image_url); ?>" srcset="<?php echo esc_url($financing_image_url); ?> 1x, <?php echo esc_url(get_exist_image_url("fullwidth-cta", "financing-a-badge@2x")); ?> 2x, <?php echo esc_url(get_exist_image_url("fullwidth-cta", "financing-a-badge@3x")); ?> 3x" class="img-fluid" <?php echo $financing_home_svg_alt; ?>>
                        <?php }
                    }
                    ?>
                </div>
                <div class="col-sm-12 col-lg-6 text-center py-lg-0 py-4">
                    <?php if (!empty($args["globals"]["financing"]["heading"])): ?>
                        <h6 class="h6-alt"><?php echo $args["globals"]["financing"]["heading"]; ?></h6>
                    <?php endif; ?>
                    <?php if (!empty($args["globals"]["financing"]["subheading"])): ?>
                        <h4 class="h4-alt mt-2 mb-0 d-block"><?php echo $args["globals"]["financing"]["subheading"]; ?></h4>
                    <?php endif; ?>
                </div>
                <div class="col-sm-12 col-lg-3 text-center text-lg-end">
                    <?php if (!empty($args["globals"]["financing"]["button_text"]) && !empty($args["globals"]["financing"]["button_link"])): ?>
                        <a href="<?php echo esc_url(get_home_url() . $args["globals"]["financing"]["button_link"]); ?>" class="no_hover_underline">
                            <button type="button" class="btn btn-secondary">
                                <?php echo esc_html($args["globals"]["financing"]["button_text"]); ?>
                            </button>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
