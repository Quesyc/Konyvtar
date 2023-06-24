<?php

class db
{
    public static $host = "localhost";
    public static $user = "quesyc";
    public static $pass = "quesyc";
    public static $data = "konyvtar";
}

class sql
{
    private $connect;
    public function __construct()
    {
        $this->connect = new mysqli(db::$host, db::$user, db::$pass, db::$data);
        if ($this->connect->connect_error)
        {
            die("Mysql hiba: ".$this->connect->error);
        }
    }

    public function lekerdezes($command)
    {
        $table = array();
        try
        {
            $halmaz = $this->connect->query($command);

            if(!empty($halmaz))
            {
                while ($sor = mysqli_fetch_array($halmaz))
                {
                    array_push($table, $sor);
                }
            }
            else
            {
                echo("Lekérdezési hiba: Üres eredmény!");
                return;
            }
            $this->connect->close();
        }
        catch (Exception $ex)
        {
            echo("Lekérdezési hiba: ".$ex->getMessage());
            return;
        }
        return $table;
    }
    public function GetSqlResult($command)
    {
        //die($command);

        try
        {
            return $this->connect->query($command);

            $this->connect->close();
        }
        catch (Exception $ex)
        {
            echo("Lekérdezési hiba: ".$ex->getMessage());
            return;
        }
        return $table;
    }

    public function GetLastInsertedID()
    {
        return $this->connect->insert_id;
    }
    public function vegrehajtas($command)
    {
        try
        {
            $this->connect->query($command);
            $this->connect->close();
        }
        catch (Exception $ex)
        {
            echo("Végrehajtási hiba: ".$ex->getMessage());
            return;
        }
    }
}
?>

