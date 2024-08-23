<?php
/**
 * ApiManager Class
 */
namespace Hasinur\Contact\Api;

use Hasinur\Contact\Api\Controllers\ContactController;
use Hasinur\Contact\Core\Interfaces\ProviderInterface;

/**
 * Api Manager Class
 */
class ApiManager implements ProviderInterface {
    /**
     * Store all controllers
     *
     * @var array
     */
    private $controllers = [
        ContactController::class
    ];

    /**
     * Run all service for the provider
     *
     * @return  void
     */
    public function run() {
        add_action( 'rest_api_init', [ $this, 'register_controllers' ] );
    }
    
    /**
     * Register rest controllers
     *
     * @return  void Register all controllers for the rest API
     */
    public function register_controllers() {
        foreach( $this->controllers as $controller ) {
            $controller_object = new $controller();
            $controller_object->register_routes();
        }
    }
}
