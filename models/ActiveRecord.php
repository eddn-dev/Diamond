<?php

namespace Model;

use mysqli;

class ActiveRecord
{
    protected static mysqli $db;
    protected static string $tabla = '';
    protected static array $columnasDB = [];

    // Alertas y Mensajes
    protected static array $alertas = [];

    // Definir la conexión a la BD - includes/database.php
    public static function setDB(mysqli $database)
    {
        self::$db = $database;
    }

    // Setear un tipo de Alerta
    public static function setAlerta(string $tipo, string $mensaje): void
    {
        static::$alertas[$tipo][] = $mensaje;
    }

    // Obtener las alertas
    public static function getAlertas(): array
    {
        return static::$alertas;
    }

    // Validación que se hereda en modelos
    public function validar(): array
    {
        static::$alertas = [];
        return static::$alertas;
    }

    // ==================================
    //           CONSULTAS SQL
    // ==================================
    
    /**
     * Ejecuta un query SQL y retorna un arreglo de objetos del modelo correspondiente.
     */
    public static function consultarSQL(string $query): array
    {
        $resultado = self::$db->query($query);

        if (!$resultado) {
            // Podrías lanzar una excepción o manejar el error
            // throw new \Exception("Error en la consulta: " . self::$db->error);
            return [];
        }

        // Iterar los resultados y convertirlos en objetos
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        $resultado->free();
        return $array;
    }

    /**
     * Crea una instancia del modelo a partir de un arreglo (row) de la BD.
     */
    protected static function crearObjeto(array $registro): static
    {
        $objeto = new static;

        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    // ==================================
    //       ATRIBUTOS Y SANITIZACIÓN
    // ==================================

    /**
     * Retorna un array asociativo de los atributos del objeto
     * que coincidan con las columnas de la BD (excepto 'id').
     */
    public function atributos(): array
    {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            if ($columna === 'id') {
                continue;
            }
            $atributos[$columna] = $this->$columna ?? null;
        }
        return $atributos;
    }

    /**
     * Escapa cada atributo usando `mysqli::escape_string`.
     */
    public function sanitizarAtributos(): array
    {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string((string) $value);
        }
        return $sanitizado;
    }

    /**
     * Sincroniza el objeto en memoria con un arreglo asociativo (por ejemplo, $_POST).
     */
    public function sincronizar(array $args = []): void
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && $value !== null) {
                $this->$key = $value;
            }
        }
    }

    // ==================================
    //             CRUD
    // ==================================

    /**
     * Guarda el registro en la base de datos. Determina si se creará o actualizará.
     */
    public function guardar()
    {
        if (!empty($this->id)) {
            return $this->actualizar();
        }
        return $this->crear();
    }

    /**
     * Crea un nuevo registro en la BD.
     */
    public function crear(): array
    {
        $atributos = $this->sanitizarAtributos();

        $campos = join(', ', array_keys($atributos));
        $valores = "'" . join("', '", array_values($atributos)) . "'";

        $query = "INSERT INTO " . static::$tabla . " ({$campos}) VALUES ({$valores})";

        $resultado = self::$db->query($query);

        return [
            'resultado' => $resultado,
            'id'        => self::$db->insert_id
        ];
    }

    /**
     * Actualiza el registro en la BD.
     */
    public function actualizar()
    {
        // Sanitizar atributos
        $atributos = $this->sanitizarAtributos();
        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        // Escapar/Castear el ID
        $id = (int) $this->id;

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = {$id} ";
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query($query);
        return $resultado;
    }

    /**
     * Elimina el registro actual (por su ID).
     */
    public function eliminar()
    {
        $id = (int) $this->id;
        $query = "DELETE FROM " . static::$tabla . " WHERE id = {$id} LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado;
    }

    // ==================================
    //         MÉTODOS ESTÁTICOS
    // ==================================

    /**
     * Retorna todos los registros de la tabla.
     */
    public static function all(string $order = 'DESC'): array
    {
        // Sanitizar el ORDER por seguridad (puedes validar manualmente si es ASC o DESC)
        $order = strtoupper($order) === 'ASC' ? 'ASC' : 'DESC';
        $query = "SELECT * FROM " . static::$tabla . " ORDER BY id {$order}";
        return self::consultarSQL($query);
    }

    /**
     * Retorna un registro por su ID.
     */
    public static function find($id): ?static
    {
        // Castear $id a int para evitar inyecciones (siempre que tu campo sea INT)
        $id = (int) $id;
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = {$id} LIMIT 1";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado) ?: null;
    }

    /**
     * Obtiene un cierto número de registros ordenados desc.
     * (Aunque tu método original `get` parecía retornar un único registro, 
     *  probablemente querrás retornar varios. Ajusto para retornar array)
     */
    public static function get(int $limite): array
    {
        $query = "SELECT * FROM " . static::$tabla . " ORDER BY id DESC LIMIT {$limite}";
        return self::consultarSQL($query);
    }

    /**
     * Retorna el primer registro que coincida con la condición WHERE columna=valor.
     */
    public static function where(string $columna, $valor): ?static
    {
        // Escapar ambos
        $columna = self::$db->escape_string($columna);
        $valor   = self::$db->escape_string((string)$valor);

        $query = "SELECT * FROM " . static::$tabla . " WHERE {$columna} = '{$valor}' LIMIT 1";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado) ?: null;
    }

    /**
     * Retorna uno o varios registros que cumplan todas las condiciones del array asociativo.
     */
    public static function whereArray(array $args = []): array
    {
        $query = "SELECT * FROM " . static::$tabla;

        if (!empty($args)) {
            $query .= " WHERE ";
            $conditions = [];
            foreach ($args as $key => $value) {
                $columna = self::$db->escape_string($key);
                $val     = self::$db->escape_string((string)$value);
                $conditions[] = "{$columna} = '{$val}'";
            }
            $query .= join(' AND ', $conditions);
        }

        return self::consultarSQL($query);
    }

    /**
     * Retorna el total de filas en la tabla.
     */
    public static function total(): int
    {
        $query = "SELECT COUNT(*) as total FROM " . static::$tabla;
        $result = self::$db->query($query);

        if ($result) {
            $row = $result->fetch_assoc();
            return (int) $row['total'];
        }
        return 0;
    }

    /**
     * Retorna un número de registros, con paginación.
     */
    public static function paginate(int $rows, int $offset): array
    {
        $rows   = (int) $rows;
        $offset = (int) $offset;
        $query  = "SELECT * FROM " . static::$tabla . " ORDER BY id DESC LIMIT {$rows} OFFSET {$offset}";
        return self::consultarSQL($query);
    }
}
