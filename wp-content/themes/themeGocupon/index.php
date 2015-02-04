<?php get_header();?>
<section class="feature-prod">
	<div class="container">
	<?php echo do_shortcode('[wpb-feature-product title="Feature Products"] '); ?>
	</div>
</section>
<section class="offers">
	<div class="container">
	<h1>Ofertas Destacadas</h1>
		<?php
			echo do_shortcode( '[recent_products per_page="12" columns="3"]' );
		?>	
	</div>
</section>
<section class="next-offers">
	<div class="container">
	<h1>Proxims Ofertas</h1>
		<?php
			echo do_shortcode( '[recent_products per_page="12" columns="3"]' );
		?>	
	</div>
</section>
<?php get_footer();?>