<?php

namespace Controllers;
use MVC\Router;

class HelpController {
    public static function apply(Router $router){
        $router->render('help/apply', [
        ]);
        
    }

    public static function service(Router $router){
        $router->render('help/service', [
        ]);
        
    }

    public static function returns(Router $router){
        $router->render('help/returns', [
        ]);
        
    }

    public static function international(Router $router){
        $router->render('help/international', [
        ]);
        
    }

    public static function policies(Router $router){
        $router->render('help/policies', [
        ]);
        
    }
}