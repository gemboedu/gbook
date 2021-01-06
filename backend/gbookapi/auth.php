<?php 
require_once "../controllers/authController.php";
require_once "verifyData.php";


header('Content-Type: aplication/json');

$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

$response = array();

if(isset($_GET['apicall'])){
    
    switch($_GET['apicall']){
        case 'auth':
            VerifyData::isTheseParametersAvailable(array('email','password'));
                $result = AuthController::loginController($email,$password);
                if ($result === -1) {
                    $response['err'] = true;
                    $response["msg"]= 'Verifique que el usuario sea correcto';  
                }else if($result === 0){
                    $response['err'] = true;
                    $response["msg"]= 'Verifique que la contraseña sea correcta'; 
                }else{
                    $response['err'] = false;
                    $response["msg"]= 'Iniciando sesión...';  
                    $response["data"]= $result;  
                }
            break;

        default:
            $response['err'] = true;
            $response["msg"]= 'Invalid End Point';
        } // end switch

    }else{

    $response['err'] = true;
    $response['msg'] = 'Invalid API call';
}

echo json_encode($response);