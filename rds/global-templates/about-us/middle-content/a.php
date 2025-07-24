<?php
global $rdsTemplateDataGlobal;
$args = $rdsTemplateDataGlobal;
?>
<div class="d-block order-14 order-lg-14">
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 about_content pb-lg-4">
                    <?php 
                    $middle_content = !empty($args["page_templates"]["about_us_page"]["middle_content"]) ? $args["page_templates"]["about_us_page"]["middle_content"] : '';
                    echo wp_kses_post($middle_content); 
                    ?>
                </div>
            </div>
        </div> 
    </div>
</div>
