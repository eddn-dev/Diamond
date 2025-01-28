<?php

namespace Model;

class Employee extends ActiveRecord
{
    protected static string $tabla = 'employees';
    protected static array $columnasDB = [
        'id',
        'location_id',
        'name',
        'email',
        'phone',
        'is_active'
    ];

    public $id;
    public $location_id;
    public $name;
    public $email;
    public $phone;
    public $is_active;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->location_id = $args['location_id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->phone = $args['phone'] ?? '';
        $this->is_active = $args['is_active'] ?? 1;
    }
}
