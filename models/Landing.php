<?php 
/*
|----------------------------------------------------------------------------
| Landing Page Class
|----------------------------------------------------------------------------
*/
class Landing    
{
    private $db;
    /*
    |--------------------------------------------------------------------------
    | Setup our constructor. So can access the database.
    |--------------------------------------------------------------------------
    */    
    public function __construct($db)
    {
        $this->db       = $db;
    }

    public function formatAll($array)
    {
        foreach($array as $key => $value)
        {
            if(!is_array($array[$key])) $array[$key] = htmlspecialchars($value);
        }
        return $array;
    }
}

?>