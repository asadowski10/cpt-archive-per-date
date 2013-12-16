<?php
/*
  Plugin Name: CPT Archive Per Date
  Version: 0.1
  Plugin URI: https://github.com/asadowski10/cpt-archive-per-date
  Description: Add rewrite rules to WP for archive per date for all post_types
  Author: Alexandre Sadowski
  Author URI: http://www.beapi.fr
  Domain Path: languages
  Network: false
  Text Domain: cpt-apd

  ----

  Copyright 2013 Alexandre Sadowski (asadowski@beapi.fr)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

// don't load directly
if ( !defined( 'ABSPATH' ) )
	die( '-1' );

// Plugin constants
define( 'CPT_APD_VERSION', '0.1' );

// Plugin URL and PATH
define( 'CPT_APD_URL', plugin_dir_url( __FILE__ ) );
define( 'CPT_APD_DIR', plugin_dir_path( __FILE__ ) );

// Function for easy load files
function _cpt_apd_load_files( $dir, $files, $prefix = '' ) {
	foreach ( $files as $file ) {
		if ( is_file( $dir . $prefix . $file . ".php" ) ) {
			require_once($dir . $prefix . $file . ".php");
		}
	}
}

// Plugin client classes
_cpt_apd_load_files( CPT_APD_DIR . 'classes/', array( 'main', 'plugin' ) );

// Plugin activate/desactive hooks
register_activation_hook( __FILE__, array( 'CPT_APD_Plugin', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'CPT_APD_Plugin', 'deactivate' ) );

add_action( 'plugins_loaded', 'init_cpt_apd_plugin' );

function init_cpt_apd_plugin() {
	// Client
	new CPT_APD_Plugin();
	new CPT_APD_Main();
}
