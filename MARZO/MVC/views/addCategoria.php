<?php
    $categorias = $_SESSION['categorias'];
    $_SESSION['cambios']=" ";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Categorías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Gestión de Categorías</h1>
    <?
        echo $_SESSION['cambios'];
    ?>

    <!-- Tabla de categorías -->
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Borrar</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($categorias as $categoria) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($categoria->Id) . '</td>';
            echo '<td>' . htmlspecialchars($categoria->Nombre) . '</td>';
            echo '<td>';
            echo '<form method="POST" action="" style="display:inline-block;">';
            echo '<input type="hidden" name="categoria_id" value="' . htmlspecialchars($categoria->Id) . '">';
            echo '<button type="submit" name="borrar_categoria" class="btn btn-danger">Borrar</button>';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>

    <!-- Formulario para añadir categoría -->
    <form method="POST" action="" class="mt-4 mb-4">
    <fieldset class="border p-2">
            <legend class="w-auto">Añadir Categoría</legend>
            <div class="mb-3">
                <label for="nombreCategoria" class="form-label">Nombre de la Categoría</label>
                <input type="text" class="form-control" id="nombreCategoria" name="nombreCategoria" required>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary" name="add_categoria">Añadir</button>
            </div>
        </fieldset>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2Kpj6cQmrsg1ST+gpSTIrYrdwGTsVbmgLdEja4uH9lAA9p60RDBo+83Z4wX" crossorigin="anonymous"></script>
</body>
</html>


