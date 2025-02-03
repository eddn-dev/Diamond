<?php

namespace Model;

class Usuario extends ActiveRecord
{
    protected static string $tabla = 'usuarios';
    protected static array $columnasDB = [
        'id',
        'nombre',
        'email',
        'password',
        'confirmado',
        'token',
        'admin',
        'celular',
        'created'
    ];

    public $id;
    public $nombre;
    public $email;
    public $password;
    public $confirmado;
    public $token;
    public $admin;
    public $celular;
    public $created;

    // Campos adicionales para validaciones (no se guardan en DB):
    public $password2;         // Para confirmar password
    public $password_actual;   // Para cambios de password
    public $password_nuevo;    // Para cambios de password

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
        $this->token = $args['token'] ?? '';
        $this->admin = $args['admin'] ?? 0;
        $this->celular = $args['celular'] ?? '';
        $this->created = $args['created'] ?? date('Y-m-d H:i:s');

        // Campos para reset / cambio de password
        $this->password_actual = $args['password_actual'] ?? '';
        $this->password_nuevo = $args['password_nuevo'] ?? '';
    }

    // Validar el Login de Usuarios
    public function validarLogin()
    {
        if (!$this->email) {
            self::$alertas['error']['email'] = 'El Email del Usuario es Obligatorio';
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error']['email'] = 'Email no válido';
        }
        if (!$this->password) {
            self::$alertas['error']['password'] = 'El Password no puede ir vacío';
        }
        return self::$alertas;
    }

    public function validar_cuenta(): array
    {
        // Reiniciamos las alertas antes de comenzar la validación
        self::$alertas = [];

        // Validar el nombre
        if (!$this->nombre) {
            self::$alertas['error']['nombre'] = 'El Nombre es Obligatorio';
        }

        // Validar el email
        if (!$this->email) {
            self::$alertas['error']['email'] = 'El Email es Obligatorio';
        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error']['email'] = 'El Email no es válido';
        }

        // Validar el número celular
        if (!$this->celular) {
            self::$alertas['error']['celular'] = 'El número celular es Obligatorio';
        } elseif (!preg_match('/^\+?[0-9]{10,15}$/', $this->celular)) {
            // La expresión regular permite un signo opcional seguido de entre 10 y 15 dígitos.
            self::$alertas['error']['celular'] = 'El número celular no es válido';
        }

        // Validar el password
        if (!$this->password) {
            self::$alertas['error']['password'] = 'El Password no puede ir vacío';
        } elseif (strlen($this->password) < 6) {
            self::$alertas['error']['password'] = 'El password debe contener al menos 6 caracteres';
        }

        return self::$alertas;
}

    // Valida un email
    public function validarEmail()
    {
        if (!$this->email) {
            self::$alertas['error']['email'] = 'El Email es Obligatorio';
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error']['email'] = 'Email no válido';
        }
        return self::$alertas;
    }

    // Valida el Password
    public function validarPassword()
    {
        if (!$this->password) {
            self::$alertas['error']['password'] = 'El Password no puede ir vacío';
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error']['password'] = 'El password debe contener al menos 6 caracteres';
        }
        return self::$alertas;
    }

    public function nuevo_password(): array
    {
        if (!$this->password_actual) {
            self::$alertas['error']['password'] = 'El Password Actual no puede ir vacío';
        }
        if (!$this->password_nuevo) {
            self::$alertas['error']['password_new'] = 'El Password Nuevo no puede ir vacío';
        }
        if (strlen($this->password_nuevo) < 6) {
            self::$alertas['error']['password_new'] = 'El Password debe contener al menos 6 caracteres';
        }
        return self::$alertas;
    }

    // Comprobar el password
    public function comprobar_password(): bool
    {
        return password_verify($this->password_actual, $this->password);
    }

    // Hashea el password
    public function hashPassword(): void
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    // Generar un Token
    public function crearToken(): void
    {
        $this->token = uniqid();
    }
}
