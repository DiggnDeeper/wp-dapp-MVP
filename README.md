# wp-dapp-MVP

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
