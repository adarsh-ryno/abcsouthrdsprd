<?php
/**
 * Sidebar - subpage rightside setup.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined("ABSPATH") || exit();
$get_rds_template_data_array = RDS_TEMPLATE_DATA;
$temName = basename(get_page_template());
?>
 <div class="col-lg-4 px-lg-3 pt-lg-0 pt-4 px-0 order-lg-2 order-2 overflow-hidden sidebar"> 
    <div class="d-flex flex-column w-100"><?php
//dynamic_sidebar( 'subpagerightsidebar' );
?>
    <?php
    //Sidebar Contact Form Section
    if ($temName == "rds-service-subpage-sidebar.php") {
    	if (
    		$get_rds_template_data_array["page_templates"]["service_subpage"][
    			"sidebar"
    		]["request_service"]["variation"] == "a" &&
    		$get_rds_template_data_array["page_templates"]["service_subpage"][
    			"sidebar"
    		]["request_service"]["enable"]
    	) {
    		get_template_part(
    			"global-templates/form/service-subpage/a",
    			null,
    			$get_rds_template_data_array
    		);
    	} elseif (
    		$get_rds_template_data_array["page_templates"]["service_subpage"][
    			"sidebar"
    		]["request_service"]["variation"] == "b" &&
    		$get_rds_template_data_array["page_templates"]["service_subpage"][
    			"sidebar"
    		]["request_service"]["enable"]
    	) {
    		get_template_part(
    			"global-templates/form/service-subpage/b",
    			null,
    			$get_rds_template_data_array
    		);
    	} elseif (
    		$get_rds_template_data_array["page_templates"]["service_subpage"][
    			"sidebar"
    		]["request_service"]["variation"] == "c" &&
    		$get_rds_template_data_array["page_templates"]["service_subpage"][
    			"sidebar"
    		]["request_service"]["enable"]
    	) {
    		get_template_part(
    			"global-templates/form/service-subpage/c",
    			null,
    			$get_rds_template_data_array
    		);
    	}
    } else {
    	if (
    		$get_rds_template_data_array["page_templates"]["subpage"][
    			"sidebar"
    		]["request_service"]["variation"] == "a" &&
    		$get_rds_template_data_array["page_templates"]["subpage"][
    			"sidebar"
    		]["request_service"]["enable"]
    	) {
    		get_template_part(
    			"global-templates/form/subpage/a",
    			null,
    			$get_rds_template_data_array
    		);
    	} elseif (
    		$get_rds_template_data_array["page_templates"]["subpage"][
    			"sidebar"
    		]["request_service"]["variation"] == "b" &&
    		$get_rds_template_data_array["page_templates"]["subpage"][
    			"sidebar"
    		]["request_service"]["enable"]
    	) {
    		get_template_part(
    			"global-templates/form/subpage/b",
    			null,
    			$get_rds_template_data_array
    		);
    	} elseif (
    		$get_rds_template_data_array["page_templates"]["subpage"][
    			"sidebar"
    		]["request_service"]["variation"] == "c" &&
    		$get_rds_template_data_array["page_templates"]["subpage"][
    			"sidebar"
    		]["request_service"]["enable"]
    	) {
    		get_template_part(
    			"global-templates/form/subpage/c",
    			null,
    			$get_rds_template_data_array
    		);
    	}
    }

    if ($temName != "page.php" || is_single()) {
    	//Sidebar Promotion Section
    	if (
    		$get_rds_template_data_array["globals"]["promotion"]["variation"] ==
    			"a" &&
    		$get_rds_template_data_array["globals"]["promotion"]["enable"]
    	) {
    		get_template_part(
    			"global-templates/promotion/sidebar/a",
    			null,
    			$get_rds_template_data_array
    		);
    	} elseif (
    		$get_rds_template_data_array["globals"]["promotion"]["variation"] ==
    			"b" &&
    		$get_rds_template_data_array["globals"]["promotion"]["enable"]
    	) {
    		get_template_part(
    			"global-templates/promotion/sidebar/b",
    			null,
    			$get_rds_template_data_array
    		);
    	} elseif (
    		$get_rds_template_data_array["globals"]["promotion"]["variation"] ==
    			"c" &&
    		$get_rds_template_data_array["globals"]["promotion"]["enable"]
    	) {
    		get_template_part(
    			"global-templates/promotion/sidebar/c",
    			null,
    			$get_rds_template_data_array
    		);
    	}
    }
    if ($temName == "rds-service-subpage-sidebar.php") {
    	//Sidebar Our Service Section
    	if (
    		$get_rds_template_data_array["globals"]["services"] &&
    		$get_rds_template_data_array["globals"]["services"]["enable"]
    	) {
    		get_template_part(
    			"global-templates/services/sidebar/a",
    			null,
    			$get_rds_template_data_array
    		);
    	}
    } else {
    	//Sidebar Easy Finacing Section
    	if (
    		$get_rds_template_data_array["page_templates"]["subpage"][
    			"sidebar"
    		]["financing"] &&
    		$get_rds_template_data_array["page_templates"]["subpage"][
    			"sidebar"
    		]["financing"]["enable"] == true
    	) {
    		get_template_part(
    			"global-templates/easy-financing/subpage-sidebar/a",
    			null,
    			$get_rds_template_data_array
    		);
    	}
    }
    /*Elementor Dynamic sidebar Start*/
    dynamic_sidebar("elementor-sidebar");

/*Elementor Dynamic Sidebar Ends*/
?>   
</div>
</div> 