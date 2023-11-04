<?php

namespace Controllers;
use MVC\Router;

class PagesController {
    public static function index(Router $router){
        $router->render('pages/index', [
        ]);
    }

    public static function products(Router $router){
        $router->render('pages/products', [
        ]);
    }

    public static function product(Router $router){
        $router->render('pages/product', [
        ]);
    }

    public static function contact(Router $router){
        $router->render('pages/contact', [
        ]);
    }

    public static function about(Router $router){
        $router->render('pages/about', [
        ]);
    }

    public static function cart(Router $router){
        $router->render('pages/cart', [
        ]);
    }

    public static function account(Router $router){
        $router->render('pages/account', [
        ]);
    }

    public static function orders(Router $router){
        $router->render('pages/orders', [
        ]);
    }
}