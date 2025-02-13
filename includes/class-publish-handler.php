<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class WP_Dapp_Publish_Handler {

    protected $hive_api;

    public function __construct() {
        // Initialize the Hive API wrapper, which uses the credentials from your settings page.
        $this->hive_api = new WP_Dapp_Hive_API();
    }

    /**
     * Handle the WordPress publish post event.
     *
     * @param int     $ID   The Post ID.
     * @param WP_Post $post The Post object.
     */
    public function on_publish_post( $ID, $post ) {
        // Only handle posts that are published.
        if ( 'publish' !== $post->post_status ) {
            return;
        }

        // Prepare the post data to be sent to Hive.
        $post_data = array(
            'title'  => $post->post_title,
            'body'   => $post->post_content,
            'author' => $post->post_author,
            // Future enhancements: add tags, beneficiary settings, etc.
        );

        // Post the content to Hive using our API wrapper.
        $response = $this->hive_api->post_to_hive( $post_data );

        // Process the response from Hive.
        if ( isset( $response['status'] ) && 'success' === $response['status'] ) {
            // Optionally store the transaction ID in post meta for reference.
            update_post_meta( $ID, '_hive_tx_id', $response['transaction_id'] );
        } else {
            // Log an error message for debugging purposes.
            error_log( 'WP-Dapp: Error posting to Hive: ' . print_r( $response, true ) );
        }
    }
}

