<?php 
/** 
 * @package WordPress 
 * @subpackage FMR 
 */ 
/*
Template Name: Page Grille programmes
*/
require('../../../wp-blog-header.php');
get_header('iphone'); 

// Identifiants Wordpress des 3 catégories de programmes
$idCatMus = 13;
$idCatDec = 14;
$idCatMag = 15;
$idCatDecr = 119;
?>


<div id="main">
	<div id="fullcontent" role="main">
		
<?php

	// Liste les sous cat de Programmes suivant le paramètre : une ou toutes
	if ($_GET['type'] != '') {
		$idCatTab = array($_GET['type']);
	} else {
		$idCatTab = array($idCatMus, $idCatDec, $idCatMag, $idCatDecr);
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
	//$idTitleProg = array(13 => 'MUSICALE', 14 => 'D&Eacute;CAL&Eacute;', 15 => 'MAGAZINE');

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
						
			//foreach ($attachments as $post) {
				$post = $attachments[0];
				// Récupère les metas horaires	
				$custom_fields = get_post_custom($post->ID);			
				
				// Et les insère dans le tableau horaires
				foreach ($custom_fields as $field => $fieldDatas) {
					if ($field != '_edit_lock' && $field != '_edit_last' && $field != 'web') {
						foreach ($fieldDatas as $hour) {

							$tabHour = split('-', str_replace(array('h30', 'h'), array('.5', ''), $hour));
							//$tabHour = split('-', str_replace('h', '', $hour));

							// Prise en compte des horaires de nuit
							for ($i = 0 ; $i <= 1 ; $i++) {
								if ($tabHour[$i] < 7 ) {
									$tabHour[$i] = $tabHour[$i] + 24;
								}
							}
												
							// 
							if (!is_array($horaires[$field][$tabHour[0]])) {
								$horaires[$field][$tabHour[0]] = array();
							}

							array_push($horaires[$field][$tabHour[0]], array('id' => $post->ID,
																	'duration' => $tabHour[1] - $tabHour[0],
																	'label' => $infoCat->name,
																	'type' =>  $infoCat->category_parent,
																	'idprog' => $infoCat->term_id));
						}
					} else if ($field == 'web') {
						$programmes[$post->ID]['web'] = $fieldDatas[0];
					}
				//}
			}
		}	
	}
		
	$oneHour = 87;
?>
		<div id="col0">
			<div style="height:12px"></div>
			<div style="height:<?php echo $oneHour; ?>px">07h00</div>
			<div style="height:<?php echo $oneHour; ?>px">08h00</div>
			<div style="height:<?php echo $oneHour; ?>px">09h00</div>
			<div style="height:<?php echo $oneHour; ?>px">10h00</div>
			<div style="height:<?php echo $oneHour; ?>px">11h00</div>
			<div style="height:<?php echo $oneHour; ?>px">12h00</div>
			<div style="height:<?php echo $oneHour; ?>px">13h00</div>
			<div style="height:<?php echo $oneHour; ?>px">14h00</div>
			<div style="height:<?php echo $oneHour; ?>px">15h00</div>
			<div style="height:<?php echo $oneHour; ?>px">16h00</div>
			<div style="height:<?php echo $oneHour; ?>px">17h00</div>
			<div style="height:<?php echo $oneHour; ?>px">18h00</div>
			<div style="height:<?php echo $oneHour; ?>px">19h00</div>
			<div style="height:<?php echo $oneHour; ?>px">20h00</div>
			<div style="height:<?php echo $oneHour; ?>px">21h00</div>
			<div style="height:<?php echo $oneHour; ?>px">22h00</div>
			<div style="height:<?php echo $oneHour; ?>px">23h00</div>
			<div style="height:<?php echo $oneHour; ?>px">00h00</div>
			<div style="height:<?php echo $oneHour; ?>px">01h00</div>
			<div style="height:<?php echo $oneHour; ?>px">02h00</div>
			<div style="height:<?php echo $oneHour; ?>px">03h00</div>
			<div style="height:<?php echo $oneHour; ?>px">04h00</div>
		</div>

<?php

	// Affichage des colonnes
	
	// Pour chaque jour
	foreach ($jours as $jour) {
		
		// Entete de la colonne
		echo '<div id="col1"><p class="gridDay">' . strtoupper($jour) . '</p>';
		
		ksort($horaires[$jour]);
		//print_r($horaires[$jour]);
		//echo '<br><br>';
	
		// Effectue la boucle sur un autre niveau
	
		// Regarde chaque horaire
		foreach ($horaires[$jour] as $hour => $hourDatas) {
//print_r($hourDatas);
			// Si pas déjà traité en third
			if ($current != $jour . $hour . $hourDatas[0]['duration'] . $hourDatas[0]['id']) {
	
	
				if (count($hourDatas) == 3) {
					
					echo '<div class="bckg' . $hourDatas[0]['type'] . ' tripleBlockLeft" style="height:' . 
																							($oneHour*$hourDatas[0]['duration']-9) . 'px;">
								<span class="tripleGridTitle">' . $hourDatas[0]['label'] . '</span></div>
						<div class="bckg' . $hourDatas[1]['type'] . ' tripleBlockMid" style="height:' . 
																							($oneHour*$hourDatas[1]['duration']-9) . 'px;">
								<span class="tripleGridTitle">' . $hourDatas[1]['label'] . '</span></div>
						<div class="bckg' . $hourDatas[2]['type'] . ' tripleBlockRight" style="height:' . 
																							($oneHour*$hourDatas[2]['duration']-9) . 'px;">
								<span class="tripleGridTitle">' . $hourDatas[2]['label'] . '</span></div>
						<div class="clear"></div>';
				
					
				// Cas des horaires simultanés et de même durée
				} else if (count($hourDatas) > 1 && $hourDatas[0]['duration'] == $hourDatas[1]['duration']) {

					echo '<div class="bckg' . $hourDatas[0]['type'] . ' demiBlockLeft" style="height:' . 
																							($oneHour*$hourDatas[0]['duration']-9) . 'px;">
								<span class="demiGridTitle">' . $hourDatas[0]['label'] . '</span></div>
						<div class="bckg' . $hourDatas[1]['type'] . ' demiBlockRight" style="height:' . 
																							($oneHour*$hourDatas[1]['duration']-9) . 'px;">
								<span class="demiGridTitle">' . $hourDatas[1]['label'] . '</span></div>
						<div class="clear"></div>';
						
						
				
				// Cas des horaires simultanés et de durée différente
				} else if (count($hourDatas) > 1) {
								
					// Cherche le plus long
					if ($hourDatas[0]['duration'] > $hourDatas[1]['duration']) {
						$firstHour = $hourDatas[0];
						$secondHour = $hourDatas[1];
					} else {
						$firstHour = $hourDatas[1];
						$secondHour = $hourDatas[0];
					}
	
					// Calcul de l'horaire suivant à rechercher
					$hourToFound = $hour + $secondHour['duration'];
									
					// Cherche le troisième horaire
					if ($hourToFound < 10) {
						$hourToFound = '0' . $hourToFound;
					}
					
					$thirdHour = $horaires[$jour][$hourToFound][0];
	
					$current = $jour . $hourToFound . $horaires[$jour][$hourToFound][0]['duration'] . 
								$horaires[$jour][$hourToFound][0]['id'];
	
					echo '<div class="bckg' . $firstHour['type'] . ' demiBlockLeft" style="height:' . 
																							($oneHour*$firstHour['duration']-9) . 'px;">
								<span class="demiGridTitle">' . $firstHour['label'] . '</span></div>
							<div class="bckg' . $secondHour['type'] . ' demiBlockRight" style="height:' . 
																							($oneHour*$secondHour['duration']-11) . 'px;">
								<span class="demiGridTitle">' . $secondHour['label'] . '</span></div>
							<div class="bckg' . $thirdHour['type'] . ' demiBlockRight" style="height:' . 
																							($oneHour*$thirdHour['duration']-11) . 'px;">
								<span class="demiGridTitle">' . $thirdHour['label'] . '</span></div>
							<div class="clear"></div>';				
				
				} else {
					echo '<div class="bckg' . $hourDatas[0]['type'] . '" style="height:' . ($oneHour*$hourDatas[0]['duration']-9) . 
							'px;"><span class="gridTitle">' . $hourDatas[0]['label'] . '</span></div>';
				}
			}
		}
		
		// Fin de la colonne
		echo '</div>';
	}
?>

	</div>	
	<div class="clear"></div>
