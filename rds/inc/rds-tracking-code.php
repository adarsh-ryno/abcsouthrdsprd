<?php

// Global Header Tracking Code
add_action("wp_head", "rds_global_head_tracking_code");
function rds_global_head_tracking_code()
{
	$get_rds_tracking_code = rds_tracking(); ?>
	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $get_rds_tracking_code[
 	"tracking"
 ]["Google"]["AW-CODE"]; ?>"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', "<?php echo $get_rds_tracking_code["tracking"]["Google"][
 	"UA-CODE"
 ]; ?>");
	gtag('config', "<?php echo $get_rds_tracking_code["tracking"]["Google"][
 	"AW-CODE"
 ]; ?>");
	gtag('config', "<?php echo $get_rds_tracking_code["tracking"]["Google"][
 	"GA4-CODE"
 ]; ?>");

	</script>

   <!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo $get_rds_tracking_code[
 	"tracking"
 ]["Google_Tag_Manager"]["GTM_CODE"]; ?>"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->

	<!-- Facebook Pixel Code -->
	<script>
	  !function(f,b,e,v,n,t,s)
	  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	  n.queue=[];t=b.createElement(e);t.async=!0;
	  t.src=v;s=b.getElementsByTagName(e)[0];
	  s.parentNode.insertBefore(t,s)}(window, document,'script',
	  'https://connect.facebook.net/en_US/fbevents.js');
	  fbq('init', "<?php echo $get_rds_tracking_code["tracking"]["Facebook_Pixel"][
   	"FACEBOOK_ID"
   ]; ?>"
	  	);
	  fbq('track', 'PageView');
	</script>
	<noscript>
	  <img height="1" width="1" style="display:none" 
	       src="https://www.facebook.com/tr?id=<?php echo $get_rds_tracking_code[
        	"tracking"
        ]["Facebook_Pixel"]["FACEBOOK_ID"]; ?>&ev=PageView&noscript=1"/>
	</noscript>
	<!-- End Facebook Pixel Code -->
	<!-- End Bing Pixel Code -->
	<script>
	(function(w,d,t,r,u){var f,n,i;w[u]=w[u]||[] ,f=function(){var o={ti:"<?php echo $get_rds_tracking_code[
 	"tracking"
 ]["Bing_Ads_Pixel"][
 	"BING_ID"
 ]; ?>"}; o.q=w[u],w[u]=new UET(o),w[u].push("pageLoad")} ,n=d.createElement(t),n.src=r,n.async=1,n.onload=n .onreadystatechange=function() {var s=this.readyState;s &&s!=="loaded"&& s!=="complete"||(f(),n.onload=n. onreadystatechange=null)},i= d.getElementsByTagName(t)[0],i. parentNode.insertBefore(n,i)})(window,document,"script"," //bat.bing.com/bat.js","uetq");
	</script>
	<!-- End Bing Pixel Code -->

<?php
}

// Global Footer Tracking Code
add_action("wp_footer", "rds_global_footer_tracking_code");
function rds_global_footer_tracking_code()
{
	$get_rds_tracking_code = rds_tracking(); ?>

	<!-- Hotjar Tracking Code -->
	<script>
	    (function(h,o,t,j,a,r){
	        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
	        h._hjSettings={hjid:<?php echo $get_rds_tracking_code["tracking"][
         	"Hotjar"
         ]["id"]; ?>,hjsv:6};
	        a=o.getElementsByTagName('head')[0];
	        r=o.createElement('script');r.async=1;
	        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
	        a.appendChild(r);
	    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
	</script>
   
<?php
}

// Per Page Header Tracking Code
add_action("wp_head", "rds_per_page_header_tracking_code");
function rds_per_page_header_tracking_code()
{
	$get_rds_tracking_code = rds_tracking();
}

// Per Page Footer Tracking Code
add_action("wp_footer", "rds_per_page_footerr_tracking_code");
function rds_per_page_footerr_tracking_code()
{
	$get_rds_tracking_code = rds_tracking();
}
