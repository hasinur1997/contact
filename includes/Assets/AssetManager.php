<?php
namespace  Hasinur\Contact\Assets;

use Hasinur\Contact\Core\Interfaces\ProviderInterface;

/**
 * Asset Manager Class
 */
class AssetManager implements ProviderInterface {
    /**
     * Store all services
     *
     * @var array
     */
    protected $services = [
        AdminAsset::class
    ];

    /**
     * Run all services
     *
     * @return  void
     */
    public function run() {
        foreach( $this->services as $service ) {
            $service_object = new $service();
            $service_object->run();
        }
    }
}
