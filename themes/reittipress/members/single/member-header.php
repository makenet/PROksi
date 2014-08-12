<?php

/**
 * BuddyPress - Users Header
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

?>

<?php do_action( 'bp_before_member_header' ); ?>
<div id="item-header-avatar">
	<?php if(get_current_user_id() == bp_displayed_user_id()) : ?>
    	<a href="<?php bp_displayed_user_link(); ?>/profile/change-avatar/">
	<?php else : ?> 
	   	<a href="<?php bp_displayed_user_link(); ?>">
	<?php endif; ?>
		<?php bp_displayed_user_avatar( 'type=full' ); ?>
	</a>
    
</div><!-- #item-header-avatar -->

<div id="item-header-content">

	<h2>
		<a href="<?php bp_displayed_user_link(); ?>"><?php bp_displayed_user_fullname(); ?></a>
	</h2>
    <span class="activity-profiili"><?php bp_last_activity( bp_displayed_user_id() ); ?></span>
    <span class="rooli"><?php if (!empty(bp_member_profile_data( 'field=Rooli' ))) : bp_member_profile_data( 'field=Rooli' ); endif; ?></span>
    <span class="viiva"></span>
	<?php do_action( 'bp_before_member_header_meta' ); ?>
	<!---<span class="user-nicename">@<?php# bp_displayed_user_username(); ?></span>-->
	
    
    
	<div id="item-meta" class="proksi-user-info">

		<!---<?php# if ( bp_is_active( 'activity' ) ) : ?> -->

			<!--<div id="latest-update">

				<?#php bp_activity_latest_update( bp_displayed_user_id() ); ?>

			</div>-->
        <?php 
		
        /***
		 * If you'd like to show specific profile fields here use:
		 *  bp_member_profile_data( 'field=About Me' ); -- Pass the name of the field
		 */
		 if($data = bp_get_profile_field_data( 'field=LinkedIn' )) : ?>
		 	<div class="linkedin">            
            	<a href="<?php bp_member_profile_data( 'field=LinkedIn' ); ?>"><img src="<?php bloginfo('url'); ?>/images/linkedin.gif" /></a>
         		<a href="<?php bp_member_profile_data( 'field=LinkedIn' ); ?>">LinkedIn-profiili</a>
            </div>
         <?php elseif(get_current_user_id() == bp_displayed_user_id()) : ?>
		 	<div class="linkedin">
            	<a href="<?php bloginfo('url'); ?>/members/<?php echo bp_displayed_user_username(); ?>"><img src="<?php bloginfo('url'); ?>/images/linkedin.gif" /></a>            
            	<a href="<?php bloginfo('url'); ?>/members/<?php echo bp_displayed_user_username(); ?>/profile/edit/group/1/">lisää LinkedIn-profiili</a>
            </div>
         <?php endif; do_action( 'bp_profile_header_meta' ); ?>
   

		<!--<?php# endif; ?>-->

		<div id="item-buttons">

			<?php do_action( 'bp_member_header_actions' ); ?>

		</div><!-- #item-buttons -->
		
        
	</div><!-- #item-meta -->

</div><!-- #item-header-content -->

<?php do_action( 'bp_after_member_header' ); ?>

<?php do_action( 'template_notices' ); ?>