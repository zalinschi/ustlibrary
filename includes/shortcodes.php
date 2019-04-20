<?php


function b4uloop($atts) {

   // EXAMPLE USAGE:
   // [library-loop post_per_page="10" order="ASC" taxonomy="category_book" terms="matematica" pagination="false"]
   
   // Defaults
   extract(shortcode_atts(array(
      "posts_per_page" => 5,
      "showposts" => 100,
      "order" => 'DESC',
      "taxonomy" => '',
      "terms" => '',
      "pagination" => 'true',

   ), $atts));

  global $post; 



  $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

 

  $args = array(
    'post_type'              => 'b3c_library',
    'posts_per_page'         => $posts_per_page,
    'order'                  => $order,
    'paged' => $paged,
  );

  if( !empty($taxonomy) ):
  $args['tax_query'] =  array(array(
                         'taxonomy' => $taxonomy, // ex: 'category_book'
                         'field' => 'slug',
                         'terms' => $terms, //slug-taxonomy ex: 'matematica'
                        ));
  endif;

  $the_query = new WP_Query( $args );
  if ( $the_query->have_posts() ) :

    while ( $the_query->have_posts() ) : $the_query->the_post(); 
      include( plugin_dir . '/templates/loop-books.php');
    endwhile; 

    if($pagination == 'true'):
		$big = 999999999; // need an unlikely integer
		 echo paginate_links( array(
		    'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
		    'format' => '?paged=%#%',
		    'current' => max( 1, get_query_var('paged') ),
		    'total' => $the_query->max_num_pages
		) );

		
 	endif;
 	wp_reset_postdata();
 ?>

  <?php else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
  <?php endif; ?>


<?php 
}
add_shortcode("library-loop", "b4uloop");








    
 