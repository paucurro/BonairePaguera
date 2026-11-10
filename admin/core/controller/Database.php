<?php

#[AllowDynamicProperties]
class Database
{
    public static $db;
    public static $con;

    function __construct()
    {
        $this->user = "User_Bonaire_Db";
        $this->pass = "HgFGE^wZ7qwh";
        $this->host = "localhost";
        $this->ddbb = "bonaire_atalaya_db";
    }

    function connect()
    {
        mysqli_report(MYSQLI_REPORT_OFF); // PHP 8.1+ lanza excepciones por defecto
        $con = new mysqli($this->host, $this->user, $this->pass, $this->ddbb);
        $con->set_charset('utf8');
        return $con;
    }

    public static function getCon()
    {
        if (self::$con == null && self::$db == null) {
            self::$db = new Database();
            self::$con = self::$db->connect();
        }
        return self::$con;
    }

}

?>
