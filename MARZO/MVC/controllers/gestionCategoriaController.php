<?
    $datosCategorias=get("categorias");
    $datosCategorias=json_decode($datosCategorias);
    $_SESSION['categorias']=$datosCategorias;


    if(isset($_REQUEST['add_categoria'])){
        $Nombre=$_REQUEST['nombreCategoria'];
        $datos_categoria= array(
            "Nombre" => $Nombre,
            "Borrado" => 0
        );
        if($response = post("categorias", $datos_categoria)){
            $_SESSION['cambios']="<h2 class='text-success text text-center>se ha añadido la categoria".$Nombre."</h2>";
            $_SESSION['vista'] = VIEW.'home.php';
            $_SESSION['controlador'] = CON.'homeController.php';
            require $_SESSION['controlador'];
        }
    }

    if(isset($_REQUEST['borrar_categoria'])){
        $categoria_id = $_REQUEST['categoria_id'];
        if($delete = deleteFromAPI("categorias", $categoria_id)){
            $_SESSION['cambios']="<h2 class='text-success text text-center>se ha Borrado la categoria</h2>";
            $_SESSION['vista'] = VIEW.'home.php';
            $_SESSION['controlador'] = CON.'homeController.php';
            require $_SESSION['controlador'];
        }
    }

