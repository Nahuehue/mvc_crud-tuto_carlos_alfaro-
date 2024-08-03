<?php
    //peticiones ajax del modulo de usuarios
    require_once "../../config/app.php";
    require_once "../views/inc/session_start.php";
    require_once "../../autoload.php";

    use app\controllers\userController;

    if (isset($_POST['modulo_usuario'])) {
        $insUsuario = new userController();//instancia a clase usuario

        if ($_POST['modulo_usuario'] == "registrar") {
            echo $insUsuario->registrarUsuarioControlador();
        }
    } else {
        session_destroy();
        header("Location: ".APP_URL."login/");
    }
    