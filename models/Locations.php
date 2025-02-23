<?php

namespace Model;

class Locations extends ActiveRecord
{
    protected static string $tabla = 'locations';
    protected static array $columnasDB = [
        'id',
        'name',
        'address',
        'phone',
        'is_active',
        'photo'
    ];

    public $id;
    public $name;
    public $address;
    public $phone;
    public $is_active;
    public $photo;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->address = $args['address'] ?? '';
        $this->phone = $args['phone'] ?? '';
        $this->is_active = $args['is_active'] ?? 1; // Valor por defecto 1 (activo)
        $this->photo = $args['photo'] ?? 'default';
    }
}