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

        // Check for custom Hive tags from the meta box.
        $custom_tags = get_post_meta( $ID, '_wpdapp_custom_tags', true );
        if ( ! empty( $custom_tags ) ) {
            // Parse the comma separated tags, trim whitespace, and limit to 5 tags.
            $tags_array = array_map( 'trim', explode( ',', $custom_tags ) );
            $tags = array_slice( $tags_array, 0, 5 );
        } else {
            // Fallback: use the post's WordPress tags (if any) or a default tag.
            $tags = array();
            $tag_objects = get_the_tags( $ID );
            if ( $tag_objects && ! is_wp_error( $tag_objects ) ) {
                foreach ( $tag_objects as $tag_obj ) {
                    $tags[] = $tag_obj->slug;
                    if ( count( $tags ) >= 5 ) {
                        break;
                    }
                }
            }
            if ( empty( $tags ) ) {
                $tags[] = 'wordpress';
            }
        }

        // Prepare the post data to be sent to Hive.
        $post_data = array(
            'title'  => $post->post_title,
            'body'   => $post->post_content,
            'author' => $post->post_author,
            'tags'   => $tags,
            // Future enhancements: beneficiary settings, etc.
        );

        // Post the content to Hive using our API wrapper.
        $response = $this->hive_api->post_to_hive( $post_data );

        // Process the response from Hive.
        if ( isset( $response['status'] ) && 'success' === $response['status'] ) {
            // Optionally store the transaction ID in post meta for future reference.
            update_post_meta( $ID, '_hive_tx_id', $response['transaction_id'] );
        } else {
            // Log an error message for debugging purposes.
            error_log( 'WP-Dapp: Error posting to Hive: ' . print_r( $response, true ) );
        }
    }
}
