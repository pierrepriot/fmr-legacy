<?php 
/** 
 * @package WordPress 
 * @subpackage FMR 
 */ 
/*
Template Name: Page Fmr Type
*/

get_header(); ?>
<div id="main">
	<div id="fullcontent" role="main">
		<div id="actuHeader">
		
			<h1 id="actuTitle"><?php the_title(); ?></h1>
			
		</div>
		<br />		
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="entry">
				<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

			</div>
		<?php endwhile; endif; ?>

	</div>
	
<div class="clear"></div>

<?php get_footer(); ?>