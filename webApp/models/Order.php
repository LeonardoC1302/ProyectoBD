<?php 
namespace Model;

class Order extends ActiveRecordPostgreSql{
    protected static $table = 'orders';
    protected static $columns_db = ['id','description','commentId','clientID','total', 'date', 'status'];

    public $id;
    public $description;
    public $clientId;
    public $total;
    public $date;
    public $status;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->description = $args['description'] ?? '';
        $this->clientId = $args['clientId'] ?? null;
        $this->total = $args['total'] ?? '';
        $this->date = $args['date'] ?? null;
        $this->status = $args['status'] ?? 0;
    }
}
