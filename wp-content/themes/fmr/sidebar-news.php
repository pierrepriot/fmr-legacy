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
		<h2 class="sidebarTitle">ARCHIVES</h2>
		<a href="index.php?page_id=46&year=&month=" class="sidebarMenu">voir [+]</a>
	</div>
	
<ul>

<?php
/**
$querystr = "SELECT YEAR(post_date) AS 'year', MONTH(post_date) AS 'month' , count(ID) as posts FROM $wpdb->posts INNER JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id) INNER JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id) WHERE $wpdb->term_taxonomy.term_id != 9 AND $wpdb->term_taxonomy.parent != 9 AND $wpdb->term_taxonomy.term_id != 1 AND $wpdb->term_taxonomy.parent != 1 AND $wpdb->term_taxonomy.term_id != 8 AND $wpdb->term_taxonomy.parent != 8 AND $wpdb->term_taxonomy.term_id != 10 AND $wpdb->term_taxonomy.parent != 10 AND $wpdb->term_taxonomy.taxonomy = 'category' AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'post' GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date DESC";
*/
$querystr = "SELECT YEAR(post_date) AS 'year', MONTH(post_date) AS 'month' , count(ID) as posts FROM $wpdb->posts INNER JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id) INNER JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id) WHERE $wpdb->term_taxonomy.parent = 5 AND $wpdb->term_taxonomy.taxonomy = 'category' AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'post' GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date DESC";

$years = $wpdb->get_results($querystr);

// Tableau d'affichage par année
$dispYears = array();

// Calcul des différents posts mois par mois
foreach ( (array) $years as $year ) {
	//$url = get_month_link( $year->year, $year->month );
	$url = $_SERVER['HTTP_REFERER'] . 'index.php?page_id=46&year=' . $year->year . '&month=' . $year->month;
	$date =mysql2date('F', $year->year.'-'.$year->month, $translate = true);
//	echo get_archives_link($url, $date, 'html','<li>',' (' . $year->posts .')</li>');

	if (!is_array($dispYears[$year->year])) {
		$dispYears[$year->year] = array();
	}
	array_push($dispYears[$year->year], get_archives_link($url, $date, 'html','<li>',' (' . $year->posts .')</li>'));
}

krsort($dispYears);	// Classement

// Affichage des années
foreach ($dispYears as $year => $line) {

	echo '<a href="javascript:;" onclick="Suite(\'year' . $year . '\')" class="year">• ' . $year . '</a> 
			<div id="year' . $year . '" class="yearDiv">
				<ul>';

	foreach ($line as $month) {
		echo $month;
	}

	echo '</ul>
		</div>
		<hr />';
}

?>
</ul>
<?php get_search_form(); ?>
</div>
<div class="clear"></div>