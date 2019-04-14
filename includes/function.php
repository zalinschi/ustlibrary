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
				echo "Categorii:";
			break;
			case 'lang_book':
				echo "Limba:";
			break;
			case 'author_book':
				echo "Autor:";
			break;
			case 'pubhouse_book':
				echo "Editura:";
			break;
			case 'year_book':
				echo "Anul:";
			break;
			case 'tag_book':
				echo "Etichete:";
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
		printf( __( 'Daily Archives: %s','b3c-library'), '<span>' . get_the_date() . '</span>' );
	elseif ( is_month() ) :
		printf( __( 'Monthly Archives: %s', 'b3c-library' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'twentytwelve' ) ) . '</span>' );
	elseif ( is_year() ) :
		printf( __( 'Yearly Archives: %s' ,'b3c-library' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format') ) . '</span>' );
	elseif ( is_tax('book_category') ) :
		_e( 'Category:','b3c-library'); echo single_cat_title();
	elseif ( is_tax('author_book') ) :
		_e( 'Author: ','b3c-library'); echo single_cat_title();
	elseif ( is_tax('pubhouse_book') ) :
		_e( 'Publishing house: ','b3c-library'); echo single_cat_title();
	elseif ( is_tax('year_book') ) :
		_e( 'Edition year: ','b3c-library'); echo single_cat_title();
	elseif ( is_tax('tag_book') ) :
		_e( 'Tag: ','b3c-library'); echo single_cat_title();
	elseif ( is_tax('lang_book') ) :
		_e( 'Book language: ','b3c-library'); echo single_cat_title();
	else :
		_e( 'Library');
	endif;
}



   function new_excerpt_more($more) {
   global $post;
   return '… <a href="'. get_permalink($post->ID) . '">' . 'Read More &raquo;' . '</a>';
   }
   add_filter('excerpt_more', 'new_excerpt_more');