<?php

do_action( 'bp_before_group_header' );

?>
<div id="proksi-group-sidebar-wrap">
	<div id="item-header-avatar">
		<a href="<?php bp_group_permalink(); ?>" title="<?php bp_group_name(); ?>">
			<?php bp_group_avatar(); ?>
		</a>
	</div><!-- #item-header-avatar -->
		<a class="projektiotsikko" href="<?php bp_group_permalink(); ?>" title="<?php bp_group_name(); ?>">
			<?php bp_group_name(); ?>
		</a>
	<span class="highlight"><?php bp_group_type(); ?></span>
	<?php do_action( 'bp_before_group_header_meta' ); ?>
	<?php if ( bp_group_is_visible() ) : ?>
       	<h4><?php _e( 'Group Admins', 'buddypress' ); ?></h4>
        <ul class="proksi-admin-list">
			<?php bp_linked_group_list_admin_names(); ?>
	   	</ul>
		<?php #bp_group_list_admins(); 
			#do_action( 'bp_after_group_menu_admins' );
	 endif; ?>
		
	<?php do_action( 'bp_group_header_actions' ); ?>
	<?php do_action( 'bp_group_header_meta' ); ?>
	<span class="activity"><?php printf( __( 'active %s', 'buddypress' ), bp_get_group_last_active() ); ?></span>
</div><!--#proksi-group-sidebar-wrap>-->
<script type="text/javascript">
jQuery(function(){
	jQuery('#home').html("Toiminta");
});
</script>
<?php
do_action( 'bp_after_group_header' );
do_action( 'template_notices' );
?>