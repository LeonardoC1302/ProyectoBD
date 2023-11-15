<?php

namespace Model;

class Cart extends ActiveRecordServer{
    protected static $table = 'carts';
    protected static $columns_db = ['id', 'userId'];

    public $id;
    public $userId;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->userId = $args['userId'] ?? null;
    }

    public function addProduct($productId, $quantity = 1){
        $productsXcart = productsXCart::where('cartId', $this->id);
        // debug($productsXcart);
        $exists = false;
        foreach($productsXcart as $productXcart){
            if($productXcart->productId == $productId){
                $exists = true;
                $productXcart->quantity+= $quantity;
                $productXcart->save();
                break;
            }
        }

        if(!$exists){
            $productXcart = new productsXCart([
                'cartId' => $this->id,
                'productId' => $productId,
                'quantity' => $quantity,
                'price' => Product::find($productId)->price
            ]);
            $productXcart->save();
        }

    }
}