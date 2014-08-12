<?php

/**
 * BuddyPress - Groups Loop
 *
 * Querystring is set via AJAX in _inc/ajax.php - bp_dtheme_object_filter()
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

?>

<?php do_action( 'bp_before_groups_loop' ); ?>

<?php if ( bp_has_groups( bp_ajax_querystring( 'groups' ) ) ) : ?>

	<div id="pag-top" class="pagination">

		<div class="pag-count" id="group-dir-count-top">

			<?php bp_groups_pagination_count(); ?>

		</div>

		<div class="pagination-links" id="group-dir-pag-top">

			<?php bp_groups_pagination_links(); ?>

		</div>

	</div>

	<?php do_action( 'bp_before_directory_groups_list' ); ?>
	<div style="display:block;">
        <ul id="groups-list" class="item-list" role="main">
        <?php while ( bp_groups() ) : bp_the_group(); ?>
            <li class="projektikorttiwrap">
                <div class="projektikortti">
                	<div class="projektikortti-inner-wrap">
                        <div class="item-avatar">
                            <a href="<?php bp_group_permalink(); ?>"><?php bp_group_avatar(); ?></a>
                        </div>
                        <div class="item">
                            <a class="projektikortti-otsikko" href="<?php bp_group_permalink(); ?>"><?php bp_group_name(); ?></a>
                           <!-- <div class="item-desc"><?php #bp_group_description_excerpt(); ?></div>-->
                            <span class="projektiadminit"><?php bp_group_list_admin_names() ?></span>
                        </div>
                    </div>
                    <div class="korttipush"></div>
                </div>
                <div class="projektikortti-footer">
                	<?php do_action( 'bp_directory_groups_item' ); ?>
                	
                    <!--<span><?php #bp_group_type(); ?> / <?php #bp_group_member_count(); ?></span>
					<?php #do_action( 'bp_directory_groups_actions' ); ?>-->
                </div>
            </li>
        <?php endwhile; ?>
        </ul>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
	<?php do_action( 'bp_after_directory_groups_list' ); ?>

	<div id="pag-bottom" class="pagination">

		<div class="pag-count" id="group-dir-count-bottom">

			<?php bp_groups_pagination_count(); ?>

		</div>

		<div class="pagination-links" id="group-dir-pag-bottom">

			<?php bp_groups_pagination_links(); ?>

		</div>

	</div>

<?php else: ?>

	<div id="message" class="info">
		<p><?php _e( 'There were no groups found.', 'buddypress' ); ?></p>
	</div>

<?php endif; ?>

<?php do_action( 'bp_after_groups_loop' ); ?>
<div class="clear"></div>