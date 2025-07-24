<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined("ABSPATH") || exit(); ?>
<div class="col-lg-12 mt-4">
    <div class="card rounded-0 p-2 blogs">
		<div class="card-head">
		<h2 class="text-uppercase bc_font_alt_1 px-4 mt-5"><?php esc_html_e(
  	"Nothing Found",
  	"understrap"
  ); ?></h2>
		</div>
		<div class="card-body px-0 py-2">
		<p class="mb-2"><?php esc_html_e(
  	"Sorry, but nothing matched your search terms. Please try again with some different keywords.",
  	"understrap"
  ); ?></p>
		</div>
    </div>
</div>