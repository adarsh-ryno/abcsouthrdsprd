<!-- Career content start -->
<div class="container-fluid mb-lg-5">
    <div class="container">
        <div class="row">
     
                <div class="col-lg-4">
                    <?php if (!empty($args["page_templates"]["career_page"]["heading"])): ?>
                        <h1 class="pb-lg-2"><?php echo esc_html($args["page_templates"]["career_page"]["heading"]); ?></h1>
                    <?php endif; ?>
                    <?php if (!empty($args["page_templates"]["career_page"]["subheading"])): ?>
                        <h2><?php echo esc_html($args["page_templates"]["career_page"]["subheading"]); ?></h2>
                    <?php endif; ?>
                </div>
                <div class="col-lg-8">
                    <?php if (!empty($args["page_templates"]["career_page"]["content"])): ?>
                        <p class="pe-lg-2">
                            <?php echo wp_kses_post($args["page_templates"]["career_page"]["content"]); ?>
                        </p>
                    <?php endif; ?>
                </div>
        </div>
    </div>
</div>
<!-- Career content end -->
