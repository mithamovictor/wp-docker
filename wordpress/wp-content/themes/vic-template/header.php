<?php
/**
 * Author: Karungaru Technologies
 * Author URI: https://www.karungarutechnologies.com
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package theme
 *
 */

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php bloginfo('title'); ?></title>

		<link rel="apple-touch-icon" sizes="180x180" href="<?php // echo get_stylesheet_directory_uri() . '/dist/assets/img/favicon/apple-touch-icon.png' ?>">
		<link rel="icon" type="image/png" sizes="32x32" href="<?php // echo get_stylesheet_directory_uri() . '/dist/assets/img/favicon/favicon-32x32.png' ?>">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php // echo get_stylesheet_directory_uri() . '/dist/assets/img/favicon/favicon-16x16.png' ?>">
		<link rel="manifest" href="<?php // echo get_stylesheet_directory_uri() . '/dist/assets/img/favicon/site.webmanifest' ?>">
		<link rel="mask-icon" href="<?php // echo get_stylesheet_directory_uri() . '/dist/assets/img/favicon/safari-pinned-tab.svg' ?>" color="#1e1616">
		<meta name="msapplication-TileColor" content="#fefefe">
		<meta name="theme-color" content="#fefefe">

		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<!--[if lt IE 7]>
		<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->

		<div class="main-content"> <!-- Start of main-content -->
			<header>  <!-- Start of header -->
				<div class="logo-container"><?php
					the_custom_logo(); ?>
					<div class="menu-button">
						<span class="mobile-button" onclick="openNav()">&#9776;</span>
					</div>
				</div><?php
				wp_nav_menu(
					[
						'theme_location'  => 'desktop_menu',
						'menu_class'      => 'menu',
						'container'       => 'nav',
						'container_class' => 'menu-desktop'
          ]
				); ?>
			</header>  <!-- End of header -->
