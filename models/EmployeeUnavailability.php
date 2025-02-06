<?php

namespace Model;

class EmployeeUnavailability extends ActiveRecord
{
    protected static string $tabla = 'employee_unavailabilities';
    protected static array $columnasDB = [
        'id',
        'employee_id',
        'date',
        'start_time',
        'end_time',
        'reason',
        'is_full_day'
    ];

    public $id;
    public $employee_id;
    public $date;
    public $start_time;
    public $end_time;
    public $reason;
    public $is_full_day;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->employee_id = $args['employee_id'] ?? null;
        $this->date = $args['date'] ?? '';
        $this->start_time = $args['start_time'] ?? '';
        $this->end_time = $args['end_time'] ?? '';
        $this->reason = $args['reason'] ?? '';
        $this->is_full_day = $args['is_full_day'] ?? 0; // Valor por defecto 0 (no es día completo)
    }
}