<?php

namespace Model;

class Payment extends ActiveRecordServer{
    protected static $table = 'payments';
    protected static $columns_db = ['id', 'CardNumber', 'ExpiryDate', 'CVC', 'email', 'country', 'address'];

    public $id;
    public $CardNumber;
    public $ExpiryDate;
    public $CVC;
    public $email;
    public $country;
    public $address;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->CardNumber = $args['CardNumber'] ?? '';
        $this->ExpiryDate = $args['ExpiryDate'] ?? '';
        $this->CVC = $args['CVC'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->country = $args['country'] ?? '';
        $this->address = $args['address'] ?? '';
    }

    public function validate(){
        if(!$this->CardNumber) {
            self::$alerts['error'][] = 'The Card Number is mandatory';
        }
        if(!$this->ExpiryDate) {
            self::$alerts['error'][] = 'The Expiry Date is mandatory';
        } else {
            $date = date('Y-m-d');
            if($this->ExpiryDate < $date) {
                self::$alerts['error'][] = 'The Expiry Date is not valid';
            }
        }
        if(!$this->CVC) {
            self::$alerts['error'][] = 'The CVC is mandatory';
        }else if(strlen($this->CVC) != 3) {
            self::$alerts['error'][] = 'The CVC is not valid';
        }
        if(!$this->email) {
            self::$alerts['error'][] = 'The email is mandatory';
        }else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alerts['error'][] = 'The email is not valid';
        }
        if(!$this->country) {
            self::$alerts['error'][] = 'The country is mandatory';
        }
        if(!$this->address) {
            self::$alerts['error'][] = 'The address is mandatory';
        }
        return self::$alerts;
    }
}