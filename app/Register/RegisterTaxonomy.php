<?php

namespace App\Register;

use App\Enums\TaxonomyType;
use BoxyBird\Inertia\Inertia;
use Illuminate\Support\Str;

class RegisterTaxonomy
{
	protected string $name;
	protected string $singular;
	protected string $plural;
	protected string $component;

	protected string $icon;
	protected int $menu_position;
	protected array $metaData;

	public function __construct(TaxonomyType $type, array $metaData, string $icon, int $menu_position)
    {
		$this->name = $type->value;
	    $this->singular = Str::of($type->value)->headline()->singular();
		$this->plural = Str::of($type->value)->headline();
		$this->component = Str::of($type->value)->camel()->ucfirst();
		$this->icon = $icon;
		$this->menu_position = $menu_position;
		$this->metaData = $metaData;

	    //hook into the init action and call create_book_taxonomies when it fires
	    add_action( 'init', [$this, 'register'], 0 );

	    add_action( 'admin_menu', [$this, 'menu']);

	    add_action( "{$this->name}_add_form_fields", [$this, 'add_icon_field']);
	    add_action( "{$this->name}_edit_form_fields", [$this, 'edit_icon_field'], 10, 2);

	    add_action( "created_{$this->name}", [$this, 'save_fields'] );
	    add_action( "edited_{$this->name}", [$this, 'save_fields'] );

//	    add_filter('manage_services_custom_column', [$this, 'table_columns']);
	    add_filter("manage_edit-{$this->name}_columns", [$this, 'table_columns'] );
	    add_filter("manage_{$this->name}_custom_column", [$this, 'table_column_content'], 10, 3);
    }

    public function menu()
    {
	    add_menu_page( $this->plural, $this->plural, 'manage_options', "edit-tags.php?taxonomy=$this->name", '', $this->icon, $this->menu_position);
    }

    protected function label(): array
    {
	    //first do the translations part for GUI
	    return array(
		    'name' => _x( $this->plural, $this->name ),
		    'singular_name' => _x( $this->singular, $this->name ),
		    'search_items' =>  __( "Search $this->plural" ),
		    'all_items' => __( "All $this->plural" ),
		    'parent_item' => __( "Parent $this->singular" ),
		    'parent_item_colon' => __( "Parent $this->singular:" ),
		    'edit_item' => __( "Edit $this->singular" ),
		    'update_item' => __( "Update $this->singular" ),
		    'add_new_item' => __( "Add New $this->singular" ),
		    'new_item_name' => __( "New $this->singular" ),
		    'menu_name' => __( $this->plural ),
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

    public function add_icon_field()
    {
	    Inertia::render("Admin/$this->component/AddForm");
    }

    public function edit_icon_field($term, $taxonomy)
    {
	    $data = [];
	    foreach (array_keys($this->metaData) as $meta) {
		    $data[$meta] = get_term_meta($term->term_id, $meta, true);
	    }

	    Inertia::render("Admin/$this->component/EditForm", $data);
    }

	function save_fields( $term_id )
	{
		foreach (array_keys($this->metaData) as $meta) {
			update_term_meta( $term_id, $meta, sanitize_text_field( $_POST[ $meta ] ) );
		}
	}

	public function table_columns($columns) {
		unset($columns['slug']);
		unset($columns['posts']);

		return array_merge($columns, $this->metaData);
	}

	function table_column_content($content, $column, $term_id) {
		foreach (array_keys($this->metaData) as $meta) {
			if ($meta == $column) {
				$data = get_term_meta($term_id, $meta, true);

				if ($column == 'icon') {
					$data = "<img src='$data' style='height: 2rem'></img>";
				}

				if ($column == 'service_icon') {
					$data = "<i class='$data'></i>";
				}

				return $data;
			}
		}

		return '';
	}
}