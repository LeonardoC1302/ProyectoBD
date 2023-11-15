<div class="checkout">
    <div class="leftBlock">
    <form method="POST">
        <h4>Shipping Information</h4>
        <div class="form__field">
            <label for="email" class="form__label">Email:</label>
            <input class="form__input" type="email" id="email" placeholder="Your email" name="email">
        </div>
        <div class="form__field">
            <label for="address" class="form__label">Shipping Address:</label>
            <input class="form__input" type="text" id=" country" placeholder="Your country" name="country">
            <input class="form__input" type="text" id="address" placeholder="Your address" name="address">
        </div>
        <div class="form__field">
            <label for="address" class="form__label">Card Information:</label>
            <input class="form__input" type="text" id=" card" placeholder="1234 1234 1234" name="card">
            <input class="form__input" type="text" id="expDate" name="expDate" placeholder="MM/YY" pattern="(0[1-9]|1[0-2])\/\d{2}" title="Please enter a valid MM/YY format">
            <input class="form__input" type="text" id=" cvc" placeholder="CVC" name="cvc">
        </div>


    </div>



    <div class="rightBlock">
        <div class="rightBlock__productsPrice">
            <p class="total"> Total</p>
            <p class="price">$<?php echo $cart->totalPrice(); ?></p>

            <?php foreach($products as $product){ ?>
                <div class="rightBlock__productsInfo">
                    <div class="rightBlock__productsInfo__productRow">
                        <img loading="lazy" src="/images/<?php echo $product[0]->image; ?>">
                        <div class="text">
                            <p class="prodName"><?php echo $product[0]->productName; ?></p>
                            <p class="prodQuantity"> Quantity: <?php echo $product[1]; ?> </p>
                        </div>
                        <p class="prodPrice">$<?php echo $product[0]->price * intval($product[1]);?></p>
                    </div>
                </div>
            <?php } ?>

                <div class="rightBlock__productsInfo__productRow">
                    <p class="subTotal"> Sub total: </p>
                    <p class="subTotalPrice">$<?php echo $cart->subtotal(); ?></p>
                </div>

                <div class="rightBlock__productsInfo__productRow">
                    <p class="shipping"> Shipping: </p>
                    <p class="shippingPrice">$<?php echo $cart->shippingPrice(); ?></p>
                </div>

                <div class="rightBlock__productsInfo__productRow">
                    <p class="total"> Total Due: </p>
                    <p class="totalPrice">$<?php echo $cart->totalPrice(); ?></p>
                </div>

                <button class="red-button" type="submit"> Pay </button>


            </div>

        </div>

    </div>

</form>



</div>