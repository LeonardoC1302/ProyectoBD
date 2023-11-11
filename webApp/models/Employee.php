<?php 
namespace Model;

class Employee extends ActiveRecord{
    protected static $table = 'employee';
    protected static $columns_db = ['id', 'name', 'surname', 'email', 'phone', 'hours', 'pay', 'lastPay', 'rolId', 'countryId'];

    public $id;
    public $name;
    public $surname;
    public $email;
    public $phone;
    public $hours;
    public $pay;
    public $lastPay;
    public $rolId;
    public $countryId;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->surname = $args['surname'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->phone = $args['phone'] ?? '';
        $this->hours = $args['hours'] ?? null;
        $this->pay = $args['pay'] ?? 0;
        $this->lastPay = $args['lastPay'] ?? '';
        $this->rolId = $args['rolId'] ?? null;
        $this->countryId = $args['countryId'] ?? null;
    }
}
