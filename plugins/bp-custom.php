<?php
/* Reorder profile tabs */
function bbg_change_profile_tab_order() {
global $bp;
 
$bp->bp_nav['profile']['position'] = 10;
$bp->bp_nav['activity']['position'] = 50;
$bp->bp_nav['friends']['position'] = 30;
$bp->bp_nav['messages']['position'] = 40;
$bp->bp_nav['groups']['position'] = 20;
$bp->bp_nav['settings']['position'] = 60;
}
add_action( 'bp_setup_nav', 'bbg_change_profile_tab_order', 999 );

/* define the default Profile component */
define("BP_DEFAULT_COMPONENT","groups");// Now when you click on a user name link, You will land on User's profile not user's activity page

// Activity button Poistaa public messaget
function remove_public_message_button() {
remove_filter( 'bp_member_header_actions','bp_send_public_message_button', 20);
}
add_action( 'bp_member_header_actions', 'remove_public_message_button' );

function bp_remove_gravatar ($image, $params, $item_id, $avatar_dir, $css_id, $html_width, $html_height, $avatar_folder_url, $avatar_folder_dir) {
	$default = get_stylesheet_directory_uri() .'/_inc/images/bp_default_avatar.jpg';
	if( $image && strpos( $image, "gravatar.com" ) ){
		return '<img src="' . $default . '" alt="avatar" class="avatar" ' . $html_width . $html_height . ' />';
	} else {
		return $image;
	}
}
add_filter('bp_core_fetch_avatar', 'bp_remove_gravatar', 1, 9 );
function remove_gravatar ($avatar, $id_or_email, $size, $default, $alt) {
	$default = get_stylesheet_directory_uri() .'/_inc/images/bp_default_avatar.jpg';
	return "<img alt='{$alt}' src='{$default}' class='avatar avatar-{$size} photo avatar-default' height='{$size}' width='{$size}' />";
}
add_filter('get_avatar', 'remove_gravatar', 1, 5);
function bp_remove_signup_gravatar ($image) {
	$default = get_stylesheet_directory_uri() .'/_inc/images/bp_default_avatar.jpg';
	if( $image && strpos( $image, "gravatar.com" ) ){
		return '<img src="' . $default . '" alt="avatar" class="avatar" width="150" height="150" />';
	} else {
		return $image;
	}
}
add_filter('bp_get_signup_avatar', 'bp_remove_signup_gravatar', 1, 1 );

?>