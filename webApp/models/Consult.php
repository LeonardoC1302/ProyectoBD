<?php 
namespace Model;

class Consult extends ActiveRecordPostgreSql{
    protected static $table = 'Fragmento3';
    protected static $columns_db = ['id','description','typeId','clientId','ordenId', 'date'];

    public $id;
    public $description;
    public $typeId;
    public $clientId;
    public $ordenId;
    public $date;


    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->description = $args['description'] ?? '';
        $this->typeId = $args['typeId'] ?? null;
        $this->clientId = $args['clientId'] ?? null;
        $this->ordenId = $args['ordenId'] ?? null;
        $this->date = $args['date'] ?? '';

    }
}