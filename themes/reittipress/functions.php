<?php add_theme_support( 'post-thumbnails' ); 

add_action('init', 'aihe_register');
 
function aihe_register()
{
	$labels = array(
		'name' => __( 'Aiheet','si_theme'),
		'singular_name' => __( 'Aihe','si_theme' ),
		'add_new' => __('Add New','si_theme'),
		'add_new_item' => __('Add New Aihe','si_theme'),
		'edit_item' => __('Edit Aihe','si_theme'),
		'new_item' => __('New Aihe','si_theme'),
		'view_item' => __('View Aihe','si_theme'),
		'search_items' => __('Search Aihe','si_theme'),
		'not_found' =>  __('No aihe found','si_theme'),
		'not_found_in_trash' => __('No Aihe found in Trash','si_theme'), 
		'parent_item_colon' => ''
	  );
	  
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => false,
		'supports' => array('title','editor','thumbnail', 'custom_fields')
	  ); 
	  
	 register_post_type('aihe',$args);
	 register_taxonomy("Alat", array("aihe"), array("hierarchical" => true, "label" => "Alat", "singular_label" => "Ala", "rewrite" => true));
}

function aihe_vapaa($post_id){
	if  ( aiheen_tekijan_id($post_id) == 0) :
		return true;
	else : return false;
	endif;
}
function aiheen_tekijan_id($post_id) {
	return get_post_meta($post_id, 'aiheen_tekijan_id', true);
}


add_action( 'admin_init', 'my_remove_menu_pages' );
function my_remove_menu_pages() {
 
    global $user_ID;
 
    if ( current_user_can( 'author' ) ) {
	    remove_menu_page('upload.php'); // Media
    	remove_menu_page('edit-comments.php'); // Comments
		remove_menu_page('tools.php'); // Comments
		remove_menu_page('edit.php'); // Comments
		

    }
	
	
}
 
function bp_group_list_admin_names( $group = false ) {
	global $groups_template;

	if ( !$group )
		$group =& $groups_template->group;

	if ( $group->admins ) { 
    		 $admin_names = array(); 
			 foreach( (array)$group->admins as $admin ) { 
                     $data=get_userdata($admin->user_id); 
                     if ($data->first_name != '')
							array_push($admin_names, $data->first_name . " " . $data->last_name); 
						  else 
						  	array_push($admin_names, $admin->user_nicename);
					
			 } 
             echo implode(', ', $admin_names); 
	 } else { 
	 } 
}
function proksi_is_user_group_admin($user_id, $group_id) {
	$group = groups_get_group( array( 'group_id' => $group_id ) );
	if ( $group->admins ) : 
    	foreach( (array)$group->admins as $admin ) { 
			if ($user_id == $admin->user_id) :
				return true;
			endif;
		} 
	endif;
	return false;	   
}

function bp_linked_group_list_admin_names( $group = false ) {
	global $groups_template;

	if ( !$group )
		$group =& $groups_template->group;

	if ( $group->admins ) { 
    		 $admin_names = array(); 
			 foreach( (array)$group->admins as $admin ) { 
                     $data=get_userdata($admin->user_id); 
					 array_push($admin_names, '<a href="/members/' . $data->user_nicename . '">'  . $data->first_name . " " . $data->last_name . '</a>'); 
			 } 
             echo implode(', ', $admin_names); 
	 } else { 
	 } 

}

function bp_member_name_rp() {
	echo apply_filters( 'bp_member_name_rp', bp_get_member_name_rp() );
}
	/**
	 * Used inside a bp_has_members() loop, this function returns a user's full name
	 *
	 * Full name is, by default, pulled from xprofile's Full Name field. When this field is
	 * empty, we try to get an alternative name from the WP users table, in the following order
	 * of preference: display_name, user_nicename, user_login.
	 *
	 * @package BuddyPress
	 *
	 * @uses apply_filters() Filter bp_get_the_member_name() to alter the function's output
	 * @return str The user's fullname for display
	 */
	function bp_get_member_name_rp() {
		global $members_template;
		$data=get_userdata($members_template->member->id);
		// Generally, this only fires when xprofile is disabled
		if ( empty( $data->first_name ) ) {
			// Our order of preference for alternative fullnames
			$name_stack = array(
				'full_name',
				'display_name',
				'user_nicename',
				'user_login'
			);

			foreach ( $name_stack as $source ) {
				if ( !empty( $members_template->member->{$source} ) ) {
					// When a value is found, set it as fullname and be done
					// with it
					$members_template->member->fullname = $members_template->member->{$source};
					break;
				}
			}
		} else { 
			
			$members_template->member->fullname = $data->first_name . " " . $data->last_name;
		}

		return apply_filters( 'bp_get_member_name_rp', $members_template->member->fullname );
	}
	add_filter( 'bp_get_member_name_rp', 'wp_filter_kses' );
	add_filter( 'bp_get_member_name_rp', 'stripslashes' );
	add_filter( 'bp_get_member_name_rp', 'strip_tags' );

/**
 * Returns a HTML formatted link for a user with the user's full name as the link text.
 * eg: <a href="http://andy.domain.com/">Andy Peatling</a>
 * Optional parameters will return just the name or just the URL.
 *
 * @param int $user_id User ID to check.
 * @param $no_anchor bool Disable URL and HTML and just return full name. Default false.
 * @param $just_link bool Disable full name and HTML and just return the URL text. Default false.
 * @return false on no match
 * @return str The link text based on passed parameters.
 * @todo This function needs to be cleaned up or split into separate functions
 */
if ( function_exists('register_sidebar') ) { 
	register_sidebar(array(
		'name' => 'Facebook-login',
		'id' => 'facebook-login',
		'before_widget' => '<div id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</div><div class="separator"></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3><div class="sep"></div>',
	));
}
function bp_core_get_username_rp( $user_id ) {
	$data=get_userdata($user_id);

	$display_name = bp_core_get_user_displayname( $user_id );

	if ( empty( $display_name ) )
		return false;

	if ( empty( $data->first_name ) ) {
		return $display_name; 
	} else { 
		return $data->first_name . ' ' . $data->last_name;
	}
}


function bp_core_get_userlink_rp( $user_id, $no_anchor = false, $just_link = false ) {
	$data=get_userdata($user_id);
	
	$display_name = bp_core_get_user_displayname( $user_id );

	if ( empty( $display_name ) )
		return false;

	if ( $no_anchor )
		return $display_name;

	if ( !$url = bp_core_get_user_domain( $user_id ) )
		return false;

	if ( $just_link )
		return $url;

	if ( empty( $data->first_name ) ) {
		return apply_filters( 'bp_core_get_userlink', '<a href="' . $url . '" title="' . $display_name . '">' . $display_name . '</a>', $user_id ); 
	} else { 
		return apply_filters( 'bp_core_get_userlink', '<a href="' . $url . '" title="' .  $data->first_name . ' ' . $data->last_name . '">' . $data->first_name . ' ' . $data->last_name . '</a>', $user_id );
	}
}

function bp_group_description_without_filters() {
	echo bp_get_group_description_wf();
}
	function bp_get_group_description_wf( $group = false ) {
		global $groups_template;

		if ( !$group )
			$group =& $groups_template->group;

		return stripslashes($group->description);
	}

function bp_loggedin_user_fullname_rp() {
	echo bp_get_loggedin_user_fullname_rp();
}
	function bp_get_loggedin_user_fullname_rp() {
		global $bp;
		if ($bp->loggedin_user->first_name && $bp->loggedin_user->last_name){
 			return apply_filters( 'bp_get_loggedin_user_fullname_rp', $bp->loggedin_user->first_name . " " . $bp->loggedin_user->last_name );
		}else{
			return apply_filters( 'bp_get_loggedin_user_fullname_rp', isset( $bp->loggedin_user->fullname ) ? $bp->loggedin_user->fullname : '' );
		}
	}
	
function rp_hae_alat($post_id){
	$terms = get_the_terms($post_id, 'Alat');
		if ( $terms && ! is_wp_error( $terms ) ) : 
			$alat = array();
			foreach ( $terms as $term ) {
				$alat[] = $term->name;
			}
			$list = join( ", ", $alat );
			return $list; 
		else : return "";
		endif;
	}
function rp_alat_checklist(){
	$terms = get_terms('Alat', 'hide_empty=0');
		if ( $terms && ! is_wp_error( $terms ) ) : 
			$alat = array();
			foreach ( $terms as $term ) {
				$alat[] = "<input type='checkbox' name='alat[]' value='" . $term->term_id . "'>" . $term->name . "</input>";
			}
			$list = join( "<br/>", $alat );
			return $list; 
		else : return "";
		endif;
	}
	
	function my_topic_date_ouput () {

global $forum_template;
echo date ('M d, Y  ', strtotime($forum_template->topic->topic_time));

}
add_filter( 'bp_get_the_topic_post_time_since', 'my_topic_date_ouput' );

//disable the responsive stylesheet from buddypress plugin.
function bp_head_action() {
	remove_theme_support( 'bp-default-responsive' );
}
add_action( 'bp_head', 'bp_head_action');

function kirjauduInfo() {
	if(!is_user_logged_in()) :
		return '<div calss="kirjaudu">Käytä PROksia Facebook-tunnuksillasi tai luo uusi käyttäjätili.<span></span></div>';
	endif;
}

function my_excerpt_group_description( $description ) {

$length = 90;
$description = substr($description,0,$length);
return $description . "...";
}
add_filter( 'bp_get_group_description_excerpt', 'my_excerpt_group_description');
?>
