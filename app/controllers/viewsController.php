<?php
    namespace app\controllers;
    
    use app\models\viewsModel;

    class viewsController extends viewsModel {
        
        public function obtenerVistasControlador($vista){
            if ($vista != "")
                return $this->obtenerVistasModelo($vista);
            else
                return "login";
            
            //return $vista == "" ? "login" : $this->obtenerVistasModelo($vista);
        }
    }