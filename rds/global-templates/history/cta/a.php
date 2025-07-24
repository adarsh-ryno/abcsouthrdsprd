<?php
// $phoneNumber = $args['site_info']['phone'];
// $just_numbers = preg_replace('/\D/', '', $phoneNumber);
// $formatedPhone = preg_replace('/^(\d{3})(\d{3})(\d{4})$/', '($1) $2-$3', $just_numbers);
// $formatedPhone = '('.substr($phoneNumber, 0, 3).') ' . substr($phoneNumber, 3, 3). '-'.substr($phoneNumber, 6);
// $phoneNum = $args['site_info']['phone'];
// $phoneNumber = preg_replace('/\D/', '', $phoneNum);
// $formatedPhone = substr($phoneNumber, 0, 6) . '-' . substr($phoneNumber, 6);
?>
 <div class="container-fluid px-lg-3 px-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <span class="d-block no_hover_underline mb-4">
                    <div class="got-an-emergency py-sm-2 py-3 px-sm-4 px-4 text-start rounded-10" style="background-size:cover; background-position:center; background-repeat: no-repeat;">
                        <div class="row align-items-center py-lg-4 px-lg-0 px-3 pb-4 pt-2">
                            <div class="col-sm-12 col-lg-7 align-items-center py-lg-4 border-right-lg-2 pb-4 border-bottom-md-2 px-0 px-lg-3 mb-lg-0 mb-4 pe-lg-0">
                                <?php if (!empty($args["page_templates"]["history_page"]["in_content_cta"]["heading"])) { ?>
                                    <span class="d-inline-block mb-0 no_hover_underline text_36 line_height_41 font_default text_bold ps-lg-3 sm_text_24 sm_line_height_29 true_white">
                                        <?php echo $args["page_templates"]["history_page"]["in_content_cta"]["heading"]; ?>
                                    </span>
                                <?php } ?>
                                <?php if (!empty($args["site_info"]["country_code"]) && !empty($args["site_info"]["phone"])) { ?>
                                    <a class="no_hover_underline d-inline-block" href="tel:<?php echo $args["site_info"]["country_code"] . $args["site_info"]["phone"]; ?>">
                                        <span class="d-block mb-0 no_hover_underline text_36 line_height_41 sm_text_36 sm_line_height_45 font_default ps-lg-3 pb-0 true_white">
                                            <?php echo $args["site_info"]["country_code"] . $args["site_info"]["phone"]; ?>
                                        </span>
                                    </a>
                                <?php } ?>
                            </div>
                            <div class="col-sm-12 col-lg-5 text-lg-end pl-0 py-lg-3 px-lg-3 px-0">
                                <?php if (!empty($args["page_templates"]["history_page"]["in_content_cta"]["button_text"]) && !empty($args["page_templates"]["history_page"]["in_content_cta"]["button_link"])) { ?>
                                    <a class="no_hover_underline a-alt" href="<?php echo get_home_url() . $args["page_templates"]["history_page"]["in_content_cta"]["button_link"]; ?>">
                                        <div class="text_30 line_height_38 font_alt_2 d-flex align-items-center justify-content-lg-end text_semibold no_hover_underline pe-lg-4 sm_text_24 sm_line_height_29 text-uppercase">
                                            <?php echo $args["page_templates"]["history_page"]["in_content_cta"]["button_text"]; ?>
                                            <i class="icon-circle-arrow-right1 text_18 ms-lg-4 ms-2 line_height_18"></i>
                                        </div>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </span>
            </div>
        </div>
    </div>
</div>
