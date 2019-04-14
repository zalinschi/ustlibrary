<?php 
	get_header(); 

?>

	<section id="primary" class="site-content">
		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title">
					<?php get_the_library_title(); ?>
				</h1>
			</header><!-- .archive-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				?>
			<?php /* .............................................................................. */ ?>

					<?php get_template_part_book() ?>	

			<?php /* .............................................................................. */ ?>
			<?php
			endwhile;

			//pagination();
			?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
