<?php 
/** 
 * @package WordPress 
 * @subpackage FMR 
 */ 
/*
Template Name: Page Contacts
*/

get_header(); ?>
<div id="main">
	<div id="leftcontent" role="main">
		<div id="actuHeader">
		
			<h1 id="actuTitle"><?php the_title(); ?></h1>
			
		</div>
		<br />		
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="entry">
				<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
			</div>
		<?php endwhile; endif; ?>

	</div>

<?php get_sidebar('contacts'); ?>

<div class="clear"></div>

<?php get_footer(); ?>