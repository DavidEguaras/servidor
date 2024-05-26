<?php
$_SESSION['view'] = VIEW . 'home.php';
$errors = array();

// Obtener y decodificar carritos del usuario
$userCartsJson = get("cart?USER_ID=" . $_SESSION['user']['USER_ID']);
$_SESSION['userCarts'] = json_decode($userCartsJson, true);

// Obtener y decodificar datos de tipos de producto
$productTypeData = get("productType");
$productTypeData = json_decode($productTypeData, true);
$_SESSION['allProducts'] = $productTypeData;


if (isset($_REQUEST['viewCart'])) {
    $_SESSION['VIEW'] = VIEW . 'cart.php';
    header("Location: " . $_SERVER['PHP_SELF']);
    $_SESSION['controller'] = CON . 'cartController.php';
}

// Agregar producto al carrito
if (isset($_REQUEST['addProductToCart'])) {
    $PRODUCT_ID = $_REQUEST['PRODUCT_ID'];
    $USER_ID = $_SESSION['user']['USER_ID'];

    $existingCart = null;

    // Verificar si existe ya ese producto en el carrito y aumentar cantidad si es asi
    if (is_array($_SESSION['userCarts'])) {
        foreach ($_SESSION['userCarts'] as &$cart) {
            if ($cart['PRODUCT_ID'] == $PRODUCT_ID) {
                $cart['quantity']++;
                $existingCart = $cart;
                break;
            }
        }
    } else {
        $_SESSION['userCarts'] = array();
    }

    // crear nuevo carrito de ese producto si no existe
    if (!$existingCart) {
        $newCartData = array(
            "quantity" => 1,
            "USER_ID" => $USER_ID,
            "PRODUCT_ID" => $PRODUCT_ID
        );
        $newCart = post("cart", $newCartData);
        $_SESSION['userCarts'][] = $newCart;
    } else {
        // actualizar carrito existente
        put("cart", $existingCart['CART_ID'], $existingCart);
    }
}

//configurar vista de carrito
if (isset($_REQUEST['viewCart'])) {
    $_SESSION['VIEW'] = VIEW . 'cart.php';
    header("Location: " . $_SERVER['PHP_SELF']);
    $_SESSION['controller'] = CON . 'cartController.php';
}
