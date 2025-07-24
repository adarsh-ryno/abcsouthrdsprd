<div class="mt-4 sidbar-services text-center d-lg-block d-none order-lg-3 order-3  overflow-hidden">
    <h3 class="pb-3"><?php echo $args["page_templates"]["service_subpage"][
    	"services"
    ]["title"]; ?></h3>
    <div class="swiper py-3 mt-3 sidebar_service_swiper overflow-visible ">
        <div class="swiper-wrapper">
            <?php
            $servicesItems = $args["globals"]["services"]["items"];
            foreach ($servicesItems as $value) {
            	echo '<div class="swiper-slide px-lg-3"><a href="' .
            		get_home_url() .
            		$value["link"] .
            		'" class="d-block  border-top-tertiary-10 no_hover_underline service_block shadow-sm">
                <div class="d-flex d-lg-block align-items-center text-lg-center py-lg-2 px-lg-0 px-4 py-1">
                <div class="w-100 d-block align-items-center  py-5">
                <div class="pt-4">
                <i class="' .
            		$value["icon"] .
            		' color_primary text_100 line_height_100 service_block_icon "></i>
                </div>
                <div class="pb-4">
                <h6 class="h7 mt-4 pt-1 true_black font_default text_normal  line_height_25 text-uppercase">' .
            		$value["title"] .
            		'</h6>
               
                </div>

                </div>
                </div>
                </a></div>';
            }
            ?> 
        </div>
    </div>
      
    <div class="swiper-pagination sidebar-service-pagination pagination-variation-a pt-2 position-relative"></div>
</div> 

 <div class="d-block order-3 d-lg-none pt-lg-5 pb-lg-5 pt-4">
           
                <div class="container-fluid pb-lg-5 px-0">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                   <h3 class="text-center pb-3 pt-1 sm_text_semibold sm_text_28 sm_line_height_33"><?php echo $args[
                                   	"page_templates"
                                   ]["service_subpage"]["services"][
                                   	"title"
                                   ]; ?></h3>

                            </div>
                             <?php
                             $servicesItems =
                             	$args["globals"]["services"]["items"];

                             foreach ($servicesItems as $value) {
                             	echo '<div class="col-lg-3">
                                <a href="' .
                             		get_home_url() .
                             		$value["link"] .
                             		'" class="d-block shadow-sm border-top-tertiary-lg-10 border-md-6 no_hover_underline service_block">
                                    <div class="d-flex d-lg-block align-items-center text-lg-center py-lg-2 px-lg-0 px-4 py-1">
                                        <div class="w-100 d-lg-block d-flex align-items-center  py-lg-5">
                                            <div class="col-lg-12 col-2">
                                                <i class="' .
                             		$value["icon"] .
                             		'  text_70 line_height_70  sm_text_30 sm_line_height_60 color_primary service_block_icon"></i>
                                            </div>
                                            <div class="col-lg-12 col-8">
                                                <h6 class="h7 mt-lg-4 mb-0 pt-lg-1">' .
                             		$value["title"] .
                             		'</h6>
                                            </div>
                                            <div class="col-lg-12 col-2 text-end">
                                                <i class="icon-chevron-right4  sm_text_20 sm_line_height_60 d-lg-none d-inline-block true_black"></i>
                                            </div>
                                        </div>
                                    </div>
                              
                                </a>
                            </div>';
                             }
                             ?>
                      

                        </div>
                    </div>
                </div>
            </div>
<script type="text/javascript">
    jQuery(document).ready(function(){
        var swiperServiceSidebar = new Swiper(".sidebar_service_swiper", {
            spaceBetween: 70,
            slidesPerView: 1,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            loop: true,
            pagination: {
                el: ".sidebar-service-pagination",
                clickable: true,
            },

        });      
    }); 
</script>
