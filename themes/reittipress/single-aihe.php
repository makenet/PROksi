<?php get_header(); 

$ilmoitus = "";

if (isset($_POST['user_id']) && isset($_POST['post_id']) && isset($_POST['toiminto']) ) :
	$post_meta = get_post_meta($_POST['post_id'], 'aiheen_tekijan_id', true);
	if ($_POST['toiminto'] == 'valitse') :
		if ($post_meta == 0) :
			if (update_post_meta($_POST['post_id'], 'aiheen_tekijan_id', $_POST['user_id'] )) :
				$ilmoitus = "Aihe valittu.";
			else :
				$ilmoitus = "Aiheen valinta epäonnistui.";
			endif;
		elseif($post_meta != $current_user->ID) :
			$ilmoitus = "Aiheella on jo tekijä."; 
		endif;
	elseif ($_POST['toiminto'] == 'luovu') :
		if($post_meta == $_POST['user_id']) :
			$deleted = update_post_meta($_POST['post_id'], 'aiheen_tekijan_id', 0);
			if ($deleted) : 
				$ilmoitus = "Luovuit aiheesta.";
			else :
				$ilmoitus = "Tapahtui virhe";
			endif;
		endif;
	else : $ilmoitus = "Tapahtui virhe";
	endif;
endif;
?> 
	<div id="content" class="single-aihe">
		<div class="padder">

			<?php do_action( 'bp_before_blog_single_post' ) ?>

			<div class="page" id="blog-single" role="main">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<?php $organisaatio = get_post_meta($post->ID, 'organisaatio', true); ?>
                <?php $yhteyshlo = get_post_meta($post->ID, 'yhteyshlo', true); ?>
                <?php $email = get_post_meta($post->ID, 'ap-email', true); ?>
                <?php $puhelin = get_post_meta($post->ID, 'ap-puhelin', true); ?>
                <?php $kotisivu = get_post_meta($post->ID, 'kotisivu', true); ?>
                <?php $luonne = get_post_meta($post->ID, 'luonne', true); ?>           	
				<?php $palkkio = get_post_meta($post->ID, 'palkkio', true); ?>
                <?php $valmistuminen = get_post_meta($post->ID, 'valmistuminen', true); ?>
                <?php $ohjaus = get_post_meta($post->ID, 'ohjaus', true); ?>
                
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div class="post-content">
						<h2 class="posttitle"><?php the_title(); ?></h2>
						<?php if (!empty($valmistuminen)) : 
									echo "<h3 class='aihe-organisaatio'>". $organisaatio . "</h3>";
								endif; ?>
                        
						<p>
							Lisätty: <?php echo get_the_date(); ?> <?php edit_post_link( "Muokkaa aihetta", "", "", $post->ID ); ?>             <br /><?php $alat = rp_hae_alat( $post->ID ); if(!empty($alat)){ echo "Alat: " . $alat;}?><br />   
						</p>
						
						<div class="entry">
							<?php the_content( __( 'Read the rest of this entry &rarr;', 'buddypress' ) ); ?>
                            <div class="aiheen-tiedot">
								<div class="aiheen-lisatiedot">
									<p>
                            		   	<?php if (!empty($luonne)) : 
											echo "<strong>Projektin luonne: </strong>". $luonne . "<br />";
										endif; ?>
										<?php if (!empty($valmistuminen)) : 
											echo "<strong>Projektin toivottu valmistumisajankohta: </strong>". $valmistuminen . "<br />";
										endif; ?>
                            		    <?php if (!empty($palkkio)) : 
											echo "<strong>Maksetaanko opiskelijan tekemästä työstä palkkio?: </strong>". $palkkio . "<br />";
										endif; ?>
                            		    <?php if (!empty($ohjaus)) : 
											echo "<strong>Aiheen lisääjällä on mahdollisuus osallistua projektin ohjaamiseen: </strong>". $ohjaus . "<br />";
										endif; ?>
									</p>
								</div>
							</div>
						 </div>  
                           	<?php if (!empty($puhelin) || !empty($email)) : ?>
		                   		<div class="aiheen-yhteystiedot">
						   			<strong>Ota yhteyttä aiheen lisääjään</strong><br />
						   			<?php if (!empty($organisaatio)) : 
						   				echo $organisaatio . "<br />";
						   			endif;
						   			if (!empty($yhteyshlo)) : 
						   				echo "Yhteyshenkilö: ". $yhteyshlo . "<br />";
						   			endif;
						   			if (!empty($puhelin)) : 
						   			echo "Puhelinnumero: ". $puhelin . "<br />";
						   			endif;
						   			if (!empty($email)) : 
						   				echo "E-mail: ". $email . "<br />";
						   			endif; 
						   			if(!empty($kotisivu)) : 
						   					echo "Kotisivu: <a href='". $kotisivu . "'>" . $kotisivu . "</a>";
						   			endif; ?>
		                   		</div>
						   	<?php endif; ?>
                           	
						   	<div class="clear"></div>
						
                        <div class="varaus">
                        <?php if (!aihe_vapaa($post->ID)) : ?>
                        	Aiheen varannut: 
							<?php echo bp_core_get_userlink_rp(aiheen_tekijan_id($post->ID)); ?>
                            <?php if(aiheen_tekijan_id($post->ID) == $current_user->ID) : ?>
                            	<div class="varausinfo varattu">
									<p>Varaamasi aihe on siirretty pois vapaiden aiheiden listalta.
	 									Luo aiheesta projektityötila ohessa olevan linkin kautta
									</p>
									<p>Muista ottaa yhteyttä aiheen lisääjään, 	
										jonka yhteystiedot ovat yllä. Ota myös yhteyttä opinnoistasi vastaavaan henkilöön 
										oppilaitoksessasi ja sovi kuinka projekti voidaan sisällyttää opintoihisi.
										Jos teet aiheesta opinnäytetyön, ota yhteyttä opinnäytetyön ohjaajaasi.
                            		</p>
								</div>
								<br />Tämä aihe on varattu sinulle. <a href="<?php bloginfo('url'); ?>/groups/create/">
									Perusta projekti aiheestasi täältä.</a>
                                <div class="aiheenvaraus">
									<form action="" method="post" id="luovu-aiheesta-form" class="standard-form"
									 enctype="multipart/form-data">
                            			<input type="hidden" name="user_id" value="<?php echo $current_user->ID; ?>">
                            			<input type="hidden" name="post_id" value="<?php the_ID(); ?>">
                                		<input type="hidden" name="toiminto" value="luovu">
                         				<input type="submit" value="Luovu aiheesta">
                        			</form>
								</div>
							<?php endif; ?>
						<?php endif; ?>
                        
                        
						<?php if(is_user_logged_in()) : if(aihe_vapaa($post->ID)) : ?>
                        	<div class="varausinfo">
								<p>Varaamalla aiheen itsellesi siirrät sen pois vapaiden aiheiden listalta.</p>
							</div>
                            
							<div class="aiheenvaraus">
								<form action="" method="post" id="valitse-aihe-form" class="standard-form" enctype="multipart/form-data">
                            	    <input type="hidden" name="user_id" value="<?php echo $current_user->ID; ?>">
                            	    <input type="hidden" name="post_id" value="<?php the_ID(); ?>">
                            	    <input type="hidden" name="toiminto" value="valitse">
                            	    <input type="submit" value="Varaa aihe" class="varausnappi">
                            	</form>
                        	</div>
                        
						<?php endif; elseif (aihe_vapaa($post->ID)) : ?>
                        	<div class="varausinfo">
								<p>Varaamalla aiheen itsellesi siirrät sen pois vapaiden aiheiden listalta. </p>
							</div>
                        	<div class="aiheenvaraus">
								<div style="margin:30px 20px 0 0;float:right;">
									<strong>Kirjaudu sisään varataksesi aiheen.</strong>
								</div>
								</div>
                            <?php endif; ?>
                            </div>
                         	<?php echo "<div id='message' class='updated'>" . $ilmoitus . "</div>"; ?>
                            
							<?php wp_link_pages( array( 'before' => '<div class="page-link"><p>' . __( 'Pages: ', 'buddypress' ), 'after' => '</p></div>', 'next_or_number' => 'number' ) ); ?>
						
					</div>
                    

				</div>

			

			<?php endwhile; else: ?>

				<p><?php _e( 'Sorry, no posts matched your criteria.', 'buddypress' ) ?></p>

			<?php endif; ?>

		</div>
		<?php echo kirjauduInfo(); ?>
		<?php comments_template(); ?>
		<?php do_action( 'bp_after_blog_single_post' ) ?>

		</div><!-- .padder -->
	</div><!-- #content -->

	<?php get_sidebar() ?>

<?php get_footer() ?>