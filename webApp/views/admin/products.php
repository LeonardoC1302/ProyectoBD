<div class="admin-actions">
    <a class="action-btn" href="/admin">Return to Panel</a>
    <a class="action-btn" href="/admin/products/create">Create Product</a>
</div>
<h1>Products</h1>

<table class="products-table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Image</th>
            <th>Type</th>
            <th>Warehouse</th>
            <th>Location</th>
            <th>Stock</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        <tr>
        <?php foreach( $products as $product): ?>
                <tr>
                    <td> <?php echo $product->id; ?> </td>
                    <td> <?php echo $product->productName; ?> </td>
                    <td><img src="/images/<?php echo $product->image; ?> " alt="Table Image" class="table-image"></td>
                    <td>
                        <?php
                        foreach($productTypes as $productType){
                            if($product->productTypeId == $productType->id){
                                echo $productType->productTypeName;
                            }
                        }
                        ?> 
                    </td>
                    <td>
                        <?php
                        foreach($warehouses as $warehouse){
                            if($product->warehouseId == $warehouse->id){
                                echo $warehouse->warehouseName;
                            }
                        }
                        ?> 
                    </td>
                    <td><?php echo $product->location ?? 'No location'; ?> </td>
                    <td><?php echo $product->stock; ?> </td>
                    <td>$ <?php echo $product->price; ?> </td>
                    <td>
                        <form method="POST" class="w-100" action="/admin/products/delete">
                            <input type="hidden" name="id" value="<?php echo $product->id ?>">
                            <input type="hidden" name="type" value="product">
                            <input type="submit" class="icon-delete" value="&#128465;">
                        </form>
                        <a href=/admin/products/update?id=<?php echo $product->id; ?> class="icon-update">&#9998;</a>
                    </td>
                </tr>
                <?php endforeach; ?>
        </tr>
    </tbody>
</table>