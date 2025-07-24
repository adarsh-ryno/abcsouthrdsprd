 <div class="row py-lg-2">
                                <div class="col-lg-4">
                                    <h1><?php echo $args["page_templates"][
                                    	"landing_page"
                                    ]["seo_section"]["heading"]; ?></h1>
                                    <h2 class="pb-lg-5"><?php echo $args[
                                    	"page_templates"
                                    ]["landing_page"]["seo_section"][
                                    	"subheading"
                                    ]; ?> </h2>
                                </div>
                                <div class="col-lg-8">
                                    
                                    
                                    <p><?php echo $args["page_templates"][
                                    	"landing_page"
                                    ]["seo_section"][
                                    	"before_read_more_content"
                                    ]; ?></p>
                                    <div class="collapse bg-transparent border-0" id="collapseExample2">
                                        <div class=" bg-transparent border-0">
                                            <p><?php echo $args[
                                            	"page_templates"
                                            ]["landing_page"]["seo_section"][
                                            	"after_read_more_content"
                                            ]; ?></p>
                                        </div>
                                    </div>
                                    <?php echo do_shortcode(
                                    	'[bc-read-more id="read_more" background-color="" data-close-icon="icon-minus1" data-open-icon="icon-plus1"]'
                                    ); ?>
                                                
                                </div>
                                
                            </div>