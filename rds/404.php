<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined("ABSPATH") || exit();
get_header();
$get_rds_template_data_array = RDS_TEMPLATE_DATA;
?>
<main>

<?php
if (isset($get_rds_template_data_array["globals"]["404"]["variation"])) {
    $variation = $get_rds_template_data_array["globals"]["404"]["variation"];

    if ($variation == "a") {
        get_template_part("global-templates/404/a", null, $get_rds_template_data_array);
    } elseif ($variation == "b") {
        get_template_part("global-templates/404/b", null, $get_rds_template_data_array);
    }
}
?>

</main>
<?php get_footer(); ?>
