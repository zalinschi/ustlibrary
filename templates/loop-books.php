<?php
 $bgcolor = get_post_meta( get_the_ID(), 'book_cover_color', true ); 
?>
<article class="row book-item">
  
  <div class="bk-img">
    <div class="bk-wrapper">
      <div class="bk-book bk-bookdefault">
        <div class="bk-front <?php if(post_password_required()){ echo "locked"; }?>" style="background-color:<?php echo $bgcolor; ?>">
          <div class="bk-cover" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(),'full') ?>')"></div>
        </div>
        <div class="bk-left" style="background-color:<?php echo $bgcolor; ?>"></div>
        <div class="bk-shadow"></div>
      </div>
    </div>
  </div>

  <div class="item-details">
    <h3 class="book-item_title"><?php the_title(); ?></h3>
    <div class="author"><?php get_library_term('author_book');  ?> </div>
  	<div class="author"> 
  		<?php get_library_term('pubhouse_book');  ?>
  		<?php  get_library_term('year_book');  ?>  
  	</div>
    <span class="excerpt">
		  <?php echo get_the_excerpt_protected_disable(); ?>
	 </span>
    <a class="button button-primary" href="<?php the_permalink(); ?>" rel="bookmark"> <?php _e('Read more'); ?> </a>
  </div>
</article>