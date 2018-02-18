<?php
/*
Plugin Name: SubSolar Novela Book Post Type
Description: Adds Books post type for the Novela theme.
Version: 1.0
Author: SubSolar Designs
Author URI: http://www.subsolardesigns.com
*/


add_action( 'init', 'sdesigns_register_book_post_type' );

if (!function_exists('sdesigns_register_book_post_type')) {
	function sdesigns_register_book_post_type() {

		register_post_type( 'book',
			array(
				'labels' => array(
					'name' =>  __('Book Chapters', 'novela'),
					'singular_name' => __('Chapter', 'novela'),
					'add_new_item'  => __( 'New Chapter', 'novela' )
					),
				'public' => true,
				'supports' => array('title','editor','thumbnail'),
				'rewrite' => array(
					'slug' => 'book',
					'with_front' => true
					)
				)
			);
	}
}


?>