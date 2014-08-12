<?php /* Template Name: Aiheet */ 
get_header(); ?>
	<div id="content">
		<div class="padder">

		<?php do_action( 'bp_before_blog_page' ); ?>

		<div class="page aihepankki" id="blog-page" role="main">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<h2 class="pagetitle" style="width:90%; margin-top: 20px; margin-left:auto; margin-right:auto;">
					<?php the_title(); ?>
                </h2>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div style="width:90%; margin:10px auto;" class="entry">

						<?php the_content( __( '<p class="serif">Read the rest of this page &rarr;</p>', 'buddypress' ) ); ?>
						
					</div>

				</div>

			<?php endwhile; endif;
			
			$descriptionErr = $kotisivuErr = $organisaatioErr = $yhteystietoErr = $titleErr = $user_idErr = "";
			$organisaatio = $email = $puhelin = $title = $description = $user_id = $yhteyshlo = $kotisivu = $luonne = $valmistuminen = $palkkio = $ohjaus = $alat = "";
			
			// Check if the form was submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
				
                // Do some minor form validation to make sure there is content
                if (!empty($_POST['organisaatio'])) { 
                    $organisaatio = aihe_input($_POST['organisaatio']); 
                } else {
					$organisaatioErr = 'Lisää organisaatiosi nimi. ';
				}
				if (empty($_POST['ap-email']) && empty($_POST['ap-puhelin'])){
					$yhteystietoErr = 'Lisää yhteystiedoksi sähköposti tai puhelinnumero. ';
				}
				if (!empty($_POST['ap-email'])){
					$email = aihe_input($_POST['ap-email']);
				}
				if (!empty($_POST['ap-puhelin'])){
					$puhelin = aihe_input($_POST['ap-puhelin']);
				}
				if (!empty($_POST['yhteyshlo'])){
					$yhteyshlo = aihe_input($_POST['yhteyshlo']); 
				} 					
				if (!empty($_POST['kotisivu'])){
					$kotisivu = aihe_input($_POST['kotisivu']);
					if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$kotisivu)) {
      					$kotisivuErr = "Virheellinen osoie."; 
    				}
				}
				if (!empty ($_POST['title']) && !empty($_POST['title'])) { 
                    $title =  aihe_input($_POST['title']); 
                } else { 
                    $titleErr = 'Kirjoita aiheen otsikko. ';
                }
                if (!empty ($_POST['description']) && !empty($_POST['description'])) { 
                    $description = aihe_input($_POST['description']); 
                } else { 
                    $descriptionErr = 'Kirjoita aiheen luonnehdinta. ';
                }
				if (!empty ($_POST['user_id'])) { 
                    $user_id = aihe_input($_POST['user_id']); 
                } else {
					$user_idErr = 'Kirjaudu sisään. ';
				}
				if (!empty($_POST['luonne'])){
					$luonne = aihe_input($_POST['luonne']);
				}
				if (!empty($_POST['valmistuminen'])){
					$valmistuminen = aihe_input($_POST['valmistuminen']);
				}
				if (!empty($_POST['palkkio'])){
					$palkkio = aihe_input($_POST['palkkio']);
				}
				if (!empty($_POST['ohjaus'])){
					$ohjaus = aihe_input($_POST['ohjaus']);
				}
				if (!empty($_POST['alat'])){
					$alat = $_POST['alat'];
				}
				
            	if(no_errors()){
					// Add the content of the form to $post as an array
					$post = array(
						'post_title'	=> $title,
						'post_content'	=> $description,
						'post_author'	=> $user_id,
						'post_status'	=> 'publish',
						'post_type'		=> 'aihe'
					);
					$post_id = 0;
					$post_id = (wp_insert_post($post)); // Pass  the value of $post to WordPress the insert function. 
					if ($post_id != 0 && !is_wp_error( $post_id )) {
						add_post_meta($post_id, 'aiheen_tekijan_id', 0, true );
						add_post_meta($post_id, 'organisaatio', $organisaatio, true );
						add_post_meta($post_id, 'ap-email', $email, true );
						add_post_meta($post_id, 'ap-puhelin', $puhelin, true );
						add_post_meta($post_id, 'yhteyshlo', $yhteyshlo, true );
						add_post_meta($post_id, 'kotisivu', $kotisivu, true );
						add_post_meta($post_id, 'luonne', $luonne, true );
						add_post_meta($post_id, 'valmistuminen', $valmistuminen, true );
						add_post_meta($post_id, 'palkkio', $palkkio, true );
						add_post_meta($post_id, 'ohjaus', $ohjaus, true );
						wp_set_post_terms( $post_id, $alat, 'Alat' );
						$message = "Aihe lisätty, kiitos!"; 
					} else {
						$message = "Aiheen lisääminen epäonnistui, yritä uudelleen.";
					}
				}

                
            }
            
			function aihe_input($data) {
			  //$data = trim($data);
			  //$data = stripslashes($data);
			  $data = htmlspecialchars($data);
			  return $data;
			}
			
			function no_errors(){
				global $descriptionErr, $kotisivuErr, $organisaatioErr, $yhteystietoErr, $titleErr, $user_idErr;
				if($descriptionErr == '' && $kotisivuErr == '' && $organisaatioErr == '' && $yhteystietoErr == '' && $titleErr == '' && $user_idErr == '') {
					return true;
				} else {
					return false;
				}
			}
			?>
            
            
            <p style="width:90%; margin:10px auto; font-family: 'Droid Serif', serif; font-size:16px; line-height:25px;">
                <b>Työnantajat</b> voivat ehdottaa aihetta opiskelijaprojektille ja osallistua sen ohjaamiseen PROksissa.
            </p>
            <p style="width:90%; margin:10px auto; font-family:'Droid Serif', serif; font-size:16px; line-height:25px;">
            	<b>Opiskelija</b> voi tarttua aiheeseen ja sopia koulun kanssa, kuinka sisällyttää sen opintoihinsa.
            </p>
            <a style="clear:both; width:33%; margin:10px auto 20px; text-align:center;" href="#" id="avaa_postbox">+ Lisää uusi aihe</a>
            
                        <!-- New Post Form -->
            <?php if (!empty($message)){ ?>
				<p style="width:90%; text-align:center; margin:0 auto;"><?php echo $message; ?></p>
            <?php } ?>
            
            <?php if(is_user_logged_in()) : 
                $args = array('taxonomy' => 'Alat', 'hide_empty' => 0); ?>
                
                <div id="postbox" class="aihepost">
                    <form id="new_post" name="new_post" method="post" action="<?php echo htmlspecialchars("");?>">
                    	<div class="ap-lomake-osio">
                            <h4>Tilaajan tiedot</h4>
                            <div class="rivi">
                                <div><label for="title">Organisaation nimi *</label>
                                <small>Projektiaiheen tilaavan organisaation tai henkilön nimi</small>
                                <div class="errorviesti"><?php echo $organisaatioErr; ?></div>
                                <input type="text" id="organisaatio" value="<?php echo $organisaatio; ?>" tabindex="1" size="20" name="organisaatio" />
                                </div>
                            </div>
							<div class="errorviesti"><?php echo $yhteystietoErr; ?></div>
                            <div class="rivi puoli">
                                <div><label for="title">Sähköposti *</label>
                                <small>Yhteyshenkilön sähköpostiosoite. Ei pakollinen, jos puhelinnumero määritelty.</small>
                                <input type="text" id="email" value="<?php echo $email; ?>" tabindex="1" size="20" name="ap-email" />
                                </div>
                                 <div><label for="title">Puhelinnumero *</label>
                                <small>Yhteyshenkilön puhelinnumero. Ei pakollinen, jos sähköposti määritelty.</small>
                                <input type="text" id="puhelin" value="<?php echo $puhelin; ?>" tabindex="1" size="20" name="ap-puhelin" />
                                </div>
								<div class="clear"></div>
                            </div>
                            <div class="rivi puoli">
                                <div><label for="title">Yhteyshenkilö</label>
                                <small>Henkilö, johon aiheeseen tarttuva opiskelija tai opettaja ottaa yhteyttä</small>
                                <input type="text" id="yhteyshlo" value="<?php echo $yhteyshlo; ?>" tabindex="1" size="20" name="yhteyshlo" />
                                </div>
                                <div><label for="title">Kotisivu</label>
                                <small>Projektiaiheen lisäävän organisaation tai henkilön kotisivu.</small>
                                 <div class="errorviesti"><?php echo $kotisivuErr; ?></div>
                                <input type="text" id="kotisivu" value="<?php echo $kotisivu; ?>" tabindex="1" size="20" name="kotisivu" />
                                </div>
                            </div>
							<div class="clear"></div>
                        </div>
                        <div class="ap-lomake-osio">
                            <h4>Tilattavan projektiaiheen tiedot</h4>
                            <div class="rivi">
                                <div><label for="title">Aiheen otsikko *</label>
                                <small>Projektiaiheen otsikko, joka näkyy Aihepankin luettelossa.</small>
                                <div class="errorviesti"><?php echo $titleErr; ?></div>
                                <input type="text" id="title" value="<?php echo $title; ?>" tabindex="1" size="20" name="title" />
                                </div>
                            </div>
                            <div class="rivi">
                                <div><label for="title">Projektin luonne</label>
                                <small>Valitse tilattavan projektin luonne listalta, tai kirjoita oma.</small>
                                
                                <input type="radio" name="luonne" <?php if(isset($luonne) && $luonne == "Palvelukehitys") echo "checked"; ?> value="Palvelukehitys">Palvelukehitys<br>
                                <input type="radio" name="luonne" <?php if(isset($luonne) && $luonne == "Organisaation kehittäminen") echo "checked"; ?> value="Organisaation kehittäminen">Organisaation kehittäminen<br>
                                <input type="radio" name="luonne" <?php if(isset($luonne) && $luonne == "Tuotekehitys") echo "checked"; ?> value="Tuotekehitys">Tuotekehitys<br>
                                <input type="radio" name="luonne" <?php if(isset($luonne) && $luonne != "") echo "checked"; ?> value="Muu">Muu<input <?php if(isset($luonne) && $luonne != "") echo "value='" . $luonne . "' "; ?>type="text" name="specified" size="10" />
                                </div>
                            </div>
                            <div class="rivi">
                                <p><label for="description">Aiheen kuvaus *</label>
                                <small>Tarkempi kuvaus tilattavasta projektiaiheesta.</small>
                                 <div class="errorviesti"><?php echo $descriptionErr; ?></div>
                                <textarea id="description" tabindex="3" name="description" cols="50" rows="6"><?php echo $description; ?></textarea>
                                </p>
                            </div>
                        </div>
                        <h4>Lisätiedot</h4>
                        <div class="rivi">
                            <div><label for="title">Projektin toivottu valmistumisajankohta</label>
                            <small>Voit määritellä aiheesta syntyvän projektin toivotun valmistumisajankohdan. 
                            (Opiskelijoiden aikataulut voivat riippua projektiopintojen tai opinnäytetyön sijoittumisesta lukujärjestykseen.)</small>
                            <input type="text" id="valmistuminen" value="<?php echo $title; ?>" tabindex="1" size="20" name="valmistuminen" />
                            </div>
                        </div>
                        <div class="rivi puoli">
                        	<div><label for="title">Maksetaanko opiskelijan tekemästä työstä palkkio?</label>
                            <input type="radio" name="palkkio" <?php if(isset($palkkio) && $palkkio == "Kyllä") echo "checked"; ?> value="Kyllä">Kyllä<br>
                            <input type="radio" name="palkkio" <?php if(isset($palkkio) && $palkkio == "Ei") echo "checked"; ?> value="Ei">Ei<br>
                            <input type="radio" name="palkkio" <?php if(isset($palkkio) && $palkkio == "Sovitaan erikseen") echo "checked"; ?> value="Sovitaan erikseen">Sovitaan erikseen
                            </div>
                            <div><label for="title">Meillä on mahdollisuus osallistua projektin ohjaamiseen</label>
                            <small>Onko sinulla tai muulla organisaatiosi jäsenellä mahdollisuus osallistua työn ohjaamiseen kommentoimalla työtä sen työstövaiheessa PROksissa?</small>
                            <input type="radio" name="ohjaus" value="Kyllä">Kyllä<br>
                            <input type="radio" name="ohjaus" value="Ei">Ei
                            </div>
                        </div>
                        <div class="rivi">
                            <label for="alat[]">Ala</label>
                            <small>Kohdenna projektiaihe opiskelijoille alan mukaan</small>
                            <?php echo rp_alat_checklist(); ?></p>
                            <input type="hidden" name="user_id" value="<?php echo $current_user->ID; ?>">
                            <p align="left"><input type="submit" value="Lisää" tabindex="6" id="submit" name="submit" /></p>
                        </div>
                 
                        <input type="hidden" name="action" value="post" />
                        <?php wp_nonce_field( 'new-post' ); ?>
                    </form>
                </div>
                
				<script type="text/javascript">
					function assignOtherValue() {
						for( i = 0; i < document.new_post.chargetotal.length; i++ ) {
							if( document.new_post.chargetotal[i].checked == true ) {
								var val = document.new_post.chargetotal[i].value;
								if(val=='Muu') {
									document.new_post.chargetotal[i].value=document.new_post.specified.value;
								}
							}
						}
						return true;
					}
				</script>
                <?php if(!(no_errors())) { ?>
                	<script type="text/javascript">
						jQuery(function(){
							jQuery('#postbox').addClass("aihepostErrors");
						});
					</script>
                <?php } ?> 
					
                
            <?php else : ?>
					<div id="postbox"><a href="<?php echo wp_login_url(); ?>">Kirjaudu sisään</a> lisätäksesi uuden aiheen. Jos sinulla ei ole vielä tunnuksia, 
                    <a href="<?php site_url( '/register/ ' ); ?>">luo käyttäjätili</a> tai käytä palvelua Facebook-tunnuksillasi oikelta.</div>
			<?php endif; ?>
            <!--// New Post Form -->
			
            <!-- Aiheet -->
		   	<div class="item-list-tabs aihe-valikko">
				<ul>
					<?php
						
                        $alafilter = '';
                        if(isset($_GET['ala'])){
                            $term = get_term_by('id', $_GET['ala'], 'Alat');
                            if($term) : $alafilter = $term->slug;
							else :  $alafilter = 0;
							endif;
                        }
                        if (isset ($_GET['filter']) && $_GET['filter'] == 'varatut'){
                            echo '<li><a href="?filter=vapaat">Vapaat aiheet</a></li><li class="selected"><a href="'. home_url() . '/aihepankki/page/1/?filter=varatut">Varatut aiheet</a></li>';
                            $args = array(
                                'post_type' => 'aihe',
								'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1 ),
								'posts_per_page' => 15,
                                'meta_key' => 'aiheen_tekijan_id',
                                'meta_value' => 0,
                                'meta_compare' => '!=',
                                'taxonomy' => 'Alat',
                                'term' => $alafilter
                            ); 
                        } else {
                            echo '<li class="selected"><a href="?filter=vapaat">Vapaat aiheet</a></li><li><a href="'. home_url() . '/aihepankki/page/1/?filter=varatut">Varatut aiheet</a></li>';
                            $args = array(
                                'post_type' => 'aihe',
								'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1 ),
                                'posts_per_page' => 15,
								'meta_key' => 'aiheen_tekijan_id',
                                'meta_value' => 0,
                                'meta_compare' => '==',
                                'taxonomy' => 'Alat',
                                'term' => $alafilter
                            ); 
                        }
                    ?>
                </ul>
            </div>
			<div class="alavalikko-wrap">
				<form id="alavalikko" name="alavalikko" method="get" action="">
                	<label for="activity-filter-by">Ala</label>
			   		<?php 
						$ala_id = 0;
						if(isset($_GET['ala'])) {
							$ala_id = $_GET['ala'];
						}
			   			$ala_args = array(
							'taxonomy' => 'Alat',
							'hide_empty' => 0, 
							'name' => 'ala', 
							'order_by' => 'name', 
							'echo' => 0, 
							'class' => 'postform last',
							'show_option_all' => 'Kaikki',
							'selected' => $ala_id
						);
			   			$valikko = wp_dropdown_categories( $ala_args );
			   			$valikko = preg_replace("#<select([^>]*)>#", "<select$1 onchange='return this.form.submit()'>", $valikko);
			   			echo $valikko;
			   		?>
					<?php if( isset($_GET['filter'])) : ?>
						<input type="hidden" name="filter" value="<?php echo $_GET['filter']; ?>">
					<?php endif; ?>
				</form>
			</div>
				
            <table>
				<?php query_posts($args); ?>
				<div class="navigation">
				  <div class="alignleft"><?php previous_posts_link('&laquo; Edelliset') ?></div>
				  <div class="alignright"><?php next_posts_link('Lisää &raquo;') ?></div>
				</div>
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                	<?php $organisaatio = get_post_meta($post->ID, 'organisaatio', true); ?>
                        <div class="etusivu-aiherivi" id="aihe<?php echo $post->ID ?>">
                            <div class="aihe-icon">
                                <img src="<?php bloginfo("url"); ?>/images/uusi-aihe.png" />
                            </div>
                            <div class="etusivu-aihe">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <?php if (!empty($organisaatio)) : 
                                        echo '<span class="etusivu-ap-organisaatio">' . $organisaatio . '</span>';
                                    else : echo bp_core_get_username_rp($post->post_author);  
                                    endif; ?> 
                                    <span class="etusivu-ap-otsikko"><?php the_title(); ?></span>
                                    <span class="etusivu-ap-alat"><?php echo rp_hae_alat($post->ID); ?></span>
                                </a>
                            </div>
                        </div>
				<?php endwhile; endif; ?>
			</table>		
				<div class="navigation">
				  <div class="alignleft"><?php previous_posts_link('&laquo; Edelliset') ?></div>
				  <div class="alignright"><?php next_posts_link('Lisää &raquo;') ?></div>
				</div>
				<?php wp_reset_query(); ?>
		
            

		</div><!-- .page -->

		<?php do_action( 'bp_after_blog_page' ); ?>

		</div><!-- .padder -->
	</div><!-- #content -->

	<?php get_sidebar(); ?>

<?php get_footer(); ?>