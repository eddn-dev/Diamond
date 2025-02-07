<?php

namespace Controllers;

use MVC\Router;
use MVC\View;

class LocationController {
    public static function middlewaresMap(){
        return [
            'landing' => []
        ];
    }

    public static function landing(Router $router) {
        
        View::render('site/landing', [
            'title'         => 'Inicio'
        ], 'layout.php');
    }
}