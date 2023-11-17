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
        $productsXcart = productsXCart::whereAll('cartId', $this->id);
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

    public function subtotal(){
        $productsXcart = productsXCart::whereAll('cartId', $this->id);
        $subtotal = 0;
        foreach($productsXcart as $productXcart){
            $subtotal += $productXcart->price * $productXcart->quantity;
        }
        return $subtotal;
    }

    public function shippingPrice(){
        $userServer = UserServer::where('email', $_SESSION['email']);
        $userLocation = $userServer->formatLocation();
        $productsXcart = productsXCart::whereAll('cartId', $this->id);
        if(empty($productsXcart)){
            return 0;
        }
        // Get which product is the farthest
        $maxDistance = 0;
        foreach($productsXcart as $productXcart){
            $product = Product::find($productXcart->productId);
            $productLocation = $product->formatLocation2();
            $distance = floatval( Product::distance($userLocation, $productLocation) );
            if($distance > $maxDistance){
                $maxDistance = $distance;
            }
        }
        // Calculate shipping price
        $shippingPrice = $maxDistance * 0.2;
        // Only 2 decimals
        $shippingPrice = number_format($shippingPrice, 2);
        return $shippingPrice;
    }

    public function totalPrice(){
        return $this->subtotal() + $this->shippingPrice();
    }

    public function clear(){
        $productsXcart = productsXCart::whereAll('cartId', $this->id);
        foreach($productsXcart as $productXcart){
            $productXcart->delete();
        }
    }
}