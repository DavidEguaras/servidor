<?

// http://192.168.7.203/MARZO/API/index.php/productos
$datosProductos=get("productos");
$datosProductos=json_decode($datosProductos);
$productos=$datosProductos;
if($productos){
  $_SESSION['productos']=$productos;
}

if(isset($_REQUEST['ir_producto'])){
  $_SESSION['id_producto'] = $_REQUEST['producto_id'];
  $_SESSION['vista'] = VIEW.'producto.php';
  $_SESSION['controlador'] = CON.'productoController.php';
  require $_SESSION['controlador'];
}

if(isset($_REQUEST['agregar_producto'])){
  $_SESSION['vista'] = VIEW.'addProducto.php';
  $_SESSION['controlador'] = CON.'addProductoController.php';
  require $_SESSION['controlador'];
}

if(isset($_REQUEST['gestion_categoria'])){
  $_SESSION['vista'] = VIEW.'addCategoria.php';
  $_SESSION['controlador'] = CON.'gestionCategoriaController.php';
  require $_SESSION['controlador'];
}


