<?
//http://192.168.7.203/MARZO/API/index.php/productos?Id=7
$datosProducto=get("productos/".$_SESSION['id_producto']);
$datosProducto=json_decode($datosProducto);
$producto=$datosProducto;
if($producto){
    $_SESSION['productoElegido']=$producto;
}
// echo is_array($producto) ? 'Array' : 'not an Array';
// echo "\n";
if(isset($_REQUEST["ir_carrito"])){
    //comprobar si el producto esta en el carrito del usuario
    $unidades=$_REQUEST['unidades'];
    $InCarrito=$datosCarritoUser=$datosProducto=get("carrito?IdUsuario=".$usuario->Id."&IdProducto=".$producto->Id);
    if($InCarrito){
        $nuevaCantidad = array("Cantidad" => $unidades);
        $updateCarrito=put("carrito",$producto[0]->Id,$nuevaCantidad);
    }else{
        
    }
}



if(isset($_REQUEST['producto_cambio'])){
    $producto_id = $producto[0]->Id; // Obtén el ID del producto
    $Descripcion = $_REQUEST['producto_Descripcion'];
    $Precio = $_REQUEST['producto_Precio'];
    $CantidadStock = $_REQUEST['cantidad_stock'];
    // Crear el array con los datos a actualizar
    $datos_actualizados = array(
        "Descripcion" => $Descripcion,
        "Precio" => $Precio,
        "CantidadStock" => $CantidadStock
        // Llamar a la función put() para actualizar los datos del producto
    );
    $updateStock = put("productos", $producto_id, $datos_actualizados);
    if($updateStock){
        $_SESSION['vista'] = VIEW.'home.php';
        $_SESSION['controlador'] = CON.'homeController.php';
        require $_SESSION['controlador'];
    }
}



