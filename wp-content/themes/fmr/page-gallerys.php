<?php 
/** 
 * @package WordPress 
 * @subpackage FMR 
 */ 
/*
Template Name: Page Accueil Galeries
*/

get_header(); 


?>


<div id="main">
	<div id="leftcontent" role="main">
		<div id="actuHeader">
		
			<h2 id="actuTitle"><?php the_title(); ?></h2>
			
		</div>
		<a href="index.php?page_id=55">[retour &agrave la page Fmr]</a>
		<br />
		<br />
		
<?php
$children = list_gallerys('title_li=&child_of='.$post->ID.'&echo=0');

if ($children) { ?>
<ul>
<?php echo $children; ?>
</ul>
<?php } ?>
		

	</div>
	
<div class="clear"></div>

<?php get_footer(); ?>