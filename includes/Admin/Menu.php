<?php
namespace Hasinur\Contact\Admin;

use Hasinur\Contact\Core\Interfaces\ServiceInterface;

/**
 * Menu Class
 * 
 * @package Contact
 */
class Menu implements ServiceInterface {
    /**
     * Register service actions
     *
     * @return  void
     */
    public function register() {
        add_action( 'admin_menu', [ $this, 'register_menu' ] );
    }

    /**
     * Register contact menu
     *
     * @return  void
     */
    public function register_menu() {
        add_menu_page(
            __( 'Contact', 'contact' ),
            __( 'Contact', 'contact' ),
            'manage_options',
            'contact',
            [ $this, 'menu_page' ],
            'dashicons-admin-users'
        );
    }

    /**
     * Admin main menu page
     *
     * @return  void
     */
    public function menu_page() {
        ?>
            <div class="wrap">
                <h2>Main menu page</h2>
            </div>
        <?php 
    }
}
