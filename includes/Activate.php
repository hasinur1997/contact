<?php
namespace Hasinur\Contact;

use Hasinur\Contact\Core\Interfaces\ProviderInterface;

/**
 * Activate class
 */
class Activate implements ProviderInterface {
    /**
     * Run activate actions
     *
     * @return  void
     */
    public function run() {
        register_activation_hook( CONTACT_STARTER_FILE, [ $this, 'run_actions' ] );
    }

    /**
     * Run on plugin activate actions
     *
     * @return  void
     */
    public function run_actions() {
        Installer::run();
    }
}

