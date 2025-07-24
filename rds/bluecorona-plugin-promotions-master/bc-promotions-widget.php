<?php
/*Custom widget*/
// BC Promotions Widget
class BC_Promotions_Widgets extends WP_Widget
{
	public function __construct()
	{
		$id = "BC_Promotions_widget";
		$title = esc_html__(
			"BC Promotions Widget",
			"bc-promotion-custom-widget"
		);
		$options = [
			"classname" => "bc-promotion-markup-widget",
			"description" => esc_html__(
				"Add Custom HTML in inputbox",
				"bc-promotion-custom-widget"
			),
		];
		parent::__construct($id, $title, $options);
	}

	function addSwiperInitPromotionJsToFooter($instance)
	{
		echo "
			<script>
			jQuery(document).ready(function(){
			var sidebarPromotionsSwiper = new Swiper('#" .
			$instance .
			"', {
	            pagination: false,
	            loop:true,
	            navigation: {
	                nextEl: '.bc_promotion_swiper_next',
	                prevEl: '.bc_promotion_swiper_prev',
	            },
        	});
        	});
			</script>
			";
	}

	public function widget($args, $instance)
	{
		//Add JS for widget to footer
		$widgetInstance = $this->id;
		add_action("wp_footer", function () use ($widgetInstance) {
			$this->addSwiperInitPromotionJsToFooter($widgetInstance);
		});
		?>

<div class="mt-5">
<?php
// if( is_plugin_active( 'bc-promotions-master/bc-promotions.php' ) ) {

if (isset($instance["title"]) && !empty($instance["title"])) {
	echo $args["before_title"] . $instance["title"] . $args["after_title"];
}
if (
	isset($instance["widget_promotion_category_id"]) &&
	!empty($instance["widget_promotion_category_id"])
) {
	$promotions_term_id = $instance["widget_promotion_category_id"];
}
?>
		<!-- before pase -->
		<div id="<?php echo $this->id; ?>" class="bc_promotions swiper-container text-center my-4 swiper-container-initialized swiper-container-horizontal">
			<div class="swiper-wrapper text-center">
			<?php
   $promotions_args = [
   	"post_type" => "bc_promotions",
   	"posts_per_page" => -1,
   	"order" => "DESC",
   	"post_status" => "publish",
   ];
   if (isset($promotions_term_id)) {
   	$promotions_args["tax_query"] = [
   		[
   			"taxonomy" => "bc_promotion_category",
   			"field" => "term_id",
   			"terms" => $promotions_term_id,
   		],
   	];
   }

   $query = new WP_Query($promotions_args);
   if ($query->have_posts()):
   	while ($query->have_posts()):

   		$query->the_post();

   		$promotion_type = get_post_meta(
   			get_the_ID(),
   			"promotion_type",
   			true
   		);
   		$noexpiry = get_post_meta(get_the_ID(), "promotion_noexpiry", true);
   		if ($promotion_type == "Builder") {
   			$date = get_post_meta(
   				get_the_ID(),
   				"promotion_expiry_date1",
   				true
   			);
   			if (
   				strtotime($date) >= strtotime(current_time("m/d/Y")) ||
   				$noexpiry == 1
   			) {

   				$title = get_post_meta(
   					get_the_ID(),
   					"promotion_title1",
   					true
   				);
   				$color = get_post_meta(
   					get_the_ID(),
   					"promotion_color",
   					true
   				);
   				$subheading = get_post_meta(
   					get_the_ID(),
   					"promotion_subheading",
   					true
   				);
   				$footer_heading = get_post_meta(
   					get_the_ID(),
   					"promotion_footer_heading",
   					true
   				);
   				?>
						<div class="swiper-slide">
							<a href="<?php the_permalink(get_the_ID()); ?>" target="_blank">
								<div id="coupon-id-<?php echo get_the_ID(); ?>" class="bc_color_secondary bc_color_primary_bg p-3 mb-3" style="background-color: <?php echo $color; ?>">
			                        <div class="py-4 px-3 pt-0 border-white bc_coupon_container">
			                            <span class="pb-3 bc_font_alt_1 bc_text_36 d-block bc_color_secondary text-capitalize "><?php echo $title; ?></span>
			                           <span class="bc_text_36 d-block my-2"><?php echo $subheading; ?></span>
			                           <span class="bc_text_36 d-block my-2"><?php echo $footer_heading; ?></span>
			                            <?php if ($noexpiry != 1) { ?>
                            <span class="mt-3 bc_text_20 ">expires <?php echo $date; ?></span>
                        <?php } ?>
			                            
			                        </div>
			                    </div>
			                </a>
						</div>
			        <?php
   			}
   		} elseif ($promotion_type == "Image") {
   			$date2 = get_post_meta(
   				get_the_ID(),
   				"promotion_expiry_date2",
   				true
   			);
   			if (
   				strtotime($date2) >= strtotime(current_time("m/d/Y")) ||
   				$noexpiry == 1
   			) {

   				$title2 = get_post_meta(
   					get_the_ID(),
   					"promotion_title2",
   					true
   				);
   				$promotion_custom_image = get_post_meta(
   					get_the_ID(),
   					"promotion_custom_image",
   					true
   				);
   				?>
						<div class="swiper-slide">
							<a href="<?php the_permalink(get_the_ID()); ?>" target="_blank">
		                    	<img  src="<?php echo $promotion_custom_image; ?>" style="width:350px;height:228px;">
		                    </a>
						</div>
		        <?php
   			}
   		}
   		?>
	        <?php
   	endwhile;
   	wp_reset_query();
   endif;
   ?>
				
			</div>
			<ul class=" list-unstyled">
				<li class="list-inline-item bc_promotion_swiper_prev bc_swiper-button-prev"> <em class="fa fa-chevron-circle-left"></em> </li>
				<li class="list-inline-item bc_promotion_swiper_next bc_swiper-button-next"> <em class="fa fa-chevron-circle-right"></em> </li>
			</ul>
		</div>
		
		<div class="text-center"><a href="<?php echo get_home_url() .
  	$instance[
  		"link"
  	]; ?>"><button class="btn bc_default_primary text-white px-4" type="button"> View Promotions</button></a></div>
</div>

<?php
		// }


	}

	public function update($new_instance, $old_instance)
	{
		$instance = [];
		if (isset($new_instance["title"]) && !empty($new_instance["title"])) {
			$instance["title"] = $new_instance["title"];
		}
		if (isset($new_instance["link"]) && !empty($new_instance["link"])) {
			$instance["link"] = $new_instance["link"];
		}
		if (
			isset($new_instance["widget_promotion_category_id"]) &&
			!empty($new_instance["widget_promotion_category_id"])
		) {
			$instance["widget_promotion_category_id"] =
				$new_instance["widget_promotion_category_id"];
		}
		return $instance;
	}
	public function form($instance)
	{
		$id = $this->get_field_id("title");
		$for = $this->get_field_id("title");
		$name = $this->get_field_name("title");
		$label = __("Title", "bc-promotion-custom-widget");
		$title = "";
		if (isset($instance["title"]) && !empty($instance["title"])) {
			$title = $instance["title"];
		}
		?>
		<p>
			<label for="<?php echo esc_attr(
   	$for
   ); ?>"><?php echo esc_html($label); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr(
   	$id
   ); ?>" name="<?php echo esc_attr($name); ?>"><?php echo esc_textarea($title); ?></textarea>
		</p>
		<?php
  $l_id = $this->get_field_id("link");
  $l_for = $this->get_field_id("link");
  $l_name = $this->get_field_name("link");
  $l_label = __("View Button Link", "bc-promotion-custom-widget");
  $l_title = "";
  if (isset($instance["link"]) && !empty($instance["link"])) {
  	$l_title = $instance["link"];
  }
  ?>
		<p>
			<label for="<?php echo esc_attr(
   	$l_for
   ); ?>"><?php echo esc_html($l_label); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr(
   	$l_id
   ); ?>" name="<?php echo esc_attr($l_name); ?>"><?php echo esc_textarea($l_title); ?></textarea>
		</p>

		<?php
  $specialargs = [
  	"post_type" => "bc_promotions",
  	"posts_per_page" => -1,
  	"order" => "DESC",
  	"post_status" => "publish",
  ];
  //ob_start();
  $query = new WP_Query($specialargs);
  if ($query->have_posts()): ?>
			<?php
   $c_id = $this->get_field_id("widget_promotion_category_id");
   $c_for = $this->get_field_id("widget_promotion_category_id");
   $c_name = $this->get_field_name("widget_promotion_category_id");
   $c_label = __("Promotion Category", "bc-promotion-custom-widget");
   $c_title = "";
   if (
   	isset($instance["widget_promotion_category_id"]) &&
   	!empty($instance["widget_promotion_category_id"])
   ) {
   	$c_id = $instance["widget_promotion_category_id"];
   }

   $terms = get_terms("bc_promotion_category");

   if (!empty($terms)) { ?>
			<p style="display: none;">
				<label for="<?php echo esc_attr($c_for); ?>"><?php echo esc_html(
	$c_label
); ?></label>
			</p>
			<select name="<?php echo esc_attr(
   	$c_name
   ); ?>" id="category" style="display: none;">
				<?php foreach ($terms as $term) { ?>

				<option <?php if ($c_id == $term->term_id) {
    	echo "selected";
    } ?> value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
				<?php } ?>
			</select>
			<?php }
   endif;?>  
	<br>             
<?php
	}
}
// register widget
function bc_promotions_register_widget()
{
	register_widget("BC_Promotions_Widgets");
}
add_action("widgets_init", "bc_promotions_register_widget");
