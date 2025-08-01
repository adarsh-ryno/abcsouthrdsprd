<div class="row py-lg-2">
    <div class="col-lg-4">
        <?php if (!empty($args["page_templates"]["about_us_page"]["seo_section"]["heading"])): ?>
            <h1><?php echo esc_html($args["page_templates"]["about_us_page"]["seo_section"]["heading"]); ?></h1>
        <?php endif; ?>

        <?php if (!empty($args["page_templates"]["about_us_page"]["seo_section"]["subheading"])): ?>
            <h2 class="pb-lg-5"><?php echo esc_html($args["page_templates"]["about_us_page"]["seo_section"]["subheading"]); ?></h2>
        <?php endif; ?>
    </div>
    
    <div class="col-lg-8">
        <?php if (!empty($args["page_templates"]["about_us_page"]["seo_section"]["before_read_more_content"])): ?>
            <p><?php echo esc_html($args["page_templates"]["about_us_page"]["seo_section"]["before_read_more_content"]); ?></p>
        <?php endif; ?>
        
        <div class="collapse bg-transparent border-0" id="read_more">
            <div class="bg-transparent border-0">
                <?php if (!empty($args["page_templates"]["about_us_page"]["seo_section"]["after_read_more_content"])): ?>
                    <p><?php echo esc_html($args["page_templates"]["about_us_page"]["seo_section"]["after_read_more_content"]); ?></p>
                <?php endif; ?>
            </div>
        </div>
        
        <?php if (!empty($args["page_templates"]["about_us_page"]["seo_section"]["after_read_more_content"])): ?>
            <?php echo do_shortcode('[bc-read-more id="read_more" background-color="" data-close-icon="icon-minus1" data-open-icon="icon-plus1"]'); ?>
        <?php endif; ?>
    </div>
</div>
