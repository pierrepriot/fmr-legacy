<?php 
/** 
 * @package WordPress 
 * @subpackage FMR 
 */ 
/*
Template Name: ActusArchives
*/

get_header(); 
?>
<div id="main">
	<div id="leftcontent" role="main">
		<div id="actuHeader">
		
			<h2 id="actuTitle">ACTU</h2>
			
			<ul id="actuMenuTop">
				<li><a href="index.php?page_id=46&actu=5&month=<? echo $_GET['month']; ?>&year=<? echo $_GET['year']; ?>">toutes</a></li>
				<li>•</li>
				<li><a href="index.php?page_id=46&actu=6&month=<? echo $_GET['month']; ?>&year=<? echo $_GET['year']; ?>">radio</a></li>
				<li>•</li>
				<li><a href="index.php?page_id=46&actu=7&month=<? echo $_GET['month']; ?>&year=<? echo $_GET['year']; ?>">fera</a></li>
				<li>•</li>
				<li><a href="index.php?page_id=46&actu=8&month=<? echo $_GET['month']; ?>&year=<? echo $_GET['year']; ?>">locale</a></li>
			</ul>
		</div>
	
<?php
// Sélections des catégories		
$idCat = 5;
if ($_GET['actu'] != '') {
	$idCat = $_GET['actu'];
}

//The Query
/*$args = array(
	'posts_per_page' => 5,
	'cat'  => $idCat,
	'monthnum' => $_GET['month'],
	'year' => $_GET['year']
	);
query_posts($args);*/

$paged = intval(get_query_var('paged'));
			if($paged == 0) {
			$paged = 1;
			}
			query_posts("showposts=2&cat=" . $idCat . "&monthnum=" . $_GET['month'] . "&year=" . $_GET['year'] . "&paged=" . $paged);
?>

<?php if (have_posts()) : ?>

<?php wp_pagenavi(); ?>

<?php //The Loop
		while (have_posts()) : the_post(); ?>
				<div>
					<a name="post-<?php the_ID(); ?>"></a>
					<h3 class="newsTitle"><?php the_title(); ?></h3>
					<small><?php the_time('j F Y') ?></small>
					<div>
						<?php the_content('<br /><span class="newsLink">voir [+]</span>'); ?>
						<!-- a href="?page_id=44" class="newsLink">voir [+]</a -->
					</div>
					<div class="clear"></div>
					<?php
						$withcomments = 1;
						echo '<br />';
						//comments_template(); ?>

				</div>
				<hr />
<?php endwhile; else:
	echo 'pas de post';
endif;

//Reset Query
wp_reset_query();
?>


	</div>


<?php get_sidebar('news'); ?>

<div class="clear"></div>

<?php get_footer(); ?>