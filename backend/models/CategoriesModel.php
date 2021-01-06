<?php

include_once 'commons/dbqueries.php';

class CategoriesModel{

    public static function getAllCategoriesModel($table){
        $sql = "SELECT id, name, description FROM $table";
        $result = DBQueries::db_query($sql,null,true);
        if (!empty($result)) {
            return $result;
        }else{
            return 0;
        }
    }

    public static function getOneCategoryModel($table, $id){
        $sql = "SELECT id, name, description FROM $table WHERE id = ?";
        $data = array($id);
        $result = DBQueries::db_query($sql,$data,true,true);
        if (!empty($result)) {
            return $result;
        }else{
            return 0;
        }
    }

    public static function createCategoryModel($table, $name, $description){
        if (CategoriesModel::verifyCategoryModel($table,$name) === 1) {
            return -1;
        }else{
            $sql = "INSERT INTO $table(name, description) VALUES(?, ?)";
            $data = array($name, $description);
            $result = DBQueries::db_query($sql, $data);
            if ($result) {
                return 1;
            }else{
                return 0;
            }
        }
    }

    public static function verifyCategoryModel($table,$name){
        $sql = "SELECT name FROM $table WHERE name = ?";
        $data = array($name);
        $result = DBQueries::db_query($sql, $data, true, true);
        if (!empty($result)) {
            return 1;
        }else{
            return 0;
        }
    }

    public static function updateCategoryModel($table, $id, $name, $description){
        $sql = "UPDATE $table SET name = ?, description = ? WHERE id = ?";
        $data = array($name,$description,$id);
        $result = DBQueries::db_query($sql,$data);
        if ($result) {
            return 1;
        }else{
            return 0;
        }
    }

    public static function deleteCategoryModel($table, $id){
        $sql = "DELETE FROM $table WHERE id = ? LIMIT 1";
        $data = array($id);
        $result = DBQueries::db_query($sql,$data);
        if ($result) {
            return 1;
        }else{
            return 0;
        }
    }
}