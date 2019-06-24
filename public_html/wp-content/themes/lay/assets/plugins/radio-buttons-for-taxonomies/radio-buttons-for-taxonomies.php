<?php
/*
Plugin Name: Radio Buttons for Taxonomies
Plugin URI: http://www.kathyisawesome.com/441/radio-buttons-for-taxonomies
Description: Use radio buttons for any taxonomy so users can only select 1 term at a time
Version: 1.7.6
Text Domain: radio-buttons-for-taxonomies
Author: Kathy Darling
Author URI: http://www.kathyisawesome.com
License: GPL2
Text Domain: radio-buttons-for-taxonomies

Copyright 2015  Kathy Darling  (email: kathy.darling@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*
This is a plugin implementation of the wp.tuts+ tutorial: http://wp.tutsplus.com/tutorials/creative-coding/how-to-use-radio-buttons-with-taxonomies/ by Stephen Harris
Stephen Harris http://profiles.wordpress.org/stephenh1988/

To use this plugin, just activate it and go to the settings page.  Then Check the taxonomies that you'd like to switch to using Radio Buttons and save the settings.
*/

if ( ! class_exists( 'Radio_Buttons_for_Taxonomies' ) ) :

class Radio_Buttons_for_Taxonomies {

	/**
	 * @var Radio_Buttons_for_Taxonomies The single instance of the class
	 * @since 1.6.0
	 */
	protected static $_instance = null;

	/**
	 * @var version
	 * @since 1.7.0
	 */
	static $version = '1.7.6';

	/**
	 * @var plugin options
	 * @since 1.7.0
	 */
	public $options = array();

	/**
	 * @var taxonomies WordPress_Radio_Taxonomy instances as an array, keyed on taxonomy name.
	 * @since 1.7.0
	 */
	public $taxonomies = array();

	/**
	 * Main Radio_Buttons_for_Taxonomies Instance
	 *
	 * Ensures only one instance of Radio_Buttons_for_Taxonomies is loaded or can be loaded.
	 *
	 * @since 1.6.0
	 * @static
	 * @see Radio_Buttons_for_Taxonomies()
	 * @return Radio_Buttons_for_Taxonomies - Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.6.0
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' , 'radio-buttons-for-taxonomies' ), '1.6' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.6.0
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' , 'radio-buttons-for-taxonomies' ), '1.6' );
	}

	/**
	 * Radio_Buttons_for_Taxonomies Constructor.
	 * @access public
	 * @return Radio_Buttons_for_Taxonomies
	 * @since  1.0
	 */
	public function __construct(){

			// Include required files
			include_once( 'inc/class.WordPress_Radio_Taxonomy.php' );
			include_once( 'inc/class.Walker_Category_Radio.php' );

			$this->options = get_option( 'radio_button_for_taxonomies_options', true );

			// launch each taxonomy class when tax is registered
			add_action( 'registered_taxonomy', array( $this, 'launch' ) );

			// Load admin scripts
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_script' ) );
	}

	/**
	 * For each taxonomy that we are converting to radio buttons, store in taxonomies class property, ex: $this->taxonomies[categories]
	 * @access public
	 * @return object
	 * @since  1.0
	 */
	public function launch( $taxonomy ){
		if($taxonomy == "category"){
			$this->taxonomies[$taxonomy] = new WordPress_Radio_Taxonomy( $taxonomy );
		}
	}

	/**
	 * Enqueue Scripts
	 * @access public
	 * @return void
	 * @since  1.0
	 */
	public function admin_script( $hook ){
		if( in_array( $hook, array( 'edit.php', 'post.php', 'post-new.php' ) ) ){
			wp_enqueue_script( 'radiotax', get_template_directory_uri().'/assets/plugins/radio-buttons-for-taxonomies/js/radiotax.min.js', array( 'jquery', 'inline-edit-post' ), self::$version, true );
		}
	}

	// ------------------------------------------------------------------------------
	// Helper Functions
	// ------------------------------------------------------------------------------

	/**
	 * Get all taxonomies - for plugin options checklist
	 * @access public
	 * @return array
	 * @since  1.7
	 */
	function get_all_taxonomies() {

		$args = array (
			'public'   => true,
			'show_ui'  => true,
			'_builtin' => true
		);

		$defaults = get_taxonomies( $args, 'objects' );

		$args['_builtin'] = false;

		$custom = get_taxonomies( $args, 'objects' );

		$taxonomies = apply_filters( 'radio_buttons_for_taxonomies_taxonomies', array_merge( $defaults, $custom ) );

		ksort( $taxonomies );

		return $taxonomies;
	}



} // end class
endif;


/**
 * Launch the whole plugin
 * Returns the main instance of WC to prevent the need to use globals.
 *
 * @since  1.6
 * @return Radio_Buttons_for_Taxonomies
 */
function Radio_Buttons_for_Taxonomies() {
	return Radio_Buttons_for_Taxonomies::instance();
}

// Global for backwards compatibility.
$GLOBALS['Radio_Buttons_for_Taxonomies'] = Radio_Buttons_for_Taxonomies();