      <footer class="footer">
        <div class="container">
            <nav>
                <?php wp_nav_menu(array('theme_location' => 'footer', 'menu_class' => 'navbar-nav', 'container' => false, 'items_wrap' => '<ul class="footer-nav">%3$s</ul>'));?>
            </nav>
            <div>
                <div class="copy"><span class="footer-logo"></span> © 2015 - Todos los derechos reservados</div>
                <div class="social-wrap"><?php wp_nav_menu(array('theme_location' => 'social_nav', 'menu_class' => 'navbar-nav', 'container' => false, 'items_wrap' => '<ul class="social-nav">%3$s</ul>'));?></div>
            </div>
        </div>
      </footer>
    </div>
    	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.1.min.js"><\/script>')</script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/vendor/bootstrap.min.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.bxslider/jquery.bxslider.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/plugins.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/map.js"></script>

		<?php wp_footer(); ?>
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X');ga('send','pageview');
        </script>
    </body>
</html>