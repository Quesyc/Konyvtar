<div class='container'>
    <div class='row py-4 my-5'>
        <div class='col'>

            <div class='row'>
                <div class='col'>
                    <h2>Kölcsönzések</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="list-group">

                        <?php
                        if(isset($_GET["azon"]) && $_GET["azon"] != "" && isset($_GET["felh_ID"]) && $_GET["felh_ID"] != "")
                        {
                            $kol_konyv = sqlmuvelet::GetKonyvFromAzon($_GET["azon"]);
                            $kolcsonzes = sqlmuvelet::GetKolcsonzesekFromUser($_GET["felh_ID"], $kol_konyv->ID);

                            $old_konyv = clone $kol_konyv;
                            $kol_konyv->darab = $kol_konyv->darab+1;
                            if($kol_konyv->darab > 0)
                            {
                                $kol_konyv->kolcsonozheto = 1;
                            }
                            sqlmuvelet::GetObjectUpdate("konyvek", $old_konyv, $kol_konyv);
                            sqlmuvelet::GetObjectDelete("kolcsonzesek", $kolcsonzes);

                            header("Location:".web::$domain."?oldal=admin_kolcsonzesek");


                        }
                        $lista = sqlmuvelet::GetKolcsonzesekLista();
                        
                        if(count($lista) > 0)
                        {
                            foreach($lista as $kolcsonzes)
                            {
                                if(strtotime($kolcsonzes->lejarat) > strtotime(date("Y-m-d")))
                                {
                                    if(strtotime($kolcsonzes->lejarat) < strtotime(date("Y-m-d", strtotime("+3 day"))))
                                    {
                                        echo("<div class='list-group-item bg-warning by-opacity-50'>");
                                    }
                                    else
                                    {
                                        echo("<div class='list-group-item'>");
                                    }
                                }
                                else
                                {
                                    echo("<div class='list-group-item bg-danger by-opacity-50'>");
                                }
                                
                                echo("<div class='row'>
                                        <div class='col'>
                                            <h5>".$kolcsonzes->konyv->cim." (".$kolcsonzes->konyv->azonosito.") - ".$kolcsonzes->felhasznalo->nev." (".$kolcsonzes->felhasznalo->azonosito.")</h5>
                                            <p class='m-0'>Kölcsönzés: ".date("Y-m-d", strtotime($kolcsonzes->datum))." - Lejár: ".date("Y-m-d", strtotime($kolcsonzes->lejarat))."</p>                                   
                                        </div>
                                        <div class='col'>
                                            <div class='d-flex justify-content-end p-2'>
                                                <a href='".web::$domain."?oldal=admin_kolcsonzesek&azon=".$kolcsonzes->konyv->azonosito."&felh_ID=".$kolcsonzes->felhasznalo->ID."' class='btn btn-danger align-middle'>Töröl</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>");
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>