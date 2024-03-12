<?php

namespace App\Supports;

use BoxyBird\Inertia\Inertia;

abstract class Taxonomy
{
	protected string $name = 'taxonomy_name';
	protected string $plural = 'taxonomies';
	protected array $metaData = [];

	public function __construct()
	{
		//hook into the init action and call create_book_taxonomies when it fires
		add_action( 'init', [$this, 'register'], 0 );

		add_action( 'admin_menu', [$this, 'menu']);

		add_action( "{$this->name}_add_form_fields", [$this, 'add_icon_field']);
		add_action( "{$this->name}_edit_form_fields", [$this, 'edit_icon_field'], 10, 2);

		add_action( "created_{$this->name}", [$this, 'save_fields'] );
		add_action( "edited_{$this->name}", [$this, 'save_fields'] );

		add_filter("manage_edit-{$this->name}_columns", [$this, 'table_columns'] );
		add_filter("manage_{$this->name}_custom_column", [$this, 'table_column_content'], 10, 3);
	}

	abstract public function menu();

	abstract protected function label();

	//create a custom taxonomy name it subjects for your posts
	abstract public function register();

	public function add_icon_field()
	{
		Inertia::render("Admin/$this->plural/AddForm");
	}

	public function edit_icon_field($term, $taxonomy)
	{
		$data = [];
		foreach (array_keys($this->metaData) as $meta) {
			$data[$meta] = get_term_meta($term->term_id, $meta, true);
		}

		Inertia::render("Admin/$this->plural/EditForm", $data);
	}

	public function save_fields( $term_id )
	{
		foreach (array_keys($this->metaData) as $meta) {
			update_term_meta( $term_id, $meta, sanitize_text_field( $_POST[ $meta ] ) );
		}
	}

	abstract public function table_columns($columns);

	abstract function table_column_content($content, $column, $term_id);
}