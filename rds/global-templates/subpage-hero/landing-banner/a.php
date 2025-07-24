<?php
if (isset($args["asset_variation"])) {
    $asset_variation = $args["asset_variation"];
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
    <div class="container px-0 py-lg-1 position-relative z-index">
        <div class="row py-lg-5">
            <div class="col-md-5 mx-auto text-center">  
                <span class="h1-alt  text-center pb-1 d-block"><?php echo $args[
                	"page_templates"
                ]["landing_page"]["banner"]["heading"]; ?></span>
                <h2 class="h2-alt text-center mb-0 pb-2"><?php echo $args[
                	"page_templates"
                ]["landing_page"]["banner"]["subheading"]; ?></h2> 
                <p class="p-alt text-center mb-0 pb-2 px-lg-3 mx-lg-3 "><?php echo $args[
                	"page_templates"
                ]["landing_page"]["banner"]["content"]; ?></p>
                <?php if (
                	!empty(
                		$args["page_templates"]["landing_page"]["banner"][
                			"button_text"
                		]
                	)
                ) { ?>
                <button onclick="scrollSmoothTo('request_service')" class="btn btn-primary mw-194 scrollTo"><?php echo $args[
                	"page_templates"
                ]["landing_page"]["banner"]["button_text"]; ?></button>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function scrollSmoothTo(elementId) {
        var element = document.getElementById(elementId);
        if (element !== null) {
            element.scrollIntoView({
                block: 'start',
                behavior: 'smooth'
            });
        }
    }
</script>

<style>
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