<?php

function get_latest_tag($repo, $token) {
    $url = "https://api.github.com/repos/$repo/tags";

    $options = [
        'http' => [
            'header' => "User-Agent: MyApp\r\n" .
                        "Authorization: token $token\r\n"
        ]
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    if ($response === FALSE) {
        die("Error fetching tags for repository $repo");
    }

    $tags = json_decode($response, true);

    if (empty($tags)) {
        die("No tags found for repository $repo");
    }

    return $tags[0]['name']; // Return the latest tag (first in the list)
}

function download_and_prepare_plugin($repo, $tag, $token, $destination) {
    $url = "https://api.github.com/repos/$repo/tarball/$tag";

    $options = [
        'http' => [
            'header' => "User-Agent: MyApp\r\n" .
                        "Authorization: token $token\r\n"
        ]
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    if ($response === FALSE) {
        die("Error fetching archive for repository $repo");
    }

    $temp_tar_path = tempnam(sys_get_temp_dir(), 'tarball') . '.tar.gz';
    file_put_contents($temp_tar_path, $response);

    // Extract tarball
    $phar = new PharData($temp_tar_path);
    $temp_extract_dir = sys_get_temp_dir() . '/extracted_' . uniqid();
    mkdir($temp_extract_dir);
    $phar->extractTo($temp_extract_dir);

    // Create ZIP file
    $zip = new ZipArchive();
    if ($zip->open($destination, ZipArchive::CREATE) !== TRUE) {
        die("Error creating ZIP archive for repository $repo");
    }

    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($temp_extract_dir),
        RecursiveIteratorIterator::LEAVES_ONLY
    );

    foreach ($files as $name => $file) {
        if (!$file->isDir()) {
            $filePath = $file->getRealPath();
            $relativePath = substr($filePath, strlen($temp_extract_dir) + 1);
            $zip->addFile($filePath, $relativePath);
        }
    }

    $zip->close();
}

function understrap_register_required_plugins() {
    $github_token = GIT_AUTHENTICATION;

    $repositories = array(
        array(
            'repo'        => 'ESBlueCorona/rds-gallery-plugin',
            'name' => 'BC Gallery',
            'slug' => 'rds-gallery-plugin',
            'version'     => '2.0.0',
            // 'force_activation' => true,
            'required'           => true,
        ),
        array(
            'repo'        => 'ESBlueCorona/rds-promotions-plugin',
            'name' => 'BC Promotions - Coupon Builder',
            'slug' => 'rds-promotions-plugin',
            'version'     => '2.0.0',
            // 'force_activation' => true,
            'required'           => true,
        ),
        array(
            'repo'        => 'ESBlueCorona/rds-testimonials-plugin',
            'name' => 'BC Testimonials',
            'slug' => 'rds-testimonials-plugin',
            'version'     => '2.0.0',
            // 'force_activation' => true,
            'required'           => true,
        ),
        array(
            'repo'        => 'ESBlueCorona/rds-configuration-plugin',
            'name' => 'Polaris RDS Configuration',
            'slug' => 'rds-configuration-plugin',
            'version'     => '2.0.0',
            // 'force_activation' => true,
            'required'           => true,
        ),
        array(
            'repo'        => 'ESBlueCorona/rds-setting-plugin',
            'name' => 'Polaris RDS Setting',
            'slug' => 'rds-setting-plugin',
            'version'     => '2.0.0',
            // 'force_activation' => true,
            'required'           => true,
        ),
        
        
    );

    // Loop through each repository
    foreach ($repositories as $repo_info) {
        $repo = $repo_info['repo'];

        // Get the latest tag for the repository
        $tag = get_latest_tag($repo, $github_token);

        // Construct destination path for the ZIP file
        $destination = $_SERVER['DOCUMENT_ROOT'] . "/wp-content/plugins/{$repo_info['slug']}-$tag.zip";

        // Download and prepare the plugin
        download_and_prepare_plugin($repo, $tag, $github_token, $destination);

        // Define plugin information for tgmpa
        $plugins[] = array(
            'name'                => $repo_info['name'],
            'slug'                => $repo_info['slug'],
            'source'              => $destination,
            'required'            => true,
            'version'             => $repo_info['version'],
            // 'force_activation'  => $repo_info['force_activation'],
        );
    }

    $config = array(
        'id'           => 'understrap',
        'default_path' => '',
        'menu'         => 'tgmpa-install-plugins',
        'parent_slug'  => 'themes.php',
        'capability'   => 'edit_theme_options',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => false,
        'message'      => '',
    );

    tgmpa($plugins, $config);
}

add_action('tgmpa_register', 'understrap_register_required_plugins');

?>
