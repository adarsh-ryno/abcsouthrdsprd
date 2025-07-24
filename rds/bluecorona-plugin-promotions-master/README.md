## bc-promotions

### These functionalities are for adding coupons (ADMIN SIDE):-

### 1. Default promotion   -> checking default promotion box fetches all coupons in UI.
![Default option](https://github.com/integrateideas/bluecorona-plugin-promotions/blob/master/readme-images/default-option.png?raw=true)
  

### 2. No Expiry           -> checking no expiry box means that particular coupon will never expire.
![No Expiry](https://github.com/integrateideas/bluecorona-plugin-promotions/blob/master/readme-images/no-expiry.png?raw=true)
   
)

### 3. Recurring promotion -> checking recurring promotion box converts current expiration date into a recurring date for the next month automatically.
![Recurring promotion](https://github.com/integrateideas/bluecorona-plugin-promotions/blob/master/readme-images/Recurring-promotion.png?raw=true)
    

### 4. Last date of month  -> checking last date of month option automatically selects last date of the current month and hides the date field.
![Last date of month](https://github.com/integrateideas/bluecorona-plugin-promotions/blob/master/readme-images/last-date-of-month.png?raw=true)
   


### 5. Promotion Category  -> helps assign any category you want for a specific coupon. 
![Promotion Category](https://github.com/integrateideas/bluecorona-plugin-promotions/blob/master/readme-images/promotion-category.png?raw=true)






### Promotion setting in page editor(ADMIN SIDE):-

### 1. Show promotion   -> checking show promotion box will assist you in either selecting default promotion or category specific promotions.
![Show promotion](https://github.com/integrateideas/bluecorona-plugin-promotions/blob/master/readme-images/show-promotion.png?raw=true)


### 2. Default Promotion  -> checking default promotion fetches all coupons on that particular page.

### 3. Category -> selecting category option fetches coupon on that particular page category-wise. 
![Category](https://github.com/integrateideas/bluecorona-plugin-promotions/blob/master/readme-images/category.png?raw=true)


### 4. Specific Coupons -> allows you to apply a specific coupon or multiple coupons on that particular page. 
![Specific Coupons](https://github.com/integrateideas/bluecorona-plugin-promotions/blob/master/readme-images/specific-coupon.png?raw=true)



### Promotions shortcode:-

1. To show a specific coupon/multiple coupons for that specific page use this shortcode :-
    for single coupon    [bc-promotion coupon_id="x"], 

    for multiple coupons [bc-promotion coupon_id="x, xx"] 
    x = coupon id (post id under the promotion post type )

2. To show all coupons, use this shortcode :- [bc-promotion]





### To Override Promotion Widget's UI :-

 1. Open bc-promotions-widgets.php file under the widgets folder in child theme. 
 2. Paste the below code inside the file.
 3. After this you can change the design of promotion widgets.

```php

<?php  
 if (class_exists('BC_Promotions_Widgets')) {
 class BC_Promotions_Widget_Overide extends BC_Promotions_Widgets{

  
    function addSwiperInitPromotionJsToFooter($instance){
            echo "
            <script>
            jQuery(document).ready(function(){
            var sidebarPromotionsSwiper = new Swiper('#".$instance."', {
                pagination: false,
                autoplay:true,
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

    public function widget( $args, $instance ) {
    //Add JS for widget to footer
    $widgetInstance = $this->id;
    add_action('wp_footer', function() use ( $widgetInstance ) { 
    $this->addSwiperInitPromotionJsToFooter( $widgetInstance ); });
?>

<div class="mt-5">
<?php 

    if ( isset( $instance['title'] ) && !empty($instance['title']) ) {
        echo $args['before_title'] . $instance['title'] . $args['after_title']; 
    }
    if ( isset( $instance['widget_promotion_category_id'] ) && ! empty( $instance['widget_promotion_category_id'] ) ) {
             $promotions_term_id = $instance['widget_promotion_category_id'];
        }

?>
        <!-- before pase -->
        <div id="<?php echo $this->id ?>" class="bc_promotions swiper-container text-center my-4 swiper-container-initialized swiper-container-horizontal">
            <div class="swiper-wrapper text-center">
            <?php 
            $promotions_args  = array( 'post_type' => 'bc_promotions', 'posts_per_page' => -1, 'order'=> 'DESC','post_status'  => 'publish',
                        'tax_query' => array(
                            array(
                            'taxonomy' => 'bc_promotion_category',
                            'field' => 'term_id',
                            'terms' => $promotions_term_id
                             )
                  ));
            $query = new WP_Query( $promotions_args );
            if ( $query->have_posts() ) :
                while($query->have_posts()) : $query->the_post();

                $promotion_type = get_post_meta(get_the_ID(), 'promotion_type', TRUE);
                 $noexpiry = get_post_meta( get_the_ID(), 'promotion_noexpiry', true );
                if($promotion_type == 'Builder'){
                    $date = get_post_meta( get_the_ID(), 'promotion_expiry_date1', true );
                    if(strtotime($date) >= strtotime(current_time('m/d/Y')) || $noexpiry == 1){
                        $title = get_post_meta( get_the_ID(), 'promotion_title1', true );
                        $color = get_post_meta( get_the_ID(), 'promotion_color', true );
                        $subheading = get_post_meta( get_the_ID(), 'promotion_subheading', true );
                        $footer_heading = get_post_meta( get_the_ID(), 'promotion_footer_heading', true ); ?>
                        <div class="swiper-slide">
                            <a href="<?php the_permalink(get_the_ID()); ?>" target="_blank">
                                <div id="coupon-id-<?php echo get_the_ID(); ?>" class="bc_color_secondary bc_color_primary_bg p-3 mb-3" style="background-color: <?php echo $color;?>">
                                    <div class="py-4 px-3 pt-0 border-white bc_coupon_container">
                                        <span class="pb-3 bc_font_alt_1 bc_text_36 d-block bc_color_secondary text-capitalize "><?php echo $title ?></span>
                                       <span class="bc_text_36 d-block my-2"><?php echo $subheading;?></span>
                                       <span class="bc_text_36 d-block my-2"><?php echo $footer_heading;?></span>
                                        <?php if($noexpiry != 1){ ?>
                            <span class="mt-3 bc_text_20 ">expires <?php echo $date;?></span>
                        <?php } ?>
                                        
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php }
                }else if($promotion_type == 'Image'){
                    $date2 = get_post_meta( get_the_ID(), 'promotion_expiry_date2', true );
                    if(strtotime($date2) >= strtotime(current_time('m/d/Y')) || $noexpiry == 1){
                        $title2 = get_post_meta( get_the_ID(), 'promotion_title2', true );
                        $promotion_custom_image = get_post_meta( get_the_ID(), 'promotion_custom_image', true ); ?>
                        <div class="swiper-slide">
                            <a href="<?php the_permalink(get_the_ID()); ?>" target="_blank">
                                <img  src="<?php echo $promotion_custom_image;?>" style="width:350px;height:228px;">
                            </a>
                        </div>
                <?php }
                }?>
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
        
        <div class="text-center"><a href="<?php echo get_home_url().$instance['link']; ?>"><button class="btn bc_default_primary text-white px-4" type="button"> View Promotion</button></a></div>
</div>

<?php
}
} 

function bc_promotions_register_widgets_overide() {
    register_widget( 'BC_Promotions_Widget_Overide' );
}
add_action( 'widgets_init', 'bc_promotions_register_widgets_overide' );
}

```
