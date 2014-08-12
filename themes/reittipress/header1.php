<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if lt IE 7 ]> <html class="ie6"> <![endif]-->
<!--[if IE 7 ]> <html class="ie7"> <![endif]-->
<!--[if IE 8 ]> <html class="ie8"> <![endif]-->
<!--[if IE 9 ]> <html class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html> <!--<![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	
	<script type="text/javascript">
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-30431161-1']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	</script>
    
    <head profile="http://gmpg.org/xfn/11">
		<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ) ?>; charset=<?php bloginfo( 'charset' ) ?>" />
		<meta name="Description" content="<?php printf(utf8_encode('Metropolian kulttuurialan Reititin-hankkeen uusi monisuuntainen oppimiskanava, jossa opiskelija, opettaja ja työelämä kohtaavat.'))?>"/>
		<meta name="viewport" content="initial-scale=1.0, width=device-width" />
		<title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>

		<?php do_action( 'bp_head' ) ?>

		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ) ?>" />

		<?php
			if ( is_singular() && bp_is_blog_page() && get_option( 'thread_comments' ) )
				wp_enqueue_script( 'comment-reply' );

			wp_head();
		?>

		
	</head>

	<body <?php body_class() ?> id="bp-default">
		<script type="text/javascript">
			jQuery(function(){
				jQuery('#nav').append('<li class="page_item own_groups_links" style="display:none;"><a href="#sidebar"><?php echo (utf8_encode("Omat ryhmät")); ?></a></li>');
			})
		</script>
		<?php do_action( 'bp_before_header' ) ?>
		<div style="display:none;">Metropolian kulttuurialan Reititin-hankkeen uusi monisuuntainen oppimiskanava, jossa opiskelija, opettaja ja työelämä kohtaavat.</div>
		<div id="header">
			<div class="header_container">
				<a id="proksi_logo" href="http://proksi.metropolia.fi/wordpress">
					<img src="http://proksi.metropolia.fi/images/proksi-logo-pieni2.png"/>
				</a>
				<a id="metropolia_logo" href="http://www.metropolia.fi">
					<img src="http://reititin.metropolia.fi/graffa/mp-logo-horizontal.png"/>
				</a>
				<h1 id="logo" role="banner"><a href="<?php echo home_url(); ?>" title="<?php _ex( 'Home', 'Home page banner link title', 'buddypress' ); ?>"><?php bp_site_name(); ?></a></h1>
				<div id="search-bar" role="search">
					<div class="padder">
	
							<form action="<?php echo bp_search_form_action() ?>" method="post" id="search-form">
								<label for="search-terms" class="accessibly-hidden"><?php _e( 'Search for:', 'buddypress' ); ?></label>
								<input type="text" id="search-terms" name="search-terms" value="<?php echo isset( $_REQUEST['s'] ) ? esc_attr( $_REQUEST['s'] ) : ''; ?>" />
	
								<?php echo bp_search_form_type_select() ?>
	
								<input type="submit" name="search-submit" id="search-submit" value="<?php _e( 'Search', 'buddypress' ) ?>" />
	
								<?php wp_nonce_field( 'bp_search_form' ) ?>
	
							</form><!-- #search-form -->
	
					<?php do_action( 'bp_search_login_bar' ) ?>
	
					</div><!-- .padder -->
				</div><!-- #search-bar -->
			</div><!--header_container -->

			<div id="navigation" role="navigation">
				<?php wp_nav_menu( array( 'container' => false, 'menu_id' => 'nav', 'theme_location' => 'primary', 'fallback_cb' => 'bp_dtheme_main_nav' ) ); ?>
			</div>

			<?php do_action( 'bp_header' ) ?>

		</div><!-- #header -->
		<?php do_action( 'bp_after_header' ) ?>
		<?php do_action( 'bp_before_container' ) ?>
			<!-- front-page-info: etusivun yläreunan info-osio -->
		<div id="front-page-info">
			<?php printf(utf8_encode('
				<h1>Yhteisöllistä opinnäytetyöskentelyä</h1>
				<div class="info-kategoria">
					<img src="http://reititin.metropolia.fi/graffa/wp-ukko.jpg"/>
					<h2>Opiskelijalle</h2>
					<p>Saa opinnäytetyöllesi näkyvyyttä vaivattomalla jakamisella ja luo uusia työelämäkontkteja. Osallistu opponoimalla muiden opsikelijoiden töitä.</p> 
				</div>
				<div class="info-kategoria">
					<img src="http://reititin.metropolia.fi/graffa/wp-ukko2.jpg"/>
					<h2>Opettajalle</h2>
					<p>Helppo työkalu opinnäytetyön ohjaamiselle.  Jaa alaa kehittävää tietoasi monisuuntaisessa tiedonjaon kanavassa työelämän kanssa.</p>
				</div>
				<div class="info-kategoria">
					<img src="http://reititin.metropolia.fi/graffa/wp-ukko3.jpg"/>
					<h2>Työelämän edustajalle</h2>
					<p>Löydä organisaatiotasi kehittäviä opinnäytetöitä ja osallistu ohjaamalla töitä alaa kehittävään suuntaan. Hyödynnä uudenlainen rekrytointikanava.</p>
				</div>
				<a class="own-groups-link" style="display:hidden" href="">Omat ryhmät</a>
			')) ?>
			<div class="clear"></div>
		</div>
		<div id="container">
