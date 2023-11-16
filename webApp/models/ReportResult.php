<?php

namespace Model;
class ReportResult extends ActiveRecord {
    protected static $table = 'results';
    protected static $columns_db = ['Name', 'TotalSalaryCost'];

    public $Name;
    public $TotalSalaryCost;

    public function __construct($args = []){
        $this->Name = $args['Name'] ?? '';
        $this->TotalSalaryCost = $args['TotalSalaryCost'] ?? null;
    }
}