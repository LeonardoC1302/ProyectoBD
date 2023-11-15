<?php

namespace Controllers;

use Model\Cart;
use Model\Product;
use Model\UserServer;
use Model\ProductType;
use MVC\Router;

class PagesController {
    public static function index(Router $router){
        $products = Product::all();
        $categories = ProductType::all();
        $router->render('pages/index', [
            'mainPage' => true,
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public static function products(Router $router){
        $products = Product::all();
        $router->render('pages/products', [
            'mainPage' => true,
            'products' => $products
        ]);
    }

    public static function product(Router $router){
        $id = $_GET['id'] ?? null;
        if(!$id){
            header('Location: /products');
        }
        

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $cart = Cart::find($_SESSION['cartId']);
            $cart->addProduct($id, $_POST['quantity'] ?? 1);
        }

        $product = Product::find($id);

        $router->render('pages/product', [
            'mainPage' => true,
            'product' => $product
        ]);
    }

    public static function contact(Router $router){
        $router->render('pages/contact', [
        ]);
    }

    public static function about(Router $router){
        $router->render('pages/about', [
        ]);
    }

    public static function cart(Router $router){
        $router->render('pages/cart', [
        ]);
    }

    public static function checkout(Router $router){
        $router->render('pages/checkout', [
        ]);
    }

    public static function account(Router $router){
        $router->render('pages/account', [
        ]);
    }

    public static function orders(Router $router){
        $router->render('pages/orders', [
        ]);
    }
}