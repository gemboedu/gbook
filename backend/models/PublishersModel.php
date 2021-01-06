<?php

include_once 'commons/dbqueries.php';

class PublishersModel{
    
    public static function getAllPublishersModel($table){
        $sql = "SELECT id, title, country FROM $table";
        $result = DBQueries::db_query($sql,null,true);
        if (!empty($result)) {
            return $result;
        }else{
            return 0;
        }
    }

    public static function getOnePublisherModel($table, $id){
        $sql = "SELECT id,title, country FROM $table WHERE id = ?";
        $data = array($id);
        $result = DBQueries::db_query($sql,$data,true,true);
        if (!empty($result)) {
            return $result;
        }else{
            return 0;
        }
    }

    public static function createPublisherModel($table, $title, $country){
        if (PublishersModel::verifyPublisherModel($table,$title) === 1) {
            return -1;
        }else{
            if ($country == 'null' || $country == 'NULL') {
                $country = NULL;
            }
            $sql = "INSERT INTO $table(title, country) VALUES(?, ?)";
            $data = array($title, $country);
            $result = DBQueries::db_query($sql, $data);
            if ($result) {
                return 1;
            }else{
                return 0;
            }
        }
    }

    public static function verifyPublisherModel($table,$title){
        $sql = "SELECT title FROM $table WHERE title = ?";
        $data = array($title);
        $result = DBQueries::db_query($sql, $data, true, true);
        if (!empty($result)) {
            return 1;
        }else{
            return 0;
        }
    }

    public static function updatePublisherModel($table, $id, $title, $country){
        if ($country == 'null' || $country == 'NULL') {
            $country = NULL;
        }
        $sql = "UPDATE $table SET title = ?, country = ? WHERE id = ?";
        $data = array($title,$country,$id);
        $result = DBQueries::db_query($sql,$data);
        if ($result) {
            return 1;
        }else{
            return 0;
        }
    }

    public static function deletePublisherModel($table, $id){
        $sql = "DELETE FROM $table WHERE id = ?";
        $data = array($id);
        $result = DBQueries::db_query($sql,$data);
        if ($result) {
            return 1;
        }else{
            return 0;
        }
    }
}