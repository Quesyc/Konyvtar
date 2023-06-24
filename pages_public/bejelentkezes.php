<div class="container">
    <div class="row py-4 my-5">
        <div class="col">
            
            <div class="row">
                <div class="col">
                    <h2>Bejelentkezés</h2>
                </div>
            </div>
            
            <?php
            if(isset($_POST["login"]))
            {
                $hibavan = "";

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
                }

                if ($hibavan == "")
                {
                   $felhasznalo = sqlmuvelet::GetLogin($_POST["email"], $_POST["pass"]);
                   if(isset($felhasznalo->ID) && $felhasznalo->ID > 0)
                   {
                        $_SESSION["user"] = $felhasznalo->LoadSession();

                        header("Location:".web::$domain);
                   }
                   else
                   {
                        echo("
                        <div class='alert alert-warning col-md-5'>
                        Helytelen email vagy jelszó.:<br />
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
                        <div class="card-body">
                            <form action="" method="POST">
                                <div class="form-group p-3">
                                    <label for="" class="form-label">E-mail*</label>
                                    <input type="email" name="email" class="form-control" required placeholder="E-mail">
                                </div>
                                <div class="form-group p-3">
                                    <label for="" class="form-label">Jelszó*</label>
                                    <input type="password" name="pass" class="form-control" required placeholder="Jelszó">
                                </div>
                                <br />
                                <br />
                                <div class="card-footer text-body-secondary">
                                    <input type="submit" name="login" value="Bejelentkezés" class="btn btn-primary" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>