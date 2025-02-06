<?php

namespace Model;

class LocationService extends ActiveRecord
{
    protected static string $tabla = 'location_services';
    protected static array $columnasDB = [
        'id',
        'location_id',
        'service_id',
        'image'
    ];

    public $id;
    public $location_id;
    public $service_id;
    public $image;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->location_id = $args['location_id'] ?? null;
        $this->service_id = $args['service_id'] ?? null;
        $this->image = $args['image'] ?? '';
    }
}