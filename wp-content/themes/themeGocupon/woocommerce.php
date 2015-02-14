<?php get_header();?>
<section class="next-offers">
	<div class="container">
		<div class="breadcrumbs">
			<?php the_breadcrumb();?>
		</div>
		

				<div class="content-page">
					<h1 class="main-title"><?php the_title();?></h1>
					<div class="entry-content">
						<?php woocommerce_content(); ?>
					</div>
				</div>

	</div>
</section>
<?php get_footer();?>