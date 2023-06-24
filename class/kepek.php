 <?php
 class kepek
 {
    function __construct()
    {

    }
 
    function KepInit($row)
    {
        $this->ID = $row["kep_ID"];
        $this->kapcs_ID = $row["kapcs_ID"];
        $this->statusz = $row["kep_statusz"];
        $this->nev = $row["kep_nev"];
        $this->cim = $row["kep_cim"];
        $this->utvonal = $row["utvonal"];
        $this->sorrend = $row["sorrend"];
        $this->datum = $row["kep_datum"];
    }

    static function GetKepFormUrl($url)
    {
        if(isset($url))
        {
            if(empty($url))
            {
                return $url;
            }
        }

        return "";
    }

    static function GetKepFormPath($kep)
    {
        $local_path = "upload";

        if(isset($kep))
        {
            if($kep->ID > 0)
            {
                return "<img src='".web::$kep_path."/".$kep->utvonal."' alt='".$kep->cim."' title'".$kep->cim."'class='".$class."' />";
            }
            else
            {
                return "";
            }
        }
    }
    function GetKepFromObj($class = "")
    {
        $local_path = "upload";

        if(isset($this))
        {
            if($this->ID > 0)
            {
                return "<img src='".web::$kep_path."/".$this->utvonal."' alt='".$this->cim."' title'".$this->cim."' class='".$class."' />";
            }
            else
            {
                return "";
            }
        }
    }

    static function GetSqlMezo()
    {
        $sql = "";

        $sql .= "kepek.ID as kep_ID, ";
        $sql .= "kepek.kapcs_ID, ";
        $sql .= "kepek.statusz as kep_statusz, ";
        $sql .= "kepek.nev as kep_nev, ";
        $sql .= "kepek.cim as kep_cim, ";
        $sql .= "kepek.utvonal, ";
        $sql .= "kepek.sorrend, ";
        $sql .= "kepek.kep_datum";

        return $sql;
    }

    static function GetSqlInsertMezo()
    {
        $sql = "";

        $sql .= "kepek.ID, ";
        $sql .= "kepek.kapcs_ID, ";
        $sql .= "kepek.statusz, ";
        $sql .= "kepek.nev, ";
        $sql .= "kepek.cim, ";
        $sql .= "kepek.utvonal, ";
        $sql .= "kepek.sorrend, ";
        $sql .= "kepek.kep_datum ";

        return $sql;
    }


    static function GetSqlJoin($foreign_key)
    {
        return "Left join kepek on kepek.kapcs_ID = ".$foreign_key." ";
    }

    public $ID = 0;
    public $kapcs_ID = 0;
    public $statusz = "";
    public $nev = "";
    public $cim = "";
    public $utvonal = "";
    public $sorrend = 0;
    public $datum = "";
}
 ?>