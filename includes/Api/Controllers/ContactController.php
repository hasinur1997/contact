<?php
namespace Hasinur\Contact\Api\Controllers;

use Hasinur\Contact\Models\ContactModel;
use WP_REST_Request;
use WP_REST_Server;

/**
 * Contact Controller Class
 * 
 * @package Contact
 */
class ContactController extends Controller {
    /**
     * Store contact rest base
     *
     * @var string
     */
    protected $rest_base = 'contacts';

    /**
     * Register routes
     *
     * @return  void
     */
    public function register_routes() {
        register_rest_route( $this->namespace, $this->rest_base, [
            [
                'methods'   => WP_REST_Server::READABLE,
                'callback'  => [ $this, 'get_items' ],
                'permission_callback' => ''
            ]
        ]);
    }

    /**
     * Retrieve a collection of items
     *
     * @param   WP_Rest_Request_Server  $request
     *
     * @return  void
     */
    public function get_items( $request ) {
        $contacts = ContactModel::all();
        
        return rest_ensure_response($contacts);
    }

    public function get_items_permissions_check( $request ) {

    }
}
