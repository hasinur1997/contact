<?php
/**
 * Admin Class
 * 
 * @package Contact
 */
namespace Hasinur\Contact\Admin;

use Hasinur\Contact\Core\Interfaces\ProviderInterface;

/**
 * Admin Provider
 */
class Admin implements ProviderInterface {
    /**
     * Store all admin services
     *
     * @var array
     */
    private $services = [
        Menu::class
    ];

    /**
     * Run all services for admin
     *
     * @return  void
     */
    public function run() {
        foreach( $this->services as $service ) {
            $service_object = new $service();
            $service_object->register();
        }
    }
}
