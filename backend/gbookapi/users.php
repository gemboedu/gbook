<?php 
require_once "../controllers/UsersController.php";


header('Content-Type: aplication/json');

$id = isset($_POST['id']) ? $_POST['id'] : '';

function isTheseParametersAvailable($params){
    $available = true;
    $missingparams = "";

    foreach ($params as $param) {

        if (!isset($_POST[$param]) || strlen($_POST[$param]) <= 0) {

            $available = false;
            $missingparams = $missingparams . ", ".$param;
        }
    }

    //Cuando faltan parametros
    if (!$available) {
        # code...
        $response = array();
        $response['err'] = true;
        $response['msg'] = 'Missing parameters: ' . substr($missingparams, 1, strlen($missingparams));

        //error de visualizacion
        echo json_encode($response); 

        //detener la ejecucion
        die();
    }
}

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
            isTheseParametersAvailable(array('id'));
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

        default:
            $response['err'] = true;
            $response["msg"]= 'Invalid End Point';
        } // end switch

    }else{

    $response['err'] = true;
    $response['msg'] = 'Invalid API call';
}

echo json_encode($response);