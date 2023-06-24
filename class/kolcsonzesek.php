<?php
class kolcsonzesek
{
    function __construct()
    {

    }
    function KolcsonzesInit($row)
    {
        $this->ID = $row["kolcsonzesek_ID"];
        $this->felh_ID = $row["kolcsonzesek_felh_ID"];
        if($this->felh_ID > 0)
        {
            $this->felhasznalo = new felhasznalok();
            $this->felhasznalo->FelhasznaloInit($row);
        }
        else
        {
            $this->felhasznalo = new felhasznalok();
        }

        $this->konyv_ID = $row["kolcsonzesek_konyv_ID"];

        if($this->konyv_ID > 0)
        {
            $this->konyv = new konyvek();
            $this->konyv->KonyvInit($row);
        }
        else
        {
            $this->konyv = new konyvek();
        }


        $this->lejarat = $row["kolcsonzesek_lejarat"];
        $this->datum = $row["kolcsonzesek_datum"];

    }


static function GetSqlMezo()
{
    $sql = "";

    $sql .= "kolcsonzesek.ID as kolcsonzesek_ID, ";
    $sql .= "kolcsonzesek.felh_ID as kolcsonzesek_felh_ID, ";
    $sql .= "kolcsonzesek.konyv_ID as kolcsonzesek_konyv_ID, ";
    $sql .= "kolcsonzesek.lejarat as kolcsonzesek_lejarat, ";
    $sql .= "kolcsonzesek.datum as kolcsonzesek_datum";

    return $sql;
}

static function GetSqlInsertMezo()
{
    $sql = "";

    $sql .= "kolcsonzesek.ID, ";
    $sql .= "kolcsonzesek.felh_ID, ";
    $sql .= "kolcsonzesek.konyv_ID, ";
    $sql .= "kolcsonzesek.lejarat, ";
    $sql .= "kolcsonzesek.datum ";

    return $sql;
}

    public $ID = 0;
    public $felh_ID = 0;
    public $konyv_ID = 0;
    public $lejarat = "";
    public $datum = "";

    public $konyv;
    public $felhasznalo;

}
?>