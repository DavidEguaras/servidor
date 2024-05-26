<?php
$_SESSION['view'] = VIEW . 'home.php';
$errors = array();
$userCartsJson = get("cart?USER_ID=" . $_SESSION['user']['USER_ID']);
$_SESSION['userCarts'] = json_decode($userCartsJson, true);  // Decodificar JSON a un arreglo asociativo

$productTypeData = get("productType");
$productTypeData = json_decode($productTypeData, true);

if (isset($_REQUEST['addProductToCart'])) {
    $PRODUCT_ID = $_REQUEST['PRODUCT_ID'];
    $USER_ID = $_SESSION['user']['USER_ID'];

    // Verificar si el usuario ya tiene un carrito con este PRODUCT_ID
    $existingCart = null;

    // Verificar si $_SESSION['userCarts'] es un arreglo antes de usar foreach
    if (is_array($_SESSION['userCarts'])) {
        foreach ($_SESSION['userCarts'] as &$cart) {
            if ($cart['PRODUCT_ID'] == $PRODUCT_ID) {
                // Si existe un carrito con este PRODUCT_ID, aumentar la cantidad en uno
                $cart['quantity']++;
                $existingCart = $cart;
                break;
            }
        }
    } else {
        $_SESSION['userCarts'] = array();  // Inicializar como arreglo si no lo es
    }

    if (!$existingCart) {
        // Si no existe un carrito con este PRODUCT_ID, agregar un nuevo carrito a la lista
        $newCartData = array(
            "quantity" => 1,
            "USER_ID" => $USER_ID,
            "PRODUCT_ID" => $PRODUCT_ID
        );
        $newCart = post("cart", $newCartData);
        // Agregar el nuevo carrito a $_SESSION['userCarts']
        $_SESSION['userCarts'][] = $newCart;
    } else {
        // Realizar un PUT del carrito existente para actualizar la cantidad
        put("cart", $existingCart['CART_ID'], $existingCart);
    }
}

if (isset($_REQUEST['viewCart'])) {
    $_SESSION['controller'] = CON . 'cartController.php';
}
?>
