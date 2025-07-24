<?php
/**
 * The template for displaying all pages
 * Template Name: images found Template
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template test.
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined("ABSPATH") || exit();
global $post;
$title = $post->post_title;
get_header();

$get_rds_template_data_array = rds_template();
?>

<main>
          

                         
                            <?php 
                            require_once dirname(__FILE__) . '/inc/img-compare.php';
                            ?>
            

    </main>
<?php get_footer();
?>
