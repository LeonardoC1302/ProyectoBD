<div class="product-details">
    <div class="detail">
        <div class="main-info">
            <div class="product-images">
                <div class="main-image">
                    <img loading="lazy" src="/images/<?php echo $product->image; ?>" alt="product">
                </div>
                <div class="small-image">
                    <img loading="lazy" src="/images/<?php echo $product->image; ?>" alt="product">
                </div>
            </div>
        </div>
        <div class="product-info">
            <p class="info-name"><?php echo $product->productName; ?></p>
            <p class="info-price">$ <?php echo $product->price; ?><span>+Shipping: US $20.3</span></p>
            <p class="info-description"><?php echo $product->description; ?></p>
        </div>
    </div>
    <div class="shipping">
        <form method="POST">
            <div class="shipping__address">
                <p>Ship to</p>
                <i class='bx bx-map'></i>
                <p>Los Angeles</p>
            </div>
            <div class="shipping__details">
                <p>Delivery <i class='bx bx-right-arrow-alt' ></i></p>
                <p>+Shipping: <span>US $20.3</span></p>
                <p class="delivery">14 - day delivery on orders over US $20</p>
                <p class="date">delivery by <span>Nov 26 - Nov 28</span></p>
            </div>
            <div class="quantity">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" value="1" min="1">
            </div>
            <input type="hidden" value="<?php echo $product->id ?>" id="id" name="id">
            <input class="add" type="submit" value="Add to Cart">
        </form>
    </div>
</div>