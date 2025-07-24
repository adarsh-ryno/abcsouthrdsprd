<div class="container-fluid py-lg-0 py-4">
    <div class="container px-lg-3 px-0">
        <div class="row">
            <div class="col-lg-12 mb-lg-3 pb-3"></div>
            <h1><?php echo !empty(get_the_title()) ? get_the_title() : ''; ?></h1>
            <h2 class="mb-5 text-capitalize">
                <?php echo !empty($args["page_templates"]["team_page"]["subheading"]) ? $args["page_templates"]["team_page"]["subheading"] : ''; ?>
            </h2>
                                    
            <?php
            $team_args = [
                "post_type" => "bc_teams",
                "posts_per_page" => -1,
                "order" => "DESC",
                "post_status" => "publish",
            ];

            $query = new WP_Query($team_args);
            if ($query->have_posts()):
                while ($query->have_posts()):

                    $query->the_post();
                    $image_full = get_the_post_thumbnail_url(get_the_ID(), "full");
                    if (empty($image_full)) {
                        $image_full = get_exist_image_url("meet-the-team", "team_placeholder.png");
                    }
                    ?>
                    <div class="col-lg-4 team_card [ is-collapsed ] border-0 ">
                        <div class="card__inner [ js-expander ] mb-4">
                            <div class="team_img">
                                <img src="<?php echo !empty($image_full) ? $image_full : ''; ?>" class="img-fluid w-100" alt="team image" width="350" height="220">
                            </div>
                            <div class="row pt-3">
                                <div class="col-8">
                                    <h3 class=""><?php echo !empty(get_the_title()) ? get_the_title() : ''; ?></h3>
                                    <span class="h7"><?php echo !empty(get_post_meta(get_the_ID(), "team_position", true)) ? get_post_meta(get_the_ID(), "team_position", true) : ''; ?></span>
                                </div>
                                <div class="col-4 pt-1">
                                    <span class="d-block text-end text-uppercase text_18 line_height_23 font_default text_semibold">
                                        bio <i class="icon-plus1 text_18 line_height_18"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card__expander pb-4">
                            <?php echo !empty(the_content()) ? the_content() : ''; ?>
                        </div>
                    </div>
            <?php
                endwhile;
                wp_reset_query();
            endif;
            ?>
        </div>
    </div>
</div>
<script>
    jQuery(document).ready(function() {
        var $cell = jQuery('.team_card');

        $cell.find('.js-expander').click(function() {
            var $thisCell = jQuery(this).closest('.team_card');

            if ($thisCell.hasClass('is-collapsed')) {
                $thisCell.siblings('.team_card').find('i').removeClass('icon-minus1').addClass('icon-plus1');
                $thisCell.find('i').toggleClass('icon-plus1 icon-minus1');
                $cell.not($thisCell).removeClass('is-expanded').addClass('is-collapsed');
                $thisCell.removeClass('is-collapsed').addClass('is-expanded');
            } else {
                $thisCell.find('i').toggleClass('icon-plus1 icon-minus1');
                $thisCell.removeClass('is-expanded').addClass('is-collapsed');
                $cell.not($thisCell).removeClass('is-inactive');
            }
        });

        $cell.find('.js-collapser').click(function() {
            var $thisCell = jQuery(this).closest('.team_card');
            $thisCell.removeClass('is-expanded').addClass('is-collapsed');
            $cell.not($thisCell).removeClass('is-inactive');
        });
    });
</script>
