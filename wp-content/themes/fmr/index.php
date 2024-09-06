<?php 
/** 
 * @package WordPress 
 * @subpackage FMR 
 */ 

get_header(); ?>
<?php query_posts('cat=5'); ?>
<div id="main">
	<div id="leftcontent" role="main">
		<div id="actuHeader">
		
			<h2 id="actuTitle">ACTU</h2>
			
			<ul id="actuMenuTop">
				<li><a href="index.php?actu=5">toutes</a></li>
				<li>&bull;</li>
				<li><a href="index.php?actu=6">fmr</a></li>
				<li>&bull;</li>
				<li><a href="index.php?actu=7">fera</a></li>
				<li>&bull;</li>
				<li><a href="index.php?actu=8">&eacute;missions</a></li>
			</ul>
		</div>
		<?php if (have_posts()) : ?>
		
		<?php 
		// Sélections des catégories
		$idCat = 5;
		if ($_GET['actu'] != '') {
			$idCat = $_GET['actu'];
		}
		
		//The Query
	/*	$args = array(
			'posts_per_page' => 2,
			'cat'  => $idCat
			);
		query_posts($args); */
		?>
		<?php
		//	$paged = intval(get_query_var('paged'));
		//	if($paged == 0) {
		//	$paged = 1;
		//	}
			query_posts("showposts=5&cat=" . $idCat . "&paged=" . $paged); ?>
		
		<?php wp_pagenavi(); ?>
		
			<!-- Compteur de posts -->
			<?php $count = 0; ?>
			<?php while (have_posts()) : the_post(); ?>
			
				<!-- Filtre les post d'actualités uniquement et éventuellement le type fera radio ou locale-->
				<!-- php if (in_category('ACTU') && ($_GET['actu'] == '' || in_category($_GET['actu']))) { ?-->
				<?php $count ++; ?>
				<div>
					<a href="index.php?page_id=46#post-<?php the_ID(); ?>"><h3 class="newsTitle"><?php the_title(); ?></h3></a>
					<small><?php the_time('j F Y') ?> <!-- par <?php the_author() ?> --></small>
					<div>
						<?php the_content(''); ?>
						<br /><a href="index.php?page_id=46#post-<?php the_ID(); ?>" class="newsLink">voir [+]</a>
						
					</div>
					<div class="clear"></div>
				</div>
				<hr />
				<!-- php } ?-->
				
			<?php endwhile; ?>
			<?php if ($count == 0) { ?>
				<div>
					<br />
					<p>Aucune actualit&eacute; pour le moment.</p>
				</div>
			<?php } ?>

		<?php else : ?>
		
			<div>
				<br />
				<p>Aucune actualit&eacute; <?php echo $_GET['actu']; ?> pour le moment.</p>
			</div>
			
		<?php endif; ?>
		
	</div>
	
<?php get_sidebar('index'); ?>

<div class="clear"></div>

<?php get_footer(); ?>