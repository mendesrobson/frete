<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'classes/Regioes.php';
require_once 'classes/Motoboys.php';
require_once 'classes/Clientes.php';
require_once 'classes/Vendedores.php';

class Rest{
    public static  function open($requisicao){

        $url = explode('/', $requisicao['url']);

        $classe = ucfirst($url[0]);
        array_shift($url);

        $metodo = ucfirst($url[0]);
        array_shift($url);

        $parametros = array();
        $parametros = $url;
        
        try{
            if(class_exists($classe)){
                if(method_exists($classe,$metodo)){
                    $retorno = call_user_func_array(array(new $classe,$metodo),$parametros);
                    return json_encode(array('status'=> 200,'dados'=> $retorno));
    
                }else{
                    return json_encode(array('status'=> 412,'dados'=> 'metodo inexistente!','paramentros'=> $parametros));
                }
            }else{
                return json_encode(array('status'=> 412,'dados'=> 'classe inexistente!'));
            }
        }catch(Exception $e){
            return json_encode(array('status'=> 412,'dados'=> $e->getMessage()));
        }
    }
}

if(isset($_REQUEST)){
    echo Rest::open($_REQUEST);
}

?>