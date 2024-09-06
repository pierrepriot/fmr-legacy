<?php 
/** 
 * @package WordPress 
 * @subpackage FMR 
 */ 
/*
Template Name: Page Grille programmes
*/

get_header(); 

// Identifiants Wordpress des 3 catégories de programmes
$idCatMus = 13;
$idCatDec = 14;
$idCatMag = 15;
$idCatDecr = 119;
?>


<div id="main">
	<div id="fullcontent" role="main">
		<div id="progHeader">
		
			<h1><?php the_title(); ?></h1>
		</div>
	<a href="https://radio-fmr.net/wp-content/uploads/2019/12/grille_fmr_201920.jpg"><img class="alignnone size-full wp-image-45202" title="FMR Grille 19-20" src="https://radio-fmr.net/wp-content/uploads/2019/12/grille_fmr_201920.jpg" alt="FMR Grille des Programmes 2019/2020" width="960" height="676" /></a>
	<?php //the_content(); ?>

	</div>	
	<div class="clear"></div>


<?php get_footer(); ?>
