<?php
if(isset($_GET["admin"]))
{
    $konyv_ID = @$_GET["konyv_ID"];

    switch($_GET["admin"])
    {
        case "uj":
        {            
            $ujkonyv = new konyvek();
            $ujkonyv->statusz = "aktiv";
            $ujkonyv->cim = "új könyv";
            $ujkonyv->szerzo = "";
            $ujkonyv->kiadas = 0;
            $ujkonyv->mufaj_ID = 0;
            $ujkonyv->tipus_ID = 0;
            $ujkonyv->nyelv = "";
            $ujkonyv->GenerateAzon();
            $ujkonyv->oldalszam = 0;
            $ujkonyv->kolcsonozheto = 0;
            $ujkonyv->darab = 0;
            $ujkonyv->reszletek = "";
            $ujkonyv->datum = date("Y-m-d H:i:s");
            try
            {
                $konyv_ID = sqlmuvelet::GetObjectBeszuras("konyvek", $ujkonyv);

                if($konyv_ID > 0)
                {
                    header("Location:".web::$domain."?oldal=admin_konyvek&admin=mod&konyv_ID=".$konyv_ID); 
                }
                else
                {
                    echo("
                    <div class='alert alert-danger col'>
                    Sql hiba:<br />
                    - Sikertelen felvitel
                    </div>");
                }
            }
            catch(Exception $ex)
            {
                echo("
                <div class='alert alert-danger col'>
                Sql hiba:<br />
                ".$ex->getMessage()."
                </div>
                ");
            }

            break;
        }
        case "mod":
        {
            if(isset($_GET["konyv_ID"]) && $_GET["konyv_ID"] > 0)
            {
                if(isset($_GET["success"]))
                {
                    echo("
                    <div class='alert alert-success col'>
                    Sikeres módosítás.
                    </div>");
                }
                $modkonyv = sqlmuvelet::GetKonyvFromID($_GET["konyv_ID"]);

                $mufaj_lista = sqlmuvelet::GetMufajokLista();
                $tipus_lista = sqlmuvelet::GetTipusokLista();

                $mufaj_droplist = "<select name='mufaj_ID' class='form-control cursor-pointer'>";
                foreach($mufaj_lista as $mufaj)
                {
                    if($mufaj->ID == $modkonyv->mufaj_ID)
                    {
                        $mufaj_droplist .= "<option selected value='".$mufaj->ID."'>".$mufaj->nev."</option>";
                    }
                    else
                    {
                        $mufaj_droplist .= "<option value='".$mufaj->ID."'>".$mufaj->nev."</option>";
                    }
                }
                $mufaj_droplist .= "</select>";

                $tipus_droplist = "<select name='tipus_ID' class='form-control cursor-pointer'>";
                foreach($tipus_lista as $tipus)
                {
                    if($tipus->ID == $modkonyv->tipus_ID)
                    {
                        $tipus_droplist .= "<option selected value='".$tipus->ID."'>".$tipus->nev."</option>";
                    }
                    else
                    {
                        $tipus_droplist .= "<option value='".$tipus->ID."'>".$tipus->nev."</option>";
                    }
                }
                $tipus_droplist .= "</select>";

                if(isset($_POST["mod"]))
                {
                    if(isset($_POST["cim"]) && $_POST["cim"] != "")
                    {

                        $ujkonyv = sqlmuvelet::GetKonyvFromID($_GET["konyv_ID"]);
                        $ujkonyv->cim = $_POST["cim"];
                        $ujkonyv->szerzo = $_POST["szerzo"];
                        $ujkonyv->kiadas = $_POST["kiadas"];
                        $ujkonyv->mufaj_ID = $_POST["mufaj_ID"];
                        $ujkonyv->mufaj_ID = $_POST["mufaj_ID"];
                        $ujkonyv->nyelv = $_POST["nyelv"];
                        $ujkonyv->oldalszam = $_POST["oldalszam"];
                        $ujkonyv->kolcsonozheto = $_POST["kolcsonozheto"];
                        $ujkonyv->darab = $_POST["darab"];
                        $ujkonyv->reszletek = $_POST["reszletek"];

                        if(isset($_FILES["kep"]) && $_FILES["kep"]["name"] != "")
                        {
                            $kep_nev = $_FILES["kep"]["name"];


                            if(move_uploaded_file($_FILES["kep"]["tmp_name"], web::$kep_path."/".$kep_nev))
                            {
                                if(file_exists(web::$kep_path."/".$kep_nev))
                                {
                                    move_uploaded_file($_FILES["kep"]["tmp_name"], web::$kep_path."/".$ujkonyv->ID."_".date("Y-m-d").".".$_FILES["kep"]["type"]);
                                }
                            }
                            else
                            {
                                echo("
                                <div class='alert alert-warning col'>
                                Kitöltési hiba:<br/>
                                Fájl feltöltés hiba.
                                </div>");
                                return;
                            }
                            

                            if($ujkonyv->kep == null)
                            {
                                $kep = new kepek();
                                $kep->ID = 0;
                                $kep->kapcs_ID = $ujkonyv->ID;
                                $kep->statusz = "aktiv";
                                $kep->nev = muvelet::GetOneString($ujkonyv->cim);
                                $kep->cim = $ujkonyv->cim;
                                $kep->utvonal = $kep_nev;
                                $kep->sorrend = 1;
                                $kep->datum = date("Y-m-d H:i:s");

                                try
                                {
                                    sqlmuvelet::GetObjectBeszuras("kepek", $kep);
                                }
                                catch (Exception $ex)
                                {
                                    echo("
                                    <div class='alert alert-warning col'>
                                    Kitöltési hiba:<br/>
                                    ".$ex->getMessage()."
                                    </div>
                                    ");
                                }
                            }
                            else
                            {
                                $kep = sqlmuvelet::GetKepFromKapcsID($ujkonyv->ID);
                                $kep->nev = muvelet::GetOneString($ujkonyv->cim);
                                $kep->cim = $ujkonyv->cim;
                                $kep->utvonal = $kep_nev;

                                try
                                {
                                    sqlmuvelet::GetObjectUpdate("kepek", $ujkonyv->kep, $kep);
                                }
                                catch (Exception $ex)
                                {
                                    echo("
                                    <div class='alert alert-warning col'>
                                    Kitöltési hiba:<br/>
                                    ".$ex->getMessage()."
                                    </div>
                                    ");
                                }
                            }
                        }

                        try
                        {
                            sqlmuvelet::GetObjectUpdate("konyvek", $modkonyv, $ujkonyv);

                            header("Location:".web::$domain."?oldal=admin_konyvek&admin=mod&konyv_ID=".$_GET["konyv_ID"]."&success=1");
                        }
                        catch (Exception $ex)
                        {
                            echo("
                            <div class='alert alert-warning col'>
                            Sql hiba:<br/>
                            ".$wx->getMessage()."
                            </div>");
                        }
                    }
                    else
                    {
                        echo("
                        <div class='alert alert-warning col'>
                        Kitöltési hiba:<br/>
                        - A cím nem  lehet üres.
                        </div>
                        ");
                        
                    }
                }
                ?>

                <div class="container">
                    <div class="row py-4 my-5">
                        <div class="col-lg-12">

                            <div class="row">
                                <div class="col-6">
                                    <h2>Könyvek módosítás</h2>
                                </div>

                                <div class="col-6">

                                </div>
                            </div>

                            <form action="" method="POST" enctype="multipart/form-data">

                            <div class="row">
                            <div class="col-lg-6">
                                <?php
                                if($modkonyv->kep != null)
                                {
                                    echo($modkonyv->kep->GetKepFromObj("img-res border border-secondary rounded-2 p-3"));
                                }
                                ?>
                            </div>
                                <div class="col-lg-6">
                                    <div class="card">
                                        <h2 class="card-title p-3"><?php echo($modkonyv->cim." - Azon: ".$modkonyv->azonosito); ?></h2>
                                        <div class="card-body">
                                            <div class="form-group p-3">
                                                <label for="" class="form-label">Cím</label>
                                                <input type="text" name="cim" class="form-control" required placeholder="Cim" <?php echo("value='".$modkonyv->cim."'");?> />
                                            </div>
                                            <div class="form-group p-3">
                                                <label for="" class="form-label">Szerzo</label>
                                                <input type="text" name="szerzo" class="form-control" placeholder="Szerzo" <?php echo("value='".$modkonyv->szerzo."'");?>>
                                            </div>
                                            <div class="form-group p-3">
                                                <label for="" class="form-label">Kiadas éve</label>
                                                <input type="number" name="kiadas" class="form-control" max="3000" placeholder="Kiadas" <?php echo("value='".$modkonyv->kiadas."'");?>>
                                            </div>
                                            <div class="form-group p-3">
                                                <label for="" class="form-label">Műfaj</label>
                                                <?php echo($mufaj_droplist);?>
                                            </div>
                                            <div class="form-group p-3">
                                                <label for="" class="form-label">Típus</label>
                                                <?php echo($tipus_droplist);?>
                                            </div>
                                            <div class="form-group p-3">
                                                <label for="" class="form-label">Nyelv</label>
                                                <input type="text" name="nyelv" class="form-control" placeholder="Nyelv" <?php echo("value='".$modkonyv->nyelv."'");?>>
                                            </div>
                                            <div class="form-group p-3">
                                                <label for="" class="form-label">Oldalszám</label>
                                                <input type="number" name="oldalszam" class="form-control" placeholder="Oldalszam" <?php echo("value='".$modkonyv->oldalszam."'");?>>
                                            </div>
                                            <div class="form-group px-3 pt-3">
                                                <label for="" class="form-label">Kölcsönözhető</label>
                                            </div>
                                            <div class="form-group px-3 pb-3">
                                                <input type="radio" class="form-check-input cursor-pointer" name="kolcsonozheto" value="1" <?php if($modkonyv->kolcsonozheto){ echo("checked");}?> />
                                                <label for="" class="form-check-label">Igen</label></br>
                                                <input type="radio" class="form-check-input cursor-pointer" name="kolcsonozheto" value="0" <?php if(!$modkonyv->kolcsonozheto){ echo("checked");}?> />
                                                <label for="" class="form-check-label">Nem</label>
                                            </div>
                                            <div class="form-group p-3">
                                                <label for="" class="form-label">Darabszám</label>
                                                <input type="number" name="darab" class="form-control" placeholder="Darabszám" <?php echo("value='".$modkonyv->darab."'");?>>
                                            </div>
                                            <div class="form-group px-3 pt-3">
                                                <label for="" class="form-label">Részletek</label>
                                            </div>
                                            <div class="form-group px-3 pb-3">
                                                <textarea name="reszletek" rows="8" class="form-control"><?php echo($modkonyv->reszletek); ?></textarea>
                                            </div>
                                            <div class="form-group p-3">
                                                <label for="" class="form-label">Kép</label>
                                                <input type="file" name="kep" class="form-control cursor-pointer" />
                                            </div>
                                            <br />
                                            <br />
                                            <div class="card-footer text-body-secondary">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input type="submit" name="mod" value="Módosítás" class="btn btn-primary">
                                                    </div>
                                                    <div class="col-md-6 d-flex justify-content-end">
                                                        <a href="<?php echo(web::$domain."?oldal=admin_konyvek&admin=del&azon=".$modkonyv->azonosito); ?>" class="btn btn-danger" >Töröl</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                            </form>
                        </div>
                    </div>
                </div>
                <?php
            }
            else
            {
                header("Location:".web::$domain."?oldal=admin_konyvek&admin=lista");
            }
            break;
        }
        case "del":
        {
            if(isset($_GET["azon"]) && $_GET["azon"] != "")
            {
                $delkonyv = sqlmuvelet::GetKonyvFromAzon($_GET["azon"]);

                try
                {
                    sqlmuvelet::GetKonyvDelete($delkonyv);          
                    
                    header("Location:".web::$domain."?oldal=admin_konyvek&admin=lista");
                }
                catch (Exception $ex)
                {
                    echo("
                    <div class='alert alert-warning col'>
                    Sql hiba:<br/>
                    ".$wx->getMessage()."
                    </div>");
                }
            }
            else
            {
                header("Location:".web::$domain."?oldal=admin_konyvek&admin=lista");
            }
            break;
        }
        default:
        {
                ?>
                <div class="container">
                <div class="row py-4 my-5">
                    <div class="col-lg-12">
            
                        <div class="row">
                            <div class="col-6">
                                <h2>Könyvek</h2>
                            </div>
                            <div class="col-6">
                                <div class="btn-group float-end">
                                    <a href="<?php echo(web::$domain."?oldal=admin_konyvek&admin=uj"); ?>"><button type="button" class="btn btn-outline-primary">Új könyv</button></a>
                                </div>
                            </div>
                        </div>
            
                        <div class="row py-2">
                            <div class="col-lg-12">
            
                                <div class="list-group">
                                    
                                    <?php
                                    
                                    $konyvek = sqlmuvelet::GetKonyvekLista();
            
                                    foreach($konyvek as $konyv)
                                    {
                                        echo("
                                        <a href='".web::$domain."?oldal=admin_konyvek&admin=mod&konyv_ID=".$konyv->ID."' class='list-group-item list-group-item-action flex-column align-items-start ".($konyv->kolcsonozheto ? "":"bg-warning bg-opacity-25")."'>
                                            <div class='d-flex w-100 justify-content-between'>
                                                <h5 class='mb-1'>".$konyv->cim."</h5>
                                                <small>".$konyv->darab." darab</small>
                                            </div>
                                            <p class='mb-1'>Múfaj: ".$konyv->mufaj->nev.", Típus: ".$konyv->tipus->nev.", Szerző: ".$konyv->szerzo."</p>
                                            <small>Aton: " .$konyv->azonosito."</small>
                                        </a>");
                                    }
                                    ?>
                                </div>
            
                            </div>
                        </div>
            
                    </div>
                </div>
            </div>
            <?php
            break;
        }
    }
}
else
{
    header("Location:".web::$domain."?oldal=admin_konyvek&admin=lista");
}
?>




