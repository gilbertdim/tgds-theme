<?php

namespace TGDS;

use App\Enums\TaxonomyType;
use App\Register\RegisterTaxonomy;
use BoxyBird\Inertia\Inertia;
use Dotenv\Dotenv;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/helpher.php';
require_once __DIR__ . '/Installation.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

add_action('after_switch_theme', ['Installation', 'setup']);

new RegisterTaxonomy(TaxonomyType::SERVICES, ['icon' => 'Icon'], 'dashicons-networking', 5);
new RegisterTaxonomy(TaxonomyType::SKILLS, ['rating' => 'Rating', 'icon' => 'Icon'],'dashicons-universal-access', 6);
new RegisterTaxonomy(TaxonomyType::SOCIAL_ACCOUNTS, ['username' => 'Username','icon' => 'Icon','link' => 'Link'], 'dashicons-share', 7);

$controllers = array_filter(scandir(__DIR__.'/app/Controllers'), fn ($item) => !in_array($item, ['.', '..']));
$controllers = array_map(fn ($item) => str_replace('.php', '', $item), $controllers);
foreach ($controllers as $controller) {
	$class = "App\\Controllers\\$controller";
	new $class();
}

$recaptchSiteKey = $_ENV['RECAPTCHA_SITE_KEY'];

// Enqueue scripts.
add_action('wp_enqueue_scripts', function () use ($recaptchSiteKey) {
    $version = md5_file(get_stylesheet_directory() . '/dist/mix-manifest.json');
    $fontAwesomeKitCode = "014be50fa2";

    wp_enqueue_script('app', get_stylesheet_directory_uri() . '/dist/js/app.js', [], $version, true);

    wp_enqueue_style('app', get_stylesheet_directory_uri() . '/dist/css/app.css', [], $version);

    wp_enqueue_script('fontawesome', "https://kit.fontawesome.com/$fontAwesomeKitCode.js", [], $version, true);

	wp_enqueue_script('recaptcha-v3', "https://www.google.com/recaptcha/api.js");
});

// Share globally with Inertia views
add_action('after_setup_theme', function () use ($recaptchSiteKey) {
    Inertia::share([
        'site' => [
            'name'        => get_bloginfo('name'),
            'description' => get_bloginfo('description'),
            'logo' => get_stylesheet_directory_uri() . '/assets/images/TheGDSoftwares-rectangle-no-bg.png',
	        'theme_path' => get_stylesheet_directory_uri()
        ],
	    'options' => [
			'recaptcha' => [
				'site_key' => $recaptchSiteKey
			]
	    ],
    ]);
});

// Add Inertia version. Helps with cache busting
add_action('after_setup_theme', function () {
    $version = md5_file(get_stylesheet_directory() . '/dist/mix-manifest.json');

    Inertia::version($version);
});
