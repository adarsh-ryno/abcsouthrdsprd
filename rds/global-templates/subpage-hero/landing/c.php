        <div class="container-fluid subpage_banner">
            <div class="row">
                <div class="col-md-4 px-0 pe-md-3 ps-md-0">  
                <?php
                //exaple how to set image sizewise
                // ['dektop', 'ipad', 'mobile']

                $img1x = [
                	get_exist_image_url(
                		"subpage-hero",
                		"subpage-banner-b-first"
                	),
                	get_exist_image_url(
                		"subpage-hero",
                		"subpage-banner-b-first"
                	),
                	get_exist_image_url(
                		"subpage-hero",
                		"subpage-banner-b-first"
                	),
                ];

                $img2x = [
                	get_exist_image_url(
                		"subpage-hero",
                		"subpage-banner-b-first"
                	),
                	get_exist_image_url(
                		"subpage-hero",
                		"subpage-banner-b-first"
                	),
                	get_exist_image_url(
                		"subpage-hero",
                		"subpage-banner-b-first"
                	),
                ];

                $img3x = [
                	get_exist_image_url(
                		"subpage-hero",
                		"subpage-banner-b-first"
                	),
                	get_exist_image_url(
                		"subpage-hero",
                		"subpage-banner-b-first"
                	),
                	get_exist_image_url(
                		"subpage-hero",
                		"subpage-banner-b-first"
                	),
                ];

                $img1x = Implode(",", $img1x);
                $img2x = Implode(",", $img2x);
                $img3x = Implode(",", $img3x);
                ?>
                    <?php echo do_shortcode(
                    	'[custom-bg-srcset class="subpage-banner-b-first" img1x="' .
                    		$img1x .
                    		'" img2x="' .
                    		$img2x .
                    		'" img3x="' .
                    		$img3x .
                    		'" size1x="cover" size2x="cover" size3x="cover"]'
                    ); ?>
                    <div class="py-lg-5 py-4 subpage-banner-b-first">
                        <div class="py-md-5 my-lg-4"></div>
                    </div>
                </div>
                <div class="col-md-4 px-0 px-md-2"> 
                <?php
                //exaple how to set image sizewise
                // ['dektop', 'ipad', 'mobile']

                $img1x = [
                	get_exist_image_url(
                		"subpage-hero",
                		"subpage-banner-b-second"
                	),
                	get_exist_image_url(
                		"subpage-hero",
                		"subpage-banner-b-second"
                	),
                	get_exist_image_url(
                		"subpage-hero",
                		"subpage-banner-b-second"
                	),
                ];

                $img2x = [
                	get_exist_image_url(
                		"subpage-hero",
                		"subpage-banner-b-second"
                	),
                	get_exist_image_url(
                		"subpage-hero",
                		"subpage-banner-b-second"
                	),
                	get_exist_image_url(
                		"subpage-hero",
                		"subpage-banner-b-second"
                	),
                ];

                $img3x = [
                	get_exist_image_url(
                		"subpage-hero",
                		"subpage-banner-b-second"
                	),
                	get_exist_image_url(
                		"subpage-hero",
                		"subpage-banner-b-second"
                	),
                	get_exist_image_url(
                		"subpage-hero",
                		"subpage-banner-b-second"
                	),
                ];

                $img1x = Implode(",", $img1x);
                $img2x = Implode(",", $img2x);
                $img3x = Implode(",", $img3x);
                ?>
                    <?php echo do_shortcode(
                    	'[custom-bg-srcset class="subpage-banner-b-second" img1x="' .
                    		$img1x .
                    		'" img2x="' .
                    		$img2x .
                    		'" img3x="' .
                    		$img3x .
                    		'" size1x="cover" size2x="cover" size3x="cover"]'
                    ); ?>
                    <div class="py-lg-5 py-4 subpage-banner-b-second">
                        <div class="py-md-5 my-lg-4"></div>
                    </div> 
                </div>
                <div class="col-md-4 px-0 ps-md-3 pe-md-0">  
                <?php
                //exaple how to set image sizewise
                // ['dektop', 'ipad', 'mobile']

                $img1x = [
                	get_exist_image_url(
                		"subpage-hero",
                		"subpage-banner-b-third"
                	),
                	get_exist_image_url(
                		"subpage-hero",
                		"subpage-banner-b-third"
                	),
                	get_exist_image_url(
                		"subpage-hero",
                		"subpage-banner-b-third"
                	),
                ];

                $img2x = [
                	get_exist_image_url(
                		"subpage-hero",
                		"subpage-banner-b-third"
                	),
                	get_exist_image_url(
                		"subpage-hero",
                		"subpage-banner-b-third"
                	),
                	get_exist_image_url(
                		"subpage-hero",
                		"subpage-banner-b-third"
                	),
                ];

                $img3x = [
                	get_exist_image_url(
                		"subpage-hero",
                		"subpage-banner-b-third"
                	),
                	get_exist_image_url(
                		"subpage-hero",
                		"subpage-banner-b-third"
                	),
                	get_exist_image_url(
                		"subpage-hero",
                		"subpage-banner-b-third"
                	),
                ];

                $img1x = Implode(",", $img1x);
                $img2x = Implode(",", $img2x);
                $img3x = Implode(",", $img3x);
                ?>
                    <?php echo do_shortcode(
                    	'[custom-bg-srcset class="subpage-banner-b-third" img1x="' .
                    		$img1x .
                    		'" img2x="' .
                    		$img2x .
                    		'" img3x="' .
                    		$img3x .
                    		'" size1x="cover" size2x="cover" size3x="cover"]'
                    ); ?>
                    <div class="py-lg-5 py-4 subpage-banner-b-third">
                        <div class="py-md-5 my-lg-4"></div>
                    </div>
                </div>
            </div>
        </div>