<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;

enum TaxonomyType: string
{
	use InvokableCases;

	case SKILLS = 'skills';
	case SERVICES = 'services';
	case SOCIAL_ACCOUNTS = 'social_accounts';

}