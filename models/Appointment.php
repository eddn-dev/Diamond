<?php

namespace Model;

class Appointment extends ActiveRecord
{
    protected static string $tabla = 'appointments';
    protected static array $columnasDB = [
        'id',
        'user_id',
        'location_id',
        'employee_id',
        'appointment_date',
        'appointment_time',
        'status',
        'client_name',
        'client_phone',
        'comments',
        'created_at'
    ];

    public $id;
    public $user_id;
    public $location_id;
    public $employee_id;
    public $appointment_date;
    public $appointment_time;
    public $status;
    public $client_name;
    public $client_phone;
    public $comments;
    public $created_at;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->user_id = $args['user_id'] ?? null;
        $this->location_id = $args['location_id'] ?? null;
        $this->employee_id = $args['employee_id'] ?? null;
        $this->appointment_date = $args['appointment_date'] ?? '';
        $this->appointment_time = $args['appointment_time'] ?? '';
        $this->status = $args['status'] ?? 'pending'; // Valor por defecto 'pending'
        $this->client_name = $args['client_name'] ?? '';
        $this->client_phone = $args['client_phone'] ?? '';
        $this->comments = $args['comments'] ?? '';
        $this->created_at = $args['created_at'] ?? null; // El valor por defecto CURRENT_TIMESTAMP lo maneja la DB
    }
}