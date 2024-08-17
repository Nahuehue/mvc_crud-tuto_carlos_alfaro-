<?php
 	namespace app\controllers;
    use app\models\mainModel;

    class loginController extends mainModel {
     
        //controlador inicio sesion
        public function iniciarSesionControlador(){
            $usuario = $this->limpiarCadena($_POST['login_usuario']); 
            $clave = $this->limpiarCadena($_POST['login_clave']);
        
             // Verificar campos obligatorios
             if ($usuario == "" || $clave == "" ) {
                echo "
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Ocurrio un error inesperado',
                        text: 'No has llenado todos los campos obligatorios',
                        confirmButtonText: 'Aceptar'
                    });
                </script>
                ";
            }else {
                // verificar integridad de datos
                if ($this->verificarDatos("[a-zA-Z0-9]{4,20}", $usuario)) {
                    echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Ocurrio un error inesperado',
                            text: 'El Usuario No coincide con el formato solicitado',
                            confirmButtonText: 'Aceptar'
                        });
                    </script>
                    ";
                } else {
                    if ($this->verificarDatos("[a-zA-Z0-9$@.-]{7,100}", $clave)) {
                        echo "
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Ocurrio un error inesperado',
                                text: 'El Usuario No coincide con el formato solicitado',
                                confirmButtonText: 'Aceptar'
                            });
                        </script>
                        ";
                    } else {
                        //verificacion de usuario
                        $check_usuario = $this->ejecutarConsulta("SELECT * FROM 
                        usuario WHERE usuario_usuario = '$usuario'");
                        if ($check_usuario->rowCount() == 1) {
                            $check_usuario = $check_usuario->fetch();

                            if ($check_usuario['usuario_usuario'] == $usuario && password_verify($clave, $check_usuario['usuario_clave'] )) {
                                //se crean variables de sesion
                                $_SESSION['id'] = $check_usuario['usuario_id'];
                                $_SESSION['nombre'] = $check_usuario['usuario_nombre'];
                                $_SESSION['apellido'] = $check_usuario['usuario_apellido'];
                                $_SESSION['usuario'] = $check_usuario['usuario_usuario'];
                                $_SESSION['foto'] = $check_usuario['usuario_foto'];

                                //verificar si se envian los encabezados
                                if (headers_sent()) {
                                    echo " <script> window.location.href='".APP_URL."dashboard/';
                                    </script> " ;
                                } else {
                                    header("Location: ".APP_URL."dashboard/");
                                }
                                
                            } else {
                                echo "
                                <script>
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Ocurrio un error inesperado',
                                        text: 'Usuario o clave incorrecto',
                                        confirmButtonText: 'Aceptar'
                                    });
                                </script>
                                ";
                            }
                            
                        } else {
                            echo "
                            <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Ocurrio un error inesperado',
                                    text: 'Usuario o clave incorrecto',
                                    confirmButtonText: 'Aceptar'
                                });
                            </script>
                            ";
                        }
                        
                    }
                    
                }
                
            }
        }

        //controlador de cierre de sesion 
        public function cerrarSesionControlador(){

            session_destroy();

            //redirecciones a login
            
            if (headers_sent()) {
                echo " <script> window.location.href='".APP_URL."login/';
                </script> " ;
            } else {
                header("Location: ".APP_URL."login/");
            }
        }
    }