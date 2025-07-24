<div class="modal" id="Gallery-lightBox" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog gallery-modal border-0 modal-dialog-centered " role="document">
        <div class="modal-content  border-0 text-center bg-transparent ">
            <div class="modal-body border-0 bg-transparent text-center p-0 ">
                <div class="swiper mySwiper-lightbox  ">
                    <div class="swiper-wrapper ">
                        <?php
                        $cat = isset($_GET["cat"]) ? $_GET["cat"] : "";
                        $paged = get_query_var("paged")
                        	? get_query_var("paged")
                        	: 1;
                        $total_posts = 0;
                        $args = [
                        	"paged" => $paged,
                        	"posts_per_page" => 9,
                        	"post_type" => "bc_galleries",
                        ];
                        if ($cat) {
                        	$args["tax_query"] = [
                        		[
                        			"taxonomy" => "bc_gallery_category",
                        			"field" => "slug",
                        			"terms" => $cat,
                        		],
                        	];
                        }
                        $query = new WP_Query($args);
                        if ($query->have_posts()):
                        	while ($query->have_posts()):

                        		$query->the_post();
                        		$gallery_img = get_post_meta(
                        			get_the_ID(),
                        			"gallery_images",
                        			true
                        		);
                        		$gallery_img_arr = json_decode($gallery_img);
                        		$alt = "";
                        		?>
                                <div class="swiper-slide d-inline-block abc ">
                                    <div class="d-inline-block position-relative border-25">                                        
                                        <img class="d-block img-fluid mx-auto" src="<?php echo $gallery_img_arr[0]
                                        	->thumbnail; ?>"  alt="<?php echo $alt; ?>" width="686" height="1060">                       
                                  <div class="swiper-button-next swiper-button-next-lightbox-gallery color_tertiary_bg" style="right:0px !important;">
                                            <i class="p-alt icon-chevron-right1  text_20   line_height_24"></i>
                                   </div>
                                     <div class="swiper-button-prev swiper-button-prev-lightbox-gallery color_tertiary_bg" style="left:0px !important;">
                                        <i class="p-alt icon-chevron-left1  text_20   line_height_24"></i>
                                     </div> 
                                     <button type="button" class="close m-0 bg-transparent p-0  p-alt position-absolute mr-n0 border-0" data-bs-dismiss="modal" aria-label="Close" style="outline: none;opacity: 1; top: -45px; z-index: 99;    width: 2rem; right: -64px;">
                                    <i class="p-alt  icon-xmark1 text_30   line_height_26"></i>
                                     </button>
                                    </div>
                                    
                                </div>

                                <?php
                        	endwhile;
                        	wp_reset_postdata();
                        endif;
                        ?>
                         
                    </div>
                    
                </div>  
                
            </div>
        </div>
    </div>
</div>