<section>
    <h2>Featured Categories</h2>
    <ul class="category-list">
        <?php foreach($categories as $category){ ?>
            <li class="category"><a href="/products"><?php echo $category->productTypeName ?></a></li>
        <?php } ?>
    </ul>
</section>

<section class="info-section">
    <h2 class="info-title">Discover the essentials for your laboratory at LabProSource</p>
    <p>Have questions or need guidance? Fill out the contact form, and our advisors will be in touch shortly</p>
    <a class="contact-button" href="/contact">Contact Us</a>
</section>

<section class="products-home">
    <h2>Featured Products</h2>
    <p class="section-description">Explore our wide range of high-quality laboratory products.</p>
    
    <ul class="products-list">
        <?php foreach($products as $product) { ?>
            <li class="product-info">
                <a class="product-home" href="/product?id=<?php echo $product->id; ?>">
                    <img class="image-small" loading="lazy" src="/images/<?php echo $product->image; ?>" alt="product">
                    <p class="product-name"><?php echo $product->productName; ?></p>
                    <p class="product-price">$ <?php echo $product->price; ?></p>
                </a>
            </li>
        <?php } ?>
    </ul>

    <a class="all-button" href="/products">See all products</a>
</section>

<section>
    <h2>More About Us</h2>
    <div class="choose">
        <div class="choose__icons">
            <div class="choose__info">
                <i class='bx bx-dollar-circle' ></i>
                <p>Competitive Prices</p>
            </div>
            <div class="choose__info">
                <i class='bx bx-lock-alt' ></i>
                <p>Buyer Protection</p>
            </div>
            <div class="choose__info">
                <i class='bx bx-credit-card' ></i>
                <p>Safe Payments</p>
            </div>
            <div class="choose__info">
                <i class='bx bx-timer' ></i>
                <p>Fast Delivery</p>
            </div>
            <div class="choose__info">
                <i class='bx bx-world' ></i>
                <p>Worldwide Shipping</p>
            </div>
        </div>
    </div>
</section>