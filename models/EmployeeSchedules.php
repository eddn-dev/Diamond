<?php

namespace Model;

class EmployeeSchedule extends ActiveRecord
{
    protected static string $tabla = 'employee_schedules';
    protected static array $columnasDB = [
        'id',
        'employee_id',
        'day_of_week',
        'start_time',
        'end_time',
        'is_active'
    ];

    public $id;
    public $employee_id;
    public $day_of_week;
    public $start_time;
    public $end_time;
    public $is_active;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->employee_id = $args['employee_id'] ?? null;
        $this->day_of_week = $args['day_of_week'] ?? null;
        $this->start_time = $args['start_time'] ?? '';
        $this->end_time = $args['end_time'] ?? '';
        $this->is_active = $args['is_active'] ?? 1; // Valor por defecto 1 (activo)
    }
}