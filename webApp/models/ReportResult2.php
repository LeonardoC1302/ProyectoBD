<?php

namespace Model;
class ReportResult2 extends ActiveRecord {
    protected static $table = 'results2';
    protected static $columns_db = ['Name', 'SocialChargeCost'];

    public $Name;
    public $SocialChargeCost;

    public function __construct($args = []){
        $this->Name = $args['Name'] ?? '';
        $this->SocialChargeCost = $args['SocialChargeCost'] ?? null;
    }
}