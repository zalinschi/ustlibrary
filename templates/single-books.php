<?php
/* Template: Library Single */

$book_image = get_the_post_thumbnail_url(get_the_ID(),'full');
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
		<a class="pdf-open">
			<?php _e('Read the book','b3c-library'); ?>
		</a>
	</div>
</div>

<?php
$meta = get_post_meta( $books->ID );
$book_print = $meta['book_print'][0];

echo "Print = ".$book_print;

?>
<div class="pdf-viewer" >
	<a class="pdf-close">✗</a>
	<?php
		$pdf_link =  get_post_meta( get_the_ID(), 'book_pdf_link', true);
		echo do_shortcode("[pdfjs-viewer url=$pdf_link]");
	?>
</div>