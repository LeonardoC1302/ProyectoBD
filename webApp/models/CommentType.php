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

    public function validate(){
        if(!$this->commentType) {
            self::$alerts['error'][] = 'You need to select a commentType';
        }
        
        if(!$this->priority) {
            self::$alerts['error'][] = 'A priority level was not selected';
        }
        return self::$alerts;
    }

}