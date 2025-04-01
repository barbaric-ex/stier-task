<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php wp_title(''); ?><?php if (wp_title('', false)) {
										echo ' :';
									} ?> <?php bloginfo('name'); ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>">
	<meta property="og:title" content="<?php echo get_bloginfo('name'); ?>" />
	<meta property="og:image" itemprop="image" content="<?php echo get_template_directory_uri(); ?>/img/og-img.jpg">
	<meta property="og:type" content="website" />

	<?php wp_head(); ?>
</head>

<body id="page-top" <?php body_class(); ?>>
	<div class="page-wrap">