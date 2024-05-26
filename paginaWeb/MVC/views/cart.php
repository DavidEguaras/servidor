<div class="container">
    <div class="header">
        <a href="#">Home</a> > <a href="#">Cart</a>
    </div>
    <form action="" method="post">
        <button type="submit" class="btn btn-primary mb-5 mt-5" name="goHome">Back to Home</button>
    </form>
    <?php 
    $totalItems = 0;
    $totalPrice = 0;
    foreach ($_SESSION['userCarts'] as $cartItem): 
        $name = $cartItem['name'];
        $variant = $cartItem['color']; // Assuming color is used as variant
        $size = $cartItem['size'];
        $quantity = $cartItem['quantity'];
        $price = $cartItem['price'];
        $image_route = $cartItem['image_route'];

        $totalItems += $quantity;
        $totalPrice += $quantity * $price;
    ?>

    <div class="cart-item mb-4"> 
        <img src="<?php echo IMG . $image_route; ?>" alt="<?php echo htmlspecialchars($name); ?>" style="width: 100px; height: 100px;">
        <div >
            <p><?php echo htmlspecialchars($name); ?></p>
            <table class="mx-5">
                <tr>
                    <td>VARIANT</td>
                    <td>SIZE</td>
                    <td>QUANT.</td>
                    <td>PRICE</td>
                </tr>
                <tr>
                    <td><?php echo htmlspecialchars($variant); ?></td>
                    <td><?php echo htmlspecialchars($size); ?></td>
                    <td>
                        <form action="" method="post" style="display: inline;">
                            <input type="hidden" name="CART_ID" value="<?php echo $cartItem['CART_ID']; ?>">
                            <input type="number" name="quantity" value="<?php echo $quantity; ?>" min="1">
                            <button type="submit" name="updateQuantity">Update</button>
                        </form>
                    </td>
                    <td>$<?php echo htmlspecialchars($price); ?></td>
                </tr>
            </table>
        </div>
        <form action="" method="post" style="display: inline;">
                <input type="hidden" name="CART_ID"  value="<?php echo $cartItem['CART_ID']; ?>">
                <button type="submit" name="deleteSingleCartProduct" class="btn btn-danger mt-5 ms-5">Delete</button>
        </form>
    </div>
    <?php endforeach; ?>
    <div class="summary">
        <p>Articles: <?php echo $totalItems; ?></p>
        <p>Total: $<?php echo $totalPrice; ?></p>
    </div>
    <form action="" method="post">
        <button type="submit" class="buy-button mb-5 mt-5" name="buyCartProducts">BUY HERE</button>
    </form>
    
</div>
