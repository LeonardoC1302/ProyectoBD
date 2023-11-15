<?php

namespace Controllers;

use Model\Cart;
use Model\Product;
use Model\productsXCart;
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
            header('Location: /products');
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
        $productsXcart = productsXCart::where('cartId', $_SESSION['cartId']);

        $products = [];
        foreach($productsXcart as $productXcart){
            $product = Product::find($productXcart->productId);
            $products[] = [$product, $productXcart->quantity];
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if (isset($_POST["delete"])) {
                $productXcart = productsXCart::findProductInCart($_SESSION['cartId'], $_POST['delete']);
                $productXcart[0]->delete();
                header('Location: /cart');
            } elseif (isset($_POST["update"])) {
                $productsXcart = productsXCart::where('cartId', $_SESSION['cartId']);
                foreach($productsXcart as $productXcart){
                    foreach($_POST['quantity'] as $key => $quantity){
                        if($productXcart->productId == $_POST['product_ids'][$key]){
                            $productXcart->quantity = $quantity;
                            break;
                        }
                    }
                    $productXcart->save();
                }
                header('Location: /cart');
            } elseif (isset($_POST["checkout"])) {
                // Handle proceed to checkout action
                debug( "Proceed to Checkout button clicked");
            }
        }

        $cart = Cart::find($_SESSION['cartId']);

        $router->render('pages/cart', [
            'products' => $products,
            'cart' => $cart
        ]);
    }

    public static function checkout(Router $router){
        $productsXcart = productsXCart::where('cartId', $_SESSION['cartId']);

        $products = [];
        foreach($productsXcart as $productXcart){
            $product = Product::find($productXcart->productId);
            $products[] = [$product, $productXcart->quantity];
        }
        $cart = Cart::find($_SESSION['cartId']);

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            debug($_POST);
        }

        $router->render('pages/checkout', [
            'products' => $products,
            'cart' => $cart
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