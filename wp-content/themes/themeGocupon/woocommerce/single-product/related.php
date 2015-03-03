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

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => $posts_per_page,
	'orderby'              => $orderby,
	'post__in'             => $related,
	'post__not_in'         => array( $product->id )
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) : ?>

	<div class="related products offers">

		<h2><?php _e( 'Related Products', 'woocommerce' ); ?></h2>
		<div class="row">
		<?php woocommerce_product_loop_start(); ?>

			<?php $c=0; while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php //wc_get_template_part( 'content', 'product' ); ?>
				<?php $c++;
				if($c%3==0){
					$divide ="<div class='divide'></div>";
				}else{
					$divide ="";
				}
				
				?>
				<div class=" col-md-4 item-offer">
					<div class="wrap-offer">
						<?php echo get_the_post_thumbnail( get_the_ID(),'smallimg-prod'); 
								$regular = get_post_meta( get_the_ID(), '_regular_price', true);
								$sales = get_post_meta( get_the_ID(), '_sale_price', true);
								$newprice = $regular - $sales;
								if($regular > 0){
									$porcent = (($regular - $sales) *100) /($regular);
								}else{
									$porcent = 0;
								}
								
						?> 
						<?php if($taxname=="comercio"){?>
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
							<?php global $product; echo $product->stock; ?> Restantes
							</span>
						<?php }?>
						<div class="float-caption">
							<h2><?php the_title();	?></h2>
						 	<div class="price">
								<?php
								
								if(($newprice<0)||($newprice==$regular)){
									$newprice =0;
								}
								 if($sales==""){
								 	$sales=0;
								  } ?>
								<?php if($taxname=="comercio"){?>
									<span class="amount regular"> En Comercio: <span><?php echo "$".$regular; ?></span></span>
									<span class="amount discount">Ahorras: <span><?php echo "$".$newprice;?></span></span>
									<span class="amount sales">Gocupon: <span><?php echo "$".$sales;?></span></span>
								<?php }else {?>
									<span class="amount regular"><span><?php echo "$".$regular; ?></span></span>
								<?php }?>
						 	</div>

							<a href="<?php echo get_the_permalink(get_the_ID()); ?>" class="show-offer">Ver Oferta</a>
						</div>						
					</div>
					<?php if($taxname=="comercio"){?>
					<div class="caption"><?php echo get_excerpt(60); ?></div>
					<?php }?>
				</div>
				<?php echo $divide;?>
			<?php endwhile; // end of the loop. ?>

		<?php woocommerce_product_loop_end(); ?>
		</div>
	</div>

<?php endif;

wp_reset_postdata();
