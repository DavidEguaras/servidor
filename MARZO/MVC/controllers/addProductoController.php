
 
<?
$datosCategoria=get("categoria");
$datosCategoria=json_decode($datosCategoria);
$categoria=$datosCategoria;
if($categoria){
    $_SESSION['categorias']=$categoria;
  }

//print_r($_SESSION['controlador']);
if(isset($_REQUEST['guardar_producto'])){

    $Nombre=$_REQUEST['nombre'];
    $Descripcion=$_REQUEST['descripcion'];
    $Precio=$_REQUEST['precio'];
    $Categoria=$_REQUEST['categoria'];
    $extension = pathinfo($_FILES['ruta_img']['name'], PATHINFO_EXTENSION);
    $RutaImg=$Nombre.".".$extension;
    //extension fichero
    $CantidadStock=$_REQUEST['cantidad_stock'];
    
    //subir fichero al servidor
    if(isset($_FILES['ruta_img']) && $_FILES['ruta_img']['error'] === UPLOAD_ERR_OK){
        // Ruta para guardar el fichero
        $ruta = "/var/www/Servidor/MARZO/MVC/webRoot/img/";
        // Ruta + nombre 
        $ruta .= $Nombre.".".$extension;
        
        if(move_uploaded_file($_FILES['ruta_img']['tmp_name'], $ruta)){
            echo "Archivo subido";
        }else{
            echo "Ha fallado al subir el archivo";
        }
    } else {
        echo "Error al subir la imagen.";
    }

    //array con los datos del producto que se va a crear
    $datos_producto = array(
        "Nombre" => $Nombre,
        "Descripcion" => $Descripcion,
        "Precio" => $Precio,
        "Categoria" => $Categoria,
        "RutaImg" => $RutaImg,
        "CantidadStock" => $CantidadStock,
        "Borrado"=>0
    );

    // $response = post("productos", $datos_producto);
    
    if($response = post("productos", $datos_producto)){
        $_SESSION['vista'] = VIEW.'home.php';
        $_SESSION['controlador'] = CON.'homeController.php';
        require $_SESSION['controlador'];
    }
}
?>
