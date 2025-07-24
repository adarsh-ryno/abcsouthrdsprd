<div class="sidbar-financing color_tertiary_bg text-center py-lg-4 py-3 order-lg-3 order-3 mx-lg-0 mx-3 px-lg-0 px-2">
    <div class="py-3">
        <div class="pb-3">
            <i class="icon-circle-dollar1 true_white text_88 line_height_88"></i>
        </div>
        <?php if (!empty($args["page_templates"]["subpage"]["sidebar"]["financing"]["heading"])): ?>
            <h4 class="h4-alt pt-2 text_36 line_height_41 pb-lg-2 pb-3 mb-0">
                <?php echo $args["page_templates"]["subpage"]["sidebar"]["financing"]["heading"]; ?>
            </h4>
        <?php endif; ?>

        <?php if (!empty($args["page_templates"]["subpage"]["sidebar"]["financing"]["subheading"])): ?>
            <span class="p-alt text_22 font_default sm_font_alt_1 text_normal line_height_25_3 pb-lg-5 pb-4 d-block">
                <?php echo $args["page_templates"]["subpage"]["sidebar"]["financing"]["subheading"]; ?>
            </span>
        <?php endif; ?>

        <?php if (!empty($args["page_templates"]["subpage"]["sidebar"]["financing"]["button_link"]) && !empty($args["page_templates"]["subpage"]["sidebar"]["financing"]["button_text"])): ?>
            <a href="<?php echo get_home_url() . $args["page_templates"]["subpage"]["sidebar"]["financing"]["button_link"]; ?>" class="btn btn-primary mw-177">
                <?php echo $args["page_templates"]["subpage"]["sidebar"]["financing"]["button_text"]; ?>
            </a>
        <?php endif; ?>
    </div>
</div>
