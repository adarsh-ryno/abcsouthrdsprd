<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Understrap
 */
// Exit if accessed directly.
defined("ABSPATH") || exit();

$bootstrap_version = get_theme_mod(
	"understrap_bootstrap_version",
	"bootstrap5"
);
$navbar_type = get_theme_mod("understrap_navbar_type", "collapse");
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/favicon.ico">
        <link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/favicon-16x16.png">
        <link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/favicon-32x32.png">
        <link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/apple-touch-icon.png">
        <link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/android-chrome-192x192.png">
        <link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/android-chrome-512x512.png">
        <?php do_action("rds_head_top"); ?>
        <meta charset="<?php bloginfo("charset"); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <meta name="format-detection" content="telephone=no">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <?php wp_head(); ?>

    
    </head>

    <body <?php body_class(); ?> <?php understrap_body_attributes(); ?>>
        <?php wp_body_open(); ?>
        <?php  ?>
 
