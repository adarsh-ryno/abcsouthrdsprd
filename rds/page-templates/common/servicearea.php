<?php
$get_rds_template_data_array = RDS_TEMPLATE_DATA;
$service_areas =
	$get_rds_template_data_array["globals"]["footer"]["service_areas"];
?>
<div class="container-fluid pb-4 check-location">
   <div class="container">
      <div class="row">
         <div data-dark-color="color_primary" data-light-color="true_white"  class="apply-conditional-color col-lg-12 text-lg-start text-center our-locations cursor-pointer border-top-light border-bottom-light">
            <span class="text-decoration-none  h4 locations_footer d-flex justify-content-between w-100 text_bold py-4">
            <h4 class="text-capitalize d-inline-block mb-0">Service Area</h4> 
            <i id="plus" aria-hidden="true" class="icon icon-plus1 text_25 ml-2 align-self-center position-relative" style="top:-2px"></i>
            </span>
            <div class="location text-center text-lg-start">
              <div class="row pb-4">
               <?php
               $processed_ids = [];
               foreach ($service_areas as $value) {
               	$pageids = $value["page_ids"];
               	$pageids = array_diff($pageids, $processed_ids);
               	$location_ids = $value["location_ids"];
               	if (!empty($location_ids)) {
               		$get_locationid = implode(",", $location_ids);
               		if (!empty($pageids) && is_page($pageids)) {
               			$processed_ids = array_merge(
               				$processed_ids,
               				$pageids
               			);
               			echo do_shortcode(
               				'[bc-location page_id="' . $get_locationid . '"]'
               			);
               		}
               	}
               }
               ?>
              </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   jQuery(document).ready(function(){
      if(jQuery('.check-location').find('.col-lg-3').hasClass('text-center') == false){
         jQuery('.check-location').hide();
      }
   });
</script>