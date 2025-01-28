<?php

namespace Model;

class Service extends ActiveRecord
{
    protected static string $tabla = 'services';
    protected static array $columnasDB = [
        'id',
        'name',
        'description',
        'duration',
        'price'
    ];

    public $id;
    public $name;
    public $description;
    public $duration;
    public $price;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->duration = $args['duration'] ?? 40;  // Por defecto
        $this->price = $args['price'] ?? 0;
    }
}
