<?php get_header();
if(get_query_var('product_cat')!=""){
	$taxname ="product_cat";
	$current_tax =get_query_var('product_cat');
}
if(get_query_var('comercio')!=""){
	$taxname ="comercio";
	$current_tax =get_query_var('comercio');
}
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
		<h1 class="main-title">Productos Gocupon <?php if($current_tax!="") echo "->".$current_tax;?></h1>
		<?php
		if($current_tax!=""){
			$taxarray = array( array( 'taxonomy' => $taxname,'field' => 'slug','terms'=>$current_tax));
		}else{
			$taxarray = array();
		}

            $args = array(
                'post_type' => 'product',
                'posts_per_page' => 8,
                'tax_query' => $taxarray,
                'paged' => $paged
            );
            $the_query = new WP_Query($args);
		?>
		<?php if ($the_query->have_posts()) : ?>
			<h2 class="subtitle"><?php echo $the_query->found_posts;?> PRODUCTOS PARA ELIGIR</h2>
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
						<?php echo get_the_post_thumbnail( get_the_ID(),'smallimg-prod'); ?> 
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
							<h2><?php the_title();	?></h2>
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
				</div>
				<?php echo $divide;?>
		    <?php endwhile; ?>
		    </div>
		<?php endif; ?>	
		<?php wp_reset_query(); ?>		
	</div>
</section>
<?php get_footer();?>