<?php

/**
 * UnderStrap functions and definitions
 *
 * @package Understrap
 */
// Exit if accessed directly.


global $rdsTemplateDataGlobal;
defined("ABSPATH") || exit(); 

define( 'POLARIS_RDS_VERSION', '4.0' );
if (file_exists(ABSPATH . '/version_control/plugin-update-checker/plugin-update-checker.php')) {
    require_once(ABSPATH . '/version_control/plugin-update-checker/plugin-update-checker.php');
}
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;
if (defined('RDS_MAIN_THEME_REPO') && defined('GIT_BRANCH') && defined('GIT_AUTHENTICATION')) {
$myUpdateChecker = PucFactory::buildUpdateChecker(
    RDS_MAIN_THEME_REPO,
    __FILE__,
    'polaris-rds'
);
 // Optional, if you want to check updates from a specific branch
$myUpdateChecker->setBranch(GIT_BRANCH); 

$myUpdateChecker->setAuthentication(GIT_AUTHENTICATION); // Optional, if your repository is private
}

if (!defined('RDS_TEMPLATE_DATA')) {
    // Define the constant and assign a value
    define('RDS_TEMPLATE_DATA', json_decode(get_option("rds_template"), true));
    $rdsTemplateDataGlobal = RDS_TEMPLATE_DATA;
}
if (!defined('RDS_ALT_DATA')) {
    // Define the constant and assign a value
    define('RDS_ALT_DATA', json_decode(get_option("rds_alt_text"), true));
}

// UnderStrap's includes directory.
$understrap_inc_dir = "inc";

// Array of files to include.
$understrap_includes = [
    "/theme-settings.php", // Initialize theme default settings.
    "/setup.php", // Theme setup and custom theme supports.
    "/widgets.php", // Register widget area.
    "/enqueue.php", // Enqueue scripts and styles.
    "/template-tags.php", // Custom template tags for this theme.
    "/pagination.php", // Custom pagination for this theme.
    "/hooks.php", // Custom hooks.
    "/extras.php", // Custom functions that act independently of the theme templates.
    "/customizer.php", // Customizer additions.
    "/custom-comments.php", // Custom Comments file.
    "/class-wp-bootstrap-navwalker.php", // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/understrap/understrap/issues/567.
    "/class-wp-bc-navwalker.php",
    "/editor.php", // Load Editor functions.
    "/block-editor.php", // Load Block Editor functions.
    "/deprecated.php", // Load deprecated functions.
    '/type_A_navwalker.php',                // Load mobile nav functions
    "/blog-slider.php", // Blog Slider
    "/custom-page-fields.php", // Page fields
    "/custom-post-type.php", // Post type
    "/custom-functions.php",
    "/custom-shortcode-function.php",
    "/flush-cache-endpoint.php", // Clear cache
    "/rds-elementor-widgets.php",
];

// Include files.
foreach ($understrap_includes as $file) {
    require_once get_theme_file_path($understrap_inc_dir . $file);
}

$understrap_include = [
    // '/bc-shortcode-override.php',
    // '/widgets/bc-footer-logo-widget.php',
    //  '/widgets/bc-easy-financings-widget.php',
    //  '/bc-promotion-override.php',
    // '/scssphp/scss.inc.php'
];
// foreach ($understrap_include as $file) {
//     $filepath = locate_template("inc" . $file);
//     if (!$filepath) {
//         trigger_error(sprintf("Error locating /inc%s for inclusion", $file), E_USER_ERROR);
//     }
//     require_once $filepath;
// }

// Prevent WP from adding <p> tags on all post types
// function disable_wp_auto_p($content) {
//     remove_filter('the_content', 'wpautop');
//     return $content;
// }

// add_filter('the_content', 'disable_wp_auto_p', 0);

//Gravity Forms Button HTML Start
add_filter("gform_submit_button", "rds_gravity_submit_button", 10, 2);

function rds_gravity_submit_button($button, $form)
{
    $rdS_template = RDS_TEMPLATE_DATA;
    $header_variation = $rdS_template["globals"]["hero"]["variation"];
    $request_service = $rdS_template["globals"]["request_service"]["variation"];
    if ($request_service == "a" || $header_variation == "a") { ?>
        <script>
        //Select Option Script
            var x, i, j, selElmnt, a, b, c;
            /*look for any elements with the class "custom-select":*/
            function bc_update_select_design() {
                x = document.querySelectorAll(".dropdown-select .ginput_container_select");
                for (i = 0; i < x.length; i++) {
                    selElmnt = x[i].getElementsByTagName("select")[0];
                    /*for each element, create a new DIV that will act as the selected item:*/
                    a = document.createElement("DIV");
                    a.setAttribute("class", "select-selected rounded-0");
                    a.setAttribute("tabindex", 0);
                    a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
                    x[i].appendChild(a);
                    /*for each element, create a new DIV that will contain the option list:*/
                    b = document.createElement("DIV");
                    b.setAttribute("class", "select-items select-hide");
                    for (j = 1; j < selElmnt.length; j++) {
                        /*for each option in the original select element,
                         create a new DIV that will act as an option item:*/
                        c = document.createElement("DIV");
                        c.innerHTML = selElmnt.options[j].innerHTML;
                        b.appendChild(c);
                    }
                    x[i].appendChild(b);
                    /*For form keydown and up*/
                }
            }
            function closeAllSelect(elmnt) {
                // console.log('click');
                /*a function that will close all select boxes in the document,
                 except the current select box:*/
                var x, y, i, arrNo = [];
                x = document.getElementsByClassName("select-items");
                y = document.getElementsByClassName("select-selected");
                for (i = 0; i < y.length; i++) {
                    if (elmnt == y[i]) {
                        arrNo.push(i);
                    } else {
                        y[i].classList.remove("select-arrow-active");
                    }
                }
                for (i = 0; i < x.length; i++) {
                    if (arrNo.indexOf(i)) {
                        x[i].classList.add("select-hide");
                    }
                }
            }
            /*if the user clicks anywhere outside the select box,
             then close all select boxes:*/

            window.onload = (event) => {
                bc_update_select_design();
                document.addEventListener("click", closeAllSelect);
            };
        </script>
        <?php wp_enqueue_script("rds-select-script", get_template_directory_uri() . "/src/js/custom-select-option.js", array('jquery'), true);}
    return "<div class='text-center pt-2'><button class='btn btn-primary min-w-182 h-lg-52 w-lg-100 rds_gform_submit' id='gform_submit_button_{$form["id"]}'>" . $form["button"]["text"] . "</button></div>";
}

//Gravity Forms Button HTML End
add_filter("use_widgets_block_editor", "__return_false");

add_rewrite_rule(
    '^careers/([^/]+)/?$',

    'index.php?job=$matches[1]',

    "top"
);

add_filter(
    "post_type_link",
    function ($post_link, $post, $leavename, $sample) {
        if ($post->post_type === "job") {
            $post_link = str_replace("/blog/careers/", "/careers/", $post_link);
        }

        return $post_link;
    },
    10,
    4
);

// Make sure Elementor is active and the Template class is available.
if (defined("ELEMENTOR_PATH") && class_exists("ElementorPro\Modules\ThemeBuilder\Classes\Template")) {
    $post_id = 41018; // Replace with the actual post ID where your Elementor template is applied.

    // Get the Elementor template associated with the post ID.
    $template = \ElementorPro\Modules\ThemeBuilder\Classes\Template::get_template($post_id);

    if ($template) {
        // You can now access the template's postmeta data using standard WordPress functions.
        $template_postmeta = get_post_meta($template->get_id(), "your_meta_key", true);

        // Do something with the postmeta data.
        echo $template_postmeta;
    }
}

function custom_back_to_link_shortcode()
{
    $archive_url = get_permalink(get_option("page_for_posts"));

    $link_html = '<a name="Back to Blog" href="' . esc_url($archive_url) . '" class="no_hover_underline d-inline-flex align-items-center button mb-3 back_to_blog">';
    $link_html .= '<i class="bc_line_height_18 icon-chevron-left2 me-1 position-relative"></i>';
    $link_html .= "Back to Blog";
    $link_html .= "</a>";

    return $link_html;
}
add_shortcode("custom_back_to_link", "custom_back_to_link_shortcode");

function enqueue_custom_styles_scripts() {
    $template_dir = get_template_directory();
    $template_uri = get_template_directory_uri();

    // Register and enqueue styles
    wp_enqueue_style('rds-swiper', $template_uri . '/css/swiper-bundle.min.css', array(), filemtime($template_dir . '/css/swiper-bundle.min.css'));
    // Register and enqueue scripts
    wp_enqueue_script('rds-swiper-script', $template_uri . '/js/swiper-bundle.min.js', array('jquery'), filemtime($template_dir . '/js/swiper-bundle.min.js'));
}

add_action("wp_enqueue_scripts", "enqueue_custom_styles_scripts");

function add_custom_hook_to_head()
{
    do_action("rds_head_top");
}

add_action("wp_head", "add_custom_hook_to_head", 1);

function add_custom_hook_to_bottom()
{
    do_action("rds_head_bottom");
}

add_action("wp_head", "add_custom_hook_to_bottom");

function add_custom_hook_to_footer_top()
{
    do_action("rds_footer_top");
}

add_action("wp_footer", "add_custom_hook_to_footer_top", 1);

function add_custom_hook_to_footer_bottom()
{
    do_action("rds_footer_bottom");
}

add_action("wp_footer", "add_custom_hook_to_footer_bottom");

add_action("rds_head_top", "favicon_add");

function favicon_add()
{
    ?>
    <link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/favicon.ico">
    <link rel="icon" href="<?php echo get_exist_image_url('favicon', 'favicon-16x16'); ?>">
    <link rel="icon" href="<?php echo get_exist_image_url('favicon', 'favicon-32x32'); ?>">
    <link rel="icon" href="<?php echo get_exist_image_url('favicon', 'apple-touch-icon'); ?>">
    <link rel="icon" href="<?php echo get_exist_image_url('favicon', 'android-chrome-192x192'); ?>">
    <link rel="icon" href="<?php echo get_exist_image_url('favicon', 'android-chrome-512x512'); ?>">
<?php
}

//  function defined design spec to elementor Start
function update_dafaultfontfamily($key, $value, $json)
{
    if (array_key_exists($value, $json["defaults"]["fonts"])) {
        $fontFamily = $json["defaults"]["fonts"][$value];
        $parts = explode(",", $fontFamily);
        return $font = trim($parts[0]);
    } else {
        $parts = explode(",", $value);
        return $font = trim($parts[0]);
    }
}
function update_color_or_typography(&$setting, $id, $value)
{
    if (isset($setting["_id"]) && $setting["_id"] === $id) {
        $setting["color"] = $value;
    }
}

function update_font_family(&$setting, $title, $value, $Title)
{
    if (isset($setting["_id"]) && $setting["_id"] === $title) {
        $setting["typography_font_family"] = $value;
        //$setting["title"] = $Title;
    }
}
// function update_body(&$item, $hide_users, $heading_key) {
//     $item["{$heading_key}_typography_font_family"] = update_dafaultfontfamily($item["{$heading_key}_typography_font_family"],$hide_users['defaults']['typography'][$heading_key]['font_family'],$hide_users);
//     $item["{$heading_key}_typography_font_weight"] = $hide_users['defaults']['typography'][$heading_key]['font_weight'];
//     $item["{$heading_key}_typography_text_transform"] = $hide_users['defaults']['typography'][$heading_key]['text_transform'];
//     $item["{$heading_key}_typography_font_style"] = $hide_users['defaults']['typography'][$heading_key]['font_style'];
//     $item["{$heading_key}_typography_text_decoration"] = $hide_users['defaults']['typography'][$heading_key]['text_decoration'];
//     $item["{$heading_key}_color"] = $hide_users['defaults']['typography'][$heading_key]['color'];
//     $item["paragraph_spacing"] = $hide_users['defaults']['typography'][$heading_key]['paragraph_spacing'];
//     $item["{$heading_key}_typography_font_size"]['size'] = str_replace(range('a', 'z'), '', $hide_users['defaults']['typography'][$heading_key]['font_size']);
//     $item["{$heading_key}_typography_font_size"]['unit'] = str_replace(range('0', '9'), '', $hide_users['defaults']['typography'][$heading_key]['font_size']);
//     $item["{$heading_key}_typography_font_size_mobile"]['size'] = str_replace(range('a', 'z'), '', $hide_users['defaults']['typography'][$heading_key]['mobile']['font_size']);
//     $item["{$heading_key}_typography_font_size_mobile"]['unit'] = str_replace(range('0', '9'), '', $hide_users['defaults']['typography'][$heading_key]['mobile']['font_size']);

//     $item["{$heading_key}_typography_line_height"]['size'] = str_replace(range('a', 'z'), '', $hide_users['defaults']['typography'][$heading_key]['line_height']);
//     $item["{$heading_key}_typography_line_height"]['unit'] = str_replace(range('0', '9'), '', $hide_users['defaults']['typography'][$heading_key]['line_height']);
//     $item["{$heading_key}_typography_line_height_mobile"]['size'] = str_replace(range('a', 'z'), '', $hide_users['defaults']['typography'][$heading_key]['mobile']['line_height']);
//     $item["{$heading_key}_typography_line_height_mobile"]['unit'] = str_replace(range('0', '9'), '', $hide_users['defaults']['typography'][$heading_key]['mobile']['line_height']);
//     $item["{$heading_key}_typography_letter_spacing"]['size'] = str_replace(range('a', 'z'), '', $hide_users['defaults']['typography'][$heading_key]['letter_spacing']);
//     $item["{$heading_key}_typography_letter_spacing"]['unit'] = str_replace(range('0', '9'), '', $hide_users['defaults']['typography'][$heading_key]['letter_spacing']);
//     $item["{$heading_key}_typography_letter_spacing_mobile"]['size'] = str_replace(range('a', 'z'), '', $hide_users['defaults']['typography'][$heading_key]['mobile']['letter_spacing']);
//     $item["{$heading_key}_typography_letter_spacing_mobile"]['unit'] = str_replace(range('0', '9'), '', $hide_users['defaults']['typography'][$heading_key]['mobile']['letter_spacing']);

//     $item["{$heading_key}_typography_word_spacing"]['size'] = str_replace(range('a', 'z'), '', $hide_users['defaults']['typography'][$heading_key]['word_spacing']);
//     $item["{$heading_key}_typography_word_spacing"]['unit'] = str_replace(range('0', '9'), '', $hide_users['defaults']['typography'][$heading_key]['word_spacing']);
//     $item["{$heading_key}_typography_word_spacing_mobile"]['size'] = str_replace(range('a', 'z'), '', $hide_users['defaults']['typography'][$heading_key]['mobile']['word_spacing']);
//     $item["{$heading_key}_typography_word_spacing_mobile"]['unit'] = str_replace(range('0', '9'), '', $hide_users['defaults']['typography'][$heading_key]['mobile']['word_spacing']);
//     // ... update other typography settings ...
// }
function update_typography(&$item, $hide_users, $heading_key)
{
    $item["{$heading_key}_typography_font_family"] = update_dafaultfontfamily($item["{$heading_key}_typography_font_family"], $hide_users["defaults"]["typography"][$heading_key]["font_family"], $hide_users);
    $item["{$heading_key}_typography_font_weight"] = $hide_users["defaults"]["typography"][$heading_key]["font_weight"];
    $item["{$heading_key}_typography_text_transform"] = $hide_users["defaults"]["typography"][$heading_key]["text_transform"];
    $item["{$heading_key}_typography_font_style"] = $hide_users["defaults"]["typography"][$heading_key]["font_style"];
    $item["{$heading_key}_typography_text_decoration"] = $hide_users["defaults"]["typography"][$heading_key]["text_decoration"];
    $item["{$heading_key}_color"] = $hide_users["defaults"]["typography"][$heading_key]["color"];
    $item["{$heading_key}_typography_font_size"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["font_size"]);
    $item["{$heading_key}_typography_font_size"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["font_size"]);
    $item["{$heading_key}_typography_font_size_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["font_size"]);
    $item["{$heading_key}_typography_font_size_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["font_size"]);

    $item["{$heading_key}_typography_line_height"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["line_height"]);
    $item["{$heading_key}_typography_line_height"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["line_height"]);
    $item["{$heading_key}_typography_line_height_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["line_height"]);
    $item["{$heading_key}_typography_line_height_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["line_height"]);
    $item["{$heading_key}_typography_letter_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["letter_spacing"]);
    $item["{$heading_key}_typography_letter_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["letter_spacing"]);
    $item["{$heading_key}_typography_letter_spacing_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["letter_spacing"]);
    $item["{$heading_key}_typography_letter_spacing_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["letter_spacing"]);

    $item["{$heading_key}_typography_word_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["word_spacing"]);
    $item["{$heading_key}_typography_word_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["word_spacing"]);
    $item["{$heading_key}_typography_word_spacing_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["word_spacing"]);
    $item["{$heading_key}_typography_word_spacing_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["word_spacing"]);
    // ... update other typography settings ...
}
function update_typography_hero(&$item, $hide_users, $heading_key)
{
    // $item["{$heading_key}_typography_font_family"] = update_dafaultfontfamily($item["{$heading_key}_typography_font_family"], $hide_users["defaults"]["typography"][$heading_key]["font_family"], $hide_users);
    // $item["{$heading_key}_typography_font_weight"] = $hide_users["defaults"]["typography"][$heading_key]["font_weight"];
    // $item["{$heading_key}_typography_text_transform"] = $hide_users["defaults"]["typography"][$heading_key]["text_transform"];
    // $item["{$heading_key}_typography_font_style"] = $hide_users["defaults"]["typography"][$heading_key]["font_style"];
    // $item["{$heading_key}_typography_text_decoration"] = $hide_users["defaults"]["typography"][$heading_key]["text_decoration"];
    // $item["{$heading_key}_color"] = $hide_users["defaults"]["typography"][$heading_key]["color"];
     $item["{$heading_key}_bg_color"] = $hide_users["defaults"]["typography"][$heading_key]["banner_form_background"];
    // $item["{$heading_key}_typography_font_size"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["font_size"]);
    // $item["{$heading_key}_typography_font_size"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["font_size"]);
    // if (isset($hide_users["defaults"]["typography"][$heading_key]["mobile"]["font_size"])) {
    // $item["{$heading_key}_typography_font_size_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["font_size"]);
    // $item["{$heading_key}_typography_font_size_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["font_size"]);
    // }

    // $item["{$heading_key}_typography_line_height"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["line_height"]);
    // $item["{$heading_key}_typography_line_height"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["line_height"]);
    // if (isset($hide_users["defaults"]["typography"][$heading_key]["mobile"]["line_height"])) {
    // $item["{$heading_key}_typography_line_height_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["line_height"]);
    // $item["{$heading_key}_typography_line_height_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["line_height"]);
    // }
    // $item["{$heading_key}_typography_letter_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["letter_spacing"]);
    // $item["{$heading_key}_typography_letter_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["letter_spacing"]);
    // if (isset($hide_users["defaults"]["typography"][$heading_key]["mobile"]["letter_spacing"])) {
    // $item["{$heading_key}_typography_letter_spacing_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["letter_spacing"]);
    // $item["{$heading_key}_typography_letter_spacing_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["letter_spacing"]);
    // }

    // $item["{$heading_key}_typography_word_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["word_spacing"]);
    // $item["{$heading_key}_typography_word_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["word_spacing"]);
    // if (isset($hide_users["defaults"]["typography"][$heading_key]["mobile"]["word_spacing"])) {
    // $item["{$heading_key}_typography_word_spacing_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["word_spacing"]);
    // $item["{$heading_key}_typography_word_spacing_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["word_spacing"]);
   // }
    // ... update other typography settings ...
}
function update_typography_call(&$item, $hide_users, $heading_key)
{
    $item["{$heading_key}_typography_font_family"] = update_dafaultfontfamily($item["{$heading_key}_typography_font_family"], $hide_users["defaults"]["typography"][$heading_key]["font_family"], $hide_users);
    $item["{$heading_key}_typography_font_weight"] = $hide_users["defaults"]["typography"][$heading_key]["font_weight"];
    $item["{$heading_key}_typography_text_transform"] = $hide_users["defaults"]["typography"][$heading_key]["text_transform"];
    $item["{$heading_key}_typography_font_style"] = $hide_users["defaults"]["typography"][$heading_key]["font_style"];
    $item["{$heading_key}_typography_text_decoration"] = $hide_users["defaults"]["typography"][$heading_key]["text_decoration"];
    $item["{$heading_key}_color"] = $hide_users["defaults"]["typography"][$heading_key]["text_color"];
    $item["{$heading_key}_typography_font_size"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["font_size"]);
    $item["{$heading_key}_typography_font_size"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["font_size"]);
    if (isset($hide_users["defaults"]["typography"][$heading_key]["mobile"]["font_size"])) {
    $item["{$heading_key}_typography_font_size_mobile"]['size'] = str_replace(range('a', 'z'), '', $hide_users['defaults']['typography'][$heading_key]['mobile']['font_size']);
    $item["{$heading_key}_typography_font_size_mobile"]['unit'] = str_replace(range('0', '9'), '', $hide_users['defaults']['typography'][$heading_key]['mobile']['font_size']);
    }

    $item["{$heading_key}_typography_line_height"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["line_height"]);
    $item["{$heading_key}_typography_line_height"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["line_height"]);
    if (isset($hide_users["defaults"]["typography"][$heading_key]["mobile"]["line_height"])) {
    $item["{$heading_key}_typography_line_height_mobile"]['size'] = str_replace(range('a', 'z'), '', $hide_users['defaults']['typography'][$heading_key]['mobile']['line_height']);
    $item["{$heading_key}_typography_line_height_mobile"]['unit'] = str_replace(range('0', '9'), '', $hide_users['defaults']['typography'][$heading_key]['mobile']['line_height']);
    }
    $item["{$heading_key}_typography_letter_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["letter_spacing"]);
    $item["{$heading_key}_typography_letter_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["letter_spacing"]);
    if (isset($hide_users["defaults"]["typography"][$heading_key]["mobile"]["letter_spacing"])) {
    $item["{$heading_key}_typography_letter_spacing_mobile"]['size'] = str_replace(range('a', 'z'), '', $hide_users['defaults']['typography'][$heading_key]['mobile']['letter_spacing']);
    $item["{$heading_key}_typography_letter_spacing_mobile"]['unit'] = str_replace(range('0', '9'), '', $hide_users['defaults']['typography'][$heading_key]['mobile']['letter_spacing']);
    }

    $item["{$heading_key}_typography_word_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["word_spacing"]);
    $item["{$heading_key}_typography_word_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["word_spacing"]);
    if (isset($hide_users["defaults"]["typography"][$heading_key]["mobile"]["word_spacing"])) {
    $item["{$heading_key}_typography_word_spacing_mobile"]['size'] = str_replace(range('a', 'z'), '', $hide_users['defaults']['typography'][$heading_key]['mobile']['word_spacing']);
    $item["{$heading_key}_typography_word_spacing_mobile"]['unit'] = str_replace(range('0', '9'), '', $hide_users['defaults']['typography'][$heading_key]['mobile']['word_spacing']);
    }
    // ... update other typography settings ...
}
function update_typography_bar(&$item, $hide_users, $heading_key)
{
    $item["{$heading_key}_typography_font_family"] = update_dafaultfontfamily($item["{$heading_key}_typography_font_family"], $hide_users["defaults"]["typography"][$heading_key]["font_family"], $hide_users);
    $item["{$heading_key}_typography_font_weight"] = $hide_users["defaults"]["typography"][$heading_key]["font_weight"];
    $item["{$heading_key}_typography_text_transform"] = $hide_users["defaults"]["typography"][$heading_key]["text_transform"];
    $item["{$heading_key}_typography_font_style"] = $hide_users["defaults"]["typography"][$heading_key]["font_style"];
    $item["{$heading_key}_typography_text_decoration"] = $hide_users["defaults"]["typography"][$heading_key]["text_decoration"];
    $item["{$heading_key}_color"] = $hide_users["defaults"]["typography"][$heading_key]["text_color"];
    $item["{$heading_key}_hover_color"] = $hide_users["defaults"]["typography"][$heading_key]["text_hover"];
    $item["{$heading_key}_typography_font_size"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["font_size"]);
    $item["{$heading_key}_typography_font_size"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["font_size"]);

    if (isset($hide_users["defaults"]["typography"][$heading_key]["mobile"]["font_size"])) {
    $item["{$heading_key}_typography_font_size_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["font_size"]);
    $item["{$heading_key}_typography_font_size_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["font_size"]);
	}
    $item["{$heading_key}_typography_line_height"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["line_height"]);
    $item["{$heading_key}_typography_line_height"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["line_height"]);

	if (isset($hide_users["defaults"]["typography"][$heading_key]["mobile"]["line_height"])) {
    $item["{$heading_key}_typography_line_height_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["line_height"]);
    $item["{$heading_key}_typography_line_height_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["line_height"]);
	}
    $item["{$heading_key}_typography_letter_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["letter_spacing"]);
    $item["{$heading_key}_typography_letter_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["letter_spacing"]);

    if (isset($hide_users["defaults"]["typography"][$heading_key]["mobile"]["letter_spacing"])) {
    $item["{$heading_key}_typography_letter_spacing_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["letter_spacing"]);
    $item["{$heading_key}_typography_letter_spacing_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["letter_spacing"]);

	}
    $item["{$heading_key}_typography_word_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["word_spacing"]);
    $item["{$heading_key}_typography_word_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["word_spacing"]);
    if (isset($hide_users["defaults"]["typography"][$heading_key]["mobile"]["word_spacing"])) {
    $item["{$heading_key}_typography_word_spacing_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["word_spacing"]);
    $item["{$heading_key}_typography_word_spacing_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["word_spacing"]);
	}
    // ... update other typography settings ...
}
function update_typography_alt(&$item, $hide_users, $heading_key)
{
    $item["{$heading_key}_typography_font_family"] = update_dafaultfontfamily($item["{$heading_key}_typography_font_family"], $hide_users["defaults"]["typography"][$heading_key]["font_family"], $hide_users);
    $item["{$heading_key}_typography_font_weight"] = $hide_users["defaults"]["typography"][$heading_key]["font_weight"];
    $item["{$heading_key}_typography_text_transform"] = $hide_users["defaults"]["typography"][$heading_key]["text_transform"];
    $item["{$heading_key}_typography_font_style"] = $hide_users["defaults"]["typography"][$heading_key]["font_style"];
    $item["{$heading_key}_typography_text_decoration"] = $hide_users["defaults"]["typography"][$heading_key]["text_decoration"];
    $item["{$heading_key}_color"] = $hide_users["defaults"]["typography"][$heading_key]["color"];
    $item["{$heading_key}_alt_color"] = $hide_users["defaults"]["typography"][$heading_key]["alt"]["color"];
    $item["{$heading_key}_typography_font_size"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["font_size"]);
    $item["{$heading_key}_typography_font_size"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["font_size"]);
	if (isset($hide_users["defaults"]["typography"][$heading_key]["mobile"]["font_size"])) {
    $item["{$heading_key}_typography_font_size_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["font_size"]);
    $item["{$heading_key}_typography_font_size_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["font_size"]);
	}
    $item["{$heading_key}_typography_line_height"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["line_height"]);
    $item["{$heading_key}_typography_line_height"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["line_height"]);
	if (isset($hide_users["defaults"]["typography"][$heading_key]["mobile"]["line_height"])) {
    $item["{$heading_key}_typography_line_height_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["line_height"]);
    $item["{$heading_key}_typography_line_height_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["line_height"]);
	}
    $item["{$heading_key}_typography_letter_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["letter_spacing"]);
    $item["{$heading_key}_typography_letter_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["letter_spacing"]);
	if (isset($hide_users["defaults"]["typography"][$heading_key]["mobile"]["letter_spacing"])) {
    $item["{$heading_key}_typography_letter_spacing_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["letter_spacing"]);
    $item["{$heading_key}_typography_letter_spacing_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["letter_spacing"]);
	}
    $item["{$heading_key}_typography_word_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["word_spacing"]);
    $item["{$heading_key}_typography_word_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["word_spacing"]);
	if (isset($hide_users["defaults"]["typography"][$heading_key]["mobile"]["word_spacing"])) {
    $item["{$heading_key}_typography_word_spacing_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["word_spacing"]);
    $item["{$heading_key}_typography_word_spacing_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["word_spacing"]);
	}
    // ... update other typography settings ...
}
function update_typography_hover(&$item, $hide_users, $heading_key)
{
    $item["{$heading_key}_typography_font_family"] = update_dafaultfontfamily($item["{$heading_key}_typography_font_family"], $hide_users["defaults"]["typography"][$heading_key]["font_family"], $hide_users);
    $item["{$heading_key}_typography_font_weight"] = $hide_users["defaults"]["typography"][$heading_key]["font_weight"];
    $item["{$heading_key}_typography_text_transform"] = $hide_users["defaults"]["typography"][$heading_key]["text_transform"];
    $item["{$heading_key}_typography_font_style"] = $hide_users["defaults"]["typography"][$heading_key]["font_style"];
    $item["{$heading_key}_typography_text_decoration"] = $hide_users["defaults"]["typography"][$heading_key]["text_decoration"];
    $item["{$heading_key}_color"] = $hide_users["defaults"]["typography"][$heading_key]["color"];
    $item["{$heading_key}_hover_color"] = $hide_users["defaults"]["typography"][$heading_key]["hover"];
    $item["{$heading_key}_typography_font_size"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["font_size"]);
    $item["{$heading_key}_typography_font_size"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["font_size"]);
	if (isset($hide_users["defaults"]["typography"][$heading_key]["mobile"]["font_size"])) {
    $item["{$heading_key}_typography_font_size_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["font_size"]);
    $item["{$heading_key}_typography_font_size_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["font_size"]);
	}
    $item["{$heading_key}_typography_line_height"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["line_height"]);
    $item["{$heading_key}_typography_line_height"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["line_height"]);
	if (isset($hide_users["defaults"]["typography"][$heading_key]["mobile"]["line_height"])) {
    $item["{$heading_key}_typography_line_height_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["line_height"]);
    $item["{$heading_key}_typography_line_height_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["line_height"]);
	}
    $item["{$heading_key}_typography_letter_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["letter_spacing"]);
    $item["{$heading_key}_typography_letter_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["letter_spacing"]);
	if (isset($hide_users["defaults"]["typography"][$heading_key]["mobile"]["letter_spacing"])) {
    $item["{$heading_key}_typography_letter_spacing_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["letter_spacing"]);
    $item["{$heading_key}_typography_letter_spacing_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["letter_spacing"]);
	}
    $item["{$heading_key}_typography_word_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["word_spacing"]);
    $item["{$heading_key}_typography_word_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["word_spacing"]);
	if (isset($hide_users["defaults"]["typography"][$heading_key]["mobile"]["word_spacing"])) {
    $item["{$heading_key}_typography_word_spacing_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["word_spacing"]);
    $item["{$heading_key}_typography_word_spacing_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["word_spacing"]);
	}
    // ... update other typography settings ...
}
function update_typography_text_footerhover(&$item, $hide_users, $heading_key)
{
    $item["{$heading_key}_typography_font_family"] = update_dafaultfontfamily($item["{$heading_key}_typography_font_family"], $hide_users["defaults"]["typography"][$heading_key]["font_family"], $hide_users);
    $item["{$heading_key}_typography_font_weight"] = $hide_users["defaults"]["typography"][$heading_key]["font_weight"];
    $item["{$heading_key}_typography_text_transform"] = $hide_users["defaults"]["typography"][$heading_key]["text_transform"];
    $item["{$heading_key}_typography_font_style"] = $hide_users["defaults"]["typography"][$heading_key]["font_style"];
    $item["{$heading_key}_typography_text_decoration"] = $hide_users["defaults"]["typography"][$heading_key]["text_decoration"];
    $item["{$heading_key}_color"] = $hide_users["defaults"]["typography"][$heading_key]["color"];
    $item["{$heading_key}_hover_color"] = $hide_users["defaults"]["typography"][$heading_key]["hover"];
    $item["{$heading_key}_typography_font_size"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["font_size"]);
    $item["{$heading_key}_typography_font_size"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["font_size"]);
    if (isset($hide_users["defaults"]["typography"][$heading_key]["mobile"]["font_size"])) {
    $item["{$heading_key}_typography_font_size_mobile"]['size'] = str_replace(range('a', 'z'), '', $hide_users['defaults']['typography'][$heading_key]['mobile']['font_size']);
    $item["{$heading_key}_typography_font_size_mobile"]['unit'] = str_replace(range('0', '9'), '', $hide_users['defaults']['typography'][$heading_key]['mobile']['font_size']);
    }

    $item["{$heading_key}_typography_line_height"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["line_height"]);
    $item["{$heading_key}_typography_line_height"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["line_height"]);
    if (isset($hide_users["defaults"]["typography"][$heading_key]["mobile"]["line_height"])) {
    $item["{$heading_key}_typography_line_height_mobile"]['size'] = str_replace(range('a', 'z'), '', $hide_users['defaults']['typography'][$heading_key]['mobile']['line_height']);
    $item["{$heading_key}_typography_line_height_mobile"]['unit'] = str_replace(range('0', '9'), '', $hide_users['defaults']['typography'][$heading_key]['mobile']['line_height']);
    }
    $item["{$heading_key}_typography_letter_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["letter_spacing"]);
    $item["{$heading_key}_typography_letter_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["letter_spacing"]);
    if (isset($hide_users["defaults"]["typography"][$heading_key]["mobile"]["letter_spacing"])) {
    $item["{$heading_key}_typography_letter_spacing_mobile"]['size'] = str_replace(range('a', 'z'), '', $hide_users['defaults']['typography'][$heading_key]['mobile']['letter_spacing']);
    $item["{$heading_key}_typography_letter_spacing_mobile"]['unit'] = str_replace(range('0', '9'), '', $hide_users['defaults']['typography'][$heading_key]['mobile']['letter_spacing']);
    }

    $item["{$heading_key}_typography_word_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["word_spacing"]);
    $item["{$heading_key}_typography_word_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["word_spacing"]);
    if (isset($hide_users["defaults"]["typography"][$heading_key]["mobile"]["word_spacing"])) {
     $item["{$heading_key}_typography_word_spacing_mobile"]['size'] = str_replace(range('a', 'z'), '', $hide_users['defaults']['typography'][$heading_key]['mobile']['word_spacing']);
    $item["{$heading_key}_typography_word_spacing_mobile"]['unit'] = str_replace(range('0', '9'), '', $hide_users['defaults']['typography'][$heading_key]['mobile']['word_spacing']);
    }
    // ... update other typography settings ...
}
function update_typography_text_hover(&$item, $hide_users, $heading_key)
{
    $item["{$heading_key}_typography_font_family"] = update_dafaultfontfamily($item["{$heading_key}_typography_font_family"], $hide_users["defaults"]["typography"][$heading_key]["font_family"], $hide_users);
	if (isset($hide_users["defaults"]["typography"][$heading_key]["font_weight"])) {
    $item["{$heading_key}_typography_font_weight"] = $hide_users["defaults"]["typography"][$heading_key]["font_weight"];
	}
    $item["{$heading_key}_typography_text_transform"] = $hide_users["defaults"]["typography"][$heading_key]["text_transform"];
    $item["{$heading_key}_typography_font_style"] = $hide_users["defaults"]["typography"][$heading_key]["font_style"];
    $item["{$heading_key}_typography_text_decoration"] = $hide_users["defaults"]["typography"][$heading_key]["text_decoration"];
    $item["{$heading_key}_color"] = $hide_users["defaults"]["typography"][$heading_key]["text_color"];
    $item["{$heading_key}_hover_color"] = $hide_users["defaults"]["typography"][$heading_key]["hover"];
    $item["{$heading_key}_typography_font_size"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["font_size"]);
    $item["{$heading_key}_typography_font_size"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["font_size"]);
    if (isset($hide_users["defaults"]["typography"][$heading_key]["mobile"]["font_size"])) {
    $item["{$heading_key}_typography_font_size_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["font_size"]);
    $item["{$heading_key}_typography_font_size_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["font_size"]);
    }

    $item["{$heading_key}_typography_line_height"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["line_height"]);
    $item["{$heading_key}_typography_line_height"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["line_height"]);
    if (isset($hide_users["defaults"]["typography"][$heading_key]["mobile"]["line_height"])) {
    $item["{$heading_key}_typography_line_height_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["line_height"]);
    $item["{$heading_key}_typography_line_height_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["line_height"]);
    }
    $item["{$heading_key}_typography_letter_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["letter_spacing"]);
    $item["{$heading_key}_typography_letter_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["letter_spacing"]);
    if (isset($hide_users["defaults"]["typography"][$heading_key]["mobile"]["letter_spacing"])) {
    $item["{$heading_key}_typography_letter_spacing_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["letter_spacing"]);
    $item["{$heading_key}_typography_letter_spacing_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["letter_spacing"]);
    }

    $item["{$heading_key}_typography_word_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["word_spacing"]);
    $item["{$heading_key}_typography_word_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["word_spacing"]);
    if (isset($hide_users["defaults"]["typography"][$heading_key]["mobile"]["word_spacing"])) {
    $item["{$heading_key}_typography_word_spacing_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["word_spacing"]);
    $item["{$heading_key}_typography_word_spacing_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["word_spacing"]);
    }
    // ... update other typography settings ...
}

function update_displaytypography(&$item, $hide_users, $heading_key)
{
    $item["{$heading_key}_typography_font_family"] = update_dafaultfontfamily($item["{$heading_key}_typography_font_family"], $hide_users["defaults"]["typography"][$heading_key]["hero_font_family"], $hide_users);

    $item["{$heading_key}_typography_font_weight"] = $hide_users["defaults"]["typography"][$heading_key]["hero_font_weight"];
    $item["{$heading_key}_typography_text_transform"] = $hide_users["defaults"]["typography"][$heading_key]["hero_text_transform"];
    $item["{$heading_key}_typography_font_style"] = $hide_users["defaults"]["typography"][$heading_key]["hero_font_style"];
    $item["{$heading_key}_typography_text_decoration"] = $hide_users["defaults"]["typography"][$heading_key]["hero_text_decoration"];
    if (isset($hide_users["defaults"]["typography"][$heading_key]["hero_color"])) {
    $item["{$heading_key}_color"] = $hide_users["defaults"]["typography"][$heading_key]["hero_color"];
    }
    $item["{$heading_key}_typography_font_size"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["hero_font_size"]);
    $item["{$heading_key}_typography_font_size"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["hero_font_size"]);
    if (isset($hide_users["defaults"]["typography"][$heading_key]["hero_mobile"]["font_size"])) {
    $item["{$heading_key}_typography_font_size_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["hero_mobile"]["font_size"]);
    $item["{$heading_key}_typography_font_size_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["hero_mobile"]["font_size"]);
    }

    $item["{$heading_key}_typography_line_height"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["hero_line_height"]);
    $item["{$heading_key}_typography_line_height"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["hero_line_height"]);
    if (isset($hide_users["defaults"]["typography"][$heading_key]["hero_mobile"]["line_height"])) {
    $item["{$heading_key}_typography_line_height_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["hero_mobile"]["line_height"]);
    $item["{$heading_key}_typography_line_height_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["hero_mobile"]["line_height"]);
    }
    $item["{$heading_key}_typography_letter_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["hero_letter_spacing"]);
    $item["{$heading_key}_typography_letter_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["hero_letter_spacing"]);
    if (isset($hide_users["defaults"]["typography"][$heading_key]["hero_mobile"]["letter_spacing"])) {
    $item["{$heading_key}_typography_letter_spacing_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["hero_mobile"]["letter_spacing"]);
    $item["{$heading_key}_typography_letter_spacing_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["hero_mobile"]["letter_spacing"]);
    }
    if (isset($hide_users["defaults"]["typography"][$heading_key]["hero_word_spacing"])) {
    $item["{$heading_key}_typography_word_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["hero_word_spacing"]);
    $item["{$heading_key}_typography_word_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["hero_word_spacing"]);
    }
    if (isset($hide_users["defaults"]["typography"][$heading_key]["hero_mobile"]["word_spacing"])) {
    $item["{$heading_key}_typography_word_spacing_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["hero_mobile"]["word_spacing"]);
    $item["{$heading_key}_typography_word_spacing_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["hero_mobile"]["word_spacing"]);
    }
    // ... update other typography settings ...
}
function update_typography_link(&$item, $hide_users, $heading_key)
{
    $item["{$heading_key}_typography_font_family"] = update_dafaultfontfamily($item["{$heading_key}_typography_font_family"], $hide_users["defaults"]["typography"]["a"]["font_family"], $hide_users);
    $item["{$heading_key}_typography_font_weight"] = $hide_users["defaults"]["typography"]["a"]["font_weight"];
    $item["{$heading_key}_typography_text_transform"] = $hide_users["defaults"]["typography"]["a"]["text_transform"];
    $item["{$heading_key}_typography_font_style"] = $hide_users["defaults"]["typography"]["a"]["font_style"];
    $item["{$heading_key}_typography_text_decoration"] = $hide_users["defaults"]["typography"]["a"]["text_decoration"];
    $item["{$heading_key}_color"] = $hide_users["defaults"]["typography"]["a"]["color"];
    $item["{$heading_key}_typography_font_size"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"]["a"]["font_size"]);
    $item["{$heading_key}_typography_font_size"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"]["a"]["font_size"]);
    if (isset($hide_users["defaults"]["typography"]["a"]["mobile"]["font_size"])) {
    $item["{$heading_key}_typography_font_size_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"]["a"]["mobile"]["font_size"]);
    $item["{$heading_key}_typography_font_size_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"]["a"]["mobile"]["font_size"]);
    }

    $item["{$heading_key}_typography_line_height"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"]["a"]["line_height"]);
    $item["{$heading_key}_typography_line_height"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"]["a"]["line_height"]);
    if (isset($hide_users["defaults"]["typography"]["a"]["mobile"]["line_height"])) {
    $item["{$heading_key}_typography_line_height_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"]["a"]["mobile"]["line_height"]);
    $item["{$heading_key}_typography_line_height_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"]["a"]["mobile"]["line_height"]);
    }
    $item["{$heading_key}_typography_letter_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"]["a"]["letter_spacing"]);
    $item["{$heading_key}_typography_letter_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"]["a"]["letter_spacing"]);
    if (isset($hide_users["defaults"]["typography"]["a"]["mobile"]["letter_spacing"])) {
    $item["{$heading_key}_typography_letter_spacing_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"]["a"]["mobile"]["letter_spacing"]);
    $item["{$heading_key}_typography_letter_spacing_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"]["a"]["mobile"]["letter_spacing"]);
    }

    $item["{$heading_key}_typography_word_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"]["a"]["word_spacing"]);
    $item["{$heading_key}_typography_word_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"]["a"]["word_spacing"]);
    if (isset($hide_users["defaults"]["typography"]["a"]["mobile"]["word_spacing"])) {
    $item["{$heading_key}_typography_word_spacing_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"]["a"]["mobile"]["word_spacing"]);
    $item["{$heading_key}_typography_word_spacing_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"]["a"]["mobile"]["word_spacing"]);
    }
    // ... update other typography settings ...
}

function update_typography_link_hover(&$item, $hide_users, $heading_key)
{
    if (isset($hide_users["defaults"]["typography"]["a"]["hover"]["font_family"])) {
    $item["{$heading_key}_typography_font_family"] = update_dafaultfontfamily($item["{$heading_key}_typography_font_family"], $hide_users["defaults"]["typography"]["a"]["hover"]["font_family"], $hide_users);
    }
    $item["{$heading_key}_typography_font_weight"] = $hide_users["defaults"]["typography"]["a"]["hover"]["font_weight"];
    if (isset($hide_users["defaults"]["typography"]["a"]["hover"]["text_transform"])) {
    $item["{$heading_key}_typography_text_transform"] = $hide_users["defaults"]["typography"]["a"]["hover"]["text_transform"];
    }
    $item["{$heading_key}_typography_font_style"] = $hide_users["defaults"]["typography"]["a"]["hover"]["font_style"];
    $item["{$heading_key}_typography_text_decoration"] = $hide_users["defaults"]["typography"]["a"]["hover"]["text_decoration"];
    $item["{$heading_key}_color"] = $hide_users["defaults"]["typography"]["a"]["hover"]["color"];
    $item["{$heading_key}_typography_font_size"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"]["a"]["hover"]["font_size"]);
    $item["{$heading_key}_typography_font_size"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"]["a"]["hover"]["font_size"]);
    if (isset($hide_users["defaults"]["typography"]["a"]["hover"]["mobile"]["font_size"])) {
    $item["{$heading_key}_typography_font_size_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"]["a"]["hover"]["mobile"]["font_size"]);
    $item["{$heading_key}_typography_font_size_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"]["a"]["hover"]["mobile"]["font_size"]);
    }
    $item["{$heading_key}_typography_line_height"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"]["a"]["hover"]["line_height"]);
    $item["{$heading_key}_typography_line_height"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"]["a"]["hover"]["line_height"]);
    if (isset($hide_users["defaults"]["typography"]["a"]["hover"]["mobile"]["line_height"])) {
    $item["{$heading_key}_typography_line_height_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"]["a"]["hover"]["mobile"]["line_height"]);
    $item["{$heading_key}_typography_line_height_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"]["a"]["hover"]["mobile"]["line_height"]);
    }
    $item["{$heading_key}_typography_letter_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"]["a"]["hover"]["letter_spacing"]);
    $item["{$heading_key}_typography_letter_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"]["a"]["hover"]["letter_spacing"]);
    if (isset($hide_users["defaults"]["typography"]["a"]["hover"]["mobile"]["letter_spacing"])) {
    $item["{$heading_key}_typography_letter_spacing_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"]["a"]["hover"]["mobile"]["letter_spacing"]);
    $item["{$heading_key}_typography_letter_spacing_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"]["a"]["hover"]["mobile"]["letter_spacing"]);
    }
    $item["{$heading_key}_typography_word_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"]["a"]["hover"]["word_spacing"]);
    $item["{$heading_key}_typography_word_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"]["a"]["hover"]["word_spacing"]);
    if (isset($hide_users["defaults"]["typography"]["a"]["hover"]["mobile"]["word_spacing"])) {
    $item["{$heading_key}_typography_word_spacing_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"]["a"]["hover"]["mobile"]["word_spacing"]);
    $item["{$heading_key}_typography_word_spacing_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"]["a"]["hover"]["mobile"]["word_spacing"]);
    }
    // ... update other typography settings ...
}

function update_single_color(&$item, $hide_users, $heading_key)
{
    $item["{$heading_key}_color"] = $hide_users["defaults"]["typography"][$heading_key]["color"];
}
function update_copyright(&$item, $hide_users, $heading_key)
{
    $item["{$heading_key}_color"] = $hide_users["defaults"]["typography"][$heading_key]["hover"];
}
function update_blog(&$item, $hide_users, $heading_key)
{
    $item["{$heading_key}_color"] = $hide_users["defaults"]["typography"][$heading_key]["read_more_text_color"];
    $item["{$heading_key}_hover_color"] = $hide_users["defaults"]["typography"][$heading_key]["read_more_text_color_hover"];
}
function update_alt(&$item, $hide_users, $heading_key)
{
    $item["{$heading_key}_color"] = $hide_users["defaults"]["typography"]["a"]["alt"]["color"];
}

function update_h1(&$item, $hide_users, $heading_key)
{
    $item["{$heading_key}_color"] = $hide_users["defaults"]["typography"]["h1"]["alt"]["color"];
}

function update_h2(&$item, $hide_users, $heading_key)
{
    $item["{$heading_key}_color"] = $hide_users["defaults"]["typography"]["h2"]["alt"]["color"];
}

function update_h3(&$item, $hide_users, $heading_key)
{
    $item["{$heading_key}_color"] = $hide_users["defaults"]["typography"]["h3"]["alt"]["color"];
}

function update_h4(&$item, $hide_users, $heading_key)
{
    $item["{$heading_key}_color"] = $hide_users["defaults"]["typography"]["h4"]["alt"]["color"];
}

function update_h5(&$item, $hide_users, $heading_key)
{
    $item["{$heading_key}_color"] = $hide_users["defaults"]["typography"]["h5"]["alt"]["color"];
}

function update_h6(&$item, $hide_users, $heading_key)
{
    $item["{$heading_key}_color"] = $hide_users["defaults"]["typography"]["h6"]["alt"]["color"];
}
function update_color_hover(&$item, $hide_users, $heading_key)
{
    $item["{$heading_key}_color"] = $hide_users["defaults"]["typography"][$heading_key]["color"];
    $item["{$heading_key}_hover_color"] = $hide_users["defaults"]["typography"][$heading_key]["hover"];
}
function update_mobile_popup_form(&$item, $hide_users, $heading_key)
{
    $item["{$heading_key}_form_background"] = $hide_users["defaults"]["typography"][$heading_key]["form_background"];
    $item["{$heading_key}_input_text_color"] = $hide_users["defaults"]["typography"][$heading_key]["input_text_color"];
    $item["{$heading_key}_background_color"] = $hide_users["defaults"]["typography"][$heading_key]["background_color"];
    $item["{$heading_key}_border_color"] = $hide_users["defaults"]["typography"][$heading_key]["border_color"];
}
function update_thankyou(&$item, $hide_users, $heading_key)
{
    $item["{$heading_key}_page_heading_color"] = $hide_users["defaults"]["typography"][$heading_key]["page_heading_color"];
    $item["{$heading_key}_page_content_color"] = $hide_users["defaults"]["typography"][$heading_key]["page_content_color"];
}
function update_pagenotfound(&$item, $hide_users, $heading_key)
{
    $item["{$heading_key}_display_1"] = $hide_users["defaults"]["typography"][$heading_key]["display_1"];
    $item["{$heading_key}_display_2"] = $hide_users["defaults"]["typography"][$heading_key]["display_2"];
}
function update_popup(&$item, $hide_users, $heading_key)
{
    $item["{$heading_key}_form_background"] = $hide_users["defaults"]["typography"][$heading_key]["form_background"];
    $item["{$heading_key}_text_color"] = $hide_users["defaults"]["typography"][$heading_key]["input_text_color"];
    $item["{$heading_key}_background_color"] = $hide_users["defaults"]["typography"][$heading_key]["input_background_color"];
    $item["{$heading_key}_border_color"] = $hide_users["defaults"]["typography"][$heading_key]["input_border_color"];
    $item["{$heading_key}_typography_font_family"] = update_dafaultfontfamily($item["{$heading_key}_typography_font_family"], $hide_users["defaults"]["typography"][$heading_key]["font_family"], $hide_users);
    $item["{$heading_key}_typography_font_weight"] = $hide_users["defaults"]["typography"][$heading_key]["font_weight"];
    $item["{$heading_key}_typography_text_transform"] = $hide_users["defaults"]["typography"][$heading_key]["text_transform"];
    $item["{$heading_key}_typography_font_style"] = $hide_users["defaults"]["typography"][$heading_key]["font_style"];
    $item["{$heading_key}_typography_text_decoration"] = $hide_users["defaults"]["typography"][$heading_key]["text_decoration"];

    $item["{$heading_key}_typography_font_size_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["font_size"]);
    $item["{$heading_key}_typography_font_size_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["font_size"]);

    $item["{$heading_key}_typography_line_height_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["line_height"]);
    $item["{$heading_key}_typography_line_height_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["line_height"]);

    $item["{$heading_key}_typography_letter_spacing_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["letter_spacing"]);
    $item["{$heading_key}_typography_letter_spacing_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["letter_spacing"]);

    $item["{$heading_key}_typography_word_spacing_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["word_spacing"]);
    $item["{$heading_key}_typography_word_spacing_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["word_spacing"]);
}
function update_form(&$item, $hide_users, $heading_key)
{
    $item["{$heading_key}_text_color"] = $hide_users["defaults"]["typography"][$heading_key]["text_color"];
    $item["{$heading_key}_border_color"] = $hide_users["defaults"]["typography"][$heading_key]["border_color"];
}
function update_typography_button(&$item, $hide_users, $heading_key)
{
    $item["{$heading_key}_typography_font_family"] = update_dafaultfontfamily($item["{$heading_key}_typography_font_family"], $hide_users["defaults"]["typography"][$heading_key]["font_family"], $hide_users);
    $item["{$heading_key}_typography_font_weight"] = $hide_users["defaults"]["typography"][$heading_key]["font_weight"];
    $item["{$heading_key}_typography_text_transform"] = $hide_users["defaults"]["typography"][$heading_key]["text_transform"];
    $item["{$heading_key}_typography_font_style"] = $hide_users["defaults"]["typography"][$heading_key]["font_style"];
    $item["{$heading_key}_typography_text_decoration"] = $hide_users["defaults"]["typography"][$heading_key]["text_decoration"];
    $item["{$heading_key}_color"] = $hide_users["defaults"]["typography"][$heading_key]["color"];
    $item["{$heading_key}_bgcolor"] = $hide_users["defaults"]["typography"][$heading_key]["background_color"];
    if (isset($hide_users["defaults"]["typography"][$heading_key]["border_radius"])) {
    $border_radius_values = explode(" ", $hide_users["defaults"]["typography"][$heading_key]["border_radius"]);
    if (count($border_radius_values) === 1) {
        $border_radius_values = array_pad($border_radius_values, 4, $border_radius_values[0]);
    }
    $item["{$heading_key}_border_radius"]["top"] = (int) trim($border_radius_values[0], "px");
    $item["{$heading_key}_border_radius"]["right"] = (int) trim($border_radius_values[1], "px");
    $item["{$heading_key}_border_radius"]["bottom"] = (int) trim($border_radius_values[2], "px");
    $item["{$heading_key}_border_radius"]["left"] = (int) trim($border_radius_values[3], "px");
    $item["{$heading_key}_border_radius"]["unit"] = "px";
    }
    $item["{$heading_key}_typography_font_size"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["font_size"]);
    $item["{$heading_key}_typography_font_size"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["font_size"]);
    $item["{$heading_key}_typography_font_size_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["font_size"]);
    $item["{$heading_key}_typography_font_size_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["font_size"]);

    $item["{$heading_key}_typography_line_height"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["line_height"]);
    $item["{$heading_key}_typography_line_height"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["line_height"]);
    $item["{$heading_key}_typography_line_height_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["line_height"]);
    $item["{$heading_key}_typography_line_height_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["line_height"]);
    $item["{$heading_key}_typography_letter_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["letter_spacing"]);
    $item["{$heading_key}_typography_letter_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["letter_spacing"]);
    $item["{$heading_key}_typography_letter_spacing_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["letter_spacing"]);
    $item["{$heading_key}_typography_letter_spacing_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["letter_spacing"]);

    $item["{$heading_key}_typography_word_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["word_spacing"]);
    $item["{$heading_key}_typography_word_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["word_spacing"]);
    $item["{$heading_key}_typography_word_spacing_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["word_spacing"]);
    $item["{$heading_key}_typography_word_spacing_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["word_spacing"]);
    // ... update other typography settings ...

    $item["{$heading_key}_hover_color"] = $hide_users["defaults"]["typography"][$heading_key]["hover"]["color"];
    $item["{$heading_key}_hover_bg_color"] = $hide_users["defaults"]["typography"][$heading_key]["hover"]["background_color"];
    if (isset($hide_users["defaults"]["typography"][$heading_key]["hover"]["border_radius"])) {
    $border_radius_hover = explode(" ", $hide_users["defaults"]["typography"][$heading_key]["hover"]["border_radius"]);
    if (count($border_radius_hover) === 1) {
        $border_radius_hover = array_pad($border_radius_hover, 4, $border_radius_hover[0]);
    }
    $item["{$heading_key}_border_radius_hover"]["top"] = (int) trim($border_radius_hover[0], "px");
    $item["{$heading_key}_border_radius_hover"]["right"] = (int) trim($border_radius_hover[1], "px");
    $item["{$heading_key}_border_radius_hover"]["bottom"] = (int) trim($border_radius_hover[2], "px");
    $item["{$heading_key}_border_radius_hover"]["left"] = (int) trim($border_radius_hover[3], "px");
    $item["{$heading_key}_border_radius_hover"]["unit"] = "px";
    }
    $item["{$heading_key}_alt_typography_font_family"] = update_dafaultfontfamily($item["{$heading_key}_alt_typography_font_family"], $hide_users["defaults"]["typography"][$heading_key]["alt"]["font_family"], $hide_users);
    $item["{$heading_key}_alt_typography_font_weight"] = $hide_users["defaults"]["typography"][$heading_key]["alt"]["font_weight"];
    $item["{$heading_key}_alt_typography_text_transform"] = $hide_users["defaults"]["typography"][$heading_key]["alt"]["text_transform"];
    $item["{$heading_key}_alt_typography_font_style"] = $hide_users["defaults"]["typography"][$heading_key]["alt"]["font_style"];
    $item["{$heading_key}_alt_typography_text_decoration"] = $hide_users["defaults"]["typography"][$heading_key]["alt"]["text_decoration"];
    $item["{$heading_key}_alt_color"] = $hide_users["defaults"]["typography"][$heading_key]["alt"]["color"];
    $item["{$heading_key}_alt_bgcolor"] = $hide_users["defaults"]["typography"][$heading_key]["alt"]["background_color"];
    if (isset($hide_users["defaults"]["typography"][$heading_key]["alt"]["border_radius"])) {
    $border_radius_alt = explode(" ", $hide_users["defaults"]["typography"][$heading_key]["alt"]["border_radius"]);
    if (count($border_radius_alt) === 1) {
        $border_radius_alt = array_pad($border_radius_alt, 4, $border_radius_alt[0]);
    }
    $item["{$heading_key}_border_radius_alt"]["top"] = (int) trim($border_radius_alt[0], "px");
    $item["{$heading_key}_border_radius_alt"]["right"] = (int) trim($border_radius_alt[1], "px");
    $item["{$heading_key}_border_radius_alt"]["bottom"] = (int) trim($border_radius_alt[2], "px");
    $item["{$heading_key}_border_radius_alt"]["left"] = (int) trim($border_radius_alt[3], "px");
    $item["{$heading_key}_border_radius_alt"]["unit"] = "px";
    }
    $item["{$heading_key}_alt_typography_font_size"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["alt"]["font_size"]);
    $item["{$heading_key}_alt_typography_font_size"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["alt"]["font_size"]);
    $item["{$heading_key}_alt_typography_font_size_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["alt"]["mobile"]["font_size"]);
    $item["{$heading_key}_alt_typography_font_size_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["alt"]["mobile"]["font_size"]);

    $item["{$heading_key}_alt_typography_line_height"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["alt"]["line_height"]);
    $item["{$heading_key}_alt_typography_line_height"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["alt"]["line_height"]);
    $item["{$heading_key}_alt_typography_line_height_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["alt"]["mobile"]["line_height"]);
    $item["{$heading_key}_alt_typography_line_height_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["alt"]["mobile"]["line_height"]);
    $item["{$heading_key}_alt_typography_letter_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["alt"]["letter_spacing"]);
    $item["{$heading_key}_alt_typography_letter_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["alt"]["letter_spacing"]);
    $item["{$heading_key}_alt_typography_letter_spacing_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["alt"]["mobile"]["letter_spacing"]);
    $item["{$heading_key}_alt_typography_letter_spacing_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["alt"]["mobile"]["letter_spacing"]);

    $item["{$heading_key}_alt_typography_word_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["alt"]["word_spacing"]);
    $item["{$heading_key}_alt_typography_word_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["alt"]["word_spacing"]);
    $item["{$heading_key}_alt_typography_word_spacing_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["alt"]["mobile"]["word_spacing"]);
    $item["{$heading_key}_alt_typography_word_spacing_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["alt"]["mobile"]["word_spacing"]);

    $item["{$heading_key}_althover_color"] = $hide_users["defaults"]["typography"][$heading_key]["alt"]["hover"]["color"];
    $item["{$heading_key}_althover_bg_color"] = $hide_users["defaults"]["typography"][$heading_key]["alt"]["hover"]["background_color"];
    if (isset($hide_users["defaults"]["typography"][$heading_key]["alt"]["hover"]["border_radius"])) {
    $border_radius_alt_hover = explode(" ", $hide_users["defaults"]["typography"][$heading_key]["alt"]["hover"]["border_radius"]);
    if (count($border_radius_alt_hover) === 1) {
        $border_radius_alt_hover = array_pad($border_radius_alt_hover, 4, $border_radius_alt_hover[0]);
    }
    $item["{$heading_key}_border_radius_alt_hover"]["top"] = (int) trim($border_radius_alt_hover[0], "px");
    $item["{$heading_key}_border_radius_alt_hover"]["right"] = (int) trim($border_radius_alt_hover[1], "px");
    $item["{$heading_key}_border_radius_alt_hover"]["bottom"] = (int) trim($border_radius_alt_hover[2], "px");
    $item["{$heading_key}_border_radius_alt_hover"]["left"] = (int) trim($border_radius_alt_hover[3], "px");
    $item["{$heading_key}_border_radius_alt_hover"]["unit"] = "px";
    }
}

function update_service_block_hover(&$item, $hide_users, $heading_key)
{
    $item["{$heading_key}_text_color"] = $hide_users["defaults"]["typography"][$heading_key]["text"]["color"];
    $item["{$heading_key}_icon_color"] = $hide_users["defaults"]["typography"][$heading_key]["icon"]["color"];
}

function update_navigation(&$item, $hide_users, $heading_key)
{
    $item["{$heading_key}_typography_font_family"] = update_dafaultfontfamily($item["{$heading_key}_typography_font_family"], $hide_users["defaults"]["typography"][$heading_key]["font_family"], $hide_users);
    $item["{$heading_key}_typography_font_weight"] = $hide_users["defaults"]["typography"][$heading_key]["font_weight"];
    $item["{$heading_key}_typography_text_transform"] = $hide_users["defaults"]["typography"][$heading_key]["text_transform"];
    $item["{$heading_key}_typography_font_style"] = $hide_users["defaults"]["typography"][$heading_key]["font_style"];
    $item["{$heading_key}_typography_text_decoration"] = $hide_users["defaults"]["typography"][$heading_key]["text_decoration"];
    $item["{$heading_key}_color"] = $hide_users["defaults"]["typography"][$heading_key]["color"];
    $item["{$heading_key}_hover"] = $hide_users["defaults"]["typography"][$heading_key]["hover"];
    $item["{$heading_key}_typography_font_size"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["font_size"]);
    $item["{$heading_key}_typography_font_size"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["font_size"]);
    $item["{$heading_key}_typography_font_size_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["font_size"]);
    $item["{$heading_key}_typography_font_size_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["font_size"]);

    $item["{$heading_key}_typography_line_height"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["line_height"]);
    $item["{$heading_key}_typography_line_height"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["line_height"]);
    $item["{$heading_key}_typography_line_height_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["line_height"]);
    $item["{$heading_key}_typography_line_height_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["line_height"]);
    $item["{$heading_key}_typography_letter_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["letter_spacing"]);
    $item["{$heading_key}_typography_letter_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["letter_spacing"]);
    $item["{$heading_key}_typography_letter_spacing_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["letter_spacing"]);
    $item["{$heading_key}_typography_letter_spacing_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["letter_spacing"]);

    $item["{$heading_key}_typography_word_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["word_spacing"]);
    $item["{$heading_key}_typography_word_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["word_spacing"]);
    $item["{$heading_key}_typography_word_spacing_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["word_spacing"]);
    $item["{$heading_key}_typography_word_spacing_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["word_spacing"]);

    $item["{$heading_key}_top_nav_background"] = $hide_users["defaults"]["typography"][$heading_key]["top_nav_background"];
    $item["{$heading_key}_top_nav_color"] = $hide_users["defaults"]["typography"][$heading_key]["top_nav_color"];
    $item["{$heading_key}_top_nav_hover_background"] = $hide_users["defaults"]["typography"][$heading_key]["top_nav_hover_background"];
    $item["{$heading_key}_top_nav_hover_color"] = $hide_users["defaults"]["typography"][$heading_key]["top_nav_hover_color"];
    $item["{$heading_key}_sub_nav_background"] = $hide_users["defaults"]["typography"][$heading_key]["sub_nav_background"];
    $item["{$heading_key}_sub_nav_color"] = $hide_users["defaults"]["typography"][$heading_key]["sub_nav_color"];
    $item["{$heading_key}_sub_nav_hover_background"] = $hide_users["defaults"]["typography"][$heading_key]["sub_nav_hover_background"];
    $item["{$heading_key}_sub_nav_hover_color"] = $hide_users["defaults"]["typography"][$heading_key]["sub_nav_hover_color"];
}

function update_coupon(&$item, $hide_users, $heading_key)
{
    $item["{$heading_key}_heading_font_family"] = update_dafaultfontfamily($item["{$heading_key}_heading_font_family"], $hide_users["defaults"]["typography"][$heading_key]["heading_font_family"], $hide_users);
    $item["{$heading_key}_heading_font_weight"] = $hide_users["defaults"]["typography"][$heading_key]["heading_font_weight"];
    $item["{$heading_key}_heading_text_transform"] = $hide_users["defaults"]["typography"][$heading_key]["heading_text_transform"];
    $item["{$heading_key}_heading_font_style"] = $hide_users["defaults"]["typography"][$heading_key]["heading_font_style"];
    $item["{$heading_key}_heading_text_decoration"] = $hide_users["defaults"]["typography"][$heading_key]["heading_text_decoration"];
    $item["{$heading_key}_heading_color"] = $hide_users["defaults"]["typography"][$heading_key]["heading_color"];
    $item["{$heading_key}_heading_font_size"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["heading_font_size"]);
    $item["{$heading_key}_heading_font_size"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["heading_font_size"]);

    $item["{$heading_key}_heading_line_height"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["heading_line_height"]);
    $item["{$heading_key}_heading_line_height"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["heading_line_height"]);
    $item["{$heading_key}_heading_letter_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["heading_letter_spacing"]);
    $item["{$heading_key}_heading_letter_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["heading_letter_spacing"]);

    $item["{$heading_key}_heading_word_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["heading_word_spacing"]);
    $item["{$heading_key}_heading_word_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["heading_word_spacing"]);

    $item["{$heading_key}_heading_font_size_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["heading_font_size"]);
    $item["{$heading_key}_heading_font_size_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["heading_font_size"]);

    $item["{$heading_key}_heading_line_height_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["heading_line_height"]);
    $item["{$heading_key}_heading_line_height_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["heading_line_height"]);
    $item["{$heading_key}_heading_letter_spacing_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["heading_letter_spacing"]);
    $item["{$heading_key}_heading_letter_spacing_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["heading_letter_spacing"]);

    $item["{$heading_key}_heading_word_spacing_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["heading_word_spacing"]);
    $item["{$heading_key}_heading_word_spacing_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["heading_word_spacing"]);

    $item["{$heading_key}_sub_heading_font_family"] = update_dafaultfontfamily($item["{$heading_key}_sub_heading_font_family"], $hide_users["defaults"]["typography"][$heading_key]["sub_heading_font_family"], $hide_users);
    $item["{$heading_key}_sub_heading_font_weight"] = $hide_users["defaults"]["typography"][$heading_key]["sub_heading_font_weight"];
    $item["{$heading_key}_sub_heading_text_transform"] = $hide_users["defaults"]["typography"][$heading_key]["sub_heading_text_transform"];
    $item["{$heading_key}_sub_heading_font_style"] = $hide_users["defaults"]["typography"][$heading_key]["sub_heading_font_style"];
    $item["{$heading_key}_sub_heading_text_decoration"] = $hide_users["defaults"]["typography"][$heading_key]["sub_heading_text_decoration"];
    $item["{$heading_key}_sub_heading_color"] = $hide_users["defaults"]["typography"][$heading_key]["sub_heading_color"];
    $item["{$heading_key}_sub_heading_font_size"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["sub_heading_font_size"]);
    $item["{$heading_key}_sub_heading_font_size"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["sub_heading_font_size"]);

    $item["{$heading_key}_sub_heading_line_height"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["sub_heading_line_height"]);
    $item["{$heading_key}_sub_heading_line_height"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["sub_heading_line_height"]);
    $item["{$heading_key}_sub_heading_letter_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["sub_heading_letter_spacing"]);
    $item["{$heading_key}_sub_heading_letter_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["sub_heading_letter_spacing"]);

    $item["{$heading_key}_sub_heading_word_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["heading_word_spacing"]);
    $item["{$heading_key}_sub_heading_word_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["heading_word_spacing"]);
    $item["{$heading_key}_sub_heading_font_size_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["sub_heading_font_size"]);
    $item["{$heading_key}_sub_heading_font_size_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["sub_heading_font_size"]);

    $item["{$heading_key}_sub_heading_line_height_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["sub_heading_line_height"]);
    $item["{$heading_key}_sub_heading_line_height_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["sub_heading_line_height"]);
    $item["{$heading_key}_sub_heading_letter_spacing_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["sub_heading_letter_spacing"]);
    $item["{$heading_key}_sub_heading_letter_spacing_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["sub_heading_letter_spacing"]);

    $item["{$heading_key}_sub_heading_word_spacing_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["heading_word_spacing"]);
    $item["{$heading_key}_sub_heading_word_spacing_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["heading_word_spacing"]);

    $item["{$heading_key}_offer_text_font_family"] = update_dafaultfontfamily($item["{$heading_key}_offer_text_font_family"], $hide_users["defaults"]["typography"][$heading_key]["offer_text_font_family"], $hide_users);
    $item["{$heading_key}_offer_text_font_weight"] = $hide_users["defaults"]["typography"][$heading_key]["offer_text_font_weight"];
    $item["{$heading_key}_offer_text_text_transform"] = $hide_users["defaults"]["typography"][$heading_key]["offer_text_text_transform"];
    $item["{$heading_key}_offer_text_font_style"] = $hide_users["defaults"]["typography"][$heading_key]["offer_text_font_style"];
    $item["{$heading_key}_offer_text_text_decoration"] = $hide_users["defaults"]["typography"][$heading_key]["offer_text_text_decoration"];
    $item["{$heading_key}_offer_text_color"] = $hide_users["defaults"]["typography"][$heading_key]["offer_text_color"];
    $item["{$heading_key}_offer_text_font_size"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["offer_text_font_size"]);
    $item["{$heading_key}_offer_text_font_size"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["offer_text_font_size"]);

    $item["{$heading_key}_offer_text_line_height"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["offer_text_line_height"]);
    $item["{$heading_key}_offer_text_line_height"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["offer_text_line_height"]);
    $item["{$heading_key}_offer_text_letter_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["offer_text_letter_spacing"]);
    $item["{$heading_key}_offer_text_letter_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["offer_text_letter_spacing"]);

    $item["{$heading_key}_offer_text_word_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["offer_text_word_spacing"]);
    $item["{$heading_key}_offer_text_word_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["offer_text_word_spacing"]);
    $item["{$heading_key}_offer_text_font_size_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["offer_text_font_size"]);
    $item["{$heading_key}_offer_text_font_size_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["offer_text_font_size"]);

    $item["{$heading_key}_offer_text_line_height_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["offer_text_line_height"]);
    $item["{$heading_key}_offer_text_line_height_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["offer_text_line_height"]);
    $item["{$heading_key}_offer_text_letter_spacing_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["offer_text_letter_spacing"]);
    $item["{$heading_key}_offer_text_letter_spacing_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["offer_text_letter_spacing"]);

    $item["{$heading_key}_offer_text_word_spacing_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["offer_text_word_spacing"]);
    $item["{$heading_key}_offer_text_word_spacing_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["offer_text_word_spacing"]);

    $item["{$heading_key}_expiry_text_font_family"] = update_dafaultfontfamily($item["{$heading_key}_expiry_text_font_family"], $hide_users["defaults"]["typography"][$heading_key]["expiry_text_font_family"], $hide_users);
    $item["{$heading_key}_expiry_text_font_weight"] = $hide_users["defaults"]["typography"][$heading_key]["expiry_text_font_weight"];
    $item["{$heading_key}_expiry_text_text_transform"] = $hide_users["defaults"]["typography"][$heading_key]["expiry_text_text_transform"];
    $item["{$heading_key}_expiry_text_font_style"] = $hide_users["defaults"]["typography"][$heading_key]["expiry_text_font_style"];
    $item["{$heading_key}_expiry_text_text_decoration"] = $hide_users["defaults"]["typography"][$heading_key]["expiry_text_text_decoration"];
    $item["{$heading_key}_expiry_text_color"] = $hide_users["defaults"]["typography"][$heading_key]["expiry_text_color"];
    $item["{$heading_key}_expiry_text_font_size"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["expiry_text_font_size"]);
    $item["{$heading_key}_expiry_text_font_size"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["expiry_text_font_size"]);

    $item["{$heading_key}_expiry_text_line_height"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["expiry_text_line_height"]);
    $item["{$heading_key}_expiry_text_line_height"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["expiry_text_line_height"]);
    $item["{$heading_key}_expiry_text_letter_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["expiry_text_letter_spacing"]);
    $item["{$heading_key}_expiry_text_letter_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["expiry_text_letter_spacing"]);

    $item["{$heading_key}_expiry_text_word_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["expiry_text_word_spacing"]);
    $item["{$heading_key}_expiry_text_word_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["expiry_text_word_spacing"]);
    $item["{$heading_key}_expiry_text_font_size_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["expiry_text_font_size"]);
    $item["{$heading_key}_expiry_text_font_size_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["expiry_text_font_size"]);

    $item["{$heading_key}_expiry_text_line_height_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["expiry_text_line_height"]);
    $item["{$heading_key}_expiry_text_line_height_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["expiry_text_line_height"]);
    $item["{$heading_key}_expiry_text_letter_spacing_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["expiry_text_letter_spacing"]);
    $item["{$heading_key}_expiry_text_letter_spacing_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["expiry_text_letter_spacing"]);

    $item["{$heading_key}_expiry_text_word_spacing_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["expiry_text_word_spacing"]);
    $item["{$heading_key}_expiry_text_word_spacing_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["expiry_text_word_spacing"]);

    $item["{$heading_key}_disclaimer_text_font_family"] = update_dafaultfontfamily($item["{$heading_key}_disclaimer_text_font_family"], 
    isset($hide_users["defaults"]["typography"][$heading_key]["disclaimer_text_font_family"]) ? $hide_users["defaults"]["typography"][$heading_key]["disclaimer_text_font_family"] : '', 
    $hide_users);

    $item["{$heading_key}_disclaimer_text_font_weight"] = isset($hide_users["defaults"]["typography"][$heading_key]["disclaimer_text_font_weight"]) ? $hide_users["defaults"]["typography"][$heading_key]["disclaimer_text_font_weight"] : '';

    $item["{$heading_key}_disclaimer_text_text_transform"] = isset($hide_users["defaults"]["typography"][$heading_key]["disclaimer_text_text_transform"]) ? $hide_users["defaults"]["typography"][$heading_key]["disclaimer_text_text_transform"] : '';

    $item["{$heading_key}_disclaimer_text_font_style"] = isset($hide_users["defaults"]["typography"][$heading_key]["disclaimer_text_font_style"]) ? $hide_users["defaults"]["typography"][$heading_key]["disclaimer_text_font_style"] : '';
    $item["{$heading_key}_disclaimer_text_text_decoration"] = $hide_users["defaults"]["typography"][$heading_key]["disclaimer_text_text_decoration"];
    $item["{$heading_key}_disclaimer_text_color"] = $hide_users["defaults"]["typography"][$heading_key]["disclaimer_text_color"];
    $item["{$heading_key}_disclaimer_text_font_size"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["disclaimer_text_font_size"]);
    $item["{$heading_key}_disclaimer_text_font_size"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["disclaimer_text_font_size"]);

    $item["{$heading_key}_disclaimer_text_line_height"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["disclaimer_text_line_height"]);
    $item["{$heading_key}_disclaimer_text_line_height"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["disclaimer_text_line_height"]);
    $item["{$heading_key}_disclaimer_text_letter_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["disclaimer_text_letter_spacing"]);
    $item["{$heading_key}_disclaimer_text_letter_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["disclaimer_text_letter_spacing"]);

    $item["{$heading_key}_disclaimer_text_word_spacing"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["disclaimer_text_word_spacing"]);
    $item["{$heading_key}_disclaimer_text_word_spacing"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["disclaimer_text_word_spacing"]);
    $item["{$heading_key}_disclaimer_text_font_size_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["disclaimer_text_font_size"]);
    $item["{$heading_key}_disclaimer_text_font_size_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["disclaimer_text_font_size"]);

    $item["{$heading_key}_disclaimer_text_line_height_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["disclaimer_text_line_height"]);
    $item["{$heading_key}_disclaimer_text_line_height_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["disclaimer_text_line_height"]);
    $item["{$heading_key}_disclaimer_text_letter_spacing_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["disclaimer_text_letter_spacing"]);
    $item["{$heading_key}_disclaimer_text_letter_spacing_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["disclaimer_text_letter_spacing"]);

    $item["{$heading_key}_disclaimer_text_word_spacing_mobile"]["size"] = str_replace(range("a", "z"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["disclaimer_text_word_spacing"]);
    $item["{$heading_key}_disclaimer_text_word_spacing_mobile"]["unit"] = str_replace(range("0", "9"), "", $hide_users["defaults"]["typography"][$heading_key]["mobile"]["disclaimer_text_word_spacing"]);
    // ... update other typography settings ...
}

function update_fonts(&$item, $hide_users, $heading_key)
{
    $item["default_font_family_font_family"] = $hide_users["defaults"][$heading_key]["default_font_family"];
    $item["alternate_font_family_1_font_family"] = $hide_users["defaults"][$heading_key]["alternate_font_family_1"];
    $item["alternate_font_family_2_font_family"] = $hide_users["defaults"][$heading_key]["alternate_font_family_2"];
    $item["alternate_font_family_3_font_family"] = $hide_users["defaults"][$heading_key]["alternate_font_family_3"];
}
function update_callbtn_bg(&$item, $hide_users, $heading_key)
{
    $item["{$heading_key}_background_color"] = $hide_users["defaults"]["typography"][$heading_key]["background_color"];
}
function rds_design_template($design_arr)
{
    global $wpdb;
    $tableNameg = $wpdb->prefix . "postmeta";
    $hide_users = $design_arr;

    $document = get_option("elementor_active_kit");
    $objectnew = get_post_meta($document, "_elementor_page_settings");
    $json = json_encode($objectnew);
    $datanew = json_decode($json, true);
    // echo '<pre>';
    // print_r($datanew);die('hello');

    if ($datanew !== null) {
        foreach ($datanew as &$item) {
            if (isset($item["system_colors"])) {
                foreach ($item["system_colors"] as &$color) {
                    update_color_or_typography($color, "primary", $hide_users["defaults"]["colors"]["primary"]);
                    update_color_or_typography($color, "secondary", $hide_users["defaults"]["colors"]["secondary"]);
                    update_color_or_typography($color, "tertiary", $hide_users["defaults"]["colors"]["tertiary"]);
                    update_color_or_typography($color, "quaternary", $hide_users["defaults"]["colors"]["quaternary"]);
                    // ... update other colors ...
                }

                foreach ($item["custom_colors"] as &$ccolor) {
                    update_color_or_typography($ccolor, "true_white", isset($hide_users["defaults"]["colors"]["true_white"]) ? $hide_users["defaults"]["colors"]["true_white"] : '');
                    update_color_or_typography($ccolor, "true_black", isset($hide_users["defaults"]["colors"]["true_black"]) ? $hide_users["defaults"]["colors"]["true_black"] : '');
                    update_color_or_typography($ccolor, "stars_color", isset($hide_users["defaults"]["colors"]["stars_color"]) ? $hide_users["defaults"]["colors"]["stars_color"] : '');
                    update_color_or_typography($ccolor, "error_color", isset($hide_users["defaults"]["colors"]["error_color"]) ? $hide_users["defaults"]["colors"]["error_color"] : '');
                    update_color_or_typography($ccolor, "contact_form_border", isset($hide_users["defaults"]["colors"]["contact_form_border"]) ? $hide_users["defaults"]["colors"]["contact_form_border"] : '');
                    update_color_or_typography($ccolor, "callbtn_bg", isset($hide_users["defaults"]["colors"]["callbtn_bg"]) ? $hide_users["defaults"]["colors"]["callbtn_bg"] : '');
                    // ... update other custom colors ...
                }


                foreach ($item["system_typography"] as &$ctypo) {
                    update_font_family($ctypo, "primary", $hide_users["defaults"]["fonts"]["default_font_family"], "default_font_family");
                    update_font_family($ctypo, "secondary", $hide_users["defaults"]["fonts"]["alternate_font_family_1"], "alternate_font_family_1");
                    update_font_family($ctypo, "text", $hide_users["defaults"]["fonts"]["alternate_font_family_2"], "alternate_font_family_2");
                    update_font_family($ctypo, "accent", $hide_users["defaults"]["fonts"]["alternate_font_family_3"], "alternate_font_family_3");
                    // ... update other system typography ...
                }

                // foreach ($item["custom_typography"] as &$ctypo) {
                //  update_font_family($ctypo, "default_font_family", $hide_users['defaults']['fonts']['default_font_family']);
                //  update_font_family($ctypo, "alternate_font_family_1", $hide_users['defaults']['fonts']['alternate_font_family_1']);
                //  update_font_family($ctypo, "alternate_font_family_2", $hide_users['defaults']['fonts']['alternate_font_family_2']);
                //  update_font_family($ctypo, "alternate_font_family_3", $hide_users['defaults']['fonts']['alternate_font_family_3']);
                //  // ... update other custom typography ...
                // }

                // update_body($item, $hide_users, 'body');
                update_typography($item, $hide_users, "h1");
                update_typography($item, $hide_users, "h2");
                update_typography($item, $hide_users, "h3");
                update_typography($item, $hide_users, "h4");
                update_typography($item, $hide_users, "h5");
                update_typography($item, $hide_users, "h6");
                update_typography_alt($item, $hide_users, "p");
                update_typography_alt($item, $hide_users, "strong");
                update_typography_alt($item, $hide_users, "li");
                update_typography_alt($item, $hide_users, "em");
                update_typography_alt($item, $hide_users, "h7");
                update_typography_alt($item, $hide_users, "h8");
                update_typography_hover($item, $hide_users, "footer_phone_number");
                update_typography_text_footerhover($item, $hide_users, "footer_links");
                update_typography_text_hover($item, $hide_users, "phone_number");
                update_typography($item, $hide_users, "default");
                update_typography_hero($item, $hide_users, "hero");
                //update_typography($item, $hide_users, 'footer_links');
                //update_typography($item, $hide_users, 'footer_phone_number');
                update_typography_bar($item, $hide_users, "announcement_bar");
                update_typography_call($item, $hide_users, "call_today");
                //update_typography($item, $hide_users, 'phone_number');
                update_typography_link($item, $hide_users, "link_normal");
                update_typography_link_hover($item, $hide_users, "link_hover");
                //display class settings
                update_displaytypography($item, $hide_users, "display_1");
                update_displaytypography($item, $hide_users, "display_2");
                //color update
                update_single_color($item, $hide_users, "footer_phone_icon");
                update_single_color($item, $hide_users, "footer_license_icon");
                update_copyright($item, $hide_users, "copyright");
                update_blog($item, $hide_users, "blog");
                update_alt($item, $hide_users, "aalt");
                update_h1($item, $hide_users, "h1alt");
                update_h2($item, $hide_users, "h2alt");
                update_h3($item, $hide_users, "h3alt");
                update_h4($item, $hide_users, "h4alt");
                update_h5($item, $hide_users, "h5alt");
                update_h6($item, $hide_users, "h6alt");
                //color update
                update_color_hover($item, $hide_users, "social_media_icons");
                //update_mobile_popup_form($item, $hide_users, 'mobile_popup_form');
                update_thankyou($item, $hide_users, "thankyou");
                update_pagenotfound($item, $hide_users, "pagenotfound");
                update_popup($item, $hide_users, "mobile_cta_popup");
                update_form($item, $hide_users, "hero_banner_and_request_service");

                update_typography_button($item, $hide_users, "button_primary");
                update_typography_button($item, $hide_users, "button_secondary");
                update_service_block_hover($item, $hide_users, "service_block_hover");

                update_navigation($item, $hide_users, "navigation");
                update_coupon($item, $hide_users, "coupon");
                update_callbtn_bg($item, $hide_users, "callbtn_bg");
                // update_fonts($item, $hide_users, 'fonts');

                // ... handle other settings ...
            }
        }
    } else {
        echo "Invalid JSON.";
    }

    if (is_array($datanew) && isset($datanew[0])) {
        $updated = update_post_meta($document, "_elementor_page_settings", $datanew[0]);
        if (!$updated) {
            echo "The field has not been updated";
        }
    } else {
        echo "The expected array structure is not present.";
    }
}

add_action("rds_design", "rds_design_template");

//  function defined design spec to elementor END

add_action("elementor/editor/after_save", "my_custom_function_after_save_template2", 10, 2);

function my_custom_function_after_save_template2($post_id, $editor_data)
{
    //  function defined  elementor to design spec Start

    if($editor_data){
        return;
    }
    function update_setting($id, &$target, $value)
    {
        if (array_key_exists($id, $target)) {
            $target[$id] = $value;
        }
    }
  
    function update_heading_typography(&$item, &$target, $headingKey)
    {
        $target[$headingKey]["font_family"] = $item["{$headingKey}_typography_font_family"];
        $target[$headingKey]["font_weight"] = $item["{$headingKey}_typography_font_weight"];
        $target[$headingKey]["text_transform"] = $item["{$headingKey}_typography_text_transform"];
        $target[$headingKey]["font_style"] = $item["{$headingKey}_typography_font_style"];
        $target[$headingKey]["text_decoration"] = $item["{$headingKey}_typography_text_decoration"];
        $target[$headingKey]["color"] = $item["{$headingKey}_color"];
        $target[$headingKey]["font_size"] = $item["{$headingKey}_typography_font_size"]["size"] . $item["{$headingKey}_typography_font_size"]["unit"];
        $target[$headingKey]["mobile"]["font_size"] = $item["{$headingKey}_typography_font_size_mobile"]["size"] . $item["{$headingKey}_typography_font_size_mobile"]["unit"];
        $target[$headingKey]["line_height"] = $item["{$headingKey}_typography_line_height"]["size"] . $item["{$headingKey}_typography_line_height"]["unit"];
        $target[$headingKey]["mobile"]["line_height"] = $item["{$headingKey}_typography_line_height_mobile"]["size"] . $item["{$headingKey}_typography_line_height_mobile"]["unit"];
        $target[$headingKey]["letter_spacing"] = $item["{$headingKey}_typography_letter_spacing"]["size"] . $item["{$headingKey}_typography_letter_spacing"]["unit"];
        $target[$headingKey]["mobile"]["letter_spacing"] = $item["{$headingKey}_typography_letter_spacing_mobile"]["size"] . $item["{$headingKey}_typography_letter_spacing_mobile"]["unit"];
        $target[$headingKey]["word_spacing"] = $item["{$headingKey}_typography_word_spacing"]["size"] . $item["{$headingKey}_typography_word_spacing"]["unit"];
        $target[$headingKey]["mobile"]["word_spacing"] = $item["{$headingKey}_typography_word_spacing_mobile"]["size"] . $item["{$headingKey}_typography_word_spacing_mobile"]["unit"];
    }
    function update_heading_typography_hero(&$item, &$target, $headingKey)
    {
        // $target[$headingKey]["font_family"] = $item["{$headingKey}_typography_font_family"];
        // $target[$headingKey]["font_weight"] = $item["{$headingKey}_typography_font_weight"];
        // $target[$headingKey]["text_transform"] = $item["{$headingKey}_typography_text_transform"];
        // $target[$headingKey]["font_style"] = $item["{$headingKey}_typography_font_style"];
        // $target[$headingKey]["text_decoration"] = $item["{$headingKey}_typography_text_decoration"];
        // $target[$headingKey]["color"] = $item["{$headingKey}_color"];
         $target[$headingKey]["banner_form_background"] = $item["{$headingKey}_bg_color"];
        // $target[$headingKey]["font_size"] = $item["{$headingKey}_typography_font_size"]["size"] . $item["{$headingKey}_typography_font_size"]["unit"];
        // $target[$headingKey]["mobile"]["font_size"] = $item["{$headingKey}_typography_font_size_mobile"]["size"] . $item["{$headingKey}_typography_font_size_mobile"]["unit"];
        // $target[$headingKey]["line_height"] = $item["{$headingKey}_typography_line_height"]["size"] . $item["{$headingKey}_typography_line_height"]["unit"];
        // $target[$headingKey]["mobile"]["line_height"] = $item["{$headingKey}_typography_line_height_mobile"]["size"] . $item["{$headingKey}_typography_line_height_mobile"]["unit"];
        // $target[$headingKey]["letter_spacing"] = $item["{$headingKey}_typography_letter_spacing"]["size"] . $item["{$headingKey}_typography_letter_spacing"]["unit"];
        // $target[$headingKey]["mobile"]["letter_spacing"] = $item["{$headingKey}_typography_letter_spacing_mobile"]["size"] . $item["{$headingKey}_typography_letter_spacing_mobile"]["unit"];
        // $target[$headingKey]["word_spacing"] = $item["{$headingKey}_typography_word_spacing"]["size"] . $item["{$headingKey}_typography_word_spacing"]["unit"];
        // $target[$headingKey]["mobile"]["word_spacing"] = $item["{$headingKey}_typography_word_spacing_mobile"]["size"] . $item["{$headingKey}_typography_word_spacing_mobile"]["unit"];
    }
    function update_heading_typography_call(&$item, &$target, $headingKey)
    {
        $target[$headingKey]["font_family"] = $item["{$headingKey}_typography_font_family"];
        $target[$headingKey]["font_weight"] = $item["{$headingKey}_typography_font_weight"];
        $target[$headingKey]["text_transform"] = $item["{$headingKey}_typography_text_transform"];
        $target[$headingKey]["font_style"] = $item["{$headingKey}_typography_font_style"];
        $target[$headingKey]["text_decoration"] = $item["{$headingKey}_typography_text_decoration"];
        $target[$headingKey]["text_color"] = $item["{$headingKey}_color"];
        $target[$headingKey]["font_size"] = $item["{$headingKey}_typography_font_size"]["size"] . $item["{$headingKey}_typography_font_size"]["unit"];
        // $target[$headingKey]['mobile']['font_size'] = $item["{$headingKey}_typography_font_size_mobile"]['size'].$item["{$headingKey}_typography_font_size_mobile"]['unit'];
        $target[$headingKey]["line_height"] = $item["{$headingKey}_typography_line_height"]["size"] . $item["{$headingKey}_typography_line_height"]["unit"];
        // $target[$headingKey]['mobile']['line_height'] = $item["{$headingKey}_typography_line_height_mobile"]['size'].$item["{$headingKey}_typography_line_height_mobile"]['unit'];
        $target[$headingKey]["letter_spacing"] = $item["{$headingKey}_typography_letter_spacing"]["size"] . $item["{$headingKey}_typography_letter_spacing"]["unit"];
        // $target[$headingKey]['mobile']['letter_spacing'] = $item["{$headingKey}_typography_letter_spacing_mobile"]['size'].$item["{$headingKey}_typography_letter_spacing_mobile"]['unit'];
        $target[$headingKey]["word_spacing"] = $item["{$headingKey}_typography_word_spacing"]["size"] . $item["{$headingKey}_typography_word_spacing"]["unit"];
        //$target[$headingKey]['mobile']['word_spacing'] = $item["{$headingKey}_typography_word_spacing_mobile"]['size'].$item["{$headingKey}_typography_word_spacing_mobile"]['unit'];
    }
    function update_heading_typography_bar(&$item, &$target, $headingKey)
    {
        $target[$headingKey]["font_family"] = $item["{$headingKey}_typography_font_family"];
        $target[$headingKey]["font_weight"] = $item["{$headingKey}_typography_font_weight"];
        $target[$headingKey]["text_transform"] = $item["{$headingKey}_typography_text_transform"];
        $target[$headingKey]["font_style"] = $item["{$headingKey}_typography_font_style"];
        $target[$headingKey]["text_decoration"] = $item["{$headingKey}_typography_text_decoration"];
        $target[$headingKey]["text_color"] = $item["{$headingKey}_color"];
        $target[$headingKey]["text_hover"] = $item["{$headingKey}_hover_color"];
        $target[$headingKey]["font_size"] = $item["{$headingKey}_typography_font_size"]["size"] . $item["{$headingKey}_typography_font_size"]["unit"];
        $target[$headingKey]["mobile"]["font_size"] = $item["{$headingKey}_typography_font_size_mobile"]["size"] . $item["{$headingKey}_typography_font_size_mobile"]["unit"];
        $target[$headingKey]["line_height"] = $item["{$headingKey}_typography_line_height"]["size"] . $item["{$headingKey}_typography_line_height"]["unit"];
        $target[$headingKey]["mobile"]["line_height"] = $item["{$headingKey}_typography_line_height_mobile"]["size"] . $item["{$headingKey}_typography_line_height_mobile"]["unit"];
        $target[$headingKey]["letter_spacing"] = $item["{$headingKey}_typography_letter_spacing"]["size"] . $item["{$headingKey}_typography_letter_spacing"]["unit"];
        $target[$headingKey]["mobile"]["letter_spacing"] = $item["{$headingKey}_typography_letter_spacing_mobile"]["size"] . $item["{$headingKey}_typography_letter_spacing_mobile"]["unit"];
        $target[$headingKey]["word_spacing"] = $item["{$headingKey}_typography_word_spacing"]["size"] . $item["{$headingKey}_typography_word_spacing"]["unit"];
        $target[$headingKey]["mobile"]["word_spacing"] = $item["{$headingKey}_typography_word_spacing_mobile"]["size"] . $item["{$headingKey}_typography_word_spacing_mobile"]["unit"];
    }
    function update_heading_typography_alt(&$item, &$target, $headingKey)
    {
        $target[$headingKey]["font_family"] = $item["{$headingKey}_typography_font_family"];
        $target[$headingKey]["font_weight"] = $item["{$headingKey}_typography_font_weight"];
        $target[$headingKey]["text_transform"] = $item["{$headingKey}_typography_text_transform"];
        $target[$headingKey]["font_style"] = $item["{$headingKey}_typography_font_style"];
        $target[$headingKey]["text_decoration"] = $item["{$headingKey}_typography_text_decoration"];
        $target[$headingKey]["color"] = $item["{$headingKey}_color"];
        $target[$headingKey]["alt"]["color"] = $item["{$headingKey}_alt_color"];
        $target[$headingKey]["font_size"] = $item["{$headingKey}_typography_font_size"]["size"] . $item["{$headingKey}_typography_font_size"]["unit"];
        $target[$headingKey]["mobile"]["font_size"] = $item["{$headingKey}_typography_font_size_mobile"]["size"] . $item["{$headingKey}_typography_font_size_mobile"]["unit"];
        $target[$headingKey]["line_height"] = $item["{$headingKey}_typography_line_height"]["size"] . $item["{$headingKey}_typography_line_height"]["unit"];
        $target[$headingKey]["mobile"]["line_height"] = $item["{$headingKey}_typography_line_height_mobile"]["size"] . $item["{$headingKey}_typography_line_height_mobile"]["unit"];
        $target[$headingKey]["letter_spacing"] = $item["{$headingKey}_typography_letter_spacing"]["size"] . $item["{$headingKey}_typography_letter_spacing"]["unit"];
        $target[$headingKey]["mobile"]["letter_spacing"] = $item["{$headingKey}_typography_letter_spacing_mobile"]["size"] . $item["{$headingKey}_typography_letter_spacing_mobile"]["unit"];
        $target[$headingKey]["word_spacing"] = $item["{$headingKey}_typography_word_spacing"]["size"] . $item["{$headingKey}_typography_word_spacing"]["unit"];
        $target[$headingKey]["mobile"]["word_spacing"] = $item["{$headingKey}_typography_word_spacing_mobile"]["size"] . $item["{$headingKey}_typography_word_spacing_mobile"]["unit"];
    }
    function update_heading_typography_hover(&$item, &$target, $headingKey)
    {
        $target[$headingKey]["font_family"] = $item["{$headingKey}_typography_font_family"];
        $target[$headingKey]["font_weight"] = $item["{$headingKey}_typography_font_weight"];
        $target[$headingKey]["text_transform"] = $item["{$headingKey}_typography_text_transform"];
        $target[$headingKey]["font_style"] = $item["{$headingKey}_typography_font_style"];
        $target[$headingKey]["text_decoration"] = $item["{$headingKey}_typography_text_decoration"];
        $target[$headingKey]["color"] = $item["{$headingKey}_color"];
        $target[$headingKey]["hover"] = $item["{$headingKey}_hover_color"];
        $target[$headingKey]["font_size"] = $item["{$headingKey}_typography_font_size"]["size"] . $item["{$headingKey}_typography_font_size"]["unit"];
        $target[$headingKey]["mobile"]["font_size"] = $item["{$headingKey}_typography_font_size_mobile"]["size"] . $item["{$headingKey}_typography_font_size_mobile"]["unit"];
        $target[$headingKey]["line_height"] = $item["{$headingKey}_typography_line_height"]["size"] . $item["{$headingKey}_typography_line_height"]["unit"];
        $target[$headingKey]["mobile"]["line_height"] = $item["{$headingKey}_typography_line_height_mobile"]["size"] . $item["{$headingKey}_typography_line_height_mobile"]["unit"];
        $target[$headingKey]["letter_spacing"] = $item["{$headingKey}_typography_letter_spacing"]["size"] . $item["{$headingKey}_typography_letter_spacing"]["unit"];
        $target[$headingKey]["mobile"]["letter_spacing"] = $item["{$headingKey}_typography_letter_spacing_mobile"]["size"] . $item["{$headingKey}_typography_letter_spacing_mobile"]["unit"];
        $target[$headingKey]["word_spacing"] = $item["{$headingKey}_typography_word_spacing"]["size"] . $item["{$headingKey}_typography_word_spacing"]["unit"];
        $target[$headingKey]["mobile"]["word_spacing"] = $item["{$headingKey}_typography_word_spacing_mobile"]["size"] . $item["{$headingKey}_typography_word_spacing_mobile"]["unit"];
    }
    function update_heading_typography_text_footerhover(&$item, &$target, $headingKey)
    {
        $target[$headingKey]["font_family"] = $item["{$headingKey}_typography_font_family"];
        $target[$headingKey]["font_weight"] = $item["{$headingKey}_typography_font_weight"];
        $target[$headingKey]["text_transform"] = $item["{$headingKey}_typography_text_transform"];
        $target[$headingKey]["font_style"] = $item["{$headingKey}_typography_font_style"];
        $target[$headingKey]["text_decoration"] = $item["{$headingKey}_typography_text_decoration"];
        $target[$headingKey]["color"] = $item["{$headingKey}_color"];
        $target[$headingKey]["hover"] = $item["{$headingKey}_hover_color"];
        $target[$headingKey]["font_size"] = $item["{$headingKey}_typography_font_size"]["size"] . $item["{$headingKey}_typography_font_size"]["unit"];
        $target[$headingKey]["line_height"] = $item["{$headingKey}_typography_line_height"]["size"] . $item["{$headingKey}_typography_line_height"]["unit"];
        $target[$headingKey]["letter_spacing"] = $item["{$headingKey}_typography_letter_spacing"]["size"] . $item["{$headingKey}_typography_letter_spacing"]["unit"];
        $target[$headingKey]["word_spacing"] = $item["{$headingKey}_typography_word_spacing"]["size"] . $item["{$headingKey}_typography_word_spacing"]["unit"];
    }
    function update_heading_typography_text_hover(&$item, &$target, $headingKey)
    {
        $target[$headingKey]["font_family"] = $item["{$headingKey}_typography_font_family"];
        $target[$headingKey]["font_weight"] = $item["{$headingKey}_typography_font_weight"];
        $target[$headingKey]["text_transform"] = $item["{$headingKey}_typography_text_transform"];
        $target[$headingKey]["font_style"] = $item["{$headingKey}_typography_font_style"];
        $target[$headingKey]["text_decoration"] = $item["{$headingKey}_typography_text_decoration"];
        $target[$headingKey]["text_color"] = $item["{$headingKey}_color"];
        $target[$headingKey]["hover"] = $item["{$headingKey}_hover_color"];
        $target[$headingKey]["font_size"] = $item["{$headingKey}_typography_font_size"]["size"] . $item["{$headingKey}_typography_font_size"]["unit"];
        $target[$headingKey]["mobile"]["font_size"] = $item["{$headingKey}_typography_font_size_mobile"]["size"] . $item["{$headingKey}_typography_font_size_mobile"]["unit"];
        $target[$headingKey]["line_height"] = $item["{$headingKey}_typography_line_height"]["size"] . $item["{$headingKey}_typography_line_height"]["unit"];
        $target[$headingKey]["mobile"]["line_height"] = $item["{$headingKey}_typography_line_height_mobile"]["size"] . $item["{$headingKey}_typography_line_height_mobile"]["unit"];
        $target[$headingKey]["letter_spacing"] = $item["{$headingKey}_typography_letter_spacing"]["size"] . $item["{$headingKey}_typography_letter_spacing"]["unit"];
        $target[$headingKey]["mobile"]["letter_spacing"] = $item["{$headingKey}_typography_letter_spacing_mobile"]["size"] . $item["{$headingKey}_typography_letter_spacing_mobile"]["unit"];
        $target[$headingKey]["word_spacing"] = $item["{$headingKey}_typography_word_spacing"]["size"] . $item["{$headingKey}_typography_word_spacing"]["unit"];
        $target[$headingKey]["mobile"]["word_spacing"] = $item["{$headingKey}_typography_word_spacing_mobile"]["size"] . $item["{$headingKey}_typography_word_spacing_mobile"]["unit"];
    }
    function update_link_typography(&$item, &$target, $headingKey)
    {
        $target["a"]["font_family"] = $item["{$headingKey}_typography_font_family"];
        $target["a"]["font_weight"] = $item["{$headingKey}_typography_font_weight"];
        $target["a"]["text_transform"] = $item["{$headingKey}_typography_text_transform"];
        $target["a"]["font_style"] = $item["{$headingKey}_typography_font_style"];
        $target["a"]["text_decoration"] = $item["{$headingKey}_typography_text_decoration"];
        $target["a"]["color"] = $item["{$headingKey}_color"];
        $target["a"]["font_size"] = $item["{$headingKey}_typography_font_size"]["size"] . $item["{$headingKey}_typography_font_size"]["unit"];
        $target["a"]["mobile"]["font_size"] = $item["{$headingKey}_typography_font_size_mobile"]["size"] . $item["{$headingKey}_typography_font_size_mobile"]["unit"];
        $target["a"]["line_height"] = $item["{$headingKey}_typography_line_height"]["size"] . $item["{$headingKey}_typography_line_height"]["unit"];
        $target["a"]["mobile"]["line_height"] = $item["{$headingKey}_typography_line_height_mobile"]["size"] . $item["{$headingKey}_typography_line_height_mobile"]["unit"];
        $target["a"]["letter_spacing"] = $item["{$headingKey}_typography_letter_spacing"]["size"] . $item["{$headingKey}_typography_letter_spacing"]["unit"];
        $target["a"]["mobile"]["letter_spacing"] = $item["{$headingKey}_typography_letter_spacing_mobile"]["size"] . $item["{$headingKey}_typography_letter_spacing_mobile"]["unit"];
        $target["a"]["word_spacing"] = $item["{$headingKey}_typography_word_spacing"]["size"] . $item["{$headingKey}_typography_word_spacing"]["unit"];
        $target["a"]["mobile"]["word_spacing"] = $item["{$headingKey}_typography_word_spacing_mobile"]["size"] . $item["{$headingKey}_typography_word_spacing_mobile"]["unit"];
    }
    function update_link_typography_hover(&$item, &$target, $headingKey)
    {   
        if (isset($item["{$headingKey}_typography_font_family"])) {
        $target["a"]["hover"]["font_family"] = $item["{$headingKey}_typography_font_family"];
        }
        $target["a"]["hover"]["font_weight"] = $item["{$headingKey}_typography_font_weight"];
		if (isset($item["{$headingKey}_typography_text_transform"])) {
        $target["a"]["hover"]["text_transform"] = $item["{$headingKey}_typography_text_transform"];
		}
        $target["a"]["hover"]["font_style"] = $item["{$headingKey}_typography_font_style"];
        $target["a"]["hover"]["text_decoration"] = $item["{$headingKey}_typography_text_decoration"];
        $target["a"]["hover"]["color"] = $item["{$headingKey}_color"];
        $target["a"]["hover"]["font_size"] = $item["{$headingKey}_typography_font_size"]["size"] . $item["{$headingKey}_typography_font_size"]["unit"];
        $target["a"]["hover"]["mobile"]["font_size"] = $item["{$headingKey}_typography_font_size_mobile"]["size"] . $item["{$headingKey}_typography_font_size_mobile"]["unit"];
        $target["a"]["hover"]["line_height"] = $item["{$headingKey}_typography_line_height"]["size"] . $item["{$headingKey}_typography_line_height"]["unit"];
        $target["a"]["hover"]["mobile"]["line_height"] = $item["{$headingKey}_typography_line_height_mobile"]["size"] . $item["{$headingKey}_typography_line_height_mobile"]["unit"];
        $target["a"]["hover"]["letter_spacing"] = $item["{$headingKey}_typography_letter_spacing"]["size"] . $item["{$headingKey}_typography_letter_spacing"]["unit"];
        $target["a"]["hover"]["mobile"]["letter_spacing"] = $item["{$headingKey}_typography_letter_spacing_mobile"]["size"] . $item["{$headingKey}_typography_letter_spacing_mobile"]["unit"];
        $target["a"]["hover"]["word_spacing"] = $item["{$headingKey}_typography_word_spacing"]["size"] . $item["{$headingKey}_typography_word_spacing"]["unit"];
        $target["a"]["hover"]["mobile"]["word_spacing"] = $item["{$headingKey}_typography_word_spacing_mobile"]["size"] . $item["{$headingKey}_typography_word_spacing_mobile"]["unit"];
    }
    function update_display_typography(&$item, &$target, $headingKey)
    {
        $target[$headingKey]["hero_font_family"] = $item["{$headingKey}_typography_font_family"];
        $target[$headingKey]["hero_font_weight"] = $item["{$headingKey}_typography_font_weight"];
        $target[$headingKey]["hero_text_transform"] = $item["{$headingKey}_typography_text_transform"];
        $target[$headingKey]["hero_font_style"] = $item["{$headingKey}_typography_font_style"];
        $target[$headingKey]["hero_text_decoration"] = $item["{$headingKey}_typography_text_decoration"];
		if (isset($item["{$headingKey}_color"])) {
        $target[$headingKey]["hero_color"] = $item["{$headingKey}_color"];
		}
        $target[$headingKey]["hero_font_size"] = $item["{$headingKey}_typography_font_size"]["size"] . $item["{$headingKey}_typography_font_size"]["unit"];
        $target[$headingKey]["hero_mobile"]["font_size"] = $item["{$headingKey}_typography_font_size_mobile"]["size"] . $item["{$headingKey}_typography_font_size_mobile"]["unit"];
        $target[$headingKey]["hero_line_height"] = $item["{$headingKey}_typography_line_height"]["size"] . $item["{$headingKey}_typography_line_height"]["unit"];
        $target[$headingKey]["hero_mobile"]["line_height"] = $item["{$headingKey}_typography_line_height_mobile"]["size"] . $item["{$headingKey}_typography_line_height_mobile"]["unit"];
        $target[$headingKey]["hero_letter_spacing"] = $item["{$headingKey}_typography_letter_spacing"]["size"] . $item["{$headingKey}_typography_letter_spacing"]["unit"];
        $target[$headingKey]["hero_mobile"]["letter_spacing"] = $item["{$headingKey}_typography_letter_spacing_mobile"]["size"] . $item["{$headingKey}_typography_letter_spacing_mobile"]["unit"];
        $target[$headingKey]["hero_word_spacing"] = $item["{$headingKey}_typography_word_spacing"]["size"] . $item["{$headingKey}_typography_word_spacing"]["unit"];
        $target[$headingKey]["hero_mobile"]["word_spacing"] = $item["{$headingKey}_typography_word_spacing_mobile"]["size"] . $item["{$headingKey}_typography_word_spacing_mobile"]["unit"];
    }
    function update_color(&$item, &$target, $headingKey)
    {
        $target[$headingKey]["color"] = $item["{$headingKey}_color"];
    }
    function update_copyrightnew(&$item, &$target, $headingKey)
    {
        $target[$headingKey]["hover"] = $item["{$headingKey}_color"];
    }

    function update_blognew(&$item, &$target, $headingKey)
    {
        $target[$headingKey]["read_more_text_color"] = $item["{$headingKey}_color"];
        $target[$headingKey]["read_more_text_color_hover"] = $item["{$headingKey}_hover_color"];
    }
    function update_altnew(&$item, &$target, $headingKey)
    {
        $target["a"]["alt"]["color"] = $item["{$headingKey}_color"];
    }
    function update_h1_new(&$item, &$target, $headingKey)
    {
        $target["h1"]["alt"]["color"] = $item["{$headingKey}_color"];
    }
    function update_h2_new(&$item, &$target, $headingKey)
    {
        $target["h2"]["alt"]["color"] = $item["{$headingKey}_color"];
    }
    function update_h3_new(&$item, &$target, $headingKey)
    {
        $target["h3"]["alt"]["color"] = $item["{$headingKey}_color"];
    }
    function update_h4_new(&$item, &$target, $headingKey)
    {
        $target["h4"]["alt"]["color"] = $item["{$headingKey}_color"];
    }
    function update_h5_new(&$item, &$target, $headingKey)
    {
        $target["h5"]["alt"]["color"] = $item["{$headingKey}_color"];
    }
    function update_h6_new(&$item, &$target, $headingKey)
    {
        $target["h6"]["alt"]["color"] = $item["{$headingKey}_color"];
    }
    function update_hover_color(&$item, &$target, $headingKey)
    {
        $target[$headingKey]["color"] = $item["{$headingKey}_color"];
        $target[$headingKey]["hover"] = $item["{$headingKey}_hover_color"];
    }
    function update_reverse_mobile_popup_form(&$item, &$target, $headingKey)
    {
        $target[$headingKey]["form_background"] = $item["{$headingKey}_form_background"];
        $target[$headingKey]["input_text_color"] = $item["{$headingKey}_input_text_color"];
        $target[$headingKey]["background_color"] = $item["{$headingKey}_background_color"];
        $target[$headingKey]["border_color"] = $item["{$headingKey}_border_color"];
    }
    function update_reverse_thankyou(&$item, &$target, $headingKey)
    {
        $target[$headingKey]["page_heading_color"] = $item["{$headingKey}_page_heading_color"];
        $target[$headingKey]["page_content_color"] = $item["{$headingKey}_page_content_color"];
    }
    function update_reverse_pagenotfound(&$item, &$target, $headingKey)
    {
        $target[$headingKey]["display_1"] = $item["{$headingKey}_display_1"];
        $target[$headingKey]["display_2"] = $item["{$headingKey}_display_2"];
    }
    function update_reverse_popup(&$item, &$target, $headingKey)
    {
        $target[$headingKey]["form_background"] = $item["{$headingKey}_form_background"];
        $target[$headingKey]["input_text_color"] = $item["{$headingKey}_text_color"];
        $target[$headingKey]["input_background_color"] = $item["{$headingKey}_background_color"];
        $target[$headingKey]["input_border_color"] = $item["{$headingKey}_border_color"];

        $target[$headingKey]["font_family"] = $item["{$headingKey}_typography_font_family"];
        $target[$headingKey]["font_weight"] = $item["{$headingKey}_typography_font_weight"];
        $target[$headingKey]["text_transform"] = $item["{$headingKey}_typography_text_transform"];
        $target[$headingKey]["font_style"] = $item["{$headingKey}_typography_font_style"];
        $target[$headingKey]["text_decoration"] = $item["{$headingKey}_typography_text_decoration"];

        $target[$headingKey]["font_size"] = $item["{$headingKey}_typography_font_size_mobile"]["size"] . $item["{$headingKey}_typography_font_size_mobile"]["unit"];

        $target[$headingKey]["line_height"] = $item["{$headingKey}_typography_line_height_mobile"]["size"] . $item["{$headingKey}_typography_line_height_mobile"]["unit"];

        $target[$headingKey]["letter_spacing"] = $item["{$headingKey}_typography_letter_spacing_mobile"]["size"] . $item["{$headingKey}_typography_letter_spacing_mobile"]["unit"];

        $target[$headingKey]["word_spacing"] = $item["{$headingKey}_typography_word_spacing_mobile"]["size"] . $item["{$headingKey}_typography_word_spacing_mobile"]["unit"];
    }
    function update_reverse_form(&$item, &$target, $headingKey)
    {
        $target[$headingKey]["text_color"] = $item["{$headingKey}_text_color"];
        $target[$headingKey]["border_color"] = $item["{$headingKey}_border_color"];
    }
    function update_heading_button(&$item, &$target, $headingKey)
    {
        $target[$headingKey]["font_family"] = $item["{$headingKey}_typography_font_family"];
        $target[$headingKey]["font_weight"] = $item["{$headingKey}_typography_font_weight"];
        $target[$headingKey]["text_transform"] = $item["{$headingKey}_typography_text_transform"];
        $target[$headingKey]["font_style"] = $item["{$headingKey}_typography_font_style"];
        $target[$headingKey]["text_decoration"] = $item["{$headingKey}_typography_text_decoration"];
        $target[$headingKey]["color"] = $item["{$headingKey}_color"];
        $target[$headingKey]["background_color"] = $item["{$headingKey}_bgcolor"];
        $target[$headingKey]["border_radius"] =
            $item["{$headingKey}_border_radius"]["top"] .
            $item["{$headingKey}_border_radius"]["unit"] .
            " " .
            $item["{$headingKey}_border_radius"]["right"] .
            $item["{$headingKey}_border_radius"]["unit"] .
            " " .
            $item["{$headingKey}_border_radius"]["bottom"] .
            $item["{$headingKey}_border_radius"]["unit"] .
            " " .
            $item["{$headingKey}_border_radius"]["left"] .
            $item["{$headingKey}_border_radius"]["unit"];
        $target[$headingKey]["font_size"] = $item["{$headingKey}_typography_font_size"]["size"] . $item["{$headingKey}_typography_font_size"]["unit"];
        $target[$headingKey]["mobile"]["font_size"] = $item["{$headingKey}_typography_font_size_mobile"]["size"] . $item["{$headingKey}_typography_font_size_mobile"]["unit"];
        $target[$headingKey]["line_height"] = $item["{$headingKey}_typography_line_height"]["size"] . $item["{$headingKey}_typography_line_height"]["unit"];
        $target[$headingKey]["mobile"]["line_height"] = $item["{$headingKey}_typography_line_height_mobile"]["size"] . $item["{$headingKey}_typography_line_height_mobile"]["unit"];
        $target[$headingKey]["letter_spacing"] = $item["{$headingKey}_typography_letter_spacing"]["size"] . $item["{$headingKey}_typography_letter_spacing"]["unit"];
        $target[$headingKey]["mobile"]["letter_spacing"] = $item["{$headingKey}_typography_letter_spacing_mobile"]["size"] . $item["{$headingKey}_typography_letter_spacing_mobile"]["unit"];
        $target[$headingKey]["word_spacing"] = $item["{$headingKey}_typography_word_spacing"]["size"] . $item["{$headingKey}_typography_word_spacing"]["unit"];
        $target[$headingKey]["mobile"]["word_spacing"] = $item["{$headingKey}_typography_word_spacing_mobile"]["size"] . $item["{$headingKey}_typography_word_spacing_mobile"]["unit"];

        $target[$headingKey]["hover"]["color"] = $item["{$headingKey}_hover_color"];
        $target[$headingKey]["hover"]["background_color"] = $item["{$headingKey}_hover_bg_color"];
        $target[$headingKey]["hover"]["border_radius"] =
            $item["{$headingKey}_border_radius_hover"]["top"] .
            $item["{$headingKey}_border_radius_hover"]["unit"] .
            " " .
            $item["{$headingKey}_border_radius_hover"]["right"] .
            $item["{$headingKey}_border_radius_hover"]["unit"] .
            " " .
            $item["{$headingKey}_border_radius_hover"]["bottom"] .
            $item["{$headingKey}_border_radius_hover"]["unit"] .
            " " .
            $item["{$headingKey}_border_radius_hover"]["left"] .
            $item["{$headingKey}_border_radius_hover"]["unit"];

        $target[$headingKey]["alt"]["font_family"] = $item["{$headingKey}_alt_typography_font_family"];
        $target[$headingKey]["alt"]["font_weight"] = $item["{$headingKey}_alt_typography_font_weight"];
        $target[$headingKey]["alt"]["text_transform"] = $item["{$headingKey}_alt_typography_text_transform"];
        $target[$headingKey]["alt"]["font_style"] = $item["{$headingKey}_alt_typography_font_style"];
        $target[$headingKey]["alt"]["text_decoration"] = $item["{$headingKey}_alt_typography_text_decoration"];
        $target[$headingKey]["alt"]["color"] = $item["{$headingKey}_alt_color"];
        $target[$headingKey]["alt"]["background_color"] = $item["{$headingKey}_alt_bgcolor"];
        $target[$headingKey]["alt"]["border_radius"] =
            $item["{$headingKey}_border_radius_alt"]["top"] .
            $item["{$headingKey}_border_radius_alt"]["unit"] .
            " " .
            $item["{$headingKey}_border_radius_alt"]["right"] .
            $item["{$headingKey}_border_radius_alt"]["unit"] .
            " " .
            $item["{$headingKey}_border_radius_alt"]["bottom"] .
            $item["{$headingKey}_border_radius_alt"]["unit"] .
            " " .
            $item["{$headingKey}_border_radius_alt"]["left"] .
            $item["{$headingKey}_border_radius_alt"]["unit"];
        $target[$headingKey]["alt"]["font_size"] = $item["{$headingKey}_alt_typography_font_size"]["size"] . $item["{$headingKey}_alt_typography_font_size"]["unit"];
        $target[$headingKey]["alt"]["mobile"]["font_size"] = $item["{$headingKey}_alt_typography_font_size_mobile"]["size"] . $item["{$headingKey}_alt_typography_font_size_mobile"]["unit"];
        $target[$headingKey]["alt"]["line_height"] = $item["{$headingKey}_alt_typography_line_height"]["size"] . $item["{$headingKey}_alt_typography_line_height"]["unit"];
        $target[$headingKey]["alt"]["mobile"]["line_height"] = $item["{$headingKey}_alt_typography_line_height_mobile"]["size"] . $item["{$headingKey}_alt_typography_line_height_mobile"]["unit"];
        $target[$headingKey]["alt"]["letter_spacing"] = $item["{$headingKey}_alt_typography_letter_spacing"]["size"] . $item["{$headingKey}_alt_typography_letter_spacing"]["unit"];
        $target[$headingKey]["alt"]["mobile"]["letter_spacing"] = $item["{$headingKey}_alt_typography_letter_spacing_mobile"]["size"] . $item["{$headingKey}_alt_typography_letter_spacing_mobile"]["unit"];
        $target[$headingKey]["alt"]["word_spacing"] = $item["{$headingKey}_alt_typography_word_spacing"]["size"] . $item["{$headingKey}_alt_typography_word_spacing"]["unit"];
        $target[$headingKey]["alt"]["mobile"]["word_spacing"] = $item["{$headingKey}_alt_typography_word_spacing_mobile"]["size"] . $item["{$headingKey}_alt_typography_word_spacing_mobile"]["unit"];

        $target[$headingKey]["alt"]["hover"]["color"] = $item["{$headingKey}_althover_color"];
        $target[$headingKey]["alt"]["hover"]["background_color"] = $item["{$headingKey}_althover_bg_color"];
        $target[$headingKey]["alt"]["hover"]["border_radius"] =
            $item["{$headingKey}_border_radius_alt_hover"]["top"] .
            $item["{$headingKey}_border_radius_alt_hover"]["unit"] .
            " " .
            $item["{$headingKey}_border_radius_alt_hover"]["right"] .
            $item["{$headingKey}_border_radius_alt_hover"]["unit"] .
            " " .
            $item["{$headingKey}_border_radius_alt_hover"]["bottom"] .
            $item["{$headingKey}_border_radius_alt_hover"]["unit"] .
            " " .
            $item["{$headingKey}_border_radius_alt_hover"]["left"] .
            $item["{$headingKey}_border_radius_alt_hover"]["unit"];
    }

    function update_reverse_service_block_hover(&$item, &$target, $headingKey)
    {
        $target[$headingKey]["text"]["color"] = $item["{$headingKey}_text_color"];
        $target[$headingKey]["icon"]["color"] = $item["{$headingKey}_icon_color"];
    }
    function update_reverse_navigation(&$item, &$target, $headingKey)
    {
        $target[$headingKey]["font_family"] = $item["{$headingKey}_typography_font_family"];
        $target[$headingKey]["font_weight"] = $item["{$headingKey}_typography_font_weight"];
        $target[$headingKey]["text_transform"] = $item["{$headingKey}_typography_text_transform"];
        $target[$headingKey]["font_style"] = $item["{$headingKey}_typography_font_style"];
        $target[$headingKey]["text_decoration"] = $item["{$headingKey}_typography_text_decoration"];
        $target[$headingKey]["color"] = $item["{$headingKey}_color"];
        $target[$headingKey]["hover"] = $item["{$headingKey}_hover"];
        $target[$headingKey]["font_size"] = $item["{$headingKey}_typography_font_size"]["size"] . $item["{$headingKey}_typography_font_size"]["unit"];
        $target[$headingKey]["mobile"]["font_size"] = $item["{$headingKey}_typography_font_size_mobile"]["size"] . $item["{$headingKey}_typography_font_size_mobile"]["unit"];
        $target[$headingKey]["line_height"] = $item["{$headingKey}_typography_line_height"]["size"] . $item["{$headingKey}_typography_line_height"]["unit"];
        $target[$headingKey]["mobile"]["line_height"] = $item["{$headingKey}_typography_line_height_mobile"]["size"] . $item["{$headingKey}_typography_line_height_mobile"]["unit"];
        $target[$headingKey]["letter_spacing"] = $item["{$headingKey}_typography_letter_spacing"]["size"] . $item["{$headingKey}_typography_letter_spacing"]["unit"];
        $target[$headingKey]["mobile"]["letter_spacing"] = $item["{$headingKey}_typography_letter_spacing_mobile"]["size"] . $item["{$headingKey}_typography_letter_spacing_mobile"]["unit"];
        $target[$headingKey]["word_spacing"] = $item["{$headingKey}_typography_word_spacing"]["size"] . $item["{$headingKey}_typography_word_spacing"]["unit"];
        $target[$headingKey]["mobile"]["word_spacing"] = $item["{$headingKey}_typography_word_spacing_mobile"]["size"] . $item["{$headingKey}_typography_word_spacing_mobile"]["unit"];

        $target[$headingKey]["top_nav_background"] = $item["{$headingKey}_top_nav_background"];
        $target[$headingKey]["top_nav_color"] = $item["{$headingKey}_top_nav_color"];
        $target[$headingKey]["top_nav_hover_background"] = $item["{$headingKey}_top_nav_hover_background"];
        $target[$headingKey]["top_nav_hover_color"] = $item["{$headingKey}_top_nav_hover_color"];
        $target[$headingKey]["sub_nav_background"] = $item["{$headingKey}_sub_nav_background"];
        $target[$headingKey]["sub_nav_color"] = $item["{$headingKey}_sub_nav_color"];
        $target[$headingKey]["sub_nav_hover_background"] = $item["{$headingKey}_sub_nav_hover_background"];
        $target[$headingKey]["sub_nav_hover_color"] = $item["{$headingKey}_sub_nav_hover_color"];
    }
    function update_reverse_coupon(&$item, &$target, $headingKey)
    {
        $target[$headingKey]["heading_font_family"] = $item["{$headingKey}_heading_font_family"];
        $target[$headingKey]["heading_font_weight"] = $item["{$headingKey}_heading_font_weight"];
        $target[$headingKey]["heading_text_transform"] = $item["{$headingKey}_heading_text_transform"];
        $target[$headingKey]["heading_font_style"] = $item["{$headingKey}_heading_font_style"];
        $target[$headingKey]["heading_text_decoration"] = $item["{$headingKey}_heading_text_decoration"];
        $target[$headingKey]["heading_color"] = $item["{$headingKey}_heading_color"];
        $target[$headingKey]["heading_font_size"] = $item["{$headingKey}_heading_font_size"]["size"] . $item["{$headingKey}_heading_font_size"]["unit"];
        $target[$headingKey]["heading_line_height"] = $item["{$headingKey}_heading_line_height"]["size"] . $item["{$headingKey}_heading_line_height"]["unit"];
        $target[$headingKey]["heading_letter_spacing"] = $item["{$headingKey}_heading_letter_spacing"]["size"] . $item["{$headingKey}_heading_letter_spacing"]["unit"];
        $target[$headingKey]["heading_word_spacing"] = $item["{$headingKey}_heading_word_spacing"]["size"] . $item["{$headingKey}_heading_word_spacing"]["unit"];
        $target[$headingKey]["mobile"]["heading_font_size"] = $item["{$headingKey}_heading_font_size_mobile"]["size"] . $item["{$headingKey}_heading_font_size_mobile"]["unit"];
        $target[$headingKey]["mobile"]["heading_line_height"] = $item["{$headingKey}_heading_line_height_mobile"]["size"] . $item["{$headingKey}_heading_line_height_mobile"]["unit"];
        $target[$headingKey]["mobile"]["heading_letter_spacing"] = $item["{$headingKey}_heading_letter_spacing_mobile"]["size"] . $item["{$headingKey}_heading_letter_spacing_mobile"]["unit"];
        $target[$headingKey]["mobile"]["heading_word_spacing"] = $item["{$headingKey}_heading_word_spacing_mobile"]["size"] . $item["{$headingKey}_heading_word_spacing_mobile"]["unit"];

        $target[$headingKey]["sub_heading_font_family"] = $item["{$headingKey}_sub_heading_font_family"];
        $target[$headingKey]["sub_heading_font_weight"] = $item["{$headingKey}_sub_heading_font_weight"];
        $target[$headingKey]["sub_heading_text_transform"] = $item["{$headingKey}_sub_heading_text_transform"];
        $target[$headingKey]["sub_heading_font_style"] = $item["{$headingKey}_sub_heading_font_style"];
        $target[$headingKey]["sub_heading_text_decoration"] = $item["{$headingKey}_sub_heading_text_decoration"];
        $target[$headingKey]["sub_heading_color"] = $item["{$headingKey}_sub_heading_color"];
        $target[$headingKey]["sub_heading_font_size"] = $item["{$headingKey}_sub_heading_font_size"]["size"] . $item["{$headingKey}_sub_heading_font_size"]["unit"];
        $target[$headingKey]["sub_heading_line_height"] = $item["{$headingKey}_sub_heading_line_height"]["size"] . $item["{$headingKey}_sub_heading_line_height"]["unit"];
        $target[$headingKey]["sub_heading_letter_spacing"] = $item["{$headingKey}_sub_heading_letter_spacing"]["size"] . $item["{$headingKey}_sub_heading_letter_spacing"]["unit"];
        $target[$headingKey]["sub_heading_word_spacing"] = $item["{$headingKey}_sub_heading_word_spacing"]["size"] . $item["{$headingKey}_sub_heading_word_spacing"]["unit"];
        $target[$headingKey]["mobile"]["sub_heading_font_size"] = $item["{$headingKey}_sub_heading_font_size_mobile"]["size"] . $item["{$headingKey}_sub_heading_font_size_mobile"]["unit"];
        $target[$headingKey]["mobile"]["sub_heading_line_height"] = $item["{$headingKey}_sub_heading_line_height_mobile"]["size"] . $item["{$headingKey}_sub_heading_line_height_mobile"]["unit"];
        $target[$headingKey]["mobile"]["sub_heading_letter_spacing"] = $item["{$headingKey}_sub_heading_letter_spacing_mobile"]["size"] . $item["{$headingKey}_sub_heading_letter_spacing_mobile"]["unit"];
        $target[$headingKey]["mobile"]["sub_heading_word_spacing"] = $item["{$headingKey}_sub_heading_word_spacing_mobile"]["size"] . $item["{$headingKey}_sub_heading_word_spacing_mobile"]["unit"];

        $target[$headingKey]["offer_text_font_family"] = $item["{$headingKey}_offer_text_font_family"];
        $target[$headingKey]["offer_text_font_weight"] = $item["{$headingKey}_offer_text_font_weight"];
        $target[$headingKey]["offer_text_text_transform"] = $item["{$headingKey}_offer_text_text_transform"];
        $target[$headingKey]["offer_text_font_style"] = $item["{$headingKey}_offer_text_font_style"];
        $target[$headingKey]["offer_text_text_decoration"] = $item["{$headingKey}_offer_text_text_decoration"];
        $target[$headingKey]["offer_text_color"] = $item["{$headingKey}_offer_text_color"];
        $target[$headingKey]["offer_text_font_size"] = $item["{$headingKey}_offer_text_font_size"]["size"] . $item["{$headingKey}_offer_text_font_size"]["unit"];
        $target[$headingKey]["offer_text_line_height"] = $item["{$headingKey}_offer_text_line_height"]["size"] . $item["{$headingKey}_offer_text_line_height"]["unit"];
        $target[$headingKey]["offer_text_letter_spacing"] = $item["{$headingKey}_offer_text_letter_spacing"]["size"] . $item["{$headingKey}_offer_text_letter_spacing"]["unit"];
        $target[$headingKey]["offer_text_word_spacing"] = $item["{$headingKey}_offer_text_word_spacing"]["size"] . $item["{$headingKey}_offer_text_word_spacing"]["unit"];
        $target[$headingKey]["mobile"]["offer_text_font_size"] = $item["{$headingKey}_offer_text_font_size_mobile"]["size"] . $item["{$headingKey}_offer_text_font_size_mobile"]["unit"];
        $target[$headingKey]["mobile"]["offer_text_line_height"] = $item["{$headingKey}_offer_text_line_height_mobile"]["size"] . $item["{$headingKey}_offer_text_line_height_mobile"]["unit"];
        $target[$headingKey]["mobile"]["offer_text_letter_spacing"] = $item["{$headingKey}_offer_text_letter_spacing_mobile"]["size"] . $item["{$headingKey}_offer_text_letter_spacing_mobile"]["unit"];
        $target[$headingKey]["mobile"]["offer_text_word_spacing"] = $item["{$headingKey}_offer_text_word_spacing_mobile"]["size"] . $item["{$headingKey}_offer_text_word_spacing_mobile"]["unit"];

        $target[$headingKey]["expiry_text_font_family"] = $item["{$headingKey}_expiry_text_font_family"];
        $target[$headingKey]["expiry_text_font_weight"] = $item["{$headingKey}_expiry_text_font_weight"];
        $target[$headingKey]["expiry_text_text_transform"] = $item["{$headingKey}_expiry_text_text_transform"];
        $target[$headingKey]["expiry_text_font_style"] = $item["{$headingKey}_expiry_text_font_style"];
        $target[$headingKey]["expiry_text_text_decoration"] = $item["{$headingKey}_expiry_text_text_decoration"];
        $target[$headingKey]["expiry_text_color"] = $item["{$headingKey}_expiry_text_color"];
        $target[$headingKey]["expiry_text_font_size"] = $item["{$headingKey}_expiry_text_font_size"]["size"] . $item["{$headingKey}_expiry_text_font_size"]["unit"];
        $target[$headingKey]["expiry_text_line_height"] = $item["{$headingKey}_expiry_text_line_height"]["size"] . $item["{$headingKey}_expiry_text_line_height"]["unit"];
        $target[$headingKey]["expiry_text_letter_spacing"] = $item["{$headingKey}_expiry_text_letter_spacing"]["size"] . $item["{$headingKey}_expiry_text_letter_spacing"]["unit"];
        $target[$headingKey]["expiry_text_word_spacing"] = $item["{$headingKey}_expiry_text_word_spacing"]["size"] . $item["{$headingKey}_expiry_text_word_spacing"]["unit"];
        $target[$headingKey]["mobile"]["expiry_text_font_size"] = $item["{$headingKey}_expiry_text_font_size_mobile"]["size"] . $item["{$headingKey}_expiry_text_font_size_mobile"]["unit"];
        $target[$headingKey]["mobile"]["expiry_text_line_height"] = $item["{$headingKey}_expiry_text_line_height_mobile"]["size"] . $item["{$headingKey}_expiry_text_line_height_mobile"]["unit"];
        $target[$headingKey]["mobile"]["expiry_text_letter_spacing"] = $item["{$headingKey}_expiry_text_letter_spacing_mobile"]["size"] . $item["{$headingKey}_expiry_text_letter_spacing_mobile"]["unit"];
        $target[$headingKey]["mobile"]["expiry_text_word_spacing"] = $item["{$headingKey}_expiry_text_word_spacing_mobile"]["size"] . $item["{$headingKey}_expiry_text_word_spacing_mobile"]["unit"];

        $target[$headingKey]["disclaimer_text_font_family"] = $item["{$headingKey}_disclaimer_text_font_family"];
        $target[$headingKey]["disclaimer_text_font_weight"] = $item["{$headingKey}_disclaimer_text_font_weight"];
        $target[$headingKey]["disclaimer_text_text_transform"] = $item["{$headingKey}_disclaimer_text_text_transform"];
        $target[$headingKey]["disclaimer_text_font_style"] = $item["{$headingKey}_disclaimer_text_font_style"];
        $target[$headingKey]["disclaimer_text_text_decoration"] = $item["{$headingKey}_disclaimer_text_text_decoration"];
        $target[$headingKey]["disclaimer_text_color"] = $item["{$headingKey}_disclaimer_text_color"];
        $target[$headingKey]["disclaimer_text_font_size"] = $item["{$headingKey}_disclaimer_text_font_size"]["size"] . $item["{$headingKey}_disclaimer_text_font_size"]["unit"];
        $target[$headingKey]["disclaimer_text_line_height"] = $item["{$headingKey}_disclaimer_text_line_height"]["size"] . $item["{$headingKey}_disclaimer_text_line_height"]["unit"];
        $target[$headingKey]["disclaimer_text_letter_spacing"] = $item["{$headingKey}_disclaimer_text_letter_spacing"]["size"] . $item["{$headingKey}_disclaimer_text_letter_spacing"]["unit"];
        $target[$headingKey]["disclaimer_text_word_spacing"] = $item["{$headingKey}_disclaimer_text_word_spacing"]["size"] . $item["{$headingKey}_disclaimer_text_word_spacing"]["unit"];
        $target[$headingKey]["mobile"]["disclaimer_text_font_size"] = $item["{$headingKey}_disclaimer_text_font_size_mobile"]["size"] . $item["{$headingKey}_disclaimer_text_font_size_mobile"]["unit"];
        $target[$headingKey]["mobile"]["disclaimer_text_line_height"] = $item["{$headingKey}_disclaimer_text_line_height_mobile"]["size"] . $item["{$headingKey}_disclaimer_text_line_height_mobile"]["unit"];
        $target[$headingKey]["mobile"]["disclaimer_text_letter_spacing"] = $item["{$headingKey}_disclaimer_text_letter_spacing_mobile"]["size"] . $item["{$headingKey}_disclaimer_text_letter_spacing_mobile"]["unit"];
        $target[$headingKey]["mobile"]["disclaimer_text_word_spacing"] = $item["{$headingKey}_disclaimer_text_word_spacing_mobile"]["size"] . $item["{$headingKey}_disclaimer_text_word_spacing_mobile"]["unit"];
    }
    function update_reverse_callbtn_bg(&$item, &$target, $headingKey)
    {
        $target[$headingKey]["background_color"] = $item["{$headingKey}_background_color"];
    }
    function update_reverse_fonts(&$item, &$target, $headingKey)
    {
        $target[$headingKey]["default_font_family"] = $item["default_font_family_font_family"];
        $target[$headingKey]["alternate_font_family_1"] = $item["alternate_font_family_1_font_family"];
        $target[$headingKey]["alternate_font_family_2"] = $item["alternate_font_family_2_font_family"];
        $target[$headingKey]["alternate_font_family_3"] = $item["alternate_font_family_3_font_family"];
    }
    function update_reverse_font_family(&$setting, $title, &$value)
    {
        if (isset($setting["_id"]) && $setting["_id"] === $title) {
            $value = $setting["typography_font_family"];
        }
    }

    $document = get_option("elementor_active_kit");
    if (isset($post_id) && $post_id == $document) {
        $args = json_decode(get_option("rds_design"), true);
        $objectnew = get_post_meta($document, "_elementor_page_settings");
        $json = json_encode($objectnew);
        $datanew = json_decode($json, true);

        if ($datanew !== null) {
            foreach ($datanew as &$item) {
                if (isset($item["system_colors"])) {
                    foreach ($item["system_colors"] as &$color) {
                        update_setting($color["_id"], $args["defaults"]["colors"], $color["color"]);
                    }

                    foreach ($item["custom_colors"] as &$ccolor) {
                        if ($ccolor["_id"] == $args["defaults"]["colors"]) {
                        update_setting($ccolor["_id"], $args["defaults"]["colors"], $ccolor["color"]);
                        }
                    }

                    foreach ($item["system_typography"] as &$ctypo) {
                        update_reverse_font_family($ctypo, "primary", $args["defaults"]["fonts"]["default_font_family"]);
                        update_reverse_font_family($ctypo, "secondary", $args["defaults"]["fonts"]["alternate_font_family_1"]);
                        update_reverse_font_family($ctypo, "text", $args["defaults"]["fonts"]["alternate_font_family_2"]);
                        update_reverse_font_family($ctypo, "accent", $args["defaults"]["fonts"]["alternate_font_family_3"]);
                        
                    }

                   
                    update_heading_typography($item, $args["defaults"]["typography"], "h1");
                    update_heading_typography($item, $args["defaults"]["typography"], "h2");
                    update_heading_typography($item, $args["defaults"]["typography"], "h3");
                    update_heading_typography($item, $args["defaults"]["typography"], "h4");
                    update_heading_typography($item, $args["defaults"]["typography"], "h5");
                    update_heading_typography($item, $args["defaults"]["typography"], "h6");
                    update_heading_typography_alt($item, $args["defaults"]["typography"], "p");
                    update_heading_typography_alt($item, $args["defaults"]["typography"], "li");
                    update_heading_typography_alt($item, $args["defaults"]["typography"], "strong");
                    update_heading_typography_alt($item, $args["defaults"]["typography"], "em");
                    update_heading_typography_alt($item, $args["defaults"]["typography"], "h7");
                    update_heading_typography_alt($item, $args["defaults"]["typography"], "h8");
                    update_heading_typography_hover($item, $args["defaults"]["typography"], "footer_phone_number");
                    update_heading_typography_text_footerhover($item, $args["defaults"]["typography"], "footer_links");
                    update_heading_typography_text_hover($item, $args["defaults"]["typography"], "phone_number");
                    update_heading_typography($item, $args["defaults"]["typography"], "default");
                    update_heading_typography_hero($item, $args["defaults"]["typography"], "hero");
                   
                    update_heading_typography_bar($item, $args["defaults"]["typography"], "announcement_bar");
                    update_heading_typography_call($item, $args["defaults"]["typography"], "call_today");
                    update_link_typography($item, $args["defaults"]["typography"], "link_normal");
                    update_link_typography_hover($item, $args["defaults"]["typography"], "link_hover");
                    //Display class
                    update_display_typography($item, $args["defaults"]["typography"], "display_1");
                    update_display_typography($item, $args["defaults"]["typography"], "display_2");
                    //one color
                    update_color($item, $args["defaults"]["typography"], "footer_phone_icon");
                    update_color($item, $args["defaults"]["typography"], "footer_license_icon");
                    update_copyrightnew($item, $args["defaults"]["typography"], "copyright");
                    update_blognew($item, $args["defaults"]["typography"], "blog");
                    update_altnew($item, $args["defaults"]["typography"], "aalt");
                    update_h1_new($item, $args["defaults"]["typography"], "h1alt");
                    update_h2_new($item, $args["defaults"]["typography"], "h2alt");
                    update_h3_new($item, $args["defaults"]["typography"], "h3alt");
                    update_h4_new($item, $args["defaults"]["typography"], "h4alt");
                    update_h5_new($item, $args["defaults"]["typography"], "h5alt");
                    update_h6_new($item, $args["defaults"]["typography"], "h6alt");
                    //Two color reupdate
                    update_hover_color($item, $args["defaults"]["typography"], "social_media_icons");
                    // update_reverse_mobile_popup_form($item, $args['defaults']['typography'], 'mobile_popup_form');
                    update_reverse_thankyou($item, $args["defaults"]["typography"], "thankyou");
                    update_reverse_pagenotfound($item, $args["defaults"]["typography"], "pagenotfound");
                    update_reverse_popup($item, $args["defaults"]["typography"], "mobile_cta_popup");
                    update_reverse_form($item, $args["defaults"]["typography"], "hero_banner_and_request_service");
                    update_heading_button($item, $args["defaults"]["typography"], "button_primary");
                    update_heading_button($item, $args["defaults"]["typography"], "button_secondary");
                    update_reverse_service_block_hover($item, $args["defaults"]["typography"], "service_block_hover");
                    update_reverse_navigation($item, $args["defaults"]["typography"], "navigation");

                    update_reverse_coupon($item, $args["defaults"]["typography"], "coupon");
                    update_reverse_callbtn_bg($item, $args["defaults"]["typography"], "callbtn_bg");

                    //  update_reverse_fonts($item, $args['defaults'], 'fonts');
                }
            }
        } else {
            wp_die("Invalid JSON.");
        }

        // ... SCSS compilation and file operations ...
        require_once "scssphp/scss.inc.php";
        // Convert $args back to JSON
        $json_args = json_encode($args, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        $design_arr = $args;
        $variables = [];
        $color_key = [];
        $font_key = [];
        $inital = 1;
        foreach ($design_arr["defaults"]["colors"] as $key => $value) {
            if ($inital < 5) {
                $variables[$key . "_color"] = $value;
            } else {
                $variables[$key] = $value;
            }
            $color_key[$key] = $value;
            $inital++;
        }
        foreach ($design_arr["defaults"]["fonts"] as $key => $value) {
            $variables[$key] = $value;
            $font_key[$key] = $value;
        }
        function processDesignArray($design_arr, &$variables, $color_key, $font_key, $prefix = "")
        {
            foreach ($design_arr as $key => $value) {
                if (substr($prefix, 0, 1) === "_") {
                    $prefix = substr($prefix, 1);
                }
                if ($prefix == "display_1" || $prefix == "display_2") {
                    $new_prefix = $key . "_" . $prefix;
                } elseif ($prefix == "hero_mobile_display_1" || $prefix == "hero_mobile_display_2") {
                    $position = strpos($prefix, "display_1");
                    $position2 = strpos($prefix, "display_2");
                    if ($position !== false) {
                        $charactersBefore = substr($prefix, 0, $position);
                        $new_prefix = $charactersBefore . $key . "_display_1";
                    }
                    if ($position2 !== false) {
                        $charactersBefore2 = substr($prefix, 0, $position2);
                        $new_prefix = $charactersBefore2 . $key . "_display_2";
                    }
                } else {
                    $new_prefix = $prefix . "_" . $key;
                }
                if (is_array($value)) {
                    processDesignArray($value, $variables, $color_key, $font_key, $new_prefix);
                } else {
                    $variables_key = $new_prefix;
                    $variables[$variables_key] = $value;
                    if (array_key_exists($variables[$variables_key], $color_key)) {
                        $variables[$variables_key] = $color_key[$variables[$variables_key]];
                    }
                    if (array_key_exists($variables[$variables_key], $font_key)) {
                        $variables[$variables_key] = $font_key[$variables[$variables_key]];
                    }
                }
            }
        }
        processDesignArray($design_arr["defaults"]["typography"], $variables, $color_key, $font_key);
        $compiler = new ScssPhp\ScssPhp\Compiler();
        $source_scss = get_template_directory() . "/src/sass/theme.scss";
        $scssContents = file_get_contents($source_scss);
        $import_path = get_template_directory() . "/src/sass";
        // $target_css = get_template_directory() . "/css/theme.min.css";
        global $wpdb;
        if (is_multisite()) {
            if (is_main_site()) {
                $target_css = get_template_directory() . "/css/" . $wpdb->prefix . "theme.min.css";
            } else {
                $target_css = get_template_directory() . "/css/" . $wpdb->prefix . "theme.min.css";
            }
        } else {
            $target_css = get_template_directory() . "/css/theme.min.css";
        }
        $target_map = get_template_directory() . "/css/theme.min.css.map";
        // $hide_users = $design_arr;
        $compiler->addImportPath($import_path);
        $compiler->setVariables($variables);
        $css = $compiler->compile($scssContents);
        if (!empty($css) && is_string($css)) {
            file_put_contents($target_css, $css);
        }

        $data = json_decode($json_args, true);
        function updateFontFamily(&$array)
        {
            foreach ($array as $key => &$value) {
                if (is_array($value)) {
                    updateFontFamily($value);
                } else {
                    if (($key === "font_family" || $key === "hero_font_family") && is_null($value)) {
                        $array[$key] = "default_font_family";
                    }
                }
            }
        }
        updateFontFamily($data);
        $updated_json = json_encode($data, JSON_PRETTY_PRINT);
        // Update the option value in the database
        update_option("rds_design", $updated_json);
    }
}

// Function to log errors
function log_error($message)
{
    error_log($message . " at " . current_time("mysql"));
}

// Function to check if the file exists in the plugin folder
function check_and_copy_file()
{
    $theme_folder = trailingslashit(get_template_directory());
    $files = [
        [
            "source" => $theme_folder . "elementor/custom-style-typography.php",
            "destination" => WP_PLUGIN_DIR . "/elementor/core/kits/documents/tabs/custom-style-typography.php",
        ],
        [
            "source" => $theme_folder . "elementor/custom-settings-site-identity.php",
            "destination" => WP_PLUGIN_DIR . "/elementor/core/kits/documents/tabs/custom-settings-site-identity.php",
        ],
    ];

    foreach ($files as $file) {
        if (!file_exists($file["destination"])) {
            if (copy($file["source"], $file["destination"])) {
                log_error("File copied to plugin folder");
            } else {
                log_error("Error copying file to plugin folder");
                // Log more detailed error information
                $error = error_get_last();
                log_error("Error details: " . $error["message"]);
            }
        }
    }
}

function check_and_execute_cron_job()
{
    $files = [WP_PLUGIN_DIR . "/elementor/core/kits/documents/tabs/custom-settings-site-identity.php", WP_PLUGIN_DIR . "/elementor/core/kits/documents/tabs/custom-style-typography.php"];

    foreach ($files as $file) {
        if (!file_exists($file)) {
           // log_error("File does not exist. Executing cron job actions.");
            check_and_copy_file();
            // Add custom actions here
        } else {
            // log_error("File exists. Skipping cron job actions.");
        }
    }
}
add_action("my_cron_job", "check_and_execute_cron_job", 999, 2);
function clear_my_cron_jobs() {
    $timestamp = wp_next_scheduled('my_cron_job');
    if ($timestamp) {
        wp_unschedule_event($timestamp, 'my_cron_job');
    }
}
add_action('init', 'clear_my_cron_jobs');
// Schedule the cron job
function schedule_cron_job()
{
    
    if (!wp_next_scheduled("my_cron_job")) {
        wp_schedule_event(time(), "hourly", "my_cron_job");
    }
}
add_action("wp", "schedule_cron_job", 999, 2);



// Function to execute when the file is modified
function on_file_modified()
{
    // Code for file modification here
    $plugin_folder = trailingslashit(plugin_dir_path(ABSPATH . "wp-content/plugins/elementor/core/kits/documents/tabs/tab_base.php"));
    $theme_folder = trailingslashit(get_template_directory()); // Use get_stylesheet_directory() if in a child theme

    // Define the file names to check
    $file_to_check = "custom-style-typography.php";
    $file_to_check2 = "custom-settings-site-identity.php";
    //    $file_to_check3 = 'custom-class-typography.php';

    // Check if the file exists in the plugin folder or theme folder
    $theme_file_path = $theme_folder . "elementor/" . $file_to_check;
    $theme_file_path2 = $theme_folder . "elementor/" . $file_to_check2;
    // $theme_file_path3 = $theme_folder . 'elementor/' . $file_to_check3;
    if (file_exists($theme_file_path) && file_exists($theme_file_path2)) {
        // Theme files exist, copy them to the plugin folder
        $destination_path = $plugin_folder . $file_to_check;
        $destination_path2 = $plugin_folder . $file_to_check2;

        if (copy($theme_file_path, $destination_path) && copy($theme_file_path2, $destination_path2)) {
            error_log("Files copied from theme to plugin folder.");
        } else {
            error_log("Failed to copy files.");
        }
    } else {
        error_log("One or both files do not exist in the theme folder. No files copied.");
    }

    error_log("The PHP file has been modified!");
}

// Get the last modification time of the PHP file
$file_path = get_template_directory() . "/elementor/custom-style-typography.php"; // Change this to the path of the file you want to monitor
$file_last_modified = filemtime($file_path);

// Check if the modification time has changed
if ($file_last_modified > get_option("last_file_modified_time", 0)) {
    // Update the last modification time in the database
    update_option("last_file_modified_time", $file_last_modified);

    // Execute the function
    on_file_modified();
}

add_action("elementor/kit/register_tabs", "custom_register_kit_tab");
// Callback function to register the custom tab
function custom_register_kit_tab($kit)
{
    $tabs = [
        "custom-style-typography" => Elementor\Core\Kits\Documents\Tabs\Custom_Style_Typography::class,
        "custom-settings-site-identity" => Elementor\Core\Kits\Documents\Tabs\Custom_Settings_Site_Identity::class,
        // 'custom-class-typography' => Elementor\Core\Kits\Documents\Tabs\Custom_Class_Typography::class,
    ];

    $file_path = WP_PLUGIN_DIR . "/elementor/core/kits/documents/tabs/custom-settings-site-identity.php"; // Replace with the path to the file
    $file_path2 = WP_PLUGIN_DIR . "/elementor/core/kits/documents/tabs/custom-style-typography.php";
    // Check if the file exists
    if (!file_exists($file_path) && !file_exists($file_path2)) {
        // File does not exist, execute the cron job actions
        // For example, log a message indicating that the file does not exist
        //error_log("File does not exist. Executing cron job actions.");
        // Add your custom actions here
    } else {
        foreach ($tabs as $id => $class) {
            $kit->register_tab($id, $class);
        }
    }
}

add_action("init", "custom_unregister_kit_tab", 999);

function custom_unregister_kit_tab($kit)
{
    // Unhook the callback functions that add the tabs you want to remove
    remove_action("elementor/kit/register_tabs", "custom_register_style_typography_tab");
}

// Callback function to register the custom tabs - Add these back if they don't exist yet
function custom_register_style_typography_tab($kit)
{
    $kit->register_tab("global-typography", Elementor\Core\Kits\Documents\Tabs\Global_Typography::class);
}

function dequeue_elementor_post_5_css()
{
    // Dequeue the Elementor post-5.css stylesheet
    wp_dequeue_style("elementor-post-5-css");
    wp_deregister_style("elementor-post-5-css");
}

function enqueue_scripts_on_footer()
{
    add_action("wp_enqueue_scripts", "dequeue_elementor_post_5_css", 20);
}

add_action("wp_footer", "enqueue_scripts_on_footer");

function dequeue_elementor_styles()
{
    // Check if Elementor is active
    $plugin_file_path = "elementor/elementor.php";
    $plugin_folder_path = plugin_dir_path(WP_PLUGIN_DIR . "/" . $plugin_file_path);

    if ($plugin_folder_path) {
        $document = get_option("elementor_active_kit");
        if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
            // Enqueue or dequeue styles specific to Elementor editor
            wp_enqueue_style("elementor-post-" . $document);
        } else {
            wp_dequeue_style("elementor-post-" . $document);
            wp_deregister_style("elementor-post-" . $document);
            //  wp_dequeue_style('elementor-frontend');
            //  wp_deregister_style('elementor-frontend');
        }
    }
}
add_action("wp_print_styles", "dequeue_elementor_styles", 9999);

function get_current_elementor_template_id() {
    if ( \Elementor\Plugin::$instance->documents->get_current() ) {
        $current_document = \Elementor\Plugin::$instance->documents->get_current();
        if ( $current_document->get_main_id() ) {
            return $current_document->get_main_id();
        }
    }

    return 'No template ID found';
}

// Shortcode to display the current Elementor template ID
function elementor_template_id_shortcode() {
    return get_current_elementor_template_id();
}
add_shortcode('elementor_template_id', 'elementor_template_id_shortcode');

// Deregister Elementor Pro and Swiper styles if the function exists
if (function_exists('wp_deregister_style')) {
    if (!function_exists('deregister_elementor_pro_style')) {
        function deregister_elementor_pro_style() {
            wp_deregister_style('elementor-pro');
            wp_deregister_style('swiper');
        }
    }
    if (!is_admin()) {
        add_action('wp_enqueue_scripts', 'deregister_elementor_pro_style', 20);
    }
}

// Add defer attribute to all scripts except specific handles if the function exists
if (function_exists('add_filter')) {
    if (!function_exists('add_defer_to_all_scripts_except_swiper')) {
        function add_defer_to_all_scripts_except_swiper($tag, $handle, $src) {
            $exclude_handles = array('jquery-core', 'swiper', 'swiper-bindule');

            if (current_user_can('administrator')) {
                return $tag;
            }

            if (in_array($handle, $exclude_handles)) {
                return $tag;
            }

            if (strpos($tag, 'src') !== false) {
                $tag = str_replace(' src', ' defer="defer" src', $tag);
            }

            return $tag;
        }
    }
    add_filter('script_loader_tag', 'add_defer_to_all_scripts_except_swiper', 10, 3);
}

// Remove WordPress head actions if the functions exist
if (function_exists('remove_action')) {
   remove_action('wp_head', 'wp_generator');
   remove_action('wp_head', 'rsd_link');
   remove_action('wp_head', 'wlwmanifest_link');
   remove_action('wp_head', 'wp_shortlink_wp_head');
   remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
   remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_filter('the_content_feed', 'wp_staticize_emoji');
remove_filter('comment_text_rss', 'wp_staticize_emoji');
remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}

// function mytheme_customize_register( $wp_customize ) {
//     $wp_customize->remove_section('custom_css');
// }
// add_action( 'customize_register', 'mytheme_customize_register' );

// function mytheme_remove_custom_css() {
//     remove_action( 'wp_head', 'wp_custom_css_cb', 101 );
// }
// add_action( 'wp_enqueue_scripts', 'mytheme_remove_custom_css', 20 );

function check_required_plugins() {
    
    add_action('current_screen', function($screen) {
        
        if ($screen->id !== 'plugins' && $screen->id !== 'themes') {
            return;
        }
        $required_plugins = array(
            'Polaris RDS Configuration' => '2.0.0',
            'Polaris RDS Setting' => '2.0.0',
            'BC Galleries' => '2.0.0',
            'BC Promotions - Coupon Builder' => '2.0.0',
            'BC Testimonials' => '2.0.0'
        );

        // Get the main theme (parent theme) information
        $theme = wp_get_theme('rds');
        $required_theme_version = POLARIS_RDS_VERSION;
        // Check main theme version
        $current_theme_version = $theme->get('Version');

        // Get all installed plugins
        $installed_plugins = get_plugins();

        foreach ($required_plugins as $required_name => $required_version) {
            $plugin_found = false;
            foreach ($installed_plugins as $plugin_path => $plugin_data) {
                if ($plugin_data['Name'] === $required_name) {
                    $plugin_found = true;
                    if (!is_plugin_active($plugin_path)) {
                        add_action('admin_notices', function() use ($plugin_data) {
                            echo '<div class="notice notice-warning"><p>';
                            echo sprintf(__('The required plugin %s is installed but not activated. Please activate it.', 'polaris-rds'), $plugin_data['Name']);
                            echo '</p></div>';
                        });
                    } elseif (version_compare($plugin_data['Version'], $required_version, '<')) {
                        add_action('admin_notices', function() use ($plugin_data, $required_version) {
                            echo '<div class="notice notice-warning"><p>';
                            echo sprintf(__('The required plugin %s (%s) needs to be updated to version %s or higher. Please update it.', 'polaris-rds'), $plugin_data['Name'], $plugin_data['Version'], $required_version);
                            echo '</p></div>';
                        });
                    }
                    break;
                }
            }
            if (!$plugin_found) {
                add_action('admin_notices', function() use ($required_name) {
                    echo '<div class="notice notice-error"><p>';
                    echo sprintf(__('The required plugin %s is not installed. Please install it.', 'polaris-rds'), $required_name);
                    echo '</p></div>';
                });
            }
        }
    });
}

add_action('admin_init', 'check_required_plugins');

/* START #20-12-2024 */
/* Commeting below code #20-12-2024 for the wp dashboard load fix - further update : TBD */

/*if (version_compare(POLARIS_RDS_VERSION, '4.0', '>=')) {
    require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';
    require_once get_template_directory() . '/inc/required_plugins.php';
}*/

/* END */

function enqueue_child_theme_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css', array(), filemtime(get_template_directory() . '/style.css'));
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'), filemtime(get_stylesheet_directory() . '/style.css'));
}
add_action('wp_enqueue_scripts', 'enqueue_child_theme_styles');


function check_for_theme_update() {
    $theme_version_option = 'rds_theme_version';
    $new_theme_version = '4.0'; 

    $saved_theme_version = get_option($theme_version_option);

    if ($saved_theme_version !== $new_theme_version) {
        output_customizer_css_on_theme_update();
        update_option($theme_version_option, $new_theme_version);
        update_option('theme_update_notice', true);
    }
}
add_action('init', 'check_for_theme_update');

function output_customizer_css_on_theme_update() {
    $custom_css = wp_get_custom_css();
    $child_theme_style_css = get_stylesheet_directory() . '/style.css';

    if (!empty($custom_css)) {
        file_put_contents($child_theme_style_css, "\n/* Custom CSS from Customizer */\n" . $custom_css, FILE_APPEND);
    }
}

function mytheme_customize_register($wp_customize) {
    if (get_option('rds_theme_version') === '4.0') {
        $wp_customize->remove_section('custom_css');
    }
}
add_action('customize_register', 'mytheme_customize_register');

function mytheme_remove_custom_css() {
    if (get_option('rds_theme_version') === '4.0') {
        remove_action('wp_head', 'wp_custom_css_cb', 101);
    }
}
add_action('wp_enqueue_scripts', 'mytheme_remove_custom_css', 20 );

function display_theme_update_notice() {
    if (get_option('theme_update_notice')) {
        echo '<div class="notice notice-success is-dismissible">';
        echo '<p>Theme has been successfully updated to version 4.0.</p>';
        echo '</div>';
        delete_option('theme_update_notice');
    }
}
add_action('admin_notices', 'display_theme_update_notice');

// image upload current month and year
$use_yearmonth_folders = get_option('uploads_use_yearmonth_folders');

// Check if the setting is enabled
if ( $use_yearmonth_folders ) {
    
    // Example: Custom code to handle uploads with the default directory structure
    add_filter('upload_dir', function($uploads) {
        $time = current_time('mysql');
    $y = date('Y', strtotime($time));
    $m = date('m', strtotime($time));

    $uploads['path'] = $uploads['basedir'] . "/$y/$m";
    $uploads['url'] = $uploads['baseurl'] . "/$y/$m";
    $uploads['subdir'] = "/$y/$m";
        return $uploads;
    });

}

function rds_api_permission($request) {
    $api_key = $request->get_header('API-Key');
    $valid_api_key = CUSTOM_API_KEY;
    if ($api_key === $valid_api_key) {
        return true;
    } else {
        return new WP_Error('rest_forbidden', esc_html__('Authentication failed.', 'text-domain'), array('status' => 401));
    }
}

// Register the REST API route to retrieve child theme CSS
function register_child_theme_css_route() {
    register_rest_route('custom/v1', '/push-css', array(
        'methods' => 'GET',
        'callback' => 'get_child_theme_css',
        'permission_callback' => 'rds_api_permission', // Permission callback function
    ));
}

add_action('rest_api_init', 'register_child_theme_css_route');

function get_child_theme_css($data) {
    $css_path = get_stylesheet_directory() . '/style.css';
    if (file_exists($css_path)) {
        $css_content = file_get_contents($css_path);
        header('Content-Type: text/css; charset=UTF-8');
        echo $css_content;
        exit; 
    } else {
        return new WP_REST_Response('Child theme CSS file not found.', 404);
    }
}

add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/update-elementor-setting', array(
        'methods' => 'POST',
        'callback' => 'set_elementor_google_fonts_default',
        'permission_callback' => '__return_true',
    ));
});

function set_elementor_google_fonts_default(WP_REST_Request $request) {
    if (!get_option('elementor_google_fonts_updated')) {
        if (function_exists('get_option') && get_option('elementor_font_display') !== 'auto') {
            update_option('elementor_font_display', 'auto');
        }
        update_option('elementor_google_fonts_updated', true);
        
        return new WP_REST_Response(array(
            'success' => true,
            'message' => 'Elementor Google Fonts setting updated to default.'
        ), 200);
    }
    
    return new WP_REST_Response(array(
        'success' => false,
        'message' => 'Elementor Google Fonts setting is already updated.'
    ), 200);
}
