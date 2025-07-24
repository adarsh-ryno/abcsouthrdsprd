<?php
$get_rds_template_data_array = RDS_TEMPLATE_DATA;
$paged = get_query_var("paged") ? get_query_var("paged") : -1;
$category_name = $args["category_taxonomy"];
if (empty($category_name) || in_array("all", $category_name)) {
    query_posts([
        "post_type" => "bc_testimonials",
        "posts_per_page" => 5,
        "paged" => $paged,
        "order" => "DESC",
        "post_status" => "publish",
        'meta_query'     => array(
            'relation' => 'OR',
            array(
                'key'     => 'testimonial_landing_page',
                'compare' => 'NOT EXISTS', // Exclude posts where the 'testimonial_landing_page' meta key doesn't exist
            ),
            array(
                'key'     => 'testimonial_landing_page',
                'value'   => '0', // Exclude posts where 'testimonial_landing_page' is set to 1
                'compare' => '=', 
                'type'    => 'NUMERIC',
            ),
        ),
    ]);
} else {
    query_posts([
        "post_type" => "bc_testimonials",
        "posts_per_page" => 5,
        "paged" => $paged,
        "order" => "DESC",
        "post_status" => "publish",
        "tax_query" => [
            "relation" => "AND", // Match both category and landing page criteria
            [
                "taxonomy" => "bc_testimonial_category",
                "field" => "name",
                "terms" => $category_name,
                "operator" => "IN",
            ],
        ],
        'meta_query'     => array(
            'relation' => 'OR',
            array(
                'key'     => 'testimonial_landing_page',
                'compare' => 'NOT EXISTS', // Exclude posts where the 'testimonial_landing_page' meta key doesn't exist
            ),
            array(
                'key'     => 'testimonial_landing_page',
                'value'   => '0', // Exclude posts where 'testimonial_landing_page' is set to 1
                'compare' => '=', 
                'type'    => 'NUMERIC',
            ),
        ),
    ]);
}

?>
<div class="w-100 d-block">
<div class="d-flex flex-column">
<div class="d-block order-1 order-lg-1">
<div class="container-fluid pt-4 pt-lg-4 pb-lg-2 pb-2 my-1 px-lg-3 px-0">
    <div class="container subpage_full_content review_page_content pb-lg-0">
        <div class="row pb-lg-2">
            <div class="col-12">
            <h1><?php echo get_the_title(); ?></h1>
            <h2 class="mb-5 text-capitalize"><?php echo !empty($args["page_templates"]["testimonial_page"]["subheading"]) ? $args["page_templates"]["testimonial_page"]["subheading"] : ''; ?></h2>
                <?php if (have_posts()): ?>
                    <?php while (have_posts()): the_post(); ?>
                        <?php
                        $message = get_post_meta(get_the_ID(), "testimonial_message", true);
                        $name = get_post_meta(get_the_ID(), "testimonial_name", true);
                        $heading = get_post_meta(get_the_ID(), "testimonial_heading", true);
                        $city = get_post_meta(get_the_ID(), "testimonial_city", true);
                        $state = get_post_meta(get_the_ID(), "testimonial_state", true);
                        ?>
                      <div class="shadow bg-white border-top-secondary p-4 text-center mb-6">
                            <?php if (!empty($message)): ?>
                                <p class="mb-0 pb-4 px-lg-2 mx-lg-1"><?php echo esc_html($message); ?></p>
                            <?php endif; ?>
                            <div class="slide-icon align-items-center d-flex justify-content-center pb-1">
                                <i class="icon-star1 stars_color text_15 line_height_15 me-1"></i>
                                <i class="icon-star1 stars_color text_15 line_height_15 me-1"></i>
                                <i class="icon-star1 stars_color text_15 line_height_15 me-1"></i>
                                <i class="icon-star1 stars_color text_15 line_height_15 me-1"></i>
                                <i class="icon-star1 stars_color text_15 line_height_15 mr-0"></i>
                            </div>
                            <?php if (!empty($name)): ?>
                                <strong class="d-block text_16 line_height_26_4 text_bold"><?php echo esc_html($name); ?></strong>
                            <?php endif; ?>
                            <p>
                                <strong class="d-block text_16 line_height_26_4">
                                    <?php 
                                    $location = '';
                                    if (!empty($city)) {
                                        $location .= esc_html($city);
                                    }
                                    if (!empty($state)) {
                                        if (!empty($location)) {
                                            $location .= ', ';
                                        }
                                        $location .= esc_html($state);
                                    }
                                    echo $location;
                                    ?>
                                </strong>
                            </p>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
                <div class="row">
                    <div class="col-md-12 d-flex align-items-center justify-content-center mt-4">
                        <?php understrap_pagination([
                            "prev_text" => '<i class="icon-angles-left4"></i>',
                            "next_text" => '<i class="icon-angles-right4"></i>',
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<?php wp_reset_query(); // Reset the custom query
?>
