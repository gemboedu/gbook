<?php
include_once '../models/UsersModel.php';

class UsersController{

    public static function getAllUsersController(){
        return UsersModel::getAllUsersModel('users');
    }

    public static function getOneUserController($id){
        return UsersModel::getOneUserModel('users',$id);
    }
}
/*
echo '<pre>';
var_dump(UsersController::getOneUserController(1));
echo '</pre>';
*/