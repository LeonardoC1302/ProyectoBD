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
use Model\ReportResult;
use Model\Sale;
use Model\UserServer;
use Model\ReportResult2;
use Model\Performance;

//all router->render functions enable the redirection to the wanted webpage

class Admincontroller { //Main page for admin functions
    public static function index(Router $router){
        isAdmin();
        $router->render('admin/index', [
        ]);
    }

    public static function employees(Router $router){ //Sends data from MySQL to employee.php
        isAdmin();
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

    public static function employeeSearch(Router $router){ //Recieves data from the form in EmployeeReport.php
        isAdmin();
        $employee = Employee::all();
        $rol = Rol::all();
        $country = Country::all();
        $department = Department::all();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(count($_POST) == 4){ //Queries all employees and their data
                $results = EmployeeResults::employeeQuery($_POST['Name'], $_POST['Surname'], $_POST['Rol'], $_POST['Country']);
            }else{
                $results = EmployeeResults::employeeQueryAll(); //Return all employees if data is not filled
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
        isAdmin();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $selectedDate = $_POST["selectedDate"];
            $date = date("Y-m-d", strtotime($selectedDate));
            $results = EmployeeResults::employeeQueryDate($date);

            if($_POST['selectedDate'] == ''){ //enables filtering by date
                $results = EmployeeResults::employeeQueryAll();
            }

        }else{
            $results = EmployeeResults::employeeQueryAll();
        }

        $payLog = SalaryLog::all();       //extracts log and performance data from sql
        $performance = Performance::all();
            
        $router->render('admin/employeeReport', [
            'results'=>$results,
            'payLog'=>$payLog,
            'performance'=>$performance
        ]);
    }

    public static function payment(Router $router){  //processes the payment updating employee data
        isAdmin();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $employee = Employee::find($id); 

            $log = new Salarylog();  //Inserts payment to pay log
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
        isAdmin();
        $results = '';
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if($_POST['filter'] == "" || $_POST['filter2'] == ""){
                $results = "None Selected";
            }

            if($_POST['filter2'] == "Salary"){  //takes the filters entered by user and searched data accordingly
                switch ($_POST['filter']) {
                    case "employees":
                        $results = ReportResult::filterByEmployee();
                        break;
                    case "roles":
                        $results = ReportResult::filterByRole();
                        break;
                    case "departments":
                        $results = ReportResult::filterByDepartment();
                        break;
                    case "countries":
                        $results = ReportResult::filterByCountry();
                        break;
                }
            }else{
                switch ($_POST['filter']) {
                    case "employees":
                        $results = ReportResult2::filterByEmployee2();
                        break;
                    case "roles":
                        $results = ReportResult2::filterByRole2();
                        break;
                    case "departments":
                        $results = ReportResult2::filterByDepartment2();
                        break;
                    case "countries":
                        $results = ReportResult2::filterByCountry2();
                        break;
                }
            }
        }
        $filter = $_POST['filter'];
        $filter2 = $_POST['filter2'];
        $router->render('admin/employeeReport2', [
            'results'=>$results,
            'filter'=>$filter,
            'filter2'=>$filter2
        ]);
    }

    public static function products(Router $router){
        isAdmin();
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
        isAdmin();
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
                $product->saveLinkedServer();
                // $product->save();
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
        isAdmin();
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
                $product->saveLinkedServer();
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
        isAdmin();
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

    public static function sales(Router $router){
        isAdmin();
        $sales = Sale::all();
        foreach($sales as $sale){
            $sale->products = $sale->getProducts();
        }

        $warehouses = Warehouse::all();
        $productTypes = ProductType::all();
        $products = Product::all();
        $users = UserServer::all();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if($_POST['date'] != ''){
                $sales = Sale::filterDate($sales, $_POST['date']);
            }
            if($_POST['productTypeId'] != ''){
                $sales = Sale::filterProductType($sales, $_POST['productTypeId']);
            }
            if($_POST['warehouseId'] != ''){
                $sales = Sale::filterWarehouse($sales, $_POST['warehouseId']);
            }
            if($_POST['productId'] != ''){
                $sales = Sale::filterProduct($sales, $_POST['productId']);
            }
        }
        
        $router->render('admin/sales', [
            'sales' => $sales,
            'warehouses' => $warehouses,
            'productTypes' => $productTypes,
            'products' => $products,
            'users' => $users
        ]);
        
    }
}

