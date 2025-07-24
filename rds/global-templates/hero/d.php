<?php
//exaple how to set image sizewise
// ['dektop', 'ipad', 'mobile']
$img1x = [get_exist_image_url("hero", "home-banner"), get_exist_image_url("hero", "home-banner"), get_exist_image_url("hero", "m-home-banner")];
$img2x = [get_exist_image_url("hero", "home-banner@2x"), get_exist_image_url("hero", "home-banner@2x"), get_exist_image_url("hero", "m-home-banner@2x")];
$img3x = [get_exist_image_url("hero", "home-banner@3x"), get_exist_image_url("hero", "home-banner@3x"), get_exist_image_url("hero", "m-home-banner@3x")];
$img1x = Implode(",", $img1x);
$img2x = Implode(",", $img2x);
$img3x = Implode(",", $img3x);
?>
<?php echo do_shortcode('[custom-bg-srcset class="home_banner" img1x="' . $img1x . '" img2x="' . $img2x . '" img3x="' . $img3x . '" size1x="cover" size2x="cover" size3x="cover"]'); ?>
<div class="container-fluid py-lg-5 home_banner px-lg-3 px-0">
    <div class="position-relative py-lg-4 pt-5">
        <div class="container py-lg-5 py-4">
            <div class="row py-lg-4 py-2 my-lg-3">
                <div class="col-md-12 pb-lg-4 position-relative bottom-lg-75">
                    <?php if (!empty($args["globals"]["hero"]["heading"])) { ?>
                        <span class="display2"><?php echo $args["globals"]["hero"]["heading"]; ?></span>
                    <?php } ?>
                    <?php if (!empty($args["globals"]["hero"]["subheading"])) { ?>
                        <span class="display1"><?php echo $args["globals"]["hero"]["subheading"]; ?></span>
                    <?php } ?>
                    <?php if (!empty($args["globals"]["hero"]["footer_text"])) { ?>
                        <span class="display2 pb-lg-3 mb-lg-2 pb-2"><?php echo $args["globals"]["hero"]["footer_text"]; ?></span>
                    <?php } ?>
                    <?php if (!empty($args["globals"]["hero"]["button_link"]) && !empty($args["globals"]["hero"]["button_text"])) { ?>
                        <a href="<?php echo get_home_url() . $args["globals"]["hero"]["button_link"]; ?>" class="btn btn-primary mw-227 mh-53"><?php echo $args["globals"]["hero"]["button_text"]; ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
