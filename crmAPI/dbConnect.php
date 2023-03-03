<?php
class dbConnect 
{
    private $server ="localhost";
    private $username="root";
    private $pass="";
    private $dbname="my_test_db";
    function connect()
    {
        try
        {
            $conn = new PDO("mysql:host=".$this->server.";dbname=".$this->dbname,$this->username,$this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $conn;
        }catch(\Exception $e)
        {
            echo  "database error : ".$e->getMessage(); 
        }
    }
}
$db = new DbConnect;
$db->connect();
?>