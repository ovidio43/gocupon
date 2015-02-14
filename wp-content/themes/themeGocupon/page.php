<?php get_header();?>
<section class="next-offers">
	<div class="container">
		<div class="breadcrumbs">
			<?php the_breadcrumb();?>
		</div>
		
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<div class="content-page">
					<h1 class="main-title"><?php the_title();?></h1>
					<div class="entry-content">
						<?php the_content();?>	
					</div>
				</div>

		    <?php endwhile; ?>
		<?php endif; ?>	
		<?php wp_reset_query(); ?>	
	</div>
</section>
<?php get_footer();?>