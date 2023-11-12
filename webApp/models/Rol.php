<?php

namespace Model;

class Rol extends ActiveRecord {
    protected static $table = 'rol';
    protected static $columns_db = ['id', 'rol', 'description', 'salary', 'departmentId'];

    public $id;
    public $rol;
    public $description;
    public $salary;
    public $departmentId;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->rol = $args['rol'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->salary = $args['salary'] ?? null;
        $this->departmentId = $args['departmentId'] ?? null;
    }

}