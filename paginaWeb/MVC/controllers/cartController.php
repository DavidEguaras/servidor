<?php

// Incluir la vista del carrito después de configurar los datos
$_SESSION['view'] = VIEW . 'cart.php';
// Obtener los carritos del usuario
$userCartsJson = get("cart?USER_ID=" . $_SESSION['user']['USER_ID']);
$userCarts = json_decode($userCartsJson, true);

// Obtener detalles completos de cada producto y combinarlos con los datos del carrito
foreach ($userCarts as &$cart) {
    $productDetailsJson = get("product/" . $cart['PRODUCT_ID']);
    $productDetails = json_decode($productDetailsJson, true);
    if ($productDetails) {
        $cart = array_merge($cart, $productDetails);
    }
}
unset($cart); // Deshacer la referencia

$_SESSION['userCarts'] = $userCarts;

// Manejar la actualización de cantidades
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


// Manejar la compra de todos los productos en el carrito

if (isset($_REQUEST['buyCartProducts'])) {
    foreach ($_SESSION['userCarts'] as $cart) {
        $newData = array(
            "PRODUCT_ID" => $cart['PRODUCT_ID'],
            "quantity" => $cart['quantity']
        );
        put("product", null, $newData); // Aquí no se proporciona el ID
    }

    // Limpiar el carrito del usuario después de la compra
    $USER_ID = $_SESSION['user']['USER_ID'];
    $data = array("USER_ID" => $USER_ID);
    deleteFromAPI("cart", $data); // Realizar la solicitud DELETE para limpiar el carrito

    // Redirigir a la página de inicio
    $_SESSION['controller'] = CON . 'homeController.php';

}



?>
