<?php
/*
Plugin Name: PDFjs Viewer
Plugin URI: http://byterevel.com/
Description: Embed PDFs with the gorgeous PDF.js viewer
Version: 1.3
Author: Ben Lawson
Author URI: http://byterevel.com/
License: GPLv2
*/


//==== Shortcode ====

//tell wordpress to register the pdfjs-viewer shortcode
add_shortcode("pdfjs-viewer", "pdfjs_handler");

function pdfjs_handler($incoming_from_post) {
  //set defaults 
  $incoming_from_post=shortcode_atts(array(
    'url' => 'bad-url.pdf',  
    'viewer_height' => '100vh',
    'viewer_width' => '100%',
    'download' => 'true',
    'print' => 'true',
    'cp' => 'true', //copypaste
    'openfile' => 'false'
  ), $incoming_from_post);

  $pdfjs_output = pdfjs_generator($incoming_from_post);

  //send back text to replace shortcode in post
  return $pdfjs_output;
}

function pdfjs_generator($incoming_from_handler) {
  $viewer_base_url= plugins_url()."/".plugin_slug."/pdfjs/web/viewer.php";
  
  $copy_paste= $incoming_from_handler["cp"];
  $file_name = $incoming_from_handler["url"];
  $viewer_height = $incoming_from_handler["viewer_height"];
  $viewer_width = $incoming_from_handler["viewer_width"];
  $download = $incoming_from_handler["download"];
  $print = $incoming_from_handler["print"];
  $openfile = $incoming_from_handler["openfile"];
  
  if ($download != 'true') {
      $download = 'false';
  }
  
  if ($print != 'true') {
      $print = 'false';
  }
  
  if ($openfile != 'true') {
      $openfile = 'false';
  }
  
  $final_url = $viewer_base_url."?file=".$file_name."&download=".$download."&print=".$print."&openfile=".$openfile."&cp=".$copy_paste;
  
  $iframe_code = '<iframe style="border:none; width:'.$viewer_width.'; height:'.$viewer_height.';"  src="'.$final_url.'"></iframe> ';
  
  return $iframe_code;
}

?>