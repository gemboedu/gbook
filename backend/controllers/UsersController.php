<?php
include_once '../models/UsersModel.php';

class UsersController{

    public static function getAllUsersController(){
        return UsersModel::getAllUsersModel('users');
    }

    public static function getOneUserController($id){
        return UsersModel::getOneUserModel('users',$id);
    }

    public static function createUserController($role,$name,$email,$password){
        return UsersModel::createUserModel($role,$name,$email,$password);
    }
}
/*
echo '<pre>';
var_dump(UsersController::getOneUserController(1));
echo '</pre>';
*/