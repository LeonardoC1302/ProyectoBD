<?php

namespace Model;

class ProductType extends ActiveRecordServer {
    protected static $table = 'productTypes';
    protected static $columns_db = ['id', 'productTypeName'];

    public $id;
    public $productTypeName;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->productTypeName = $args['productTypeName'] ?? '';
    }

}