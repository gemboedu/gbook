<?php
include_once '../models/CategoriesModel.php';

class CategoriesController{
    public static function getAllCategoriesController(){
        return CategoriesModel::getAllCategoriesModel('categories');
    }

    public static function getOneCategoryController($id){
        return CategoriesModel::getOneCategoryModel('categories', $id);
    }

    public static function createCategoryController($name, $description){
        return CategoriesModel::createCategoryModel('categories',$name, $description);
    }

    public static function updateCategoryController($id, $name, $description){
        return CategoriesModel::updateCategoryModel('categories',$id, $name, $description);
    }

    public static function deleteCategoryController($id){
        return CategoriesModel::deleteCategoryModel('categories', $id);
    }
}