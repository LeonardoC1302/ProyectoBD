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

            </tr>
        </thead>

        <tbody>
            <?php foreach($products as $product){ ?>
            <form method="POST">
                    <td><?php echo $product[0]->productName; ?></td>
                    <td> <img loading="lazy" src="/images/<?php echo $product[0]->image; ?>"> </td>
                    <td>$<?php echo $product[0]->price; ?></td>
                    <input type="hidden" name="id" value="<?php echo $product[0]->id ?>">
                    <td><input type="number" id="quantity" name="quantity" value="<?php echo $product[1] ?>" min="1"></td>
                    <td>$<?php echo $product[0]->price * intval($product[1]);?></td>
                    <td><button type="submit" name="delete"> <i class='bx bx-trash'></i> </button></td>
                </tr>
            </form>
            <?php } ?>

        </tbody>
    </table>

    <div class="button-container">
        <a class="button" href="/products">Return to Shop</a>
        <button class="button" type="submit" name="update"> Update Cart </button>
    </div>

    <div class="box">
        <h2>Cart Total</h2>
        <p>Subtotal: <span>$14.72</span></p>
        <p>Shipping: <span>$15.28</span></p>
        <p>Total: <span>$30.00</span></p>

        <button class="red-button" type="submit" name="checkout"> Proceed to checkout </button>
    </div>
</div>

</form>
