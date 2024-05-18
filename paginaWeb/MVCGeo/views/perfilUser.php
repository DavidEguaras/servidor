


<div class="row">
<div class="col-lg-4">
        <div class="card mb-4 mt-4 d-flex justify-content-center">
            <div class="d-flex justify-content-center">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                  class="rounded-circle img-fluid ms-auto mx-auto mt-1" style="width: 150px;">
            </div>
          <div class="card-body text-center ">
            <h5 class="my-3"><?echo $_SESSION['usuario']['Nombre']?></h5>
            <p class="text-muted mb-1"><?echo $_SESSION['usuario']['Email']?></p>
            <div class="d-flex justify-content-center mb-2">
            </div>
          </div>
        </div>
</div>
<div class="col-lg-8">
    <div class="card mb-4 mt-4 d-flex justify-content-center border">
        <h3 class="cambiarDatos text text-center fw-bold mt-2">Cambiar datos</h3>
        <form action="">
            <div class="row d-flex justify-content-around text-center mb-3 ">
                <div class="col-5 mx-1 ">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nombre :</label>
                        <input type="text" class="form-control text-center" id="nuevoNombre" aria-describedby="newName" value="<?echo $_SESSION['usuario']['Nombre']?>" name="nuevo_nombre">
                    </div>    
                </div>

                <div class="col-5 ">
                <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email :</label>
                        <input type="email" class="form-control text-center" id="nuevoNombre" aria-describedby="newName" value="<?echo $_SESSION['usuario']['Email']?>" name="nuevo_nombre">
                    </div>   
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-5">
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </div>
                    <div class="col-5">
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?
    echo "<pre>";
    print_r($_SESSION['usuario']);
?>
