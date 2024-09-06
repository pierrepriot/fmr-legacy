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
		<h2 class="sidebarTitle">Archives des podcasts</h2>
	</div>
<ul>
<?php
	// Cherche l'id de la catégorie émission et charge les infos des Podcasts
	if (count($posts) > 0) {
		
		// Classe les émissions dans les différentes années
		foreach ($posts as $infoPodcast) {
			if (!isset($Podcasts[substr($infoPodcast->post_date, 0, 4)])) {
				$Podcasts[substr($infoPodcast->post_date, 0, 4)] = array();
			}
			array_push($Podcasts[substr($infoPodcast->post_date, 0, 4)], 
						array('title'=>$infoPodcast->post_title, 'id'=>$infoPodcast->ID));
		}
		
		// Affichage des années
		foreach ($Podcasts as $year => $line) {
		
			echo '<a href="javascript:;" onclick="Suite(\'year' . $year . '\')" class="year">• ' . $year . '</a> 
					<div id="year' . $year . '" class="yearDiv">
						<ul>';
		
			foreach ($line as $Podcast) {
				echo '<li><a href="index.php?page_id=316&idprog=' . $_GET['idprog'] . '&idpl=' . 
														$Podcast['id'] . '">' . $Podcast['title'] . '</a></li>';
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