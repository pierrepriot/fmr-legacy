<?php 
/** 
 * @package WordPress 
 * @subpackage FMR 
 */ 
/*
Template Name: Page Détail Podcast
*/

get_header();
?>

<div id="main">
	<div id="leftcontent" role="main">
		<div id="actuHeader">
		
			<h1 id="actuTitle">PODCAST</h1>

		</div>
		<a href="index.php?page_id=314">[retour &agrave la liste des podcasts]</a>
		<br />
		<br />
		<div>
		
<?php
	
	global $posts;
	$posts = array();

	// Charge le nom de la catégorie
	$infoProg = get_category($_GET['idprog']);
	echo '<h2>' . $infoProg->name . '</h2>';

	// Cherche la categorie playlists du prog correspondant
	$infos = get_category_by_slug( $infoProg->category_nicename . '-pod' );
	
	// Charge la liste des podcasts
	if (isset($infos->term_id)) {
		echo '<ul>';
		$args = array(
					'numberposts' => -1,
					'category' => $infos->term_id
				);

		$posts = get_posts($args);

		// Définit l'id playlist si manquant
		if (isset($_GET['idpl']) && $_GET['idpl'] != '') {
			$idPl = $_GET['idpl'];
		} else {
			$idPl = $posts[0]->ID;
		}

		foreach ($posts as $podcast) {

			// Si c'est celle à afficher
			if ($podcast->ID == $idPl) {

				// Affiche le titre du podcast
				echo '<br /><h3>' . $podcast->post_title . '</h3><br />';
			
				// Affiche le podcast en cours
				echo '<object type="application/x-shockwave-flash" data="wp-content/themes/fmr/dewplayer/dewplayer.swf" width="200" height="20" id="dewplayer" name="dewplayer">
							<param name="movie" value="wp-content/themes/fmr/dewplayer/dewplayer.swf" />
							<param name="flashvars" value="mp3=' . $podcast->post_content . '&amp;showtime=1" />
							<param name="wmode" value="transparent" />
						</object>';
						
			}
		}
		echo '</ul>';
	} else {
		echo '<br />Pas de podcast pour cette émission';
	}
	// Appel de la sidebar
	
?>		</div>

	</div>

<?php get_sidebar('podcast'); ?>

<div class="clear"></div>

<?php get_footer(); ?>