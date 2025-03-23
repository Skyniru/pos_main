<?= $this->include('templates/header') ?>

<div class="bg-container">
    <img src="<?=base_url('assets/images/Background.gif')?>" alt="Background">
</div>

<?= $this->include('templates/navbar') ?>

<!-- Inventory Content -->
<div class="container">
    <div class="inventory-container">
        <div class="inventory-header">
            <h1>Inventory Management</h1>
            <div class="inventory-actions">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                    <i class="fas fa-plus"></i> Add New Product
                </button>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="search-filter-section mb-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search products...">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-6">
                    <select class="form-select" aria-label="Filter by category">
                        <option selected>All Categories</option>
                        <option value="1">Category 1</option>
                        <option value="2">Category 2</option>
                        <option value="3">Category 3</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="products-grid">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                <?php if(isset($products) && !empty($products)): ?>
                    <?php foreach($products as $product): ?>
                        <div class="col">
                            <div class="card h-100">
                                <img src="<?= $product['image_url'] ?? base_url('assets/images/logo.jpg') ?>" 
                                     class="card-img-top product-image" 
                                     alt="<?= esc($product['name'] ?? 'Product Image') ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?= esc($product['name'] ?? 'Product Name') ?></h5>
                                    <p class="card-text price">₱<?= number_format($product['price'] ?? 0, 2) ?></p>
                                    <div class="product-details">
                                        <p class="mb-1"><small>Stock: <?= esc($product['stock'] ?? 0) ?></small></p>
                                        <p class="mb-1"><small>Category: <?= esc($product['category'] ?? 'Uncategorized') ?></small></p>
                                    </div>
                                    <div class="product-actions mt-3">
                                        <button class="btn btn-sm btn-primary" onclick="editProduct(<?= $product['id'] ?? 0 ?>)">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="btn btn-sm btn-danger" onclick="deleteProduct(<?= $product['id'] ?? 0 ?>)">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center">
                        <p>No products found. Add some products to get started!</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('inventory/add') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="productName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Price</label>
                        <div class="input-group">
                            <span class="input-group-text">₱</span>
                            <input type="number" class="form-control" id="productPrice" name="price" step="0.01" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="productStock" class="form-label">Initial Stock</label>
                        <input type="number" class="form-control" id="productStock" name="stock" required>
                    </div>
                    <div class="mb-3">
                        <label for="productCategory" class="form-label">Category</label>
                        <select class="form-select" id="productCategory" name="category" required>
                            <option value="">Select a category</option>
                            <option value="1">Category 1</option>
                            <option value="2">Category 2</option>
                            <option value="3">Category 3</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="productImage" name="image" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->include('templates/footer') ?>

<script>
function editProduct(productId) {
    // Add your edit product logic here
    console.log('Editing product:', productId);
}

function deleteProduct(productId) {
    if (confirm('Are you sure you want to delete this product?')) {
        // Add your delete product logic here
        console.log('Deleting product:', productId);
    }
}
</script>
