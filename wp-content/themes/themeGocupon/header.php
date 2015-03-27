

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php wp_title( '|', true, 'right' ); ?></title>
        <meta name="description" content="<?php bloginfo( 'description' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.css?v=<?php echo date('his');?>">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/jquery.bxslider/jquery.bxslider.css?v=<?php echo date('his');?>">
        
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/fancyapps/jquery.fancybox.css?v=<?php echo date('his');?>">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/main.css?v=<?php echo date('his');?>">
        <script src="<?php echo get_template_directory_uri(); ?>/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
      <header class="header">
        <div class="container">
          <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>"></a>
          </div>
          <span class="bg-icon icon-search"><span aria-hidden="true" class="glyphicon glyphicon-search"></span></span>
          <a href="/cart/" class="bg-icon icon-carts"><span aria-hidden="true" class="glyphicon glyphicon-shopping-cart"></span></a>
        </div>
      </header>
      <nav class="wrap-navbar" role="navigation">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
          <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
          </div><!--/.navbar-collapse -->
        </div>
      </nav>  
      <div class="wrap-search-box">
        <div class="container">
          <?php if ( is_active_sidebar( 'search_bar' ) ) : ?>
              <?php dynamic_sidebar( 'search_bar' ); ?>
                <?php
                $args1=array(
                    //'include'=> array(12,30)
                    );
                $terms = get_terms('comercio',$args1 );?>
                <div class="btn-group" role="group" aria-label="">
                    <button aria-expanded="false" data-toggle="dropdown" class="btn btn-custom dropdown-toggle" type="button" id="btnGroupDrop2">Comercio&nbsp;&nbsp;<span class="caret"></span></button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="btnGroupDrop2">
                      <?php foreach ($terms as $term) {
                          $term_link = get_term_link( $term, 'comercio' );
                          if( is_wp_error( $term_link ) )
                              continue;
                          ?>
                          <li><a href="<?php echo $term_link?>"><?php echo $term->name?></a></li>
                      <?php } ?>
                    </ul>
                </div>                
                <?php
                $args1=array(
                    //'include'=> array(12,30)
                    );
                $terms = get_terms('product_cat',$args1 );?>
                <div class="btn-group" role="group" aria-label="">
                    <button aria-expanded="false" data-toggle="dropdown" class="btn btn-custom dropdown-toggle" type="button" id="btnGroupDrop1">Categoría&nbsp;&nbsp;<span class="caret"></span></button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="btnGroupDrop1">
                      <?php foreach ($terms as $term) {
                          $term_link = get_term_link( $term, 'product_cat' );
                          if( is_wp_error($term_link ))
                              continue;
                          ?>
                          <li><a href="<?php echo $term_link?>"><?php echo $term->name?></a></li>
                      <?php } ?>
                    </ul>
                </div>
              
          <?php endif; ?>  


      

            
        </div>
      </div>      
