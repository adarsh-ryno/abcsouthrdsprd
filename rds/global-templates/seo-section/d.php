<?php
global $rdsTemplateDataGlobal;
$args = $rdsTemplateDataGlobal;
$template_id = get_current_elementor_template_id();
//echo $template_id;
if ($template_id == 41084) {
?>
<div class="d-block">
    <div class="container-fluid pt-3 text-start pt-lg-5 mt-0">
        <div class="container py-lg-0 py-2 px-lg-3 px-0">
            <div class="row py-lg-0">
                <div class="col-lg-4 bc_homepage">
                    <h1 class="text-lg-start text-center">
                        <?php echo !empty($args["page_templates"]["history_page"]["seo_section"]["heading"]) ? $args["page_templates"]["history_page"]["seo_section"]["heading"] : ''; ?>
                    </h1>
                    <h2 class="pb-lg-3 text-lg-start text-center">
                        <?php echo !empty($args["page_templates"]["history_page"]["seo_section"]["subheading"]) ? $args["page_templates"]["history_page"]["seo_section"]["subheading"] : ''; ?>
                    </h2>
                </div>
                <div class="col-lg-8 bc_homepage">
                    <p>
                        <?php echo !empty($args["page_templates"]["history_page"]["seo_section"]["before_read_more_content"]) ? $args["page_templates"]["history_page"]["seo_section"]["before_read_more_content"] : ''; ?>
                    </p>
                    <div class="collapse bg-transparent border-0" id="read_more">
                        <div class="bg-transparent border-0">
                            <p>
                                <?php echo !empty($args["page_templates"]["history_page"]["seo_section"]["after_read_more_content"]) ? $args["page_templates"]["history_page"]["seo_section"]["after_read_more_content"] : ''; ?>
                            </p>
                        </div>
                    </div>
                    <?php if (!empty($args["page_templates"]["history_page"]["seo_section"]["after_read_more_content"])) {
                        echo do_shortcode('[bc-read-more id="read_more" background-color="" data-close-icon="icon-minus1" data-open-icon="icon-plus1"]');
                    } ?>          
                </div>
            </div>
        </div>
    </div>
</div>

<?php
}elseif ($template_id == 39478) {
    ?>
    <div class="d-block">
    <div class="container-fluid pt-3 text-start pt-lg-5 mt-0">
        <div class="container py-lg-0 py-2 px-lg-3 px-0">
            <div class="row py-lg-0">
                <div class="col-lg-4 bc_homepage">
                    <h1 class="text-lg-start text-center">
                        <?php echo !empty($args["page_templates"]["homepage"]["seo_section"]["heading"]) ? $args["page_templates"]["homepage"]["seo_section"]["heading"] : ''; ?>
                    </h1>
                    <h2 class="pb-lg-3 text-lg-start text-center">
                        <?php echo !empty($args["page_templates"]["homepage"]["seo_section"]["subheading"]) ? $args["page_templates"]["homepage"]["seo_section"]["subheading"] : ''; ?>
                    </h2>
                </div>
                <div class="col-lg-8 bc_homepage">
                    <p>
                        <?php echo !empty($args["page_templates"]["homepage"]["seo_section"]["before_read_more_content"]) ? $args["page_templates"]["homepage"]["seo_section"]["before_read_more_content"] : ''; ?>
                    </p>
                    <div class="collapse bg-transparent border-0" id="read_more">
                        <div class="bg-transparent border-0">
                            <p>
                                <?php echo !empty($args["page_templates"]["homepage"]["seo_section"]["after_read_more_content"]) ? $args["page_templates"]["homepage"]["seo_section"]["after_read_more_content"] : ''; ?>
                            </p>
                        </div>
                    </div>
                    <?php if (!empty($args["page_templates"]["homepage"]["seo_section"]["after_read_more_content"])) {
                        echo do_shortcode('[bc-read-more id="read_more" background-color="" data-close-icon="icon-minus1" data-open-icon="icon-plus1"]');
                    } ?>          
                </div>
            </div>
        </div>
    </div>
</div>

    <?php
    }elseif ($template_id == 40758) {
    ?>
    <div class="d-block">
    <div class="container-fluid pt-3 text-start pt-lg-5 mt-0">
        <div class="container py-lg-0 py-2 px-lg-3 px-0">
            <div class="row py-lg-0">
                <div class="col-lg-4 bc_homepage">
                    <h1 class="text-lg-start text-center">
                        <?php echo !empty($args["page_templates"]["about_us_page"]["seo_section"]["heading"]) ? $args["page_templates"]["about_us_page"]["seo_section"]["heading"] : ''; ?>
                    </h1>
                    <h2 class="pb-lg-3 text-lg-start text-center">
                        <?php echo !empty($args["page_templates"]["about_us_page"]["seo_section"]["subheading"]) ? $args["page_templates"]["about_us_page"]["seo_section"]["subheading"] : ''; ?>
                    </h2>
                </div>
                <div class="col-lg-8 bc_homepage">
                    <p>
                        <?php echo !empty($args["page_templates"]["about_us_page"]["seo_section"]["before_read_more_content"]) ? $args["page_templates"]["about_us_page"]["seo_section"]["before_read_more_content"] : ''; ?>
                    </p>
                    <div class="collapse bg-transparent border-0" id="read_more">
                        <div class="bg-transparent border-0">
                            <p>
                                <?php echo !empty($args["page_templates"]["about_us_page"]["seo_section"]["after_read_more_content"]) ? $args["page_templates"]["about_us_page"]["seo_section"]["after_read_more_content"] : ''; ?>
                            </p>
                        </div>
                    </div>
                    <?php if (!empty($args["page_templates"]["about_us_page"]["seo_section"]["after_read_more_content"])) {
                        echo do_shortcode('[bc-read-more id="read_more" background-color="" data-close-icon="icon-minus1" data-open-icon="icon-plus1"]');
                    } ?>          
                </div>
            </div>
        </div>
    </div>
</div>

    <?php
    }elseif($template_id == 40930) {
    ?>
   <div class="d-block">
    <div class="container-fluid pt-3 text-start pt-lg-5 mt-0">
        <div class="container py-lg-0 py-2 px-lg-3 px-0">
            <div class="row py-lg-0">
                <div class="col-lg-4 bc_homepage">
                    <h1 class="text-lg-start text-center">
                        <?php echo !empty($args["page_templates"]["landing_page"]["seo_section"]["heading"]) ? $args["page_templates"]["landing_page"]["seo_section"]["heading"] : ''; ?>
                    </h1>
                    <h2 class="pb-lg-3 text-lg-start text-center">
                        <?php echo !empty($args["page_templates"]["landing_page"]["seo_section"]["subheading"]) ? $args["page_templates"]["landing_page"]["seo_section"]["subheading"] : ''; ?>
                    </h2>
                </div>
                <div class="col-lg-8 bc_homepage">
                    <p>
                        <?php echo !empty($args["page_templates"]["landing_page"]["seo_section"]["before_read_more_content"]) ? $args["page_templates"]["landing_page"]["seo_section"]["before_read_more_content"] : ''; ?>
                    </p>
                    <div class="collapse bg-transparent border-0" id="read_more">
                        <div class="bg-transparent border-0">
                            <p>
                                <?php echo !empty($args["page_templates"]["landing_page"]["seo_section"]["after_read_more_content"]) ? $args["page_templates"]["landing_page"]["seo_section"]["after_read_more_content"] : ''; ?>
                            </p>
                        </div>
                    </div>
                    <?php if (!empty($args["page_templates"]["landing_page"]["seo_section"]["after_read_more_content"])) {
                        echo do_shortcode('[bc-read-more id="read_more" background-color="" data-close-icon="icon-minus1" data-open-icon="icon-plus1"]');
                    } ?>          
                </div>
            </div>
        </div>
    </div>
</div>

    <?php
    }elseif($template_id == 60786) {
        ?>
       <div class="d-block">
    <div class="container-fluid pt-3 text-start pt-lg-5 mt-0">
        <div class="container py-lg-0 py-2 px-lg-3 px-0">
            <div class="row py-lg-0">
                <div class="col-lg-4 bc_homepage">
                    <h1 class="text-lg-start text-center">
                        <?php echo !empty($args["page_templates"]["landing_page"]["seo_section"]["heading"]) ? $args["page_templates"]["landing_page"]["seo_section"]["heading"] : ''; ?>
                    </h1>
                    <h2 class="pb-lg-3 text-lg-start text-center">
                        <?php echo !empty($args["page_templates"]["landing_page"]["seo_section"]["subheading"]) ? $args["page_templates"]["landing_page"]["seo_section"]["subheading"] : ''; ?>
                    </h2>
                </div>
                <div class="col-lg-8 bc_homepage">
                    <p>
                        <?php echo !empty($args["page_templates"]["landing_page"]["seo_section"]["before_read_more_content"]) ? $args["page_templates"]["landing_page"]["seo_section"]["before_read_more_content"] : ''; ?>
                    </p>
                    <div class="collapse bg-transparent border-0" id="read_more">
                        <div class="bg-transparent border-0">
                            <p>
                                <?php echo !empty($args["page_templates"]["landing_page"]["seo_section"]["after_read_more_content"]) ? $args["page_templates"]["landing_page"]["seo_section"]["after_read_more_content"] : ''; ?>
                            </p>
                        </div>
                    </div>
                    <?php if (!empty($args["page_templates"]["landing_page"]["seo_section"]["after_read_more_content"])) {
                        echo do_shortcode('[bc-read-more id="read_more" background-color="" data-close-icon="icon-minus1" data-open-icon="icon-plus1"]');
                    } ?>          
                </div>
            </div>
        </div>
    </div>
</div>

    <?php
        } else {
            ?>
    <div class="d-block">
    <div class="container-fluid pt-3 text-start pt-lg-5 mt-0">
        <div class="container py-lg-0 py-2 px-lg-3 px-0">
            <div class="row py-lg-0">
                <div class="col-lg-4 bc_homepage">
                    <h1 class="text-lg-start text-center">
                        <?php echo !empty($args["page_templates"]["homepage"]["seo_section"]["heading"]) ? $args["page_templates"]["homepage"]["seo_section"]["heading"] : ''; ?>
                    </h1>
                    <h2 class="pb-lg-3 text-lg-start text-center">
                        <?php echo !empty($args["page_templates"]["homepage"]["seo_section"]["subheading"]) ? $args["page_templates"]["homepage"]["seo_section"]["subheading"] : ''; ?>
                    </h2>
                </div>
                <div class="col-lg-8 bc_homepage">
                    <p>
                        <?php echo !empty($args["page_templates"]["homepage"]["seo_section"]["before_read_more_content"]) ? $args["page_templates"]["homepage"]["seo_section"]["before_read_more_content"] : ''; ?>
                    </p>
                    <div class="collapse bg-transparent border-0" id="read_more">
                        <div class="bg-transparent border-0">
                            <p>
                                <?php echo !empty($args["page_templates"]["homepage"]["seo_section"]["after_read_more_content"]) ? $args["page_templates"]["homepage"]["seo_section"]["after_read_more_content"] : ''; ?>
                            </p>
                        </div>
                    </div>
                    <?php if (!empty($args["page_templates"]["homepage"]["seo_section"]["after_read_more_content"])) {
                        echo do_shortcode('[bc-read-more id="read_more" background-color="" data-close-icon="icon-minus1" data-open-icon="icon-plus1"]');
                    } ?>          
                </div>
            </div>
        </div>
    </div>
</div>

    <?php
        } 
        ?>
