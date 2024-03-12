<?php

namespace App\Taxonomies;

use BoxyBird\Inertia\Inertia;

class Services
{
	protected $name = 'services';

    public function __construct()
    {
        //hook into the init action and call create_book_taxonomies when it fires
        add_action( 'init', [$this, 'register'], 0 );

        add_action( 'admin_menu', [$this, 'menu']);

        add_action( "{$this->name}_add_form_fields", [$this, 'add_icon_field']);
        add_action( "{$this->name}_edit_form_fields", [$this, 'edit_icon_field'], 10, 2);

	    add_action( "created_{$this->name}", [$this, 'save_fields'] );
	    add_action( "edited_{$this->name}", [$this, 'save_fields'] );

//	    add_filter('manage_services_custom_column', [$this, 'table_columns']);
	    add_filter('manage_edit-services_columns', [$this, 'table_columns'] );
	    add_filter('manage_services_custom_column', [$this, 'table_column_content'], 10, 3);
    }

    public function menu()
    {
        add_menu_page( 'Sevices', 'Services', 'manage_options', 'edit-tags.php?taxonomy=services', '', 'dashicons-networking', 5);
    }

    protected function label(): array
    {
        //first do the translations part for GUI
        return array(
            'name' => _x( 'Services', 'services' ),
            'singular_name' => _x( 'Service', 'service' ),
            'search_items' =>  __( 'Search Services' ),
            'all_items' => __( 'All Services' ),
            'parent_item' => __( 'Parent Service' ),
            'parent_item_colon' => __( 'Parent Service:' ),
            'edit_item' => __( 'Edit Service' ),
            'update_item' => __( 'Update Service' ),
            'add_new_item' => __( 'Add New Service' ),
            'new_item_name' => __( 'New Service' ),
            'menu_name' => __( 'Services' ),
        );
    }

    //create a custom taxonomy name it subjects for your posts
    public function register() {
        // Now register the taxonomy
        register_taxonomy('services', '', array(
            'hierarchical' => false,
            'labels' => $this->label(),
            'show_ui' => true,
            'show_in_rest' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'capabilities' => ['manage_terms'],
            'rewrite' => array( 'slug' => 'service' ),
        ));
    }

    public function add_icon_field()
    {
        Inertia::render('Admin/Taxonomies/AddForm');
    }

    public function edit_icon_field($term, $taxonomy)
    {
        Inertia::render('Admin/Taxonomies/EditForm', [
			'icon' => get_term_meta($term->term_id, 'icon', true)
        ]);
    }

	function save_fields( $term_id )
	{
		update_term_meta(
			$term_id,
			'icon',
			sanitize_text_field( $_POST[ 'icon' ] )
		);
	}

	public function table_columns($columns) {
		unset($columns['slug']);
		unset($columns['posts']);

		return array_merge($columns, ['service_icon' => 'Icon']);
	}

	function table_column_content($content, $column, $term_id) {
		switch ($column) {
			case 'service_icon':
				$icon = get_term_meta($term_id, 'icon', true);
				return "<i class='$icon'></i>";

				break;
		}

		return '';
	}

}
