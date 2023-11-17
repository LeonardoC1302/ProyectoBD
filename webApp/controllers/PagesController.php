<?php

namespace Controllers;

use Model\Cart;
use Model\Product;
use Model\productsXCart;
use Model\productsXsale;
// use Model\UserServer;
use Model\User;
use Model\Payment;
use Model\Sale;
use Model\ProductType;
use Model\UserServer;
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
        isAuth();
        $productsXcart = productsXCart::whereAll('cartId', $_SESSION['cartId']);

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
                $productsXcart = productsXCart::whereAll('cartId', $_SESSION['cartId']);
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
        isAuth();
        $alerts = [];
        $productsXcart = productsXCart::whereAll('cartId', $_SESSION['cartId']);

        $products = [];
        foreach($productsXcart as $productXcart){
            $product = Product::find($productXcart->productId);
            $products[] = [$product, $productXcart->quantity];
        }
        $cart = Cart::find($_SESSION['cartId']);

        if($cart->subtotal() == 0){
            header('Location: /cart');
        }

        $payment = new Payment();

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $payment->sync($_POST);
            $alerts = $payment->validate();

            if(empty($alerts['error'])){
                $result = $payment->save();
                $userId = UserServer::where('email', $_SESSION['email'])->id;
                $sale = new Sale([
                    'userId' => $userId,
                    'total' => $cart->totalPrice(),
                    'paymentId' => $result['id']
                ]);
                $result = $sale->save();
                $saleId = $result['id'];
                $sale->saveProducts($productsXcart, $saleId);
                Sale::syncPostgre();
                $cart->clear();
                header('Location: /products');
            }
        }

        $router->render('pages/checkout', [
            'products' => $products,
            'cart' => $cart,
            'alerts' => $alerts,
            'payment' => $payment
        ]);
    }

    public static function account(Router $router){
        isAuth();
        $alerts = [];
        $user = User::find($_SESSION['id']);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $fullName = $user->name . ' ' . $user->surname;
            $auth = new User($_POST);
            $auth->sync($_POST);
            $alerts = $auth->validateUpdate();

            if($_POST['currentPassword'] || $_POST['password1'] || $_POST['password2']) {
                // append to the alerts array
                $alerts = array_merge($alerts, $user->validatePasswordChange($_POST['currentPassword'], $_POST['password1'], $_POST['password2']));
                if(empty($alerts['error'])){
                    $user->password = $_POST['password1'];
                    $user->hashPassword();
                    $result = $user->save();
                    User::syncSQLServer();
                    User::syncPostgre($fullName);
                }
            }
            
            if(empty($alerts['error'])){
                $user->name = $auth->name;
                $user->surname = $auth->surname;
                $user->email = $auth->email;
                $user->phone = $auth->phone;
                $user->save();
                User::syncSQLServer();
                User::syncPostgre($fullName);
                User::setAlerts('success', 'The user was updated successfully');
            }
        }

        $alerts = User::getAlerts();
        $router->render('pages/account', [
            'user' => $user,
            'alerts' => $alerts
        ]);
    }

    public static function orders(Router $router){
        isAuth();
        $router->render('pages/orders', [
        ]);
    }
}