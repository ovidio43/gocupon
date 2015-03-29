<?php
/**
 * Description tab
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

$heading = esc_html( apply_filters( 'woocommerce_product_description_heading', __( 'Product Description', 'woocommerce' ) ) );

?>

<?php if ( $heading ): ?>
  <!--h2><?php echo $heading; ?></h2-->
<?php endif; ?>
<div class="row">
	<div class="col-md-8">
		<?php the_content(); ?>
	</div>
	<div class="col-md-4">
		<?php the_field('terminos_y_condiciones'); ?>
	</div>
</div>
<?php $desc =get_field('descripcion_comercio'); if(!empty($desc)){?>
<div class="row aditional-content">

	<div class="col-md-8">
	<h2>Ubicación del comercio</h2>
	<div class="row">
		<div class="col-md-8">
			<?php 
			$location = get_field('ubicacion_de_comercio');
			if( !empty($location) ):
			?>
			<div class="acf-map">
				<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
			</div>
			<?php endif; ?>
		</div>
		<div class="col-md-4">
			<span class="grey"> 
			<br><?php echo $location['address']; ?>				
			</span>
		</div>		
	</div>
	</div>
	<div class="col-md-4">
		<?php the_field('descripcion_comercio'); ?>
	</div>	
</div>
<?php }?>
