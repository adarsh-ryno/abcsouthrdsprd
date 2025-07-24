<?php
//exaple how to set image sizewise
// ['dektop', 'ipad', 'mobile']

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

$img1x = Implode(",", $img1x);
$img2x = Implode(",", $img2x);
$img3x = Implode(",", $img3x);
?>

<?php echo do_shortcode(
	'[custom-bg-srcset class="service_subpage_banner" img1x="' .
		$img1x .
		'" img2x="' .
		$img2x .
		'" img3x="' .
		$img3x .
		'" size1x="cover" size2x="cover" size3x="cover"]'
); ?>
<div class="container-fluid service_subpage_banner py-lg-0 py-4">
    <div class="container px-0 pb-lg-2 pb-4">
        <div class="row py-2 pb-lg-3">
            <div class="col-lg-12 py-3 py-lg-4"> 
                <?php
                $i = 0;
                $services_prmotion_id = get_post_meta(
                	get_the_ID(),
                	"rds_promotion_id",
                	true
                );
                global $post;
                $get_slug = $post->post_name;
                $the_query = new WP_Query([
                	"post_type" => "bc_promotions",
                	"post_status" => "publish",
                	"tax_query" => [
                		[
                			"taxonomy" => "bc_promotion_category",
                			"field" => "slug",
                			"terms" => $get_slug,
                		],
                	],
                ]);
				if (!empty($the_query->post) && isset($post) && isset($post->post_parent)) {
					$get_slug = get_page($post->post_parent)->post_name;
				}
				
                if (!empty($services_prmotion_id)) {
                	$get_id = [
                		"post_type" => "bc_promotions",
                		"post_status" => "publish",
                		"p" => $services_prmotion_id,
                	];
                	$loop = new WP_Query($get_id);
                	if ($loop->have_posts()) {
                		while ($loop->have_posts()):
                			$loop->the_post();

                			$noexpiry = get_post_meta(
                				get_the_ID(),
                				"promotion_noexpiry",
                				true
                			);
                			$date = get_post_meta(
                				get_the_ID(),
                				"promotion_expiry_date1",
                				true
                			);
                			if (
                				strtotime($date) >=
                					strtotime(current_time("m/d/Y")) ||
                				$noexpiry == 1
                			) {
                				$i++; ?>
                            <span class="d-block display1 coupon_title"><?php echo get_post_meta(
                            	get_the_ID(),
                            	"promotion_title1",
                            	true
                            ); ?> </span> 
                                <span class="d-block display2 coupon_subtitle"><?php echo get_post_meta(
                                	get_the_ID(),
                                	"promotion_heading",
                                	true
                                ); ?> </span>
                                <span class="d-block display2 coupon_subtitle2 "><?php echo get_post_meta(
                                	get_the_ID(),
                                	"promotion_subheading",
                                	true
                                ); ?> </span>
                                <a data-bs-toggle="modal" data-bs-target="#request_coupon_form" onclick="couponBannerButtonClick(this);" class="btn btn-secondary mw-226 mt-2">Request Service <i class="icon-chevron-right text_18 line_height_18 ms-2 "></i></a>
                            <?php
                			}
                		endwhile;
                		wp_reset_postdata();
                	}
                }
                if ($i == 0) {
                	$get_id = [
                		"post_type" => "bc_promotions",
                		"post_status" => "publish",
                		"orderby" => "modified",
                	];
                	$loop = new WP_Query($get_id);
                	while ($loop->have_posts()):
                		$loop->the_post();
                		$terms = wp_get_post_terms($loop->post->ID, [
                			"bc_promotion_category",
                		]);
                		foreach ($terms as $term):
                			$noexpiry = get_post_meta(
                				get_the_ID(),
                				"promotion_noexpiry",
                				true
                			);
                			$date = get_post_meta(
                				get_the_ID(),
                				"promotion_expiry_date1",
                				true
                			);
                			if (
                				$get_slug == $term->slug &&
                				$i == 0 &&
                				get_post_meta(
                					get_the_ID(),
                					"promotion_show_banner_setting",
                					true
                				) == true &&
                				(strtotime($date) >=
                					strtotime(current_time("m/d/Y")) ||
                					$noexpiry == 1)
                			) { ?>
                                <span class="d-block display1 coupon_title"><?php echo get_post_meta(
                                	get_the_ID(),
                                	"promotion_title1",
                                	true
                                ); ?> </span> 
                                <span class="d-block display2 coupon_subtitle"><?php echo get_post_meta(
                                	get_the_ID(),
                                	"promotion_heading",
                                	true
                                ); ?> </span>
                                <span class="d-block display2 coupon_subtitle2 "><?php echo get_post_meta(
                                	get_the_ID(),
                                	"promotion_subheading",
                                	true
                                ); ?> </span>
                                <a data-bs-toggle="modal" data-bs-target="#request_coupon_form" onclick="couponBannerButtonClick(this);" class="btn btn-secondary mw-226 mt-2">Request Service <i class="icon-chevron-right text_18 line_height_18 ms-2 "></i></a>
                                <?php $i++;}
                		endforeach;
                	endwhile;
                	wp_reset_postdata();
                }
				if ($i == 0) { 
					// Check if 'heading' is not empty before displaying it
					if (!empty($args["page_templates"]["landing_page"]["banner"]["heading"])) {
						?>
						<span class="d-block display1"><?php echo esc_html($args["page_templates"]["landing_page"]["banner"]["heading"]); ?></span>
						<?php
					}
				
					// Check if 'subheading' is not empty before displaying it
					if (!empty($args["page_templates"]["landing_page"]["banner"]["subheading"])) {
						?>
						<span class="d-block display2"><?php echo esc_html($args["page_templates"]["landing_page"]["banner"]["subheading"]); ?></span>
						<?php
					}
				
					// Check if 'button_text' and 'button_link' are not empty before displaying the button
					if (!empty($args["page_templates"]["landing_page"]["banner"]["button_text"]) && !empty($args["page_templates"]["landing_page"]["banner"]["button_link"])) {
						?>
						<a href="<?php echo esc_url(get_home_url() . $args["page_templates"]["landing_page"]["banner"]["button_link"]); ?>" class="btn btn-primary mw-237 mt-3">
							<?php echo esc_html($args["page_templates"]["landing_page"]["banner"]["button_text"]); ?>
							<i class="icon-chevron-right1 ms-1 text_18 line_height_18 d-lg-inline-block d-none"></i>
						</a>
						<?php
					}
				}
				
                ?>
            </div>
        </div>
    </div>
</div>