<div class="actions">
    <a href="/admin" class="link-btn">Return to Panel</a>
</div>

<div class = 'center'>
    <form class="form" method = 'POST'>
        <div class="form__field">
            <label class='form__label' for="date">Select a Date to Filter: </label>
            <input class="form__input" type="date" id="date" name="date" placeholder="YYYY-MM-DD">
        </div>

        <div class="form__field">
            <label class="form__legend">Select a Category to Filter:</label>
            <select class="form__select" name="productTypeId" id="productTypeId">
                    <option value="" disabled selected>-- Select a product category --</option>
                    <?php foreach($productTypes as $ptype){ ?>
                        <option value="<?php echo $ptype->id ?>" 
                            <?php echo $ptype->id === $product->productTypeId ? 'selected' : '' ?>
                        >
                            <?php echo $ptype->productTypeName?> 
                        </option>
                    <?php } ?>
    
                </select>
        </div> <!-- /form__field -->

        <div class="form__field">
            <label class="form__legend">Select a Warehouse to Filter</label>
            <select class="form__select" name="warehouseId" id="warehouseId">
                    <option value="" disabled selected>-- Select a warehouse --</option>
                    <?php foreach($warehouses as $warehouse){ ?>
                        <option value="<?php echo $warehouse->id ?>" 
                            <?php echo $warehouse->id === $product->warehouseId ? 'selected' : '' ?>
                        >
                            <?php echo $warehouse->warehouseName  ?> 
                        </option>
                    <?php } ?>
                </select>
        </div> <!-- /form__field -->

        <div class="form__field">
            <label class="form__legend">Select a Product to Filter</label>
            <select class="form__select" name="productId" id="productId">
                    <option value="" disabled selected>-- Select a product --</option>
                    <?php foreach($products as $product){ ?>
                        <option value="<?php echo $product->id ?>" 
                            <?php echo $product->id === $product->productId ? 'selected' : '' ?>
                        >
                            <?php echo $product->productName  ?> 
                        </option>
                    <?php } ?>
                </select>
        </div> <!-- /form__field -->

        
        <input class="link-btn" type="submit" value="Search">
    </form>
</div>

<?php if(empty($sales)){ ?>
    <h1>No sales found</h1>
<?php } ?>

<div class="sales-container">
    <?php foreach($sales as $sale) {?>
        <div class="sale-container">
            <p>Sale Id: <span><?php echo $sale->id ;?></span></p>
            <p>User Name: <span>
                <?php
                    foreach($users as $user){
                        if($user->id == $sale->userId){
                            echo $user->name . ' ' . $user->surname;
                        }
                    }
                ?>
            </span></p>
            <p>Sale Date: <span><?php echo $sale->saleDate ;?></span></p>
            <p>Sale Total: <span>$<?php echo $sale->total ;?></span></p>
            <ul class="sale-products">
                <?php foreach($sale->products as $product){ ?>
                    <li class="sale-product">
                        <p>Product <span><?php echo $product->productName ;?></span></p>
                        <p>Price: <span><?php echo $product->price ;?></span></p>
                        <p>Quantity: <span><?php echo $product->quantity ;?></span></p>
                        <p>Total Price: <span><?php echo $product->total ;?></span></p>
                </li>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>
</div>