<?php

namespace Controllers;
use MVC\Router;

class LoginController {
    public static function login(Router $router){
        $router->render('auth/login', [
        ]);
    }

    public static function logout(Router $router){
        $router->render('auth/logout', [
        ]);
    }

    public static function forgot(Router $router){
        $router->render('auth/forgot', [
        ]);
    }

    public static function recover(Router $router){
        $router->render('auth/recover', [
        ]);
    }

    public static function register(Router $router){
        $router->render('auth/register', [
        ]);
    }

    public static function verify(Router $router){
        $router->render('auth/verify', [
        ]);
    }

    public static function message(Router $router){
        $router->render('auth/message', [
        ]);
    }

}