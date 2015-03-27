<?php get_header();?>
<a href="#modal-content" class="main-modal"></a>
<div id="modal-content" class="modal-content" style="display:none;">
	<span class="logo-modal"><img src="<?php echo get_template_directory_uri(); ?>/img/s-logo-go.png"> </span>
	<a href="javascript:parent.$.fancybox.close();" class="close-modal">Ya estoy registrado</a>
	<img src="<?php echo get_template_directory_uri(); ?>/img/modal-banner.jpg">
	<div class="teaser-content">
		<h1>Bienvenido a Gocupon</h1>
		<p>Sed ut luctus quam. Etiam at ultricies purus. Donec eleifend arcu et purus ultrices hendrerit. Pellentesque at nulla sit amet orci placerat finibus. Phasellus tortor est, lobortis et cursus eu.</p>
		<form action="" name="" id="">
			<input type="text" value="" placeholder="Correo electrónico"/>
			<input type="submit" value="INGRESAR"/>
		</form>
	</div>
</div>	

<section class="feature-prod">
	<div class="container woocommerce">
<div class="breadcrumb"><a property="v:title" rel="v:url" href="http://gocupon.ganver.com/">Gocupon</a> » <span class="current">Home Page</span></div>
	<?php //echo do_shortcode('[wpb-feature-product] '); ?>
	<?php 
	$posts = get_field('productos_for_slide','option');
	if( $posts ): ?>
	    <ul class="bxslider">
		    <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
		        <?php setup_postdata($post); ?>
			<?php
			global $product;
			$attachment_ids = $product->get_gallery_attachment_ids();
			foreach( $attachment_ids as $attachment_id ) 
			{
				$med_image_url = wp_get_attachment_image_src( $attachment_id, 'slideimg-prod');?>
				<li>
					<img src="<?php echo $med_image_url[0];?>">
					<div class="caption-product">
					 	<h1><?php the_title(); ?></h1>
					 	<div class="description"><?php the_excerpt();?></div>
					 	<div class="row price">
							<?php
							$regular = get_field('precio_normal_aux');
							$sales = get_field('precio_rebajado_aux');
							$newprice = $regular - $sales;
							if($regular > 0){
								$porcent = (($regular - $sales) *100) /($regular);
							}else{
								$porcent = 0;
							}						
							 ?>
							<div class="col-md-4">
								<span class="regular"> En Comercio <br><span><?php echo "$".get_field('precio_normal_aux'); ?></span></span>
							</div>
							<div class="col-md-4">
								<span class="porcent">Ahorro <br><span><?php echo round($porcent,0)."%";?></span></span>
							</div>
							<div class="col-md-4">
								<span class="sale">Gocupon <br><span><?php echo "$".get_field('precio_rebajado_aux');?></span></span>
							</div>														
					 	</div>
						<div class="product-rating">
					       <?php //$string = WC_Product::get_rating_html( 5); echo $string;?>
					       <?php echo do_shortcode('[ratings id="'.get_the_ID().'"]');?>
					    </div> 
						<span class="expirate-date">
							<?php 
							$date_format = __( 'Y-m-d H:i:s' );
							//I used "Y-m-d H-i-s" instead of "Y-m-d H:i:s"
							$expiration_date = get_post_meta( get_the_ID(), '_expiration_date', true);

							$dt_end = new DateTime(date_i18n( $date_format, strtotime( $expiration_date ) ));
							$remain = $dt_end->diff(new DateTime());
							?>
							<div class="col-md-3">
								<span class="days"> Dias <br><span><?php echo $remain->d ?></span></span>
							</div>
							<div class="col-md-3">
								<span class="hours">Horas <br><span><?php echo $remain->h;?></span></span>
							</div>							
						</span>					                	
					 	<a href="<?php echo get_the_permalink(get_the_ID()); ?>" class="show-offer">Ver Oferta</a>
					</div>
				</li>
			<?php }?>               
		    <?php endforeach; ?>
	    </ul>
	    <?php wp_reset_postdata(); ?>
	<?php endif; ?>	
	</div>
</section>
<section class="offers">
	<div class="container">
		<h1>Ofertas Destacadas</h1>
		<?php
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => 8,
				'meta_query'		=> array(
					array(
						'key' => 'producto_de_comercio',
						'value' => '1',
						'compare' => '=='
					)
				)                
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
						<?php echo get_the_post_thumbnail( get_the_ID(),$size); 
							$regular = get_field('precio_normal_aux');
							$sales = get_field('precio_rebajado_aux');
							$newprice = $regular - $sales;
							if($regular > 0){
								$porcent = (($regular - $sales) *100) /($regular);
							}else{
								$porcent = 0;
							}								
						?> 
						<span class="porcent"><span><?php echo round($porcent,0)."%";?></span></span>
						<span class="expirate-date">
							<?php 
							$date_format = __( 'Y-m-d H:i:s' );
							$expiration_date = get_post_meta( get_the_ID(), '_expiration_date', true);

							$dt_end = new DateTime(date_i18n( $date_format, strtotime( $expiration_date ) ));
							$remain = $dt_end->diff(new DateTime());
							echo $remain->d . ' dias y ' . $remain->h . ' horas';
							?>
						</span>
						<div class="float-caption">
							<h2><?php the_title();?></h2>
						 	<div class="price">	
								<span class="amount regular"> Precio en Comercio: <span><?php echo "$".get_field('precio_normal_aux'); ?></span></span>
								<span class="amount discount">Promocion: <span><?php echo "%".round($porcent,0);?></span></span>
								<span class="amount sales">Precio en Gocupon: <span><?php echo "$".get_field('precio_rebajado_aux');?></span></span>
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
<section class="list_clients">
	<div class="container">
		<?php
		$rows = get_field('lista_clientes', 'option');
		if($rows)
		{
			echo '<ul class="bxslider_carrousel">';
			foreach($rows as $row)
			{
				$image_url = wp_get_attachment_image_src( $row['logo_cliente'], 'thumbnail');?>
				<li><img src="<?php echo $image_url[0];?>" /></li>
			<?php }
			echo '</ul>';
		}		
		?>	
	</div>	
</section>
<?php get_footer();?>
<script type="text/javascript">
    $(document).ready(function() {
        $(".main-modal").fancybox({
        	padding:0,
        	closeBtn:false
        }).trigger('click');
    });
</script>