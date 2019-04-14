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

    if($pagination == 'true'): ?>
      <div class="navHolder">
        <div class="nav-prev nav-previous">
          <?php previous_posts_link( __('Back').' &laquo;' ); ?>
        </div>
       <div class="nav-next">
         <?php next_posts_link( __('Next').' &raquo;', $the_query->max_num_pages ); ?>
       </div>
      </div>
    <?php endif;
   // wp_reset_postdata(); ?>

  <?php else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
  <?php endif; ?>


<?php 
}
add_shortcode("library-loop", "b4uloop");








    
 