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
use Model\productsXCart;
use Model\productsXsale;
use Intervention\Image\ImageManagerStatic as Image;


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

        $result = $_GET['result'] ?? null;
        $error = $_GET['error'] ?? null;

        $router->render('admin/products', [
            'products' => $products,
            'productTypes' => $productTypes,
            'warehouses' => $warehouses,
            'result' => $result,
            'error' => $error
        ]);
    }

    public static function createProduct(Router $router){
        $warehouses = Warehouse::all();
        $productTypes = ProductType::all();

        $alerts = [];
        $product = new Product();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $product->sync($_POST);
            $imageName = md5(uniqid(rand(), true)) .  '.jpg';
            if($_FILES['image']['tmp_name']){
                $image = Image::make($_FILES['image']['tmp_name'])->fit(800, 600);
                $product->setImage($imageName);
            }
            $alerts = $product->validate();
            if(empty($alerts)){
                if(!is_dir(IMAGES_DIR)){
                    mkdir(IMAGES_DIR);
                }
                $image->save(IMAGES_DIR . $imageName);
                $product->save();
                header('Location: /admin/products?result=1');
            }
        }

        $alerts = Product::getAlerts();
        $router->render('admin/createProduct', [
            'warehouses' => $warehouses,
            'productTypes' => $productTypes,
            'alerts' => $alerts,
            'product' => $product
        ]);
    }

    public static function updateProduct(Router $router){
        $id = validateORredirect('/admin/products');
        $product = Product::find($id);
        $alerts = [];

        $warehouses = Warehouse::all();
        $productTypes = ProductType::all();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $product->sync($_POST);
            if($product->location == ''){
                $product->location = 'null';
            }
            if($_FILES['image']['name'] != ""){
                $imageName = md5(uniqid(rand(), true)) .  '.jpg';
                if($_FILES['image']){
                    $image = Image::make($_FILES['image']['tmp_name'])->fit(800, 600);
                    $product->setImage($imageName);
                    if(!is_dir(IMAGES_DIR)){
                        mkdir(IMAGES_DIR);
                    }
                    $image->save(IMAGES_DIR . $imageName);
                }
            }

            $alerts = $product->validate();
            if(empty($alerts)){
                // debug($product);
                $product->save();
                header('Location: /admin/products?result=2');
            }

        }

        $router->render('admin/updateProduct', [
            'warehouses' => $warehouses,
            'productTypes' => $productTypes,
            'alerts' => $alerts,
            'product' => $product
        ]);
    }

    public static function deleteProduct(Router $router){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // debug($_POST['id']);
            $id = $_POST['id'];
            $product = Product::find($id); 
            // debug($product);
            $valid = true;

            $productsCart = productsXCart::all();
            // debug($productsCart);
            foreach($productsCart as $prod){
                if($prod->productId == $id){
                    $valid = false;
                }
            }


            $productsSale = productsXsale::all();
            foreach($productsSale as $prod){
                if($prod->productId == $id){
                    $valid = false;
                }
            }
            if($valid){
                $product->delete();
                header('Location: /admin/products?result=3');
            }else{
                header('Location: /admin/products?error=1');
            }
        }
    }
}

