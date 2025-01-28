<?php

namespace MVC;

class View
{
    public static function render($view, $data = [], $layout = 'layout.php')
    {
        // Extraer las variables de $data como variables individuales
        extract($data);

        // Ruta de la vista
        $viewPath = __DIR__ . "/views/{$view}.php";
        if (!file_exists($viewPath)) {
            throw new \Exception("La vista {$view} no existe.");
        }

        // Capturar el contenido de la vista en un buffer
        ob_start();
        include $viewPath;
        $content = ob_get_clean();

        // Cargar el layout y pasarle el contenido
        $layoutPath = __DIR__ . "/views/{$layout}";
        if (file_exists($layoutPath)) {
            include $layoutPath;
        } else {
            // Si no existe un layout, renderizar directamente
            echo $content;
        }
    }
}
