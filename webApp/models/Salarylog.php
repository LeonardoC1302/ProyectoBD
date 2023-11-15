<?php

namespace Model;

class Salarylog extends ActiveRecord {
    protected static $db_server;
    protected static $table = 'salarylog';
    protected static $columns_db = ['id', 'description', 'amount', 'datePayed', 'employeeId'];

    public $id;
    public $description;
    public $amount;
    public $datePayed;
    public $employeeId;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->description = $args['description'] ?? '';
        $this->amount = $args['amount'] ?? null;
        $this->datePayed = $args['datePayed'] ?? '';
        $this->employeeId = $args['employeeId'] ?? null;
    }
}