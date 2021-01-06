<?php

include_once 'commons/dbqueries.php';

class AuthorsModel{
    public static function getAllAuthorsModel($table){
        $sql = "SELECT id, name, country FROM $table";
        $result = DBQueries::db_query($sql, null, true);
        if (!empty($result)) {
            return $result;
        }else{
            return 0;
        }
    }

    public static function getOneAuthorModel($table, $id){
        $sql = "SELECT id, name, country FROM $table WHERE id = ?";
        $data = array($id);
        $result = DBQueries::db_query($sql, $data, true, true);
        if (!empty($result)) {
            return $result;
        }else{
            return 0;
        }
    }

    public static function createAuthorModel($table, $name, $country){
        if (AuthorsModel::verifyAuthorModel($table, $name) === 0) {
            if ($country === 'null' || $country === 'NULL') {
                $country = NULL;
            }
            $sql = "INSERT INTO $table(name, country) VALUES(?,?)";
            $data = array($name,$country);
            $result = DBQueries::db_query($sql, $data);
            if ($result) {
                return 1;
            }else{
                return 0;
            }      
        }else{
            return -1;
        }

    }

    public static function verifyAuthorModel($table,$name){
        $sql = "SELECT name FROM $table WHERE name = ?";
        $data = array($name);
        $result = DBQueries::db_query($sql, $data, true);
        if (!empty($result)) {
            return 1;
        }else{
            return 0;
        }
    }

    public static function updateAuthorModel($table, $id, $name, $country){
        
    }

    public static function deleteAuthorModel($table, $id){

    }
}