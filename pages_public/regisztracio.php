<div class="container">
    <div class="row py-4 my-5">
        <div class="col">
            
            <div class="row">
                <div class="col">
                    <h2>Regisztráció</h2>
                </div>
            </div>
            
            <?php
            if(isset($_POST["reg"]))
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

                if(isset($_POST["pass"]) && isset($_POST["pass2"]))
                {
                    if($_POST["pass"] == "")
                    {
                        $hibavan .= "- A jelszó mezőt kötelező kitölteni.<br />";
                    }
                    else if($_POST["pass"] != $_POST["pass2"])
                    {
                        $hibavan .= "- A jelszó mezők nem egyeznek.<br />";
                    }
                }

                if ($hibavan == "")
                {
                    $ujfelhasznalo = new felhasznalok();
                    $ujfelhasznalo->ID = 0;
                    $ujfelhasznalo->GenerateAzon();
                    $ujfelhasznalo->nev = $_POST["nev"];
                    $ujfelhasznalo->jelszo = md5($_POST["pass"]);
                    $ujfelhasznalo->statusz = "aktiv";
                    $ujfelhasznalo->tipus = "olvaso";
                    $ujfelhasznalo->lakcim = $_POST["lakcim"];
                    $ujfelhasznalo->szuletesiev = $_POST["szulev"] == "" ? date("Y-m-d"): $_POST["szulev"];
                    $ujfelhasznalo->email = $_POST["email"];
                    $ujfelhasznalo->telefonszam = $_POST["telefon"];
                    $ujfelhasznalo->datum = date("Y-m-d H:i:s");

                    try
                    {
                        sqlmuvelet::GetObjectBeszuras("felhasznalok", $ujfelhasznalo);
                        echo("
                        <div class='alert alert-success col-md-5'>
                        Sikeres felhasználó létrehozás.
                        </div>");
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

            <div class ="row py-2">
                <div class="col col-md-5">
                    <div class="card">
                        <h4 class="card-title p-3">*-gal jelölt mezők kitöltése kötelező.</h4>
                        <div class="card-body">
                            <form action="" method="POST">
                                <div class="form-group p-3">
                                    <label for="" class="form-label">Név*</label>
                                    <input type="text" name="nev" class="form-control" required placeholder="Név">
                                </div>
                                <div class="form-group p-3">
                                    <label for="" class="form-label">E-mail*</label>
                                    <input type="email" name="email" class="form-control" required placeholder="E-mail">
                                </div>
                                <div class="form-group p-3">
                                    <label for="" class="form-label">Jelszó*</label>
                                    <input type="password" name="pass" class="form-control" required placeholder="Jelszó">
                                </div>
                                <div class="form-group p-3">
                                    <label for="" class="form-label">Jelszó újra*</label>
                                    <input type="password" name="pass2" class="form-control" required placeholder="Jelszó újra">
                                </div>
                                <div class="form-group p-3">
                                    <label for="" class="form-label">Lakcím</label>
                                    <input type="text" name="lakcim" class="form-control" placeholder="Lakcím">
                                </div>
                                <div class="form-group p-3">
                                    <label for="" class="form-label">Születési év</label>
                                    <input type="date" name="szulev" class="form-control" placeholder="Születési év">
                                </div>
                                <div class="form-group p-3">
                                    <label for="" class="form-label">Telefonszám</label>
                                    <input type="tel" name="telefon" class="form-control" placeholder="+36 70 1234567">
                                </div>
                                <br />
                                <br />
                                <div class="card-footer text-body-secondary">
                                    <input type="submit" name="reg" value="Regisztráció" <?php if (isset($_POST["reg"])) {echo("disabled='true'"); }?> class="btn btn-primary" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>