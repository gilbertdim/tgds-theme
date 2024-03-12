<?php

use App\Actions\GetTaxonomyAction;
use App\Enums\TaxonomyType;
use BoxyBird\Inertia\Inertia;

$component = '';
$page  = get_post();
$data = [
	'page' => $page,
	'socials' => app(GetTaxonomyAction::class)->execute(TaxonomyType::SOCIAL_ACCOUNTS),
];

if ($page->post_name == 'about') {
	$component = 'About';
	$data['skills'] = app(GetTaxonomyAction::class)->execute(TaxonomyType::SKILLS);
}

return Inertia::render("Page$component", $data);
