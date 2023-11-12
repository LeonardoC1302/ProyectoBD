<?php

namespace Model;

class Department extends ActiveRecord {
    protected static $table = 'department';
    protected static $columns_db = ['id', 'name'];

    public $id;
    public $name;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
    }

}