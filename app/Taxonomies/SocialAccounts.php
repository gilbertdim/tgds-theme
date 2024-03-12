<?php

namespace App\Taxonomies;

use App\Supports\Taxonomy;

class SocialAccounts extends Taxonomy
{
	protected string $name = 'social_accounts';

	protected string $plural = 'Social Accounts';

	protected array $metaData = [
		'username' => 'Username',
		'icon' => 'Icon',
		'link' => 'Link',
	];

	public function menu()
	{
		add_menu_page( 'Social Accounts', 'Social Accounts', 'manage_options', "edit-tags.php?taxonomy=$this->name", '', 'dashicons-share', 7);
	}

	protected function label(): array
	{
		//first do the translations part for GUI
		return array(
			'name' => _x( 'Social Accounts', 'social_account' ),
			'singular_name' => _x( 'Social Accounts', 'social_account' ),
			'search_items' =>  __( 'Search Social Accounts' ),
			'all_items' => __( 'All Skills' ),
			'parent_item' => __( 'Parent Social Account' ),
			'parent_item_colon' => __( 'Parent Social Account:' ),
			'edit_item' => __( 'Edit Social Account' ),
			'update_item' => __( 'Update Social Account' ),
			'add_new_item' => __( 'Add New Social Account' ),
			'new_item_name' => __( 'New Social Account' ),
			'menu_name' => __( 'Social Accounts' ),
		);
	}

	//create a custom taxonomy name it subjects for your posts
	public function register() {
		// Now register the taxonomy
		register_taxonomy($this->name, '', array(
			'hierarchical' => false,
			'labels' => $this->label(),
			'show_ui' => true,
			'show_in_rest' => true,
			'show_in_menu' => true,
			'show_in_nav_menus' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'capabilities' => ['manage_terms'],
			'rewrite' => array( 'slug' => $this->name ),
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