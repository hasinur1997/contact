<?php
namespace Hasinur\Contact\Api\Controllers;

use Hasinur\Contact\Models\ContactModel;
use WP_Error;
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
                // 'permission_callback' => ''
            ],
            [
                'methods'   => WP_REST_Server::CREATABLE,
                'callback'  => [ $this, 'create_item' ],
                // 'permission_callback' => ''
            ]
        ]);

        register_rest_route( $this->namespace, $this->rest_base . '/(?P<id>[\d]+)', [
            [
                'methods'   => WP_REST_Server::READABLE,
                'callback'  => [ $this, 'get_item' ],
                // 'permission_callback' => ''
            ],
            [
                'methods'   => WP_REST_Server::EDITABLE,
                'callback'  => [ $this, 'update_item' ],
                // 'permission_callback' => ''
            ],
            [
                'methods'   => WP_REST_Server::DELETABLE,
                'callback'  => [ $this, 'delete_item' ],
                // 'permission_callback' => ''
            ]
        ]);
    }

    public function get_item($request) {
        $id =   intval($request['id']);
        $contact = ContactModel::find($id);

        if ( ! $contact ) {
            return new WP_Error( 'not_found_contact', __( 'Invalid contact', 'contact' ) );
        }

        return rest_ensure_response( $contact );
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

    public function create_item( $request ) {
        $data = $this->prepare_item_for_database( $request );

        $contact = ContactModel::create($data);

        return rest_ensure_response($contact);
    }

    public function update_item($request) {
        $id =   intval($request['id']);
        $contact = ContactModel::find($id);
        $data = $this->prepare_item_for_database($request);

        if ( ! $contact ) {
            return new WP_Error( 'not_found_contact', __( 'Invalid contact', 'contact' ) );
        }

        $contact->update( $data );

        return rest_ensure_response($contact);
    }

    public function delete_item($request) {
        $id =   intval($request['id']);
        $contact = ContactModel::find($id);
        $data = $this->prepare_item_for_database($request);

        if ( ! $contact ) {
            return new WP_Error( 'not_found_contact', __( 'Invalid contact', 'contact' ) );
        }

        $contact->delete();

        return [
            'message' => __( 'Successfully deleted the item', 'contact' ),
        ];
    }

    public function get_items_permissions_check( $request ) {
        return current_user_can('manage_options');
    }

    /**
     * Prepare item for database
     *
     * @param   WP_Rest_Request  $request  
     *
     * @return  array
     */
    public function prepare_item_for_database( $request ) {
        $prepared_data = [];

        if ( ! empty( $request['name'] ) ) {
            $prepared_data['name'] = sanitize_text_field( $request['name'] );
        }

        if ( ! empty( $request['email'] ) ) {
            $prepared_data['email'] = sanitize_text_field( $request['email'] );
        }

        if ( ! empty( $request['phone'] ) ) {
            $prepared_data['phone'] = sanitize_text_field( $request['phone'] );
        }

        if ( ! empty( $request['address'] ) ) {
            $prepared_data['address'] = sanitize_text_field( $request['address'] );
        }

        return $prepared_data;
    }
}
