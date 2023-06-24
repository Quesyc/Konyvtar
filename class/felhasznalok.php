<?php
class felhasznalok
{
    function __construct()
    {

    }

    function FelhasznaloInit($row)
    {
        $this->ID = $row["felhasznalok_ID"];
        $this->azonosito = $row["felhasznalok_azon"];
        $this->nev = $row["felhasznalok_nev"];
        $this->jelszo = $row["felhasznalok_jelszo"];
        $this->statusz = $row["felhasznalok_statusz"];
        $this->tipus = $row["felhasznalok_tipus"];
        $this->lakcim = $row["felhasznalok_lakcim"];
        $this->szuletesiev = $row["felhasznalok_szuletesiev"];
        $this->email = $row["felhasznalok_email"];
        $this->telefonszam = $row["felhasznalok_telefonszam"];
        $this->datum = $row["felhasznalok_datum"];

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

    function GetStatusz()
    {
        if ($this->statusz == "aktiv")
        {
            return "Aktív";
        }
        else
        {
            return "Törölve";
        }
    }

    function GetTipus()
    {
        if ($this->statusz == "konyvtaros")
        {
            return "Könyvtáros";
        }
        else
        {
            return "Olvasó";
        }
    }

    function LoadSession()
    {
        return get_object_vars($this);
    }

    static function GetSqlMezo()
    {
        $sql = "";

        $sql .= "felhasznalok.ID as felhasznalok_ID, ";
        $sql .= "felhasznalok.azonosito as felhasznalok_azon, ";
        $sql .= "felhasznalok.nev as felhasznalok_nev, ";
        $sql .= "felhasznalok.jelszo as felhasznalok_jelszo, ";
        $sql .= "felhasznalok.statusz as felhasznalok_statusz, ";
        $sql .= "felhasznalok.tipus as felhasznalok_tipus, ";
        $sql .= "felhasznalok.lakcim as felhasznalok_lakcim, ";
        $sql .= "felhasznalok.szuletesiev as felhasznalok_szuletesiev, ";
        $sql .= "felhasznalok.email as felhasznalok_email, ";
        $sql .= "felhasznalok.telefonszam as felhasznalok_telefonszam, ";
        $sql .= "felhasznalok.datum as felhasznalok_datum ";


        return $sql;
    }

    static function GetSqlInsertMezo()
    {
        $sql = "";

        $sql .= "felhasznalok.ID, ";
        $sql .= "felhasznalok.azonosito, ";
        $sql .= "felhasznalok.nev, ";
        $sql .= "felhasznalok.jelszo, ";
        $sql .= "felhasznalok.statusz, ";
        $sql .= "felhasznalok.tipus, ";
        $sql .= "felhasznalok.lakcim, ";
        $sql .= "felhasznalok.szuletesiev, ";
        $sql .= "felhasznalok.email, ";
        $sql .= "felhasznalok.telefonszam, ";
        $sql .= "felhasznalok.datum ";


        return $sql;
    }

    static function GetSqlJoin($foreign_key)
    {
        return "Left join felhasznalok on felhasznalok.ID = ".$foreign_key." ";
    }

    public $ID = 0;
    public $azonosito = 0;
    public $nev = "";
    public $jelszo = "";
    public $statusz = "";
    public $tipus = "";
    public $lakcim = "";
    public $szuletesiev = "";
    public $email = "";
    public $telefonszam = "";
    public $datum = "";

    public $kep;
}
?>