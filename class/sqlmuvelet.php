<?php
class sqlmuvelet
{
   private static function GetSelectSql($table, $where = "1", $orderby = "", $limit = "")
   {
        $sql = "Select ";
        switch ($table)
        {
            case "felhasznalok":
            {
                $sql.= felhasznalok::GetSqlMezo().",";
                $sql.= kepek::GetSqlMezo();
                break;
            }
            case "kepek":
            {
                $sql.= kepek::GetSqlMezo();
                break;
            }
            case "kolcsonzesek":
            {
                $sql.= kolcsonzesek::GetSqlMezo().",";
                $sql.= felhasznalok::GetSqlMezo().",";
                $sql.= konyvek::GetSqlMezo().",";
                $sql.= mufajok::GetSqlMezo().",";
                $sql.= tipusok::GetSqlMezo().",";
                $sql.= kepek::GetSqlMezo();
                break;
            }
            case "konyvek":
            {
                $sql.= konyvek::GetSqlMezo().",";
                $sql.= mufajok::GetSqlMezo().",";
                $sql.= tipusok::GetSqlMezo().",";
                $sql.= kepek::GetSqlMezo();
                break;
            }
            case "mufajok":
            {
                $sql.= mufajok::GetSqlMezo();
                break;
            }
            case "tipusok":
            {
                $sql.= tipusok::GetSqlMezo();
                break;
            }
            default:
            {
                $sql.= " * ";
                break;
            }
        }
        $sql.= " From ".$table." ";
        switch ($table)
        {
            case "felhasznalok":
            {
                $sql.= kepek::GetSqlJoin("felhasznalok.ID");
                break;
            }
            case "kolcsonzesek":
            {
                $sql.= felhasznalok::GetSqlJoin("kolcsonzesek.felh_ID");
                $sql.= konyvek::GetSqlJoin("kolcsonzesek.konyv_ID");
                $sql.= mufajok::GetSqlJoin("konyvek.mufaj_ID");
                $sql.= tipusok::GetSqlJoin("konyvek.tipus_ID");
                $sql.= kepek::GetSqlJoin("konyvek.ID");
                break;
            }
            case "konyvek":
            {
                $sql.= mufajok::GetSqlJoin("konyvek.mufaj_ID");
                $sql.= tipusok::GetSqlJoin("konyvek.tipus_ID");
                $sql.= kepek::GetSqlJoin("konyvek.ID");
                break;
            }
        }
        $sql.= "Where " .$where." ";

        if(!empty($orderby))
        {
            $sql.= "Order by ".$orderby." ";
        }
        
        if(!empty($limit))
        {
            $sql.= "Limit ".$limit." ";
        }

        return $sql;
    }

    private static function GetInsertSql($table, $object)
    {
        $sql = "Insert Into ".$table." (";
        switch ($table)
        {
            case "felhasznalok":
            {
                $sql.= felhasznalok::GetSqlInsertMezo();
                break;
            }
            case "kepek":
            {
                $sql.= kepek::GetSqlInsertInsertMezo();
                break;
            }
            case "kolcsonzesek":
            {
                $sql.= kolcsonzesek::GetSqlInsertMezo();
                break;
            }
            case "konyvek":
            {
                $sql.= konyvek::GetSqlInsertMezo();
                break;
            }
            case "mufajok":
            {
                $sql.= mufajok::GetSqlInsertMezo();
                break;
            }
            case "tipusok":
            {
                $sql.= tipusok::GetSqlInsertMezo();
                break;
            }
        }
        $sql.= ") Values (";
        $property_columns = array_keys(get_object_vars($object));
        $property_array = array_values(array_filter(get_object_vars($object), function($item)
        {
        if(isset($item))
        {
            return true;
        }
        return false;
        }));

        for($i = 0; $i < count($property_array); $i++)
        {
            if ($property_columns[$i] == "ID")
            {
                $sql.= "null,";
            }
            else
            {
                if($i == (count($property_array)-1))
                {
                    $sql.= "'".$property_array[$i]."'";
                }
                else
                {
                    $sql.= "'".$property_array[$i]."',";
                }
            }
        }
        $sql.= ")";

        return $sql;
    }

        private static function GetArrayFilter($item)
        {
            if (isset($item->ID))
            {
                return true;
            }
            return false;
        }

        private static function GetUpdateSql($table, $oldobject, $newobject)
        {
            $sql = "Update ".$table." ";
            $sql .= "Set ";

            $object_columns = array_keys(get_object_vars($newobject));
            $oldobject_values = array_values(get_object_vars($oldobject));
            $newobject_values = array_values(get_object_vars($newobject));

            $modositasvan = false;
            for($i = 0; $i < count($object_columns); $i++)
            {
                if($oldobject_values[$i] != $newobject_values[$i])
                {
                    $modositasvan = true;

                    $sql.= $object_columns[$i]."='".$newobject_values[$i]."',"; 

                }
                
            }

            if($modositasvan)
            {
                $sql = substr_replace($sql," ",-1);
            }
        
            $sql .= "Where ".$table.".ID = ".$newobject->ID;

            if($modositasvan)
            {
                return $sql;
            }
            else
            {
                return "";
            }

        }

        private static function GetDeleteSql($table, $ID)
        {
            $sql = "Delete From ";
            $sql .= $table." ";
            $sql .= "Where ".$table.".ID = ".$ID;
            return $sql;
        }

        public static function GetListaLekerdez($table, $where = "1", $orderby = "", $limit = "")
        {
            $lista = array();

            $kapcsolat = new sql();

            $lista = $kapcsolat->lekerdezes(self::GetSelectSql($table, $where, $orderby, $limit));
        
            return $lista;
        }

        public static function GetObjectBeszuras($table, $object)
        {
            $kapcsolat = new sql();

            $kapcsolat->GetSqlResult(self::GetInsertSql($table, $object));
        
            return $kapcsolat->GetLastInsertedID();
        }

        public static function GetObjectUpdate($table, $oldobject, $newobject)
        {
            $kapcsolat = new sql();

            $sql= self::GetUpdateSql($table, $oldobject, $newobject);

            //echo($sql);

            if($sql == "")
            {
                return false;
            }
            else
            {
                $kapcsolat->GetSqlResult($sql);
                return true; 
            }

        }

        public static function GetObjectDelete($table, $object)
        {
            $kapcsolat = new sql();

            if(isset($object->ID) && $object->ID > 0)
            {
                $kapcsolat->GetSqlResult(self::GetDeleteSql($table, $object->ID));
                return true;
            }
            else
            {
                return false;
            }
        }

        public static function GetLogin($email, $pass)
        {
            $felhasznalo = new felhasznalok();

            $kapcsolat = new sql();

            //biztonsági ellenőrzés
            $safe_user = trim($email);
            $safe_pass = trim($pass); 

            $safe_user = str_replace("'", "", $safe_user);
            $safe_user = str_replace('"', "", $safe_user);
            $safe_user = str_replace(";", "", $safe_user);
            //$safe_user = str_replace(".", "", $safe_user);

            $safe_pass = str_replace("'", "", $safe_pass);
            $safe_pass = str_replace('"', "", $safe_pass);
            $safe_pass = str_replace(";", "", $safe_pass);
            $safe_pass = str_replace(".", "", $safe_pass);

            $adat = $kapcsolat->GetSqlResult(self::GetSelectSql("felhasznalok", "felhasznalok.email = '".$safe_user."' and felhasznalok.jelszo = '".md5($safe_pass)."' "));
            
            $row = mysqli_fetch_array($adat);
            
            if(isset($row) && count($row) > 0)
            {
                $felhasznalo->FelhasznaloInit($row);
                return $felhasznalo;
            }
            return $felhasznalo;
        }

        public static function GetFelhasznalokLista($where = "1", $orderby = "", $limit = "")
        {
            $lista = array();

            $kapcsolat = new sql();

            $adat = $kapcsolat->GetSqlResult(self::GetSelectSql("felhasznalok", $where, $orderby, $limit));
        
            while($row = mysqli_fetch_array($adat))
            {
                $felhasznalo = new felhasznalok();
                $felhasznalo->FelhasznaloInit($row);

                array_push($lista, $felhasznalo);
            }

            return $lista;
        }

        public static function GetFelhasznaloFromID($ID)
        {
            $felhasznalo = new felhasznalok();

            if (isset($ID) && $ID > 0)
            {
                $lista = self::GetFelhasznalokLista("felhasznalok.ID = ".$ID);

                if(count($lista) > 0)
                {
                    $felhasznalo = $lista[0];
                }
            }

            return $felhasznalo;
        }

        public static function GetFelhasznaloDelete($felhasznalo)
        {
            $oldfelhasznalo = $felhasznalo;
            $newfelhasznalo = clone $felhasznalo;

            $newfelhasznalo->statusz = "torolve";

            if(self::GetObjectUpdate("felhasznalok", $oldfelhasznalo, $newfelhasznalo))
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public static function GetKepekLista($where = "1", $orderby = "", $limit = "")
        {
            $lista = array();

            $kapcsolat = new sql();

            $adat = $kapcsolat->GetSqlResult(self::GetSelectSql("kepek", $where, $orderby, $limit));
        
            while($row = mysqli_fetch_array($adat))
            {
                $kep = new kepek();
                $kep->KepInit($row);

                array_push($lista, $kep);
            }

            return $lista;
        }

        public static function GetKepFromID($ID)
        {
            $kep = new kepek();

            if(isset($ID) && $ID > 0)
            {
                $lista = self::GetKepekLista("kepek.ID = ".$ID);

                if(count($lista) > 0)
                {
                    $kep = $lista[0];
                }
            }
            return $kep;
        }

        public static function GetKepFromKapcsID($ID)
        {
            $kep = new kepek();

            if(isset($ID) && $ID > 0)
            {
                $lista = self::GetKepekLista("kepek.kapcs_ID = ".$ID);

                if(count($lista) > 0)
                {
                    $kep = $lista[0];
                }
            }
            return $kep;
        }

        public static function GetKolcsonzesekLista($where = "1", $orderby = "", $limit = "")
        {
            $lista = array();

            $kapcsolat = new sql();

            $adat = $kapcsolat->GetSqlResult(self::GetSelectSql("kolcsonzesek", $where, $orderby, $limit));
        
            while($row = mysqli_fetch_array($adat))
            {
                $kolcsonzes = new kolcsonzesek();
                $kolcsonzes->KolcsonzesInit($row);

                array_push($lista, $kolcsonzes);
            }

            return $lista;
        }

        public static function GetKolcsonzesekFromKonyvID($ID)
        {
            $kolcsonzes = new kolcsonzesek();

            if (isset($ID) && $ID > 0)
            {
                $lista = self::GetKolcsonzesekLista("kolcsonzesek.konyv_ID = ".$ID);

                if(count($lista) > 0)
                {
                    $kolcsonzes = $lista[0];
                }
                
            }
            return $kolcsonzes;
        }

        public static function GetKolcsonzesekFromUser($felh_ID, $konyv_ID)
        {
            $kolcsonzes = new kolcsonzesek();

            if (isset($konyv_ID) && $konyv_ID > 0 && isset($felh_ID) && $felh_ID > 0)
            {
                $lista = self::GetKolcsonzesekLista("kolcsonzesek.konyv_ID = ".$konyv_ID." and kolcsonzesek.felh_ID = ".$felh_ID." ");

                if(count($lista) > 0)
                {
                    $kolcsonzes = $lista[0];
                }
                
            }
            return $kolcsonzes;
        }

        public static function GetKonyvekLista($where = "konyvek.statusz = 'aktiv'", $orderby = "", $limit = "")
        {
            $lista = array();

            $kapcsolat = new sql();

            $adat = $kapcsolat->GetSqlResult(self::GetSelectSql("konyvek", $where, $orderby, $limit));
        
            while($row = mysqli_fetch_array($adat))
            {
                $konyv = new konyvek();
                $konyv->KonyvInit($row);

                array_push($lista, $konyv);
            }

            return $lista;
        }

        public static function GetKonyvFromID($ID)
        {
            $konyv = new konyvek();

            if (isset($ID) && $ID > 0)
            {
                $lista = self::GetKonyvekLista("konyvek.ID = ".$ID);

                if(count($lista) > 0)
                {
                    $konyv = $lista[0];
                }
                
            }
            return $konyv;
        }

        public static function GetKonyvFromAzon($azon)
        {
            $konyv = new konyvek();

            if (isset($azon) && $azon > 0)
            {
                $lista = self::GetKonyvekLista("konyvek.azonosito = ".$azon);

                if(count($lista) > 0)
                {
                    $konyv = $lista[0];
                }
            }

            return $konyv;
        }

        public static function GetKonyvDelete($konyv)
        {
            $oldkonyv = $konyv;
            $newkonyv = clone $konyv;

            $newkonyv->statusz = "torolve";

            if(self::GetObjectUpdate("konyvek", $oldkonyv, $newkonyv))
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public static function GetMufajokLista($where = " mufajok.statusz = 'aktiv' ", $orderby = "", $limit = "")
        {
            $lista = array();

            $kapcsolat = new sql();

            $adat = $kapcsolat->GetSqlResult(self::GetSelectSql("mufajok", $where, $orderby, $limit));
        
            while($row = mysqli_fetch_array($adat))
            {
                $mufaj = new mufajok();
                $mufaj->MufajInit($row);

                array_push($lista, $mufaj);
            }

            return $lista;
        }

        public static function GetMufajFromID($ID)
        {
            $mufaj = new mufajok();

            if (isset($ID) && $ID > 0)
            {
                $lista = self::GetMufajokLista("mufajok.ID = ".$ID);

                if(count($lista) > 0)
                {
                    $mufaj = $lista[0];
                }
                
            }
            return $mufaj;
        }

        public static function GetTipusokLista($where = " tipusok.statusz = 'aktiv' ", $orderby = "", $limit = "")
        {
            $lista = array();

            $kapcsolat = new sql();

            $adat = $kapcsolat->GetSqlResult(self::GetSelectSql("tipusok", $where, $orderby, $limit));
        
            while($row = mysqli_fetch_array($adat))
            {
                $tipus = new tipusok();
                $tipus->TipusInit($row);

                array_push($lista, $tipus);
            }

            return $lista;
        }

        public static function GetTipusFromID($ID)
        {
            $tipus = new tipusok();

            if (isset($ID) && $ID > 0)
            {
                $lista = self::GetTipusokLista("tipusok.ID = ".$ID);

                if(count($lista) > 0)
                {
                    $tipus = $lista[0];
                }
                
            }
            return $tipus;
        }

}
?>