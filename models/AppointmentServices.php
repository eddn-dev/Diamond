<?php

namespace Model;

class AppointmentService extends ActiveRecord
{
    protected static string $tabla = 'appointment_services';
    protected static array $columnasDB = [
        'appointment_id',
        'service_id'
    ];

    public $appointment_id;
    public $service_id;

    public function __construct($args = [])
    {
        $this->appointment_id = $args['appointment_id'] ?? null;
        $this->service_id = $args['service_id'] ?? null;
    }
}