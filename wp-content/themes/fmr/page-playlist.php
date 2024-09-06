<?php 
/** 
 * @package WordPress 
 * @subpackage FMR 
 */ 
/*
Template Name: Page Détail Playlist
*/

get_header();
?>

<div id="main">
	<div id="leftcontent" role="main">
		<div id="actuHeader">
		
			<h1 id="actuTitle">PLAYLIST</h1>

		</div>
		<a href="index.php?page_id=241">[retour &agrave la liste des playlists]</a>
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
	$infos = get_category_by_slug( $infoProg->category_nicename . '-play' );
	
	// Charge la liste des playlists
	if (isset($infos->term_id)) {
	
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

		foreach ($posts as $playlist) {

			// Si c'est celle à afficher
			if ($playlist->ID == $idPl) {

				// Affiche le titre de la playlist
				echo '<br /><h3>' . $playlist->post_title . '</h3><br />';
			
				// Récupère la playlist
				$texte =  $playlist->post_content;
				
				// Affiche la playlist en cours suivant le type de playlist
				if (substr_count($texte, '///') >= 3) {
				
					echo '<table id="playlistTab">
							<tr>
								<th class="playCell1">N&deg;</th>
								<th>Artiste / Groupe</th>
								<th>Titre</th>
								<th>Label / Distributeur</th>
							</tr>';
					$textTab = explode('$$$', $texte);

					$line1 = TRUE;
					
					foreach ($textTab as $lineContent)
					{
						$lineTab = explode('///', $lineContent);

						echo '<tr class="playLine' . ($line1 ? '1' : '2') . '">
									<td class="playCell1">' . $lineTab[0] . '</td>
									<td class="playCell2">' . $lineTab[1] . '</td>
									<td>' . $lineTab[2] . '</td>
									<td>' . $lineTab[3] . '</td></tr>';
						
						if ($line1) {
							$line1 = FALSE;
						} else {
							$line1 = TRUE;
						}
					}
					
					echo '</table>';
				
				} else {
				
					// Indique les séparations
					$separ = array('.mp3)','.wav)','.m4a)');
					$texte = str_replace($separ, '$@&', $texte);
					
					// Supprime les mises en forme
					$cleanTab = array('<div id="_mcePaste">', '</div>', '=&gt;');
					$texte = str_replace($cleanTab, '', $texte);
					
					// Extrait les lignes
					$tab = explode('$@&', $texte);
					
					echo '<ul>';	
					// Affichage
					foreach ($tab as $track) {
					
						$tabTrack = explode(' - ', substr($track, 0, strpos($track, '(F:')));
						echo '<li>' . $tabTrack[0] . ' - <strong>' . $tabTrack[1] . '</strong></li>';
					}
					echo '</ul>';
				}
				break;
			}
		}
	} else {
		echo '<br />Pas de playlist pour cette émission';
	}
	// Appel de la sidebar
	
?>		</div>

	</div>

<?php get_sidebar('playlist'); ?>

<div class="clear"></div>

<?php get_footer(); ?>