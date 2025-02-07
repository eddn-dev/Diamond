<?php

/**
 * Router.php (Modificado para parámetros dinámicos)
 *
 * Este archivo contiene la lógica del enrutador para la aplicación web Diamond.
 * Ahora con soporte para rutas con parámetros dinámicos como {id}.
 *
 * @author Edd n dev
 * @version 1.1 (con parámetros dinámicos)
 */
namespace MVC;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    // Registra ruta GET
    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    // Registra ruta POST
    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    // Método principal que verifica y ejecuta la ruta
    public function dispatch()
    {
        $url_actual = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];
        $params = []; // Array para almacenar los parámetros dinámicos

        $route_found = false;
        $routes_to_check = ($method === 'GET') ? $this->getRoutes : $this->postRoutes;

        foreach ($routes_to_check as $route_pattern => $fn) {
            // Limpiar rutas de slashes al principio y al final para comparar correctamente
            $route_pattern = trim($route_pattern, '/');
            $url_actual_trimmed = trim($url_actual, '/');

            $route_parts = explode('/', $route_pattern);
            $url_parts = explode('/', $url_actual_trimmed);

            if (count($route_parts) !== count($url_parts)) {
                continue; // No coinciden en número de segmentos
            }

            $is_match = true;
            $current_params = [];

            for ($i = 0; $i < count($route_parts); $i++) {
                $route_part = $route_parts[$i];
                $url_part = $url_parts[$i];

                if ($route_part !== $url_part && !preg_match('/^\{(.*?)\}$/', $route_part, $matches)) {
                    $is_match = false; // Segmentos no coinciden y no es un parámetro
                    break;
                }

                // Si es un parámetro dinámico {nombre_parametro}
                if (isset($matches[1])) {
                    $param_name = $matches[1];
                    $current_params[$param_name] = $url_part; // Capturar el valor del parámetro
                }
            }

            if ($is_match) {
                $fn_to_call = $fn;
                $params = $current_params; // Asignar los parámetros encontrados
                $route_found = true;
                break; // Ruta encontrada, salir del bucle
            }
        }

        if (!$route_found) {
            // 404 Not Found
            header('HTTP/1.0 404 Not Found');
            View::render('404', [
                'title' => 'Página no encontrada'
            ], 'empty-layout.php');
            return;
        }

        // Llamar a los middlewares del controlador si existen
        $this->execMiddlewaresMap($fn_to_call);

        // Finalmente, llama a la función o método del controlador, pasando los parámetros
        call_user_func_array($fn_to_call, [$this, $params]); // Pasar $params como segundo argumento
    }

    /**
     * Ejecuta los middlewares definidos en middlewaresMap() si el controlador los define
     * para el método correspondiente.
     */
    protected function execMiddlewaresMap($fn)
    {
        // Verificamos si $fn es un array estilo [Controller::class, 'method']
        if (is_array($fn) && count($fn) === 2) {
            [$controllerClass, $controllerMethod] = $fn;

            // Verificamos si existe un método 'middlewaresMap()' en el controlador
            if (method_exists($controllerClass, 'middlewaresMap')) {
                $middlewaresMap = $controllerClass::middlewaresMap();

                // Revisamos si el método actual tiene middlewares asignados
                if (isset($middlewaresMap[$controllerMethod])) {
                    $middlewares = $middlewaresMap[$controllerMethod];

                    if (is_array($middlewares)) {
                        foreach ($middlewares as $middlewareClass) {
                            $middleware = new $middlewareClass();
                            $middleware->handle();
                        }
                    }
                }
            }
        }
    }
}