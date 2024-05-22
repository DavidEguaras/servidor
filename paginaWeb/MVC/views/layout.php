<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mercadillo David Eguaras - Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
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

        .card {
            height: auto; /* Ajustar la altura según sea necesario */
        }
    </style>
</head>
<body class="bg-dark text-white">
    <div class="container">

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
                            <li class="nav-item">
                                <i>01.<a href="#">Style Man</a></i>
                                <i>02.<a href="#">Style Women</a></i>
                            </li>
                        </ul>
                    </nav>
                    <form class="d-flex ms-3" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                    <?php if (validado()) { ?>
                        <form action="" method="post" class="ms-3">
                            <input type="submit" value="Log Out" name="Login_CerrarSesion" class="btn btn-primary w-50">
                            <input type="submit" value="Home" name="ir_home" class="btn btn-primary">
                        </form>
                    <?php } else { ?>
                        <form action="" method="post" class="ms-3">
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
        <footer class="footer fixed-bottom d-flex flex-column bg-black text-white">
            <div class="footerHeader">
                <h1>ABOUT US</h1>
            </div>
            <div class="footerBot justify-content-evenly d-flex flex-row">
                <div class="footerLeft">
                    <h2>Social Media</h2>
                    <ul>
                        <li>Instagram</li>
                        <li>TikTok</li>
                        <li>Twitter</li>
                    </ul>
                </div>
                <div class="footerMid">
                    <h2>Help & Info</h2>
                    <ul>
                        <li>About Mercadillo</li>
                        <li>Work in Mercadillo</li>
                        <li>Corporate Responsibilities</li>
                        <li>Investors Relationship</li>
                    </ul>
                </div>
                <div class="footerRight">  
                    <h2>Contact Us</h2>
                    <ul>
                        <li>Email</li>
                        <li>SMS</li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
