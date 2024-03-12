<?php

namespace TGDS;

use App\Enums\TaxonomyType;
use App\Register\RegisterTaxonomy;
use BoxyBird\Inertia\Inertia;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/helpher.php';
require_once __DIR__ . '/Installation.php';

add_action('after_switch_theme', ['Installation', 'setup']);

new RegisterTaxonomy(TaxonomyType::SERVICES, ['service_icon' => 'Icon'], 'dashicons-networking', 5);
new RegisterTaxonomy(TaxonomyType::SKILLS, ['rating' => 'Rating', 'icon' => 'Icon'],'dashicons-universal-access', 6);
new RegisterTaxonomy(TaxonomyType::SOCIAL_ACCOUNTS, ['username' => 'Username','icon' => 'Icon','link' => 'Link'], 'dashicons-share', 7);

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
            'logo' => get_stylesheet_directory_uri() . '/assets/images/TheGDSoftwares-rectangle-no-bg.png',
	        'theme_path' => get_stylesheet_directory_uri()
        ],
    ]);
});

// Add Inertia version. Helps with cache busting
add_action('after_setup_theme', function () {
    $version = md5_file(get_stylesheet_directory() . '/dist/mix-manifest.json');

    Inertia::version($version);
});
