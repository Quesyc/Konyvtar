<?php
class konyvek
{
    function __constructor()
    {

    }

    function KonyvInit($row)
    {
        $this->ID = $row["konyvek_ID"];
        $this->statusz = $row["konyvek_statusz"];
        $this->cim = $row["konyvek_cim"];
        $this->szerzo = $row["konyvek_szerzo"];
        $this->kiadas = $row["konyvek_kiadas"];
        $this->mufaj_ID = $row["konyvek_mufaj_ID"];
        if($this->mufaj_ID > 0)
        {
            $this->mufaj = new mufajok();
            $this->mufaj->MufajInit($row);
        }
        else
        {
            $this->mufaj = new mufajok();
        }
        $this->tipus_ID = $row["konyvek_tipus_ID"];
        if($this->tipus_ID > 0)
        {
            $this->tipus = new tipusok();
            $this->tipus->TipusInit($row);
        }
        else
        {
            $this->tipus = new tipusok();
        }
        $this->nyelv = $row["konyvek_nyelv"];
        $this->azonosito = $row["konyvek_azonosito"];
        $this->oldalszam = $row["konyvek_oldalszam"];
        $this->kolcsonozheto = $row["konyvek_kolcsonozheto"];
        $this->darab = $row["konyvek_darab"];
        $this->reszletek = $row["konyvek_reszletek"];
        $this->datum = $row["konyvek_datum"];

        
        if(isset($row["kep_ID"]))
        {
            $kep = new kepek();
            $kep->KepInit($row);
            $this->kep = $kep;
        }
    }

    function GenerateAzon()
    {
        $rand = rand(0, 9999);
        $this->azonosito = $rand;
        return $rand;
    }

    function GetKolcsonozheto()
    {
        if($this->kolcsonozheto)
        {
            return "Igen";
        }
        else
        {
            return "Nem";
        }
    }

    static function GetSqlMezo()
    {
        $sql = "";
    
        $sql .= "konyvek.ID as konyvek_ID, ";
        $sql .= "konyvek.statusz as konyvek_statusz, ";
        $sql .= "konyvek.cim as konyvek_cim, ";
        $sql .= "konyvek.szerzo as konyvek_szerzo, ";
        $sql .= "konyvek.kiadas as konyvek_kiadas, ";
        $sql .= "konyvek.mufaj_ID as konyvek_mufaj_ID, ";
        $sql .= "konyvek.tipus_ID as konyvek_tipus_ID, ";
        $sql .= "konyvek.nyelv as konyvek_nyelv, ";
        $sql .= "konyvek.azonosito as konyvek_azonosito, ";
        $sql .= "konyvek.oldalszam as konyvek_oldalszam, ";
        $sql .= "konyvek.kolcsonozheto as konyvek_kolcsonozheto, ";
        $sql .= "konyvek.darab as konyvek_darab, ";
        $sql .= "konyvek.reszletek as konyvek_reszletek, ";
        $sql .= "konyvek.datum as konyvek_datum ";


        return $sql;
    }

    static function GetSqlInsertMezo()
    {
        $sql = "";
    
        $sql .= "konyvek.ID, ";
        $sql .= "konyvek.statusz, ";
        $sql .= "konyvek.cim, ";
        $sql .= "konyvek.szerzo, ";
        $sql .= "konyvek.kiadas, ";
        $sql .= "konyvek.mufaj_ID, ";
        $sql .= "konyvek.tipus_ID, ";
        $sql .= "konyvek.nyelv, ";
        $sql .= "konyvek.azonosito, ";
        $sql .= "konyvek.oldalszam, ";
        $sql .= "konyvek.kolcsonozheto, ";
        $sql .= "konyvek.darab, ";
        $sql .= "konyvek.reszletek, ";
        $sql .= "konyvek.datum ";


        return $sql;
    }

static function GetSqlJoin($foreign_key)
{
    return "Left join konyvek on konyvek.ID = ".$foreign_key." ";
}

    public $ID = 0;
    public $statusz = "";
    public $cim = "";
    public $szerzo = "";
    public $kiadas = 0;
    public $mufaj_ID = 0;
    public $tipus_ID = 0;
    public $nyelv = "";
    public $azonosito = 0;
    public $oldalszam = 0;
    public $kolcsonozheto = 0;
    public $darab = "";
    public $reszletek = "";
    public $datum = "";

    public $tipus;
    public $mufaj;
    public $kep;
}
?>