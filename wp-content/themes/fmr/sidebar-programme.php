<?php 
/** 
 * @package WordPress 
 * @subpackage Default_Theme 
 */ 
?>
<script type="text/javascript">
function Suite(lien){
	
	var objet = document.getElementById(lien);
	
	if(objet.style.display == "none" || !objet.style.display){

		objet.style.display = "block";
	} else {
		objet.style.display = "none";
	}
}
</script>

<div id="rightsidebar">
	<div class="sidebarHeader">
		<h2 class="sidebarTitle">Archives des &eacute;missions</h2>
	</div>
<ul>

<?php

	// Récupère les infos de l'émission la plus récente
	
	// Infos de la catégories émissions du programme en cours
/*	$emissionsInfos = get_category_by_slug( $infosCat->category_nicename . '-em' );

	$emissions = array();

	// Cherche l'id de la catégorie émission et charge les infos des emissions
	if (isset($emissionsInfos->term_id)) {
	
		$args2 = array(	
						'category' => $emissionsInfos->term_id,
						'orderby' => 'date',
						'order' => 'DESC'); 
			
		// Extrait le texte du post
		$attachments2 = get_posts($args2);
		
		// Classe les émissions dans les différentes années
		foreach ($attachments2 as $infoEmission) {
			if (!isset($emissions[substr($infoEmission->post_date, 0, 4)])) {
				$emissions[substr($infoEmission->post_date, 0, 4)] = array();
			}
			array_push($emissions[substr($infoEmission->post_date, 0, 4)], 
						array('title'=>$infoEmission->post_title, 'id'=>$infoEmission->ID));
		}
	}*/
	
	// Affichage des années
	foreach ($emissions as $year => $line) {
	
		echo '<a href="javascript:;" onclick="Suite(\'year' . $year . '\')" class="year">• ' . $year . '</a> 
				<div id="year' . $year . '" class="yearDiv">
					<ul>';
	
		foreach ($line as $emission) {
			echo '<li><a href="index.php?page_id=212&idprog=' . $_GET['idprog'] . '&idem=' . 
													$emission['id'] . '">' . $emission['title'] . '</a></li>';
		}
	
		echo '</ul>
			</div>
			<hr />';
	}
?>

	</ul>
	<br />
	<br />
	<div class="sidebarHeader">
		<h2 class="sidebarTitle">Archives des playlists</h2>
	</div>
	
<?php
	
	$posts = array();

	// Charge le nom de la catégorie
	$infoProg = get_category($_GET['idprog']);

	// Cherche la categorie playlists du prog correspondant
	$infos = get_category_by_slug( $infoProg->category_nicename . '-play' );
	
	// Charge la liste des playlists
	if (isset($infos->term_id)) {
	
		$args = array(
					'numberposts' => -1,
					'category' => $infos->term_id
				);

		$posts = get_posts($args);
		
	}
	
?>
	
<?php
	// Cherche l'id de la catégorie émission et charge les infos des emissions
	if (count($posts) > 0) {
		
		// Classe les émissions dans les différentes années
		foreach ($posts as $infoPlaylist) {
			if (!isset($playlists[substr($infoPlaylist->post_date, 0, 4)])) {
				$playlists[substr($infoPlaylist->post_date, 0, 4)] = array();
			}
			array_push($playlists[substr($infoPlaylist->post_date, 0, 4)], 
						array('title'=>$infoPlaylist->post_title, 'id'=>$infoPlaylist->ID));
		}
		
		// Affichage des années
		foreach ($playlists as $year => $line) {
		
			echo '<a href="javascript:;" onclick="Suite(\'year3' . $year . '\')" class="year">• ' . $year . '</a> 
					<div id="year3' . $year . '" class="yearDiv">
						<ul>';
		
			foreach ($line as $playlist) {
				echo '<li><a href="index.php?page_id=245&idprog=' . $_GET['idprog'] . '&idpl=' . 
														$playlist['id'] . '">' . $playlist['title'] . '</a></li>';
			}
		
			echo '</ul>
				</div>
				<hr />';
		}
	}
?>

		</ul>
	<br />
	<br />
	<div class="sidebarHeader">
		<h2 class="sidebarTitle">Archives des podcasts</h2>
	</div>
	<ul>
<?php
	
	$posts = array();

	// Charge le nom de la catégorie
	$infoProg = get_category($_GET['idprog']);

	// Cherche la categorie playlists du prog correspondant
	$infos = get_category_by_slug( $infoProg->category_nicename . '-pod' );
	
	// Charge la liste des podcasts
	if (isset($infos->term_id)) {

		$args = array(
					'numberposts' => -1,
					'category' => $infos->term_id
				);

		$posts = get_posts($args);
	}
	// Appel de la sidebar
	
?>
	<?php
		// Cherche l'id de la catégorie émission et charge les infos des emissions
		if (count($posts) > 0) {
			
			// Classe les émissions dans les différentes années
			foreach ($posts as $infoPodcast) {
				if (!isset($podcasts[substr($infoPodcast->post_date, 0, 4)])) {
					$podcasts[substr($infoPodcast->post_date, 0, 4)] = array();
				}
				array_push($podcasts[substr($infoPodcast->post_date, 0, 4)], 
							array('title'=>$infoPodcast->post_title, 'id'=>$infoPodcast->ID));
			}
			
			// Affichage des années
			foreach ($podcasts as $year => $line) {
			
				echo '<a href="javascript:;" onclick="Suite(\'year2' . $year . '\')" class="year">• ' . $year . '</a> 
						<div id="year2' . $year . '" class="yearDiv">
							<ul>';
			
				foreach ($line as $podcast) {
					echo '<li><a href="index.php?page_id=316&idprog=' . $_GET['idprog'] . '&idpl=' . 
															$podcast['id'] . '">' . $podcast['title'] . '</a></li>';
				}
			
				echo '</ul>
					</div>
					<hr />';
			}
		}
	?>
	
	</ul>

</div>

<div class="clear"></div>