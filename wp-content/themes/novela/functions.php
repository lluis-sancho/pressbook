<?php
global $novela_data;

/*===========================================================*/
/*    Theme Initialization
/*===========================================================*/

if( ! defined('THEME_URL') ) { define('THEME_URL', get_template_directory_uri() ); }
if( ! defined('THEME_INCLUDES') ) { define('THEME_INCLUDES', get_template_directory()  . '/includes'); }

define( 'ACFGFS_API_KEY', 'AIzaSyDN9ZwsPOMFEKRPQRZn-PZ2QKyMZCetkB4' );

if ( !function_exists( 'sdesigns_init' ) ) {
	function sdesigns_init() {

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );

		register_nav_menu( 'sidebar-menu', __('Sidebar Menu', 'novela') );

		/* Thumbnails Support */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 50, 50, true );
		add_image_size( 'character-image', 250, 250, true );
		add_image_size( 'blog-thumb', 600, 600, true );
		add_image_size( 'single-blog-header', 1600, 1000, true );
		add_image_size( 'book-cover', 400, 700, true );

		add_theme_support(
			'post-formats'
			);

	}
}

add_action( 'after_setup_theme', 'sdesigns_init' );

require_once( THEME_INCLUDES . '/class-tgm-plugin-activation.php' );
require_once( THEME_INCLUDES . '/tgm-plugin-activator.php' );

// Redux Framework
require_once( THEME_INCLUDES . '/admin/options-init.php' );

include_once( THEME_INCLUDES . '/custom-fields.php');
include_once( THEME_INCLUDES . '/custom-styles.php');


/*===========================================================*/
/*    ACF
/*===========================================================*/

/**
 * Return a custom field stored by the Advanced Custom Fields plugin 
 */

if ( !function_exists( 'sdesigns_get_field' ) ) {
	function sdesigns_get_field( $key, $id=false, $default='' ) {
		global $post;
		$key = trim( filter_var( $key, FILTER_SANITIZE_STRING ) );
		$result = '';

		if ( function_exists( 'get_field' ) ) {
			if ( isset( $post->ID ) && !$id )
				$result = get_field( $key );
			else
				$result = get_field( $key, $id );

		if ( $result == '' ) // If ACF enabled but key is undefined, return default
		$result = $default;

		} else {
			$result = $default;
		}
	return $result;
}
}

if ( !function_exists( 'sdesigns_the_field' ) ) {
	function sdesigns_the_field( $key, $id=false, $default='' ) {

		$value = sdesigns_get_field($key, $id, $default);

		if( is_array($value) ) {

			$value = @implode( ', ', $value );

		}

		echo $value;
	}
}

if ( !function_exists( 'sdesigns_get_sub_field' ) ) {
	function sdesigns_get_sub_field( $key, $default='' ) {
		if ( function_exists( 'get_sub_field' ) &&  get_sub_field( $key ) )  
			return get_sub_field( $key );
		else 
			return $default;
	}
}

if ( !function_exists( 'sdesigns_the_sub_field' ) ) {
	function sdesigns_the_sub_field( $key, $default='' ) {
		$value = sdesigns_get_sub_field( $key, $default );
		echo $value;
	}
}

if ( !function_exists( 'sdesigns_has_sub_field' ) ) {
	function sdesigns_has_sub_field( $key, $id=false ) {
		if ( function_exists('has_sub_field') )
			return has_sub_field( $key, $id );
		else
			return false;
	}
}

if ( !function_exists( 'sdesigns_have_rows' ) ) {
	function sdesigns_have_rows( $key, $id=false ) {
		if ( function_exists('have_rows') )
			return have_rows( $key, $id );
		else
			return false;
	}
}

add_filter('acf/settings/show_admin', '__return_false');
add_filter('acf/settings/show_updates', '__return_false');


/*===========================================================*/
/*    ACF Sanitization
/*===========================================================*/

function sdesigns_acf_update_value( $value, $post_id, $field  )
{
	return wp_kses_post($value);
}

// add_filter('esc_attr(acf/update_value/type=wysiwyg)', 'sdesigns_acf_update_value', 10, 3);

/*===========================================================*/
/*    Content Width
/*===========================================================*/
if ( ! isset( $content_width ) )
	$content_width = 1000;


/*===========================================================*/
/*    Loading Scripts
/*===========================================================*/

if (!function_exists( 'sdesigns_register_scripts' ) ) {
	function sdesigns_register_scripts() {

		global $novela_data;


		wp_register_script( 'modernizr', get_template_directory_uri() . '/assets/js/modernizr.custom.79639.js', 'jquery', 1.0 );
		wp_register_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', 'jquery', 1.0, true );
		wp_register_script( 'mousewheel', get_template_directory_uri() . '/assets/js/jquery.mousewheel.js', 'jquery', 1.0, true );
		wp_register_script( 'jscrollpane', get_template_directory_uri() . '/assets/js/jquery.jscrollpane.min.js', 'jquery', 1.0, true );
		wp_register_script( 'jquerypp', get_template_directory_uri() . '/assets/js/jquerypp.custom.js', 'jquery', 1.0, true );
		wp_register_script( 'bookblock', get_template_directory_uri() . '/assets/js/jquery.bookblock.js', 'jquery', 1.0, true );
		wp_register_script( 'page', get_template_directory_uri() . '/assets/js/page.js', 'jquery', 1.0, true );
		wp_register_script( 'owl', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', 'jquery', 1.0, true );
		wp_register_script( 'supersized', get_template_directory_uri() . '/assets/js/supersized.3.2.7.min.js', 'jquery', 1.0 );
		wp_register_script( 'sidebar', get_template_directory_uri() . '/assets/js/slidebars.min.js', 'jquery', 1.0, true );
		wp_register_script( 'isotope', get_template_directory_uri() . '/assets/js/isotope.pkgd.min.js', 'jquery', 1.0, true );
		wp_register_script( 'debouncedresize', get_template_directory_uri() . '/assets/js/jquery.debouncedresize.js', 'jquery', 1.0, true );
		wp_register_script( 'imagesloaded', get_template_directory_uri() . '/assets/js/imagesloaded.pkgd.min.js', 'jquery', 1.0, true );
		wp_register_script( 'validation', get_template_directory_uri() . '/assets/js/jquery.validate.min.js', 'jquery', 1.0, true );
		wp_register_script( 'custom', get_template_directory_uri() . '/assets/js/scripts.js', 'jquery', '1.0', 1.0, true );

		wp_enqueue_script('jquery');
		wp_enqueue_script('modernizr');
		wp_enqueue_script('bootstrap');
		wp_enqueue_script('mousewheel');
		wp_enqueue_script('jscrollpane');
		wp_enqueue_script('jquerypp');
		wp_enqueue_script('bookblock');
		wp_enqueue_script('page');
		wp_enqueue_script('owl');
		wp_enqueue_script('supersized');
		wp_enqueue_script('sidebar');
		wp_enqueue_script('isotope');
		wp_enqueue_script('debouncedresize');
		wp_enqueue_script('imagesloaded');
		wp_enqueue_script('custom');


		/* Loading Styles */

		wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '1.0');
		wp_enqueue_style( 'jscrollpane', get_template_directory_uri() . '/assets/css/jquery.jscrollpane.custom.css', array(), '1.0');
		wp_enqueue_style( 'bookblock', get_template_directory_uri() . '/assets/css/bookblock.css', array(), '1.0');
		wp_enqueue_style( 'owl', get_template_directory_uri() . '/assets/css/owl.carousel.css', array(), '1.0');
		wp_enqueue_style( 'supersized', get_template_directory_uri() . '/assets/css/supersized.css', array(), '1.0');
		wp_enqueue_style( 'sidebars', get_template_directory_uri() . '/assets/css/slidebars.min.css', array(), '1.0');
		wp_enqueue_style( 'master', get_template_directory_uri() . '/assets/css/master.css', array(), '1.0');

		wp_localize_script( 'custom', 'sdesignsAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
	}
}

add_action('wp_enqueue_scripts', 'sdesigns_register_scripts');



if (!function_exists( 'sdesigns_get_the_content' ) ) {
	function sdesigns_get_the_content($more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
		$content = get_the_content($more_link_text, $stripteaser, $more_file);
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);
		return $content;
	}
}


function sdesigns_ajax_mail_function(){

	$name = trim($_POST['name']);
	$email = sanitize_email(trim($_POST['email']));
	$message = trim($_POST['message']);
	$to_email = sanitize_email($_POST['to_email']);

	$subject = "[".get_bloginfo('name')."] - Email From: ".$email;
	$message = "
	Name : {$name},
	Email : {$email}

	$message
	";

	$emailSent = wp_mail($to_email,$subject,$message);

	echo $emailSent;

	die();

}


add_action('wp_ajax_sdesigns_ajax_mail_function', 'sdesigns_ajax_mail_function');
add_action('wp_ajax_nopriv_sdesigns_ajax_mail_function', 'sdesigns_ajax_mail_function');


function sdesigns_ajax_bookblock_function(){

    $download_id = $_POST['id'];
    $output = '';

    if ( !empty( $download_id) ) {
    	$args = array(
    		'post_type' => 'book',
    		'posts_per_page' => -1,
    		'order' => 'ASC',
    		'meta_query' => array(
    			array(
    				'key' => 'chapter_belongs_to',
    				'value' => $download_id
				),
			)
		
		);
    } else {
    	$args = array(
    		'post_type' => 'book',
    		'posts_per_page' => -1,
    		'order' => 'ASC',
    		'meta_query' => array(
    			array(
    				'key' => 'chapter_belongs_to',
    				'value' => ' '
				),
			)
    	);
    }
  
	

	

	$the_query = new WP_Query($args);

	if ( $the_query->have_posts() ) :

	$output .= '
	<div id="book-container" class="book-container">

		<div class="menu-panel">
			<h3>' . __('Table of Contents', 'novela') . '</h3>
			<ul id="menu-toc" class="menu-toc">';

				$item_num = 1;

				while  ($the_query->have_posts()) : $the_query->the_post();

					$output .= '<li><a href="#item'. $item_num = 1 . '">' . get_the_title() .'</a></li>';

					$item_num++;

				endwhile;

			$output .= '</ul>

		</div>

		<div class="bb-custom-wrapper">
			<div id="bb-bookblock" class="bb-bookblock">' ?>

				<?php rewind_posts();

				$item_num = 1;

				?>

				<?php while  ($the_query->have_posts()) : $the_query->the_post();

					
					$output .= '<div class="bb-item" id="item' . $item_num . '">
						<div class="book-content">
							<div class="scroller">
								<h1 class="chapter-heading">' . get_the_title() . '</h1>'
								. sdesigns_get_the_content() .
							'</div>
						</div>
					</div><!-- end bb-item -->';

					$item_num++;

				endwhile; ?>

			<?php
			$output .= '</div>

			<nav>
				<span id="bb-nav-prev">&larr;</span>
				<span id="bb-nav-next">&rarr;</span>
			</nav>

			<span id="tblcontents" class="menu-button">' . __('Table of Contents', 'novela') . '</span>

			<span class="bb-nav-close"><i class="fa fa-times"></i></span>

		</div>

	</div><!-- /container -->';

endif;
wp_reset_query();

echo $output;

die();
}


add_action('wp_ajax_sdesigns_ajax_bookblock_function', 'sdesigns_ajax_bookblock_function');
add_action('wp_ajax_nopriv_sdesigns_ajax_bookblock_function', 'sdesigns_ajax_bookblock_function');



/*===========================================================*/
/*    Sidebars Initialization
/*===========================================================*/
if ( !function_exists( 'sdesigns_sidebars_init' ) ) {

	function sdesigns_sidebars_init() {
		register_sidebar(
			array(
			'name' => __('Footer Content', 'novela'),
			'description' => __('Widget area for footer.', 'novela'),
			'id' => 'footer',
			'before_widget' => '<div class="col-sm-4"><div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div></div>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
			)
		);
	}

}
add_action( 'widgets_init', 'sdesigns_sidebars_init' );



/*===========================================================*/
/*    Custom Excerpt More
/*===========================================================*/
if ( !function_exists( 'sdesigns_excerpt_more' ) ) {
	function sdesigns_excerpt_more( $more ) {
		return '...';
	}
}
add_filter('excerpt_more', 'sdesigns_excerpt_more');


/*===========================================================*/
/*    Excerpt Read More
/*===========================================================*/
if ( !function_exists( 'sdesigns_excerpt_read_more_link' ) ) {
	function sdesigns_excerpt_read_more_link($output) {
		global $post;

		return $output . '<p class="read-more-p"><a href="' . get_permalink($post->ID) . '" class="more"><i class="fa fa-arrow-right"></i>' . __('Continue Reading', 'novela') . '</a></p>';
	}
}
add_filter('the_excerpt', 'sdesigns_excerpt_read_more_link');

/*===========================================================*/
/*    Custom Read More
/*===========================================================*/

if ( !function_exists( 'sdesigns_custom_readMore' ) ) {
	function sdesigns_custom_readMore() {
		global $post;
		return '<p class="read-more-p"><a href="' . get_permalink($post->ID) . '" class="more"><i class="fa fa-arrow-right"></i>' . __('Continue Reading', 'novela') . '</a></p>';
	}
}
add_filter( 'the_content_more_link', 'sdesigns_custom_readMore' );


/*===========================================================*/
/*    Comments
/*===========================================================*/

if ( !function_exists( 'sdesigns_comments' ) ) {
	function sdesigns_comments($comment, $args, $depth) {

		$GLOBALS['comment'] = $comment; ?>

		<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
			<article class="comment-content">
				<header class="comment-header">
					<figure>
						<?php
						$avatar_size = 50;
						echo get_avatar($comment, $avatar_size); ?>
					</figure>
					<h5 class="comment-author"><?php comment_author_link(); ?></h5>
					<span class="comment-meta"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_date(); ?> - <?php comment_time(); ?></a><?php edit_comment_link(__('[Edit]', 'novela'),'  ','') ?> &middot; <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>
				</header>

				<?php if ( $comment->comment_approved == 0 ) : ?>

				<p class="awaiting-moderation alert"><?php _e('Your comment is awaiting moderation', 'novela'); ?></p>

			<?php endif; ?>

			<?php comment_text(); ?>
		</article>
		<?php

	}
}

/*===========================================================*/
/*    Pingbacks
/*===========================================================*/

if ( !function_exists( 'sdesigns_list_pings' ) ) {
	function sdesigns_list_pings($comment, $args, $depth) {

		$GLOBALS['comment'] = $comment; ?>

		<li <?php comment_class('pingback'); ?> id="comment-<?php comment_ID() ?>">
			<article class="comment-content">
				<header class="ping-header">
					<h5 class="comment-author"><?php _e('Pingback:', 'novela'); ?></h5>
					<span class="comment-meta"><?php edit_comment_link(__('[Edit]', 'novela'),'  ','') ?></span>
				</header>
				<?php comment_author_link(); ?>
			</article>
		</li>
		<?php
	}
}

/*===========================================================*/
/*	Localization
/*===========================================================*/

if ( !function_exists( 'sdesigns_theme_localization' ) ) {
	function sdesigns_theme_localization() {

		load_theme_textdomain( 'novela', get_template_directory() . '/lang' );

	}
}

add_action('after_setup_theme', 'sdesigns_theme_localization');


/*===========================================================*/
/*    Custom wp_link_pages
/*===========================================================*/

if ( !function_exists( 'sdesigns_wp_link_pages' ) ) {
	function sdesigns_wp_link_pages( $args = '' ) {
		$defaults = array(
			'before' => '<p class="link-pages" ><strong>' . __('Pages:', 'novela' ) . '</strong> ',
			'after' => '</p>',
			'text_before' => '',
			'text_after' => '',
			'next_or_number' => 'number',
			'nextpagelink' => __( 'Next page', 'novela' ),
			'previouspagelink' => __( 'Previous page', 'novela' ),
			'pagelink' => '%',
			'echo' => 1
			);

		$r = wp_parse_args( $args, $defaults );
		$r = apply_filters( 'wp_link_pages_args', $r );
		extract( $r, EXTR_SKIP );

		global $page, $numpages, $multipage, $more, $pagenow;

		$output = '';
		if ( $multipage ) {
			if ( 'number' == $next_or_number ) {
				$output .= $before;
				for ( $i = 1; $i < ( $numpages + 1 ); $i = $i + 1 ) {
					$j = str_replace( '%', $i, $pagelink );
					$output .= ' ';
					if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
						$output .= _wp_link_page( $i );
					else
						$output .= '<span class="current-post-page">';

					$output .= $text_before . $j . $text_after;
					if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
						$output .= '</a>';
					else
						$output .= '</span>';
				}
				$output .= $after;
			} else {
				if ( $more ) {
					$output .= $before;
					$i = $page - 1;
					if ( $i && $more ) {
						$output .= _wp_link_page( $i );
						$output .= $text_before . $previouspagelink . $text_after . '</a>';
					}
					$i = $page + 1;
					if ( $i <= $numpages && $more ) {
						$output .= _wp_link_page( $i );
						$output .= $text_before . $nextpagelink . $text_after . '</a>';
					}
					$output .= $after;
				}
			}
		}

		if ( $echo )
			echo $output;

		return $output;
	}
}

/*===========================================================*/
/*    Password Form
/*===========================================================*/

if ( !function_exists( 'sdesigns_password_form' ) ) {
	function sdesigns_password_form() {
		global $post;
		$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
		$output = '<form class="protected-post-form" action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post">
		' . '<p>' . __( 'This post is password protected. To view it please enter your password below:', 'novela' ) . '</p>' . '
		<label class="pass-label" for="' . $label . '">' . __( "PASSWORD:", 'novela' ) . ' </label><input name="post_password" id="' . $label . '" type="password" size="20" /><input class="pass-input button normal" type="submit" name="Submit" class="button" value="' . esc_attr__( 'Submit', 'novela' ) . '" />
		</form>
		';
		return $output;
	}
}
add_filter( 'the_password_form', 'sdesigns_password_form' );


/*===========================================================*/
/*    Fix Shortcodes Newline
/*===========================================================*/
if ( !function_exists( 'sdesigns_the_content_filter' ) ) {
	function sdesigns_the_content_filter($content) {

		// array of custom shortcodes requiring the fix
		$block = join("|",array("collapse","collapsibles", "tabs", "tab"));

		// opening tag
		$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);

		// closing tag
		$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);

		return $rep;

	}
}

add_filter('the_content', 'sdesigns_the_content_filter');

/*===========================================================*/
/*   Easy Digital Downloads
/*===========================================================*/

// Remove the standard button that shows after the download's content
remove_action( 'edd_after_download_content', 'edd_append_purchase_link' );

// Hide the payment icons at checkout when the cart total is $0.00

function sdesigns_edd_hide_payment_icons() {

	if ( function_exists('edd_get_cart_total') ) {
		$cart_total = edd_get_cart_total();

		if ( $cart_total )
			return;

		remove_action( 'edd_payment_mode_top', 'edd_show_payment_icons' );
		remove_action( 'edd_checkout_form_top', 'edd_show_payment_icons' );
	}

}
add_action( 'template_redirect', 'sdesigns_edd_hide_payment_icons' );






/*-------------------------------------------------------------------------------
	Custom Columns
-------------------------------------------------------------------------------*/

// ONLY BOOK CUSTOM TYPE POSTS
add_filter('manage_book_posts_columns', 'sdesigns_columns_head_only_books', 10);
add_action('manage_book_posts_custom_column', 'sdesigns_columns_content_only_books', 10, 2);
 
// CREATE TWO FUNCTIONS TO HANDLE THE COLUMN
function sdesigns_columns_head_only_books($defaults) {
    $defaults['chapter_belongs_to'] = __('Chapter Belongs To', 'novela');
    return $defaults;
}

function sdesigns_columns_content_only_books($column_name, $post_ID) {
    if ($column_name == 'chapter_belongs_to') {
        if( sdesigns_get_field('chapter_belongs_to') ) {
			echo get_the_title( sdesigns_get_field('chapter_belongs_to') );
		} else {
			esc_html_e('N/A', 'novela');
		}
    }
}

function sdesigns_column_register_sortable( $columns ) {
	$columns['chapter_belongs_to'] = 'chapter_belongs_to';
	return $columns;
}

add_filter("manage_edit-book_sortable_columns", "sdesigns_column_register_sortable" );


add_action( 'pre_get_posts', 'sdesigns_chapter_belongs_to_orderby' );
function sdesigns_chapter_belongs_to_orderby( $query ) {
    if( ! is_admin() )
        return;
 
    $orderby = $query->get( 'orderby');
 
    if( 'chapter_belongs_to' == $orderby ) {
        $query->set('meta_key','chapter_belongs_to');
        $query->set('orderby','meta_value_num');
    }
}