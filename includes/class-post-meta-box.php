<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class WP_Dapp_Post_Meta_Box {

    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
        add_action( 'save_post', array( $this, 'save_meta_box' ) );
    }

    /**
     * Add a meta box for Hive tags.
     */
    public function add_meta_box() {
        add_meta_box(
            'wpdapp_tags_meta_box',       // Unique ID
            'Hive Tags',                  // Title
            array( $this, 'render_meta_box' ), // Callback function
            'post',                       // Post type
            'side',                       // Context (side, normal, etc.)
            'default'                     // Priority
        );
    }

    /**
     * Render the meta box content.
     *
     * @param WP_Post $post The post object.
     */
    public function render_meta_box( $post ) {
        // Use nonce for verification.
        wp_nonce_field( 'wpdapp_tags_nonce_action', 'wpdapp_tags_nonce' );

        // Retrieve existing tags from the post meta.
        $value = get_post_meta( $post->ID, '_wpdapp_custom_tags', true );
        ?>
        <p>
            <label for="wpdapp_custom_tags">
                Enter up to 5 tags (comma separated):
            </label>
            <input type="text" id="wpdapp_custom_tags" name="wpdapp_custom_tags" value="<?php echo esc_attr( $value ); ?>" style="width:100%;" />
        </p>
        <?php
    }

    /**
     * Save the meta box data when the post is saved.
     *
     * @param int $post_id The ID of the post being saved.
     */
    public function save_meta_box( $post_id ) {
        // Check if our nonce is set.
        if ( ! isset( $_POST['wpdapp_tags_nonce'] ) ) {
            return;
        }
        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $_POST['wpdapp_tags_nonce'], 'wpdapp_tags_nonce_action' ) ) {
            return;
        }
        // Avoid autosave.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        // Check permissions.
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
        // Sanitize and save the meta value.
        if ( isset( $_POST['wpdapp_custom_tags'] ) ) {
            $tags = sanitize_text_field( $_POST['wpdapp_custom_tags'] );
            update_post_meta( $post_id, '_wpdapp_custom_tags', $tags );
        }
    }
}

new WP_Dapp_Post_Meta_Box();
