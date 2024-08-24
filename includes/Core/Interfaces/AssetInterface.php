<?php
namespace Hasinur\Contact\Core\Interfaces;

/**
 * Asset interface
 */
interface AssetInterface {
    /**
     * Register all scripts and styles
     *
     * @return  void
     */
    public function register();

    /**
     * Get all scripts
     *
     * @return  array
     */
    public function getScripts();

    /**
     * Get all styles
     *
     * @return  array
     */
    public function getStyles();
}
