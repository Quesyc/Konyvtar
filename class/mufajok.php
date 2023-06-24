<?php
class mufajok
{
    function __construct()
    {

    }

    function MufajInit($row)
    {
        $this->ID = $row["mufajID"];
        $this->statusz = $row["mufajstatusz"];
        $this->nev = $row["mufajnev"];
        $this->leiras = $row["mufajleiras"];
        $this->datum = $row["mufajdatum"]; 
    }

    static function GetSqlMezo()
    {
        $sql = "";

        $sql .= "mufajok.ID as mufajID, ";
        $sql .= "mufajok.statusz as mufajstatusz, ";
        $sql .= "mufajok.nev as mufajnev, ";
        $sql .= "mufajok.leiras as mufajleiras, ";
        $sql .= "mufajok.datum as mufajdatum ";

        return $sql;
    }

    static function GetSqlInsertMezo()
    {
        $sql = "";

        $sql .= "mufajok.ID, ";
        $sql .= "mufajok.statusz, ";
        $sql .= "mufajok.nev, ";
        $sql .= "mufajok.leiras, ";
        $sql .= "mufajok.datum ";

        return $sql;
    }

    static function GetSqlJoin($foreign_key)
    {
        return "Left join mufajok on mufajok.ID = ".$foreign_key." ";
    }

        public $ID = 0;
        public $statusz = "";
        public $nev = "";
        public $leiras = "";
        public $datum = "";
}
?>