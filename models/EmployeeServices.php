<?php

namespace Model;

class EmployeeServices extends ActiveRecord
{
    protected static string $tabla = 'employee_services';
    protected static array $columnasDB = [
        'employee_id',
        'service_id'
    ];

    public $employee_id;
    public $service_id;

    public function __construct($args = [])
    {
        $this->employee_id = $args['employee_id'] ?? null;
        $this->service_id = $args['service_id'] ?? null;
    }
}
