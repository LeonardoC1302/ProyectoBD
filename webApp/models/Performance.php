<?php

namespace Model;
class Performance extends ActiveRecord {
    protected static $table = 'performance';
    protected static $columns_db = ['id', 'report', 'rating', 'employeeId'];

    public $id;
    public $report;
    public $rating;
    public $employeeId;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->report = $args['report'] ?? '';
        $this->rating = $args['rating'] ?? null;
        $this->employeeId = $args['employeeId'] ?? null;
    }
}