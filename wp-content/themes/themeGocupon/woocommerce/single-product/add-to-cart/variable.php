<?php
/**
 * Variable product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $product, $post;
?>

<script type="text/javascript">
    var product_variations_<?php echo $post->ID; ?> = <?php echo json_encode( $available_variations ) ?>;
</script>

<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo $post->ID; ?>" data-product_variations="<?php echo esc_attr( json_encode( $available_variations ) ) ?>">
	<?php if ( ! empty( $available_variations ) ) : ?>
		<table class="variations" cellspacing="0">
			<tbody>
				<?php $loop = 0; foreach ( $attributes as $name => $options ) : $loop++; ?>
					<tr>
						<!--td class="label"><label for="<?php echo sanitize_title($name); ?>"><?php echo wc_attribute_label( $name ); ?></label></td-->
						<td class="value"><fieldset>
                        <strong>Elije entre las siguientes opciones:</strong><br />
                        <?php
                            if ( is_array( $options ) ) {
 
                                if ( empty( $_POST ) )
                                    $selected_value = ( isset( $selected_attributes[ sanitize_title( $name ) ] ) ) ? $selected_attributes[ sanitize_title( $name ) ] : '';
                                else
                                    $selected_value = isset( $_POST[ 'attribute_' . sanitize_title( $name ) ] ) ? $_POST[ 'attribute_' . sanitize_title( $name ) ] : '';
								//echo   $selected_value;
                                // Get terms if this is a taxonomy - ordered
                                if ( taxonomy_exists( sanitize_title( $name ) ) ) {
 
                                    $terms = get_terms( sanitize_title($name), array('menu_order' => 'ASC') );
									
                                    foreach ( $terms as $term ) {
                                        if ( ! in_array( $term->slug, $options ) ) continue;
                                        echo '<input type="radio" value="' . strtolower($term->slug) . '" ' . checked( strtolower ($selected_value), strtolower ($term->slug), false ) . ' id="'. esc_attr( sanitize_title($name) ) .'" name="attribute_'. sanitize_title($name).'"> ' . apply_filters( 'woocommerce_variation_option_name', $term->name ).'<br />';
                                    }
                                } else {
                                    foreach ( $options as $option )
                                        echo '<input type="radio" value="' .esc_attr( sanitize_title( $option ) ) . '" ' . checked( sanitize_title( $selected_value ), sanitize_title( $option ), false ) . ' id="'. esc_attr( sanitize_title($name) ) .'" name="attribute_'. sanitize_title($name).'"> ' . apply_filters( 'woocommerce_variation_option_name', $option ) . '<br />';
                                }
                            }
                        ?>
                    </fieldset> <?php
							if ( sizeof($attributes) == $loop )
								//echo '<a class="reset_variations" href="#reset">' . __( 'Clear selection', 'woocommerce' ) . '</a>';
						?></td>
					</tr>
		        <?php endforeach;?>
			</tbody>
		</table>

		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<div class="single_variation_wrap" style="display:none;">
			<?php do_action( 'woocommerce_before_single_variation' ); ?>

			<div class="single_variation"></div>

			<div class="variations_button">
				<?php woocommerce_quantity_input(); ?>
				
				<button type="submit" <?php echo $product->is_in_stock() ? '' : 'disabled'; ?> class="single_add_to_cart_button button alt"><?php echo $product->single_add_to_cart_text(); ?></button>
			</div>

			<input type="hidden" name="add-to-cart" value="<?php echo $product->id; ?>" />
			<input type="hidden" name="product_id" value="<?php echo esc_attr( $post->ID ); ?>" />
			<input type="hidden" name="variation_id" value="" />

			<?php do_action( 'woocommerce_after_single_variation' ); ?>
			<span class="expirate-date">
				<?php 
				date_default_timezone_set(get_option('timezone_string'));
				$date_format = __( 'Y-m-d H:i:s' );
				$expiration_date = get_post_meta( get_the_ID(), '_expiration_date', true);
				
				$dt_end = new DateTime(date_i18n( $date_format, strtotime( $expiration_date ) ), new DateTimeZone(get_option('timezone_string')));
				$remain = $dt_end->diff(new DateTime());
				// get all coutn date in days
				$currentdate = date_i18n( $date_format, strtotime( '11/15-1976' ) );
				$after1yrdate =  $expiration_date;
				$diff = (strtotime($after1yrdate) - strtotime($currentdate)) / (60 * 60 * 24);			
				echo  '<div class="wrap-expiration"> dias<br> <span class="bg-black day">'.round($diff).'</span></div>' . ' <div class="wrap-expiration">horas <br><span class="bg-black hour">' .$remain->h.'</span></div>' . ' <div class="wrap-expiration">min <br><span class="bg-black hour">' .$remain->m.'</span></div>';
				?>
			</span>				
		</div>
		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<?php else : ?>

		<p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>

	<?php endif; ?>

</form>
<div class="wrap-share" style="text-align:right;padding:0 0 10px 0;">
	<!-- Go to www.addthis.com/dashboard to customize your tools -->
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-539f76f8264f1eac" async="async"></script>
	<!-- Go to www.addthis.com/dashboard to customize your tools -->
	<div class="addthis_sharing_toolbox"></div>		
</div>
<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
