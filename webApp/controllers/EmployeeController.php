<?php

namespace Controllers;
use MVC\Router;


class EmployeeController {
    public static function employees(Router $router){
        $router->render('admin/employees', [
        ]);
        
    }

    public static function employeesSearch(Router $router){
        $router->render('admin/employeeSearch', [
        ]);
        
    }
}

