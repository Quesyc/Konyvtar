<?php
date_default_timezone_set("Europe/Budapest");
header("Content_Type: application/json; charset=utf-8");
include "class/import.php";

$getter = @$_GET["api"];

if(isset($getter))
{
    switch($getter)
    {
        case "konyvek":
        {
            $konyv_lista = sqlmuvelet::GetKonyvekLista();
            echo(json_encode($konyv_lista));
            break;
        }
        case "mufajok":
        {
            $mufaj_lista = sqlmuvelet::GetMufajokLista();
            echo(json_encode($mufaj_lista));
            break;
        }
        case "tipusok":
        {
            $tipus_lista = sqlmuvelet::GetTipusokLista();
            echo(json_encode($tipus_lista));
            break;
        }
        case "kepek":
        {
            $kepek_lista = sqlmuvelet::GetKepekLista();
            $safe_kepek = array();
            foreach($kepek_lista as $kep)
            {
                $arr = array();
                array_push($arr, $kep->kapcs_ID);
                array_push($arr, $kep->nev);
                array_push($arr, $kep->cim);
                array_push($arr, web::$url."/".web::$root_path."/".web::$kep_path."/".$kep->utvonal);
                array_push($arr, $kep->datum);
                array_push($safe_kepek, $arr);
            }
            echo(json_encode($safe_kepek));
            break;
        }
    }
}
else
{
    echo("
    <h1>Könyvtár API</h1>
    <ul>
    <li><a href='".web::$api_domain."?api=konyvek'>Könyvek api</a></li>
    <li><a href='".web::$api_domain."?api=mufajok'>Műfajok api</a></li>
    <li><a href='".web::$api_domain."?api=tipusok'>Típusok api</a></li>
    <li><a href='".web::$api_domain."?api=kepek'>Képek api</a></li>
    </ul>
    ");
}
?>