<?php 
/** 
 * @package WordPress 
 * @subpackage Default_Theme 
 */ 

get_header(); ?>
<div id="main">
	<div id="leftcontent" role="main">
		<div id="actuHeader">
		
			<h2 id="actuTitle">ACTU</h2>
			
			<ul id="actuMenuTop">
				<li>R&eacute;sultats de recherche</li>
			</ul>
		</div>
	<?php if (have_posts()) : ?>
	
		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Articles plus anciens') ?></div>
			<div class="alignright"><?php previous_posts_link('Articles plus récents &raquo;') ?></div>
		</div>
		
		<?php while (have_posts()) : the_post(); ?>
			<div>
				<br />
				<h3><a href="index.php?page_id=46#post-<?php the_ID(); ?>"><?php the_title(); ?></a></h3>
				<small>publi&eacute; le <?php the_time('l j F Y') ?></small>

			</div>
		<?php endwhile; ?>
		
		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Articles plus anciens') ?></div>
			<div class="alignright"><?php previous_posts_link('Articles plus récents &raquo;') ?></div>
		</div>
		
	<?php else : ?>
	
		<h2 class="center">Aucun article trouvé. Essayer une autre recherche ?</h2>
		<?php get_search_form(); ?>
		
	<?php endif; ?>
</div>

<?php get_sidebar('news'); ?>

<div class="clear"></div>

<?php get_footer(); ?>