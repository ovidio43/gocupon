<?php get_header();?>

<section class="next-offers">
	<div class="container">
	<h1>Proxims Ofertas</h1>
		<?php if (have_posts()) : ?>
			<div class="row">
			<?php while (have_posts()) : the_post(); ?>
				<div class="col-md-4 item-offer">
					<?php echo get_the_post_thumbnail( get_the_ID(),'medium'); ?> 
					<h2><?php the_title();?></h2>
				</div>
		    <?php endwhile; ?>
		    </div>
		<?php endif; ?>	
		<?php wp_reset_query(); ?>	
	</div>
</section>
<?php get_footer();?>