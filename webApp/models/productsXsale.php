<?php

namespace Model;

class productsXsale extends ActiveRecordServer{
    protected static $table = 'productXsales';
    protected static $columns_db = ['id', 'saleId', 'productId', 'quantity', 'total'];

    public $id;
    public $saleId;
    public $productId;
    public $quantity;
    public $total;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->saleId = $args['saleId'] ?? null;
        $this->productId = $args['productId'] ?? null;
        $this->quantity = $args['quantity'] ?? 0;
        $this->total = $args['total'] ?? 0;
    }
}