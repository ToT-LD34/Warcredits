<?php
class DBSingleton
{
    private static $inst = NULL;
    private static $db = FALSE; //connection to be opened
    //DB connection values
    private $server = NULL; private $usr = NULL; private $psw = NULL; private $name = NULL;
    public static function getInstance()
    {
    //simply stores connections values, without opening connection
        if(self::$db == NULL){
           new DBSingleton();
        }
        return self::$db;
    }
    private function __construct(){
        self::$db = new PDO('mysql:host=localhost;dbname=warcredits;charset=utf8', 'root', 'iamj');
    }
}
$db = DBSingleton::getInstance();
?>
