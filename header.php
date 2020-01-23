<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<link href="https://fonts.googleapis.com/css?family=Inconsolata|Roboto:300&display=swap" rel="stylesheet">

		<?php wp_head(); ?>

	</head>
	<body <?php body_class(); ?>>

		<?php if(!is_front_page()): ?>
		<div id="top_nav">
			<div class="btnMenu">
				<div class="linea"></div>
				<div class="linea"></div>
				<div class="linea"></div>
			</div>

			<div class="sideMenu">
				<?php get_sidebar() ?>
			</div>

			<a href="<?php echo get_blogInfo('url') ?>" class="logo"></a>
		</div>
		<?php endif; ?>

		<!-- wrapper -->
		<div class="wrapper">
