<?php

namespace Controllers;
use MVC\Router;
use Model\Order;
use Model\Client;
use Model\CommentType;
use Model\Comment;
use Model\Consult;

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
        $orderInfo = Order::iDQuery($clientOrderId);
        $clientInfo= Client::iDQuery($orderInfo[0]['clientId'] );
        $router->render('help/serviceEmp2', [
        'orderInfo'=>$orderInfo,
        'clientInfo'=>$clientInfo
        ]);
        
    }

    public static function report(Router $router){
        $alerts = [];
        $clientOrderId = isset($_GET['id']) ? (int)$_GET['id'] : null;
        $clientOrderId = filter_var($clientOrderId, FILTER_VALIDATE_INT);
        $orderInfo = Order::iDQuery($clientOrderId);
        $clientInfo= Client::iDQuery($orderInfo[0]['clientId'] );
        $type = CommentType::all();
        $date = date('Y-m-d');
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $reportType = (int)$_POST["Type"];
                $description = $_POST["Description"];
                $comment = new Comment();
                $comment->create($description, 0,$reportType,$orderInfo[0]['clientId'], $clientOrderId, $date);
                header("Location: /orderInfo?id={$clientOrderId}");
        }
        $router->render('help/report', [
            'orderInfo'=>$orderInfo,
            'clientInfo'=>$clientInfo,
            'comment'=>$type
        ]);
        
    }

    public static function consult(Router $router){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $whereClause = ""; 
            
            $selectedDate = $_POST['selectedDate'];

            if (!empty($selectedDate)) {
                $consultInfo = Consult::dateQuery($selectedDate);
            }
            else {
                $consultInfo = Consult::dateAll();
            }
            $clientNames = [];
            $i=0;
            foreach ($consultInfo as $c) {
                $clientInfo = Client::iDQuery($consultInfo[$i]['clienteId']);
                if (!empty($clientInfo)) {
                    $clientNames[$consultInfo[$i]['clienteId']] = $clientInfo[0]['name'];
                }
                $i++;
            }
            
            $i=0;
            foreach ($consultInfo as &$info) {
                $clientId = $consultInfo[$i]['clienteId'];
                if (isset($clientNames[$clientId])) {
                    $consultInfo[$i]['clientName'] = $clientNames[$clientId];
                }$i++;
            }
            unset($info);
            $typesNames = [];
            $i=0;
            foreach ($consultInfo as $c) {
                $typeInfo = CommentType::iDQuery($consultInfo[$i]['typeId']);
                if (!empty($typeInfo)) {
                    $typesNames[$consultInfo[$i]['typeId']] = $typeInfo[0]['commentType'];
                }
                $i++;
            }
            
            $i=0;
            foreach ($consultInfo as &$info) {
                $typeId = $consultInfo[$i]['typeId'];
                if (isset($typesNames[$typeId])) {
                    $consultInfo[$i]['typeName'] = $typesNames[$typeId];
                }$i++;
            }
            unset($info);
    }
        $router->render('help/consult', [
            'consultInfo'=>$consultInfo
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