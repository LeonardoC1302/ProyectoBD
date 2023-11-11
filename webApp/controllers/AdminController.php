<?php

namespace Controllers;
use MVC\Router;
use Model\Employee;


class Admincontroller {
    public static function index(Router $router){
        $router->render('admin/index', [
        ]);
        
    }

    public static function employees(Router $router){
        $employee = Employee::all();
        $router->render('admin/employees', [
            'employee' => $employee
        ]);
        
    }

    public static function employeeSearch(Router $router){
        $router->render('admin/employeeSearch', [
        ]);
        
    }
}

