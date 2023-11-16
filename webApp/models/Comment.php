<?php 
namespace Model;

class Comment extends ActiveRecordPostgreSql{
    protected static $table = 'comment';
    protected static $columns_db = ['id','description','resolved','typeId','clientId','ordenId'];

    public $id;
    public $description;
    public $resolved;
    public $typeId;
    public $clientId;
    public $ordenId;


    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->description = $args['description'] ?? '';
        $this->resolved = $args['resolved'] ?? 0;
        $this->typeId = $args['typeId'] ?? null;
        $this->clientId = $args['clientId'] ?? null;
        $this->ordenId = $args['ordenId'] ?? null;

    }
}