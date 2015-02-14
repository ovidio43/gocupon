<?php get_header();?>
<section class="feature-prod">
</section>
<section class="offers">
	<div class="container">
		<h1>Productos Gocupon</h1>
		<?php
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => 8
            );
            $the_query = new WP_Query($args);
		?>
		<?php if ($the_query->have_posts()) : ?>
			<div class="row">
			<?php $c=0;while ($the_query->have_posts()) : $the_query->the_post(); 
				$c++;
				if($c%2==0){
					$divide ="<div class='divide'></div>";
				}else{
					$divide ="";
				}
				if(($c==2)||($c==3)||($c==6)||($c==7)){
					$size ="bigimg-prod";
					$cols = "col-md-8";
				}else{
					$size ="smallimg-prod";
					$cols = "col-md-4";
				}
				?>
				<div class="<?=$cols?> item-offer">
					<div class="wrap-offer">
						<?php echo get_the_post_thumbnail( get_the_ID(),$size); ?> 
						<span class="porcent"><span><?php echo round($porcent,0)."%";?></span></span>
						<span class="expirate-date">
							<?php 
							$date_format = __( 'M j, Y G:i' );
							$expiration_date = get_post_meta( get_the_ID(), '_expiration_date', true);

							$dt_end = new DateTime(date_i18n( $date_format, strtotime( $expiration_date ) ));
							$remain = $dt_end->diff(new DateTime());
							echo $remain->d . ' dias y ' . $remain->h . ' horas';
							?>
						</span>
						<div class="float-caption">
							<h2><?php the_title();?></h2>
						 	<div class="price">
								<?php
								$regular = get_post_meta( get_the_ID(), '_regular_price', true);
								$sales = get_post_meta( get_the_ID(), '_sale_price', true);
								$newprice = $regular - $sales;
								$porcent = (($regular - $sales) *100) /($regular);								
								if(($newprice<0)||($newprice==$regular)){
									$newprice =0;
								}
								 if($sales==""){
								 	$sales=0;
								  } ?>	
								<span class="amount regular"> En Comercio: <span><?php echo "$".$regular; ?></span></span>
								<span class="amount discount">Ahorras: <span><?php echo "$".$newprice;?></span></span>
								<span class="amount sales">Gocupon: <span><?php echo "$".$sales;?></span></span>
						 	</div>

							<a href="<?php echo get_the_permalink(get_the_ID()); ?>" class="show-offer">Ver Oferta</a>
						</div>						
					</div>
					<div class="caption"><?php echo get_excerpt(60); ?></div>
				</div>
				<?php echo $divide;?>
		    <?php endwhile; ?>
		    </div>
		<?php endif; ?>	
		<?php wp_reset_query(); ?>	
		<?php
			//echo do_shortcode( '[recent_products per_page="6" columns="3"]' );
		?>	
	</div>
</section>
<section class="next-offers">
	<div class="container">
	<h1>Proximas Ofertas</h1>
	<?php
            $args = array(
                'post_type' => 'proximas-ofertas'
            );
            $the_query = new WP_Query($args);
	?>
		<?php if ($the_query->have_posts()) : ?>
			<div class="row">
			<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
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
<section class="wrap-newsletter">
	<div class="container">
		<div class="newsletter">
			<?php if ( is_active_sidebar( 'newsletter' ) ) : ?>
			  <?php dynamic_sidebar( 'newsletter' ); ?>
			<?php endif; ?> 			
		</div>
	</div>
</section>
<?php get_footer();?>