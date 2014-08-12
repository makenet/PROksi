<?php
/*
Plugin Name: PROksi etapit
Description: PROksi etapit
Version: 1.0
Author: Markku Tähtinen
*/
 
/* Only load code that needs BuddyPress to run once BP is loaded and initialized. */
function proksi_etapit_init() {
    require( dirname( __FILE__ ) . '/proksi_etapit.php' );
}
add_action( 'bp_include', 'proksi_etapit_init' );
 
/* If you have code that does not need BuddyPress to run, then add it here. */
?>