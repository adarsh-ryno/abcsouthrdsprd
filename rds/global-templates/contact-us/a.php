<div class="container-fluid pt-lg-3 pb-lg-5 pb-4 my-2">
    <div class="container pb-lg-5">
        <div class="row pb-lg-5">
            <div class="col-12 col-lg-12">
                <h1><?php the_title(); ?></h1>
                
                <?php if (!empty($args["page_templates"]["contact_page"]["content"])): ?>
                    <?php echo $args["page_templates"]["contact_page"]["content"]; ?>
                <?php endif; ?>
                
                <div class="pt-3 mt-lg-2 pt-lg-4">
                    <?php if (!empty($args["page_templates"]["contact_page"]["gravity_form_id"])): ?>
                        <?php
                        $form_id = $args["page_templates"]["contact_page"]["gravity_form_id"];
                        echo do_shortcode("[gravityforms id=" . $form_id . " ajax=true]");
                        ?>
                    <?php endif; ?>
                </div>
            </div>  
        </div>
    </div>
</div>
