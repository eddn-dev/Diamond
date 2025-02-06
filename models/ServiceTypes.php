<?php

namespace Model;

class ServiceType extends ActiveRecord
{
    protected static string $tabla = 'service_types';
    protected static array $columnasDB = [
        'id',
        'name',
        'description'
    ];

    public $id;
    public $name;
    public $description;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->description = $args['description'] ?? '';
    }
}