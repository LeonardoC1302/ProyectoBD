<?php

namespace Model;

class Product extends ActiveRecordServer {
    protected static $table = 'products';
    protected static $columns_db = ['id', 'productName', 'location', 'stock', 'price', 'image', 'productTypeId', 'warehouseId', 'description'];

    public $id;
    public $productName;
    public $location;
    public $stock;
    public $price;
    public $image;
    public $productTypeId;
    public $warehouseId;
    public $description;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->productName = $args['productName'] ?? '';
        $this->location = $args['location'] ?? 'null';
        $this->stock = $args['stock'] ?? '';
        $this->price = $args['price'] ?? '';
        $this->image = $args['image'] ?? '';
        $this->productTypeId = $args['productTypeId'] ?? null;
        $this->warehouseId = $args['warehouseId'] ?? null;
        $this->description = $args['description'] ?? '';
    }

    public function validate(){
        if(!$this->productName) {
            self::$alerts['error'][] = 'The Product Name is mandatory';
        }
        if(!$this->stock) {
            self::$alerts['error'][] = 'The Stock is mandatory';
        } else if(!is_numeric($this->stock)) {
            self::$alerts['error'][] = 'The Stock must be a number';
        } else if($this->stock < 0) {
            self::$alerts['error'][] = 'The Stock must be greater than 0';
        }
        if(!$this->price) {
            self::$alerts['error'][] = 'The Price is mandatory';
        }
        if(!$this->image) {
            self::$alerts['error'][] = 'The Image is mandatory';
        }
        if(!$this->productTypeId) {
            self::$alerts['error'][] = 'The Product Type is mandatory';
        }
        if(!$this->warehouseId) {
            self::$alerts['error'][] = 'The Warehouse is mandatory';
        }
        if(!$this->description) {
            self::$alerts['error'][] = 'The Description is mandatory';
        }
        return self::$alerts;
    }

    public function setImage($image){
        // Delete the previous image
        if(!is_null($this->id)){
            $this->deleteImage();
        }

        if($image){
            $this->image = $image;
        }
    }

    public function deleteImage(){
        $fileExists = file_exists(IMAGES_DIR . $this->image);
        if($fileExists){
            unlink(IMAGES_DIR . $this->image);
        }
    }

    public function formatLocation()
{
    // Assuming $this->location contains the binary representation of the geometry
    // Adjust the column name and table name as needed
    $sql = "SELECT TOP 1 location.STAsText() AS location_text FROM " .static::$table . " WHERE id = :id";
    $stmt = self::$db->prepare($sql);
    $stmt->bindParam(':id', $this->id, \PDO::PARAM_INT);
    // debug($sql);
    $stmt->execute();
    $result = $stmt->fetch(\PDO::FETCH_ASSOC);

    if ($result) {
        // Assuming 'location_text' is the alias used in the SQL query
        return $result['location_text'];
    } else {
        return null; // or handle the case where the location is not found
    }
}

}