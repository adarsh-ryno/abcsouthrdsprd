<?php
// Check if WP Job Board is enabled
if (!empty($args["page_templates"]["career_page"]["position"]["wp_job_board"]) && $args["page_templates"]["career_page"]["position"]["wp_job_board"] == true) { ?>
    <div class="container-fluid" id="open_position">
        <div class="container pb-5">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="mb-0 pb-4"><?php echo !empty($args["page_templates"]["career_page"]["position"]["heading"]) ? esc_html($args["page_templates"]["career_page"]["position"]["heading"]) : ''; ?></h4>
                    <?php echo do_shortcode("[wpjb_jobs_list]"); ?>
                </div>
            </div>
        </div>
    </div>
<?php } else { 
    $team_args = [
        "post_type" => "bc_position",
        "posts_per_page" => -1,
        "order" => "DESC",
        "post_status" => "publish",
    ];
    $query = new WP_Query($team_args);
    
    ?>
    <div class="container-fluid mt-4 mt-lg-2" id="open_position">
        <div class="container pb-2">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="mb-0 pb-4"><?php echo !empty($args["page_templates"]["career_page"]["position"]["heading"]) ? esc_html($args["page_templates"]["career_page"]["position"]["heading"]) : ''; ?></h4>
                    <?php if (!empty($args["page_templates"]["career_page"]["position"]["button_text"]) && !empty($args["page_templates"]["career_page"]["position"]["button_link"])) { ?>
                        <a href="<?php echo esc_url(get_home_url() . $args["page_templates"]["career_page"]["position"]["button_link"]); ?>/" class="mb-4 btn btn-primary mw-206">
                            <?php echo esc_html($args["page_templates"]["career_page"]["position"]["button_text"]); ?> 
                            <i class="icon-chevron-right1 ms-2 text_16 line_height_16"></i>
                        </a>
                    <?php } ?>
                </div>

                <div id="career_services_swiper" class="swiper swiper-container pb-5">
                    <div class="abc swiper-wrapper overflow-visible" style="justify-content:left!important;"> 
                    
                        <?php if ($query->have_posts()):
                            while ($query->have_posts()): $query->the_post();
                                $team_position = get_post_meta(get_the_ID(), "team_position", true);
                                $team_custom_content = get_post_meta(get_the_ID(), "team_custom_content", true);
                        ?>
                            <div class="swiper-slide mb-lg-0 mb-4">
                                <div class="color_quaternary_bg p-4">
                                    <h6 class="position_title"><?php the_title(); ?></h6>
                                    <p class="text_bold"><?php echo !empty($team_position) ? esc_html($team_position) : ''; ?></p>
                                    <p class="h-auto"><?php echo !empty($team_custom_content) ? wp_trim_words($team_custom_content, 25, "...") : wp_trim_words(get_the_content(), 25, "..."); ?></p>
                                    <a href="<?php echo esc_url(get_the_permalink()); ?>" class="btn btn-primary mw-206">
                                        View position 
                                        <i class="icon-chevron-right1 ms-2 text_16 line_height_16"></i>
                                    </a>
                                </div>
                            </div>
                            <?php
                            endwhile;
                            wp_reset_postdata(); // Use wp_reset_postdata() instead of wp_reset_query()
                        endif; ?>
                        
                    </div>
                    <div class="swiper-pagination swiper-pagination-service"></div>
                </div>
            </div>
        </div>
    </div>

<?php } ?>

    <script>
    // Job Application js
    function viewPostionButtonClick(attr) {
        var jobTitle = jQuery(attr).siblings('.position_title').text();
        console.log(jobTitle);
        jQuery(".job-title").find('input:text').val(jobTitle);
    }

    jQuery(document).ready(function () {
        <?php if (isset($query) && $query): ?>
            var CountSlider = "<?php echo $query->found_posts; ?>";
            var loop = false;
            if (CountSlider > 3) {
                loop = true;
            }
            if (CountSlider < 3) {
                jQuery(".abc.swiper-wrapper").addClass("justify-content-center");
            }
        <?php else: ?>
            var CountSlider = 0; // Or any default value you want
        <?php endif; ?>

        var swiper = new Swiper("#career_services_swiper", {
            slidesPerView: 1,
            spaceBetween: 10,
            loop: true,
            autoplay: {
                enabled: true,
                delay: 8000,
            },
            noSwiping: true,
            pagination: {
                el: ".swiper-pagination-service",
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                    noSwiping: true,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                    noSwiping: true,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                    noSwiping: true,
                },
            },
        });
    });
</script>
