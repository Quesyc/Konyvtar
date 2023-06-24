<?php
class tipusok
{
    function __construct()
    {

    }

    function TipusInit($row)
    {
        $this->ID = $row["tipusID"];
        $this->statusz = $row["tipusstatusz"];
        $this->nev = $row["tipusnev"];
        $this->leiras = $row["tipusleiras"];
        $this->datum = $row["tipusdatum"]; 
    }

    static function GetSqlMezo()
    {
        $sql = "";
    
        $sql .= "tipusok.ID as tipusID, ";
        $sql .= "tipusok.statusz as tipusstatusz, ";
        $sql .= "tipusok.nev as tipusnev, ";
        $sql .= "tipusok.leiras as tipusleiras, ";
        $sql .= "tipusok.datum as tipusdatum ";
    
        return $sql;
    }

    static function GetSqlInsertMezo()
    {
        $sql = "";
    
        $sql .= "tipusok.ID, ";
        $sql .= "tipusok.statusz, ";
        $sql .= "tipusok.nev, ";
        $sql .= "tipusok.leiras, ";
        $sql .= "tipusok.datum ";
    
        return $sql;
    }
    
    static function GetSqlJoin($foreign_key)
    {
        return "Left join tipusok on tipusok.ID = ".$foreign_key." ";
    }

    public $ID = 0;
    public $statusz = "";
    public $nev = "";
    public $leiras = "";
    public $datum = "";
    
}
?>