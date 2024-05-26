<div class="container">
    <div class="header">
        <a href="#">Home</a> > <a href="#">Cart</a>
    </div>
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
    <div class="cart-item">
        <img src="<?php echo IMG . $image_route; ?>" alt="<?php echo htmlspecialchars($name); ?>">
        <div>
            <p><?php echo htmlspecialchars($name); ?></p>
            <table>
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
                        <form action="" method="post">
                            <input type="hidden" name="CART_ID" value="<?php echo $cartItem['CART_ID']; ?>">
                            <input type="number" name="quantity" value="<?php echo $quantity; ?>" min="1">
                            <button type="submit" name="updateQuantity">Update</button>
                        </form>
                    </td>
                    <td>$<?php echo htmlspecialchars($price); ?></td>
                </tr>
            </table>
        </div>
    </div>
    <?php endforeach; ?>
    <div class="summary">
        <p>Articles: <?php echo $totalItems; ?></p>
        <p>Total: $<?php echo $totalPrice; ?></p>
    </div>
    <form action="" method="post">
        <button type="submit" class="buy-button" name="buyCartProducts">BUY HERE</button>
    </form>
</div>
