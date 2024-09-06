<?php 
/** 
 * @package WordPress 
 * @subpackage Default_Theme 
 */ 
?>
<div id="rightsidebar">
	<div class="sidebarHeader">
		<h2 class="sidebarTitle">PODCASTS</h2>
		<a href="index.php?page_id=314" class="sidebarMenu">voir [+]</a>
	</div>
	
		<!-- Compteur de posts et tableaux d'entrées d'agenda-->
		<?php $count = 0;
			  $datas = array();
			  //The Query
				$args = array(
					'tag'  => 'podcast'
					);
				query_posts($args); ?>
		<div>
			<ul>
		<?php while (have_posts()) : the_post(); ?>
		
			<!-- Filtre les post d'agenda -->
			<?php 
				$count ++; 
				$category = get_the_category();

				echo '<li><a href="index.php?page_id=288&idprog=' . $category[0]->category_parent . '">' . 
								get_cat_name($category[0]->category_parent) . ' - ' . substr(get_the_title(), 0, 54) . 
						'</a>
					  </li><li><hr /></li>';
					
				// Sort si plus de 3 dates
				if ($count >= 3) {
					break;
				}
			 ?>			
		<?php endwhile; ?>
		
			</ul>
		</div>

	<br />
	<div class="coloredBlock">
		<div class="sidebarHeader">
			<h2 class="sidebarTitle">PROGRAMMES & EMISSIONS</h2>
		</div>
		Retrouvez la grille des programmes et toutes les fiches &eacute;missions.<br />
		<a href="index.php?page_id=129" class="sidebarMenu">voir [+]</a>
		<div class="clear"></div>
	</div>
	<br />
	<div class="sidebarHeader">
		<h2 class="sidebarTitle">GALERIES</h2>
		<a href="index.php?page_id=97" class="sidebarMenu">voir [+]</a>
	</div>
	<div>
		<?php
		$children = list_gallerys('title_li=&child_of=97&echo=0');
		
		if ($children) { ?>
		<ul>
		<?php echo $children; ?>
		</ul>
		<?php } ?>
	</div>
	<br />
	<div class="coloredBlock">
		<div class="sidebarHeader">
			<h2 class="sidebarTitle">PARTENARIATS</h2>
		</div>
		Retrouvez tous nos partenariats en cours dans la section "PARTENAIRES".<br />
		<a href="index.php?page_id=64" class="sidebarMenu">voir [+]</a>
		<div class="clear"></div>
	</div>
	<br />
	<div class="coloredBlock">
		<div class="sidebarHeader">
			<h2 class="sidebarTitle">ARCHIVES DES SITES FMR</h2>
		</div>
		Retrouvez ci-dessous les anciens sites Radio Fmr !<br />
		<a href="https://radio-fmr.net/BACKUP_201011_site/index.php3" target="_blank">2005-2010</a>
		<div class="clear"></div>
	</div>
</div>
