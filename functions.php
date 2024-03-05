<?php

use BoxyBird\Inertia\Inertia;
use App\Taxonomies\Services;

require_once __DIR__ . '/vendor/autoload.php';

new Services();

// Enqueue scripts.
add_action('wp_enqueue_scripts', function () {
    $version = md5_file(get_stylesheet_directory() . '/dist/mix-manifest.json');
    $fontAwesomeKitCode = "014be50fa2";

    wp_enqueue_script('app', get_stylesheet_directory_uri() . '/dist/js/app.js', [], $version, true);

    wp_enqueue_style('app', get_stylesheet_directory_uri() . '/dist/css/app.css', [], $version);

    wp_enqueue_script('fontawesome', "https://kit.fontawesome.com/$fontAwesomeKitCode.js", [], $version, true);
});

// Share globally with Inertia views
add_action('after_setup_theme', function () {
    Inertia::share([
        'site' => [
            'name'        => get_bloginfo('name'),
            'description' => get_bloginfo('description'),
            'logo' => get_stylesheet_directory_uri() . '/dist/images/TheGDSoftwares-rectangle-no-bg.png'
        ],
    ]);
});

// Add Inertia version. Helps with cache busting
add_action('after_setup_theme', function () {
    $version = md5_file(get_stylesheet_directory() . '/dist/mix-manifest.json');

    Inertia::version($version);
});