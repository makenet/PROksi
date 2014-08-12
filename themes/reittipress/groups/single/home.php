<?php get_header( 'buddypress' ); ?>

	<div id="content">
		<div class="padder">

			<?php if ( bp_has_groups() ) : while ( bp_groups() ) : bp_the_group(); ?>

				<?php do_action( 'bp_before_group_home_content' ) ?>
            	
				<div id="item-header" class="proksi-projekti-hdr" role="complementary">
            	
					<?php locate_template( array( 'groups/single/group-header.php' ), true ); ?>
					
				</div><!-- #item-header -->
				<div id="proksi-group-content">
					<h2 class="proksi-projekti-h2"><a href="<?php bp_group_permalink(); ?>" title="<?php bp_group_name(); ?>"><?php bp_group_name(); ?></a></h2>
					<div class="proksi-group-desc">
						<?php if (bp_get_group_status() == "public" || (is_user_logged_in() && bp_group_is_member()) && bp_is_active( 'activity' )) : ?>
							<?php bp_group_description(); ?>
	        			<?php elseif(bp_is_active( 'activity' )) : ?>
							<?php bp_group_description_without_filters(); ?><br />
	        			<?php endif ?>
						<?php echo kirjauduInfo(); ?>
	            		
					</div>
				   	 
				   	<div class="item-list-tabs no-ajax" id="object-nav" role="navigation">
				   		<ul>
            	   	
				   			<?php bp_get_options_nav(); ?>
            	   	
				   			<?php do_action( 'bp_group_options_nav' ); ?>
            	   	
				   		</ul>
				   	</div>
					
					<div id="item-body">
            		
						<?php do_action( 'bp_before_group_body' );
            		
						if ( bp_is_group_admin_page() && bp_group_is_visible() ) :
							locate_template( array( 'groups/single/admin.php' ), true );
            		
						elseif ( bp_is_group_members() && bp_group_is_visible() ) :
							locate_template( array( 'groups/single/members.php' ), true );
            		
						elseif ( bp_is_group_invites() && bp_group_is_visible() ) :
							locate_template( array( 'groups/single/send-invites.php' ), true );
            		
							elseif ( bp_is_group_forum() && bp_group_is_visible() && bp_is_active( 'forums' ) && bp_forums_is_installed_correctly() ) :
								locate_template( array( 'groups/single/forum.php' ), true );
            		
						elseif ( bp_is_group_membership_request() ) :
							locate_template( array( 'groups/single/request-membership.php' ), true );
            		
						elseif ( bp_group_is_visible() && bp_is_active( 'activity' ) ) :
							locate_template( array( 'groups/single/activity.php' ), true );
            		
						elseif ( bp_group_is_visible() ) :
							locate_template( array( 'groups/single/members.php' ), true );
            		
						elseif ( !bp_group_is_visible() ) :
							// The group is not visible, show the status message
            		
							do_action( 'bp_before_group_status_message' ); ?>
            		
							<div id="message" class="info">
								<p><?php bp_group_status_message(); ?></p>
							</div>
            		
							<?php do_action( 'bp_after_group_status_message' );
            		
						else :
							// If nothing sticks, just load a group front template if one exists.
							locate_template( array( 'groups/single/front.php' ), true );
            		
						endif;
            		
						do_action( 'bp_after_group_body' ); ?>
					</div><!-- #item-body -->
					<?php do_action( 'bp_after_group_home_content' ); ?>
				</div><!-- #proksi-group-content -->
            	
			<?php endwhile; endif; ?>

		</div><!-- .padder -->
	</div><!-- #content -->

<?php get_sidebar( 'buddypress' ); ?>
<?php get_footer( 'buddypress' ); ?>
