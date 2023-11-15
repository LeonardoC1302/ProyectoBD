<?php

namespace Model;

class Sale extends ActiveRecordServer{
    protected static $table = 'sales';
    protected static $columns_db = ['id', 'userId', 'saleDate', 'total'];

    public $id;
    public $userId;
    public $saleDate;
    public $total;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->userId = $args['userId'] ?? null;
        $this->saleDate = $args['saleDate'] ?? date("Y-m-d H:i:s");
        $this->total = $args['total'] ?? 0;
    }
}