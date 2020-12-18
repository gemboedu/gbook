<?php

include_once 'commons/dbqueries.php';

class UsersModel{
    public static function getAllUsersModel($table){
        $sql = "SELECT * FROM $table";
        $result = DBQueries::db_query($sql,null,true);
        if (!empty($result)) {
            return $result;
        }else{
            return 0;
        }
    }

    public static function getOneUserModel( $table, $id){
        $sql = "SELECT * FROM $table WHERE id = ?";
        $data = array($id);
        $result = DBQueries::db_query($sql, $data, true, true);
        if (!empty($result)) {
            return $result;
        }else{
            return 0;
        }
    }

    public static function verifyEmailModel(){
        
    }

    public static function verifyAccountModel(){
        
    }

    public static function createUserModel(){
        
    }

    public static function updateProfileModel(){
        
    }

    public static function updatePasswordModel(){
        
    }
    
    public static function updateEmailModel(){
        
    }
}
/*
echo '<pre>';
var_dump(UsersModel::getAllUsersModel());
echo '</pre>';

*/