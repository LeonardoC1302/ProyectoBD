<h1>Create Product</h1>

<form class="form" method="POST" enctype="multipart/form-data">
    <a class="action-btn" href="/admin/products">Return back</a>
    <div class="form__field">
        <label for="name" class="form__label">Product Name</label>
        <input class="form__input" type="text" placeholder="Product Name" id="name" name="name">
    </div> <!-- /form__field -->
    <div class="form__field">
        <label for="price" class="form__label">Price</label>
        <input class="form__input" type="number" placeholder="Price" id="price" name="price">
    </div> <!-- /form__field -->
    <div class="form__field">
        <label for="imagen" class="form__label">Image</label>
        <input class="form__input" type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">
    </div> <!-- /form__field -->
    <div class="form__field">
        <label class="form__legend">Category</label>
        <!-- Add your category input/select here -->
    </div> <!-- /form__field -->
    <div class="form__field">
        <label for="description" class="form__label">Description</label>
        <textarea class="form__textarea" name="description" id="description" placeholder="Product Description"></textarea>
    </div> <!-- /form__field -->


    <input class="action-btn" type="submit" value="Create" onclick="return confirm('Are you sure you want to create the product')">
</form>

</div>