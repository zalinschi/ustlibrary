<?php
/*
 * CUSTOM FIELDS (Cîmpuri Personalizate) 
 */

function cpt_biblioteca_setup_meta_box() {
	add_meta_box('cf_preview_book','Preview book','display_preview_book_cf','b3c_library', 'normal', 'high' );
	add_meta_box('cf_color_book_cover','Book Cover Color','display_color_book_cf','b3c_library', 'normal', 'high' );		
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
					<input style="margin-left: 3px" id="uploadbutton" type="button" class="button button-primary button-large" value="Upload PDF">  
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
				   	            title: "Selectează un fișier PDF",
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
    }
}

add_action( 'save_post','ustlib_save_metabox', 10, 3 );
add_action( 'admin_init', 'cpt_biblioteca_setup_meta_box' );

