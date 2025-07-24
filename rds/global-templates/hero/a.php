<?php
//exaple how to set image sizewise
// ['dektop', 'ipad', 'mobile']

$img1x = [
	get_exist_image_url("hero", "home-banner"),
	get_exist_image_url("hero", "home-banner"),
	get_exist_image_url("hero", "m-home-banner"),
];
$img2x = [
	get_exist_image_url("hero", "home-banner@2x"),
	get_exist_image_url("hero", "home-banner@2x"),
	get_exist_image_url("hero", "m-home-banner@2x"),
];
$img3x = [
	get_exist_image_url("hero", "home-banner@3x"),
	get_exist_image_url("hero", "home-banner@3x"),
	get_exist_image_url("hero", "m-home-banner@3x"),
];
$img1x = Implode(",", $img1x);
$img2x = Implode(",", $img2x);
$img3x = Implode(",", $img3x);

$heading_tag = isset($args["globals"]["hero"]["heading_tag"])
	? $args["globals"]["hero"]["heading_tag"]
	: "span";
$subheading_tag = isset($args["globals"]["hero"]["subheading_tag"])
	? $args["globals"]["hero"]["subheading_tag"]
	: "span";
?>
<?php echo do_shortcode(
	'[custom-bg-srcset class="home_banner" img1x="' .
		$img1x .
		'" img2x="' .
		$img2x .
		'" img3x="' .
		$img3x .
		'" size1x="cover" size2x="cover" size3x="cover"]'
); ?>
<div class="container-fluid py-lg-0 home_banner px-lg-3 px-0">
    <div class="position-relative">
        <div class="container py-4">
            <div class="row pb-lg-0 pb-2 align-items-lg-center">
                <div class="col-md-8">
                    <?php if (!empty($args["globals"]["hero"]["heading"])) { ?>
                        <span class="display2"><?php echo $args["globals"]["hero"]["heading"]; ?></span>
                    <?php } ?>
                    <?php if (!empty($args["globals"]["hero"]["subheading"])) { ?>
                        <span class="display1"><?php echo $args["globals"]["hero"]["subheading"]; ?></span>
                    <?php } ?>
                    <?php if (!empty($args["globals"]["hero"]["footer_text"])) { ?>
                        <span class="display2 pb-lg-3 mb-lg-1 pb-2"><?php echo $args["globals"]["hero"]["footer_text"]; ?></span>
                    <?php } ?>
                    <?php if (!empty($args["globals"]["hero"]["button_link"]) && !empty($args["globals"]["hero"]["button_text"])) { ?>
                        <a href="<?php echo get_home_url() . $args["globals"]["hero"]["button_link"]; ?>" class="btn btn-primary mw-227 mh-53"><?php echo $args["globals"]["hero"]["button_text"]; ?></a>
                    <?php } ?>
                </div>
                <div class="col-lg-4">
                    <?php if (!empty($args["globals"]["hero"]["form_heading"]) || !empty($args["globals"]["hero"]["form_subheading"]) || !empty($args["globals"]["hero"]["desktop_gravity_form_id"])) { ?>
                        <div class="shadow-xl d-lg-block d-none border-top-tertiary pt-lg-3 pt-4 pb-lg-4 hero_banner_form_background border_form home_form_a">
                            <?php if (!empty($args["globals"]["hero"]["form_heading"])) { ?>
                                <h5 class="d-block pt-lg-1 text-center"><?php echo $args["globals"]["hero"]["form_heading"]; ?></h5>
                            <?php } ?>
                            <?php if (!empty($args["globals"]["hero"]["form_subheading"])) { ?>
                                <h3 class="d-block pb-lg-2 text-center"><?php echo $args["globals"]["hero"]["form_subheading"]; ?></h3>
                            <?php } ?>
                            <?php
                            $form_id = $args["globals"]["hero"]["desktop_gravity_form_id"];
                            if (!empty($form_id)) {
                                echo do_shortcode("[gravityforms id=" . $form_id . " ajax=true]");
                            }
                            ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
