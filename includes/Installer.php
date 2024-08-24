<?php
/**
 * Install actions
 */
namespace Hasinur\Contact;

/**
 * Installer class
 * 
 * @package Contact
 */
class Installer {
    /**
     * Run all installation actions
     *
     * @return  void
     */
    public static function run() {
        // TODO: Run all actions when activate plugin.
        self::create_tables();
    }

    /**
     * Create tables
     *
     * @return  void
     */
    public static function create_tables() {
        global $wpdb;

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';


        $charset = $wpdb->get_charset_collate();

        $tables = [
            "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}contacts`(
                `id` int not NULL AUTO_INCREMENT,
                `name` varchar(25),
                `email` varchar(25),
                `phone` varchar(25),
                `address` text DEFAULT NULL,
                `image` varchar(100) DEFAULT NULL,
                PRIMARY KEY(`id`)
            ) {$charset};",
        ];

        foreach( $tables as $table ) {
            dbDelta( $table );
        }
    }
}
