<?php

if ( class_exists( 'BP_Group_Extension' ) ) :
	class Proksi_Etapit extends BP_Group_Extension {
		 
		function __construct() {
			$args = array(
				'slug' => 'eteneminen',
				'name' => 'Projektin etapit',
				'nav_item_position' => 60,
				'screens' => array(
					'admin' => array(
						'enabled' => false 
					),
					'edit' => array(
						'enabled' => false
					)
				),
			);
			parent::init( $args );
		}

		function display() {
			global $bp;
			global $current_user;
			global $post;
			$project_id = $bp->groups->current_group->id;
			$ilmoitus = "";
			
			//wp_enqueue_style( 'proksi_etapit', get_stylesheet_uri() );
			wp_enqueue_scripts();
			
			echo "<h2>Etapit</h2>";		
				/*if (!empty($message)){ 
					echo '<div class="message">' . $message . '</div>';
            	}*/
				if ( is_user_logged_in() && bp_group_is_admin() ) :	
					echo 
					'<div style="display:block; margin-bottom:20px;">
						<a href="#" id="avaa_postbox">+ Lisää uusi etappi</a>
						<div id="postbox"">
							<form id="new_post" name="new_post" method="post" action="">
								<p><label for="title">Otsikko</label><br />
								<input type="text" id="title" value="" tabindex="1" size="40" name="title" />
								</p>
								<!--<p><label for="description">Kuvaus</label><br />
								<textarea id="description" tabindex="3" name="description" cols="50" rows="6"></textarea>
								</p>--!>
								<p>
								<input type="hidden" name="user_id" value="' . $current_user->ID . '">
								<input type="hidden" name="project_id" value="' . $project_id . '">
								<p><input type="submit" value="Lisää" tabindex="6" id="submit" name="submit" /></p>
								
								<input type="hidden" name="uusi-etappi" value="post" />
								<?php wp_nonce_field( "new-post" ); ?>
							</form>
						</div>
					</div>';
				endif;
				
				$args = array(
                	'post_type' => 'Etappi',
					'posts_per_page' => -1,
                    'meta_key' => 'project_id',
                    'meta_value' => $project_id,
                    'meta_compare' => '==',
                );
				echo '<h4 class="etappi_hdr kesken">Keskeneräiset</h4><table class="etappi_tbl">';
				query_posts($args);
				$valmiit = array();
				if ( have_posts() ) : while ( have_posts() ) : the_post();
					$valmis = get_post_meta($post->ID, 'valmis', true);
					if (!$valmis) : 
						echo '<tr class="etappirivi"><td>'.get_the_title().'</td>';
						if ( is_user_logged_in() && bp_group_is_admin() ) :
							echo 
								'<td class="tehdyksi">
									<form action="" method="post" id="merkitse-tehdyksi-form-'.$post->ID.'" name="tehty">
										<input type="hidden" name="tehty_post_id" value="'.$post->ID.'">
										<input type="hidden" name="toiminto" value="tehty">
										<input type="submit" name="merkkaus" value="Merkitse tehdyksi">
									</form>
								</td>
								<td class="poista_etappi">
									<form action="" method="post" id="poista-etappi-'.$post->ID.'" name="tehty">
										<input type="hidden" name="poista_post_id" value="'.$post->ID.'">
										<input type="submit" name="poista" value="Poista">
									</form>
								</td>';
						endif;
						echo "</tr>"; 
					else :
						$html = '<tr class="etappirivi"><td>'.get_the_title().'</td>';
						if ( is_user_logged_in() && bp_group_is_admin() ) :			
							$html = $html . '<td class="palauta">	
										<form action="" method="post" id="merkitse-tehdyksi-form-'.$post->ID.'" name="kesken">
											<input type="hidden" name="tehty_post_id" value="'.$post->ID.'">
											<input type="hidden" name="toiminto" value="kesken">
											<input type="submit" name="merkkaus" value="Palauta keskeneräiseksi">
										</form>
									</td>
								<td class="poista_etappi">
									<form action="" method="post" id="poista-etappi-'.$post->ID.'" name="tehty">
										<input type="hidden" name="poista_post_id" value="'.$post->ID.'">
										<input type="submit" name="poista" value="Poista">
									</form>
								</td>';
						endif;
						$html = $html . '</tr>';
						array_push($valmiit,$html); 	 
						endif;		
				endwhile; endif;
				echo '</table><h4 class="etappi_hdr valmiit">Valmiit</h4><table class="etappi_tbl">';
				
				foreach($valmiit as $rivi) {
					echo $rivi;
				}
				echo '</table>';

		}
	 
		function settings_screen( $group_id ) {
			echo '<p>Projektin etapit voi määrittää luonnin jälkeen "Projektin etapit" -välilehdellä</p>';
		}
	 
		function settings_screen_save( $group_id ) {
			$setting = isset( $_POST['eteneminen_setting'] ) ? $_POST['eteneminen_setting'] : '';
			groups_update_groupmeta( $group_id, 'eteneminen_setting', $setting );
		}
		

 	}
	
	add_action( 'wp_enqueue_scripts', 'register_plugin_styles' );
	
	function register_plugin_styles() {
		wp_register_style( 'proksi_etapit', plugins_url( 'proksi_etapit/style.css' ) );
		wp_enqueue_style( 'proksi_etapit' );
		wp_enqueue_script(
			'script',
			'/wp-content/plugins/proksi_etapit/script.js',
			array( 'jquery' )
		);
	}
	
	bp_register_group_extension( 'proksi_etapit' );
	
	add_action('init', 'etappi_register');
	function etappi_register(){
			$labels = array(
				'name' => __( 'Etapit','si_theme'),
				'singular_name' => __( 'Etappi','si_theme' ),
				'add_new' => __('Add New','si_theme'),
				'add_new_item' => __('Add New Etappi','si_theme'),
				'edit_item' => __('Edit Etappi','si_theme'),
				'new_item' => __('New Etappi','si_theme'),
				'view_item' => __('View Etappi','si_theme'),
				'search_items' => __('Search Etappi','si_theme'),
				'not_found' =>  __('No etappi found','si_theme'),
				'not_found_in_trash' => __('No Etappi found in Trash','si_theme'), 
				'parent_item_colon' => ''
			  );
		  
			$args = array(
				'labels' => $labels,
				'public' => true,
				'exclude_from_search' => false,
				'publicly_queryable' => true,
				'show_ui' => false, 
				'query_var' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position' => false,
				'supports' => array('title','editor','thumbnail', 'custom_fields')
			  ); 
		  
		 	register_post_type('etappi',$args);
	}
	
	function etappi_count($project_id){
			$args = array(
                	'post_type' => 'Etappi',
					'posts_per_page' => -1,
                    'meta_key' => 'project_id',
                    'meta_value' => $project_id,
                    'meta_compare' => '==',
                );
			$prosentit = 0;
			$etapit = get_posts($args);
			$etapit_yhteensa = count($etapit);
			if($etapit_yhteensa > 0) :
				$valmiit = 0;
				foreach($etapit as $etappi) {
					if(get_post_meta($etappi->ID, 'valmis', true)) : $valmiit++; endif;
				}
				$prosentit = (int)(100 * $valmiit / $etapit_yhteensa);
			else : return -1;
			endif; 
			return $prosentit;
			
		}
	function etappi_prosentit_print() {
		global $bp;
		etappi_check_forms();
		$project_id = $bp->groups->current_group->id;
		$prosentit = etappi_count($project_id);
		$eteneminen_url =  home_url() ."/groups/". $bp->groups->current_group->slug . "/eteneminen";
		if ($prosentit > -1) : 
			echo "<div style='display:block'>Edistyminen</div>
				<a href='".$eteneminen_url."'>
					<div class='eteneminen-kehys'>
						<div class='eteneminen-prosentit' style='width:".$prosentit."%;'></div>
					</div>
				</a>";
		elseif ( is_user_logged_in() && bp_group_is_admin() ) :
			
			echo "<div class='generic-button group-button private'><a href='" . $eteneminen_url . "'>Määritä projektin etapit</a></div>";
		endif;
	}
	add_action('bp_group_header_meta', 'etappi_prosentit_print', 999);
	//add_action('bp_directory_groups_item', 'etappi_prosentit_print', 999);
	
	function etappi_prosentit_print_to_list() {
		$project_id = bp_get_group_id();
		$prosentit = etappi_count($project_id);
		if ($prosentit > -1) :
			echo "<div class='lista-eteneminen-kehys'>
					<div class='lista-eteneminen-prosentit' style='width:".($prosentit)."%;'></div>
				</div>";
		endif;
		
	}
	add_action('bp_directory_groups_item', 'etappi_prosentit_print_to_list', 9999);

	
	
	function etappi_check_forms() {
		// Check if the form was submitted
		if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['uusi-etappi'] )) {
			$message = '';
			// Do some minor form validation to make sure there is content
			if (isset ($_POST['title']) && !empty($_POST['title'])) { 
				$title =  $_POST['title']; 
			} else { 
				$message = 'Kirjoita etapin otsikko. ';
			}
			if (isset ($_POST['description']) && !empty($_POST['description'])) { 
				$description = $_POST['description']; 
			} else { 
				$description = "";
			}
			if (isset ($_POST['user_id'])) { 
				$user_id = $_POST['user_id']; 
			} else {
				$message =  $message . 'Kirjaudu sisään.';
			}
				if (isset ($_POST['project_id'])) { 
				$project_id = $_POST['project_id']; 
			} else {
				$message =  $message . 'Projektia ei löydy.';
			}
			if($message == ''){
				// Add the content of the form to $post as an array
				$post = array(
					'post_title'	=> $title,
					'post_content'	=> $description,
					'post_author'    => $user_id,
					'post_status'	=> 'publish',
					'post_type'		=> 'Etappi'
				);
				$post_id = 0;
				$post_id = (wp_insert_post($post)); // Pass  the value of $post to WordPress the insert function. 
				if ($post_id != 0 && !is_wp_error( $post_id )) {
					add_post_meta($post_id, 'valmis', 0, true )	;
					add_post_meta($post_id, 'project_id', $project_id, true )	;
					$message = 'Etappi "' . $title . '" lisätty<br>.';
				}
			}

		}
									
		if (isset($_POST['toiminto'])) :
			$ilmoitus = "moi";
			$etappi_valmis = get_post_meta($_POST['tehty_post_id'], 'valmis', true);
			if ($_POST['toiminto'] == 'kesken') :
				if ($etappi_valmis) :
					if (update_post_meta($_POST['tehty_post_id'], 'valmis', 0 )) :
						$ilmoitus = "Palautettu keskeneräiseksi.";
					else :
						$ilmoitus = "Palautus epäonnistui.";
					endif;
				else :
					$ilmoitus = "Etappi on keskeneräinen."; 
				endif;
			elseif ($_POST['toiminto'] == 'tehty') :
				if(!$etappi_valmis) :
					if(update_post_meta($_POST['tehty_post_id'], 'valmis', 1)) :
						$ilmoitus = "Etappi merkattu tehdyksi.";
					else :
						$ilmoitus = "Tapahtui virhe";
					endif;
				else : $ilmoitus = "Etappi on jo merkattu tehdyks";
				endif;
			else : $ilmoitus = "Tapahtui virhe";
			endif;
		endif;
				
		if (isset($_POST['poista']) && isset($_POST['poista_post_id'])) :
			if(wp_delete_post($_POST['poista_post_id'])) :
				$ilmoitus = "Etappi poistettu";
			else :
				$ilmoitus = "Poisto epäonnistui";
			endif;
		endif;	
	}
endif;
?>