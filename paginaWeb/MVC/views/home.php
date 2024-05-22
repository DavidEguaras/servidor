
<?php 
print_r("Hola");


print_r($datosTiposProducto);


?>

    
<div id="Marcas" class="container mt-5">
        <h2> Registrar una marca (POST)</h2>
        <form id="marcaForm" style="margin-bottom: 10px;">
            <label for="category" style="margin-bottom: 5px;">Product Category:</label>
            <input type="text" id="category" name="category" class="form-control" required style="margin-bottom: 10px;">
            
            <label for="name" style="margin-bottom: 5px;">Name:</label>
            <input type="text" id="name" name="name" class="form-control" required style="margin-bottom: 10px;">

            <label for="price" style="margin-bottom: 5px;">Price:</label>
            <input type="number" id="price" name="price" class="form-control" required style="margin-bottom: 10px;">

            <label for="brand" style="margin-bottom: 5px;">Brand:</label>
            <input type="text" id="brand" name="brand" class="form-control" required style="margin-bottom: 10px;">

            <label for="description" style="margin-bottom: 5px;">description:</label>
            <input type="text" id="description" name="description" class="form-control" required style="margin-bottom: 10px;">
            
            <button type="submit" class="btn btn-primary" name='postProductType'>Register Product Type</button>
        </form>
    </div>
