<?php

namespace TGDS;

use App\Actions\GetSkillsAction;
use App\Actions\GetTaxonomiesAction;
use BoxyBird\Inertia\Inertia;

if (is_home()) {
    return Inertia::render('Index', [
		'services' => app(GetTaxonomiesAction::class)->execute(),
    ]);
}

if (is_404()) {
    return Inertia::render('404', [
        'content' => '404 - Not Found',
    ]);
}
