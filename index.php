<?php

include "class/import.php";

error_reporting(E_ALL);
date_default_timezone_set("Europe/Budapest");
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Könyvtár</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/base.css" rel="stylesheet" />

    </head>
    <body class="d-flex flex-column min-vh-100">
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container px-5">
                <a class="navbar-brand" href="<?php echo(web::$domain); ?>">Könyvtár</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <?php
                        if (isset($_SESSION["user"]))
                        {
                            if ($_SESSION["user"]["tipus"] == "konyvtaros")
                            {
                                echo("
                                <li class='nav-item'><a class='nav-link active' aria-current='page' href='".web::$domain."'>Kezdőlap</a></li>
                                <li class='nav-item'><a class='nav-link' href='".web::$domain."?oldal=admin_konyvek'>Könyvek</a></li>
                                <li class='nav-item'><a class='nav-link' href='".web::$domain."?oldal=admin_kolcsonzesek'>Kölcsönzések</a></li>
                                <li class='nav-item'><a class='nav-link' href='".web::$domain."?oldal=admin'>Admin</a></li>
                                <li class='nav-item dropdown'>
                                    <a class='nav-link dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                        Profil
                                    </a>
                                    <ul class='dropdown-menu'>
                                        <li><a class='dropdown-item' href='".web::$domain."?oldal=profil&user_ID=".$_SESSION["user"]["ID"]."'>".$_SESSION["user"]["nev"]."</a></li>
                                        <li><hr class='dropdown-divider'></li>
                                        <li><a class='dropdown-item' href='".web::$domain."?oldal=kijelentkezes'>Kijelentkezés</a></li>
                                    </ul>
                                </li>  
                                ");
                            }
                            else
                            {
                                echo("
                                <li class='nav-item'><a class='nav-link active' aria-current='page' href='".web::$domain."'>Kezdőlap</a></li>
                                <li class='nav-item'><a class='nav-link' href='".web::$domain."?oldal=konyvek'>Könyvek</a></li>
                                <li class='nav-item'><a class='nav-link' href='".web::$domain."?oldal=kolcsonzesek'>Kölcsönzések</a></li>
                                <li class='nav-item dropdown'>
                                    <a class='nav-link dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                        Profil
                                    </a>
                                    <ul class='dropdown-menu'>
                                        <li><a class='dropdown-item' href='".web::$domain."?oldal=profil&user_ID=".$_SESSION["user"]["ID"]."'>".$_SESSION["user"]["nev"]."</a></li>
                                        <li><hr class='dropdown-divider'></li>
                                        <li><a class='dropdown-item' href='".web::$domain."?oldal=kijelentkezes'>Kijelentkezés</a></li>
                                    </ul>
                                </li>  
                                ");
                            } 
                        }
                        else
                        {
                            echo("
                                <li class='nav-item'><a class='nav-link active' aria-current='page' href='".web::$domain."'>Kezdőlap</a></li>
                                <li class='nav-item'><a class='nav-link' href='".web::$domain."?oldal=konyvek'>Könyvek</a></li>
                                <li class='nav-item'><a class='nav-link' href='".web::$domain."?oldal=kapcsolat'>Kapcsolat</a></li>
                                <li class='nav-item dropdown'>
                                    <a class='nav-link dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                        Profil
                                    </a>
                                    <ul class='dropdown-menu'>
                                        <li><a class='dropdown-item' href='/konyvtar/index.php?oldal=bejelentkezes'>Bejelentkezés</a></li>
                                        <li><a class='dropdown-item' href='/konyvtar/index.php?oldal=regisztracio'>Regisztráció</a></li>
                                    </ul>
                                </li>  
                                ");
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <?php
        $page = @$_GET["oldal"];
        if (isset($_SESSION["user"]))
        {
            switch ($page)
            {
                case "konyvek":
                {
                    include "pages_public/konyvek.php";
                    break;
                }
                case "admin_konyvek":
                {
                    include "pages_private/admin_konyvek.php";
                    break;
                }
                case "kolcsonzesek":
                {
                    include "pages_private/kolcsonzesek.php";
                    break;
                }
                case "admin_kolcsonzesek":
                {
                    include "pages_private/admin_kolcsonzesek.php";
                    break;
                }
                case "admin":
                {
                    include "pages_private/admin.php";
                    break;
                }
                case "kezdolap":
                {
                    include "pages_private/kezdolap.php";
                    break;
                }
                case "profil":
                {
                    include "pages_private/profil.php";
                    break;
                }
                case "kijelentkezes":
                {
                    include "pages_private/kijelentkezes.php";
                    break;
                }
                default:
                {
                    include "pages_private/kezdolap.php";
                    break;
                }
            }
        }
        else
        {
            switch ($page)
            {

                case "kezdolap":
                {
                    include "pages_public/kezdolap.php";
                    break;
                }
                case "konyvek":
                {
                    include "pages_public/konyvek.php";
                    break;
                }
                case "konyv":
                {
                    include "pages_public/konyv.php";
                    break;
                }
                case "kapcsolat":
                {
                    include "pages_public/kapcsolat.php";
                    break;
                }
                case "bejelentkezes":
                {
                    include "pages_public/bejelentkezes.php";
                    break;
                }
                case "regisztracio":
                {
                    include "pages_public/regisztracio.php";
                    break;
                }
                default:
                {
                    include "pages_public/kezdolap.php";
                    break;
                }
            }
        }
        ?>
       
        <!-- Footer-->
        <footer class="py-5 bg-dark mt-auto">
            <div class="container px-4 px-lg-5">
                <div class="row">
                    <div class="col-lg-4 text-light text-center text-lg-start">
                        <h5>Városi Könyvtár</h5>
                        <p>Város utca X.<br />E-mail: varosi@konyvtar.com<br />Tel: +36 30 123 4567</p>
                    </div>
                    <div class="col-lg-4 text-light text-center">
                        <p>Készítette: Kőnig Roland &copy; Városi Könyvtár rendszer 2023</p>
                        <p>
                            <a href="mailto:varosi@konyvtar.com" class="p-1" target="_blank" ><img src="images/email.png" class="img-res" width="50" alt="Email" title="E-mail"/></a>
                            <a href="#" class="p-1" target="_blank" ><img src="images/facebook.png" class="img-res" width="50" alt="Facebook" title="Facebook"/></a>
                            <a href="#" class="p-1" target="_blank" ><img src="images/twitter.png" class="img-res" width="50" alt="Twitter" title="Twitter"/></a>
                        </p>
                    </div>
                    <div class="col-lg-4 text-light text-lg-end text-center">
                        <a href="#" class="link-primary" data-bs-toggle="modal" data-bs-target="#helpmodal">Kézikönyv</a>
                        <br/>
                        <a href=<?php echo(web::$domain."?oldal=kapcsolat"); ?> class="link-primary">Kapcsolat</a>
                        <br/>
                        <br/>
                        <p>Nyitvatartás:<br/>H-P 06:00-20:00<br/>Sz-V 08:00-16:00</p>
                    </div>
                </div> 
            </div>
             <!--<div class="kapcsolat">
                    <ul>
                        <li>Nyitvatartás:</li>
                        <li>Cím: </li>
                        <li>GPS: </li>
                        <li>E-mail: </li>
                        <li>Telefon: </li>
                    </ul>
                    <ul>
                        <li>H-P 6-20 óráig, Sz-V 10-18 óráig</li>
                        <li>8000 Város, utca X.</li>
                        <li>46.097 / 18.207</li>
                        <li>konyvtar@mail.com</li>
                        <li>+36 30 123 4567</li>
                    </ul>
                </div>-->

        </footer>
        <div class="modal" id="helpmodal">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Kézikönyv</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <?php include "pages_public/help.php"; ?>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>

                </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>


