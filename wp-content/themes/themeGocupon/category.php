<?php get_header();?>

<section class="next-offers">
	<div class="container">
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				
					<?php the_content();?>

		    <?php endwhile; ?>
		<?php endif; ?>	
		<?php wp_reset_query(); ?>	
	</div>
</section>
<?php get_footer();?>