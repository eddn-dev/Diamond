<?php

namespace Model;

class Service extends ActiveRecord
{
    protected static string $tabla = 'services';
    protected static array $columnasDB = [
        'id',
        'service_type_id',
        'name',
        'description',
        'duration',
        'price'
    ];

    public $id;
    public $service_type_id;
    public $name;
    public $description;
    public $duration;
    public $price;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->service_type_id = $args['service_type_id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->duration = $args['duration'] ?? 40; // Valor por defecto 40
        $this->price = $args['price'] ?? 0.00;     // Valor por defecto 0.00
    }
}