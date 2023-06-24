<?php

if(isset($_GET["admin"]) && $_GET["admin"] != "" && (
    (isset($_GET["mufaj_ID"]) && $_GET["mufaj_ID"] != "") ||
    (isset($_GET["tipus_ID"]) && $_GET["tipus_ID"] != "")))
{
    if(isset($_GET["mufaj_ID"]))
    {
        $modmufaj =sqlmuvelet::GetMufajFromID($_GET["mufaj_ID"]);
        $oldmufaj= clone $modmufaj;

        $modmufaj->statusz = "torolve";
    
        sqlmuvelet::GetObjectUpdate("mufajok", $oldmufaj, $modmufaj);
    }

    if(isset($_GET["tipus_ID"]))
    {
        $modtipus =sqlmuvelet::GetTipusFromID($_GET["tipus_ID"]);
        $oldtipus= clone $modtipus;

        $modtipus->statusz = "torolve";
    
        sqlmuvelet::GetObjectUpdate("tipusok", $oldtipus, $modtipus); 
    }
    header("Location:".web::$domain."?oldal=admin");
}

if(isset($_POST["mufaj"]))
{
    if(isset($_POST["mufaj_nev"]) && $_POST["mufaj_nev"] != "")
    {
        $ujmufaj = new mufajok();
        $ujmufaj->statusz = "aktiv";
        $ujmufaj->nev = $_POST["mufaj_nev"];
        $ujmufaj->leiras = "";
        $ujmufaj->datum = date("Y-m-d H:i:s");

        try
        {
            sqlmuvelet::GetObjectBeszuras("mufajok", $ujmufaj);

            header("Location:".web::$domain."?oldal=admin");
        }
        catch (Exception $ex)
        {
            echo("
            <div class='alert alert-danger col'>
            Sql hiba:<br />
            ".$ex->getMessage()."
            </div>");
        }
    }
    else
    {
    echo("
        <div class='alert alert-danger col'>
        Kitöltési hiba:<br />
        - A műfaj név nem lehet üres.
        </div>");
    }
}

if(isset($_POST["tipus"]))
{
    if(isset($_POST["tipus_nev"]) && $_POST["tipus_nev"] != "")
    {
        $ujtipus = new tipusok();
        $ujtipus->statusz = "aktiv";
        $ujtipus->nev = $_POST["tipus_nev"];
        $ujtipus->leiras = "";
        $ujtipus->datum = date("Y-m-d H:i:s");

        try
        {
            sqlmuvelet::GetObjectBeszuras("tipusok", $ujtipus);

            header("Location:".web::$domain."?oldal=admin");
        }
        catch (Exception $ex)
        {
            echo("
            <div class='alert alert-danger col'>
            Sql hiba:<br />
            ".$ex->getMessage()."
            </div>");
        }
    }
    else
    {
    echo("
        <div class='alert alert-danger col'>
        Kitöltési hiba:<br />
        - A típus név nem lehet üres.
        </div>");
    }
}

?>

<div class="container">
    <div class="row py-4 my-5">
        <div class="col-lg-12">

            <div class="row">
                <div class="col">
                    <h2>Admin</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 py-2">
                    <div class="card py-1">
                        <h5 class="card-title p-2">Műfaj</h5>
                        <div class="card-body">

                            <form action="" method="POST">
                                <div class="row g-2 p-2 pb-4">
                                    <div class="col">
                                        <input type="text" class="form-control" name="mufaj_nev" placeholder="Műfaj név"/>
                                    </div>
                                    <div class="col-auto">
                                        <input type="submit" class="btn btn-primary" name="mufaj" value="Hozzáadás"/>                                 
                                    </div>
                                </div>
                            </form>

                            <hr class="m-0"/>

                            <div class="row">
                                <div class="col">
                                    <ul class="list-group list-group-flush">
                                        <?php
                                        $lista = sqlmuvelet::GetMufajokLista();
                                        if(count($lista) > 0)
                                        {
                                            foreach ($lista as $mufaj)
                                            {
                                            echo("
                                                <li class='list-group-item d-flex justify-content-between align-items-center'>
                                                    ".$mufaj->nev."
                                                    <span class='badge'><a href='".web::$domain."?oldal=admin&admin=del&mufaj_ID=".$mufaj->ID."' class='link-primary'>Töröl</a></span>
                                                </li>");
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                    
                </div>

                <div class="col-lg-6 py-2">
                    <div class="card py-1">
                        <h5 class="card-title p-2">Típus</h5>
                        <div class="card-body">

                            <form action="" method="POST">
                                <div class="row g-2 p-2 pb-4">
                                    <div class="col">
                                        <input type="text" class="form-control" name="tipus_nev" placeholder="Típus név"/>
                                    </div>
                                    <div class="col-auto">
                                        <input type="submit" class="btn btn-primary" name="tipus" value="Hozáadás"/>                                 
                                    </div>
                                </div>
                            </form>

                            <hr class="m-0"/>

                            <div class="row">
                                <div class="col">
                                    <ul class="list-group list-group-flush">
                                        <?php
                                        $lista = sqlmuvelet::GetTipusokLista();
                                        if(count($lista) > 0)
                                        {
                                            foreach ($lista as $tipus)
                                            {
                                            echo("
                                                <li class='list-group-item d-flex justify-content-between align-items-center'>
                                                    ".$tipus->nev."
                                                    <span class='badge'><a href='".web::$domain."?oldal=admin&admin=del&tipus_ID=".$tipus->ID."' class='link-primary'>Töröl</a></span>
                                                </li>");
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                    
                </div>
            </div>

        </div>
    </div>   
</div>