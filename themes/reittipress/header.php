<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if lt IE 7 ]> <html class="ie ie6"> <![endif]-->
<!--[if IE 7 ]> <html class="ie ie7"> <![endif]-->
<!--[if IE 8 ]> <html class="ie ie8"> <![endif]-->
<!--[if IE 9 ]> <html class="ie ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html> <!--<![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	

    
    <head profile="http://gmpg.org/xfn/11">
		<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ) ?>; charset=<?php bloginfo( 'charset' ) ?>" />
		<meta name="Description" content="<?php printf(utf8_encode('Metropolian kulttuurialan Reititin-hankkeen uusi monisuuntainen oppimiskanava, jossa opiskelija, opettaja ja ty�el�m� kohtaavat.'))?>"/>
		<meta name="viewport" content="initial-scale=1.0, width=device-width" />
		<title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>

		<?php do_action( 'bp_head' ) ?>

		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ) ?>" />
		<link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
        <link href='//fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
        <link href='//fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>
		<?php
			if ( is_singular() && bp_is_blog_page() && get_option( 'thread_comments' ) )
				wp_enqueue_script( 'comment-reply' );

			wp_head();
		?>

		<script type="text/javascript" src="<?php bloginfo("url"); ?>/wp-content/themes/reittipress/scripts/scripts.js"></script>
	</head>

	<body <?php body_class() ?> id="bp-default">
		<script type="text/javascript">
			jQuery(function(){
				jQuery("#bp-adminbar-notifications-menu:first-child").attr("href", "#")
				jQuery("#bp-adminbar-notifications-menu > a:first-child").attr("href", "");
			})
		</script>
		<?php do_action( 'bp_before_header' ) ?>
		<div style="display:none;"><?php printf(utf8_encode('Metropolia Ammattikorkeakoulun uusi projektiymp�rist�, jossa opiskelija, opettaja ja ty�el�m� kohtaavat.'));?></div>
		<div id="header">
			<div class="header_container">
				<a id="proksi_logo" href="<?php bloginfo('url'); ?>">
					<img src="<?php bloginfo('url'); ?>/images/proksi-valkoinen.jpg" />
				</a>
				<a id="metropolia_logo" href="http://www.metropolia.fi">
					<img src="<?php bloginfo("url"); ?>/images/mp-logo-horizontal.png"/>
				</a>
                <div id="mobilevalikko">
                	<img src="<?php bloginfo("url"); ?>/images/mobiilivalikko.gif"></img>
                </div>
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
        <?php if(is_front_page()) : ?>
			<div id="proksi-front-page-container">
		<?php else : ?>
    		<div id="container">
		<?php endif; ?>