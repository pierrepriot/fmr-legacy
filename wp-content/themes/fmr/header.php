<?php 
/** 
 * @package WordPress 
 * @subpackage Default_Theme 
 */ 
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="fr-FR">

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?php wp_title('&laquo;', true, 'right'); ?> Radio FMR</title>
	<base href="https://radio-fmr.net/">
	<link rel="stylesheet" href="https://radio-fmr.net/wp-content/themes/fmr/style.css" type="text/css" media="screen" />
	<link rel="shortcut icon" type="images/x-icon" href="favicon.ico">
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?> 

	<?php wp_head(); ?>
	
	<script type="text/javascript" src="https://radio-fmr.net/wp-content/themes/fmr/js/default.js"></script>
</head>
	<?php flush(); ?>
<body <?php body_class(); ?>

	<a name="top"></a>

		<div id="header" role="banner">
			<ul id="menu">
				<li><a href="index.php" class="aheader">ACCUEIL</a></li>
				<li>•</li>
				<li><a href="index.php?page_id=55" class="aheader">FMR</a></li>
				<li>•</li>
				<li><a href="index.php?page_id=129" class="aheader">PROGRAMMES</a></li>
				<li>•</li>
				<li><a href="index.php?page_id=314" class="aheader">PODCASTS</a></li>
				<li>•</li>
				<li><a href="index.php?page_id=60" class="aheader">STREAM</a></li>
				<li>•</li>
				<li><a href="index.php?page_id=241" class="aheader">PLAYLISTS</a></li>
				<li>•</li>
				<li><a href="index.php?page_id=208" class="aheader">AGENDA</a></li>
				<li>•</li>
				<li><a href="index.php?page_id=64" class="aheader">PARTENAIRES</a></li>
				<li>•</li>
				<li><a href="index.php?page_id=74" class="aheader">SHOP</a></li>
				<li>•</li>
				<li><a href="index.php?page_id=76" class="aheader">CONTACTS</a></li>
			</ul>
			<div style="float:left;"><img id="logo" src="param/pix/shared/logofmr.png" alt="FMR" title="FMR" /></div>
			<div style="float:right;text-align:right;">
				<INPUT TYPE="image" id="radio" src="param/pix/shared/player.png" NAME="but" 
					VALUE="Afficher le player" onclick='OuvrirPop("https://radio-fmr.net/wp-content/themes/fmr/jplayer/index.htm", "fencent", 10,10,520,80, 					"toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,")'>
				<br /><br />
				<a href="https://www.facebook.com/pages/FMR/75835941957" target="_blank">
					<img class="social" src="param/pix/shared/f.png" alt="facebook Radio FMR" title="facebook Radio FMR" /></a>
				<a href="https://twitter.com/#!/RADIOFMR" target="_blank">
					<img class="social" src="param/pix/shared/t.png" alt="twitter Radio FMR" title="twitter Radio FMR" /></a>
				<a href="https://www.myspace.com/radiofmr" target="_blank">
					<img class="social" src="param/pix/shared/m.png" alt="myspace Radio FMR" title="myspace Radio FMR" /></a>
				<br />
				<a href="http://smeuh.org:8000/radio-fmr.mp3" target="_blank" style="margin-right:23px">Lien direct = http://smeuh.org:8000/radio-fmr.mp3</a>
			</div>
		</div>
		

