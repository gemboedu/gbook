<?php
include_once 'commons/dbqueries.php';

class AuthModel{

    public static function loginModel($table, $email, $password){
        $sql = "SELECT * FROM $table WHERE email = ?";
        $data = array($email);
        $result = DBQueries::db_query($sql,$data,true,true);
        if (!empty($result)) {
            $psql = "SELECT password FROM accounts WHERE id_user = ?";
            $pdata = array($result['id']);
            $presult = DBQueries::db_query($psql,$pdata,true,true);
            if (password_verify($password,$presult['password'])) {
                $fsql = "SELECT 
                        u.id AS id_user,
                        r.name AS role,
                        a.status,
                        u.name,
                        u.document,
                        u.phone,
                        u.nickname,
                        u.address,
                        u.email,
                        u.photo,
                        u.registed_at,
                        a.last_connection
                    FROM accounts AS a
                    LEFT JOIN users AS u
                    ON a.id_user = u.id
                    LEFT JOIN roles AS r
                    ON a.id_role = r.id
                    WHERE u.email = ?";
                $fdata = array($email);
                $fresult = DBQueries::db_query($fsql,$fdata,true,true);
                return $fresult;
            }else{
                return 0;
            }
        }else{
            return -1;
        }
    }
}

/*
echo '<pre>';
var_dump(AuthModel::loginModel('users','kaen@gmail.com','karen123'));
echo '</pre>';
*/