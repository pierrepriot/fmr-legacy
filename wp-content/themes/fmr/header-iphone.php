<?php 
/** 
 * @package WordPress 
 * @subpackage Default_Theme 
 */ 
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=UTF-8" />
	<title><?php wp_title('&laquo;', true, 'right'); ?> Radio FMR</title>
<!--base href="http:/localhost/wp-fmr/"--><base href="http://radio-fmr.net/" />
	<link rel="stylesheet" href="https://radio-fmr.net/wp-content/themes/fmr/style.css" type="text/css" media="screen" />
	<!-- link rel="pingback" href="<php bloginfo('pingback_url'); ?>" /-->
	<link rel="shortcut icon" type="images/x-icon" href="favicon.ico">
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?> 

	<?php wp_head(); ?>
</head>
	<?php flush(); ?>
<body <?php body_class(); ?>
		

