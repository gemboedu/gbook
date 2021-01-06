
<?php
include_once '../models/AuthorsModel.php';

class AuthorsController{
    public static function getAllAuthorsController(){
        return AuthorsModel::getAllAuthorsModel('authors');
    }

    public static function getOneAuthorController($id){
        return AuthorsModel::getOneAuthorModel('authors', $id);
    }

    public static function createAuthorController($name, $country){
        return AuthorsModel::createAuthorModel('authors',$name, $country);
    }

    public static function updateAuthorController($id, $name, $country){
        return AuthorsModel::updateAuthorModel('authors',$id, $name, $country);
    }

    public static function deleteAuthorController($id){
        return AuthorsModel::deleteAuthorModel('authors', $id);
    }
}