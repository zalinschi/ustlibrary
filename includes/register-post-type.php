<?php

function ustlib_setup_init() {
	$labels = array(
        'name'                  => __('Books', 'ust-library'),
        'singular_name'         => __('Book', 'ust-library'),
        'menu_name'             => __('Books', 'ust-library'),
        'name_admin_bar'        => __('Book', 'ust-library'),
        'add_new'               => __('Add New', 'ust-library'),
        'add_new_item'          => __('Add New Book', 'ust-library'),
        'new_item'              => __('New Book', 'ust-library'),
        'edit_item'             => __('Edit Book', 'ust-library'),
        'view_item'             => __('View Book', 'ust-library'),
        'all_items'             => __('All Books', 'ust-library'),
        'search_items'          => __('Search Books', 'ust-library'),
        'parent_item_colon'     => __('Parent Books:', 'ust-library'),
 
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'librarie' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'			 => 'dashicons-book-alt',
        'supports'           => array( 'title', 'thumbnail', 'excerpt' ),
    );
    

	$cat_args = array( 
		'labels' => array(
						'name' => __('Category book','ust-library'),
						'add_new_item' =>  __('Add category','ust-library'),
						'new_item_name' => __('New category','ust-library'),
					),
		'show_ui' => true,
		'public' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'hierarchical' => true,
		'query_var' => true,
	   	'rewrite' => array( 'slug' => 'categorie-carti' )
	);

	// ETICHETE
	$tag_args = array( 
		'labels' => array(
						'name' => __('Book tags','ust-library'),
						'add_new_item' =>  __('Add tag','ust-library'),
						'new_item_name' => __('New tag','ust-library'),
					),
		'show_ui' => true,
		'public' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'hierarchical' => false,
		'query_var' => true,
	   	'rewrite' => array( 'slug' => 'etichete-carti' )
	);

	//AUTHOR
	$author_args = array( 
		'labels' => array(
						'name' => __('Author','ust-library'),
						'add_new_item' => __('Add Author','ust-library'),
						'new_item_name' =>  __('New Author','ust-library'),
					),
		'show_ui' => true,
		'public' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'hierarchical' => false,
		'query_var' => true,
	   	'rewrite' => array( 'slug' => 'autor-carti' )
	);

	//EDITURA
	$publishing_house_args = array( 
		'labels' => array(
						'name' =>  __('publishing house','ust-library'),
						'add_new_item' => __('Add publishing house','ust-library'),
						'new_item_name' => __('New publishing house','ust-library'),
					),
		'show_ui' => true,
		'public' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'hierarchical' => false,
		'query_var' => true,
	   	'rewrite' => array( 'slug' => 'editura' )
	);

	//AN
	$year_args = array( 
		'labels' => array(
						'name' => __('Year','ust-library'),
						'add_new_item' => __('Add Year','ust-library'),
						'new_item_name' => __('New Year','ust-library'),
					),
		'show_ui' => true,
		'public' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'hierarchical' => false,
		'query_var' => true,
	   	'rewrite' => array( 'slug' => 'an' )
	);

	//Lang
	$lang_args = array( 
		'labels' => array(
						'name' => __('Language','ust-library'),
						'add_new_item' => __('Add Language','ust-library'),
						'new_item_name' => __('New Language','ust-library'),
					),
		'show_ui' => true,
		'public' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'hierarchical' => false,
		'query_var' => true,
	   	'rewrite' => array( 'slug' => 'limba' )
	);

	//Reg Post Type
	register_post_type( 'b3c_library', $args );

	//Reg taxonomii
	register_taxonomy('author_book','b3c_library', $author_args );
	register_taxonomy('pubhouse_book','b3c_library', $publishing_house_args );
	register_taxonomy('year_book','b3c_library', $year_args );
	register_taxonomy('tag_book','b3c_library', $tag_args );
	register_taxonomy('lang_book','b3c_library', $lang_args );
	register_taxonomy('book_category','b3c_library', $cat_args );

}
 
add_action( 'init', 'ustlib_setup_init' );