<div class="container">
    <div class="row py-4 my-5">
        <div class="col">
            
            <div class="row">
                <div class="col">
                    <h2>Profil</h2>
                </div>
            </div>
            
            <?php
            if(isset($_POST["mod"]))
            {
                $hibavan = "";

                if(isset($_POST["nev"]) && $_POST["nev"] == "")
                {
                    $hibavan .= "- A név mezőt kötelező kitölteni.<br />";
                }

                if(isset($_POST["email"]) && $_POST["email"] == "")
                {
                    $hibavan .= "- Az e-mail mezőt kötelező kitölteni.<br />";
                }

                if ($hibavan == "")
                {
                    $oldfelhasznalo = sqlmuvelet::GetFelhasznaloFromID($_GET["user_ID"]);
                    $modfelhasznalo = sqlmuvelet::GetFelhasznaloFromID($_GET["user_ID"]);
                    $modfelhasznalo->nev = $_POST["nev"];
                    $modfelhasznalo->lakcim = $_POST["lakcim"];
                    $modfelhasznalo->szuletesiev = $_POST["szulev"] == "" ? date("Y-m-d"): $_POST["szulev"];
                    $modfelhasznalo->email = $_POST["email"];
                    $modfelhasznalo->telefonszam = $_POST["telefon"];

                    try
                    {
                        if(sqlmuvelet::GetObjectUpdate("felhasznalok", $oldfelhasznalo, $modfelhasznalo))
                        {
                            echo("
                            <div class='alert alert-success col-md-5'>
                            Sikeres módosítás.
                            </div>");
                        }
                        else
                        {
                            echo("
                            <div class='alert alert-success col-md-5'>
                            Nincs módosítandó mező.
                            </div>");
                        }
                        
                    }
                    catch(Exception $ex)
                    {
                        echo("
                        <div class='alert alert-danger col-md-5'>
                        Sql hiba:<br />
                        ".$ex->getMessage()."
                        </div>
                        ");
                    }

                }
                else
                {
                    echo("
                    <div class='alert alert-warning col-md-5'>
                    Felviteli hiba:<br />
                    ".$hibavan."
                    </div>
                    ");
                }
            }
            ?>

            <?php
            
            if(isset($_GET["user_ID"]))
            {
                $felhasznalo = sqlmuvelet::GetFelhasznaloFromID($_GET["user_ID"]);
                if($felhasznalo->ID > 0)
                {
                        
            ?>
                <div class ="row py-2">
                    <div class="col col-md-5">
                        <div class="card">
                            <h4 class="card-title p-3">Adatok</h4>
                            <div class="card-body p-3">
                                <div class='row'>
                                    <div class='col-6'>
                                        <p>Olvasó azonosító:</p>
                                    </div>
                                    <div class='col-6'>
                                        <p><?php echo($felhasznalo->azonosito); ?></p>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-6'>
                                        <p>Típus:</p>
                                    </div>
                                    <div class='col-6'>
                                        <p><?php echo($felhasznalo->GetTipus()); ?></p>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-6'>
                                        <p><?php echo($felhasznalo->GetStatusz()); ?></p>
                                    </div>
                                    <div class='col-6'>
                                        <p><?php echo(date_format(date_create($felhasznalo->datum), "Y-m-d")); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class ="row py-2">
                    <div class="col col-md-5">
                        <div class="card">
                            <h4 class="card-title p-3">*-gal jelölt mezők kitöltése kötelező.</h4>
                            <div class="card-body">
                                <form action="" method="POST">
                                    <div class="form-group p-3">
                                        <label for="" class="form-label">Név*</label>
                                        <input type="text" name="nev" class="form-control" required placeholder="Név" <?php echo("value='".$felhasznalo->nev."'"); ?> />
                                    </div>
                                    <div class="form-group p-3">
                                        <label for="" class="form-label">E-mail*</label>
                                        <input type="email" name="email" class="form-control" required placeholder="E-mail" <?php echo("value='".$felhasznalo->email."'"); ?>>
                                    </div>
                                    <div class="form-group p-3">
                                        <label for="" class="form-label">Lakcím</label>
                                        <input type="text" name="lakcim" class="form-control" placeholder="Lakcím" <?php echo("value='".$felhasznalo->lakcim."'"); ?>>
                                    </div>
                                    <div class="form-group p-3">
                                        <label for="" class="form-label">Születési év</label>
                                        <input type="date" name="szulev" class="form-control" placeholder="Születési év" <?php echo("value='".$felhasznalo->szuletesiev."'"); ?>>
                                    </div>
                                    <div class="form-group p-3">
                                        <label for="" class="form-label">Telefonszám</label>
                                        <input type="tel" name="telefon" class="form-control" placeholder="+36 70 1234567" <?php echo("value='".$felhasznalo->telefonszam."'"); ?>>
                                    </div>
                                    <br />
                                    <br />
                                    <div class="card-footer text-body-secondary">
                                        <input type="submit" name="mod" value="Módosítás" class="btn btn-primary" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            <?php
                }
                else
                {
                    echo("
                    <div class='alert alert-warning col-md-5'>
                    A kiválasztott felhasználó nem elérhető.
                    </div>
                    ");
                }
            }
            else
            {
                echo("
                <div class='alert alert-warning col-md-5'>
                A kiválasztott felhasználó nem elérhető.
                </div>
                ");
            }
            ?>

        </div>
    </div>
</div>