<?php
/**
 * Theme setup and config
 * 
 * @package StarterTheme
 */


if ( file_exists( trailingslashit( __DIR__ ) . '../vendor/autoload.php' ) ) {
    include_once trailingslashit( __DIR__ ) . '../vendor/autoload.php';
}

$files = [
    // Admin
    'admin/customizer.php',
    'admin/meta-boxes.php',

    // Functions
    'functions/helpers.php',
    'functions/template-functions.php',
    'functions/template-hooks.php',
    'functions/template-tags.php',

    // Plugins
    'plugins/easy-digital-downloads.php',
    'plugins/jetpack.php',
    //'plugins/woocommerce.php',

    // Shortcodes
    'shortcodes/shortcodes.php',
];

foreach ( $files as $file ) {
    include_once trailingslashit( __DIR__ ) . $file;
}