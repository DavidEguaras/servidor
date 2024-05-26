<?php 

$esAdmin = $_SESSION['user']['rol'] == 'admin';

?>
<div class="container">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        <?php foreach ($productTypeData as $product): ?>
        <div class="col">
            <div class="card h-100 card-custom mt-5 mb-5">
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
                            <button type="submit" class="btn btn-primary mt-5" name='addProductToCart'>Add to cart</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php if ($esAdmin): ?>
    
<div id="productos" class="container mt-5">
    <h2>Registrar una marca (POST)</h2>
    <form id="marcaForm" style="margin-bottom: 10px;">
        <label for="category" style="margin-bottom: 5px;">PRODUCT Category:</label>
        <input type="text" id="category" name="category" class="form-control" required style="margin-bottom: 10px;">
        
        <label for="name" style="margin-bottom: 5px;">Name:</label>
        <input type="text" id="name" name="name" class="form-control" required style="margin-bottom: 10px;">

        <label for="price" style="margin-bottom: 5px;">Price:</label>
        <input type="number" id="price" name="price" class="form-control" required style="margin-bottom: 10px;">

        <label for="brand" style="margin-bottom: 5px;">Brand:</label>
        <input type="text" id="brand" name="brand" class="form-control" required style="margin-bottom: 10px;">

        <label for="description" style="margin-bottom: 5px;">description:</label>
        <input type="text" id="description" name="description" class="form-control" required style="margin-bottom: 10px;">
        
        <button type="submit" class="btn btn-primary" name='postPRODUCTType'>Register PRODUCT Type</button>
    </form>
</div>

<?php endif; ?>

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
