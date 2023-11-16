<?php

namespace Model;

use Model\productsXsale;

class Sale extends ActiveRecordServer{
    protected static $db_postgreSQL;
    protected static $table = 'sales';
    protected static $columns_db = ['id', 'userId', 'saleDate', 'total', 'paymentId'];

    public $id;
    public $userId;
    public $saleDate;
    public $total;
    public $paymentId;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->userId = $args['userId'] ?? null;
        $this->saleDate = $args['saleDate'] ?? date("Y-m-d H:i:s");
        $this->total = $args['total'] ?? 0;
        $this->paymentId = $args['paymentId'] ?? null;
    }
    public static function setDbServer2($database){
        self::$db_postgreSQL = $database;
    }

    public function saveProducts($productsXcart, $saleId){
        foreach($productsXcart as $productXcart){
            $productXsale = new productsXsale([
                'saleId' => $saleId,
                'productId' => $productXcart->productId,
                'quantity' => $productXcart->quantity,
                'total' => $productXcart->price * $productXcart->quantity
            ]);
            $productXsale->save();
        }
    }
    public static function syncPostgre(){
        $sales = self::all();
        foreach ($sales as $sale) {
            $attributes = $sale->attributes();
    
            // Build the merge statement
            $query = "
                -- Insert a new record
                INSERT INTO orders (description, \"clientId\", date, total, status) VALUES ('','". $attributes["userId"]. "', '". $attributes["saleDate"]. "','". $attributes["total"]. "', 'en camino');
                ";
            $stmt = self::$db_postgreSQL->prepare($query);
            $stmt->execute();
        }
    }
}