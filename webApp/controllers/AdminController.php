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
use Model\Salarylog;
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
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $selectedDate = $_POST["selectedDate"];
            $date = date("Y-m-d", strtotime($selectedDate));
            $results = EmployeeResults::employeeQueryDate($date);

        }else{
            $results = EmployeeResults::employeeQueryAll();
        }

        $payLog = SalaryLog::all();
            
        $router->render('admin/employeeReport', [
            'results'=>$results,
            'payLog'=>$payLog
        ]);
    }

    public static function payment(Router $router){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $employee = Employee::find($id); 

            $log = new Salarylog();
            $log->description = "Pago a " . $employee->name . " " . $employee->surname . " el dia " . date("Y-m-d") . ", Con un monto de: ₡" . round($_POST['totalSalary'], 2);
            $log->amount = (float)round($_POST['totalSalary'], 2);
            $log->datePayed = date("Y-m-d");
            $log->employeeId = (int)$_POST['id'];
            $log->save();

            $employee->hours = 0;
            $employee->lastPay = date("Y-m-d");
            $employee->pay = 1;

            $employee->save();
        }
            header('Location: /admin/employeeReport ');
    }

    public static function employeeReport2(Router $router){
        $router->render('admin/employeeReport2', [
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

