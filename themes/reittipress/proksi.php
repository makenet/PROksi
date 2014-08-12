<?php /* Template Name: PROksin etusivu */ 
get_header() ?>
	<div id="proksi-etusivu-header">
    	<div class="proksi-etusivu-header-wrap">
            <div class="tyypit">
            	<div class="kirjautuminen">
        			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Facebook-login') ) : ?>  
					<?php endif; ?>
        		</div>
            </div>
            <h1 class="slogan">Asiantuntijuuden ja osaamisen jakamista.</h1>
            <p class="slogan-info">Tuo osaamisesi esille ja hyödynnä monialaista asiantuntijayhteisöä projektisi toteuttamiseksi.</p>
            <a class="slogan-more" href="/info">Lue lisää &raquo;</a>
        </div>
        
    </div>
    <div id="proksi-etusivu-aihepankki">
    	<div class="etusivu-centered">
        	<div class="uudet-aiheet-oikea">
                <a class="ehdota" style="text-decoration:none;" href="/aihepankki">Ehdota projektiaihetta &raquo;</a>
                <p>Työnantajat voivat ehdottaa aihetta opiskelijaprojektille ja osallistua sen ohjaamiseen PROksissa.<p> <p>Opiskelija voi tarttua aiheeseen ja sopia koulun kanssa, kuinka sisällyttää sen opintoihinsa.</p>
            </div>
            <div class="uudet-aiheet">
                <h2>Uusimmat vapaat projektiaiheet</h2>                             
                 
                    <?php 
                    $args = array(
                                    'post_type' => 'aihe',
                                    'posts_per_page' => 4,
                                    'meta_key' => 'aiheen_tekijan_id',
                                    'meta_value' => 0,
                                    'meta_compare' => '=='
                                ); 
                    query_posts($args);
                    if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
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
			</div>
            <a href="aihepankki" style="display:block; clear:both;">Lisää &raquo;</a>
            <div style="clear:both;display:block;"></div>
        </div>
    </div>
    
    <!--- PROJEKTIT --->
    
    <div id="proksi-etusivu-projektit">
    	<div class="etusivu-centered">
    		<h2>Viimeksi aktiiviset projektit</h2>
			<?php if ( bp_has_groups('max=4') ) : ?>	
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
                        </div>
                    </li>
                <?php endwhile; ?>
                </ul>
                <a href="groups" style="display:block;">lisää &raquo;</a>
                <div class="clear"></div>     
			<?php else: ?>
            	<div id="message" class="info">
                	<p>Ei projekteja käynnissä. <a href="groups">Luo uusi projekti.</a></p>
            	</div>
			<?php endif; ?>
		</div>
     </div>
     <?php get_sidebar(); ?>
     <style type="text/css">
		div#sidebar{
			display:none;
		}
		.footer-left{
			margin:0;
		}
	</style>
<?php get_footer() ?>