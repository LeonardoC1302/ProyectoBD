<?php

namespace Controllers;
use MVC\Router;
use Model\Order;

class HelpController {
    public static function apply(Router $router){
        $router->render('help/apply', [
        ]);
        
    }

    public static function service(Router $router){
        $router->render('help/service', [
        ]);
        
    }public static function serviceEmp(Router $router){
        $alerts = [];
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            if (!empty($_GET['search'])) {
                $clientOrderId = (int)$_GET['search'];
            if(empty($alerts['error'])){
                // check if order exists
                $order = Order::find($clientOrderId);
                if($order){
                    header("Location: /orderInfo?id={$clientOrderId}");
                }
                
                 else{
                    Order::setAlerts('error', 'The order does not exist');
                }
            }}else{
                Order::setAlerts('error', 'Insert a client Order ID');
             
            }}
        

        $alerts = Order::getAlerts();
        $router->render('help/serviceEmp', [
            'alerts' => $alerts
        ]);
    }

    public static function serviceEmp2(Router $router){
        $alerts = [];
        $clientOrderId = isset($_GET['id']) ? (int)$_GET['id'] : null;
        $clientOrderId = filter_var($clientOrderId, FILTER_VALIDATE_INT);
        $orderInfo = Order::orderQuery($clientOrderId);
        $router->render('help/serviceEmp2', [
        'orderInfo'=>$orderInfo
        ]);
        
    }

    public static function report(Router $router){
        $router->render('help/report', [
        ]);
        
    }

    public static function consult(Router $router){
        $router->render('help/consult', [
        ]);
        
    }

    public static function returns(Router $router){
        $router->render('help/returns', [
        ]);
        
    }

    public static function international(Router $router){
        $router->render('help/international', [
        ]);
        
    }

    public static function policies(Router $router){
        $router->render('help/policies', [
        ]);
        
    }
}