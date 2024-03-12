<?php

namespace App\Actions;

class GetTaxonomiesAction {

	public function execute(): array
	{
		$services = [];

		foreach (get_terms(['taxonomy' => 'services','hide_empty' => false]) as $service) {
			$service->meta = get_term_meta($service->term_id);
			$services[] = $service;
		}

		return $services;
	}

}