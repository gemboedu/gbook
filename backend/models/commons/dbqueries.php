<?php
require_once "connection.php";

class DBQueries extends Connection{

static function  db_query($sql, $data = array(), $is_search = false, $search_one = false ){
    $connection = new Connection();
    $db = $connection->db_connection();
    $mysql = $db->prepare($sql);
    $mysql->execute($data);

    if($is_search){
        //Consultas de tipo read
        if($search_one){
            //leer todos los registros
            $result = $mysql->fetch(PDO::FETCH_ASSOC);
        }else{
            //leer todos los registros
            $result = $mysql->fetchAll(PDO::FETCH_ASSOC); 
        }
        $db  = null;
        return $result;

    }else{
        //Consultas de tipo CREATE, UPDATE y DELETE
        $db = null;
        return true;
    }

}

} 