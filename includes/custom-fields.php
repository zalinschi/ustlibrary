<?php
/*
 * CUSTOM FIELDS (Cîmpuri Personalizate) 
 */

function cpt_biblioteca_setup_meta_box() {
	add_meta_box('cf_preview_book', __('Preview book','ust-library'),'display_preview_book_cf','b3c_library', 'normal', 'high' );
	add_meta_box('cf_color_book_cover', __('Book Cover Color','ust-library'),'display_color_book_cf','b3c_library', 'normal', 'high' );	
	add_meta_box('cf_details_book', __('Book Details','ust-library'),'display_book_details_cf','b3c_library', 'normal', 'high' );	
}

function display_book_details_cf( $books ) {
	$meta = get_post_meta( $books->ID );

	
	$book_pages = ( isset( $meta['book_pages'][0] ) && '' !== $meta['book_pages'][0] ) ? $meta['book_pages'][0] : '';
	$book_isbn  = ( isset( $meta['book_isbn'][0] ) && '' !== $meta['book_isbn'][0] ) ? $meta['book_isbn'][0] : '';
	$book_issn  = ( isset( $meta['book_issn'][0] ) && '' !== $meta['book_issn'][0] ) ? $meta['book_issn'][0] : '';

	$book_print = $meta['book_print'][0];
	$book_copypaste = $meta['book_copypaste'][0];
	$book_download =  $meta['book_download'][0];
	?>
		<table style='border-spacing: 0; width:100%;'>
			<tr>
				<td style="width: 33.33%">
					<label><?php _e('Number of pages','ust-library'); ?></label>
					<input  type='number' name='book_pages'  value='<?php echo $book_pages; ?>'  /> 
				</td>

				<td style="width: 33.33%">
					<label><?php _e('ISBN','ust-library') ?></label>
					<input  type='text' name='book_isbn'  value='<?php echo $book_isbn; ?>'  />
				</td>

				<td style="width: 33.33%">
					<label><?php _e('ISSN','ust-library') ?></label>
					<input  type='text' name='book_issn'  value='<?php echo $book_issn; ?>'  />
				</td>
			</tr>
			<tr>
				<td style="width: 33.33%">
					<label>
						<input type="checkbox" name="book_copypaste" value="1" <?php checked( $book_copypaste, 1 ); ?> />
						<?php esc_attr_e( 'Copy Paste Disable ?', 'ust-library' ); ?>
					</label>
				</td>

				<td style="width: 33.33%">
					<label>
						<input type="checkbox" name="book_download" value="1" <?php checked( $book_download, 1 ); ?> />
						<?php esc_attr_e( 'Disable Download ?', 'ust-library' ); ?>
					</label>
				</td>

				<td style="width: 33.33%"> 
					<label>
						<input type="checkbox" name="book_print" value="1" <?php checked( $book_print, 1 ); ?> />
						<?php esc_attr_e( 'Disable Print ?', 'ust-library' ); ?>
					</label>
				</td>
			</tr>
		</table>
	<?php
}

function display_color_book_cf( $books ) {
	$book_cover_color = esc_html( get_post_meta( $books->ID,'book_cover_color', true ) );
	?>
		<table style='border-spacing: 0; width:100%;'>
			<tr>
				<td> <input  type='color' name='book_cover_color'  value='<?php echo $book_cover_color; ?>'  /> </td>
			</tr>
		</table>
	<?php
}

function display_preview_book_cf( $books ) {
		$book_pdf_link = esc_html( get_post_meta( $books->ID,'book_pdf_link', true ) );
?>
		<table style='border-spacing: 0; width:100%;'>
			<tr>
				<td style="width: 100px;">
					<input style="margin-left: 3px" id="uploadbutton" type="button" class="button button-primary button-large" value="<?php _e('Upload PDF','ust-library'); ?>">  
				</td>
				<td> 
					<input  id="pdflink" type='text' name='book_pdf_link' placeholder="URL PDF" value='<?php echo $book_pdf_link; ?>' style="width: 100%" /> 
				</td>
				<tr>
					<td colspan="2" >
						<?php
							$pdf_link =  get_post_meta( get_the_ID(), 'book_pdf_link', true);
							echo do_shortcode("[pdfjs-viewer url=$pdf_link]");
						?>
					</td>
				</tr>
			</tr>

				<script type="text/javascript">
				   	jQuery(document).ready(function(e) {
						e("#uploadbutton").click(function(t) {

				   	        t.preventDefault();
				   	        var r = wp.media({
				   	            title: "<?php _e("Select a PDF file","ust-library") ?>",
				   	            multiple: !1
				   	        }).open().on("select", function(t) {
				   	            var i = r.state().get("selection").first().toJSON().url;
				   	            e("#pdflink").val(i);
				   	            e("#pdf-preview").attr("src",i);
				   	        })

				   	    })

				   	    e("#pdflink").on('change', function(){    
							e("#pdf-preview").attr("src",e("#pdflink").val());
						});

						e("#pdf-preview").attr("src",e("#pdflink").val());
				   	});
				</script>
		</table>
<?php
}

function ustlib_save_metabox( $post_id,$cpt_name) {
    // Selectăm tabelul din BD a Post Type-ului cpt_web
    if ( $cpt_name->post_type == 'b3c_library' ) {
        
        // Salvăm cîmpurile în BD
		if ( isset( $_POST['book_pdf_link'] )) { update_post_meta( $post_id, 'book_pdf_link', $_POST['book_pdf_link'] ); }
		if ( isset( $_POST['book_cover_color'] )) { update_post_meta( $post_id, 'book_cover_color', $_POST['book_cover_color'] ); }

		if ( isset( $_POST['book_pages'] )) { 
			update_post_meta( $post_id, 'book_pages', $_POST['book_pages'] ); 
		}

		if ( isset( $_POST['book_isbn'] )) { 
			update_post_meta( $post_id, 'book_isbn', $_POST['book_isbn'] ); 
		}

		if ( isset( $_POST['book_issn'] )) { 
			update_post_meta( $post_id, 'book_issn', $_POST['book_issn'] ); 
		}


		$book_print = ( isset( $_POST['book_print'] ) && '1' === $_POST['book_print'] ) ? 1 : 0;
		update_post_meta( $post_id, 'book_print', esc_attr( $book_print ) );

		$book_copypaste = ( isset( $_POST['book_copypaste'] ) && '1' === $_POST['book_copypaste'] ) ? 1 : 0;
		update_post_meta( $post_id, 'book_copypaste', esc_attr( $book_copypaste ) );

		$book_download = ( isset( $_POST['book_download'] ) && '1' === $_POST['book_download'] ) ? 1 : 0;
		update_post_meta( $post_id, 'book_download', esc_attr( $book_download ) );

    }
}

add_action( 'save_post','ustlib_save_metabox', 10, 3 );
add_action( 'admin_init', 'cpt_biblioteca_setup_meta_box' );

