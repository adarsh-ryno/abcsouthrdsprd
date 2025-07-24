<?php
if (isset($args["asset_variation"])) {
    $assvariationIsset = $args["asset_variation"];
    $asset_variation = $args["asset_variation_isset"];
    $selectedFolder = $args["asset_variation"];
}

$img1x = get_exist_image_url("landing-page", "landing-banner");
$img2x = get_exist_image_url("landing-page", "landing-banner@2x");
$img3x = get_exist_image_url("landing-page", "landing-banner@3x");
$size3x = 'cover';
$size2x = 'cover';

if (isset($asset_variation)) {
	$img1x = get_exist_image_url(
		"landing-page/" . $selectedFolder,
		"landing-banner"
	);
	$img2x = get_exist_image_url(
		"landing-page/" . $selectedFolder,
		"landing-banner@2x"
	);
	$img3x = get_exist_image_url(
		"landing-page/" . $selectedFolder,
		"landing-banner@3x"
	);
}

$img1x = implode(",", (array) $img1x);
$img2x = implode(",", (array) $img2x);
$img3x = implode(",", (array) $img3x);

echo do_shortcode(
	'[custom-bg-srcset class="landing_banner" img1x="' .
		$img1x .
		'" img2x="' .
		$img2x .
		'" img3x="' .
		$img3x .
		'" size1x="cover" size2x="cover" size3x="cover"]'
);
?>
<div class="container-fluid landing_banner py-5 position-relative">
    <div class="position-relative">
        <div class="container py-4">
            <div class="row pb-lg-0 pb-2 align-items-lg-center">
                <div class="col-md-8">
                    <span class="true_white  display2"><?php echo $args[
                    	"page_templates"
                    ]["landing_page"]["banner"][
                    	"heading"
                    ]; ?></<?php $heading_tag ?>></span>
                    <span class="true_white display1"><?php echo $args[
                    	"page_templates"
                    ]["landing_page"]["banner"][
                    	"subheading"
                    ]; ?></<?php $subheading_tag ?>></span>
                    <span class="display2 pb-lg-3 mb-lg-1 pb-2"><?php echo $args[
                    	"page_templates"
                    ]["landing_page"]["banner"]["content"]; ?></span>
                    <a href="<?php echo $args["page_templates"]["landing_page"][
                    	"banner"
                    ][
                    	"button_link"
                    ]; ?>" class="btn btn-primary mw-227 mh-53"><?php echo $args[
	"page_templates"
]["landing_page"]["banner"]["button_text"]; ?> 
                    </a>

                </div>
                <div class="sidebar landing-form col-lg-4"><div class="shadow-xl d-lg-block d-none pt-lg-3 pb-lg-4 color_secondary_bg shadow-lg border_form border_form_light  order-lg-1 order-1">
    
    <span class="d-block pt-lg-1 p-alt text-center font_default text_normal text_26 line_height_31 pb-1"><?php echo $args[
    	"page_templates"
    ]["landing_page"]["banner"]["form_heading"]; ?></span>
   
     <?php
     $form_id =
     	$args["page_templates"]["landing_page"]["banner"]["gravity_form_id"];
     echo do_shortcode("[gravityforms id=" . $form_id . " ajax=true]");
     ?> 
</div></div>
            </div>
        </div>
    </div>
</div>


<style>
.landing_banner .landing-form .gform_wrapper ul li.gfield .large , .landing_banner .border_form.border_form_light .floating_labels_wrapper .floating_labels label{
    color:#fff!important;
}
.landing_banner .border_form.border_form_light .gform_wrapper .gfield_checkbox .gchoice .gfield-choice-input{
    background-color:#fff!important;
}
    @media only screen and (max-width: 767px) {
        .landing_banner {
            background-image: -webkit-image-set(
                url('<?php echo $img1x; ?>') 1x,
                url('<?php echo $img2x; ?>') 2x,
                url('<?php echo $img3x; ?>') 3x
            );
            background-image: image-set(
                url('<?php echo $img1x; ?>') 1x,
                url('<?php echo $img2x; ?>') 2x,
                url('<?php echo $img3x; ?>') 3x
            );

            background-size: <?php echo $size3x; ?>;
            background-repeat: no-repeat;
            background-position: center center !important;
        }
    }

    @media only screen and (min-width: 768px) and (max-width: 1024px) {
        .landing_banner {
            background-image: -webkit-image-set(
                url('<?php echo $img1x; ?>') 1x,
                url('<?php echo $img2x; ?>') 2x,
                url('<?php echo $img3x; ?>') 3x
            );
            background-image: image-set(
                url('<?php echo $img1x; ?>') 1x,
                url('<?php echo $img2x; ?>') 2x,
                url('<?php echo $img3x; ?>') 3x
            );

            background-size: <?php echo $size2x; ?>;
            background-repeat: no-repeat;
            background-position: center center !important;
        }
    }
</style>