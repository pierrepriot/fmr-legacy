<?php 
/** 
 * @package WordPress 
 * @subpackage Default_Theme 
 */ 
?>
<div id="rightsidebar">
	<div class="sidebarHeader">
		<h2 class="sidebarTitle">AGENDA</h2>
		<a href="index.php?page_id=208" class="sidebarMenu">voir [+]</a>
	</div>


		<!-- Compteur de posts et tableaux d'entrées d'agenda-->
		<?php $count = 0;
			  $datas = array();
			  //The Query
				/*$args = array(
					'cat'  => 9
					);
				query_posts($args);*/
				query_posts('showposts=10000&cat=9'); ?>
		<div>
			<ul>
		<?php while (have_posts()) : the_post(); ?>
		
			<!-- Filtre les post d'agenda -->
			<?php 
				  // Lis la date et regarde si elle n'est pas passée
				  $date = get_post_meta($post->ID, 'date', true);
				  
				  if ($date >= date("Ymd")) {  					
					  if (!isset($datas[$date])) {
				  		$datas[$date] = array();
					  	}
			  
					  $count ++; 
					  $category = get_the_category();
					  array_push($datas[$date], '<li>' . 
					  							DEUXJS_numtoletDate($date) . ' - ' . $category[1]->cat_name . 
					  							' - <a href="archives-agenda/?monthD=' . substr($date, 4, 2) . 
					  																'&yearD=' . substr($date, 0, 4) . '#' . 
					  							str_replace(' ', '', substr(get_the_title(), -4) . DEUXJS_numtoletDate($date)) . '">' . 
					  							substr(get_the_title(), 0, 100) . 
					  					'</a></li><li><hr /></li>');
					}
					
					// Sort si plus de 3 dates
					//if ($count >= 7) {
					//	break;
					//}
		 ?>			
		<?php endwhile; ?>
		
		<!-- S il y en a, classe et affiche les entrées d'agenda-->
		<?php if ($count > 0) : ?>
		<?php 
			$count = 0;
			ksort($datas);			
			foreach ($datas as $dayTab) {
				foreach ($dayTab as $line) {
					echo $line;
					$count ++;
					if ($count >= 5) {
						break(2);
					}
				}
			}
		?>
		
		<?php else : ?>
			<li>
				Aucune date pour le moment.
			</li>
		<?php endif; ?>
			</ul>
		</div>
		
	<br />
	<div>
		<?php
		list_gallerys('title_li=&child_of=97&echo=0&pageIndex=TRUE&nbGal=3');
		
		if ($children) { ?>
		<ul>
		<?php echo $children; ?>
		</ul>
		<?php } ?>
	</div>	
	<br />
	<br />
	<div class="sidebarHeader">
		<h2 class="sidebarTitle">PODCASTS</h2>
		<a href="index.php?page_id=314" class="sidebarMenu">voir [+]</a>
	</div>
	
		<!-- Compteur de posts et tableaux d'entrées d'agenda-->
		<?php //$count = 0;
			  $datas = array();
			  //The Query
				$args = array(
					'tag'  => 'podcast',
					'showposts' => '3'
					);
				query_posts($args); ?>
		<div>
			<ul>
		<?php while (have_posts()) : the_post(); ?>
		
			<!-- Filtre les post d'agenda -->
			<?php 
				//$count ++; 
				$category = get_the_category();

				echo '<li><a href="index.php?page_id=316&idprog=' . $category[0]->term_id . '">' . 
								get_cat_name($category[0]->category_parent) . ' - ' . substr(get_the_title(), 0, 54) . 
						'</a>
					  </li><li><hr /></li>';
					
				// Sort si plus de 3 dates
			//	if ($count >= 3) {
			//		break;
			//	}
			 ?>			
		<?php endwhile; ?>
		<?php  if ($count == 0) : ?>
			<li>
				Aucun podcast pour le moment.
			</li>
		<?php endif; ?>
			</ul>
		</div>

	<br />
	<br />
	<div class="sidebarHeader">
		<h2 class="sidebarTitle">PLAYLISTS</h2>
		<a href="index.php?page_id=314" class="sidebarMenu">voir [+]</a>
	</div>
	
		<?php //$count = 0;
			  $datas = array();
			  //The Query
				$args = array(
					'tag'  => 'playlist',
					'showposts' => '3'
					);
				query_posts($args); ?>
		<div>
			<ul>
		<?php while (have_posts()) : the_post(); ?>
		
			<?php 
				//$count ++; 
				$category = get_the_category();

				echo '<li><a href="index.php?page_id=245&idprog=' . 
							(isset($category[1]) ? $category[1]->category_parent : $category[0]->category_parent) . '&idpl=' . 
							(isset($category[1]) ? $category[1]->object_id : $category[0]->object_id) . '">' . 
							get_cat_name($category[0]->category_parent) . ' - ' . substr(get_the_title(), 0, 54) . 
						'</a>
					  </li><li><hr /></li>';
					
				// Sort si plus de 3 dates
			//	if ($count >= 3) {
			//		break;
			//	}
			 ?>			
		<?php endwhile; ?>
		<?php  if ($count == 0) : ?>
			<li>
				Aucune playlist pour le moment.
			</li>
		<?php endif; ?>
			</ul>
		</div>

	<br />
	<br />
	<div class="sidebarHeader">
		<h2 class="sidebarTitle">DERNIERS TWEETS</h2>&nbsp;&nbsp;<img src="param/pix/shared/blacktwitter.png" />
		<a href="https://twitter.com/RADIOFMR" target="_blank" class="sidebarMenu">suivez-nous [+]</a>
	</div>
	<br /><br />
	<img title="Radio FMR disponible sur Iphone !" alt="Radio FMR disponible sur Iphone !" src="param/pix/shared/iphoneaccueil2.png" 
			usemap="#map1">
	<MAP NAME="map1">	
	<AREA SHAPE="RECT" style="border:solid 1px" COORDS="16,82,178,136" href="https://itunes.apple.com/fr/app/radio-fmr-alternative-musicale/id404579279?mt=8" title="Radio FMR disponible sur Iphone !" alt="Radio FMR disponible sur Iphone !" target="_blank">
	<AREA SHAPE="RECT" style="border:solid 1px" COORDS="15,150,177,204" href="https://market.android.com/details?id=com.studio2j.radiofmr" 
		title="Radio FMR disponible sur Android !" alt="Radio FMR disponible sur Iphone !"target="_blank">
	</MAP> 

	<a href="https://www.laregion.fr/" title="R&eacute;gion Occitanie" target="_blank"><img src="/wp-content/uploads/2023/06/logo-region-occ.png" alt="R&eacute;gion Occitanie"></a>		
</div>
