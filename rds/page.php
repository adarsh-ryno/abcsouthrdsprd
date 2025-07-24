<?php
/**
 * The template for displaying all pages
 *
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
if (function_exists('rds_template')) {
    $get_rds_template_data_array = RDS_TEMPLATE_DATA;
}
?>

<main>
          

                         
                            <?php if (have_posts()):
                            	while (have_posts()):
                            		the_post();
                            		the_content();
                            	endwhile;
                            endif; ?>
            

    </main>
<?php get_footer();
?>
