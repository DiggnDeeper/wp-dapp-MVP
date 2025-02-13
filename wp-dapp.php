<?php
/**
 * Plugin Name: WP-Dapp: Hive Integration
 * Description: A plugin to post content from WordPress to Hive without self-voting on publish.
 * Version: 0.1
 * Author: Your Name
 * License: MIT
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Define plugin constants.
define( 'WPDAPP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WPDAPP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Include required files.
require_once WPDAPP_PLUGIN_DIR . 'includes/class-hive-api.php';
require_once WPDAPP_PLUGIN_DIR . 'includes/class-publish-handler.php';
require_once WPDAPP_PLUGIN_DIR . 'includes/class-settings-page.php';
require_once WPDAPP_PLUGIN_DIR . 'includes/class-post-meta-box.php';

/**
 * Initialize the plugin functionality.
 */
function wpdapp_init() {
    $publish_handler = new WP_Dapp_Publish_Handler();
    // Hook into the publish process; priority 10, expecting 2 arguments (post ID and post object).
    add_action( 'publish_post', array( $publish_handler, 'on_publish_post' ), 10, 2 );
}
add_action( 'plugins_loaded', 'wpdapp_init' );
