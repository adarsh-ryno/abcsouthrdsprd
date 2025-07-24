<?php
$template_id = get_current_elementor_template_id();

if ($template_id == 60786) {
    ?>
    <div class="d-block">
        <div class="container-fluid pt-5 pt-lg-2 text-center">
            <div class="container pt-lg-2 py-2">
                <div class="row align-items-center py-lg-2">
                    <div class="col-lg-12 px-0 bc_homepage text-center">
                        <?php if (!empty($args["page_templates"]["landing_page"]["landing_seo_section"]["heading"])): ?>
                            <h1><?php echo $args["page_templates"]["landing_page"]["landing_seo_section"]["heading"]; ?></h1>
                        <?php endif; ?>

                        <?php if (!empty($args["page_templates"]["landing_page"]["landing_seo_section"]["subheading"])): ?>
                            <h2 class="pb-lg-5"><?php echo $args["page_templates"]["landing_page"]["landing_seo_section"]["subheading"]; ?></h2>
                        <?php endif; ?>

                        <?php if (!empty($args["page_templates"]["landing_page"]["landing_seo_section"]["before_read_more_content"])): ?>
                            <p><?php echo $args["page_templates"]["landing_page"]["landing_seo_section"]["before_read_more_content"]; ?></p>
                        <?php endif; ?>

                        <div class="collapse bg-transparent border-0" id="read_more">
                            <div class="card card-body bg-transparent border-0">
                                <?php if (!empty($args["page_templates"]["landing_page"]["landing_seo_section"]["after_read_more_content"])): ?>
                                    <p><?php echo $args["page_templates"]["landing_page"]["landing_seo_section"]["after_read_more_content"]; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php if (!empty($args["page_templates"]["landing_page"]["landing_seo_section"]["after_read_more_content"])): ?>
                            <?php echo do_shortcode('[bc-read-more id="read_more" background-color="" data-close-icon="icon-minus1" data-open-icon="icon-plus1"]'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    ?>
    <div class="d-block">
        <div class="container-fluid pt-5 pt-lg-2 text-center">
            <div class="container pt-lg-2 py-2">
                <div class="row align-items-center py-lg-2">
                    <div class="col-lg-12 px-0 bc_homepage text-center">
                        <?php if (!empty($args["page_templates"]["landing_page"]["landing_seo_section"]["heading"])): ?>
                            <h1><?php echo $args["page_templates"]["landing_page"]["landing_seo_section"]["heading"]; ?></h1>
                        <?php endif; ?>

                        <?php if (!empty($args["page_templates"]["landing_page"]["landing_seo_section2"]["subheading"])): ?>
                            <h2 class="pb-lg-5"><?php echo $args["page_templates"]["landing_page"]["landing_seo_section2"]["subheading"]; ?></h2>
                        <?php endif; ?>

                        <?php if (!empty($args["page_templates"]["landing_page"]["landing_seo_section"]["before_read_more_content"])): ?>
                            <p><?php echo $args["page_templates"]["landing_page"]["landing_seo_section"]["before_read_more_content"]; ?></p>
                        <?php endif; ?>

                        <div class="collapse bg-transparent border-0" id="read_more">
                            <div class="card card-body bg-transparent border-0">
                                <?php if (!empty($args["page_templates"]["landing_page"]["landing_seo_section"]["after_read_more_content"])): ?>
                                    <p><?php echo $args["page_templates"]["landing_page"]["landing_seo_section"]["after_read_more_content"]; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php if (!empty($args["page_templates"]["landing_page"]["landing_seo_section"]["after_read_more_content"])): ?>
                            <?php echo do_shortcode('[bc-read-more id="read_more" background-color="" data-close-icon="icon-minus1" data-open-icon="icon-plus1"]'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
