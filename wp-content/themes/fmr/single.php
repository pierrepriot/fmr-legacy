<?php 
/** 
 * @package WordPress 
 * @subpackage Default_Theme 
 */

get_header(); ?>

<div id="main">
	<div id="leftcontent" role="main">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<!-- div class="navigation">
			<div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
			<div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
		</div-->
		
		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<a href="javascript:history.back()">Retour &agrave; la page précedente</a>
			<h2><?php the_title(); ?></h2>
			<div class="entry">
				<?php the_content('<p class="serif">Lire la suite de l\'article &raquo;</p>'); ?>
				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				<?php the_tags( '<p>Mots-clefs&nbsp;: ', ', ', '</p>'); ?> 
				<!--p class="postmetadata alt">
					<small>
						Cet article  a été publié 
						<?php 
						/*
							Cette partie est commentée parce qu'elle demande parfois un petit ajustement .
							Vous aurez besoin de télécharger ce plugin, et de suivre les instructions contenues dans la page :
							http://binarybonsai.com/wordpress/time-since/ 
						*/
						/* $entry_datetime = abs(strtotime($post->post_date) - (60*120)); echo time_since($entry_datetime); echo ' ago'; */
						?>
						le <?php the_time('l j F Y') ?> à <?php the_time() ?>
						et est classé dans <?php the_category(', ') ?>.
					</small>				
				</p-->
			</div>
		</div>
		<!--?php comments_template(); ?-->
	
	<?php endwhile; else: ?>
	
		<p>Désolé, aucun article ne correspond à vos critères.</p>
		
	<?php endif; ?>
	</div>


<?php get_sidebar('news'); ?>

<div class="clear"></div>

<?php get_footer(); ?>