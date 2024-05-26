<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mercadillo David Eguaras - Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo CSS ?>stylesLayout.css">
    <link rel="stylesheet" href="<?php echo CSS ?>stylesLogin.css">
    <link rel="stylesheet" href="<?php echo CSS ?>stylesCart.css">
    <link rel="stylesheet" href="<?php echo CSS ?>stylesHome.css">
</head>
<body class="bg-dark text-white">

        <header class="header mb-5">
            <div class="headerTop bg-black container-fluid d-flex flex-row text-white">
                <div class="topLeft container">
                    <div class="logo">
                        <h1>MERCADILLO DAVID EGUARAS</h1>
                    </div>
                    <div class="phrase">
                        <span><p>//Never Stop Exploring</p></span>
                    </div>
                </div>
                <div class="topRight d-flex align-items-center justify-content-evenly">
                    <nav class="d-flex">
                        <ul class="navbar-nav d-flex flex-row">
                            <li class="nav-item d-flex">
                                <?php if (validated()) { ?>
                                    <form action="" method="post" class="d-flex">
                                        <input type="submit" value="Log Out;" name="logOut" class="btn-custom">
                                    </form>
                                    <form action="" method="post" class="d-flex">
                                        <input type="submit" value="<Cart>" name="viewCart" class="btn-custom">
                                    </form>
                                <?php } ?>
                            </li>
                        </ul>
                    </nav>
                </div>

            </div>
        </header>
        <main>
            <?php
                /*
                if(isset($_SESSION['controller'])) {
                    print_r($_SESSION['controller']);
                }
                if(isset($_SESSION['view'])) {
                    print_r($_SESSION['view']);
                }
                */
                if(!isset($_SESSION['view'])){
                    require VIEW.'login.php';
                } else {
                    require $_SESSION['view'];
                }
               
            ?>
        </main>

</body>
</html>
