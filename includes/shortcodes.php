<?php



function b3c_library_loop($atts){

 // Defaults
 extract(shortcode_atts(array(
    "posts_per_page" => '',
    "order" => 'DESC',
    "taxonomy" => '',
    "terms" => '',
    "pagination" => 'true',

 ), $atts));






ob_start();

  if( $pagination == "true" ):
    if ( get_query_var('paged') ) {
      $paged = get_query_var('paged');
    } elseif ( get_query_var('page') ) {
      $paged = get_query_var('page');
    } else {
      $paged = 1;
    }
  endif;

  $args =  array( 'post_type' => 'b3c_library',  'order' => $order );
  
  if( $pagination == "true" ) $args['paged'] =  $paged; 
  if( !empty($posts_per_page) ) $args['posts_per_page'] =  $posts_per_page;
  if( !empty($taxonomy) ):
    $args['tax_query'] =  array(array(
                         'taxonomy' => $taxonomy, // ex: 'book_category'
                         'field' => 'slug',
                         'terms' => $terms, //slug-taxonomy ex: 'matematica'
                        ));
  endif;

  query_posts( $args );

  if (have_posts() ) :
    while( have_posts() ): the_post();
      include( plugin_dir . '/templates/loop-books.php');
    endwhile; 
    
    if( $pagination == "true" ) echo paginate_links();

    wp_reset_postdata(); 
    wp_reset_query();

  else:
    _e( 'Sorry, no posts matched your criteria.' );
  endif;

  $output = ob_get_contents();
  ob_end_clean();
  return $output;
}

add_shortcode('library-loop', 'b3c_library_loop');  