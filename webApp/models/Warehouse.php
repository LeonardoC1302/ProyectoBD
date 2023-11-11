<?php

namespace Model;

class Warehouse extends ActiveRecordServer {
    protected static $table = 'warehouses';
    protected static $columns_db = ['id', 'warehouseName', 'addressId'];

    public $id;
    public $warehouseName;
    public $addressId;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->warehouseName = $args['warehouseName'] ?? '';
        $this->addressId = $args['addressId'] ?? null;
    }

}