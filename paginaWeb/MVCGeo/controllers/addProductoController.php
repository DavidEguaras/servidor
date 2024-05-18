
 
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
    $RutaImg=IMG.$Nombre;
    //extension fichero
    $extension = pathinfo($_FILES['ruta_img']['name'], PATHINFO_EXTENSION);
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
    $datos_producto= array(
        "Descripcion" => $Descripcion,
        "Precio" => $Precio,
        "CantidadStock" => $CantidadStock
        // Llamar a la función put() para actualizar los datos del producto
    );

}
?>
