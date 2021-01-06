<?php
class VerifyData{
    
    public static function isTheseParametersAvailable($params){
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
}