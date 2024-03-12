<?php

namespace App\Actions;

use App\Enums\TaxonomyType;

class GetTaxonomyAction {

	public function execute(TaxonomyType $type): array
	{
		$taxonomies = [];

		foreach (get_terms(['taxonomy' => $type->value, 'hide_empty' => false]) as $taxonomy) {
			$taxonomy->meta = get_term_meta($taxonomy->term_id);

			$taxonomies[] = $taxonomy;
		}

		return $taxonomies;
	}

}