<?php

use App\Actions\GetSkillsAction;
use BoxyBird\Inertia\Inertia;

$component = '';
$page  = get_post();
$data = [
	'page' => $page,
];

if ($page->post_name == 'about') {
	$component = 'About';
	$data['skills'] = app(GetSkillsAction::class)->execute();
}

return Inertia::render("Page$component", $data);
