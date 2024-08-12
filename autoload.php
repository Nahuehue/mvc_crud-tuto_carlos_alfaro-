<?php 

//carga de las clases o archivos de clases que tienen todo el codigo de las clases 
    spl_autoload_register(function($clase){
        $archivo = __DIR__."/".$clase.".php"; //obtiene el directorio acctual de donde se esta ejecutando 
        $archivo = str_replace("\\","/",$archivo);//para evitar problemas en servidores linux
    
        if(is_file($archivo)){
            require_once $archivo;
        } 

    });//obtiene el nombre de las clases del sistema
    

