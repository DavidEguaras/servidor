<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/index.css">
    <style>
        tr, td, th {
            border: 1px solid black;
            text-align: center;
        }
      .card-body,
      .card-text {
          margin: 0;
          padding: 0;
      }

      /* CSS para ajustar la altura si es necesario */
      .card {
          height: auto; /* O ajusta la altura según sea necesario */
      }
    </style>
</head>
<body>

  <div class="container">
    <header class="mt-5">
      <div class="row border border-danger ">
        <div class="col-2">
            <img src="<?php echo IMG . 'LogoTienda.png'; ?>" class="card-img-top img-fluid" alt="Imagen" style="width: 150px;">
          </div>
          <div class="col-8 d-flex align-items-center justify-content-evenly">
            <form>
                <input type="submit" class="btn btn-primary rounded-pill " value="Cápsula 1">
            </form>
            <form>
                <input type="submit" class="btn btn-primary rounded-pill" value="Cápsula 2">
            </form>
            <form>
                <input type="submit" class="btn btn-primary rounded-pill" name="ver_usuario" value="Mi usuario">
            </form>

            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>

          <div class="col-2 d-flex align-items-center justify-content-evenly">
            <?php if (validado()) { ?>
              <form action="" method="post" class="ms-2">
                <input type="submit" value="Log Out" name="Login_CerrarSesion" class="btn btn-primary w-50 ">
                <input type="submit" value="Home" name="ir_home" class="btn btn-primary ">
              </form>
            <?php } else { ?>
              <form action="" method="post" class="ms-2">
                <input type="submit" value="Login" name="ir_login" class="btn btn-link">
              </form>
            <?php } ?>
          </div>
      </div>
  </header>
  <main>
      <?php
          if(!isset($_SESSION['vista'])){
              require VIEW.'login.php';
          } else {
              require $_SESSION['vista'];
          }
      ?>
  </main>
  <footer>
  
  </footer>
</div>

</body>
</html>