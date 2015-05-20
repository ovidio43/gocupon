<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>
<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

	<!--p class="price"><?php echo $product->get_price_html(); ?>
		<?php 
			$regular = get_post_meta( get_the_ID(), '_regular_price', true);
			$sales = get_post_meta( get_the_ID(), '_sale_price', true);		
		if($regular > 0){
			$porcent = (($regular - $sales) *100) /($regular);
		}else{
			$porcent = 0;
		}
		if($sales!=""){?>
			<span class="porcent"><span><?php echo round($porcent,0)."%";?></span></span>
		<?php }?>
	</p-->
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
 	<div class="price">
		 <?php if(get_field('producto_de_comercio')){?>
			<span class="amount regular"> Precio en Comercio: <span><?php echo "$".get_field('precio_normal_aux'); ?></span></span>
			<span class="amount discount">Promocion: <span><?php echo "%".round($porcent,0);?></span></span>
			<span class="amount sales">Precio en Cupons Up: <span><?php echo "$".get_field('precio_rebajado_aux');?></span></span>
		<?php }else{ ?>
			<span class="amount regular"> Precio por unidad: <span><?php echo $product->get_price_html(); ?></span></span>
		<?php }?>

 	</div>
	<meta itemprop="price" content="<?php echo $product->get_price(); ?>" />
	<meta itemprop="priceCurrency" content="<?php echo get_woocommerce_currency(); ?>" />
	<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />
</div>
