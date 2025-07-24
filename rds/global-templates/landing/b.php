<div class="row py-lg-2">
    <div class="col-lg-12 px-0">
        <?php if (!empty($args["page_templates"]["landing_page"]["seo_section"]["heading"]) || !empty($args["page_templates"]["landing_page"]["seo_section"]["subheading"]) || !empty($args["page_templates"]["landing_page"]["seo_section"]["before_read_more_content"]) || !empty($args["page_templates"]["landing_page"]["seo_section"]["after_read_more_content"])): ?>
            <?php if (!empty($args["page_templates"]["landing_page"]["seo_section"]["heading"])): ?>
                <h1 class=""><?php echo $args["page_templates"]["landing_page"]["seo_section"]["heading"]; ?></h1>
            <?php endif; ?>

            <?php if (!empty($args["page_templates"]["landing_page"]["seo_section"]["subheading"])): ?>
                <h2 class="pb-lg-5"><?php echo $args["page_templates"]["landing_page"]["seo_section"]["subheading"]; ?></h2>
            <?php endif; ?>

            <?php if (!empty($args["page_templates"]["landing_page"]["seo_section"]["before_read_more_content"])): ?>
                <p><?php echo $args["page_templates"]["landing_page"]["seo_section"]["before_read_more_content"]; ?></p>
            <?php endif; ?>

            <div class="collapse bg-transparent border-0" id="collapseExample2">
                <div class="bg-transparent border-0">
                    <?php if (!empty($args["page_templates"]["landing_page"]["seo_section"]["after_read_more_content"])): ?>
                        <p><?php echo $args["page_templates"]["landing_page"]["seo_section"]["after_read_more_content"]; ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <?php if (!empty($args["page_templates"]["landing_page"]["seo_section"]["after_read_more_content"])): ?>
                <?php echo do_shortcode('[bc-read-more id="collapseExample2" background-color="" data-close-icon="icon-minus1" data-open-icon="icon-plus1"]'); ?>
            <?php endif; ?>
        <?php endif; ?>

        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/seo-section/seo-img.webp" srcset="<?php echo get_stylesheet_directory_uri(); ?>/img/seo-section/seo-img.webp 1x, <?php echo get_stylesheet_directory_uri(); ?>/img/seo-section/seo-img@2x.webp 2x, <?php echo get_stylesheet_directory_uri(); ?>/img/seo-section/seo-img@3x.webp 3x" class="img-fluid float-lg-end ms-lg-5 pb-lg-0 pb-4" width="540" height="534" alt="Homepage Image">
    </div>
</div>
