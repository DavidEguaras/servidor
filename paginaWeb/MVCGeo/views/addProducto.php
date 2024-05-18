<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4 text text-center">Agregar Nuevo Producto</h2>
    <div class="row">
    <form method="POST" action="" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción:</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio:</label>
            <input type="number" step="0.01" min="0" class="form-control" id="precio" name="precio" required>
        </div>
        <div class="mb-3">
            <select class="form-select" aria-label="Default select example" name="categoria">
                <option selected>Selecciona la categoria</option>
                    <?
                        foreach ($_SESSION['categorias'] as $categoria => $value) {
                            //echo $_SESSION['categorias'][$categoria]->Nombre;
                            echo "<option value =".$_SESSION['categorias'][$categoria]->Id.">".$_SESSION['categorias'][$categoria]->Nombre."</option>";
                        }
                    ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Imagen del producto:</label>
            <input class="form-control" type="file" id="formFile" name="ruta_img" >
        </div>
        <div class="mb-3">
            <label for="cantidad_stock" class="form-label">Cantidad en Stock:</label>
            <input type="number" class="form-control" id="cantidad_stock" name="cantidad_stock" min="0">
        </div>
        <button type="submit" name="guardar_producto" class="btn btn-primary">Guardar Producto</button>
    </form>
    </div>

</div>
</body>
</html>

