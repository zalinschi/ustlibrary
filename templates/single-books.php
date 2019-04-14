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
		<a class="pdf-open">
			<?php _e('Read the book','b3c-library'); 	?>
		</a>

	</div>
</div>


<div class="pdf-viewer" >
	<a class="pdf-close">✗</a>
	<?php


		$meta = get_post_meta( $book_id );
		$pdf_link =  $meta['book_pdf_link'][0];
		
		if($meta['book_print'][0] == 1){ $is_printable = 'false'; }
		else { $is_printable = 'true'; }

		if($meta['book_download'][0] == 1){ $is_downloadable = 'false'; } 
		else { $is_downloadable = 'true'; }

		if($meta['book_copypaste'][0] == 1){ $is_copy_paste = 'false'; }
		else{ $is_copy_paste = 'true'; }

		echo do_shortcode("[pdfjs-viewer url=$pdf_link download=$is_downloadable print=$is_printable cp=$is_copy_paste]");
	?>
</div>