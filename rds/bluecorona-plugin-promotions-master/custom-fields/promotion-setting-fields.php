<?php
function bc_promotion_settiong_metabox()
{
	$screens = ["post", "page", "bc_promotions"];
	foreach ($screens as $screen) {
		add_meta_box(
			"bc_promotion_settings", // Metabox ID
			"Promotion Settings", // Title to display
			"bc_promotion_settings", // Function to call that contains the metabox content
			"page", // Post type to display metabox on
			"side", // Where to put it (normal = main colum, side = sidebar, etc.)
			"high" // Priority relative to other metaboxes
		);
	}
}

add_action("add_meta_boxes", "bc_promotion_settiong_metabox");
function bc_promotion_settings($post)
{
	$default_value = get_post_meta($post->ID, "promotion_default_value", true);
	$promotion_save = get_post_meta(
		$post->ID,
		"promotion_default_checkbox_value",
		true
	);
	$promotion_cat = get_post_meta(
		$post->ID,
		"promotion_default_category",
		true
	);
	$promotion_spa = get_post_meta(
		$post->ID,
		"promotion_default_special",
		true
	);
	$promotion_spa = explode(",", $promotion_spa);
	$promotion_cat = explode(",", $promotion_cat);
	$default_template = get_post_meta($post->ID, "_wp_page_template", true);
	$promotion_showval = get_post_meta($post->ID, "promotion_show_value", true);
	?>
   <!--  <style type="text/css">.btn-group{
        display: none;
    }</style> -->
     <div class="misc-pub-section misc-pub-section-last">
       <span ><label><input id="promotion_show_value" type="checkbox"  value="1" name="promotion_show_value"  <?php if (
       	empty($default_template)
       ) {
       	echo "checked";
       } else {
       	echo $promotion_showval == 1 ? "checked" : "";
       } ?> /> Show Promotion</label></span>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery("#promotion_show_value").change(function(){
            if(jQuery("#promotion_show_value").prop('checked') == false){
                jQuery("#show-promotion").hide();
            }else{
               jQuery("#show-promotion").show(); 
           }
            });
            if(jQuery("#promotion_show_value").prop('checked') == false){
                jQuery("#show-promotion").hide();
            }else{
               jQuery("#show-promotion").show();
           }
       });
    </script>
<div id="show-promotion">
    <div class="misc-pub-section misc-pub-section-last">
       <span >
        <label>

            <input id="promotion_default_value" type="checkbox"  value="1" name="promotion_default_value" <?php echo $default_value ==
            1
            	? "checked"
            	: ""; ?> <?php if (empty($default_template)) {
 	echo "checked";
 } ?> /> Default Promotion
        </label>
    </span>
    </div>
    <input type="hidden" name="tab_val3" value="true" id="tab_val3">
    <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery("#wporg_field").change(function(){
                jQuery(this).find("option:selected").each(function(){
                    var optionValue = jQuery(this).attr("value");
                    if(optionValue == 2){
                        jQuery(".category-class").show();
                    } else{
                        jQuery(".category-class").hide();
                    }
                    if(optionValue == 3){
                    
                        jQuery(".btn-group").show();
                    } else{
                       
                        jQuery(".btn-group").hide();
                    }

                    
                });
            }).change();
          
           
            jQuery("#promotion_default_value").change(function(){
            if(jQuery("#promotion_default_value").prop('checked') == true){

                jQuery("#filed").hide();
              
                

            }else{

               jQuery("#filed").show();
               jQuery(".btn-group").hide();
              
           }
            });
            if(jQuery("#promotion_default_value").prop('checked') == true){

                jQuery("#filed").hide();
                

            }else{

               jQuery("#filed").show();
            
           }
       });
          
    </script>
    <div id='filed'>
    <div id="default_checkbox">
    <label for="wporg_field">Description for this field</label>
    <select name="wporg_field" id="wporg_field" class="postbox">
        <option value="1" <?php echo $promotion_save == 1
        	? "selected"
        	: ""; ?>>All Coupons</option>
        <option value="2" <?php echo $promotion_save == 2
        	? "selected"
        	: ""; ?>>Category</option>
        <option value="3" <?php echo $promotion_save == 3
        	? "selected"
        	: ""; ?>>Specific Coupons</option>
        
    </select>
  
    
    <?php
    $args = [
    	"orderby" => "",
    	"order" => "ASC",
    	"hide_empty" => false,
    	"fields" => "all",
    	"parent" => 0,
    	"hierarchical" => true,
    	"child_of" => 0,
    	"childless" => false,
    	"pad_counts" => false,
    	"cache_domain" => "core",
    ];
    $categories = get_terms("bc_promotion_category", $args);

    $count_promotion = wp_count_posts($post_type = "bc_promotions");

    foreach ($categories as $category) {
    	if ($category->count) { ?>
    <ul class="category-class" style="display: none;">
        <li><input type="checkbox" name="category_name[]" value="<?php echo $category->term_taxonomy_id; ?>" <?php echo in_array(
	$category->term_taxonomy_id,
	$promotion_cat
)
	? "checked"
	: ""; ?>><?php echo $category->name; ?></li>
    </ul>
    <?php }
    }
    if ($count_promotion->publish == 0) { ?>
       <p class="category-class" style="display: none;" >No Promotion Found</p>
    <?php }
    ?></div>
<!-- <link rel="stylesheet" href="<?php //echo get_home_url();
	?>/wp-content/plugins/bc-promotions/css/bootstrap-3.1.1.min.css" type="text/css" /> -->
<link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri()); ?>/bluecorona-plugin-promotions-master/css/bootstrap-multiselect.css" type="text/css" media="all"/>
<!--<script type="text/javascript" src="https://code.jquery.com/jquery-1.8.2.js"></script>-->
<script defer type="text/javascript" src="<?php echo esc_url(get_template_directory_uri()); ?>/bluecorona-plugin-promotions-master/js/bootstrap-2.3.2.min.js"></script>
<script defer type="text/javascript" src="<?php echo esc_url(get_template_directory_uri()); ?>/bluecorona-plugin-promotions-master/js/bootstrap-multiselect.js"></script>
<link  media="all" rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri()); ?>/bluecorona-plugin-promotions-master/css/custom_style.css" type="text/css" />


    <?php
    // $specialargs  = array( 'post_type' => 'bc_promotions', 'posts_per_page' => -1, 'order'=> 'DESC','post_status'  => 'publish');
    $promotions = get_posts([
    	"numberposts" => -1,
    	"post_status" => "publish",
    	"post_type" => "bc_promotions",
    ]);

    //print_r($promotions);die("here");
    // ob_start();
    // $selectQuery = new WP_Query( $specialargs );
    if (!empty($promotions)): ?>
                                  <select id="special-class" multiple="multiple" style="display: none !important;" name="special_coupan[]">


<?php foreach ($promotions as $prom) {

	$promotion_title1 = get_post_meta($prom->ID, "promotion_title1", true);
	$promotion_title2 = get_post_meta($prom->ID, "promotion_title2", true);
	$promotion_Id = $prom->ID;
	?>
                <option value="<?php echo $promotion_Id; ?>"  <?php echo in_array(
	$promotion_Id,
	$promotion_spa
)
	? "selected"
	: ""; ?>
            ><?php
            echo $promotion_title1;
            echo $promotion_title2;
            ?></option>
    
    <?php
}
    	// wp_reset_query();
    	?></select><?php endif;?>                
<script type="text/javascript">
jQuery( window ).on( "load", function() {
jQuery('#special-class').multiselect({
includeSelectAllOption: true
});
});
</script></div>
</div>
  <script type="text/javascript">
        jQuery( window ).load(function() {
        

        if(jQuery('#wporg_field').find(":selected").val() == 3){
            
                jQuery(".btn-group").show();
                
            }else{
                
              jQuery(".btn-group").hide();
            }
            });
    </script>
                <?php
	// ob_end_flush();


}

function bc_promotion_setting_save_metabox($post_id, $post)
{
	if (empty($_POST["promotion_default_value"])) {
		$promotion_default_value = 0;
	} else {
		$promotion_default_value = wp_filter_post_kses(
			strip_tags($_POST["promotion_default_value"])
		);
	}
	if (empty($_POST["wporg_field"])) {
		$promotion_default_checkbox_value = 0;
	} else {
		$promotion_default_checkbox_value = wp_filter_post_kses(
			strip_tags($_POST["wporg_field"])
		);
	}
	if (empty($_POST["promotion_show_value"])) {
		$promotion_show = 0;
	} else {
		$promotion_show = wp_filter_post_kses(
			strip_tags($_POST["promotion_show_value"])
		);
	}
	if (empty($_POST["category_name"])) {
		$promotion_default_category = 0;
	} else {
		$promotion_default_category = implode(",", $_POST["category_name"]);
	}
	if (empty($_POST["special_coupan"])) {
		$promotion_special = 0;
	} else {
		$promotion_special = implode(",", $_POST["special_coupan"]);
	}

	if (empty($promotion_default_value)) {
		$promotion_default_value = 0;
	} else {
		$promotion_special = 0;
		$promotion_default_category = 0;
		$promotion_default_checkbox_value = 0;
	}
	if ($promotion_default_checkbox_value == 2) {
		$promotion_special = 0;
	}
	if ($promotion_default_checkbox_value == 3) {
		$promotion_default_category = 0;
	}
	if ($promotion_default_checkbox_value == 1) {
		$promotion_default_category = 0;
		$promotion_special = 0;
	}
	if (empty($promotion_show)) {
		$promotion_show = 0;
	} else {
		$promotion_show = 1;
	}

	update_post_meta(
		$post->ID,
		"promotion_default_checkbox_value",
		$promotion_default_checkbox_value
	);
	update_post_meta(
		$post->ID,
		"promotion_default_category",
		$promotion_default_category
	);
	update_post_meta(
		$post->ID,
		"promotion_default_value",
		$promotion_default_value
	);
	update_post_meta(
		$post->ID,
		"promotion_default_special",
		$promotion_special
	);
	update_post_meta($post->ID, "promotion_show_value", $promotion_show);

	return;
}

add_action("save_post", "bc_promotion_setting_save_metabox", 1, 2);
