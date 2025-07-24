<?php
global $rdsTemplateDataGlobal;
$args = $rdsTemplateDataGlobal;
$post_id = get_the_ID();
$meta = get_post_meta($post_id);

if (isset($meta["_elementor_template_type"], $meta["_elementor_edit_mode"])) {
    if (isset($meta["_elementor_data"])) {
        $elementorData = $meta["_elementor_data"][0] ?? null;
        if ($elementorData) {
            $array_data = json_decode($elementorData, true);
            if (isset($array_data[0]["elements"][0]["elements"][0]["settings"]["template_id"])) {
                $template_id = $array_data[0]["elements"][0]["elements"][0]["settings"]["template_id"];

                if ($template_id == 40758) {
                    $image_placeholder_image = get_exist_image_url("about-page", "about-img");
                    $image_placeholder_image2x = get_exist_image_url("about-page", "about-img@2x");
                    $image_placeholder_image3x = get_exist_image_url("about-page", "about-img@3x");

                    // Constructing image HTML
                    $a = '<img src="' . $image_placeholder_image . '" srcset="' . $image_placeholder_image . ' 1x, ' . $image_placeholder_image2x . ' 2x, ' . $image_placeholder_image3x . ' 3x" class="img-fluid float-lg-end ms-lg-5 pb-lg-0 pb-4 d-lg-inline-block d-none" width="540" height="534" alt="Homepage Image">
                    <img src="' . $image_placeholder_image . '" srcset="' . $image_placeholder_image . ' 1x, ' . $image_placeholder_image2x . ' 2x, ' . $image_placeholder_image3x . ' 3x"  class="img-fluid float-lg-end ms-lg-5 pb-lg-0 pb-4 d-inline-block d-lg-none" width="540" height="534" alt="Homepage Image">';
                }
            }
        }
    }
}
$template_id = get_current_elementor_template_id();
		//echo $template_id;
		if ($template_id == 41084) {
?>

<div class="d-block">
    <div class="container-fluid pt-lg-4 py-lg-0 py-2 text-start">
        <div class="container pt-lg-3 py-2">
            <div class="row py-lg-2">
                <div class="col-lg-12 px-0 bc_homepage seosection-bc text-md-left seotext-sm-center">
                    <?php
                    $postId = isset($_GET['post']) ? $_GET['post'] : null;
                    if ($postId == 40758) {
                    ?>
                        <img src="<?php echo get_exist_image_url("about-page", "about-img"); ?>" srcset="<?php echo get_exist_image_url("about-page", "about-img"); ?> 1x, <?php echo get_exist_image_url("about-page", "about-img@2x"); ?> 2x, <?php echo get_exist_image_url("about-page", "about-img@3x"); ?> 3x" class="img-fluid float-lg-end ms-lg-5 pb-lg-0 pb-4" width="540" height="534" alt="Homepage Image">
                    <?php
                    } else {
                    ?>
                        <img src="<?php echo get_exist_image_url("seo-section", "seo-img"); ?>" srcset="<?php echo get_exist_image_url("seo-section", "seo-img"); ?> 1x, <?php echo get_exist_image_url("seo-section", "seo-img@2x"); ?> 2x, <?php echo get_exist_image_url("seo-section", "seo-img@3x"); ?> 3x" class="img-fluid float-lg-end ms-lg-5 pb-lg-0 pb-4" width="540" height="534" alt="Homepage Image">
                    <?php
                    }
                    ?>
                    <h1 class="text-lg-start text-center"><?php echo !empty($args["page_templates"]["history_page"]["seo_section"]["heading"]) ? $args["page_templates"]["history_page"]["seo_section"]["heading"] : ''; ?></h1>
                    <h2 class="pb-lg-4 text-lg-start text-center"><?php echo !empty($args["page_templates"]["history_page"]["seo_section"]["subheading"]) ? $args["page_templates"]["history_page"]["seo_section"]["subheading"] : ''; ?></h2>
                    <p class="seotext-sm-start"><?php echo !empty($args["page_templates"]["history_page"]["seo_section"]["before_read_more_content"]) ? $args["page_templates"]["history_page"]["seo_section"]["before_read_more_content"] : ''; ?></p>
                    <div class="collapse bg-transparent border-0" id="read_more">
                        <div class="bg-transparent border-0">
                            <p class="seotext-sm-start"><?php echo !empty($args["page_templates"]["history_page"]["seo_section"]["after_read_more_content"]) ? $args["page_templates"]["history_page"]["seo_section"]["after_read_more_content"] : ''; ?></p>
                        </div>
                    </div>
                    <?php
                    if (!empty($args["page_templates"]["history_page"]["seo_section"]["after_read_more_content"])) {
                        echo do_shortcode('[bc-read-more id="read_more" background-color="" data-close-icon="icon-minus1" data-open-icon="icon-plus1"]');
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
}elseif($template_id == 39478) {
    ?>

<div class="d-block">
    <div class="container-fluid pt-lg-4 py-lg-0 py-2 text-start">
        <div class="container pt-lg-3 py-2">
            <div class="row py-lg-2">
                <div class="col-lg-12 px-0 bc_homepage seosection-bc text-md-left seotext-sm-center">
                    <?php
                    $postId = isset($_GET['post']) ? $_GET['post'] : null;
                    if ($postId == 40758) {
                    ?>
                        <img src="<?php echo get_exist_image_url("about-page", "about-img"); ?>" srcset="<?php echo get_exist_image_url("about-page", "about-img"); ?> 1x, <?php echo get_exist_image_url("about-page", "about-img@2x"); ?> 2x, <?php echo get_exist_image_url("about-page", "about-img@3x"); ?> 3x" class="img-fluid float-lg-end ms-lg-5 pb-lg-0 pb-4" width="540" height="534" alt="Homepage Image">
                    <?php
                    } else {
                    ?>
                        <img src="<?php echo get_exist_image_url("seo-section", "seo-img"); ?>" srcset="<?php echo get_exist_image_url("seo-section", "seo-img"); ?> 1x, <?php echo get_exist_image_url("seo-section", "seo-img@2x"); ?> 2x, <?php echo get_exist_image_url("seo-section", "seo-img@3x"); ?> 3x" class="img-fluid float-lg-end ms-lg-5 pb-lg-0 pb-4" width="540" height="534" alt="Homepage Image">
                    <?php
                    }
                    ?>
                    <h1 class="text-lg-start text-center"><?php echo !empty($args["page_templates"]["homepage"]["seo_section"]["heading"]) ? $args["page_templates"]["homepage"]["seo_section"]["heading"] : ''; ?></h1>
                    <h2 class="pb-lg-4 text-lg-start text-center"><?php echo !empty($args["page_templates"]["homepage"]["seo_section"]["subheading"]) ? $args["page_templates"]["homepage"]["seo_section"]["subheading"] : ''; ?></h2>
                    <p class="seotext-sm-start"><?php echo !empty($args["page_templates"]["homepage"]["seo_section"]["before_read_more_content"]) ? $args["page_templates"]["homepage"]["seo_section"]["before_read_more_content"] : ''; ?></p>
                    <div class="collapse bg-transparent border-0" id="read_more">
                        <div class="bg-transparent border-0">
                            <p class="seotext-sm-start"><?php echo !empty($args["page_templates"]["homepage"]["seo_section"]["after_read_more_content"]) ? $args["page_templates"]["homepage"]["seo_section"]["after_read_more_content"] : ''; ?></p>
                        </div>
                    </div>
                    <?php
                    if (!empty($args["page_templates"]["homepage"]["seo_section"]["after_read_more_content"])) {
                        echo do_shortcode('[bc-read-more id="read_more" background-color="" data-close-icon="icon-minus1" data-open-icon="icon-plus1"]');
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
}elseif($template_id == 40758) {
    ?>

<div class="d-block">
    <div class="container-fluid pt-lg-4 py-lg-0 py-2 text-start">
        <div class="container pt-lg-3 py-2">
            <div class="row py-lg-2">
                <div class="col-lg-12 px-0 bc_homepage seosection-bc text-md-left seotext-sm-center">
                    <?php
                    if ($template_id == 40758) {
                    ?>
                        <img src="<?php echo get_exist_image_url("about-page", "about-img"); ?>" srcset="<?php echo get_exist_image_url("about-page", "about-img"); ?> 1x, <?php echo get_exist_image_url("about-page", "about-img@2x"); ?> 2x, <?php echo get_exist_image_url("about-page", "about-img@3x"); ?> 3x" class="img-fluid float-lg-end ms-lg-5 pb-lg-0 pb-4" width="540" height="534" alt="Homepage Image">
                    <?php
                    } else {
                    ?>
                        <img src="<?php echo get_exist_image_url("seo-section", "seo-img"); ?>" srcset="<?php echo get_exist_image_url("seo-section", "seo-img"); ?> 1x, <?php echo get_exist_image_url("seo-section", "seo-img@2x"); ?> 2x, <?php echo get_exist_image_url("seo-section", "seo-img@3x"); ?> 3x" class="img-fluid float-lg-end ms-lg-5 pb-lg-0 pb-4" width="540" height="534" alt="Homepage Image">
                    <?php
                    }
                    ?>
                    <h1 class="text-lg-start text-center"><?php echo !empty($args["page_templates"]["about_us_page"]["seo_section"]["heading"]) ? $args["page_templates"]["about_us_page"]["seo_section"]["heading"] : ''; ?></h1>
                    <h2 class="pb-lg-4 text-lg-start text-center"><?php echo !empty($args["page_templates"]["about_us_page"]["seo_section"]["subheading"]) ? $args["page_templates"]["about_us_page"]["seo_section"]["subheading"] : ''; ?> </h2>
                    <p class="seotext-sm-start"><?php echo !empty($args["page_templates"]["about_us_page"]["seo_section"]["before_read_more_content"]) ? $args["page_templates"]["about_us_page"]["seo_section"]["before_read_more_content"] : ''; ?></p>
                    <div class="collapse bg-transparent border-0" id="read_more">
                        <div class="bg-transparent border-0">
                            <p class="seotext-sm-start"><?php echo !empty($args["page_templates"]["about_us_page"]["seo_section"]["after_read_more_content"]) ? $args["page_templates"]["about_us_page"]["seo_section"]["after_read_more_content"] : ''; ?></p>
                        </div>
                    </div>
                    <?php
                    if (!empty($args["page_templates"]["about_us_page"]["seo_section"]["after_read_more_content"])) {
                        echo do_shortcode('[bc-read-more id="read_more" background-color="" data-close-icon="icon-minus1" data-open-icon="icon-plus1"]');
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
}elseif($template_id == 40930) {
    ?>

<div class="d-block">
    <div class="container-fluid pt-lg-4 py-lg-0 py-2 text-start">
        <div class="container pt-lg-3 py-2">
            <div class="row py-lg-2">
                <div class="col-lg-12 px-0 bc_homepage seosection-bc text-md-left seotext-sm-center">
                    <?php
                    $postId = isset($_GET['post']) ? $_GET['post'] : null;
                    if ($postId == 40758) {
                    ?>
                        <img src="<?php echo get_exist_image_url("about-page", "about-img"); ?>" srcset="<?php echo get_exist_image_url("about-page", "about-img"); ?> 1x, <?php echo get_exist_image_url("about-page", "about-img@2x"); ?> 2x, <?php echo get_exist_image_url("about-page", "about-img@3x"); ?> 3x" class="img-fluid float-lg-end ms-lg-5 pb-lg-0 pb-4" width="540" height="534" alt="Homepage Image">
                    <?php
                    } else {
                    ?>
                        <img src="<?php echo get_exist_image_url("seo-section", "seo-img"); ?>" srcset="<?php echo get_exist_image_url("seo-section", "seo-img"); ?> 1x, <?php echo get_exist_image_url("seo-section", "seo-img@2x"); ?> 2x, <?php echo get_exist_image_url("seo-section", "seo-img@3x"); ?> 3x" class="img-fluid float-lg-end ms-lg-5 pb-lg-0 pb-4" width="540" height="534" alt="Homepage Image">
                    <?php
                    }
                    ?>
                    <h1 class="text-lg-start text-center"><?php echo !empty($args["page_templates"]["landing_page"]["seo_section"]["heading"]) ? $args["page_templates"]["landing_page"]["seo_section"]["heading"] : ''; ?></h1>
                    <h2 class="pb-lg-4 text-lg-start text-center"><?php echo !empty($args["page_templates"]["landing_page"]["seo_section"]["subheading"]) ? $args["page_templates"]["landing_page"]["seo_section"]["subheading"] : ''; ?></h2>
                    <p class="seotext-sm-start"><?php echo !empty($args["page_templates"]["landing_page"]["seo_section"]["before_read_more_content"]) ? $args["page_templates"]["landing_page"]["seo_section"]["before_read_more_content"] : ''; ?></p>
                    <div class="collapse bg-transparent border-0" id="read_more">
                        <div class="bg-transparent border-0">
                            <p class="seotext-sm-start"><?php echo !empty($args["page_templates"]["landing_page"]["seo_section"]["after_read_more_content"]) ? $args["page_templates"]["landing_page"]["seo_section"]["after_read_more_content"] : ''; ?></p>
                        </div>
                    </div>
                    <?php
                    if (!empty($args["page_templates"]["landing_page"]["seo_section"]["after_read_more_content"])) {
                        echo do_shortcode('[bc-read-more id="read_more" background-color="" data-close-icon="icon-minus1" data-open-icon="icon-plus1"]');
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
}elseif($template_id == 60786) {
    ?>

<div class="d-block">
    <div class="container-fluid pt-lg-4 py-lg-0 py-2 text-start">
        <div class="container pt-lg-3 py-2">
            <div class="row py-lg-2">
                <div class="col-lg-12 px-0 bc_homepage seosection-bc text-md-left seotext-sm-center">
                    <?php
                    $postId = isset($_GET['post']) ? $_GET['post'] : null;
                    if ($postId == 40758) {
                    ?>
                        <img src="<?php echo get_exist_image_url("about-page", "about-img"); ?>" srcset="<?php echo get_exist_image_url("about-page", "about-img"); ?> 1x, <?php echo get_exist_image_url("about-page", "about-img@2x"); ?> 2x, <?php echo get_exist_image_url("about-page", "about-img@3x"); ?> 3x" class="img-fluid float-lg-end ms-lg-5 pb-lg-0 pb-4" width="540" height="534" alt="Homepage Image">
                    <?php
                    } 
                     else {
                    ?>
                        <img src="<?php echo get_exist_image_url("seo-section", "seo-img"); ?>" srcset="<?php echo get_exist_image_url("seo-section", "seo-img"); ?> 1x, <?php echo get_exist_image_url("seo-section", "seo-img@2x"); ?> 2x, <?php echo get_exist_image_url("seo-section", "seo-img@3x"); ?> 3x" class="img-fluid float-lg-end ms-lg-5 pb-lg-0 pb-4" width="540" height="534" alt="Homepage Image">

                    <?php
                    }
                    ?>
                    <h1 class="text-lg-start text-center"><?php echo !empty($args["page_templates"]["landing_page"]["seo_section"]["heading"]) ? $args["page_templates"]["landing_page"]["seo_section"]["heading"] : ''; ?></h1>
                    <h2 class="pb-lg-4 text-lg-start text-center"><?php echo !empty($args["page_templates"]["landing_page"]["seo_section"]["subheading"]) ? $args["page_templates"]["landing_page"]["seo_section"]["subheading"] : ''; ?></h2>
                    <p class="seotext-sm-start"><?php echo !empty($args["page_templates"]["landing_page"]["seo_section"]["before_read_more_content"]) ? $args["page_templates"]["landing_page"]["seo_section"]["before_read_more_content"] : ''; ?></p>
                    <div class="collapse bg-transparent border-0" id="read_more">
                        <div class=" bg-transparent border-0">
                            <p class="seotext-sm-start"><?php echo !empty($args["page_templates"]["landing_page"]["seo_section"]["after_read_more_content"]) ? $args["page_templates"]["landing_page"]["seo_section"]["after_read_more_content"] : ''; ?></p>
                        </div>
                    </div>
                    <?php
                    if (!empty($args["page_templates"]["landing_page"]["seo_section"]["after_read_more_content"])) {
                        echo do_shortcode('[bc-read-more id="read_more" background-color="" data-close-icon="icon-minus1" data-open-icon="icon-plus1"]');
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
        } else {
            ?>

<div class="d-block">
    <div class="container-fluid pt-lg-4 py-lg-0 py-2 text-start">
        <div class="container pt-lg-3 py-2">
            <div class="row py-lg-2">
                <div class="col-lg-12 px-0 bc_homepage seosection-bc text-md-left seotext-sm-center">
                    <?php
                    $postId = isset($_GET['post']) ? $_GET['post'] : null;
                    if ($postId == 40758) {
                    ?>
                        <img src="<?php echo get_exist_image_url("about-page", "about-img"); ?>" srcset="<?php echo get_exist_image_url("about-page", "about-img"); ?> 1x, <?php echo get_exist_image_url("about-page", "about-img@2x"); ?> 2x, <?php echo get_exist_image_url("about-page", "about-img@3x"); ?> 3x" class="img-fluid float-lg-end ms-lg-5 pb-lg-0 pb-4" width="540" height="534" alt="Homepage Image">
                    <?php
                    } else {
                    ?>
                        <img src="<?php echo get_exist_image_url("seo-section", "seo-img"); ?>" srcset="<?php echo get_exist_image_url("seo-section", "seo-img"); ?> 1x, <?php echo get_exist_image_url("seo-section", "seo-img@2x"); ?> 2x, <?php echo get_exist_image_url("seo-section", "seo-img@3x"); ?> 3x" class="img-fluid float-lg-end ms-lg-5 pb-lg-0 pb-4" width="540" height="534" alt="Homepage Image">
                    <?php
                    }
                    ?>
                    <h1 class="text-lg-start text-center"><?php echo !empty($args["page_templates"]["homepage"]["seo_section"]["heading"]) ? $args["page_templates"]["homepage"]["seo_section"]["heading"] : ''; ?></h1>
                    <h2 class="pb-lg-4 text-lg-start text-center"><?php echo !empty($args["page_templates"]["homepage"]["seo_section"]["subheading"]) ? $args["page_templates"]["homepage"]["seo_section"]["subheading"] : ''; ?></h2>
                    <p class="seotext-sm-start"><?php echo !empty($args["page_templates"]["homepage"]["seo_section"]["before_read_more_content"]) ? $args["page_templates"]["homepage"]["seo_section"]["before_read_more_content"] : ''; ?></p>
                    <div class="collapse bg-transparent border-0" id="read_more">
                        <div class="bg-transparent border-0">
                            <p class="seotext-sm-start"><?php echo !empty($args["page_templates"]["homepage"]["seo_section"]["after_read_more_content"]) ? $args["page_templates"]["homepage"]["seo_section"]["after_read_more_content"] : ''; ?></p>
                        </div>
                    </div>
                    <?php
                    if (!empty($args["page_templates"]["homepage"]["seo_section"]["after_read_more_content"])) {
                        echo do_shortcode('[bc-read-more id="read_more" background-color="" data-close-icon="icon-minus1" data-open-icon="icon-plus1"]');
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
        }
        ?>