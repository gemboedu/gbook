<?php
include_once 'config.php';
class Connection{
    public function db_connection(){
        $dsn = DB['dsn'];
        $user = DB['user'];
        $pass = DB['pass'];
        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    
        try{
            $db = new PDO($dsn,$user,$pass,$options);
            return $db;
        }catch(PDOException $e){
            echo '<p>Error!: <mark>' . $e->getMessage() . '</mark></p>';
            die();
        }
    }
}
/*
$conn = new Connection();
print_r($conn->db_connection());
*/