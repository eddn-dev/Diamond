<?php

/**
 * Router.php
 * 
 * Este archivo contiene la lógica del enrutador para la aplicación web Diamond.
 * 
 * @author Edd n dev
 * @version 1.0
 *
 * Este enrutador se encarga de manejar las rutas de la aplicación web, 
 * dirigiendo las solicitudes HTTP a los controladores y acciones correspondientes.
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

        if ($method === 'GET') {
            $fn = $this->getRoutes[$url_actual] ?? null;
        } else {
            $fn = $this->postRoutes[$url_actual] ?? null;
        }

        if (!$fn) {
            // 404 Not Found
            header('HTTP/1.0 404 Not Found');
            View::render('404', [
                'title' => 'Página no encontrada'
            ]);
            return;
        }

        // Llamar a los middlewares del controlador si existen
        $this->execMiddlewaresMap($fn);

        // Finalmente, llama a la función o método del controlador
        call_user_func($fn, $this);
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
