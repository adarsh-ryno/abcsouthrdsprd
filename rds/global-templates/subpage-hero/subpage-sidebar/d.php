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
	'[custom-bg-srcset class="subpage_banner" img1x="' .
		$img1x .
		'" img2x="' .
		$img2x .
		'" img3x="' .
		$img3x .
		'" size1x="cover" size2x="cover" size3x="cover"]'
); ?>
<div class="container-fluid subpage_banner py-5" >
            <div class="container px-0 py-md-5">
                <div class="row py-2 py-lg-5 my-lg-5">
                    <div class="col-md-10 offset-md-1 py-3 py-lg-5">  
                    </div>
                </div>
            </div>
        </div>