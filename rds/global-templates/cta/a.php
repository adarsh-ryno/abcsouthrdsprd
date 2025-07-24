<?php
   $heading = !empty( $args["globals"]["in_content_cta"]["heading"] ) ?  $args["globals"]["in_content_cta"]["heading"] : '';
   $title_class = !empty( $args["globals"]["in_content_cta"]["title_class"] ) ?  $args["globals"]["in_content_cta"]["title_class"] : '';
   $button_class = !empty( $args["globals"]["in_content_cta"]["button_class"] ) ?  $args["globals"]["in_content_cta"]["button_class"] : '';
   $buttonText = !empty( $args["globals"]["in_content_cta"]["button_text"] ) ?  $args["globals"]["in_content_cta"]["button_text"] : '';
   $buttonLink = !empty( $args["globals"]["in_content_cta"]["button_link"] ) ?  $args["globals"]["in_content_cta"]["button_link"] : '';
   $phone_number = !empty($args["globals"]["in_content_cta"]["phone"])
	? $args["globals"]["in_content_cta"]["phone"]
	: $args["site_info"]["phone"];
   $telLink = $args["site_info"]["country_code"] . $phone_number;
   $target = $args["globals"]["in_content_cta"]["target"] == "true" ? "_blank" : "_self";
   $schedule_id = "";
   if (isset($args["globals"]["in_content_cta"]["id"]) && !empty($args["globals"]["in_content_cta"]["id"]) && ($args["globals"]["in_content_cta"]["id"] == "service_titan" || $args["globals"]["in_content_cta"]["id"] == "schedule_engine")) {
       $href = "javascript:void(0)";
       $schedule_id = $args["globals"]["in_content_cta"]["id"];
       $target = "_self";
       if ($schedule_id == "schedule_engine") {
           $id = "schedule_cta_schedule_engine";
       } elseif ($schedule_id == "service_titan") {
           $id = "schedule_cta_service_titan";
       }
   } elseif (isset($args["globals"]["in_content_cta"]["button_link"]) && empty($args["globals"]["in_content_cta"]["id"])) {
       $id = "";
       $href = get_home_url() . $buttonLink;
   } else {
       $schedule_id = $args["globals"]["in_content_cta"]["id"];
       if ($schedule_id == "service_titan" || $schedule_id == "schedule_engine") {
           $href = "javascript:void(0)";
           if ($schedule_id == "schedule_engine") {
               $id = "schedule_cta_schedule_engine";
           } elseif ($schedule_id == "service_titan") {
               $id = "schedule_cta_service_titan";
           }
       } else {
           $id = "";
           $href = get_home_url() . $buttonLink;
       }
   }
   if ($schedule_id == "schedule_engine") {
       add_action("wp_footer", function () {
   ?>
<script type="text/javascript">
   jQuery(".schedule_cta_schedule_engine").click(function () {
       console.log("schedule_engine");
       if (typeof ScheduleEngine !== "undefined" && ScheduleEngine) {
           ScheduleEngine.show();
       }
   });
</script>
<?php
   });
   } elseif ($schedule_id == "service_titan") {
   add_action("wp_footer", function () {
   ?>
<script type="text/javascript">
   jQuery(".schedule_cta_service_titan").click(function () {
       console.log("service_titan");
       if (typeof STWidgetManager !== "undefined" && STWidgetManager) {
           STWidgetManager("ws-open");
       }
   });
</script>
<?php
});
}
$telephone_class = !empty( $args["globals"]["in_content_cta"]["telephone_class"] ) ?  $args["globals"]["in_content_cta"]["telephone_class"] : '';
$icon_class = !empty( $args["globals"]["in_content_cta"]["icon_class"] ) ?  $args["globals"]["in_content_cta"]["icon_class"] : '';
$counteyCode = !empty( $args["site_info"]["country_code"] ) ?  $args["site_info"]["country_code"] : '';
$backgroungImage = get_exist_image_url("in-content-cta", "in-content-bg");

echo '
<span  class="max_w_730 d-block no_hover_underline mb-4">
   <div class="got-an-emergency py-sm-2 py-3 px-sm-4 px-4 text-start rounded-10" >
      <div class="row align-items-center py-lg-4 px-lg-0 px-3 pb-4 pt-2">
         <div class="col-sm-12 col-lg-6 align-items-center py-lg-3 border-right-lg-2 pb-4 border-bottom-md-2 px-0 px-lg-3 mb-lg-0 mb-4 pe-lg-0">
            <span class="heading_title ' . $title_class . ' d-block true_white mb-0 no_hover_underline text_25 line_height_25 font_default text_bold ps-lg-3 sm_text_24 sm_line_height_29">' . $heading . '</span> 
            <a class="cta_call_link no_hover_underline ' . $telephone_class . ' " href="tel:' . $counteyCode . $telLink . '"><span class="a-alt d-block mb-0 no_hover_underline text_30 line_height_41 sm_text_36 sm_line_height_45 font_default ps-lg-3 pb-0">' . $telLink . '</span></a>
         </div>
         <div class=" ' . $button_class . ' col-sm-12 col-lg-6 text-lg-center pl-0 py-lg-3 px-lg-0 px-0">
            <a id="" class="' . $id . ' no_hover_underline cta_link d-lg-inline-block d-none" href="' . $href . '" target="' . $target . '">
               <div class="text_25 line_height_30 font_default  d-block text_bold no_hover_underline pe-lg-3  true_white sm_text_24 sm_line_height_29 text-capitalize">' . $buttonText . '<i class=" ' . $icon_class . ' text_18 ms-2 line_height_18"></i></div>
            </a>
            <a id="" class=" ' . $id . ' cta_link no_hover_underline d-lg-none" href="' . $href . '" target="' . $target . '">
               <div class="text_25 line_height_30 font_default  d-block text_bold no_hover_underline pe-lg-3 sm_text_24 sm_line_height_29 true_white text-capitalize">' . $buttonText . '<i class=" ' . $icon_class . ' text_18 ms-2 line_height_18"></i></div>
            </a>
         </div>
      </div>
   </div>
</span>
';