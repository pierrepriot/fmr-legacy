<?php 
/** 
 * @package WordPress 
 * @subpackage Default_Theme 
 */ 
?>
<div id="rightsidebar">
	<div class="sidebarHeader">
		<h2 class="sidebarTitle">DERNIERS PODCASTS AJOUT&Eacute;S</h2>
	</div>
	
		<!-- Compteur de posts et tableaux d'entrées d'agenda-->
		<?php $count = 0;
			  $datas = array();
			  //The Query
				$args = array(
					'tag'  => 'podcast'
					);
				query_posts($args); ?>

			<ul>
		<?php while (have_posts()) : the_post(); ?>
			<!-- Filtre les post d'agenda -->
			<?php 
				$count ++; 
				$category = get_the_category();
				
				echo '<li><a href="index.php?page_id=316&idprog=' . $category[0]->term_id . '&idpl=' . 
								$category[0]->object_id . '">' . 
								get_cat_name($category[0]->category_parent) . ' - ' . substr(get_the_title(), 0, 54) . 
						'</a>
					  </li><li><hr /></li>';
					
				// Sort si plus de 3 dates
				/*if ($count >= 10) {
					break;
				}*/
			 ?>			
		<?php endwhile; ?>
		
			</ul>

</div>