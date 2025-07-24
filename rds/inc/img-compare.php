<?php
echo "<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}
td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}
tr:nth-child(even) {
  background-color: #dddddd;
}
</style>";

require_once dirname(__FILE__, 5) . '/wp-load.php';

function list_files_recursive($dir) {
    if (!is_dir($dir)) {
        return [];
    }
    $result = [];
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;
        $path = $dir . DIRECTORY_SEPARATOR . $file;
        if (is_dir($path)) {
            $result = array_merge($result, list_files_recursive($path));
        } else {
            $result[] = str_replace(trailingslashit(get_stylesheet_directory()), '', $path);
        }
    }
    return $result;
}

function render_table($title, $images, $base_dir) {
if (!empty($images)) {
    echo "<br>$title found<br><table><tr><th>s no</th><th>Images</th></tr>";
    $varintNum = 1;
    foreach ($images as $image) {
        echo '<tr><td>' . $varintNum . '</td><td>' . htmlspecialchars(str_replace(trailingslashit($base_dir), '', $image)) . "</td></tr>";
        $varintNum++;
    }
    echo "</table>";
    } 
}

function compare_image_folders($parent_img_dir, $child_img_dir) {
    $parent_images = list_files_recursive($parent_img_dir);
    $child_images = list_files_recursive($child_img_dir);
    $parent_image_names = array_map('basename', $parent_images);
    $child_image_names = array_map('basename', $child_images);
    $missing_in_child = array_diff($parent_image_names, $child_image_names);
    $extra_in_child = array_diff($child_image_names, $parent_image_names);

    render_table('Child theme image not', array_filter($parent_images, function($img) use ($missing_in_child) {
        return in_array(basename($img), $missing_in_child);
    }), get_template_directory());

    render_table('child theme Extra images ', array_filter($child_images, function($img) use ($extra_in_child) {
        return in_array(basename($img), $extra_in_child);
    }), get_stylesheet_directory());
}

$parent_img_dir = get_template_directory() . '/img';
$child_img_dir = get_stylesheet_directory() . '/img';

compare_image_folders($parent_img_dir, $child_img_dir);
?>
