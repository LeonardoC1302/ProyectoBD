<?php

namespace Model;

class Product extends ActiveRecordServer {
    protected static $table = 'products';
    protected static $columns_db = ['id', 'productName', 'location', 'stock', 'price', 'image', 'productTypeId', 'warehouseId', 'description'];

    public $id;
    public $productName;
    public $location;
    public $stock;
    public $price;
    public $image;
    public $productTypeId;
    public $warehouseId;
    public $description;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->productName = $args['productName'] ?? '';
        $this->location = $args['location'] ?? '';
        $this->stock = $args['stock'] ?? '';
        $this->price = $args['price'] ?? '';
        $this->image = $args['image'] ?? '';
        $this->productTypeId = $args['productTypeId'] ?? null;
        $this->warehouseId = $args['warehouseId'] ?? null;
        $this->description = $args['description'] ?? '';
    }

}