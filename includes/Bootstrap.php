<?php
namespace Hasinur\Contact;

use Hasinur\Contact\Core\Interfaces\ProviderInterface;
use Hasinur\Contact\Api\ApiManager;
use Hasinur\Contact\Admin\Admin;
use Hasinur\Contact\Assets\AssetManager;

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
        ApiManager::class,
        Admin::class,
        AssetManager::class,
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
