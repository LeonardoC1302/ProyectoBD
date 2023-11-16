<h1>Shopping Cart</h1>
<form method="POST">
    <div class="cart-container">
        <table class="cart">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($products as $product){ ?>
                <tr>
                    <td><?php echo $product[0]->productName; ?></td>
                    <td> <img loading="lazy" src="/images/<?php echo $product[0]->image; ?>"> </td>
                    <td>$<?php echo $product[0]->price; ?></td>
                    <td>
                        <input type="number" name="quantity[]" value="<?php echo $product[1] ?>" min="1">
                        <input type="hidden" name="product_ids[]" value="<?php echo $product[0]->id ?>">
                    </td>
                    <td>$<?php echo $product[0]->price * intval($product[1]);?></td>
                    <td>
                    <button type="submit" name="delete" value="<?php echo $product[0]->id; ?>">
                        <i class='bx bx-trash'></i>
                    </button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="button-container">
            <a class="button" href="/products">Return to Shop</a>
            <button class="button" type="submit" name="update"> Update Cart </button>
        </div>
</form>

        <div class="box">
            <h2>Cart Total</h2>
            <p>Subtotal: <span>$<?php echo $cart->subtotal(); ?></span></p>
            <p>Shipping: <span>$<?php echo $cart->shippingPrice(); ?></span></p>
            <p>Total: <span>$<?php echo $cart->totalPrice(); ?></span></p>

            <a class="red-button" href="/checkout"> Proceed to checkout </a>
        </div>
    </div>
