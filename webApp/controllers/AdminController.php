<?php

namespace Controllers;
use MVC\Router;
use Model\Employee;
use Model\EmployeeResults;
use Model\Product;
use Model\ProductType;
use Model\Warehouse;
use Model\Rol;
use Model\Department;
use Model\Country;
use Model\ActiveRecord;


class Admincontroller {
    public static function index(Router $router){
        $router->render('admin/index', [
        ]);
        
    }

    public static function employees(Router $router){
        $employee = Employee::all();
        $rol = Rol::all();
        $country = Country::all();
        $department = Department::all();
        $router->render('admin/employees', [
            'employee' => $employee,
            'rol' => $rol,
            'country' => $country,
            'department' => $department
        ]);
        
    }

    public static function employeeSearch(Router $router){
        $employee = Employee::all();
        $rol = Rol::all();
        $country = Country::all();
        $department = Department::all();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(count($_POST) == 4){
                $results = EmployeeResults::employeeQuery($_POST['Name'], $_POST['Surname'], $_POST['Rol'], $_POST['Country']);
            }else{
                $results = EmployeeResults::employeeQueryAll();
            }
        }

        $router->render('admin/employeeSearch', [
            'employee' => $employee,
            'rol' => $rol,
            'country' => $country,
            'department' => $department,
            'results'=> $results
        ]);
    }
    //Employee Validations Search and Reports

    public static function employeeReport(Router $router){
        $router->render('admin/employeeReport', [
        ]);
    }

    public static function products(Router $router){
        $products = Product::all();
        $productTypes = ProductType::all();
        $warehouses = Warehouse::all();

        $router->render('admin/products', [
            'products' => $products,
            'productTypes' => $productTypes,
            'warehouses' => $warehouses
        ]);
    }

    public static function createProduct(Router $router){
        $router->render('admin/createProduct', [
        ]);
    }

    public static function updateProduct(Router $router){
        $router->render('admin/updateProduct', [
        ]);
    }

    public static function deleteProduct(Router $router){
        $router->render('admin/deleteProduct', [
        ]);
    }
}

