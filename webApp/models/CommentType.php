<?php 
namespace Model;

class CommentType extends ActiveRecordPostgreSql{
    protected static $table = 'type';
    protected static $columns_db = ['id','commentType','priority'];

    public $id;
    public $commentType;
    public $priority;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->commentType = $args['commentType'] ?? '';
        $this->priority = $args['priority'] ?? '';
    }
}