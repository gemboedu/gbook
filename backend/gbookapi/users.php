<?php 
require_once "../controllers/UsersController.php";
require_once "verifyData.php";


header('Content-Type: aplication/json');

$id = isset($_POST['id']) ? $_POST['id'] : '';
$role = isset($_POST['role']) ? $_POST['role'] : '';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

$response = array();

if(isset($_GET['apicall'])){
    
    switch($_GET['apicall']){
        case 'users':
                $result = UsersController::getAllUsersController();
                if ($result != 0) {
                    $response['err'] = false;
                    $response["msg"]= 'Solicitud completada correctamente';  
                    $response["data"]= $result;  
                }else{
                    $response['err'] = true;
                    $response["msg"]= 'No existe ningún usuario registrado en el sistema'; 
                }
            break;
        case 'user':
            VerifyData::isTheseParametersAvailable(array('id'));
                $result = UsersController::getOneUserController($id);
                if ($result != 0) {
                    $response['err'] = false;
                    $response["msg"]= 'Solicitud completada correctamente';  
                    $response["data"]= $result;  
                }else{
                    $response['err'] = true;
                    $response["msg"]= 'No se encontró ningún usuario'; 
                }
            break;
            
        case 'adduser':
            VerifyData::isTheseParametersAvailable(array('role','name','email','password'));
            $result = UsersController::createUserController($role,$name,$email,$password);
            if ($result != -1) {
                $response['err'] = false;
                $response["msg"]= 'Felicidades! Ya eres parte de GBook';  
            }else{
                $response['err'] = true;
                $response["msg"]= 'El email esta siendo utilizado por otro usuario';
            }
            break;

        default:
            $response['err'] = true;
            $response["msg"]= 'Error: Invalid End Point';
        } // end switch

    }else{

    $response['err'] = true;
    $response['msg'] = 'Error: Invalid API call';
}

echo json_encode($response);