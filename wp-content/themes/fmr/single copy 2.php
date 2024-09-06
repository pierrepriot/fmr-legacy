<?php 
/** 
 * @package WordPress 
 * @subpackage Default_Theme 
 */

get_header(); ?>

<div id="main">
	
	Le commentaire est post&eacute;, il sera en ligne tr&egrave;s prochainement.<br /><br />
	
	<div id="leftcontent" role="main">
			<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Retour &agrave; la page précedente</a>
	</div>


<?php get_sidebar('news'); ?>

<div class="clear"></div>

<?php get_footer(); ?>