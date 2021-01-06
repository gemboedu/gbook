<?php 
require_once "../controllers/PublishersController.php";
require_once "verifyData.php";


header('Content-Type: aplication/json');

$title = isset($_POST['title']) ? $_POST['title'] : '';
$country = isset($_POST['country']) ? $_POST['country'] : '';
$id = isset($_POST['id']) ? $_POST['id'] : '';

$response = array();

if(isset($_GET['apicall'])){
    
    switch($_GET['apicall']){
        case 'publishers':
            $result = PublishersController::getAllPublishersController();
            if ($result != 0) {
                $response['err'] = false;
                $response["msg"]= 'Solicitud completada correctamente';  
                $response["data"]= $result;  
            }else{
                $response['err'] = true;
                $response["msg"]= 'No existe ninguna editorial registrada en el sistema'; 
            }
        break;

        case 'publisher':
            VerifyData::isTheseParametersAvailable(array('id'));
                $result = PublishersController::getOnePublisherController($id);
                if ($result != 0) {
                    $response['err'] = false;
                    $response["msg"]= 'Solicitud completada correctamente';  
                    $response["data"]= $result;  
                }else{
                    $response['err'] = true;
                    $response["msg"]= 'No se encontró ninguna editorial'; 
                }
            break;

            case 'create':
                VerifyData::isTheseParametersAvailable(array('title','country'));
                $result = PublishersController::createPublisherController($title,$country);
                if ($result != -1) {
                    $response['err'] = false;
                    $response["msg"]= 'Editorial registrado exitosamente';  
                }else{
                    $response['err'] = true;
                    $response["msg"]= 'La editorial fue registrado anteriormente';
                }
                break;
            case 'update':
                    VerifyData::isTheseParametersAvailable(array('id', 'title', 'country'));
                    $result = PublishersController::updatePublisherController($id, $title, $country);
                    if ($result === 1) {
                        $response['err'] = false;
                        $response["msg"]= 'Editorial actualizado correctamente';  
                    }else{
                        $response['err'] = true;
                        $response["msg"]= 'Error al actualizar, intente nuevamente';
                    }
                break;
            
            case 'delete':
                    VerifyData::isTheseParametersAvailable(array('id'));
                    $result = PublishersController::deletePublisherController($id);
                    if ($result === 1) {
                        $response['err'] = false;
                        $response["msg"]= 'Editorial eliminado correctamente';  
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