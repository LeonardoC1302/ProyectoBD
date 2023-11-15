<?php

namespace Model;

class UserServer extends ActiveRecordServer {
    protected static $db;
    protected static $table = 'users';
    protected static $columns_db = ['id', 'name', 'surname', 'email', 'password', 'phone', 'admin', 'verified', 'token'];

    public $id;
    public $name;
    public $surname;
    public $email;
    public $password;
    public $phone;
    public $admin;
    public $verified;
    public $token;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->surname = $args['surname'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->phone = $args['phone'] ?? '';
        $this->admin = $args['admin'] ?? 0;
        $this->verified = $args['verified'] ?? 0;
        $this->token = $args['token'] ?? '';
    }

    public static function setDbServer($database){
        self::$db = $database;
    }
}