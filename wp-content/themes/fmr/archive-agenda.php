<?php 
/** 
 * @package WordPress 
 * @subpackage FMR 
 */ 
/*
Template Name: AgendaArchives
*/

get_header(); 
?>
<div id="main">
	<div id="leftcontent" role="main">
		<div id="actuHeader">
		
			<h1 id="actuTitle">AGENDA</h1>

		</div>
		<div>
		
<!-- Compteur de posts et tableaux d'entrées d'agenda-->
<?php $count = 0;
// Sélections des catégories		
//$idCat = 9;

//The Query
/*$args = array(
	'cat'  => $idCat
	);*/
query_posts('showposts=10000&cat=9');

/*$paged = intval(get_query_var('paged'));
			if($paged == 0) {
			$paged = 1;
			}
			query_posts("showposts=12&cat=" . $idCat . "&monthnum=" . $_GET['month'] . "&year=" . $_GET['year'] . "&paged=" . $paged);
			//query_posts("showposts=12&cat=" . $idCat);*/
?>
<?php if (have_posts()) : ?>


		<?php while (have_posts()) : the_post(); ?>
		
			<!-- Filtre les post d'agenda -->
			<?php 
			  // Lis la date et regarde si elle n'est pas passée
			  $date = get_post_meta($post->ID, 'date', true);

			  if ($date >= date("Ymd") 
			  		&& ((!isset($_GET['monthD']) && date("m") == substr($date, 4, 2) && date("Y") == substr($date, 0, 4))
			  		     || ($_GET['monthD'] == substr($date, 4, 2) && $_GET['yearD'] == substr($date, 0, 4)))) {
			  
				  	if (!isset($datas[$date])) {
				  		$datas[$date] = array();
				  	}
				  
				  $count ++; 
				  $category = get_the_category();
				  array_push($datas[$date], '<a name="' . str_replace(' ', '', substr(get_the_title(), -4) . DEUXJS_numtoletDate($date)) . 
				  				'"></a>' . DEUXJS_numtoletDate($date) . '<h3>' . get_the_title() . '</h3>' . 
				  					$category[1]->cat_name . '<br />' . get_the_content() . '<div class="clear"></div><hr />');
			  }
			?>
			
		<?php endwhile; ?>
		
		<!-- S il y en a, classe et affiche les entrées d'agenda-->
		<?php if ($count > 0) : ?>
		<?php 
			$count = 0;
			ksort($datas);
			foreach ($datas as $dayTab) {
				foreach ($dayTab as $line) {
					echo $line;
					$count ++;
			//		if ($count >= 3) {
			//			break;
			//		}
				}
			}
		?>
		
		<?php else : ?>
				<br />
				Aucune date pour ce mois-ci.

		<?php endif; ?>
		
<?php else:
	echo 'pas de post';
endif;

//Reset Query
wp_reset_query();
?>
		</div>

	</div>
	
<?php get_sidebar('agenda'); ?>

<div class="clear"></div>

<?php get_footer(); ?>