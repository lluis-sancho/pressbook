<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package	   TGM-Plugin-Activation
 * @subpackage Example
 * @version	   2.3.6
 * @author	   Thomas Griffin <thomas@thomasgriffinmedia.com>
 * @author	   Gary Jones <gamajo@gamajo.com>
 * @copyright  Copyright (c) 2012, Thomas Griffin
 * @license	   http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/includes/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function my_theme_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	tgmpa( array(

		array(
			'name'      			=> 'Advanced Custom Fields Pro',
			'slug'      			=> 'advanced-custom-fields-pro',
			'source'    			=> THEME_INCLUDES . '/plugins/advanced-custom-fields-pro.zip',
			'required'  			=> true,
			'force_activation' 		=> false
		),
		array(
			'name'      			=> 'Advanced Custom Fields: Font Awesome',
			'slug'      			=> 'advanced-custom-fields-font-awesome',
			'required'  			=> true,
			'force_activation' 		=> false
		),
		array(
			'name'     				=> 'SubSolar Novela Shortcodes',
			'slug'     				=> 'subsolar-novela-shortcodes',
			'source'   				=> THEME_INCLUDES . '/plugins/subsolar-novela-shortcodes.zip',
			'required' 				=> false,
			'force_activation' 		=> false
		),
		array(
			'name'     				=> 'Envato Market',
			'slug'     				=> 'envato-market',
			'source'   				=> THEME_INCLUDES . '/plugins/envato-market.zip',
			'required' 				=> false,
			'force_activation' 		=> false
		),
		array(
			'name'     				=> 'Subsolar Novela Book Post Type',
			'slug'     				=> 'subsolar-novela-book-post-type',
			'source'   				=> THEME_INCLUDES . '/plugins/subsolar-novela-book-post-type.zip',
			'required' 				=> false,
			'force_activation' 		=> false
		),
        array(
            'name'                  => 'Easy Digital Downloads',
            'slug'                  => 'easy-digital-downloads',
            'required'              => false,
        ),
        array(
			'name' 					=> 'Redux Framework',
			'slug' 					=> 'redux-framework',
			'required' 				=> true,
		)

	));

}