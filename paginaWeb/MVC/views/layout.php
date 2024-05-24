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
        footer{
            font-family: Contrail One;
            padding: 20px;
        }
        .headerTop{
            background: linear-gradient(180deg, rgba(0,0,0,1) 0%, rgba(19,21,21,1) 94%);
            padding: 20px;
        }
        .logo{
            font-family: Contrail One; 
        }
        .logo h1{
            font-size: 45px;
            letter-spacing: 5px;
        }
        .phrase{
            font-family: Cascadia Code;
            color: aquamarine;
        }
        .topRight{
            padding: 25px;
            font-size: 18px;
        }
        nav i{
            margin-right: 20px;
            color: aqua;
            font-family: Cascadia Code;
        }
        nav a{
            color: white;
            text-decoration: none;
        }
        .userIcons{
            font-size:20px;
        }
        .userIcons a{
            margin-right: 25px;
            color: black;
        }

        .headerBot{
            padding: 10px;
            background: rgb(0,255,224);
        }
        .botRight{
            margin-left: 80%;
            justify-content: space-evenly;
        }
        .searchBox input[type=text]{
            background-color: black;
            color:white;
            width: 80%;
            padding: 5px;
            border-radius: 25px;
            border: none;
            outline: none;
            font-family: Cascadia Code;
            margin-right: 15px;
        }


        .login-box {
            font-family: Cascadia Code;
            background-color: black;
            border-radius: 3px;
            padding: 40px;
            -webkit-box-shadow: 18px 18px 5px 0px rgba(0,255,255,1);
            -moz-box-shadow: 18px 18px 5px 0px rgba(0,255,255,1);
            box-shadow: 18px 18px 5px 0px rgba(0,255,255,1);
        }

        .text-info {
            color: aquamarine;
        }

        .form-control {
            background-color: #ccc;
            border: none;
        }
    </style>
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
                        <ul class="navbar-nav d-flex flex-column">
                            <li class="nav-item">
                                <i>01.<a href="#">Man</a></i>
                                <i>02.<a href="#">Women</a></i>
                            </li>
                        </ul>
                    </nav>
                    <!-- <form class="d-flex ms-3" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form> -->
                    <?php if (validado()) { ?>
                        <form action="" method="post" class="ms-3">
                            <input type="submit" value="Log Out" name="logOut" class="btn btn-primary w-50">
                            <input type="submit" value="Home" name="ir_home" class="btn btn-primary">
                        </form>
                    <?php }?>
                </div>
            </div>
        </header>
        <main>
            <?php
                
                if(isset($_SESSION['controlador'])) {
                    print_r($_SESSION['controlador']);
                }
                if(isset($_SESSION['vista'])) {
                            print_r($_SESSION['vista']);
                }

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
</body>
</html>
