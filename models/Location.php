<?php

namespace Model;

class Location extends ActiveRecord
{
    protected static string $tabla = 'locations';
    protected static array $columnasDB = [
        'id',
        'name',
        'address',
        'phone',
        'is_active'
    ];

    public $id;
    public $name;
    public $address;
    public $phone;
    public $is_active;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->address = $args['address'] ?? '';
        $this->phone = $args['phone'] ?? '';
        $this->is_active = $args['is_active'] ?? 1;
    }
}
