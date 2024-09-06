<?php 
/** 
 * @package WordPress 
 * @subpackage FMR 
 */ 
/*
Template Name: Page Accueil Podcasts
*/

get_header();

// Identifiants Wordpress des 3 catégories de programmes
$idCatMus = 13;
$idCatDec = 14;
$idCatMag = 15;
?>

<div id="main">
	<div id="leftcontent" role="main">
		<div id="actuHeader">
		
			<h1 id="actuTitle">PODCASTS</h1>

		</div>
		<div>
		
<?php
	// Liste les sous cat de Programmes suivant le paramètre : une ou toutes
	$idCatTab = array($idCatMus, $idCatDec, $idCatMag);
	$categories = array();
	
	foreach ($idCatTab as $idCat) {
		$args = array(
					    'type'                     => 'post',
					    'child_of'                 => '',
					    'parent'				   => $idCat,
					    'orderby'                  => 'name',
					    'order'                    => 'ASC',
					    'hide_empty'               => 0,
					    'hierarchical'             => 1,
					    'exclude'                  => '',
					    'include'                  => '',
					    'number'                   => '',
					    'pad_counts'               => false );

		$categories = array_merge($categories, get_categories( $args ));
	}
	
	// Remettre les émissions dans l'ordre
	$programmes = array();
	foreach ($categories as $categorie) {
		$programmes[$categorie->cat_ID] = $categorie->name;
	}
	// Classe
	asort($programmes);
?>
<br />
				<?php
				
					// Constitution du tableau des programmes
					$listProg = array();
					foreach ($programmes as $idProg => $progName) {
					
							array_push($listProg, '<li><a href="index.php?page_id=316&idprog=' . $idProg . '">' . $progName . '</a></li>');
					}
					
					// Compte le nombre
					$nbProg = count($listProg);
					
					// Première colonne
					echo '<table style="width:100%">
							<tr>
								<td style="width:50%">
									<ul>';
					for ($i = 0 ; $i < round((int)$nbProg/2) ; $i ++) {
						
						echo $listProg[$i];
					}
					echo '			</ul>
								</td>
								<td style="width:50%">
									<ul>';
								
					// Deuxième colonne
					for ($i = round((int)$nbProg/2) ; $i < $nbProg ; $i ++) {
						
						echo $listProg[$i];
					}
					echo '			</ul>
								</td>
								<td>';
					echo '</table>';
				?>

		</div>

	</div>

<?php get_sidebar('podcasts'); ?>


<div class="clear"></div>

<?php get_footer(); ?>