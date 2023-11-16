<?php 
namespace Model;

class Client extends ActiveRecordPostgreSql{
    protected static $table = 'clients';
    protected static $columns_db = ['id','contact','name'];

    public $id;
    public $contact;
    public $name;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->contact = $args['description'] ?? '';
        $this->name = $args['clientId'] ?? '';
    }
}
