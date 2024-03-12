<?php

namespace App\Taxonomies;

use App\Supports\Taxonomy;
use BoxyBird\Inertia\Inertia;

class Skills extends Taxonomy
{

	protected string $name = 'skills';
	protected string $plural = 'Skills';
	protected array $metaData = [
		'rating' => 'Rating',
		'icon' => 'Icon'
	];

	public function menu()
	{
		add_menu_page( 'Skills', 'Skills', 'manage_options', 'edit-tags.php?taxonomy=skills', '', 'dashicons-universal-access', 6);
	}

	protected function label(): array
	{
		//first do the translations part for GUI
		return array(
			'name' => _x( 'Skills', 'skills' ),
			'singular_name' => _x( 'Skill', 'skill' ),
			'search_items' =>  __( 'Search Skills' ),
			'all_items' => __( 'All Skills' ),
			'parent_item' => __( 'Parent Skill' ),
			'parent_item_colon' => __( 'Parent Skill:' ),
			'edit_item' => __( 'Edit Skill' ),
			'update_item' => __( 'Update Skill' ),
			'add_new_item' => __( 'Add New Skill' ),
			'new_item_name' => __( 'New Skill' ),
			'menu_name' => __( 'Skill' ),
		);
	}

	//create a custom taxonomy name it subjects for your posts
	public function register() {
		// Now register the taxonomy
		register_taxonomy('skills', '', array(
			'hierarchical' => false,
			'labels' => $this->label(),
			'show_ui' => true,
			'show_in_rest' => true,
			'show_in_menu' => true,
			'show_in_nav_menus' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'capabilities' => ['manage_terms'],
			'rewrite' => array( 'slug' => 'skills' ),
		));
	}

	public function table_columns($columns) {
		unset($columns['slug']);
		unset($columns['posts']);
		unset($columns['description']);

		return array_merge($columns, $this->metaData);
	}

	function table_column_content($content, $column, $term_id) {
		foreach (array_keys($this->metaData) as $meta) {
			if ($meta == $column) {
				$data = get_term_meta($term_id, $meta, true);

				if ($column == 'icon') {
					$data = "<img src='$data' style='height: 2rem'></img>";
				}

				return $data;
			}
		}

		return '';
	}

}