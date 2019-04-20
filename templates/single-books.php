<?php
/* Template: Library Single */

$book_id = get_the_ID();
$book_image = get_the_post_thumbnail_url($book_id,'full');
?>

<div class="book-wrapper">
	<div class="book-cover" 
		style="background-image: url('<?php echo $book_image; ?>')"> </div>
	<div class="book-info">
		<div class="book-meta">
			<?php 
				 get_library_term('book_category'); 
				 get_library_term('author_book'); 
				 get_library_term('pubhouse_book'); 
				 get_library_term('year_book'); 
				 get_library_term('lang_book');
				 get_library_term('tag_book'); 
			?>
		</div>
		<p class="description">
			<?php the_excerpt(); ?>
		</p>

		<?php if ( !post_password_required() ) : ?>		
			<a class="pdf-open">
				<?php _e('Read the book','ust-library'); 	?>
			</a>
		<?php else: ?>
			<?php echo "<div id='passwordForm' >".get_the_password_form()."</div>"; ?>
		<?php endif; ?>
	</div>
</div>

<?php 
	if ( !post_password_required() ) :  //is_user_logged_in() && !current_user_can( 'subscriber' ) && 
			display_book();
	endif;

 ?>
