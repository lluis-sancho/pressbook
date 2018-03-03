<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html <?php language_attributes(); ?> class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]> <html <?php language_attributes(); ?> class="no-js"> <![endif]-->
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="https://html5shim.googlecode.com/svn/trunk/html5.js">
	  </script>
	<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="shortcut icon" href="<?php bloginfo( 'stylesheet_directory' ); ?>/favicon.ico" />
<title><?php
	global $page, $paged;
	wp_title( '|', true, 'right' );
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
if ( $site_description && ( is_home() || is_front_page() ) ) {
	echo " | $site_description";
}

	// Add a page number if necessary:
if ( $paged >= 2 || $page >= 2 ) {
	echo ' | ' . sprintf( __( 'Page %s', 'pressbooks-book' ), max( $paged, $page ) );
}

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>
    <link rel="stylesheet" href="<?php bloginfo( 'template_directory' ); ?>/assets/book/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php bloginfo( 'template_directory' ); ?>/assets/book/css/jquery.jscrollpane.custom.css" />
    <link rel="stylesheet" href="<?php bloginfo( 'template_directory' ); ?>/assets/book/css/bookblock.css" />
    <link rel="stylesheet" href="<?php bloginfo( 'template_directory' ); ?>/assets/book/css/owl.carousel.css" />
    <link rel="stylesheet" href="<?php bloginfo( 'template_directory' ); ?>/assets/book/css/supersized.css" />
    <link rel="stylesheet" href="<?php bloginfo( 'template_directory' ); ?>/assets/book/css/slidebars.min.css" />
    <link rel="stylesheet" href="<?php bloginfo( 'template_directory' ); ?>/assets/book/css/master.css?id=33" />

    <script src="<?php bloginfo('template_directory'); ?>/assets/book/js/modernizr.custom.79639.js"> </script>
    <script src="<?php bloginfo('template_directory'); ?>/assets/book/js/bootstrap.min.js"> </script>
    <script src="<?php bloginfo('template_directory'); ?>/assets/book/js/jquery.mousewheel.js"> </script>
    <script src="<?php bloginfo('template_directory'); ?>/assets/book/js/jquery.jscrollpane.min.js"> </script>
    <script src="<?php bloginfo('template_directory'); ?>/assets/book/js/jquerypp.custom.js"> </script>
    <script src="<?php bloginfo('template_directory'); ?>/assets/book/js/jquery.bookblock.js"> </script>
    <script src="<?php bloginfo('template_directory'); ?>/assets/book/js/page.js"> </script>
    <script src="<?php bloginfo('template_directory'); ?>/assets/book/js/owl.carousel.min.js"> </script>
    <script src="<?php bloginfo('template_directory'); ?>/assets/book/js/supersized.3.2.7.min.js"> </script>
    <script src="<?php bloginfo('template_directory'); ?>/assets/book/js/slidebars.min.js"> </script>
    <script src="<?php bloginfo('template_directory'); ?>/assets/book/js/isotope.pkgd.min.js"> </script>
    <script src="<?php bloginfo('template_directory'); ?>/assets/book/js/jquery.debouncedresize.js"> </script>
    <script src="<?php bloginfo('template_directory'); ?>/assets/book/js/imagesloaded.pkgd.min.js"> </script>
    <script src="<?php bloginfo('template_directory'); ?>/assets/book/js/jquery.validate.min.js"> </script>
    <script src="<?php bloginfo('template_directory'); ?>/assets/book/js/scripts.js"> </script>

</head>
<?php if ( is_front_page() ) {
	$schema = 'itemscope itemtype="http://schema.org/Book" itemref="about alternativeHeadline author copyrightHolder copyrightYear datePublished description editor image inLanguage keywords publisher" ';
} else {
	$schema = 'itemscope itemtype="http://schema.org/WebPage" itemref="about copyrightHolder copyrightYear inLanguage publisher" ';
} ?>
<body <?php body_class();
if ( wp_title( '', false ) !== '' ) { print ' id="' . str_replace( ' ', '', strtolower( wp_title( '', false ) ) ) . '"'; } ?> <?php echo $schema; ?>>
<?php if ( pb_social_media_enabled() ) { ?>
	<!-- Faccebook share js sdk -->
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, "script", "facebook-jssdk"));</script>
<?php } ?>

<?php get_template_part( 'content', 'accessibility-toolbar' ); ?>

		<?php if ( is_front_page() ) :?>

		 <!-- home page wrap -->
		 <div class="book-info-container">

		<?php else : ?>
		<div class="nav-container">
				<nav>

					 <!-- Book Title -->
					<?php $metadata = pb_get_book_information(); ?>
					<h1 class="book-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?> - <?php echo $metadata['pb_subtitle'] ?></a></h1>

						<div class="sub-nav-left">
							<!-- Logo -->
							<h2 class="pressbooks-logo"><a href="<?php echo esc_url( network_home_url() ); ?>">Tecmerin</a></h2>
						</div> <!-- end .sub-nav-left -->

				<div class="sub-nav-right">

						<?php if ( array_filter( get_option( 'pressbooks_ecommerce_links', [] ) ) ) : ?>
						<!-- Buy -->
						<div class="buy">
							<a href="<?php echo get_option( 'home' ); ?>/buy" class="button-red"><?php _e( 'Buy', 'pressbooks-book' ); ?></a>
						</div>
						<?php endif; ?>

				</div> <!-- end .sub-nav-right -->
			</nav>

			  <!-- <div class="sub-nav"> -->
					<?#php get_search_form(); ?>
				<!-- Author Name -->
				<!-- <div class="author-wrap"> -->
					<?php# $metadata = pb_get_book_information(); ?>
					<?php# if ( ! empty( $metadata['pb_author'] ) ) : ?>
					 <!-- <h3><?php echo $metadata['pb_author']; ?></h3> -->
						<?php# endif; ?>
				 <!-- </div> end .author-name -->

			  <!-- </div>end sub-nav -->


		</div> <!-- end .nav-container -->

<div class="main-content" id="sb-site" style="min-height: 360px;">		
	<div id="book-container" class="book-container" style="margin-top: 40px;">
		<div class="menu-panel">
			<h3>Indice</h3>
			<ul id="menu-toc" class="menu-toc">
						<!-- Pop out TOC only on READ pages -->
		<?php if ( is_single() ) : ?>
		<?php $book = pb_get_book_structure(); ?>
						<?php foreach ( $book['front-matter'] as $fm ) : ?>
						<?php if ( $fm['post_status'] !== 'publish' ) {
							if ( ! current_user_can_for_blog( $blog_id, 'read_private_posts' ) ) {
								if ( current_user_can_for_blog( $blog_id, 'read' ) ) {
									if ( absint( get_option( 'permissive_private_content' ) ) !== 1 ) { continue; // Skip
									}
								} elseif ( ! current_user_can_for_blog( $blog_id, 'read' ) ) {
									 continue; // Skip
								}
							}
} ?>
						<li class="front-matter <?php echo pb_get_section_type( get_post( $fm['ID'] ) ); echo (get_the_ID() === $fm['ID'] ? ' menu-toc-current' : '');  ?>"><a href="#item1"><?php echo pb_strip_br( $fm['post_title'] );?></a>
				<?php if ( pb_should_parse_subsections() ) {
					$sections = pb_get_subsections( $fm['ID'] );
					if ( $sections ) {
						  $s = 1; ?>
							<?php foreach ( $sections as $id => $name ) { ?>
					  <li class="section"><a href="#item1"><?php echo $name; ?></a></li>
					<?php } ?>
						<?php }
} ?>
						</li>
						<?php endforeach; ?>
				<?php foreach ( $book['part'] as $part ) :?>
				<li><?php if ( count( $book['part'] ) > 1 && get_post_meta( $part['ID'], 'pb_part_invisible', true ) !== 'on' ) { ?>
				<?php if ( $part['has_post_content'] ) { ?><a href="#item1"><?php } ?>
				<?php echo $part['post_title']; ?>
				<?php if ( $part['has_post_content'] ) { ?></a><?php } ?>
				<?php } ?></li>
						<?php foreach ( $part['chapters'] as $chapter ) : ?>
							<?php if ( $chapter['post_status'] !== 'publish' ) {
								if ( ! current_user_can_for_blog( $blog_id, 'read_private_posts' ) ) {
									if ( current_user_can_for_blog( $blog_id, 'read' ) ) {
										if ( absint( get_option( 'permissive_private_content' ) ) !== 1 ) { continue; // Skip
										}
									} elseif ( ! current_user_can_for_blog( $blog_id, 'read' ) ) {
										 continue; // Skip
									}
								}
} ?>
							<li class="chapter <?php echo pb_get_section_type( get_post( $chapter['ID'] ) );?>"><a href="#item1">
								<?php echo pb_strip_br( $chapter['post_title'] ); ?></a>
				<?php if ( pb_should_parse_subsections() ) {
					$sections = pb_get_subsections( $chapter['ID'] );
					if ( $sections ) {
						$s = 1; ?>
							<?php foreach ( $sections as $id => $name ) { ?>
						<li class="section"><a href="#item1"><?php echo $name; ?></a></li>
						<?php } ?>
						<?php }
} ?>
							</li>
						<?php endforeach; ?>
				<?php endforeach; ?>
						<?php foreach ( $book['back-matter'] as $bm ) : ?>
						<?php if ( $bm['post_status'] !== 'publish' ) {
							if ( ! current_user_can_for_blog( $blog_id, 'read_private_posts' ) ) {
								if ( current_user_can_for_blog( $blog_id, 'read' ) ) {
									if ( absint( get_option( 'permissive_private_content' ) ) !== 1 ) { continue; // Skip
									}
								} elseif ( ! current_user_can_for_blog( $blog_id, 'read' ) ) {
									 continue; // Skip
								}
							}
} ?>
						<li class="back-matter <?php echo pb_get_section_type( get_post( $bm['ID'] ) ) ?>"><a href="#item1"><?php echo pb_strip_br( $bm['post_title'] );?></a>
				<?php if ( pb_should_parse_subsections() ) {
					$sections = pb_get_subsections( $bm['ID'] );
					if ( $sections ) {
						  $s = 1; ?>
							<?php foreach ( $sections as $id => $name ) { ?>
					  <li class="section"><a href="#item1"><?php echo $name; ?></a></li>
					<?php } ?>
						<?php }
} ?>
						</li>
						<?php endforeach; ?>
		<?php endif; ?>
			</ul>


		</div>
		<?php endif; ?>
