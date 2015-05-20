<?php
/**
 * Simple product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}

?>

<?php
	// Availability
	$availability      = $product->get_availability();
	$availability_html = empty( $availability['availability'] ) ? '' : '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>';

	echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product );
?>

<?php if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart" method="post" enctype='multipart/form-data'>
	<?php if(get_field('producto_de_comercio')){?>
		<span class="expirate-date">
			<?php 
			$date_format = __( 'Y-m-d H:i:s' );
			$expiration_date = get_post_meta( get_the_ID(), '_expiration_date', true);

			$dt_end = new DateTime(date_i18n( $date_format, strtotime( $expiration_date ) ));
			$remain = $dt_end->diff(new DateTime());
			echo  '<div class="wrap-expiration"> dias<br> <span class="bg-black day">'.$remain->d.'</span></div>' . ' <div class="wrap-expiration">horas <br><span class="bg-black hour">' .$remain->h.'</span></div>';
			?>
		</span>		
	<?php }?>
	 	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

	 	<?php
	 		if ( ! $product->is_sold_individually() )
	 			woocommerce_quantity_input( array(
	 				'min_value' => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
	 				'max_value' => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product )
	 			) );
	 	?>

	 	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />

	 	<button type="submit" class="single_add_to_cart_button button alt" <?php echo $product->is_in_stock() ? '' : 'disabled'; ?>><?php echo $product->single_add_to_cart_text(); ?></button>
		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	</form>
	<div class="wrap-share" style="text-align:right;padding:0 0 10px 0;">
		<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-539f76f8264f1eac" async="async"></script>
		<div class="addthis_sharing_toolbox"></div>		
	</div>
	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
