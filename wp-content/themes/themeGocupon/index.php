<?php session_start(); get_header();?>
<a href="#modal-content" class="main-modal"></a>
<div id="modal-content" class="modal-content" style="display:none;">
	<span class="logo-modal"><img src="<?php echo get_template_directory_uri(); ?>/img/cupons-logo-s.png"> </span>
	<a href="javascript:parent.$.fancybox.close();" class="close-modal">Ya estoy registrado</a>
	<?php $image_modal = wp_get_attachment_image_src( get_field('image_modal','option'), 'big');?>
	<img src="<?php echo $image_modal[0];?>">
	<div class="teaser-content">
		<h1><?php the_field('title_modal','option')?></h1>
		<p><?php the_field('content_modal','option')?></p>
        <form action="/send-suscribe.php" method="post" id="mc-embedded-subscribe-form2" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                 <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Correo electrónico" data-validate="validate(required, email)">
                 <input type="hidden" name="idmailchimp" value="<?php echo get_field('modal_mailchimp_id','option');?>">
                <input type="submit" value="INGRESAR" name="subscribe" id="mc-embedded-subscribe" class="wysija-submit">
				<span class="thanks-txt"></span>	
        </form>				
	</div>
</div>	

<section class="feature-prod">
	<div class="container woocommerce">
<div class="breadcrumb"><a property="v:title" rel="v:url" href="<?php echo esc_url(home_url('/')); ?>">Cupons Up</a> » <span class="current">Home Page</span></div>
	<?php //echo do_shortcode('[wpb-feature-product] '); ?>
	<?php 
	$posts = get_field('productos_for_slide','option');
	if( $posts ): ?>
	    <ul class="bxslider">
		    <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
		        <?php setup_postdata($post); ?>
			<?php
			$featureProd=get_the_ID();
				$med_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'slideimg-prod');?>
				<li>
					<img src="<?php echo $med_image_url[0];?>">
					<div class="caption-product">
					 	<h1><?php the_title(); ?></h1>
					 	<!--div class="description"><?php the_excerpt();?></div-->
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
							<div class="col-xs-4">
								<span class="regular"> En Comercio <br><span><?php echo "$".get_field('precio_normal_aux'); ?></span></span>
							</div>
							<div class="col-xs-4">
								<span class="porcent">Ahorro <br><span><?php echo round($porcent,0)."%";?></span></span>
							</div>
							<div class="col-xs-4">
								<span class="sale">Cupons Up <br><span><?php echo "$".get_field('precio_rebajado_aux');?></span></span>
							</div>														
					 	</div>
						<div class="product-rating">
					       <?php //$string = WC_Product::get_rating_html( 5); echo $string;?>
					       <?php echo do_shortcode('[ratings id="'.get_the_ID().'"]');?>
					    </div> 
						<span class="expirate-date">
							<?php 
							date_default_timezone_set(get_option('timezone_string'));
							$date_format = __( 'Y-m-d H:i:s' );
							//I used "Y-m-d H-i-s" instead of "Y-m-d H:i:s"
							$expiration_date = get_post_meta( get_the_ID(), '_expiration_date', true);

							$dt_end = new DateTime(date_i18n( $date_format, strtotime( $expiration_date ) ), new DateTimeZone(get_option('timezone_string')));
							$remain = $dt_end->diff(new DateTime());
							?>
							<div class="col-xs-3">
								<span class="days"> Dias <br><span><?php echo $remain->d ?></span></span>
							</div>
							<div class="col-xs-3">
								<span class="hours">Horas <br><span><?php echo $remain->h;?></span></span>
							</div>							
						</span>					                	
					 	<a href="<?php echo get_the_permalink(get_the_ID()); ?>" class="show-offer">Ver Oferta</a>
					</div>
				</li>              
		    <?php endforeach; ?>
	    </ul>
	    <?php wp_reset_postdata(); ?>
	<?php endif; ?>	
	</div>
</section>
<section class="offers">
	<div class="container">
		<h1>OFERTAS DESTACADAS</h1>
		<?php
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => 8,
                'post__not_in' => array($featureProd),
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
					$cols = "col-xs-8";
				}else{
					$size ="smallimg-prod";
					$cols = "col-xs-4";
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
							<span aria-hidden="true" class="glyphicon glyphicon-time"></span>
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
							//echo $remain->d . ' dias';
							echo round($diff). ' dias, '.$remain->h .'horas, '.$remain->m .'min.';
							?>
						</span>
						<div class="float-caption">
							<!--h2><?php the_title();?></h2-->
						 	<div class="price">	
								<span class="amount regular"> Precio en Comercio: <span><?php echo "$".number_format(get_field('precio_normal_aux'),2,'.',','); ?></span></span>
								<span class="amount discount">Promocion: <span><?php echo "%".round($porcent,0);?></span></span>
								<span class="amount sales">Precio en Cupons Up: <span><?php echo "$".number_format(get_field('precio_rebajado_aux'),2,'.',',');?></span></span>
						 	</div>

							<a href="<?php echo get_the_permalink(get_the_ID()); ?>" class="show-offer">Ver Oferta</a>
						</div>						
					</div>
					<div class="caption"><?php the_title();//echo get_excerpt(60); ?></div>
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
	<h1>PRÓXIMAS OFERTAS</h1>
	<?php
            $args = array(
                'post_type' => 'proximas-ofertas',
                'post_status' => array ( 'publish' )
            );
            $the_query = new WP_Query($args);
	?>
		<?php if ($the_query->have_posts()) : ?>
			<div class="row">
			<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
				<div class="col-xs-4 item-offer">
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
			<h2>Recibir Ofertas</h2>
			<div class="widget_wysija_cont">
	            <form action="/send-suscribe.php" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
	            		<input type="text" value="" name="FNAME" class="" id="mce-FNAME" placeholder="Nombre">
	                     <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="nombre@email.com" data-validate="validate(required, email)">
	                     <input type="hidden" name="idmailchimp" value="<?php echo get_field('modal_mailchimp_id','option');?>">
	                    <input type="submit" value="REGISTRARME" name="subscribe" id="mc-embedded-subscribe" class="wysija-submit">
						<span class="thanks-txt"></span>	
	            </form>						
			</div>		
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
<?php
if(!$_SESSION["modal_active"]){

	$_SESSION["modal_active"] = "displaymodal";?>
	<script type="text/javascript">
	    $(document).ready(function() {

	    });
	    $(window).load(function() {
	        $(".main-modal").fancybox({
	        	padding:0,
	        	closeBtn:false,
			    closeBtn    : false,
			    closeClick  : false,
			    helpers     : {
			        overlay : {closeClick: false}
			    }
	        }).trigger('click');
		});
	</script>	
<?php }
?>

