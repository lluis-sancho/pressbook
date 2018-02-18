<?php
global $novela_data;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />


	<!-- Favicon -->
	<?php
	if ( !empty($novela_data['custom-favicon']['url']) ):
	?>
		<link rel="shortcut icon" href="<?php echo esc_url($novela_data['custom-favicon']['url']); ?>">
	<?php endif; ?>

	 <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>

	<?php wp_head(); ?>
</head>
<body <?php body_class();?>>

<div class="header">

	<a id="toggle-menu" class="toggle-menu-hidden" >
		<div>
			<span class="top"></span>
			<span class="middle"></span>
			<span class="bottom"></span>
		</div>
	</a>

</div><!-- end header -->

<div class="sb-slidebar sb-right sb-style-overlay">

<?php if ( !empty($novela_data['custom-logo']['url'] )): ?>

	<div class="logo">
		<img src="<?php echo esc_url($novela_data['custom-logo']['url']); ?>" alt="<?php bloginfo('name'); ?>">
	</div>

<?php else : ?>

	<div class="logo">
		<h1 class="logo-title"><?php bloginfo('name'); ?></h1>
	</div>

<?php endif; //logo check ?>

<?php

	if ( has_nav_menu('sidebar-menu') ) {
		wp_nav_menu( array(
			'theme_location'  => 'sidebar-menu',
			'menu_class'      => 'nav-menu'
		));
	}
?>

</div><!-- end sidr -->

<div class="main-content" id="sb-site">