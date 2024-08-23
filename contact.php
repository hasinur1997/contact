<?php
/*
 * Plugin Name:       Contact
 * Plugin URI:        https://github.com/hasinur1997/
 * Description:       A contact collections software.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Hasinur Rahman
 * Author URI:        https://github.com/hasinur1997/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       contact
 * Domain Path:       /languages
 */

namespace Hasinur\Contact;

if ( ! defined( 'ABSPATH' ) ) return;

require_once __DIR__ . '/vendor/autoload.php';

if ( ! defined( 'CONTACT_STARTER_FILE' ) ) {
    define( 'CONTACT_STARTER_FILE', __FILE__ );
}

if ( ! defined( 'CONTACT_STARTER_DIR' ) ) {
    define( 'CONTACT_STARTER_DIR', __DIR__ );
}

class_exists( Contact::class ) && Contact::instance();
