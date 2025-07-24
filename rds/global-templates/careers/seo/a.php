<div class="container-fluid pb-5">
    <div class="container career_faq">
        <div class="row">
            <div class="col-lg-12">
                <?php if (!empty($args["page_templates"]["career_page"]["faq"]["heading"])): ?>
                    <h4 class="pb-3"><?php echo $args["page_templates"]["career_page"]["faq"]["heading"]; ?></h4>
                <?php endif; ?>

                <?php
                $faqData = !empty($args["page_templates"]["career_page"]["faq"]["data"]) ? $args["page_templates"]["career_page"]["faq"]["data"] : [];
                $accordion = "";
                foreach ($faqData as $value) {
                    if (!empty($value["question"]) && !empty($value["content"])) {
                        $accordion .= '[bc_card title="' . $value["question"] . '"] ' . $value["content"] . " [/bc_card]";
                    }
                }
                ?>

                <?php echo !empty($accordion) ? do_shortcode("[bc_accordion]" . $accordion . "[/bc_accordion]") : ''; ?>
            </div>
        </div>
    </div>
</div>
