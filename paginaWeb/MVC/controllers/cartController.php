<?php
$_SESSION['view'] = VIEW . 'cart.php';

$userCartsJson = get("cart?USER_ID=" . $_SESSION['user']['USER_ID']);
$userCarts = json_decode($userCartsJson, true);
//se imprimen los carritos del user
foreach ($userCarts as &$cart) {
    $productDetailsJson = get("product/" . $cart['PRODUCT_ID']);
    $productDetails = json_decode($productDetailsJson, true);
    if ($productDetails) {
        $cart = array_merge($cart, $productDetails);
    }
}
unset($cart);

$_SESSION['userCarts'] = $userCarts;

if (isset($_REQUEST['updateQuantity'])) {
    $cartId = $_REQUEST['CART_ID'];
    $newQuantity = $_REQUEST['quantity'];

    foreach ($_SESSION['userCarts'] as &$cart) {
        if ($cart['CART_ID'] == $cartId) {
            $cart['quantity'] = $newQuantity;
            put("cart", $cartId, $cart);
            break;
        }
    }
}


//Si el usuario realiza la compra de los productos del carrito, se resta la cantidad del pedido del stock de los productos, y se reinicia(borra) las instancia del carrito con ese id de usuario
if (isset($_REQUEST['buyCartProducts'])) {
    foreach ($_SESSION['userCarts'] as $cart) {
        $newData = array(
            "PRODUCT_ID" => $cart['PRODUCT_ID'],
            "quantity" => $cart['quantity']
        );
        put("product", null, $newData); 
    }

    $USER_ID = $_SESSION['user']['USER_ID'];
    $data = array("USER_ID" => $USER_ID);
    deleteFromAPI("cart", $data);
    header("Location: " . $_SERVER['PHP_SELF']);

}

if (isset($_REQUEST['deleteSingleCartProduct'])) {
    $CART_ID = $_REQUEST['CART_ID'];
    $data = array("CART_ID" => $CART_ID);
    deleteFromAPI("cart", $data);

    $_SESSION['VIEW'] = VIEW . 'cart.php';
    header("Location: " . $_SERVER['PHP_SELF']);
}

