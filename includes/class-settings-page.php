<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class WP_Dapp_Settings_Page {

    private $options;

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page under the Settings menu.
     */
    public function add_plugin_page() {
        add_options_page(
            'WP-Dapp Settings',      // Page title
            'WP-Dapp',               // Menu title
            'manage_options',        // Capability
            'wp-dapp',               // Menu slug
            array( $this, 'create_admin_page' ) // Callback to render the page
        );
    }

    /**
     * Options page callback.
     */
    public function create_admin_page() {
        // Retrieve existing options from the database
        $this->options = get_option( 'wpdapp_options' );
        ?>
        <div class="wrap">
            <h2>WP-Dapp Settings</h2>
            <form method="post" action="options.php">
                <?php
                // Output security fields for the registered setting "wpdapp_option_group"
                settings_fields( 'wpdapp_option_group' );
                // Output setting sections and their fields
                do_settings_sections( 'wp-dapp-admin' );
                // Submit button
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings.
     */
    public function page_init() {
        register_setting(
            'wpdapp_option_group', // Option group
            'wpdapp_options',      // Option name
            array( $this, 'sanitize' ) // Sanitize callback
        );

        add_settings_section(
            'setting_section_id',  // ID
            'Hive Credentials',    // Title
            array( $this, 'print_section_info' ), // Callback
            'wp-dapp-admin'        // Page
        );

        add_settings_field(
            'hive_account',        // ID
            'Hive Account',        // Title
            array( $this, 'hive_account_callback' ), // Callback
            'wp-dapp-admin',       // Page
            'setting_section_id'   // Section
        );

        add_settings_field(
            'private_key',
            'Private Key',
            array( $this, 'private_key_callback' ),
            'wp-dapp-admin',
            'setting_section_id'
        );
    }

    /**
     * Sanitize each setting field as needed.
     *
     * @param array $input Contains all settings fields as array keys.
     * @return array Sanitized settings.
     */
    public function sanitize( $input ) {
        $new_input = array();

        if ( isset( $input['hive_account'] ) ) {
            $new_input['hive_account'] = sanitize_text_field( $input['hive_account'] );
        }

        if ( isset( $input['private_key'] ) ) {
            $new_input['private_key'] = sanitize_text_field( $input['private_key'] );
        }

        return $new_input;
    }

    /**
     * Print the Section text.
     */
    public function print_section_info() {
        echo 'Enter your Hive credentials below:';
    }

    /**
     * Hive account field callback.
     */
    public function hive_account_callback() {
        printf(
            '<input type="text" id="hive_account" name="wpdapp_options[hive_account]" value="%s" />',
            isset( $this->options['hive_account'] ) ? esc_attr( $this->options['hive_account'] ) : ''
        );
    }

    /**
     * Private key field callback.
     */
    public function private_key_callback() {
        printf(
            '<input type="text" id="private_key" name="wpdapp_options[private_key]" value="%s" />',
            isset( $this->options['private_key'] ) ? esc_attr( $this->options['private_key'] ) : ''
        );
    }
}

// Initialize the settings page.
new WP_Dapp_Settings_Page();
