<?php
    $errores = array();
    if(validarFormulario($errores)){
        

        $datosTiposProducto = get("productType");
        $datosTiposProducto = json_decode($datosTiposProducto, true);
        $tiposProductos = $datosTiposProducto;


        // if($_SESSION['usuario']['rol'] == 'admin')
        //seria mas cuestion de hacer otra vista, y se cargasen tanto los productos con un boton de eliminar como un formulario al principio
        //de la pagina para agregar uno
        if(isset($_REQUEST['postProductType'])){
            // $errores = array();
            // if(validarProducto($errores)){}
            $category = $_REQUEST['$category'];
            $name = $_REQUEST['$name'];
            $price = $_REQUEST['$price'];
            $brand = $_REQUEST['$brand'];
            $description = $_REQUEST['$description'];

            // Construir los datos en formato JSON
            $productTypeData = array(
                'category' => $category,
                'name' => $name,
                'price' => $price,
                'brand' => $brand,
                'description' => $description
            );

            $response = post("productType", $productTypeData);
            
        }
        
    }
