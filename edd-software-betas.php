<?php
/*
Plugin Name: Easy Digital Downloads - Software Betas
Plugin URI: https://filament-studios.com
Description: Allows stores to provide easy access of Beta versions to purchasing customers
Version: 0.1
Author: Filament Studios
Author URI: http://filament-studios.com
Text Domain: edd-bf-txt
*/
define( 'EDD_SB_PATH', plugin_dir_path( __FILE__ ) );
define( 'EDD_SB_VERSION', '0.1' );
define( 'EDD_SB_FILE', plugin_basename( __FILE__ ) );
define( 'EDD_SB_URL', plugins_url( '/', EDD_SB_FILE ) );

class EDDSoftwareBetas {
	private static $edd_sb_instance;

	private function __construct() {
		$this->includes();
	}

	/**
	 * Get the singleton instance of our plugin
	 * @return class The Instance
	 * @access public
	 */
	public static function getInstance() {
		if ( !self::$edd_sb_instance ) {
			self::$edd_sb_instance = new EDDSoftwareBetas();
		}

		return self::$edd_sb_instance;
	}

	private function includes() {
		if ( is_admin() ) {
			include_once( EDD_SB_PATH . 'admin/metaboxes.php' );
		}
	}
}

EDDSoftwareBetas::getInstance();