<?php 
/** 
 * @package WordPress 
 * @subpackage FMR 
 */ 
/*
Template Name: Page Accueil Programmes
*/

get_header(); 

// Identifiants Wordpress des 3 catégories de programmes
$idCatMus = 13;
$idCatDec = 14;
$idCatMag = 15;
?>


<div id="main">
	<div id="fullcontent" role="main">
		<div id="progHeader">
		
			<h1><?php the_title(); ?></h1>
			<ul id="submenu">
				<li><a href="index.php?page_id=129&type=<?php echo $_GET['type']; ?>&day=lundi">LUNDI</a></li>
				<li>•</li>
				<li><a href="index.php?page_id=129&type=<?php echo $_GET['type']; ?>&day=mardi">MARDI</a></li>
				<li>•</li>
				<li><a href="index.php?page_id=129&type=<?php echo $_GET['type']; ?>&day=mercredi">MERCREDI</a></li>
				<li>•</li>
				<li><a href="index.php?page_id=129&type=<?php echo $_GET['type']; ?>&day=jeudi">JEUDI</a></li>
				<li>•</li>
				<li><a href="index.php?page_id=129&type=<?php echo $_GET['type']; ?>&day=vendredi">VENDREDI</a></li>
				<li>•</li>
				<li><a href="index.php?page_id=129&type=<?php echo $_GET['type']; ?>&day=samedi">SAMEDI</a></li>
				<li>•</li>
				<li><a href="index.php?page_id=129&type=<?php echo $_GET['type']; ?>&day=dimanche">DIMANCHE</a></li>
			</ul>
		</div>
		
		<ul id="submenuProg">
			<li><a href="index.php?page_id=129&type=&day="><img class="submenuProgImg" src="param/pix/shared/progBlack.png" alt="LA SEMAINE" title="LA SEMAINE" />&nbsp;LA SEMAINE</a></li>
			<li><a href="index.php?page_id=163&type=&day="><img class="submenuProgImg" src="param/pix/shared/progBlack.png" alt="LA GRILLE" title="LA GRILLE" />&nbsp;LA GRILLE</a></li>
			<li><a href="index.php?page_id=129&type=13&day=<?php echo $_GET['day']; ?>"><img class="submenuProgImg" src="param/pix/shared/progOrange.png" alt="MUSICALE" title="MUSICALE" />&nbsp;<span class="prog13">MUSICALE</span></a></li>
			<li><a href="index.php?page_id=129&type=15&day=<?php echo $_GET['day']; ?>"><img class="submenuProgImg" src="param/pix/shared/progBrown.png" alt="MAGAZINE" title="MAGAZINE" />&nbsp;<span class="prog15">MAGAZINE</span></a></li>
			<li><a href="index.php?page_id=129&type=14&day=<?php echo $_GET['day']; ?>"><img class="submenuProgImg" src="param/pix/shared/progGray.png" alt="TON D&Eacute;CAL&Eacute;" title="TON D&Eacute;CAL&Eacute;" />&nbsp;<span class="prog14">TON D&Eacute;CAL&Eacute;</span></a></li>
		</ul>
		<hr />
		
<?php

	// Liste les sous cat de Programmes suivant le paramètre : une ou toutes
	if ($_GET['type'] != '') {
		$idCatTab = array($_GET['type']);
	} else {
		$idCatTab = array($idCatMus, $idCatDec, $idCatMag);
	}
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
	
	// Liste des jours
	$jours = array('lundi',	'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
	
	// Tableau des horaires
	$horaires = array('lundi' => array(),
						'mardi' => array(),
						'mercredi' => array(),
						'jeudi' => array(),
						'vendredi' => array(),
						'samedi' => array(),
						'dimanche' => array());
						
	// Correspondances id prog
	$idTitleProg = array(1049 => 'MUSICALE', 14 => 'D&Eacute;CAL&Eacute;', 15 => 'MAGAZINE');

	// Tableau des données programme
	$programmes = array();

	// Passe les post de ces catégories
	foreach ($categories as $infoCat) {
				
		$args = array(
			'numberposts' => 1,
			'category' => $infoCat->cat_ID,
			'orderby' => 'date',
			'order' => 'ASC'
			); 
			
		$attachments = get_posts($args);

		if ($attachments) {
						
			foreach ($attachments as $post) {

				// Mémorise les informations du programme
				//$programmes[$post->ID]['img'] = wp_get_post_image('width=200&height=120&css=emImg&parent_id='.$post->ID);
				$programmes[$post->ID]['nom'] = $infoCat->name;
				$programmes[$post->ID]['type'] = $infoCat->category_parent;
				$programmes[$post->ID]['id'] = $post->ID;
				$programmes[$post->ID]['style'] = $infoCat->description;
				$programmes[$post->ID]['catId'] = $infoCat->cat_ID;
				$programmes[$post->ID]['idEm'] = '';

				// Extrait le texte du post
				$postContent = $attachments[0]->post_content;
	//			while (strpos($postContent, '<a') !== FALSE){
	//				$postContent = removeImg($postContent);
	//			}
				
				// Remplace le texte du programme
				$programmes[$post->ID]['text'] = $postContent;
									
				// Récupère les metas horaires	
				$custom_fields = get_post_custom($post->ID);
				
				// Et les insère dans le tableau horaires
				foreach ($custom_fields as $field => $fieldDatas) {
					if ($field != '_edit_lock' && $field != '_edit_last' && $field != 'web') {
						foreach ($fieldDatas as $hour) {
							$horaires[$field][$hour] = $post->ID;
						}
					} else if ($field == 'web') {
						$programmes[$post->ID]['web'] = $fieldDatas[0];
					}
				}

				// Récupère les infos de l'émission la plus récente
				
				// Infos de la catégories émissions du programme en cours
			//	$emissionsInfos = get_category_by_slug( $infoCat->category_nicename . '-em' );
			
				// Cherche l'id de la catégorie émission et charge les infos de la derniere emission
			/*	if (isset($emissionsInfos->term_id)) {
					$args2 = array(	'numberposts' => 1,
									'category' => $emissionsInfos->term_id,
									'orderby' => 'date',
									'order' => 'DESC'); 
						
					// Extrait le texte du post
					$attachments2 = get_posts($args2);
					
					//print_r($attachments2); echo '<br><br>';
					$postContent = $attachments2[0]->post_content;
					while (strpos($postContent, '<a') !== FALSE){
						$postContent = removeImg($postContent);
						
					}
					
					// Remplace le texte du programme
					$programmes[$post->ID]['text'] = $postContent;

					// S'il y a une image, remplace l'image du programme
					if (wp_get_post_image('width=200&height=120&css=alignleft&parent_id='.$attachments2[0]->ID) != '') {
						$programmes[$post->ID]['img'] = 
							wp_get_post_image('width=200&height=120&css=emImg&parent_id='.$attachments2[0]->ID);
					}
					
					// Ajoute l'id de l'émission si dispo
					$programmes[$post->ID]['idEm'] = $attachments2[0]->ID;
				}*/
			}
		}

	//	unset($emissionsInfos);
	//	unset($attachments2);
		
	}				
	// Affichage des émissions
	
	// Applique le filtre des jours si besoin
	if ($_GET['day'] != '') {
		$horaires = array($_GET['day'] => $horaires[$_GET['day']]);
		$jours = array($_GET['day']);
	}
	print_r($horaires);
	foreach ($jours as $jour) {
		
		// Ordonne les horaires
		ksort($horaires[$jour]);
		//print_r($horaires[$jour]);
		
		$cptLine = 1;
		$flagProg = FALSE;
		// Pour chaque horaire
		foreach ($horaires[$jour] as $hour => $idProg) {
			
			// Flage la présence de programmes pour ce jour
			$flagProg = TRUE;
			
			if ($cptLine == 1) {
// $idTitleProg[$programmes[$idProg]['type']]

				echo '<div class="progLeft">
						<p>
							<span class="dayTitle">' . strtoupper($jour) . 
							'</span>&nbsp;&nbsp;&nbsp;<span class="hourTitle">' . str_replace('-', ' &agrave; ', $hour) . 
							'</span>
						</p>
						<p class="progTitle">' . $programmes[$idProg]['nom'] . 
							'&nbsp;&nbsp;<img class="progLogo" src="param/pix/shared/prog' . $programmes[$idProg]['type'] . '.png">
							<span class="prog' . $programmes[$idProg]['type'] . ' progType">' . 
								$programmes[$idProg]['style'] . '</span>
						</p>
						<div class="progText">' . $programmes[$idProg]['text'] . '</div>
						<div class="clear"></div>' . 
								(trim($programmes[$idProg]['web']) != '' ? 
								'<a href="http://' . $programmes[$idProg]['web'] . '" target="_blank">http://' . 
									$programmes[$idProg]['web'] . '</a>' : '') . 
								'<br /><a href="index.php?page_id=212&idprog=' . $programmes[$idProg]['catId'] . '&idem=' . 
													$programmes[$idProg]['idEm'] . '">[VOIR FICHE]</a> 
											<a href="index.php?page_id=288&idprog=' . $programmes[$idProg]['catId'] . '">[PODCASTS]</a>
					</div>';
				$cptLine ++;
				
			} else {
			
				echo '<div class="progRight">
						<p>
							<span class="dayTitle">' . strtoupper($jour) . 
							'</span>&nbsp;&nbsp;&nbsp;<span class="hourTitle">' . str_replace('-', ' &agrave; ', $hour) . 
							'</span>
						</p>
						<p class="progTitle">' . $programmes[$idProg]['nom'] . 
							'&nbsp;&nbsp;<img class="progLogo" src="param/pix/shared/prog' . $programmes[$idProg]['type'] . '.png">
							<span class="prog' . $programmes[$idProg]['type'] . ' progType">' . 
								$programmes[$idProg]['style'] . '</span>
						</p>
						<div class="progText">' . $programmes[$idProg]['text'] . '</div>
						<div class="clear"></div>' . 
								(trim($programmes[$idProg]['web']) != '' ? 
								'<a href="http://' . $programmes[$idProg]['web'] . '" target="_blank">http://' . 
									$programmes[$idProg]['web'] . '</a>' : '') . 
								'<br /><a href="index.php?page_id=212&idprog=' . $programmes[$idProg]['catId'] . '&idem=' . 
													$programmes[$idProg]['idEm'] . '">[VOIR FICHE]</a> 
											<a href="index.php?page_id=288&idprog=' . $programmes[$idProg]['catId'] . '">[PODCASTS]</a>
					</div>
					<div class="clear"></div>';
				$cptLine = 1;
			}
		}
		
		if ($flagProg === TRUE) {
			echo '<div class="clear"></div><hr />';
		}
	}
?>
		
	</div>	
	<div class="clear"></div>


<?php get_footer(); ?>