<?php

global $post;
$td = get_template_directory_uri();

?>
<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />

		<!--TODO: replace -->
		<link rel="icon" type="image/png" sizes="192x192" href="<?=$td?>/img/favicons/android-chrome-192x192.png" />

		<!-- iOS Meta Tags -->
		<link rel="apple-touch-icon" sizes="57x57" href="<?=$td?>/img/favicons/apple-touch-icon-57x57.png" />
		<link rel="apple-touch-icon" sizes="60x60" href="<?=$td?>/img/favicons/apple-touch-icon-60x60.png" />
		<link rel="apple-touch-icon" sizes="72x72" href="<?=$td?>/img/favicons/apple-touch-icon-72x72.png" />
		<link rel="apple-touch-icon" sizes="76x76" href="<?=$td?>/img/favicons/apple-touch-icon-76x76.png" />
		<link rel="apple-touch-icon" sizes="114x114" href="<?=$td?>/img/favicons/apple-touch-icon-114x114.png" />
		<link rel="apple-touch-icon" sizes="120x120" href="<?=$td?>/img/faviconsapple-touch-icon-120x120.png" />
		<link rel="apple-touch-icon" sizes="144x144" href="<?=$td?>/img/favicons/apple-touch-icon-144x144.png" />
		<link rel="apple-touch-icon" sizes="152x152" href="<?=$td?>/img/favicons/apple-touch-icon-152x152.png" />
		<link rel="apple-touch-icon" sizes="180x180" href="<?=$td?>/img/favicons/apple-touch-icon-180x180.png" />

		<link rel="icon" type="image/png" sizes="32x32" href="<?=$td?>/img/favicons/favicon-32x32.png" />
		<link rel="icon" type="image/png" sizes="16x16" href="<?=$td?>/img/favicons/favicon-16x16.png" />

		<link rel="shortcut icon" href="<?=$td?>/img/favicons/favicon.ico" />

    <?php wp_head() ?>
</head>
<body id="page-top">
	<header>
		<nav class="navbar navbar-expand-lg bg-white fixed-top" id="mainNav">
			<div class="container">
				<a class="navbar-brand js-scroll-trigger" href="<?=get_site_url()?>"><?php
					$logo = get_theme_mod('custom_logo');
					$logo = wp_get_attachment_image_src($logo , 'full');
					if (has_custom_logo() ) {
						echo '<img src="'. esc_url( $logo[0] ) .'" class="fi-logo">';
					} else {
						echo '<h1 class="logo">'. get_bloginfo( 'name' ) .'</h1>';
					}?>
				</a>
				<button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
					Menu
					<i class="fa fa-bars"></i>
				</button>
				<div class="collapse navbar-collapse" id="navbarResponsive">
					 <?php
							/*$menu = wp_nav_menu([
									'menu' => 'Header',
									'menu_class' => 'navbar-nav mx-auto ml-auto mt-1',
									'container' => '',
									'container_class' => '',
									'container_id' => '',
									'walker' => new BC\Walker\Header
								]);*/
						 ?>
						 <ul class="nav navbar-nav pull-right fi-socials mt-4">

						 </ul>
			  </div>
			</div>
		</nav>
	</header>
	<main>
