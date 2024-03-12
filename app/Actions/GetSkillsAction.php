<?php

namespace App\Actions;

class GetSkillsAction {

	public function execute(): array
	{
		$skills = [];

		foreach (get_terms(['taxonomy' => 'skills','hide_empty' => false]) as $skill) {
			$skill->meta = get_term_meta($skill->term_id);
			$skills[] = $skill;
		}

		return $skills;
	}

}