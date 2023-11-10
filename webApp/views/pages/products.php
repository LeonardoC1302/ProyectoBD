<div class="products">
    <h1>Our Products</h1>
    <div class="products__list">
        <?php foreach($products as $product){ ?>
            <a class="product" href="/product?id=<?php echo $product->id; ?>">
                <div class="product__image">
                    <img loading="lazy" src="/images/<?php echo $product->image; ?>" alt="product">
                </div>
                <p class="product__name"><?php echo $product->productName; ?></p>
                <p class="product__price">$<?php echo $product->price; ?></p>
            </a> <!-- product -->
        <?php } ?>
        
    </div> <!-- products__list -->
</div>