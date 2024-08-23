<?php
namespace Hasinur\Contact;

use Hasinur\Contact\Core\Interfaces\ProviderInterface;
use Hasinur\Contact\Api\ApiManager;

/**
 * Bootstrap Class
 */
class Bootstrap {
    /**
     * Store all service providers
     *
     * @var array
     */
    protected static $providers = [
        Activate::class,
        ApiManager::class
    ];

    /**
     * Run all services
     *
     * @return  void
     */
    public static function run() {
        foreach( self::$providers as $provider ) {
            $provider_object = new $provider();
            $provider_object->run();
        }
    }
}
