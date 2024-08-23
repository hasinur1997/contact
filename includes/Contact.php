<?php
namespace Hasinur\Contact;
/**
 * Contact class
 */
class Contact {
    /**
     * Constructor for the Contact Class
     *
     * @return  void
     */
    public function __construct() {
        $this->actions();
    }

    /**
     * Get instance
     *
     * @return  Contact
     */
    public static function instance() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Run all neccery actions
     *
     * @return  void
     */
    public function actions() {
        Bootstrap::run();
    }
}
