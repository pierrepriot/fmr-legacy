<?php 
/** 
 * @package WordPress 
 * @subpackage Default_Theme 
 */ 
?>
<div id="rightsidebar">
	<div class="sidebarHeader">
		<h2 class="sidebarTitle">DERNI&Egrave;RES PLAYLISTS AJOUT&Eacute;ES</h2>
	</div>
	
		<!-- Compteur de posts et tableaux d'entrées de playlist-->
		<?php //$count = 0;
			  $datas = array();
			  //The Query
				$args = array(
					'tag'  => 'playlist',
					'showposts' => '20'
					);
				query_posts($args); ?>
		<div>
			<ul>
		<?php while (have_posts()) : the_post(); ?>
			<!-- Filtre les post de playlists -->
			<?php 
			
			//	$count ++; 
				$category = get_the_category();

				echo '<li><a href="index.php?page_id=245&idprog=' . 
							(isset($category[1]) ? $category[1]->category_parent : $category[0]->category_parent) . '&idpl=' . 
							(isset($category[1]) ? $category[1]->object_id : $category[0]->object_id) . '">' . 
							get_cat_name($category[0]->category_parent) . ' - ' . substr(get_the_title(), 0, 54) . 
						'</a>
					  </li><li><hr /></li>';
					
				// Sort si plus de 3 dates
			//	if ($count >= 10) {
			//		break;
			//	}
			 ?>			
		<?php endwhile; ?>
		
			</ul>
		</div>

</div>