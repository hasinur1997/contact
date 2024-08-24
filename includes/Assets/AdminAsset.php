<?php
namespace Hasinur\Contact\Assets;

use Hasinur\Contact\Core\Interfaces\AssetInterface;
use Hasinur\Contact\Core\Abstracts\Asset;

/**
 * Register all admin scripts and styles
 */
class AdminAsset extends Asset{
    /**
     * Register admin and styles
     *
     * @return  void
     */
    public function run() {
        add_action( 'admin_enqueue_scripts', [ $this, 'register' ] );
    }

    /**
     * Get scripts
     *
     * @return  array
     */
    public function getScripts() {
        $scripts = [
            'contact-main' => [
                'src'       => plugins_url('build/index.js', CONTACT_STARTER_FILE ),
                'deps'      => ['jquery'],
                'in_footer' => false,
            ],
        ];

        return $scripts;
    }

    /**
     * Get styles
     *
     * @return  array
     */
    public function getStyles() {
        $styles = [];

        return $styles;
    }
}
