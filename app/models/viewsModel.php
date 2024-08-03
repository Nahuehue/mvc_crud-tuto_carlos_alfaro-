<?php
    namespace app\models; //(como un nombre de proyecto)/nombre de la clase 

    class viewsModel {
        protected function obtenerVistasModelo($vista){
            //los valores que se permiten en la url
            $listaBlanca = ["dashboard","userNew","userList","userSearch","userUpdate","userPhoto",
            "logOut"];

            if(in_array($vista, $listaBlanca)){
                if(is_file("./app/views/content/".$vista."-view.php")){
                    $contenido = "./app/views/content/".$vista."-view.php";
                } else{
                    $contenido = "404";
                }
            } elseif($vista == "login" || $vista == "index"){
                $contenido = "login";
            }else {
                $contenido = "404";
            }
            
            return $contenido ;
        }
    }