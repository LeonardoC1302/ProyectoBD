<h1>Update Product</h1>

<form method="POST" class="form" enctype="multipart/form-data">
    <a href="/admin" class="action-btn">Return back</a>
    <div class="form__field">
        <label for="name" class="form__label">Product Name:</label>
        <input class="form__input" type="text" placeholder="Product Name" id="name" name="name">
    </div> <!-- /form__field -->
    <div class="form__field">
        <label for="price" class="form__label">Price:</label>
        <input class="form__input" type="number" placeholder="Price" id="price" name="price">
    </div> <!-- /form__field -->
    <div class="form__field">
        <label for="cantidad" class="form__label">Quantity:</label>
        <input class="form__input" type="number" placeholder="Quantity" id="cantidad" name="cantidad">
    </div> <!-- /form__field -->
    <div class="form__field">
        <label for="image" class="form__label">Image:</label>
        <input class="form__input" type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">
        <label class="form__label">Current Image:</label>
    </div> <!-- /form__field -->
    <div class="form__field">
        <legend class="form__legend">Category</legend>
        <!-- Add your category input/select here -->
    </div> <!-- /form__field -->
    <div class="form__field">
        <label for="description" class="form__label">Description</label>
        <textarea class="form__textarea" name="description" id="description" placeholder="Product Description"></textarea>
    </div> <!-- /form__field -->
    <input class="action-btn" type="submit" value="Update" onclick="return confirm('Are you sure you want to create the product')">
</form>

</div>