<?php
class muvelet
{
    public static function GetSafeString($txt)
    {
        if(!empty($txt))
        {
            $txt = trim($txt);
        

        $txt = str_replace("'", "", $txt);
        $txt = str_replace('"', "", $txt);
        $txt = str_replace(";", "", $txt);
        $txt = str_replace(".", "", $txt);
        }
    return $txt;
    }

    public static function GetOneString($txt)
    {
        if(!empty($txt))
            {
            $txt = trim($txt);
            $txt = strtolower($txt);

            $txt = strtr($txt, "áéíóöőúüű","aeiooouuu");
            
          
            $txt = str_replace(" ", "_", $txt);
            }
        return $txt;
    }
}
?>