<?php

namespace Model;

class Country extends ActiveRecord {
    protected static $table = 'country';
    protected static $columns_db = ['id', 'name'];

    public $id;
    public $name;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
    }

}