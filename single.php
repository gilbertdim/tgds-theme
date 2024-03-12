<?php

use BoxyBird\Inertia\Inertia;

return Inertia::render('Single', [
	'post' => get_post(),
]);
