<?php

namespace TGDS;

use App\Actions\GetSkillsAction;
use App\Actions\GetTaxonomyAction;
use App\Enums\TaxonomyType;
use BoxyBird\Inertia\Inertia;

if (is_home()) {
    return Inertia::render('Index', [
		'services' => app(GetTaxonomyAction::class)->execute(TaxonomyType::SERVICES),
		'socials' => app(GetTaxonomyAction::class)->execute(TaxonomyType::SOCIAL_ACCOUNTS),
    ]);
}

if (is_404()) {
    return Inertia::render('404', [
        'content' => '404 - Not Found',
    ]);
}
