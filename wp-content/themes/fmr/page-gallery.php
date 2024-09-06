<?php 
/** 
 * @package WordPress 
 * @subpackage FMR 
 */ 
/*
Template Name: Page Galerie
*/

get_header(); 


?>

<link rel="stylesheet" href="wp-content/themes/fmr/css/galleriffic-2.css" type="text/css" />
<script type="text/javascript" src="wp-content/themes/fmr/js/jquery-1.3.2.js"></script>
<script type="text/javascript" src="wp-content/themes/fmr/js/jquery.galleriffic.js"></script>
<script type="text/javascript" src="wp-content/themes/fmr/js/jquery.opacityrollover.js"></script>

<div id="main">
	<div id="leftcontent" role="main">
		<div id="actuHeader">
		
			<h2 id="actuTitle">GALERIE</h2>
			<h3 id="galTitle"><?php the_title(); ?></h3>
			
		</div>
		<a href="index.php?page_id=55">[retour &agrave la page Fmr]</a> - <a href="index.php?page_id=97">[retour aux galeries]</a>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="entry">

				<!-- Start Advanced Gallery Html Containers -->
				<div id="thumbs" class="navigation">
					<ul class="thumbs noscript">

					<?php 
						attachment_toolbox(array(50,50));
					?>

					</ul>
				</div>
			</div>
		<?php endwhile; endif; ?>

	</div>

	<script type="text/javascript">
		jQuery(document).ready(function($) {
			// We only want these styles applied when javascript is enabled
			$('div.navigation').css({'width' : '440px', 'float' : 'left'});
			$('div.content').css('display', 'block');

			// Initially set opacity on thumbs and add
			// additional styling for hover effect on thumbs
			var onMouseOutOpacity = 0.67;
			$('#thumbs ul.thumbs li').opacityrollover({
				mouseOutOpacity:   onMouseOutOpacity,
				mouseOverOpacity:  1.0,
				fadeSpeed:         'fast',
				exemptionSelector: '.selected'
			});
			
			// Initialize Advanced Galleriffic Gallery
			var gallery = $('#thumbs').galleriffic({
				delay:                     2500,
				numThumbs:                 15,
				preloadAhead:              10,
				enableTopPager:            true,
				enableBottomPager:         true,
				maxPagesToShow:            7,
				imageContainerSel:         '#slideshow',
				controlsContainerSel:      '#controls',
				captionContainerSel:       '#caption',
				loadingContainerSel:       '#loading',
				renderSSControls:          true,
				renderNavControls:         true,
				playLinkText:              'Play Slideshow',
				pauseLinkText:             'Pause Slideshow',
				prevLinkText:              '[pr&eacute;c&eacute;dente]',
				nextLinkText:              '[suivante]',
				nextPageLinkText:          'Next &rsaquo;',
				prevPageLinkText:          '&lsaquo; Prev',
				enableHistory:             false,
				autoStart:                 false,
				syncTransitions:           true,
				defaultTransitionDuration: 900,
				onSlideChange:             function(prevIndex, nextIndex) {
					// 'this' refers to the gallery, which is an extension of $('#thumbs')
					this.find('ul.thumbs').children()
						.eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
						.eq(nextIndex).fadeTo('fast', 1.0);
				},
				onPageTransitionOut:       function(callback) {
					this.fadeTo('fast', 0.0, callback);
				},
				onPageTransitionIn:        function() {
					this.fadeTo('fast', 1.0);
				}
			});
		});
	</script>

<?php get_sidebar('gallery'); ?>
	
<div class="clear"></div>

<?php get_footer(); ?>