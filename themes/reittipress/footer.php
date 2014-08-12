			<div class="clear" style="display:block; celar:both;"></div>
		</div> <!-- #container -->

		<?php do_action( 'bp_after_container' ) ?>
		<?php do_action( 'bp_before_footer' ) ?>

		<div id="footer">
			<div id="footer-container">
                <div class="footer-left">
					<?php if ( is_active_sidebar( 'first-footer-widget-area' ) || is_active_sidebar( 'second-footer-widget-area' ) || is_active_sidebar( 'third-footer-widget-area' ) || is_active_sidebar( 'fourth-footer-widget-area' ) ) : ?>
                    <div id="footer-widgets">
                    	<?php get_sidebar( 'footer' ) ?>
                    </div>
                    <?php endif; ?>
                    <img src="<?php bloginfo("url"); ?>/images/rahoittajan-logot2.jpg"/>
                    <div id="site-generator" role="contentinfo">
                        <?php do_action( 'bp_dtheme_credits' ) ?>
                        <p>
                        	<a rel="license" href="http://creativecommons.org/licenses/by-nd/3.0/">
                            	<img alt="Creative Commons -lisenssi" style="width:88px; border-width:0" src="http://i.creativecommons.org/l/by-nd/3.0/88x31.png" />
                            </a>
                            <br />
                            <span xmlns:dct="http://purl.org/dc/terms/" href="http://purl.org/dc/dcmitype/InteractiveResource" property="dct:title" rel="dct:type"></span>
                            <?php# printf( __( 'Proudly powered by <a href="%1$s">WordPress</a> and <a href="%2$s">BuddyPress</a>.', 'buddypress' ), 'http://wordpress.org', 'http://buddypress.org' ) ?>
                    	</p>
                	</div>
            	</div> 
			</div>                   
			<?php do_action( 'bp_footer' ) ?>
		</div><!-- #footer -->

		<?php do_action( 'bp_after_footer' ) ?>

		<?php wp_footer(); ?>

	</body>

</html>