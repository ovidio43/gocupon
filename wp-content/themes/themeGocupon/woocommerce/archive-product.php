<?php get_header();
if(get_query_var('product_cat')!=""){
	$taxname ="product_cat";
	$current_tax =get_query_var('product_cat');
}
if(get_query_var('comercio')!=""){
	$taxname ="comercio";
	$current_tax =get_query_var('comercio');
}
$term =	$wp_query->queried_object;
global $paged;
if (get_query_var('paged'))
    $paged = get_query_var('paged');
else if (get_query_var('page'))
    $paged = get_query_var('page');
else
    $paged = 1; 

?>
<section class="offers">
	<div class="container">
		<div class="breadcrumbs">
			<?php the_breadcrumb();?>
		</div>	
		
		<?php
		if($current_tax!=""){
			$taxarray = array( array( 'taxonomy' => $taxname,'field' => 'slug','terms'=>$current_tax));
			$metaquery = array(array('key' => 'producto_de_comercio',	'value' => '1','compare' => '=='));
		}else{
			$taxarray = array();
			$metaquery = array(	array('key' => 'producto_de_comercio',	'value' => '1','compare' => '!=')); 

		}
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => 8,
                'tax_query' => $taxarray,
                'paged' => $paged ,	
                'meta_query' => $metaquery
            );
            $the_query = new WP_Query($args);
		?>
		<?php if ($the_query->have_posts()) : ?>
			<?php if($taxname=="comercio"){				
				$queried_object = get_queried_object();
				$term_id = $queried_object->term_id;
				
				?>
				<div class="row comercio-head">
					<div class="col-md-1">
					<?php $thumb = wp_get_attachment_image_src(get_field('logotipo_de_comercio', 'comercio_'.$term_id), 'thumbnail' );?>
						<?php if($thumb['0']!=""){?>
						<img src="<?php echo $thumb['0'];?>">
						<?php }?>
					</div>
					<div class="col-md-6">
						<h1><?php echo $term->name;?></h1>
						<?php 
							echo get_field('descripcion_comercio', 'comercio_'.$term_id);
						?>
					</div>
					<div class="col-md-5">
						<?php 
						$location = get_field('ubicacion_de_comercio', 'comercio_'.$term_id);
						if( !empty($location) ):
						?>
						<div class="acf-map">
							<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
						</div>
					<?php endif; ?>
					</div>
				</div>
				<h2 class="subtitle"><?php echo $the_query->found_posts;?> CUPONES EN CARTELERA</h2>
			<?php }else{ ?>
				<h1 class="main-title">Productos Gocupon</h1>
				<h2 class="subtitle"><?php echo $the_query->found_posts;?> PRODUCTOS PARA ELIGIR</h2>
			<?php }?>
			<div class="row">
			<?php $c=0;while ($the_query->have_posts()) : $the_query->the_post(); 
				$c++;
				if($c%3==0){
					$divide ="<div class='divide'></div>";
				}else{
					$divide ="";
				}
				
				?>
				<div class=" col-md-4 item-offer">
					<div class="wrap-offer">
						<?php echo get_the_post_thumbnail( get_the_ID(),'smallimg-prod'); 
							$regular = get_field('precio_normal_aux',get_the_ID());
							$sales = get_field('precio_rebajado_aux',get_the_ID());
							$newprice = $regular - $sales;
							if($regular > 0){
								$porcent = (($regular - $sales) *100) /($regular);
							}else{
								$porcent = 0;
							}	
								
						?> 
						<?php if(get_field('producto_de_comercio',get_the_ID())){?>
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
						<?php }else{?>
							<span class="expirate-date">
							<?php echo $product->get_stock_quantity(get_the_ID()); ?>
							<?php //global $product; echo $product->stock;  ?> Restantes
							</span>
						<?php }?>
						<div class="float-caption">
							<h2><?php the_title();	?></h2>
						 	<div class="price">
								<?php if(get_field('producto_de_comercio',get_the_ID())){?>
									<span class="amount regular"> En Comercio: <span><?php echo "$".get_field('precio_normal_aux',get_the_ID()); ?></span></span>
									<span class="amount discount">Ahorras: <span><?php echo "%".round($porcent,0);?></span></span>
									<span class="amount sales">Gocupon: <span><?php echo "$".get_field('precio_rebajado_aux',get_the_ID());?></span></span>
								<?php }else {?>
									<span class="amount sales"><span><?php echo "$".get_post_meta( get_the_ID(), '_regular_price', true); ?></span></span>
								<?php }?>
						 	</div>

							<a href="<?php echo get_the_permalink(get_the_ID()); ?>" class="show-offer">
							<?php
								if(get_field('producto_de_comercio',get_the_ID())){
									echo "Ver Oferta";
								}else{
									echo "Ver Producto";
								}
							?>
							</a>
						</div>						
					</div>
					<?php if(get_field('producto_de_comercio',get_the_ID())){?>
					<div class="caption"><?php echo get_excerpt(60); ?></div>
					<?php }?>
				</div>
				<?php echo $divide;?>
		    <?php endwhile; ?>
		    </div>
		<?php endif; ?>	
		<?php wp_reset_query(); ?>		
	</div>
</section>
<?php get_footer();?>