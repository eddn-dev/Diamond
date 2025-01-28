<?php

namespace Model;

class LocationServices extends ActiveRecord
{
    protected static string $tabla = 'location_services';
    protected static array $columnasDB = [
        'id',
        'location_id',
        'service_id'
    ];

    public $id;
    public $location_id;
    public $service_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->location_id = $args['location_id'] ?? null;
        $this->service_id = $args['service_id'] ?? null;
    }
}
