<?php

namespace Controllers;
use MVC\Router;
use Model\Employee;
use Model\Product;
use Model\ProductType;
use Model\Warehouse;
use Model\Rol;
use Model\Department;
use Model\Country;


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
        $router->render('admin/employeeSearch', [
        ]);
    }

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

