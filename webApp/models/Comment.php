<?php 
namespace Model;

class Comment extends ActiveRecordPostgreSql{
    protected static $table = 'comment';
    protected static $columns_db = ['id','description','resolved','typeId','clientId','ordenId', 'date'];

    public $id;
    public $description;
    public $resolved;
    public $typeId;
    public $clientId;
    public $ordenId;
    public $date;


    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->description = $args['description'] ?? '';
        $this->resolved = $args['resolved'] ?? 0;
        $this->typeId = $args['typeId'] ?? null;
        $this->clientId = $args['clientId'] ?? null;
        $this->ordenId = $args['ordenId'] ?? null;
        $this->date = $args['date'] ?? '';

    }

    public function validate(){
        if(!$this->typeId) {
            self::$alerts['error'][] = 'You need to select a type for the comment';
        }
        
        if(!$this->description) {
            self::$alerts['error'][] = 'No description was added';
        }
        return self::$alerts;
    }
}