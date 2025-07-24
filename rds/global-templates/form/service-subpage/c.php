<div class="sidebar">
    <div class="shadow-lg d-lg-block d-none pt-lg-3 pb-lg-4 mt-lg-2 border_form bg_form order-lg-1 order-1">
        <?php if (!empty($args["page_templates"]["service_subpage"]["sidebar"]["request_service"]["heading"])): ?>
            <span class="d-block pt-lg-1 text-center font_default text_normal text_26 line_height_31">
                <?php echo $args["page_templates"]["service_subpage"]["sidebar"]["request_service"]["heading"]; ?>
            </span>
        <?php endif; ?>
        <?php if (!empty($args["page_templates"]["service_subpage"]["sidebar"]["request_service"]["subheading"])): ?>
            <span class="d-block pb-lg-4 text-center font_default text_bold text_26 line_height_31">
                <?php echo $args["page_templates"]["service_subpage"]["sidebar"]["request_service"]["subheading"]; ?>
            </span>
        <?php endif; ?>
        <?php
        $form_id = !empty($args["page_templates"]["service_subpage"]["sidebar"]["request_service"]["gravity_form_id"]) ? $args["page_templates"]["service_subpage"]["sidebar"]["request_service"]["gravity_form_id"] : '';
        if ($form_id) {
            echo do_shortcode("[gravityforms id=" . $form_id . " ajax=true]");
        }
        ?>
    </div>
</div>
