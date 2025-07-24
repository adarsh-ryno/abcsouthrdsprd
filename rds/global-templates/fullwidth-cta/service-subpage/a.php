<?php
$heading_tag = !empty($args["page_templates"]["service_subpage"]["financing"]["heading_tag"])
    ? $args["page_templates"]["service_subpage"]["financing"]["heading_tag"]
    : "h6";
$subheading_tag = !empty($args["page_templates"]["service_subpage"]["financing"]["subheading_tag"])
    ? $args["page_templates"]["service_subpage"]["financing"]["subheading_tag"]
    : "h4";
?>
<div class="d-block order-lg-2 order-2">
    <div class="container-fluid text-center px-lg-3 px-0 py-5 py-lg-5 text-center">
        <div class="container py-lg-3 py-2">
            <div class="row align-items-center">
                <div class="col-lg-10 mx-auto">
                    <div class="row align-items-center">
                        <div class="col-sm-12 col-lg-2 text-lg-start">
                            <i class="true_white icon-shield-halved2 text_96 line_height_96"></i>
                        </div>
                        <div class="col-sm-12 col-lg-7 text-center py-lg-0 py-4">
                            <?php if (!empty($args["page_templates"]["service_subpage"]["financing"]["heading"])): ?>
                                <<?php echo $heading_tag ?> class="<?php echo $heading_tag ?>-alt">
                                    <?php echo $args["page_templates"]["service_subpage"]["financing"]["heading"]; ?>
                                </<?php echo $heading_tag ?>>
                            <?php endif; ?>
                            <?php if (!empty($args["page_templates"]["service_subpage"]["financing"]["subheading"])): ?>
                                <<?php echo $subheading_tag ?> class="<?php echo $subheading_tag ?>-alt mt-2 pt-lg-0 pt-4 mb-0 d-block">
                                    <?php echo $args["page_templates"]["service_subpage"]["financing"]["subheading"]; ?>
                                </<?php echo $subheading_tag ?>>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-12 col-lg-3 text-center text-lg-end">
                            <?php if (!empty($args["page_templates"]["service_subpage"]["financing"]["button_text"])): ?>
                                <a href="<?php echo !empty($args["page_templates"]["service_subpage"]["financing"]["button_link"]) ? get_home_url() . $args["page_templates"]["service_subpage"]["financing"]["button_link"] : '#'; ?>" class="no_hover_underline btn btn-secondary mw-165">
                                    <?php echo $args["page_templates"]["service_subpage"]["financing"]["button_text"]; ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
