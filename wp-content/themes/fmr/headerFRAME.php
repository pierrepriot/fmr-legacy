<?php 
/** 
 * @package WordPress 
 * @subpackage Default_Theme 
 */ 
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
	<base href="http:/localhost/"><!-- base href="http://radio-fmr.net/soon/" -->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="shortcut icon" type="images/x-icon" href="favicon.ico">
	<!-- link href="param/css/shared.css" rel="stylesheet" type="text/css" -->
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?> 

	<?php wp_head(); ?>
</head>
<?php flush(); ?>
<body <?php body_class(); ?>>

	<a name="top"></a>
	<br />
	<br />
	<br />
	<br />

		<!-- div id="header" role="banner">
			<ul id="menu">
				<li><a href="index.php" class="aheader">ACCUEIL</a></li>
				<li>•</li>
				<li><a href="index.php?page_id=55" class="aheader">FMR</a></li>
				<li>•</li>
				<li><a href="index.php?page_id=129" class="aheader">PROGRAMMES</a></li>
				<li>•</li>
				<li><a href="" class="aheader">PODCASTS</a></li>
				<li>•</li>
				<li><a href="index.php?page_id=60" class="aheader">STREAM</a></li>
				<li>•</li>
				<li><a href="" class="aheader">PLAYLISTS</a></li>
				<li>•</li>
				<li><a href="" class="aheader">AGENDA</a></li>
				<li>•</li>
				<li><a href="index.php?page_id=64" class="aheader">PARTENAIRES</a></li>
				<li>•</li>
				<li><a href="index.php?page_id=74" class="aheader">SHOP</a></li>
				<li>•</li>
				<li><a href="index.php?page_id=76" class="aheader">CONTACTS</a></li>
			</ul>
			<img id="logo" src="param/pix/shared/logofmr.png" alt="FMR" title="FMR" />
		</div -->
		

