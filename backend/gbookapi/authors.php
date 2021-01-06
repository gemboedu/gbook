<?php 
require_once "../controllers/AuthorsController.php";
require_once "verifyData.php";


header('Content-Type: aplication/json');

$name = isset($_POST['name']) ? $_POST['name'] : '';
$country = isset($_POST['country']) ? $_POST['country'] : '';
$id = isset($_POST['id']) ? $_POST['id'] : '';

$response = array();

if(isset($_GET['apicall'])){
    
    switch($_GET['apicall']){
        case 'authors':
            $result = AuthorsController::getAllAuthorsController();
            if ($result != 0) {
                $response['err'] = false;
                $response["msg"]= 'Solicitud completada correctamente';  
                $response["data"]= $result;  
            }else{
                $response['err'] = true;
                $response["msg"]= 'No existe nungún autor registrado en el sistema'; 
            }
        break;

        case 'author':
            VerifyData::isTheseParametersAvailable(array('id'));
                $result = AuthorsController::getOneAuthorController($id);
                if ($result != 0) {
                    $response['err'] = false;
                    $response["msg"]= 'Solicitud completada correctamente';  
                    $response["data"]= $result;  
                }else{
                    $response['err'] = true;
                    $response["msg"]= 'No se encontró ningún autor'; 
                }
            break;

            case 'create':
                VerifyData::isTheseParametersAvailable(array('name','country'));
                $result = AuthorsController::createAuthorController($name,$country);
                if ($result != -1) {
                    $response['err'] = false;
                    $response["msg"]= 'Autor registrado exitosamente';  
                }else{
                    $response['err'] = true;
                    $response["msg"]= 'El autor fue registrado anteriormente';
                }
                break;
            case 'update':
                    VerifyData::isTheseParametersAvailable(array('id', 'name', 'country'));
                    $result = AuthorsController::updateAuthorController($id, $name, $country);
                    if ($result === 1) {
                        $response['err'] = false;
                        $response["msg"]= 'Author actualizado correctamente';  
                    }else{
                        $response['err'] = true;
                        $response["msg"]= 'Error al actualizar, intente nuevamente';
                    }
                break;
            
            case 'delete':
                    VerifyData::isTheseParametersAvailable(array('id'));
                    $result = AuthorsController::deleteAuthorController($id);
                    if ($result === 1) {
                        $response['err'] = false;
                        $response["msg"]= 'Autor eliminado correctamente';  
                    }else{
                        $response['err'] = true;
                        $response["msg"]= 'Error al eliminar, intente nuevamente';
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