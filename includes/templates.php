<?php

//Single Content

add_action( 'the_content', 'b3c_library_add_template_part_content' );
function b3c_library_add_template_part_content( $content ) {

    global $post;

    if ( 'b3c_library' == get_post_type() && is_single() ){
        ob_start();
        	require_once(  plugin_dir .'/templates/single-books.php'); //
       return ob_get_clean();
    }

    return $content;

}



add_filter('template_include', 'b3c_library_template_callback');

function b3c_library_template_callback( $template ) {

  if ( is_post_type_archive('b3c_library') ||  ( 'b3c_library' == get_post_type() && is_tax() ) ) {

    $theme_files = array('archive-books.php', 'b3c-library/archive-books.php');
    $exists_in_theme = locate_template($theme_files, false);
    if ( $exists_in_theme != '' ) {
      return $exists_in_theme;
    } else {
      return plugin_dir . '/templates/archive-books.php';
    }

  }

  if ( is_single('b3c_library') ||  is_singular('b3c_library') ) { 
    $theme_files = array('single-books.php', 'b3c-library/single-books.php');
    $exists_in_theme = locate_template($theme_files, false);
    if ( $exists_in_theme != '' ) {
      return $exists_in_theme;
    } 
  }

  return $template;

}

