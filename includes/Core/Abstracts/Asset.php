<?php
namespace Hasinur\Contact\Core\Abstracts;

/**
 * Asset class
 */
abstract class Asset {
    /**
     * Register scripts and styles
     *
     * @return  void
     */
    public function register() {
        $this->registerScript();
        $this->registerStyle();
    }

    /**
     * Register scripts
     *
     * @return  void
     */
    public function registerScript() {
        $scripts = $this->getScripts();

        foreach ( $scripts as $handle => $script ) {
            $deps      = isset( $script['deps'] ) ? $script['deps'] : [];
            $in_footer = isset( $script['in_footer'] ) ? $script['in_footer'] : true;
            $version   = isset( $script['version'] ) ? $script['version'] : $this->get_version( $script['src'] );

            $deps = $this->get_dependencies( $script['src'], $deps );

            wp_register_script( $handle, $script['src'], $deps, $version, $in_footer );
        }
    }

    /**
     * Register styles
     *
     * @return  array
     */
    public function registerStyle() {
        $styles = $this->getStyles();

        foreach ( $styles as $handle => $style ) {
            $deps = isset( $style['deps'] ) ? $style['deps'] : false;

            wp_register_style( $handle, $style['src'], $deps, \Wpeventin::version() );
        }
    }

    /**
     * Get script and style file dependencies
     *
     * @param   string  $file_name
     * @param   array  $deps
     *
     * @return  array
     */
    private function get_dependencies( $file_name, $deps = [] ) {
        $assets = $this->get_file_assets( $file_name );

        $assets_deps = ! empty( $assets['dependencies'] ) ? $assets['dependencies'] : [];

        $merged_deps = array_merge( $assets_deps, $deps );
        return $merged_deps;
    }

    /**
     * Get script file version
     *
     * @param   string  $file_name
     *
     * @return  string
     */
    private function get_version( $file_name ) {
        $assets      = $this->get_file_assets( $file_name );
        $assets_vers = ! empty( $assets['version'] ) ? $assets['version'] : '1.0.0';
        return $assets_vers;
    }

    /**
     * Get file assets
     *
     * @param   string  $file_name
     *
     * @return  array
     */
    private function get_file_assets( $file_url ) {
        $file   = $this->get_file_path( $file_url );
        $assets = [];

        if ( file_exists( $file ) ) {
            $assets = include $file;
        }

        return $assets;
    }

    /**
     * Get file path from url
     *
     * @param   string  $url
     *
     * @return string
     */
    private function get_file_path( $url ) {
        // Check if the URL is valid
        if ( ! filter_var( $url, FILTER_VALIDATE_URL ) ) {
            return false;
        }

        // Parse the URL
        $url_parts = parse_url( $url );

        // Check if the URL has a path component
        if ( ! isset( $url_parts['path'] ) ) {
            return false; // URL does not contain a path
        }

        $clean_path = str_replace( '.js', '.asset.php', $url_parts['path'] );

        // Get the file path from the URL path
        $file_path = $_SERVER['DOCUMENT_ROOT'] . $clean_path;

        // Check if the file exists
        if ( ! file_exists( $file_path ) ) {
            return false; // File does not exist
        }

        return $file_path;
    }

    /**
     * Run hooks
     *
     * @return  array
     */
    public abstract function run();

    /**
     * Get scripts
     *
     * @return  array
     */
    public abstract function getScripts();

    /**
     * Get styles
     *
     * @return  array
     */
    public abstract function getStyles();
}
