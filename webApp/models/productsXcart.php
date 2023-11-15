<?php

namespace Model;

class productsXCart extends ActiveRecordServer{
    protected static $table = 'productsXCart';
    protected static $columns_db = ['id', 'cartId', 'productId', 'quantity', 'price'];

    public $id;
    public $cartId;
    public $productId;
    public $quantity;
    public $price;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->cartId = $args['cartId'] ?? null;
        $this->productId = $args['productId'] ?? null;
        $this->quantity = $args['quantity'] ?? 0;
        $this->price = $args['price'] ?? 0;
    }
}