<?php
// Example of how to set image size-wise
// ['desktop', 'ipad', 'mobile']

$img1x = [
    get_exist_image_url("subpage-hero", "subpage-banner"),
    get_exist_image_url("subpage-hero", "subpage-banner"),
    get_exist_image_url("subpage-hero", "m-subpage-banner"),
];

$img2x = [
    get_exist_image_url("subpage-hero", "subpage-banner@2x"),
    get_exist_image_url("subpage-hero", "subpage-banner@2x"),
    get_exist_image_url("subpage-hero", "m-subpage-banner@2x"),
];

$img3x = [
    get_exist_image_url("subpage-hero", "subpage-banner@3x"),
    get_exist_image_url("subpage-hero", "subpage-banner@3x"),
    get_exist_image_url("subpage-hero", "m-subpage-banner@3x"),
];

// Check if $img1x, $img2x, $img3x are not empty before imploding
$img1x = !empty($img1x) ? implode(",", $img1x) : '';
$img2x = !empty($img2x) ? implode(",", $img2x) : '';
$img3x = !empty($img3x) ? implode(",", $img3x) : '';

$args = RDS_TEMPLATE_DATA;

echo do_shortcode(
    '[custom-bg-srcset class="service_subpage_banner" img1x="' .
    $img1x .
    '" img2x="' .
    $img2x .
    '" img3x="' .
    $img3x .
    '" size1x="cover" size2x="cover" size3x="cover"]'
);
?>

<div class="container-fluid service_subpage_banner py-lg-0 py-4">
    <div class="container px-0 pb-lg-2 pb-4">
        <div class="row py-2 pb-lg-3">
            <div class="col-lg-12 py-3 py-lg-4"> 
                <?php
                $i = 0;
                $services_promotion_id = get_post_meta(get_the_ID(), "rds_promotion_id", true);

                global $post;

                // Ensure $post is set
                $get_slug = !empty($post) ? $post->post_name : '';

                $the_query = new WP_Query([
                    'post_type' => 'bc_promotions',
                    'post_status' => 'publish',
                    'tax_query' => [
                        [
                            'taxonomy' => 'bc_promotion_category',
                            'field' => 'slug',
                            'terms' => $get_slug,
                        ],
                    ],
                ]);

                // Handle the case when $post is null or empty
                if (empty($the_query->post) && !empty($post)) {
                    $parent_post = get_page($post->post_parent);
                    $get_slug = !empty($parent_post) ? $parent_post->post_name : '';
                }
                

                if (!empty($services_promotion_id)) {
                    $get_id = [
                        'post_type' => 'bc_promotions',
                        'post_status' => 'publish',
                        'p' => $services_promotion_id,
                    ];
                    $loop = new WP_Query($get_id);
                    if ($loop->have_posts()) {
                        while ($loop->have_posts()) {
                            $loop->the_post();
                            $noexpiry = get_post_meta(get_the_ID(), 'promotion_noexpiry', true);
                            $date = get_post_meta(get_the_ID(), 'promotion_expiry_date1', true);
                            if (strtotime($date) >= strtotime(current_time('m/d/Y')) || $noexpiry == 1) {
                                $i++;
                                ?>
                                <span class="d-block display1 coupon_title"><?php echo esc_html(get_post_meta(get_the_ID(), 'promotion_title1', true)); ?> </span> 
                                <span class="d-block display2 coupon_subtitle"><?php echo esc_html(get_post_meta(get_the_ID(), 'promotion_heading', true)); ?> </span>
                                <span class="d-block display2 coupon_subtitle2"><?php echo esc_html(get_post_meta(get_the_ID(), 'promotion_subheading', true)); ?> </span>
                                <a data-bs-toggle="modal" data-bs-target="#request_coupon_form" onclick="couponBannerButtonClick(this);" class="btn btn-secondary mw-226 mt-2">Request Service <i class="icon-chevron-right text_18 line_height_18 ms-2"></i></a>
                                <?php
                            }
                        }
                    }
                }

                if ($i == 0) {
                    $get_id = [
                        'post_type' => 'bc_promotions',
                        'post_status' => 'publish',
                        'orderby' => 'modified',
                    ];
                    $loop = new WP_Query($get_id);
                    while ($loop->have_posts()) {
                        $loop->the_post();
                        $terms = wp_get_post_terms($loop->post->ID, ['bc_promotion_category']);
                        foreach ($terms as $term) {
                            $noexpiry = get_post_meta(get_the_ID(), 'promotion_noexpiry', true);
                            $date = get_post_meta(get_the_ID(), 'promotion_expiry_date1', true);
                            if ($get_slug == $term->slug && $i == 0 && get_post_meta(get_the_ID(), 'promotion_show_banner_setting', true) == true && (strtotime($date) >= strtotime(current_time('m/d/Y')) || $noexpiry == 1)) {
                                ?>
                                <span class="d-block display1 coupon_title"><?php echo esc_html(get_post_meta(get_the_ID(), 'promotion_title1', true)); ?> </span> 
                                <span class="d-block display2 coupon_subtitle"><?php echo esc_html(get_post_meta(get_the_ID(), 'promotion_heading', true)); ?> </span>
                                <span class="d-block display2 coupon_subtitle2"><?php echo esc_html(get_post_meta(get_the_ID(), 'promotion_subheading', true)); ?> </span>
                                <a data-bs-toggle="modal" data-bs-target="#request_coupon_form" onclick="couponBannerButtonClick(this);" class="btn btn-secondary mw-226 mt-2">Request Service <i class="icon-chevron-right text_18 line_height_18 ms-2"></i></a>
                                <?php 
                                $i++;
                            }
                        }
                    }
                }
                if ($i == 0) {
                    if (!empty($args['page_templates']['service_subpage']['banner']['heading'])) {
                        ?>
                        <span class="d-block display1"><?php echo esc_html($args['page_templates']['service_subpage']['banner']['heading']); ?> </span> 
                        <?php
                    }
                    if (!empty($args['page_templates']['service_subpage']['banner']['subheading'])) {
                        ?>
                        <span class="d-block display2"><?php echo esc_html($args['page_templates']['service_subpage']['banner']['subheading']); ?> </span>
                        <?php
                    }
                    if (!empty($args['page_templates']['service_subpage']['banner']['button_text']) && !empty($args['page_templates']['service_subpage']['banner']['button_link'])) {
                        ?>
                        <a href="<?php echo esc_url(get_home_url() . $args['page_templates']['service_subpage']['banner']['button_link']); ?>" class="btn btn-primary mw-237 mt-3"><?php echo esc_html($args['page_templates']['service_subpage']['banner']['button_text']); ?>  <i class="icon-chevron-right1 ms-1 text_18 line_height_18  d-lg-inline-block d-none"></i></a> 
                        <?php 
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
