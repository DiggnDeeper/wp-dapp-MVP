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


wp-dapp/                           # Root directory for the WP-Dapp plugin
├── assets/                        # Contains front-end and admin assets
│   ├── css/
│   │   └── style.css              # Custom CSS for styling the plugin's admin or front-end pages
│   └── js/
│       └── script.js              # Custom JavaScript for any dynamic plugin functionality
├── includes/                      # Contains all PHP classes and functionality modules
│   ├── class-hive-api.php         # Wrapper class for interacting with the Hive blockchain using the Hive PHP library
│   ├── class-publish-handler.php  # Handles WordPress publish events and sends post data to Hive
│   ├── class-settings-page.php    # Adds an options page in the WordPress admin for storing Hive credentials
│   └── class-post-meta-box.php    # Adds a meta box to the post editor for entering custom Hive tags (up to 5)
├── languages/                     # Contains translation files (if needed for localization)
├── README.md                      # Documentation and information about the plugin
└── wp-dapp.php                    # Main plugin file; initializes the plugin and loads all required files
