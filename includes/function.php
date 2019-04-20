<?php

function get_library_term($term_name){
	$terms =  wp_get_object_terms( get_the_id() ,  $term_name ); 

	if (!empty($terms) && ! is_wp_error( $terms) ):
?>
	<div class="meta-<?php echo $term_name; ?>">
	<strong class="meta-term_title">
	<?php
		//TITLUL
		switch ($term_name) {
			case 'book_category': 
				echo __("Categories","ust-library")." :";
			break;
			case 'lang_book':
				echo __("Language","ust-library")." :";
			break;
			case 'author_book':
				echo __("Author","ust-library")." :";
			break;
			case 'pubhouse_book':
				echo __("Publishing house","ust-library")." :";
			break;
			case 'year_book':
				echo __("Year","ust-library")." :";
			break;
			case 'tag_book':
				echo __("Tags","ust-library")." :";
			break;
		}
	?>
	</strong>
	<?php
	    foreach ( $terms as $term ) {
	        echo "<span class=separator></span><a href=". get_term_link($term)."> $term->name </a>";
	    }
	?>
	</div>
	<?php
	endif;
}


function wpse70960_filter_post_thumbnail_html( $html ) {
    if ( is_home() || is_single() || 'b3c_library' == get_post_type() ) {
        return '';
    } else {
        return $html;
    }
}
add_filter( 'post_thumbnail_html', 'wpse70960_filter_post_thumbnail_html' );



function get_template_part_book(){
	include( plugin_dir.'/templates/loop-books.php');
}


function get_the_library_title(){
	if ( is_day() ) :
		printf( __( 'Daily Archives: %s'), '<span>' . get_the_date() . '</span>' );
	elseif ( is_month() ) :
		printf( __( 'Monthly Archives: %s'), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format' ) ) . '</span>' );
	elseif ( is_year() ) :
		printf( __( 'Yearly Archives: %s'), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format') ) . '</span>' );
	elseif ( is_tax('book_category') ) :
		echo __( 'Category','ust-library').': '.single_cat_title();
	elseif ( is_tax('author_book') ) :
		echo __( 'Author','ust-library').': '.single_cat_title();
	elseif ( is_tax('pubhouse_book') ) :
		echo __( 'Publishing house','ust-library').': '.single_cat_title();
	elseif ( is_tax('year_book') ) :
		echo __( 'Edition year','ust-library').': '.single_cat_title();
	elseif ( is_tax('tag_book') ) :
		echo __( 'Tag','ust-library').': '.single_cat_title();
	elseif ( is_tax('lang_book') ) :
		echo __( 'Book language','ust-library').': '.single_cat_title();
	else :
		_e( 'Library');
	endif;
}



   function new_excerpt_more($more) {
   global $post;
   return '… <a href="'. get_permalink($post->ID) . '">' . __('Read more').' &raquo;' . '</a>';
   }
   add_filter('excerpt_more', 'new_excerpt_more');
