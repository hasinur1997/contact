<?php
/**
 * Model class
 * 
 * @package Contact
 */
namespace Hasinur\Contact\Models;

/**
 * Model class
 */
class Model {
    /**
     * Store table name
     *
     * @var string
     */
    protected $table;

    /**
     * Store primary key
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Store all attributes
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Constructor for Model class
     *
     * @param   array  $attributes
     *
     * @return  void
     */
    public function __construct(array $attributes = []) {
        global $wpdb;

        $this->fill($attributes);
        $this->table = "{$wpdb->prefix}{$this->table}";
    }

    /**
     * Magic method to dynamically access attributes.
     *
     * @param   string  $key
     *
     * @return  mixed
     */
    public function __get($key) {
        if (array_key_exists($key, $this->attributes)) {
            return $this->attributes[$key];
        }

        return null;
    }

    /**
     * Setup all attributes
     *
     * @param   array  $attributes
     *
     * @return  void
     */
    public function fill( array $attributes ) {
        $this->attributes = array_merge($this->attributes, $attributes);
    }

    /**
     * Create database row
     *
     * @param   array  $attributes  [$attributes description]
     *
     * @return  object
     */
    public static function create(array $attributes) {
        $instance = new static($attributes);
        $instance->save();
        return $instance;
    }

    /**
     * Save database row
     *
     * @return  void
     */
    public function save() {
        $columns = array_keys($this->attributes);
        $values = array_values($this->attributes);

        global $wpdb;

        if ( isset( $this->attributes[ $this->primaryKey ] ) ) {
            // Update existing record
            $id = $wpdb->update( $this->table, $this->attributes, [ 'id' => $this->attributes[$this->primaryKey] ] );
        } else {
            // Insert new record
            $id = $wpdb->insert( $this->table, $this->attributes );
        }

        if ( ! isset( $this->attributes[$this->primaryKey] ) ) {
            $this->attributes[$this->primaryKey] = $id;
        }
    }

    /**
     * Update a database row
     *
     * @param   array  $attributes
     *
     * @return  void
     */
    public function update(array $attributes) {
        $this->fill($attributes);
        $this->save();
    }

    public function delete() {
        if ( ! isset( $this->attributes[ $this->primaryKey ] ) ) {
            throw new \Exception("Primary key value is missing for delete operation.");
        }

        global $wpdb;

        $wpdb->delete( $this->table, ['id' => $this->attributes[ $this->primaryKey] ] );
    }

    /**
     * Get a single database row
     *
     * @param   [type]  $id  [$id description]
     *
     * @return  [type]       [return description]
     */
    public static function find( $id ) {
        global $wpdb;
        $instance = new static();
    
        $query = $wpdb->prepare("SELECT * FROM {$instance->table} WHERE {$instance->primaryKey} = %d", $id);
        $result = $wpdb->get_row($query, ARRAY_A);

        if ($result) {
            $instance->fill($result);
            return $instance;
        }

        return null;
    }

    /**
     * Get all items from database
     *
     * @return  array
     */
    public static function all() {
        global $wpdb;
        $instance = new static();
        
        $query = "SELECT * FROM {$instance->table}";
        $results = $wpdb->get_results($query, ARRAY_A);

        $models = [];
        foreach ($results as $row) {
            $modelInstance = new static();
            $modelInstance->fill($row);
            $models[] = $modelInstance;
        }

        return $models;
    }
}
