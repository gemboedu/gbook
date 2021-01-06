<?php
include_once '../models/authModel.php';

class AuthController{

    public static function loginController($email, $password){
        return AuthModel::loginModel('users', $email, $password);
    }
}