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
		<h2 class="sidebarTitle">Archives des playlists</h2>
	</div>
<ul>

<?php
	// Cherche l'id de la catégorie émission et charge les infos des emissions
	if (count($posts) > 0) {
		
		// Classe les émissions dans les différentes années
		foreach ($posts as $infoEmission) {
			if (!isset($emissions[substr($infoEmission->post_date, 0, 4)])) {
				$emissions[substr($infoEmission->post_date, 0, 4)] = array();
			}
			array_push($emissions[substr($infoEmission->post_date, 0, 4)], 
						array('title'=>$infoEmission->post_title, 'id'=>$infoEmission->ID));
		}
		
		// Affichage des années
		foreach ($emissions as $year => $line) {
		
			echo '<a href="javascript:;" onclick="Suite(\'year' . $year . '\')" class="year">• ' . $year . '</a> 
					<div id="year' . $year . '" class="yearDiv">
						<ul>';
		
			foreach ($line as $emission) {
				echo '<li><a href="index.php?page_id=245&idprog=' . $_GET['idprog'] . '&idpl=' . 
														$emission['id'] . '">' . $emission['title'] . '</a></li>';
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