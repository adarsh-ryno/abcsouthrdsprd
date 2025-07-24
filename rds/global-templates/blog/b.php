<div class="row">
    <?php if (have_posts()): ?>
        <?php while (have_posts()): the_post(); ?>
            <div class="col-lg-8 col-md-12 mb-4 pb-2 pt-4">
                <div class="card border-0 rounded-0 p-4 position-relative blogs h-100 shadow">
                    <a href="<?php echo esc_url(get_permalink()); ?>" class="no_hover_underline no-underline">
                        <img src="<?php echo esc_url(post_content_first_image()); ?>" class="blog_img mb-4 img-fluid w-100" alt="<?php echo esc_attr(get_the_title()); ?>" width="670" height="220">
                        <div class="card-body px-0 py-0">
                            <h5 class="mb-0 pb-3"><?php echo esc_html(get_the_title()); ?></h5>
                            <p>
                                <?php
                                $my_content = wp_strip_all_tags(get_the_excerpt());
                                echo wp_trim_words($my_content, 25);
                                ?>
                            </p>
                            <a href="<?php echo esc_url(get_permalink()); ?>" class="no_hover_underline w-100 d-inline-flex align-items-center text_semibold text-uppercase text_18 line_height_23 font_alt_1 mb-3 blog_read_more_text_color">
                                <span class="continue blog_read_more_text_color">Keep Reading</span> 
                                <i class="bc_text_18 bc_line_height_18 icon-chevron-right2 ms-1 position-relative"></i>
                            </a>
                        </div>
                    </a>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <?php get_template_part("loop-templates/content", "none"); ?>
    <?php endif; ?>
</div>
