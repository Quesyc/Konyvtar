<?php
if(isset($_POST["search"]))
{
    $url = "?oldal=konyvek";

    if(isset($_POST["search_text"]) && $_POST["search_text"] != "")
    {
        $url .= "&search_text=".$_POST["search_text"];
    }
    if(isset($_POST["search_number"]) && $_POST["search_number"] != "")
    {
        $url .= "&search_number=".$_POST["search_number"];
    }

    if(isset($_POST["mufaj"]) && $_POST["mufaj"] != "0")
    {
        $url .= "&mufaj=".$_POST["mufaj"];
    }

    if(isset($_POST["tipus"]) && $_POST["tipus"] != "0")
    {
        $url .= "&tipus=".$_POST["tipus"];
    }

    if(isset($_POST["kolcsonozheto"]) && $_POST["kolcsonozheto"] != "-")
    {
        $url .= "&kolcsonozheto=".$_POST["kolcsonozheto"];
    }

    header("Location:".web::$domain.$url);
}
?>
<div class='container'>
    <div class='row py-4 my-5'>
        <div class='col'>

            <div class='row'>
                <div class='col'>
                    <h2>Könyvek</h2>
                </div>
            </div>

            <form action="" method="POST" id="search_form">
                <div class='row'>
                    <div class='col'>
                        <div class="card p-3">
                            <h5 class="card-title" px-2>Kereső</h5>
                            
                            <div class="row py-2">
                                <div class="col-lg-6 py-2">
                                    <input type="text" class="form-control" <?php if (isset($_GET["search_text"]) && $_GET["search_text"] != "") {echo("value='".$_GET["search_text"]."'"); }?> name="search_text" placeholder="Cím, Szerző, Nyelv, Részletek"/>
                                </div>  
                                <div class="col-lg-6">
                                    <input type="number" class="form-control" <?php if (isset($_GET["search_number"]) && $_GET["search_number"] != "") {echo("value='".$_GET["search_number"]."'"); }?> name="search_number" placeholder="Kiadás, Azonosító, Oldalszám, Darab"/>
                                </div>  
                            </div>
                            
                            <div class="row py-2">
                                <div class="col-lg-4 py-2">
                                    <label for="">Műfaj:</label>
                                    <select name="mufaj" id="" class="form-control cursor-pointer">
                                        <?php
                                        $mufajok = sqlmuvelet::GetMufajokLista();
                                        echo("<option value='0'>-- Válassz --</option>");
                                        foreach($mufajok as $mufaj)
                                        {
                                            if(isset($_GET["mufaj"]) && $_GET["mufaj"] == $mufaj->ID)
                                            {
                                                echo("<option value='".$mufaj->ID."'selected>".$mufaj->nev."</option>");
                                            }
                                            else
                                            {
                                                echo("<option value='".$mufaj->ID."'>".$mufaj->nev."</option>");
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-4 py-2">
                                <label for="">Típus:</label>
                                    <select name="tipus" id="" class="form-control cursor-pointer">
                                        <?php
                                            $tipusok = sqlmuvelet::GetTipusokLista();
                                            echo("<option value='0'>-- Válassz --</option>");
                                            foreach($tipusok as $tipus)
                                            {
                                                if(isset($_GET["tipus"]) && $_GET["tipus"] == $tipus->ID)
                                                {
                                                    echo("<option value='".$tipus->ID."'selected>".$tipus->nev."</option>");
                                                }
                                                else
                                                {
                                                    echo("<option value='".$tipus->ID."'>".$tipus->nev."</option>");
                                                }
                                            }
                                            ?>
                                    </select>                               
                                </div>
                                <div class="col-lg-4 py-2">
                                <label for="">Kölcsönözhető:</label>
                                    <select name="kolcsonozheto" id="" class="form-control cursor-pointer">
                                        <?php
                                        if(isset($_GET["kolcsonozheto"]))
                                        {
                                            if($_GET["kolcsonozheto"] == "1")
                                            {
                                                echo("<option value='-'>-- Válassz --</option>");
                                                echo("<option value='1' selected>Igen</option>");
                                                echo("<option value='0'>Nem</option>");
                                            }
                                            else
                                            {
                                                echo("<option value='-'>-- Válassz --</option>");
                                                echo("<option value='1'>Igen</option>");
                                                echo("<option value='0' selected>Nem</option>");
                                            }
                                            
                                        }
                                        else
                                        {
                                            echo("<option value='-'>-- Válassz --</option>");
                                            echo("<option value='0'>Nem</option>");
                                            echo("<option value='1'>Igen</option>");
                                        }
                                        ?>
                                    </select>                                    
                                </div>
                            </div>
                                  
                            <div class="row py-2">                                   
                                <div class="col">
                                    <input type="submit" class="btn btn-primary float-end" name="search" value="Keresés"/>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>

            <?php
            $kereso = " konyvek.statusz = 'aktiv' ";

            if(isset($_GET["search_text"]) && $_GET["search_text"] != "")
            {
                $kereso .= "and (";
                $kereso .= " konyvek.cim like '%".$_GET["search_text"]."%' ";
                $kereso .= "or konyvek.szerzo like '%".$_GET["search_text"]."%' ";
                $kereso .= "or konyvek.nyelv like '%".$_GET["search_text"]."%' ";
                $kereso .= "or konyvek.reszletek like '%".$_GET["search_text"]."%' ) ";
            }

            if(isset($_GET["search_number"]) && $_GET["search_number"] != "")
            {
                $kereso .= "and (";
                $kereso .= " konyvek.kiadas like ".$_GET["search_number"]." ";
                $kereso .= "or konyvek.azonosito like ".$_GET["search_text"]." ";
                $kereso .= "or konyvek.oldalszam like ".$_GET["search_text"]." ";
                $kereso .= "or konyvek.darab like ".$_GET["search_text"]." ) ";
            }

            if(isset($_GET["mufaj"]) && $_GET["mufaj"] != "0")
            {
                $kereso .= "and konyvek.mufaj_ID = ".$_GET["mufaj"]." ";
            }

            if(isset($_GET["tipus"]) && $_GET["tipus"] != "0")
            {
                $kereso .= "and konyvek.tipus_ID = ".$_GET["tipus"]." ";
            }

            if(isset($_GET["kolcsonozheto"]) && $_GET["kolcsonozheto"] != "-")
            {
                $kereso .= "and konyvek.kolcsonozheto = ".$_GET["kolcsonozheto"]." ";
            }

            $lista = sqlmuvelet::GetKonyvekLista($kereso);
            if(isset($_SESSION["user"]))
            {
                if(isset($_GET["kolcsonzes"]) && $_GET["kolcsonzes"] != "")
                {
                    $kol_konyv = sqlmuvelet::GetKonyvFromAzon($_GET["kolcsonzes"]);
                    $kolcsonzes = sqlmuvelet::GetKolcsonzesekFromUser($_SESSION["user"]["ID"],$kol_konyv->ID);

                    if(isset($kolcsonzes) && $kolcsonzes->ID > 0)
                    {
                    echo("
                        <div class='alert alert-warning col3'>
                        Ezt a könyvet kikölcsönözted már. (".$kol_konyv->cim.")
                        </div>");
                    }
                    else
                    {
                        $kol = new kolcsonzesek();
                        $kol->felh_ID = $_SESSION["user"]["ID"];
                        $kol->konyv_ID = $kol_konyv->ID;
                        $kol->lejarat = date("Y-m-d", strtotime("+10 day"));
                        $kol->datum = date("Y-m-d H-i-s");
                        
                        sqlmuvelet::GetObjectBeszuras("kolcsonzesek", $kol);

                        $old_konyv = clone $kol_konyv;
                        $kol_konyv->darab = ($kol_konyv->darab-1);

                        if($kol_konyv->darab == 0)
                        {
                            $kol_konyv->kolcsonozheto = 0;
                        }

                        

                        sqlmuvelet::GetObjectUpdate("konyvek", $old_konyv, $kol_konyv);

                            echo("
                            <div class='alert alert-success col-md'>
                            Sikeres kölcsönzés. (".$kol_konyv->cim.")
                            </div>");
                    }
                }
            }
            if(count($lista) > 0)
            {
                foreach($lista as $konyv)
                {
                    echo("
                    <div class='row py-2'>
                        <div class='col'>
                            <div class='card'>
                                <h4 class='card-title p-md-3'>".$konyv->cim."</h4>
                                <div class='card-body p-3'>");
                                if(isset($_SESSION["user"]))
                                {
                                    if($konyv->kolcsonozheto && $konyv->darab > 0)
                                    {
                                        $html = "<div class='row'>";
                                        $html.= "   <div class='col-lg-12 d-flex justify-content-end'>";
                                        $html.= "       <a href='".web::$domain."?oldal=konyvek&kolcsonzes=".$konyv->azonosito."' class='btn btn-primary'>Kölcsönzés</a>";
                                        $html.= "   </div>";
                                        $html.= "</div>";
                                        echo($html);
                                    }

                                }
                                echo("
                                    <div class='row'>
                                        <div class='col-md-3 p-3 text-center'>
                                            ".$konyv->kep->GetKepFromObj("img-res")."
                                        </div>
                                        <div class='col-md-6 p-3'>
                                            <div class='row'>
                                                <div class='col-6'>
                                                    <p>Szerző</p>
                                                </div>
                                                <div class='col-6'>
                                                    <p>".$konyv->szerzo."</p>
                                                </div>
                                            </div>
                                            <div class='row'>
                                                <div class='col-6'>
                                                    <p>Kiadás</p>
                                                </div>
                                                <div class='col-6'>
                                                    <p>".$konyv->kiadas."</p>
                                                </div>
                                            </div>
                                            <div class='row'>
                                                <div class='col-6'>
                                                    <p>Műfaj</p>
                                                </div>
                                                <div class='col-6'>
                                                    <p>".$konyv->mufaj->nev."</p>
                                                </div>
                                            </div>
                                            <div class='row'>
                                                <div class='col-6'>
                                                    <p>Nyelv</p>
                                                </div>
                                                <div class='col-6'>
                                                    <p>".$konyv->nyelv."</p>
                                                </div>
                                            </div>
                                            <div class='row'>
                                                <div class='col-6'>
                                                    <p>Oldalszám</p>
                                                </div>
                                                <div class='col-6'>
                                                    <p>".$konyv->oldalszam."</p>
                                                </div>
                                            </div>
                                            <hr />
                                            <div class='row'>
                                                <div class='col-6'>
                                                    <p>Azonosító</p>
                                                </div>
                                                <div class='col-6'>
                                                    <p>".$konyv->azonosito."</p>
                                                </div>
                                            </div>
                                            <div class='row'>
                                                <div class='col-6'>
                                                    <p>Típus</p>
                                                </div>
                                                <div class='col-6'>
                                                    <p>".$konyv->tipus->nev."</p>
                                                </div>
                                            </div>
                                            <div class='row'>
                                                <div class='col-6'>
                                                    <p>Kölcsönözhető</p>
                                                </div>
                                                <div class='col-6'>
                                                    <p>".$konyv->GetKolcsonozheto()."</p>
                                                </div>
                                            </div>
                                            <div class='row'>
                                                <div class='col-6'>
                                                    <p>Mennyiség</p>
                                                </div>
                                                <div class='col-6'>
                                                    <p>".($konyv->darab == 0 ? "<span class='border border-danger rounded-2 p-2 bg-danger bg-opacity-50'>Kikölcsönözve</span>":$konyv->darab." darab")."</p>
                                                </div>
                                            </div>
                                        </div>    
                                        <div class='col-md-3'>
                                            <p class ='text-align-justify'>".$konyv->reszletek."</p>                                  
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    ");
                    }
            }
            else
            {
                echo("
                <div class='row my-2'>
                    <div class='alert alert-warning col'>
                        - Nincs találat
                    </div>
                </div>");
            }
            ?>
        </div>
    </div>
</div>
