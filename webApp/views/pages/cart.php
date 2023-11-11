

<h1>Shopping Cart</h1>
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
            <tr>
                <td>Erlenmeyer Flask, 250mL</td>
                <td> <img loading="lazy" src="/images/erlenmeyer.png" > </td>
                <td>$7.36</td>
                <td><input type="number" id="quantity" name="quantity" value="1" min="1"></td>
                <td>$7.36</td>
    
            </tr>
            <tr>
                <td>Erlenmeyer Flask, 350mL</td>
                <td> <img loading="lazy" src="/images/erlenmeyer.png" > </td>
                <td>$7.36</td>
                <td><input type="number" id="quantity" name="quantity" value="1" min="1"></td>
                <td>$7.36</td>
               
            </tr>
        </tbody>
    </table>
    
    <div class="button-container" >
        <a class="button" href="/products">Return to Shop</a>
        <a class="button" href="/cart">Update Cart</a>
    </div>

    <div class="box">
        <h2>Cart Total</h2>
        <p>Subtotal: <span>$14.72</span></p>
        <p>Shipping: <span>$15.28</span></p>
        <p>Total: <span>$30.00</span></p>
    
        <a class="red-button" href="/checkout">Proceed to checkout</a>
    </div>
</div>


