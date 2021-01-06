<?php

include_once 'commons/dbqueries.php';

class UsersModel{
    public static function getAllUsersModel($table){
        $sql = "SELECT * FROM $table ORDER BY registed_at DESC";
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

    public static function verifyEmailModel($table,$email){
        $sql = "SELECT email FROM $table WHERE email = ?";
        $data = array($email);
        $result = DBQueries::db_query($sql,$data,true);
        if (!empty($result)) {
            return 1;
        }else{
            return 0;
        }
    }

    public static function verifyAccountModel(){
        
    }

    public static function createUserModel($role,$name,$email,$password){
        $pass = password_hash($password, PASSWORD_DEFAULT);
        $sql = "CALL p_create_user(?,?,?,?)";
        $data = array($role,$name,$email,$pass);
        $result = DBQueries::db_query($sql,$data,true);
        if ($result[0]['response'] === '0') {
            return -1;
        }else{
            return 1;
        }
        
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
var_dump(UsersModel::createUserModel(2,'Nela','nela@gmail.com','nela123'));
echo '</pre>';
*/