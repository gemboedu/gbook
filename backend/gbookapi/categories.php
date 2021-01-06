<?php 
require_once "../controllers/CategoriesController.php";
require_once "verifyData.php";


header('Content-Type: aplication/json');

$name = isset($_POST['name']) ? $_POST['name'] : '';
$description = isset($_POST['description']) ? $_POST['description'] : '';
$id = isset($_POST['id']) ? $_POST['id'] : '';

$response = array();

if(isset($_GET['apicall'])){
    
    switch($_GET['apicall']){
        case 'categories':
            $result = CategoriesController::getAllCategoriesController();
            if ($result != 0) {
                $response['err'] = false;
                $response["msg"]= 'Solicitud completada correctamente';  
                $response["data"]= $result;  
            }else{
                $response['err'] = true;
                $response["msg"]= 'No existe ninguna categoría registrada en el sistema'; 
            }
        break;

        case 'category':
            VerifyData::isTheseParametersAvailable(array('id'));
                $result = CategoriesController::getOneCategoryController($id);
                if ($result != 0) {
                    $response['err'] = false;
                    $response["msg"]= 'Solicitud completada correctamente';  
                    $response["data"]= $result;  
                }else{
                    $response['err'] = true;
                    $response["msg"]= 'No se encontró ninguna categoría'; 
                }
            break;

            case 'create':
                VerifyData::isTheseParametersAvailable(array('name','description'));
                $result = CategoriesController::createCategoryController($name,$description);
                if ($result != -1) {
                    $response['err'] = false;
                    $response["msg"]= 'Categoría registrado exitosamente';  
                }else{
                    $response['err'] = true;
                    $response["msg"]= 'La categoría fue registrado anteriormente';
                }
                break;
            case 'update':
                    VerifyData::isTheseParametersAvailable(array('id', 'name', 'description'));
                    $result = CategoriesController::updateCategoryController($id, $name, $description);
                    if ($result === 1) {
                        $response['err'] = false;
                        $response["msg"]= 'Categoría actualizado correctamente';  
                    }else{
                        $response['err'] = true;
                        $response["msg"]= 'Error al actualizar, intente nuevamente';
                    }
                break;
            
            case 'delete':
                    VerifyData::isTheseParametersAvailable(array('id'));
                    $result = CategoriesController::deleteCategoryController($id);
                    if ($result === 1) {
                        $response['err'] = false;
                        $response["msg"]= 'Categoría eliminado correctamente';  
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