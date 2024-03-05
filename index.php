<?php

use BoxyBird\Inertia\Inertia;

if (is_home()) {
	$services = [];

	foreach (get_terms(['taxonomy' => 'services','hide_empty' => false]) as $service) {
		$service->meta = get_term_meta($service->term_id);
		$services[] = $service;
	}

    return Inertia::render('Index', [
		'services' => $services,
    ]);
}

if (is_single()) {
    return Inertia::render('Single', [
        'post' => get_post(),
    ]);
}

if (is_page()) {
    return Inertia::render('Page', [
        'page' => get_post(),
    ]);
}

if (is_404()) {
    return Inertia::render('404', [
        'content' => '404 - Not Found',
    ]);
}
