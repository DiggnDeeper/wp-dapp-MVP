# wp-dapp-MVP

# WP-Dapp: Hive Integration

[![Version](https://img.shields.io/badge/version-0.1-blue.svg)](https://github.com/yourusername/wp-dapp)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](LICENSE)

WP-Dapp: Hive Integration is a WordPress plugin that seamlessly broadcasts your WordPress posts to the Hive blockchain. This plugin allows you to configure your Hive credentials, specify custom Hive tags via a user-friendly meta box, and automatically post your content on publish—without self-voting.

## Features

- **Automated Hive Posting:** Automatically posts WordPress content to Hive when a post is published.
- **Hive Credentials Management:** Configure your Hive account and private key easily through an admin options page.
- **Custom Hive Tags:** Use a dedicated meta box in the post editor to enter up to 5 comma-separated tags for your Hive post.
- **Bundled Hive PHP Library:** The plugin includes the necessary Hive PHP library via Composer, making it self-contained.
- **Scalable & Extensible:** Future plans include adding beneficiary settings and enhanced voting control options.

## Requirements

- WordPress 5.0 or higher
- PHP 7.2 or higher
- A valid Hive account with a posting key (keep your private key secure)

## Installation

### For Developers (Composer Installation)

If you need to update or manage dependencies locally:

1. Open a terminal in the plugin directory.
2. Run the following command to install dependencies:
   ```bash
   composer install
    This will create a vendor/ directory with the Hive PHP library and its dependencies.

Configuration

    Access Settings:
    After activating the plugin, navigate to Settings > WP-Dapp in your WordPress admin dashboard.

    Enter Hive Credentials:
        Hive Account: Enter your Hive username.
        Private Key: Enter your Hive posting key (must be at least 50 characters).

    Save & Verify:
    Click Save Changes. The plugin will verify your credentials. If there are issues, an error message will display.

Usage

    Create or Edit a Post:
    Open the post editor to create a new post or edit an existing one.

    Set Custom Hive Tags:
    In the post editor sidebar, locate the Hive Tags meta box.
    Enter up to 5 comma-separated tags that will be used when posting to Hive.

    Publish Your Post:
    Publish or update the post. The plugin will automatically broadcast your content to the Hive blockchain.

    Verify on Hive:
    Visit Peakd.com or check your Hive account to view the published post.

Troubleshooting

    No Post on Hive:
    Verify that your Hive credentials are correct and that your posting key is valid. Check your PHP error logs for any broadcast errors.

    Credential Verification Issues:
    Ensure your Hive account contains only lowercase letters, numbers, or dashes, and that your private key meets the minimum length requirement.

    Dependency Problems:
    Ensure the vendor/ directory exists and that Composer’s autoloader is included in wp-dapp.php.

Contributing

Contributions are welcome! To contribute:

    Fork the repository.
    Create a new branch for your feature or bugfix.
    Submit a pull request with your changes.

For major changes, please open an issue first to discuss what you would like to change.
License

This plugin is licensed under the MIT License. See the LICENSE file for details.
Disclaimer

This plugin is provided "as is" without any warranty. Use it at your own risk. The author is not responsible for any issues that arise from the use of this plugin
├── README.md                      # Documentation and information about the plugin
└── wp-dapp.php                    # Main plugin file; initializes the plugin and loads all required files
