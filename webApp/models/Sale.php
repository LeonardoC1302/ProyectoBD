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
    public static function syncPostgre($sale){
        
            $attributes = $sale->attributes();
    
            $query = "
                -- Insert a new record
                INSERT INTO orders (description, \"clientId\", date, total, status) VALUES ('','". $attributes["userId"]. "', '". $attributes["saleDate"]. "','". $attributes["total"]. "', 'en camino');
                ";
            
            //debug($query);
            $stmt = self::$db_postgreSQL->prepare($query);
            $stmt->execute();
    }

    public function getProducts(){
        $productsXsale = productsXsale::all();
        $products = [];
        foreach($productsXsale as $productXsale){
            if($productXsale->saleId == $this->id){
                $product = Product::find($productXsale->productId);
                $product->quantity = $productXsale->quantity;
                $product->total = $productXsale->total;
                $products[] = $product;
            }
        }
        return $products;
    }

    public static function filterDate($sales, $dateString){
        $salesFiltered = [];
        
        // Convert input date string to a DateTime object
        $targetDate = new \DateTime($dateString);
    
        foreach($sales as $sale){
            // Convert sale date string to a DateTime object
            $saleDate = new \DateTime($sale->saleDate);
    
            // Compare dates without considering the time
            if($saleDate->format('Y-m-d') == $targetDate->format('Y-m-d')){
                $salesFiltered[] = $sale;
            }
        }
    
        return $salesFiltered;
    }

    public static function filterWarehouse($sales, $warehouseId){
        $salesFiltered = [];
        foreach($sales as $sale){
            $products = $sale->getProducts();
            foreach($products as $product){
                if($product->warehouseId == $warehouseId){
                    $salesFiltered[] = $sale;
                    break;
                }
            }
        }
        return $salesFiltered;
    }

    public static function filterProductType($sales, $productTypeId){
        $salesFiltered = [];
        foreach($sales as $sale){
            $products = $sale->getProducts();
            foreach($products as $product){
                if($product->productTypeId == $productTypeId){
                    $salesFiltered[] = $sale;
                    break;
                }
            }
        }
        return $salesFiltered;
    }

    public static function filterProduct($sales, $productId){
        $salesFiltered = [];
        foreach($sales as $sale){
            $products = $sale->getProducts();
            foreach($products as $product){
                if($product->id == $productId){
                    $salesFiltered[] = $sale;
                    break;
                }
            }
        }
        return $salesFiltered;
    }
    
}