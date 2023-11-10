<?php

namespace Controllers;
use MVC\Router;


class Admincontroller {
    public static function index(Router $router){
        $router->render('admin/index', [
        ]);
        
    }

    public static function employees(Router $router){
        $router->render('admin/employees', [
        ]);
        
    }

    public static function employeeSearch(Router $router){
        $router->render('admin/employeeSearch', [
        ]);
        
    }
}

