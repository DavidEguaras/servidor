<?php 

$esAdmin = $_SESSION['user']['rol'] == 'admin';

?>

<!-- NO ME HA DADO TIEMPO A IMPLEMENTARLO -->
<?php if ($esAdmin): ?>

<div id="productos" class="container mt-5">
    <h2>Registrar un producto (POST)</h2>
    <form id="productForm" method="POST" enctype="multipart/form-data" style="margin-bottom: 10px;">

        <label for="PT_ID" style="margin-bottom: 5px;">Product Type ID:</label>
        <input type="text" id="PT_ID" name="PT_ID" class="form-control" required style="margin-bottom: 10px;">

        
        <label for="color" style="margin-bottom: 5px;">Color:</label>
        <input type="text" id="color" name="color" class="form-control" required style="margin-bottom: 10px;">

        <label for="size" style="margin-bottom: 5px;">Size:</label>
        <input type="text" id="size" name="size" class="form-control" required style="margin-bottom: 10px;">

        <label for="stock" style="margin-bottom: 5px;">Stock:</code></label>
        <input type="number" id="stock" name="stock" class="form-control" required style="margin-bottom: 10px;">

        <label for="formFile" class="form-label">Product Image:</label>
        <input class="form-control" type="file" id="formFile" name="image_route" required style="margin-bottom: 10px;">

        <button type="submit" class="btn btn-primary" name='postProduct'>Register Product</button>
    </form>
</div>

<?php endif; ?>


<div class="container">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        <?php foreach ($_SESSION['allProducts'] as $product): ?>
        <div class="col">
            <div class="card h-80 card-custom">
                <img src="<?php echo IMG . $product['image_route']; ?>" class="card-img-top" alt="Product Image">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-white"><?php echo $product['name']; ?></h5>
                    <p class="card-text"><?php echo $product['description']; ?></p>
                    <div class="mt-auto">
                        <div class="list-group-item price-right">
                            Price: $<?php echo $product['price']; ?>
                        </div>
                        <form action="" method="post">
                            <input type="hidden" name="PRODUCT_ID" value="<?php echo $product['PRODUCT_ID']; ?>">
                            <button type="submit" class="btn btn-primary" name='addProductToCart'>Add to cart</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>



<footer class="footer fixed-bottom bg-black text-white mt-5">
    <div class="container py-3">
        <div class="row">
            <div class="col-md-4">
                <h2>Social Media</h2>
                <ul class="list-unstyled">
                    <li>Instagram</li>
                    <li>TikTok</li>
                </ul>
            </div>
            <div class="col-md-4">
                <h2>Help & Info</h2>
                <ul class="list-unstyled">
                    <li>About Mercadillo</li>
                    <li>Work in Mercadillo</li>
                </ul>
            </div>
            <div class="col-md-4">
                <h2>Contact Us</h2>
                <ul class="list-unstyled">
                    <li>Email</li>
                    <li>SMS</li>
                </ul>
            </div>
        </div>
    </div>
</footer>
