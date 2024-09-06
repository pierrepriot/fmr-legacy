<?php 
/** 
 * @package WordPress 
 * @subpackage FMR 
 */ 
/*
Template Name: Page Détail Programme
*/

get_header(); 
?>
<?php
	// Recup des infos programme		
	// A partir de la catégorie
	$infosCat = get_category( $_GET['idprog']);

	$args = array(
		'numberposts' => 1,
		'category' => $_GET['idprog'],
		'orderby' => 'date',
		'order' => 'ASC'
		); 
		
	$attachments = get_posts($args);
?>
<div id="main">
	<div id="leftcontent" role="main">
		<div id="actuHeader">		
			<h2 id="progMainTitle"><?php echo strtoupper($infosCat->name); ?></h2>
		</div>
		<div>
			<h3 id="styleTitle"><?php echo $infosCat->description; ?></h3>
			<div>
				<?php echo $attachments[0]->post_content; ?>
			</div>
			<div class="clear"></div>
			<?php
			//	$withcomments = 1;
			//	comments_template();
			?>
		</div>
		<hr />
<?php	

	// Récupère les infos de l'émission la plus récente
	
	// Infos de la catégories émissions du programme en cours
	$emissionsInfos = get_category_by_slug( $infosCat->category_nicename . '-em' );

	$emissions = array();

	// Emission à afficher chargée ?
	$curEmissionLoaded = FALSE;

	// Cherche l'id de la catégorie émission et charge les infos des emissions
	if (isset($emissionsInfos->term_id)) {
	
		$args2 = array(	
						'numberposts' => -1,
						'category' => $emissionsInfos->term_id,
						'orderby' => 'date',
						'order' => 'DESC'); 
				
		// Extrait le texte du post
		$attachments2 = get_posts($args2);
		
		// Classe les émissions dans les différentes années
		foreach ($attachments2 as $infoEmission) {
		
			// Charge l'émission à afficher si besoin	
			if ($curEmissionLoaded === FALSE && isset($_GET['idem']) 
					&& ( ($_GET['idem'] == '') || $_GET['idem'] == $infoEmission->ID)) {
				$attachments3 = $infoEmission;
				$curEmissionLoaded = TRUE;
			}		
		
			if (!isset($emissions[substr($infoEmission->post_date, 0, 4)])) {
				$emissions[substr($infoEmission->post_date, 0, 4)] = array();
			}
			array_push($emissions[substr($infoEmission->post_date, 0, 4)], 
						array('title'=>$infoEmission->post_title, 'id'=>$infoEmission->ID));
		}
	}
	
	echo '<h3>Emission : ' . $attachments3->post_title . '</h3>
			<br />' . $attachments3->post_content;
?>
	</div>


<?php //get_sidebar('programme'); ?>

<?php include (TEMPLATEPATH . '/sidebar-programme.php'); ?>

<div class="clear"></div>

<?php get_footer(); ?>