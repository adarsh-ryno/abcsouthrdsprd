<style type="text/css">
    .mySwiper-lightbox{
        visibility: hidden;
    }
    html {
        -webkit-user-select: none; /* Safari */
        -ms-user-select: none; /* IE 10 and IE 11 */
        user-select: none; /* Standard syntax */
    }
</style>
<?php
$get_rds_template_data_array = RDS_TEMPLATE_DATA;
$cat = isset($_GET["cat"]) ? $_GET["cat"] : "";
$paged = get_query_var("paged") ? get_query_var("paged") : 1;
$total_posts = 0;

$query_posts = [
	"paged" => $paged,
	"posts_per_page" => 9,
	"post_type" => "bc_galleries",
];
if ($cat) {
	$query_posts["tax_query"] = [
		[
			"taxonomy" => "bc_gallery_category",
			"field" => "slug",
			"terms" => $cat,
		],
	];
}
query_posts($query_posts);
?>
<main>
    <div class="w-100 d-block">
        <div class="d-flex flex-column">
            <div class="d-block order-1 order-lg-1">
                <div class="container-fluid pt-4 pt-lg-5 order-1 order-lg-1  mt-2  px-lg-3 px-0">
                    <div class="container px-lg-3 px-0">
                        <div class="row pb-lg-2 mx-0">
                            <div class="col-12 col-lg-12 order-lg-1 order-1 ">
                                <h1 class="mb-0 pb-4"><?php the_title(); ?></h1>
                                <p class="">
                                <?php
$get_rds_template_data_array = RDS_TEMPLATE_DATA;

if (!empty($args["page_templates"]["gallery_page"]["content"])) {
    echo $args["page_templates"]["gallery_page"]["content"];
}
?>

                                </p>
                                <?php get_template_part(
                                	"sidebar-templates/search",
                                	"gallerytopbar"
                                ); ?>
                                <div class="row mt-3">
                                    <?php if (have_posts()):
                                    	while (have_posts()):
                                    		the_post();
                                    		get_template_part(
                                    			"loop-templates/content-gallery"
                                    		);
                                    		$total_posts++;
                                    	endwhile;
                                    endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-center my-5">
                    <?php understrap_pagination([
                    	"prev_text" => '<i class="icon-angles-left4"></i>',
                    	"next_text" => '<i class="icon-angles-right4"></i>',
                    ]); ?>
                </div>
                <?php get_template_part(
                	"page-templates/common/bc-gallery-popup"
                ); ?>
            </div>
        </div>
    </div>
    <?php wp_reset_query(); ?>
</main>
<script>
    var dataIndex;
    var gallerySwiper;
    var pageNumber;
    var lastNumber;
    var url = jQuery(location).attr('href'),
            pageNumber = url.split("/"),
            lastNumber = pageNumber[pageNumber.length - 2];
    if (Math.floor(lastNumber) == lastNumber && jQuery.isNumeric(lastNumber))
    {
        lastNumber = lastNumber;
    } else {
        lastNumber = 1;
    }

    jQuery(document).ready(function () {

        jQuery(".lightbox").click(function () {
            dataIndex = jQuery(this).index();
          //  dataIndex = dataIndex + (lastNumber - 1) * <?php // echo $total_posts ?>;
            gallerySwiper = new Swiper('.mySwiper-lightbox', {
                grabCursor: true,
                observer: true,
                observeParents: true,
                navigation: {
                    nextEl: ".swiper-button-next-lightbox-gallery",
                    prevEl: ".swiper-button-prev-lightbox-gallery",
                },

                autoHeight: true,
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                initialSlide: dataIndex,
                slideToClickedSlide: false,
                on: {
                    init: function () {
                        jQuery(".mySwiper-lightbox").css("visibility", "visible");
                    },
                    beforeDestroy: function () {
                        jQuery(".mySwiper-lightbox").css("visibility", "hidden");
                    }
                }

            });
        });
        jQuery("#Gallery-lightBox").on('hide.bs.modal', function () {
            gallerySwiper.destroy();
        });
    });

</script>