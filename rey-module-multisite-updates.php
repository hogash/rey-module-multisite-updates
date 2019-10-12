<?php
/**
 * Plugin Name: Rey Module - Multisite Updates
 * Description: This plugin allows Rey Theme & plugins to update on Multisite installations, if Rey theme isn't activated on the main site.
 * Plugin URI: http://www.reytheme.com/
 * Version: 1.0.0
 * Author: ReyTheme
 * Author URI:  https://twitter.com/mariushoria
 * Text Domain: rey-module-multisite-updates
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

if( !class_exists('ReyModuleMultisiteUpdates') ):

class ReyModuleMultisiteUpdates
{

	public function __construct()
	{
		$this->init();
	}

	private function init()
	{
		if( defined( 'REY_THEME_NAME' ) ){
			return;
		}

		define( 'REY_THEME_NAME', 'rey');
		define( 'REY_THEME_DIR', WP_CONTENT_DIR . '/themes/' . REY_THEME_NAME );
		define( 'REY_THEME_URI', WP_CONTENT_URL . '/themes/' . REY_THEME_NAME );
		define( 'REY_THEME_PLACEHOLDER', REY_THEME_URI . '/images/placeholder.png');
		define( 'REY_THEME_CORE_SLUG', 'rey-core');

		// Get version
		$theme = wp_get_theme( REY_THEME_NAME, WP_CONTENT_DIR . '/themes' );

		if( $theme->get('Version') ){
			define( 'REY_THEME_VERSION', $theme->get('Version') );
		}
		else {
			return;
		}

		require_once REY_THEME_DIR . '/inc/core/functions.php';
		require_once REY_THEME_DIR . '/inc/core/api.php';
		require_once REY_THEME_DIR . '/inc/core/admin.php';
		require_once REY_THEME_DIR . '/inc/core/plugins.php';
		require_once REY_THEME_DIR . '/inc/core/updates.php';
	}

}
new ReyModuleMultisiteUpdates();

endif;
