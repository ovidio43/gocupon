<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

if ( empty( $product ) || ! $product->exists() ) {
	return;
}

$related = $product->get_related( $posts_per_page );

if ( sizeof( $related ) == 0 ) return;

if(get_field('producto_de_comercio')){
	$obs = 	'==';
}else{
	$obs = 	'!=';
}
$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => 3,
	'orderby'              => 'rand',
	'post__not_in'         => array( $product->id ),
	'meta_query' => array(
		array(
			'key' => 'producto_de_comercio',
			'value' => '1',
			'compare' => $obs
		)
	)	
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) : ?>

	<div class="related products offers">

		<h2 class="title-related">
		<?php if(get_field('producto_de_comercio')){?>
		<?php _e( 'Cupones que podrían interesarte', 'woocommerce' ); ?>
		<?php }else{ ?>
		otros productos Cupons Up
		<?php }?>
		</h2>
		<div class="row">
		<?php woocommerce_product_loop_start(); ?>

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

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
							<span aria-hidden="true" class="glyphicon glyphicon-time"></span>
								<?php 
								$date_format = __( 'Y-m-d H:i:s' );
								$expiration_date = get_post_meta( get_the_ID(), '_expiration_date', true);

								$dt_end = new DateTime(date_i18n( $date_format, strtotime( $expiration_date ) ));
								$remain = $dt_end->diff(new DateTime());
								echo $remain->d . ' dias';
								?>
							</span>
						<?php }else{?>
							<span class="expirate-date">
							<?php echo $product->get_stock_quantity(get_the_ID()); ?>
							<?php //global $product; echo $product->stock; ?> Restantes
							</span>
						<?php }?>
						<div class="float-caption">
							<h2><?php the_title();	?></h2>
						 	<div class="price">
								<?php if(get_field('producto_de_comercio',get_the_ID())){?>
									<span class="amount regular"> En Comercio: <span><?php echo "$".get_field('precio_normal_aux',get_the_ID()); ?></span></span>
									<span class="amount discount">Ahorras: <span><?php echo "%".round($porcent,0);?></span></span>
									<span class="amount sales">Cupons Up: <span><?php echo "$".get_field('precio_rebajado_aux',get_the_ID());?></span></span>
								<?php }else {?>
									<span class="amount regular"><span><?php echo "$".get_post_meta( get_the_ID(), '_regular_price', true); ?></span></span>
								<?php }?>
						 	</div>

							<a href="<?php echo get_the_permalink(get_the_ID()); ?>" class="show-offer">Ver Oferta</a>
						</div>						
					</div>
					<div class="caption"><?php echo get_excerpt(60); ?></div>
				</div>
			<?php endwhile; // end of the loop. ?>
			<?php wp_reset_query(); ?>	
		<?php woocommerce_product_loop_end(); ?>
		</div>
	</div>

<?php endif;

wp_reset_postdata();
