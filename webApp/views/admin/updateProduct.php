<?php 
    include_once __DIR__ . "/../templates/alerts.php";
?>

<h1>Create Product</h1>

<form class="form" method="POST" enctype="multipart/form-data">
    <a class="action-btn" href="/admin/products">Return back</a>
    <div class="form__field">
        <label for="productName" class="form__label">Product Name</label>
        <input class="form__input" type="text" placeholder="Product Name" id="productName" name="productName" value="<?php echo $product->productName;?>">
    </div> <!-- /form__field -->
    <div class="form__field">
        <label for="price" class="form__label">Price</label>
        <input class="form__input" type="number" placeholder="Price" id="price" name="price" value="<?php echo $product->price;?>">
    </div> <!-- /form__field -->
    <div class="form__field">
        <label for="location" class="form__label">Location</label>
        <input class="form__input" type="text" placeholder="Location" id="location" name="location" value="<?php echo $product->formatLocation();?>">
    </div> <!-- /form__field -->
    <div class="form__field">
        <label for="stock" class="form__label">Stock</label>
        <input class="form__input" type="number" placeholder="Stock" id="stock" name="stock" value="<?php echo $product->stock;?>">
    </div> <!-- /form__field -->
    <div class="form__field">
        <label for="image" class="form__label">Image</label>
        <input class="form__input" type="file" id="image" name="image" accept="image/jpeg, image/png">
        <label class="form__label">Current Image:</label>
        <img src="/images/<?php echo $product->image;?>" class="image-small">
    </div> <!-- /form__field -->
    <div class="form__field">
        <label class="form__legend">Category</label>
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
        <label class="form__legend">Warehouse</label>
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
        <label for="description" class="form__label">Description</label>
        <textarea class="form__textarea" name="description" id="description" placeholder="Product Description"><?php echo $product->description; ?></textarea>
    </div> <!-- /form__field -->


    <input class="action-btn" type="submit" value="Update">
</form>

</div>